<?php

namespace Models;

/**
 * Modèle représentant une classe/unité (par exemple : épéiste, archer, etc.)
 */
class UnitClass
{
    // Identifiant unique de la classe (clé primaire en base)
    private int $id;

    // Nom de la classe (ex. : "Épéiste", "Lancier")
    private string $name;

    // URL de l’image associée à cette classe
    private string $urlImg;

    /**
     * Constructeur optionnel permettant d’initialiser nom et image
     */
    public function __construct(string $name = "", string $urlImg = "")
    {
        $this->name = $name;
        $this->urlImg = $urlImg;
    }

    // -----------------------------
    // Getters et setters classiques
    // -----------------------------

    public function getId(): int { return $this->id; }

    public function setId(int $id): void { $this->id = $id; }

    public function getName(): string { return $this->name; }

    public function setName(string $name): void { $this->name = $name; }

    public function getUrlImg(): string { return $this->urlImg; }

    public function setUrlImg(string $urlImg): void { $this->urlImg = $urlImg; }
}
