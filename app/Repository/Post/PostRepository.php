<?php

namespace App\Repository\Post;

use App\Models\Post;
use App\Repository\BaseRepository;

class PostRepository extends BaseRepository implements IPostRepository
{
    /**
     * @var Post
     */
    protected static $model;

    public function __construct(Post $post)
    {
        self::$model = $post;
    }

    public function paginate(?int $perPage = null, array $columns = ['*'], string $pageName = 'page', ?int $page = null): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return self::$model->with(['creator', 'creator.profile'])->paginate(
            $perPage,
            $columns,
            $pageName,
            $page
        );
    }
}
