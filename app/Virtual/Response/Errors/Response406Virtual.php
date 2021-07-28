<?php


namespace App\Virtual\Response\Errors;


/**
 * @OA\Schema(
 *     title="response validation Error 422",
 *     description="response validation Error 422",
 *     type="object",
 * )
 */

class Response406Virtual
{
    /**
     * @OA\Property(
     *      title="status",
     *      description="Status",
     *      example=406
     * )
     *
     * @var int
     */
    public $status;

    /**
     * @OA\Property(
     *      title="message",
     *      description="Not acceptable",
     *      example="not acceptable"
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
