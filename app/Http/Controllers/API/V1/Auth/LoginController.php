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
     * @OA\Post(
     *     path="/1.0/auth/login",
     *     description="User login endpont & client id, password",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/LoginUserRequestVirtual")
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="successful loged",
     *          @OA\JsonContent(ref="#/components/schemas/LoginResponse200Virtual")
     *      ),
     *     @OA\Response(
     *          response=401,
     *          description="Invalid email or password",
     *          @OA\JsonContent(ref="#/components/schemas/Response401Virtual")
     *      ),
     *      @OA\Response(
     *          response=426,
     *          description="upgrade required",
     *          @OA\JsonContent(ref="#/components/schemas/Response401Virtual")
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="The given data was invalid",
     *          @OA\JsonContent(ref="#/components/schemas/Response422Virtual")
     *      )
     * )
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
