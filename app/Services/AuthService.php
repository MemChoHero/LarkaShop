<?php

namespace App\Services;

use App\Entities\UserEntity;
use App\Exceptions\InvalidCredentialsException;
use App\Repositories\Interfaces\IUserRepository;
use Illuminate\Support\Facades\Hash;

readonly class AuthService
{
    public function __construct(private readonly IUserRepository $userRepository)
    {

    }

    public function register(UserEntity $userEntity): UserEntity
    {
        return $this->userRepository->create($userEntity);
    }

    /**
     * @throws InvalidCredentialsException
     */
    public function login(UserEntity $userEntity): UserEntity
    {
        $user = $this->userRepository->findByEmail($userEntity->getEmail());
        if (!$user) {
            throw new InvalidCredentialsException();
        }

        if(!Hash::check($userEntity->getPassword(), $user->getPassword())) {
            throw new InvalidCredentialsException();
        }

        return $user;
    }
}
