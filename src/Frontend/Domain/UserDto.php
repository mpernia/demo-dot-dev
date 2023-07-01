<?php

namespace App\Src\Frontend\Domain;

class UserDto
{
    public function __construct(
        private string $password,
        private string $email,
        private string $type = UserType::TEACHER,
        private ?string $name = null
    )
    {
    }

    public function getName() : string|null
    {
        return $this->name;
    }

    public function setName(?string $name = null): static
    {
        $this->name = $name;
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

    public function passwd() :string
    {
        return bcrypt($this->password);
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
        return $this->type;
    }

    public function setType(string $type = UserType::TEACHER): static
    {
        $this->type = $type;
        return $this;
    }
}
