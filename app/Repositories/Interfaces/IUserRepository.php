<?php

namespace App\Repositories\Interfaces;

use App\Entities\RoleEntity;
use App\Entities\UserEntity;

interface IUserRepository
{
    public function create(UserEntity $userEntity, RoleEntity $roleEntity) : UserEntity;
    public function findByEmail(string $email): ?UserEntity;
}
