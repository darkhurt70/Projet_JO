<?php

namespace Helpers;

class Message
{
    // Définition des constantes pour les types/couleurs de message
    public const COLOR_SUCCESS = "success"; // Pour les succès (vert)
    public const COLOR_ERROR   = "error";   // Pour les erreurs (rouge)
    public const COLOR_INFO    = "info";    // Pour les infos neutres (=ris)

    // Propriétés du message
    private string $content; // Le contenu texte principal
    private string $color;   // Le type (success, error, info)
    private string $title;   // Le titre (optionnel)

    /**
     * Constructeur du message
     *
     * @param string $content Contenu du message
     * @param string $color   Type de message (utilise les constantes ci-dessus)
     * @param string $title   Titre facultatif
     */
    public function __construct(string $content, string $color = self::COLOR_INFO, string $title = "")
    {
        $this->content = $content;
        $this->color   = $color;
        $this->title   = $title;
    }

    // Getters pour accéder aux propriétés

    /**
     * Retourne le contenu du message
     */
    public function getContent(): string { return $this->content; }

    /**
     * Retourne la couleur (type) du message
     */
    public function getColor(): string { return $this->color; }

    /**
     * Retourne le titre du message
     */
    public function getTitle(): string { return $this->title; }
}
