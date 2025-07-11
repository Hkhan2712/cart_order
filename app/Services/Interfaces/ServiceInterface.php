<?php 
namespace App\Services\Interfaces;

interface ServiceInterface 
{
    public function all();
    public function find($id);
    public function create($datas);
    public function update($id, $datas);
    public function delete($id);
}