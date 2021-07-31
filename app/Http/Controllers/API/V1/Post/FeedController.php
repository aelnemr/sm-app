<?php

namespace App\Http\Controllers\API\V1\Post;

use App\Http\Controllers\API\V1\APIV1Controller;
use App\Http\Resources\FeedResource;
use App\Models\Post;

class FeedController extends APIV1Controller
{
    public function feed()
    {
        $posts = Post::query()->with(['creator', 'creator.profile'])
            ->paginate(request()->query->get('limit', 100));

        return $this->okWithPagination(
            FeedResource::collection($posts)
        );
    }
}
