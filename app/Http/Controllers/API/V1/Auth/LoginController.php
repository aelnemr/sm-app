<?php


namespace App\Http\Controllers\API\V1\Auth;


use AElnemr\RestFullResponse\CoreJsonResponse;
use Laravel\Passport\Exceptions\OAuthServerException;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use League\OAuth2\Server\Exception\OAuthServerException as LeagueException;
use Nyholm\Psr7\Response as Psr7Response;
use Nyholm\Psr7\ServerRequest;
use Psr\Http\Message\ServerRequestInterface;

class LoginController extends AccessTokenController
{
    use CoreJsonResponse;

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
     */
    public function issueToken(ServerRequestInterface $request)
    {
        $response = $this->withErrorHandling(function () use ($request) {
            return $this->convertResponse(
                $this->server->respondToAccessTokenRequest($request, new Psr7Response)
            );
        });

        $tokenData = json_decode($response->getContent(), true);

        return $this->ok($tokenData);
    }
}
