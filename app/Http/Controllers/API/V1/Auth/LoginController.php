<?php


namespace App\Http\Controllers\API\V1\Auth;


use App\Http\Controllers\API\V1\APIV1Controller;
use App\Http\Resources\UserProfileResource;
use App\Services\AccessTokenService;
use Illuminate\Validation\ValidationException;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class LoginController extends APIV1Controller
{
    /**
     * @var AccessTokenService
     */
    private $accessTokenService;

    public function __construct(AccessTokenService $accessTokenService)
    {
        $this->accessTokenService = $accessTokenService;
    }

    /**
     * @param ServerRequestInterface $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function login(ServerRequestInterface $request): JsonResponse
    {
        //validation
        $data = $this->isValid($request);

        // get token
        $response = $this->accessTokenService->issueToken($request);
        $tokenData = json_decode($response->getContent(), true);
        $tokenData['user'] = new UserProfileResource(
            \App\Models\User::query()
                ->where('email', $data['username'])
                ->firstOrFail()
        );

        return $this->ok($tokenData);
    }

    /**
     * @param ServerRequestInterface $request
     * @return array|object|null
     * @throws ValidationException
     */
    public function isValid(ServerRequestInterface $request)
    {
        $rules = [
            'grant_type' => 'required',
            'client_id' => 'required|exists:oauth_clients,id',
            'client_secret' => 'required|exists:oauth_clients,secret',
            'username' => 'required',
            'password' => 'required',
        ];

        $messages = [
            'client_id.exists' => 'Invalid client',
            'client_secret.exists' => 'Invalid client',
        ];

        $data = $request->getParsedBody();
        try {
            request()->validate($rules, $messages, $data);
            return $data;
        } catch (ValidationException $exception) {
            throw ValidationException::withMessages($exception->errors());
        }
    }
}
