<?php


namespace App\Virtual\Response\Errors;

/**
 * @OA\Schema(
 *     title="response Error 401",
 *     description="response Error 401",
 *     type="object",
 * )
 */
class Response401Virtual
{
    /**
     * @OA\Property(
     *      title="status",
     *      description="Status",
     *      example=401
     * )
     *
     * @var int
     */
    public $status;

    /**
     * @OA\Property(
     *      title="message",
     *      description="unauthorized",
     *      example="unauthorized user"
     * )
     *
     * @var string
     */
    public $message;

    /**
     * @OA\Property(
     *      title="data",
     *      description="data object",
     *      type="object",
     *      @OA\Property(
     *          property="data",
     *          type="object",
     *          example=null
     *      ),
     *      @OA\Property(
     *          property="meta",
     *          type="object",
     *          example=null
     *      )
     * )
     *
     * @var object
     */
    public $response;

    /**
     * @OA\Property(
     *      title="errors",
     *      type="object",
     *      example=null
     * )
     *
     * @var ?object
     */
    public $errors;
}
