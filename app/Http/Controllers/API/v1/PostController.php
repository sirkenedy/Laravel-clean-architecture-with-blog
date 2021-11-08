<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\API\BaseController;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\Post\IPostService;
use App\Http\Resources\Post\PostCollection;
use App\Http\Resources\Post\Post as PostResource;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class PostController extends BaseController
{
    private $post;

    public function __construct(IPostService $post)
    {
        $this->middleware('auth:sanctum', ['except' => ['index','show']]);
        $this->post = $post;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : JsonResponse
    {
        return $this->handleResponse(new PostCollection($this->post->getAllPost()), "", Response::HTTP_OK);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) : JsonResponse
    {
        return $this->handleResponse(new PostResource($this->post->createPost($request->validated())), "Post saved successfully", Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(int $post) : JsonResponse
    {
        return $this->handleResponse(new PostResource($this->post->getPostById($post)), "", Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $post) : JsonResponse
    {
        return $this->handleResponse(new PostResource($this->post->updatePostById($request->all(), $post)), "Post updated successfully", Response::HTTP_OK);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $post) : JsonResponse
    {
        $this->post->deletePostById($post);
        return $this->handleResponse([], "Post deleted successfully", Response::HTTP_OK);
        
    }
}
