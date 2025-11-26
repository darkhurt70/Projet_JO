<?php
namespace Models;

/**
 * Classe représentant un personnage de Genshin Impact
 */
class Personnage
{
    // Attributs privés représentant les propriétés du personnage

    private string $id;              // Identifiant unique (ex: perso001)
    private string $name;            // Nom du personnage
    private Element $element;        // Élément du personnage (ex: Hydro, Pyro, etc.)
    private Origin $origin;          // Origine (ex: Mondstadt, Inazuma...)
    private UnitClass $unitclass;    // Classe (ex: épéiste, archer, etc.)
    private int $rarity;             // Rareté (nombre d’étoiles)
    private string $urlImg;          // URL de l’image d’illustration

    // ======== GETTERS ========

    /**
     * Retourne l'identifiant du personnage
     */
    public function getId(): ?string { return $this->id; }

    /**
     * Retourne le nom du personnage
     */
    public function getName(): string { return $this->name; }

    /**
     * Retourne l'élément du personnage
     */
    public function getElement(): Element { return $this->element; }

    /**
     * Retourne la classe du personnage
     */
    public function getUnitclass(): UnitClass { return $this->unitclass; }

    /**
     * Retourne la rareté du personnage (ex: 5 étoiles)
     */
    public function getRarity(): int { return $this->rarity; }

    /**
     * Retourne l'origine du personnage
     */
    public function getOrigin(): ?Origin { return $this->origin; }

    /**
     * Retourne l'URL de l'image du personnage
     */
    public function getUrlImg(): string { return $this->urlImg; }

    // ======== SETTERS ========

    /**
     * Définit l'identifiant du personnage
     */
    public function setId(string $id): void { $this->id = $id; }

    /**
     * Définit le nom du personnage
     */
    public function setName(string $name): void { $this->name = $name; }

    /**
     * Définit l'élément du personnage
     */
    public function setElement(Element $element): void { $this->element = $element; }

    /**
     * Définit la classe du personnage
     */
    public function setUnitclass(UnitClass $unitclass): void { $this->unitclass = $unitclass; }

    /**
     * Définit la rareté du personnage
     */
    public function setRarity(int $rarity): void { $this->rarity = $rarity; }

    /**
     * Définit l'origine du personnage
     */
    public function setOrigin(?Origin $origin): void { $this->origin = $origin; }

    /**
     * Définit l'URL de l'image
     */
    public function setUrlImg(string $urlImg): void { $this->urlImg = $urlImg; }
}

