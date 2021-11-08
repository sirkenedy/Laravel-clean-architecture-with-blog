<?php

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\IWriteModifyRepository;

class WriteModifyRepository implements IWriteModifyRepository
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
    public function __construct(Model $model)     
    {         
        $this->model = $model;
    }

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function updateById(array $attributes, string $id): Model
    {
        return tap($this->model->findOrFail($id))->update($attributes);
    }

    public function delete(int $id) : bool
    {
        return $this->model->destroy($id);
    }
}