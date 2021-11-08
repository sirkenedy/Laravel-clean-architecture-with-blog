<?php

namespace App\Repositories\Eloquent\Comment;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Eloquent\Comment\CommentRepositoryInterface as ICommentRepository;
use App\Repositories\Eloquent\ReadWriteModifyRepository;
use App\Models\Comment;

class CommentRepository extends ReadWriteModifyRepository  implements ICommentRepository
{
    /**      
     * @var Model      
     */     
    protected $model;       

    /**      
     * PostRepository constructor.      
     *      
     * @param Model $model      
     */     
    public function __construct(Comment $model)     
    {         
        $this->model = $model;
    }

    public function fetchPostCommentsById(int $postId)
    {
        return $this->model->commentsWithPostId($postId)->get();
    }
}