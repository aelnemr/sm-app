<?php

namespace App\Http\Controllers\API\V1\Post;

use App\Http\Controllers\API\V1\APIV1Controller;
use App\Http\Resources\FeedResource;
use App\Repository\Post\IPostRepository;

class FeedController extends APIV1Controller
{
    /**
     * @var IPostRepository
     */
    private $postRepository;

    public function __construct(IPostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function feed()
    {
        $posts = $this->postRepository->paginate(
            request()->query->get('limit', 100)
        );



        return $this->okWithPagination(
            FeedResource::collection($posts)
        );
    }
}
