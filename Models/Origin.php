<?php

namespace Models;

class Origin
{
    // Identifiant unique de l'origine (généré par la base de données)
    private int $id;

    // Nom de l'origine (ex. Mondstadt, Liyue, Inazuma, etc.)
    private string $name;

    // URL vers une image représentant cette origine
    private string $urlImg;

    /**
     * Constructeur de l'objet Origin
     * @param string $name Le nom de l'origine (optionnel)
     * @param string $urlImg L'URL de l'image associée (optionnel)
     */
    public function __construct(string $name = "", string $urlImg = "")
    {
        $this->name = $name;
        $this->urlImg = $urlImg;
    }

    // --- GETTERS / SETTERS ---

    /**
     * Retourne l'ID de l'origine
     */
    public function getId(): int { return $this->id; }

    /**
     * Définit l'ID (souvent appelé depuis un DAO après récupération SQL)
     */
    public function setId(int $id): void { $this->id = $id; }

    /**
     * Retourne le nom de l'origine
     */
    public function getName(): string { return $this->name; }

    /**
     * Définit le nom de l'origine
     */
    public function setName(string $name): void { $this->name = $name; }

    /**
     * Retourne l'URL de l'image de l'origine
     */
    public function getUrlImg(): string { return $this->urlImg; }

    /**
     * Définit l'URL de l'image
     */
    public function setUrlImg(string $urlImg): void { $this->urlImg = $urlImg; }
}
