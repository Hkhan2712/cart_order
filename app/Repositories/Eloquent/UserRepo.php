<?php 
namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Interfaces\UserRepoInterface;

class UserRepo extends BaseRepo implements UserRepoInterface {

    protected function model(): string { return User::class; }
}