<?php

namespace App\Repositories\Interfaces;

use App\Entities\UserEntity;

interface IUserRepository
{
    public function create(UserEntity $userEntity) : UserEntity;
    public function findByEmail(string $email): ?UserEntity;
}
