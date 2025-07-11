<?php 
namespace App\Repositories\Interfaces;

interface Repository {
    public function all();
    public function find($id);
    public function create($datas);
    public function update($id, $datas);
    public function delete($id);
}