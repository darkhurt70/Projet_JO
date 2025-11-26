<?php

namespace Models;

class Element
{
    // Identifiant unique de l'élément (géré par la base de données)
    private int $id;
    // Nom de l’élément (ex : Pyro, Hydro...)
    private string $name;

    // URL vers l’icône ou l’image de l’élément
    private string $urlImg;

    /**
     * Constructeur optionnel pour initialiser nom et image
     *
     * @param string $name   Nom de l’élément
     * @param string $urlImg URL de l’image de l’élément
     */
    public function __construct(string $name = "", string $urlImg = "")
    {
        $this->name = $name;
        $this->urlImg = $urlImg;
    }

    // --- Getters / Setters ---
    public function getId(): int { return $this->id; }
    public function setId(int $id): void { $this->id = $id; }

    public function getName(): string { return $this->name; }
    public function setName(string $name): void { $this->name = $name; }

    public function getUrlImg(): string { return $this->urlImg; }
    public function setUrlImg(string $urlImg): void { $this->urlImg = $urlImg; }
}