<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

interface IReadOnlyRepository
{
    /**
    * @return Collection
    */
    public function fetchAll();

    /**
    * @param $id
    * @return Model
    */
    public function findById(int $id): ?Model;
}