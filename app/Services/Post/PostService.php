<?php
namespace App\Services\Post;

use App\Repositories\Eloquent\Post\PostRepositoryInterface;
use App\Services\Post\IPostService;

class PostService implements IPostService{

    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function createPost($data)
    {
        return $this->postRepository->create($data);
    }

    public function getAllPost()
    {
        return $this->postRepository->fetchAll();
    }

    public function updatePostById(array $data, int $id)
    {
        return $this->postRepository->updateById($data, $id);
    }

    public function getPostById(int $id)
    {
        return $this->postRepository->findById($id);
    }

    public function deletePostById(int $id)
    {
        return $this->postRepository->delete($id);
    }
}