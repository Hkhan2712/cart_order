<?php
namespace App\Services\Eloquent;

use App\Repositories\Interfaces\Repository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class Service implements \App\Services\Interfaces\ServiceInterface
{
    public function __construct(protected Repository $repo) {}

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
