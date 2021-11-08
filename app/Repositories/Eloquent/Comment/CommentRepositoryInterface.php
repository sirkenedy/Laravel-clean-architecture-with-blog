<?php

namespace App\Repositories\Eloquent\Comment;

interface CommentRepositoryInterface 
{
    public function fetchPostCommentsById(int $id);
}