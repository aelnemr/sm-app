<?php


namespace App\Http\Controllers\API\V1\Auth;


use App\Http\Controllers\API\V1\APIV1Controller;
use App\Http\Resources\UserProfileResource;
use App\Services\AccessTokenService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Psr\Http\Message\ServerRequestInterface;

class RegistrationController extends APIV1Controller
{

    /**
     * @var AccessTokenService
     */
    private $accessTokenService;

    public function __construct(AccessTokenService $accessTokenService)
    {
        $this->accessTokenService = $accessTokenService;
    }

    public function register(ServerRequestInterface $request): \Symfony\Component\HttpFoundation\JsonResponse
    {
        //validation
        $data = $this->isValid($request);

        $data['email'] = $data['username'];
        $data['password'] = Hash::make($data['password']);

        $user = \App\Models\User::query()->create(Arr::only($data, ['name', 'email', 'password']));
        $user->profile()->create(Arr::only($data, ['bio']));

        // get token
        $response = $this->accessTokenService->issueToken($request);
        $tokenData = json_decode($response->getContent(), true);
        $tokenData['user'] = new UserProfileResource($user);
        return $this->ok($tokenData);
    }

    public function isValid(ServerRequestInterface $request)
    {
        $rules = [
            'grant_type' => 'required',
            'client_id' => 'required|exists:oauth_clients,id',
            'client_secret' => 'required|exists:oauth_clients,secret',
            'username' => 'required|unique:users,email',
            'password' => 'required',
            'name' => 'required',
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
