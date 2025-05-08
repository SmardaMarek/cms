<?php
namespace App\Services;

use App\Repositories\NewsImageRepositoryInterface;
use App\Models\NewsImage;
class NewsImageService
{
    public function __construct(protected NewsImageRepositoryInterface $newsImageRepositoryInterface)
    {

    }
    public function delete(int $id): bool
    {
        return $this->newsImageRepositoryInterface->delete($id);
    }
    public function find(int $id): ?NewsImage
    {
        return $this->newsImageRepositoryInterface->find($id);
    }
}