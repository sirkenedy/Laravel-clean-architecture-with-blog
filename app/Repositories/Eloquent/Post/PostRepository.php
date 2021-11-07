<?php

namespace App\Repositories\Eloquent\Post;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Eloquent\Post\PostRepositoryInterface as IPostRepository;
use App\Repositories\Eloquent\ReadWriteModifyRepository;
use App\Models\Post;

class PostRepository extends ReadWriteModifyRepository  implements IPostRepository
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
    public function __construct(Post $model)     
    {         
        $this->model = $model;
    }
}