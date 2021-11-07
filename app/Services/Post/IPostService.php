<?php
namespace App\Services\Post;

interface IPostService 
{
    public function createPost($data);

    public function getAllPost();

    public function updatePostById(array $data, int $id);

    public function getPostById(int $id);

    public function deletePostById(int $id);
}