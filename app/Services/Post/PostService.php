<?php
namespace App\Services\Post;

use App\Repositories\Eloquent\Post\PostRepositoryInterface;
use App\Services\Post\IPostService;
use App\Traits\ImageTrait;

class PostService implements IPostService
{
    use ImageTrait;

    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function createPost($data)
    {
        $data = $this->imageUploadS3($data, 'post_image/');
        return $this->postRepository->create($data);
    }

    public function getAllPost()
    {
        return $this->postRepository->fetchAll();
    }

    public function updatePostById(array $data, int $id)
    {
        if (array_key_exists('image', $data)) {
            $data = $this->imageUploadS3($data, 'post_image/');
        }
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