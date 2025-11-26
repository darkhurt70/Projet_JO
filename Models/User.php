<?php
namespace Models;

/**
 * Classe représentant un utilisateur.
 * Contient les données essentielles : id, nom d'utilisateur, mot de passe hashé.
 */
class User
{
    private string $id;           // Identifiant unique (généré)
    private string $username;     // Nom d'utilisateur
    private string $hashPwd;      // Mot de passe hashé (Bcrypt)

    /**
     * Constructeur de l'utilisateur.
     *
     * @param string $id       Identifiant unique
     * @param string $username Nom d'utilisateur
     * @param string $hashPwd  Mot de passe hashé
     */
    public function __construct(string $id, string $username, string $hashPwd)
    {
        $this->id = $id;
        $this->username = $username;
        $this->hashPwd = $hashPwd;
    }

    // Getter pour l'ID
    public function getId(): string
    {
        return $this->id;
    }

    // Getter pour le nom d'utilisateur
    public function getUsername(): string
    {
        return $this->username;
    }

    // Getter pour le mot de passe hashé
    public function getHashPwd(): string
    {
        return $this->hashPwd;
    }

    /**
     * Vérifie si un mot de passe en clair correspond au mot de passe hashé.
     *
     * @param string $plainText Mot de passe en clair
     * @return bool True si le mot de passe est correct, false sinon
     */
    public function verifyPassword(string $plainText): bool
    {
        return password_verify($plainText, $this->hashPwd);
    }
}
