<?php


namespace App\Virtual\Response\Errors;

/**
 * @OA\Schema(
 *     title="response Error 402",
 *     description="payment required 402",
 *     type="object",
 * )
 */
class Response402Virtual
{
    /**
     * @OA\Property(
     *      title="status",
     *      description="Status",
     *      example=402
     * )
     *
     * @var int
     */
    public $status;

    /**
     * @OA\Property(
     *      title="message",
     *      description="payment required",
     *      example="payment required"
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
