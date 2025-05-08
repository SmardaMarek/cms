<?php
namespace App\Services;

use Illuminate\Http\UploadedFile;
use App\Models\News;
use App\Repositories\NewsRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use \Illuminate\Database\Eloquent\Collection;

class NewsService
{
    public function __construct(protected NewsRepositoryInterface $newsRepositoryInterface)
    {

    }
    public function create(array $data, ?UploadedFile $mainImage, ?array $galleryImages): News
    {
        $new = $this->newsRepositoryInterface->create($data);

        if ($mainImage) {
            $path = $this->handleUploadedMainImage($mainImage, $new);
            $this->newsRepositoryInterface->update(['main_image' => $path], $new->id);
        }

        if (!empty($galleryImages)) {
            $paths = $this->handleUploadedImages($galleryImages, $new);
            $this->newsRepositoryInterface->createMultiple($new, $paths);
        }

        return $new;
    }
    public function update(array $data, int $id, ?UploadedFile $mainImage, ?array $galleryImages): bool
    {
        $new = $this->find($id);
        if ($mainImage) {
            $path = $this->handleUploadedMainImage($mainImage, $new);
            $this->newsRepositoryInterface->update(['main_image' => $path], $id);
        }

        if (!empty($galleryImages)) {
            $paths = $this->handleUploadedImages($galleryImages, $new);
            $this->newsRepositoryInterface->createMultiple($new, $paths);
        }
        return $this->newsRepositoryInterface->update($data, $id);
    }

    public function delete(int $id): bool
    {
        return $this->newsRepositoryInterface->delete($id);
    }

    public function all(): Collection
    {
        return $this->newsRepositoryInterface->all();
    }

    public function findLatest(): LengthAwarePaginator
    {
        return $this->newsRepositoryInterface->findLatest();
    }

    public function find(int $id): ?News
    {
        return $this->newsRepositoryInterface->find($id);
    }
    public function handleUploadedMainImage(?UploadedFile $image, $new): ?string
    {
        if ($image !== null) {
            return $image->store("aktuality/hlavni-obrazek/{$new->id}", 'public');
        }

        return null;
    }

    public function handleUploadedImages(?array $images, $new): ?array
    {
        $paths = [];
        if (is_array($images)) {
            foreach ($images as $image) {
                if ($image instanceof UploadedFile) {
                    $paths[] = $image->store("aktuality/galerie/{$new->id}", 'public');
                }
            }
            return $paths;
        }
        return $paths;
    }
}