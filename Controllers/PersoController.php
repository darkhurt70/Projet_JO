<?php

namespace Controllers;

use Models\Personnage;
use League\Plates\Engine;
use Helpers\Message;
use Helpers\Logger;

/**
 * Contrôleur responsable de la gestion des personnages :
 * affichage des formulaires, création, modification, suppression.
 */
class PersoController
{
    private Engine $templates;

    public function __construct()
    {
        $this->templates = new Engine(__DIR__ . '/../Views');
    }

    /**
     * Affiche le formulaire d'ajout de personnage.
     * Charge également la liste des éléments, origines et classes.
     */
    public function displayAddPerso(?string $message = null): void
    {
        $elementDAO = new \Models\ElementDAO();
        $originDAO = new \Models\OriginDAO();
        $unitclassDAO = new \Models\UnitClassDAO();

        echo $this->templates->render('add-perso', [
            'message' => $message,
            'gameName' => 'Ajouter un personnage',
            'listElements' => $elementDAO->getAll(),
            'listOrigins' => $originDAO->getAll(),
            'listUnitClasses' => $unitclassDAO->getAll()
        ]);
    }



    /**
     * Supprime un personnage à partir de son identifiant.
     * Affiche un message de retour selon le succès de l’opération.
     */
    public function deletePerso(string $id): void
    {
        $dao = new \Models\PersonnageDAO();
        $success = $dao->deletePerso($id);

        if ($success) {
            Logger::log('DELETE', 'Personnage', "Suppression du personnage avec l'ID : $id");
            $message = new Message("Personnage supprimé avec succès ", Message::COLOR_SUCCESS, "Succès");
        } else {
            Logger::log('DELETE', 'Personnage', "Échec de la suppression : ID $id introuvable");
            $message = new Message("Aucun personnage trouvé avec cet ID.", Message::COLOR_ERROR, "Erreur");
        }

        echo $this->templates->render('home', [
            'listPersonnage' => $dao->getAll(),
            'message' => $message,
            'gameName' => 'Genshin Impact'
        ]);
    }

    /**
     * Redirige vers le formulaire d’édition d’un personnage via son ID.
     */
    public function redirectToEdit(string $id): void
    {
        header("Location: index.php?action=add-perso&id=" . urlencode($id));
        exit;
    }

    /**
     * Traite la soumission du formulaire d’ajout de personnage.
     * Instancie un objet Personnage, le remplit et le sauvegarde via le DAO.
     */
    public function addPerso(array $data): void
    {
        try {
            $id = uniqid(); // Génère un ID unique

            // Récupération des entités liées
            $element = (new \Models\ElementDAO())->getByID($data['element']);
            $origin = (new \Models\OriginDAO())->getByID($data['origin']);
            $unit = (new \Models\UnitClassDAO())->getByID($data['unitclass']);

            // Création de l’objet Personnage
            $personnage = new Personnage();
            $personnage->setId($id);
            $personnage->setName($data['name']);
            $personnage->setElement($element);
            $personnage->setOrigin($origin);
            $personnage->setUnitclass($unit);
            $personnage->setRarity((int)$data['rarity']);
            $personnage->setUrlImg($data['url_img']);

            // Sauvegarde
            $dao = new \Models\PersonnageDAO();
            $dao->createPersonnage($personnage);
            Logger::log('CREATE', 'Personnage', "Ajout du personnage '{$personnage->getName()}' (ID: $id)");

            // Affichage avec message de succès
            $message = new Message("Personnage ajouté avec succès ✅", Message::COLOR_SUCCESS, "Succès");
            echo $this->templates->render('home', [
                'message' => $message,
                'listPersonnage' => $dao->getAll(),
                'gameName' => 'Genshin Impact'
            ]);

        } catch (\Exception $e) {
            // En cas d’erreur : on affiche de nouveau le formulaire avec le message
            $message = new Message($e->getMessage(), Message::COLOR_ERROR, "Erreur");
            echo $this->templates->render('add-perso', [
                'message' => $message,
                'gameName' => 'Genshin Impact'
            ]);
        }
    }

    /**
     * Supprime un personnage et recharge la page d'accueil avec message.
     * Si aucun ID n'est fourni, affiche un message d’erreur.
     */
    public function deletePersoAndIndex(?string $id = null): void
    {
        $dao = new \Models\PersonnageDAO();

        if ($id !== null) {
            $success = $dao->deletePerso($id);
            if ($success) {
                Logger::log('DELETE', 'Personnage', "Suppression du personnage avec l'ID : $id");
                $message = new Message("Personnage supprimé avec succès ✅", Message::COLOR_SUCCESS, "Succès");
            } else {
                Logger::log('DELETE', 'Personnage', "Échec de la suppression : ID $id introuvable");
                $message = new Message("Aucun personnage trouvé avec cet ID.", Message::COLOR_ERROR, "Erreur");
            }
        } else {
            Logger::log('DELETE', 'Personnage', "Tentative de suppression échouée : aucun ID fourni");
            $message = new Message("Aucun identifiant fourni.", Message::COLOR_ERROR, "Erreur");
        }

        echo $this->templates->render('home', [
            'message' => $message,
            'listPersonnage' => $dao->getAll(),
            'gameName' => 'Genshin Impact'
        ]);
    }

    /**
     * Affiche le formulaire de modification d’un personnage, si un ID est fourni.
     */
    public function displayEditPerso(?string $id = null, ?string $message = null): void
    {
        $dao = new \Models\PersonnageDAO();
        $perso = $id ? $dao->getByID($id) : null;

        $elementDAO = new \Models\ElementDAO();
        $originDAO = new \Models\OriginDAO();
        $unitclassDAO = new \Models\UnitClassDAO();

        echo $this->templates->render('edit-perso', [
            'message' => $message,
            'perso' => $perso,
            'gameName' => 'Genshin Impact',
            'listElements' => $elementDAO->getAll(),
            'listOrigins' => $originDAO->getAll(),
            'listUnitClasses' => $unitclassDAO->getAll()
        ]);
    }

    /**
     * Met à jour un personnage existant avec les données du formulaire.
     */
    public function editPersoAndIndex(array $data): void
    {
        $dao = new \Models\PersonnageDAO();

        // Récupération des entités associées
        $element = (new \Models\ElementDAO())->getByID($data['element']);
        $origin = (new \Models\OriginDAO())->getByID($data['origin']);
        $unit = (new \Models\UnitClassDAO())->getByID($data['unitclass']);

        // Création d’un objet Personnage avec les nouvelles données
        $personnage = new Personnage();
        $personnage->setId($data['id']);
        $personnage->setName($data['name']);
        $personnage->setElement($element);
        $personnage->setUnitclass($unit);
        $personnage->setRarity((int)$data['rarity']);
        $personnage->setOrigin($origin);
        $personnage->setUrlImg($data['url_img']);

        // Sauvegarde
        $dao->updatePersonnage($personnage);
        Logger::log('UPDATE', 'Personnage', "Modification du personnage '{$personnage->getName()}' (ID: {$personnage->getId()})");

        // Affichage
        $message = new Message("Personnage modifié avec succès ✅", Message::COLOR_SUCCESS, "Succès");
        echo $this->templates->render('home', [
            'listPersonnage' => $dao->getAll(),
            'gameName' => 'Genshin Impact',
            'message' => $message
        ]);
    }
}

