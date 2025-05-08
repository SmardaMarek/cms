<?php
namespace App\Repositories;
use App\Models\News;
use \Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
interface NewsRepositoryInterface
{
    public function all(): Collection;

    public function findLatest(): LengthAwarePaginator;

    public function create(array $data): ?News;

    public function update(array $data, int $id): bool;

    public function delete(int $id): bool;

    public function find(int $id): ?News;
    public function createMultiple(News $news, array $paths): void;
}