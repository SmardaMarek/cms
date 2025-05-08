<?php
namespace App\Repositories;
use App\Models\NewsImage;
use \Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
interface NewsImageRepositoryInterface
{
    public function delete(int $id): bool;

    public function find(int $id): ?NewsImage;
}