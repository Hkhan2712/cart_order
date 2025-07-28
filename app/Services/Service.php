<?php
namespace App\Services;

use App\Repositories\BaseRepo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class Service
{
    public function __construct(protected BaseRepo $repo) {}

    public function all(): Collection
    {
        return $this->repo->all();
    }

    public function find($id): ?Model
    {
        return $this->repo->find($id);
    }

    public function create($data): Model
    {
        return $this->repo->create($data);
    }

    public function update($id, $data): ?Model
    {
        return $this->repo->update($id, $data);
    }

    public function delete($id): int
    {
        return $this->repo->delete($id);
    }
}
