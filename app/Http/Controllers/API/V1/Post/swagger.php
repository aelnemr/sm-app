<?php
/**
 * @Feed
 *
 * @OA\Get(
 *     path="/1.0/feed",
 *     description="User Feed",
 *     tags={"Feed"},
 *     security={
 *          {"passport": {}},
 *      },
 *     @OA\Response(
 *          response=200,
 *          description="User feed",
 *          @OA\JsonContent(ref="#/components/schemas/FeedResponse200Virtual")
 *      ),
 *     @OA\Response(
 *          response=401,
 *          description="token required",
 *          @OA\JsonContent(ref="#/components/schemas/Response401Virtual")
 *      )
 * )
 */
