<?php 
namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\Repository;

abstract class BaseRepository implements Repository {
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;        
    }
    
    public function all() { return $this->model->all(); }
    public function find($id) { return $this->model->find($id); }
    public function create($datas) { return $this->model->create($datas); }
    public function update($id, $datas) {
        return tap($this->find($id), fn($record) => $record?->update($datas));
    }
    public function delete($id) { return $this->model->destroy($id); }
}