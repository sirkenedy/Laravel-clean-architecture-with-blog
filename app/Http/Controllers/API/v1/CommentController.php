<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\API\BaseController;
use App\Services\Comment\ICommentService;
use App\Http\Resources\Comment\CommentCollection;
use App\Http\Resources\Comment\Comment as CommentResource;
use Illuminate\Http\Response;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CommentController extends BaseController
{
    private $comment;

    public function __construct(ICommentService $comment)
    {
        $this->middleware('auth:sanctum', ['except' => ['index']]);
        $this->comment = $comment;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $postId): JsonResponse
    {
        return $this->handleResponse(new CommentCollection($this->comment->getPostComment($postId)), "", Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, int $postId)
    {
        return $this->handleResponse(new CommentResource($this->comment->createPostComment($request->all(), $postId)), "Comment saved successfully", Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $commentId)
    {
        return $this->handleResponse(new CommentResource($this->comment->updateCommentById($request->all(), $commentId)), "Comment updated successfully", Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $commentId)
    {
        $this->comment->deleteCommentById($commentId);
        return $this->handleResponse([], "Comment deleted successfully", Response::HTTP_OK);
    }
}
