<?php


namespace App\Virtual\Response\Auth;


/**
 * @OA\Schema(
 *     title="Login success response",
 *     description="Login success response",
 *     type="object",
 * )
 */

class LoginResponse200Virtual
{
    /**
     * @OA\Property(
     *      title="status",
     *      description="Status",
     *      example=200
     * )
     *
     * @var int
     */
    public $status;

    /**
     * @OA\Property(
     *      title="message",
     *      description="success message",
     *      example="logged!"
     * )
     *
     * @var string
     */
    public $message;

    /**
     * @OA\Property(
     *      title="response",
     *      type="object",
     *      description="data object",
     *      @OA\Property(
     *          property="data",
     *          type="object",
     *          description="user token",
     *          @OA\Property(property="access_token", type="string", description="JWT user token", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9..."),
     *          @OA\Property(property="token_type", description="token type", type="string", example="Bearer"),
     *          @OA\Property(property="refresh_token", description="JWT user refresh token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9..."),
     *          @OA\Property(property="refresh_url", description="refresh token url", type="string", example="http://dev.uguworld.com/api/1.0/auth/refresh"),
     *          @OA\Property(property="expires_in", description="expires in (per second)", type="integer", example="1296000")
     *      ),
     *      @OA\Property(
     *          property="meta",
     *          type="object",
     *      )
     * )
     *
     * @var object
     */
    public $response;

    /**
     * @OA\Property(
     *      title="errors",
     *      type="object"
     * )
     *
     * @var ?object
     */
    public $errors;
}
