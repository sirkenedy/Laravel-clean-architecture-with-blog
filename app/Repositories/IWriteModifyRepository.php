<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface IWriteModifyRepository
{
    /**
    * @param array $attributes
    * @return Model
    */
    public function create(array $attributes): Model;

    /**
    * @param array $attributes
    * @param $id
    * @return Model
    */
    public function updateById(array $attributes, int $id) : Model;

    /**
    * @return Bool
    * @param $id
    */
    public function delete(int $id):bool;
}