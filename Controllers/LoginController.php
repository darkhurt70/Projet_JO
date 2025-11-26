<?php

namespace Controllers;

use Models\UserDAO;
use Helpers\Message;
use League\Plates\Engine;

/**
 * Contrôleur dédié à la gestion de l'authentification utilisateur.
 */
class LoginController
{
    private Engine $templates;

    /**
     * Initialise le moteur de templates Plates.
     */
    public function __construct()
    {
        $this->templates = new Engine(__DIR__ . '/../Views');
    }

    /**
     * Affiche le formulaire de connexion.
     *
     * @param Message|null $message Message d'erreur ou de succès à afficher (facultatif)
     */
    public function showLoginForm(?Message $message = null): void
    {
        echo $this->templates->render('login', [
            'message' => $message
        ]);
    }

    /**
     * Traite la tentative de connexion.
     *
     * @param array $data Données envoyées depuis le formulaire (username + password)
     */
    public function handleLogin(array $data): void
    {
        // Récupération et nettoyage des champs
        $username = trim($data['username'] ?? '');
        $password = trim($data['password'] ?? '');

        // Chargement de l'utilisateur depuis la BDD
        $dao = new UserDAO();
        $user = $dao->getByUsername($username);

        // Vérification de l'existence et du mot de passe
        if (!$user || !$user->verifyPassword($password)) {
            $msg = new Message("Nom d’utilisateur ou mot de passe invalide.", Message::COLOR_ERROR, "Erreur");
            $this->showLoginForm($msg);
            return;
        }

        // Authentification réussie, création de la session
        $_SESSION['user'] = [
            'username' => $user->getUsername(),
            'role' => $user->getRole()
        ];

        // Redirection vers la page d'accueil avec message de bienvenue
        $msg = new Message("Bienvenue, $username !", Message::COLOR_SUCCESS, "Connexion réussie");

        echo $this->templates->render('home', [
            'gameName' => 'Genshin Impact',
            'message' => $msg,
            'listPersonnage' => (new \Models\PersonnageDAO())->getAll()
        ]);
    }

    /**
     * Déconnecte l'utilisateur en détruisant la session.
     */
    public function logout(): void
    {
        session_destroy();
        header('Location: index.php?action=login');
        exit;
    }
}
