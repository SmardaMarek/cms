<?php
namespace App\Repositories;

use App\Models\News;
use \Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

class NewsRepository implements NewsRepositoryInterface
{

    public function all(): Collection
    {
        return News::all();
    }

    public function findLatest(): LengthAwarePaginator
    {
        return News::latest()->paginate(10);
    }

    public function create(array $data): ?News
    {
        return News::create(Arr::except($data, ['gallery_images', 'main_image']));
    }

    public function update(array $data, int $id): bool
    {
        $new = $this->find($id);
        return $new->update($data);
    }

    public function delete(int $id): bool
    {
        $new = News::findOrFail($id);
        $new->deleteImages();
        return $new->delete();
    }

    public function find(int $id): ?News
    {
        return News::find($id);
    }

    public function createMultiple(News $new, array $paths): void
    {
        foreach ($paths as $path) {
            $new->images()->create(['path' => $path]);
        }
    }
}