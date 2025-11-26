<?php
namespace Services;

use Models\Element;

/**
 * Classe utilitaire pour manipuler les objets Element.
 */
class ElementService
{
    /**
     * Convertit un tableau de données (provenant de la BDD) en objet Element.
     *
     * @param array $data Données associatives (ex. : résultat de requête PDO)
     * @return Element Instance de l'objet Element hydraté
     */
    public static function hydrate(array $data): Element
    {
        // Création d'un nouvel élément
        $e = new Element();

        // Remplissage de l'objet avec les données issues de la BDD
        $e->setId($data['id']);
        $e->setName($data['name']);
        $e->setUrlImg($data['url_img']);

        return $e;
    }
}
