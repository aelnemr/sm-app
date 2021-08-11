<?php

namespace App\Http\Controllers\API\V1\Post;

use AElnemr\RestFullResponse\CoreJsonResponse;
use App\Http\Controllers\API\V1\APIV1Controller;
use App\Http\Resources\FeedResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PostController extends APIV1Controller
{
    use CoreJsonResponse;

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function store(Request $request)
    {
        $post = Post::query()->create($request->all());
        if ($request->input('media')) {
            Media::query()
                ->findMany($request->input('media'))
                ->each(function (Media $mediaFile) use ($post) {
                    $mediaFile->move($post, 'posting');
                    $mediaFile->model()->delete();
                });
        }

        return $this->accepted(
            (new FeedResource($post))->resolve()
        );
    }
}
