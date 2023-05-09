<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $orderColumn = request('order_column', 'created_at');
        if (!in_array($orderColumn, ['id', 'title', 'created_at'])) {
            $orderColumn = 'created_at';
        }
        $orderDirection = request('order_direction', 'desc');
        if (!in_array($orderDirection, ['asc', 'desc'])) {
            $orderDirection = 'desc';
        }

        return PostResource::collection(Post::with('category')
            ->when(request('category'), function (Builder $query) {
                $query->where('category_id', request('category'));
            })
            ->orderBy($orderColumn, $orderDirection)
            ->paginate(10));
    }

    public function store(StorePostRequest $request)
    {
        $request->file('thumbnail')->getClientOriginalName();

        $post = Post::create($request->validated());

        return new PostResource($post);
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
