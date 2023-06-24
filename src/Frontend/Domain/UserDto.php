<?php

namespace App\Src\Frontend\Domain;

class UserDto
{
    public function __construct(private string $password, private string $email, private ?string $username = null, private string $type = UserType::TEACHER)
    {
    }

    public function getUsername() : string|null
    {
        return $this->username;
    }

    public function setUsername(?string $username = null): static
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword() :string
    {
        return $this->password;
    }

    public function setPassword($password) : static
    {
        $this->password = $password;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }

    public function getType() : string
    {
        $this->type;
    }

    public function setType(string $type = UserType::TEACHER): static
    {
        $this->type = $type;
        return $this;
    }
}
