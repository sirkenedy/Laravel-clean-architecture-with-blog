<?php
namespace App\Services\Comment;

interface ICommentService 
{
    public function createPostComment(array $data, int $postId);

    public function getPostComment($id);

    public function updateCommentById(array $data, int $id);

    public function deleteCommentById(int $id);
}