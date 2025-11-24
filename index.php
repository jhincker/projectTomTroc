<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config/config.php';
require_once 'config/autoload.php';
require_once __DIR__ . '/models/DBManager.php';

$dbManager = DBManager::getInstance();
$pdo = $dbManager->getPDO();

// On récupère l'action demandée par l'utilisateur.
// Si aucune action n'est demandée, on affiche la page d'accueil.
$action = Utils::request('action', 'home');

// Try catch global pour gérer les erreurs
try {
    // Pour chaque action, on appelle le bon contrôleur et la bonne méthode.
    switch ($action) {
        // Pages accessibles à tous.
        case 'home':
            $bookController = new BookController();
            $bookController->showHome();
            break;

        case 'showBook':
            $bookController = new BookController();
            $bookController->showBook();
            break;

        case 'addBook':
            $bookController = new BookController();
            $bookController->addBook();
            break;

        case 'showUpdateBookForm':
            $bookController = new BookController();
            $bookController->showUpdateBookForm();
            break;

        case 'updateBook':
            $bookController = new BookController();
            $bookController->updateBook();
            break;

        case 'deleteBook':
            $bookController = new BookController();
            $bookController->deleteBook();
            break;


        // Section connexion

        case 'connectionForm':
            $userController = new UserController();
            $userController->displayConnectionForm();
            break;

        case 'signUpForm':
            $userController = new UserController();
            $userController->displaySignUpForm();
            break;

        case 'signUpUser':
            $userController = new UserController();
            $userController->signUpUser();
            break;

        case 'connectUser':
            $userController = new UserController();
            $userController->connectUser();
            break;

        case 'disconnectUser':
            $userController = new UserController();
            $userController->disconnectUser();
            break;

        case 'deleteUser':
            $userController = new UserController();
            $userController->deleteUser();
            break;

        default:
            throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    // En cas d'erreur, on affiche la page d'erreur.
    $errorView = new View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
}
