<?php

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\IReadOnlyRepository;
use App\Repositories\IWriteModifyRepository;
use Illuminate\Support\Collection;

class ReadWriteModifyRepository implements IReadOnlyRepository, IWriteModifyRepository
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
 
    /**
    * @param $id
    * @return Model
    */
    public function findById(int $id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    /**
    * @return Collection
    */
    public function fetchAll() 
    {
        return $this->model->all();
    }

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function updateById(array $attributes, int $id): Model
    {
        return tap($this->model->findOrFail($id))->update($attributes);
    }

    public function delete(int $id) : bool
    {
        return $this->model->findOrFail($id)->destroy($id);
    }
}