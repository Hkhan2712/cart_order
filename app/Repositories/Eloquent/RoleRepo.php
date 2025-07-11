<?php 
namespace App\Repositories\Eloquent;

use App\Models\Role;
use App\Repositories\Interfaces\RoleRepoInterface;

class RoleRepo extends BaseRepo implements RoleRepoInterface 
{
    public function __construct(Role $model) 
    {
        parent::__construct($model);
    }
}