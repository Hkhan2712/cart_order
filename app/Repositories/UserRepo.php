<?php 
namespace App\Repositories;

use App\Models\User;

class UserRepo extends BaseRepo {

    protected function model(): string { return User::class; }
}