<?php 
namespace App\Repositories\Interfaces;

interface CategoryRepoInterface extends Repository {
    public function findBySlug($slug);
    public function findById($id);
}