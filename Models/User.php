<?php

namespace Models;

class User
{
    private string $id;
    private string $username;
    private string $hashPwd;

    public function __construct(string $id, string $username, string $hashPwd)
    {
        $this->id = $id;
        $this->username = $username;
        $this->hashPwd = $hashPwd;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getHashPwd(): string
    {
        return $this->hashPwd;
    }

    public function verifyPassword(string $plainText): bool
    {
        return password_verify($plainText, $this->password);
    }

}
