<?php 
namespace App\Services\Interfaces;

interface CategoryServiceInterface extends ServiceInterface {
    public function findBySlug(string $slug);
}