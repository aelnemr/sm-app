<?php

namespace App\Services\Post;

use App\Repository\Post\IPostRepository;
use Illuminate\Support\Facades\Cache;

class FeedService
{
    /**
     * @var IPostRepository
     */
    private $postRepository;

    public function __construct(IPostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }


    public function getMyFeed()
    {
        //latest
        return $this->postRepository->latest()->paginate(
            request()->query->get('limit', 25)
        );
    }
}
