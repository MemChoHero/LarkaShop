<?php

namespace App\Entities;

use App\Enums\RoleEnum;

class RoleEntity implements \JsonSerializable
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public static function fromEnum(RoleEnum $enum): RoleEntity
    {
        return new RoleEntity($enum->value);
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
