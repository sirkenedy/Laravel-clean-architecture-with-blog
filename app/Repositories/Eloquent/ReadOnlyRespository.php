<?php

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\IReadOnlyRespository;

class ReadOnlyRespository implements IReadOnlyRepository
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
    public function findById($id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    /**
    * @return Collection
    */
    public function fetchAll(): Collection
    {
        return $this->model->all();
    }
}