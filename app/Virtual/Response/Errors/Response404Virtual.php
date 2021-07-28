<?php


namespace App\Virtual\Response\Errors;

/**
 * @OA\Schema(
 *     title="response Error 404",
 *     description="response Error 404",
 *     type="object",
 * )
 */
class Response404Virtual
{
    /**
     * @OA\Property(
     *      title="status",
     *      description="Status",
     *      example=404
     * )
     *
     * @var int
     */
    public $status;

    /**
     * @OA\Property(
     *      title="message",
     *      description="not found",
     *      example="Not found"
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
     * @var object
     */
    public $errors;
}
