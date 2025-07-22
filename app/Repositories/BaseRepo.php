<?php 
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepo {
    protected Model $model;

    public function __construct()
    {
        $this->model = app($this->model());
    }

    abstract protected function model(): string;
    
    public function all() { return $this->model->all(); }
    public function find($id) { return $this->model->find($id); }
    public function create($datas) { return $this->model->create($datas); }
    public function update($id, $datas) {
        return tap($this->find($id), fn($record) => $record?->update($datas));
    }
    public function delete($id) { return $this->model->destroy($id); }
}