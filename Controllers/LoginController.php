<?php

namespace Controllers;

use Models\UserDAO;
use Helpers\Message;
use League\Plates\Engine;

class LoginController
{
    private Engine $templates;

    public function __construct()
    {
        $this->templates = new Engine(__DIR__ . '/../Views');
    }

    public function showLoginForm(?Message $message = null): void
    {
        echo $this->templates->render('login', [
            'message' => $message
        ]);
    }

    public function handleLogin(array $data): void
    {
        $username = trim($data['username'] ?? '');
        $password = trim($data['password'] ?? '');

        $dao = new UserDAO();
        $user = $dao->getByUsername($username);

        if (!$user || !$user->verifyPassword($password)) {
            $msg = new Message("Nom d’utilisateur ou mot de passe invalide.", Message::COLOR_ERROR, "Erreur");
            $this->showLoginForm($msg);
            return;
        }

        // Connexion réussie
        $_SESSION['user'] = [
            'username' => $user->getUsername(),
            'role' => $user->getRole()
        ];

        $msg = new Message("Bienvenue, $username !", Message::COLOR_SUCCESS, "Connexion réussie");
        echo $this->templates->render('home', [
            'gameName' => 'Genshin Impact',
            'message' => $msg,
            'listPersonnage' => (new \Models\PersonnageDAO())->getAll()
        ]);
    }

    public function logout(): void
    {
        session_destroy();
        header('Location: index.php?action=login');
        exit;
    }


}
