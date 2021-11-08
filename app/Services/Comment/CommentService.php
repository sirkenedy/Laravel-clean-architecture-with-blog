<?php
namespace App\Services\Comment;

use App\Repositories\Eloquent\Comment\CommentRepositoryInterface;
use App\Services\Comment\ICommentService;

use App\Repositories\Eloquent\Post\PostRepositoryInterface;

class CommentService implements ICommentService{

    protected $commentRepository;
    protected $postRepository;

    public function __construct(
        CommentRepositoryInterface $commentRepository, 
        PostRepositoryInterface $postRepository
    )
    {
        $this->commentRepository = $commentRepository;
        $this->postRepository = $postRepository;
    }

    public function createPostComment($data, $postId)
    {
        $post = $this->postRepository->findById($postId);
        $data['post_id'] = $post->id;
        $data['user_id'] = auth('sanctum')->user()->id;
        return $this->commentRepository->create($data);
    }

    public function getPostComment($id)
    {
        return $this->commentRepository->fetchPostCommentsById($id);
    }

    public function updateCommentById(array $data, int $commentId)
    {
        return $this->commentRepository->updateById($data, $commentId);
    }

    public function deleteCommentById(int $commentId)
    {
        return $this->commentRepository->delete($commentId);
    }
}