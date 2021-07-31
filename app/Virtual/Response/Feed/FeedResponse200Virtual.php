<?php


namespace App\Virtual\Response\Feed;


/**
 * @OA\Schema(
 *     title="Feed success response",
 *     description="Feed success response",
 *     type="object",
 * )
 */

class FeedResponse200Virtual
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
     *          description="Feed data",
     *          @OA\Property(property="id", type="integer", description="user id", example=5),
     *          @OA\Property(property="color", description="background color", type="string", example="red"),
     *          @OA\Property(property="creator_by", description="User email", type="int", example=1),
     *          @OA\Property(property="body", description="user bio", type="string", example="Hi.."),
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
