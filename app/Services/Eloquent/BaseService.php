<?php 
namespace App\Services\Eloquent;

use App\Repositories\Interfaces\Repository;
use App\Services\Interfaces\ServiceInterface;

abstract class BaseService implements ServiceInterface 
{
    protected Repository $repo;

    public function __construct(Repository $repo) 
    {
        $this->repo = $repo;
    }

    public function all()               { return $this->repo->all(); }
    public function find($id)           { return $this->repo->find($id); }
    public function create($datas)      { return $this->repo->create($datas); }
    public function update($id, $datas) { return $this->repo->update($id, $datas); }
    public function delete($id)         { return $this->repo->delete($id); }
}