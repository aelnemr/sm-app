<?php

namespace App\Http\Controllers\API\V1\Post;

use App\Http\Controllers\API\V1\APIV1Controller;
use App\Http\Resources\FeedResource;
use App\Models\Post;
use App\Repository\Post\IPostRepository;
use App\Services\Post\FeedService;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\JsonResponse;

class FeedController extends APIV1Controller
{
    /**
     * @var FeedService
     */
    private $feedService;

    public function __construct(FeedService $feedService)
    {
        $this->feedService = $feedService;
    }

    /**
     * @return JsonResponse
     */
    public function feed(): JsonResponse
    {
        return $this->okWithPagination(
            FeedResource::collection($this->feedService->getMyFeed())
        );
    }
}
