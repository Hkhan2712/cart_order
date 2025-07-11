<?php 
namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Interfaces\UserRepoInterface;

class UserRepo extends BaseRepo implements UserRepoInterface {
    public function __construct(User $model) 
    {
        parent::__construct($model);
    }
}