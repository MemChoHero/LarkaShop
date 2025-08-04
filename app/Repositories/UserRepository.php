<?php

namespace App\Repositories;

use App\Entities\RoleEntity;
use App\Entities\UserEntity;
use App\Models\Role;
use App\Models\User;
use App\Repositories\Interfaces\IUserRepository;

class UserRepository implements IUserRepository
{
    public function create(UserEntity $userEntity, RoleEntity $roleEntity): UserEntity
    {
        $user = User::create([
           'email' => $userEntity->getEmail(),
           'password' => $userEntity->getPassword()
        ]);

        $role = Role::createOrFirst([
            'name' => $roleEntity->getName(),
        ]);

        $user->roles()->attach($role->id);

        return UserEntity::fromModel($user);
    }

    public function findByEmail(string $email): ?UserEntity
    {
        $user = User::where('email', $email)->first();

        return $user ? UserEntity::fromModel($user) : null;
    }
}
