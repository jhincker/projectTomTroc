<?php

/**
 * Contrôleur de la partie user.
 */

class UserController
{

    /**
     * Vérifie que l'utilisateur est connecté.
     * @return void
     */
    public function checkIfUserIsConnected(): void
    {
        // On vérifie que l'utilisateur est connecté.
        if (!isset($_SESSION['user'])) {
            Utils::redirect("connectionForm");
        }
    }

    /**
     * Affichage du formulaire de connexion.
     * @return void
     */
    public function displayConnectionForm(): void
    {
        $view = new View("Connexion");
        $view->render("connectionForm");
    }

    /**
     * Affichage du formulaire d'inscription.
     * @return void
     */
    public function displaySignUpForm(): void
    {
        $view = new View("Inscription");
        $view->render("signUpForm");
    }

    /**
     * Connexion de l'utilisateur.
     * @return void
     */
    public function connectUser(): void
    {
        // On récupère les données du formulaire.
        $email = Utils::request("email");
        $password = Utils::request("password");

        // On vérifie que les données sont valides.
        if (empty($email) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires. 1");
        }

        // On vérifie que l'utilisateur existe.
        $userManager = new UserManager();
        $user = $userManager->getUserByEmail($email);
        if (!$user) {
            throw new Exception("L'utilisateur demandé n'existe pas.");
        }

        // On vérifie que le mot de passe est correct.
        if (!password_verify($password, $user->getPassword())) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            throw new Exception("Le mot de passe est incorrect : $hash");
        }

        // On connecte l'utilisateur.
        $_SESSION['user'] = $user;
        $_SESSION['idUser'] = $user->getId();

        // On redirige vers la page d'useristration.
        Utils::redirect("home");
    }

    /**
     * Inscription de l'utilisateur.
     * @return void
     */
    public function signUpUser(): void
    {
        // On récupère les données du formulaire.
        $username = Utils::request("username");
        $email = Utils::request("email");
        $password = Utils::request("password");

        // Validation simple
        if (empty($email) || empty($password) || empty($username) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Utils::redirect("signUpForm"); // ou afficher une erreur
            return;
        }

        // Hasher le mot de passe
        $hashed = password_hash($password, PASSWORD_DEFAULT);


        // On créé l'utilisateur.
        $userManager = new UserManager();
        $user = new User([
            'username' => $username,
            'email' => $email,
            'password' => $hashed
        ]);
        $userManager->addUser($user);
        $_SESSION['user'] = $user;
        $_SESSION['idUser'] = $user->getId();

        // On redirige vers la page d'useristration.
        Utils::redirect("home");
    }

    /**
     * Affiche la page mon compte.
     * @return void
     */
    public function displayMyAccount(): void
    {
        // Récupération de l'id depuis la session du user.
        $idUser = $_SESSION['idUser'];

        // s'assurer que l'utilisateur est connecté
        $this->checkIfUserIsConnected();

        $bookManager = new BookManager();
        $books = $bookManager->getAllBooksByUserId($idUser);

        if (!$books) {
            throw new Exception("Le livre demandé n'existe pas.");
        }

        $userManager = new UserManager();
        $user = $userManager->getUserById($idUser);
        // RÉCUPERER LA DATE ET LA CHANGER EN ANNÉE
        $creationDate = $user->getCreationDate();
        $year = $creationDate->diff(new DateTime)->y;
        // COMPTER LES LIVRES
        $bookCount = $bookManager->countBooksByUser($user->getId());
        //RÉCUPERER LA PHOTO D'IDENTITÉ
        $userPicture = null;

        if (!empty($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['image'];
            $userPicture = file_get_contents($file['tmp_name']);
        }

        $view = new View("Mon compte");
        $view->render("myAccount", [
            'books' => $books,
            'user' => $user,
            'year' => $year,
            'bookCount' => $bookCount,
            'userPicture' => $userPicture,
        ]);
    }

    /**
     * Déconnexion de l'utilisateur.
     * @return void
     */
    public function disconnectUser(): void
    {
        // On déconnecte l'utilisateur.
        unset($_SESSION['user']);

        // On redirige vers la page d'accueil.
        Utils::redirect("home");
    }



    /**
     * Affiche le formulaire d'ajout d'un user.
     * @return void
     */
    public function addUser(): void
    {
        $view = new View("Inscription");
        $view->render("signUpForm");
    }

    /**
     * Suppression d'un useraire.
     * @return void
     */
    public function deleteUser(): void
    {
        $this->checkIfUserIsConnected();

        $id = Utils::request("id", -1);

        // On supprime le useraire.
        $userManager = new UserManager();
        $userManager->deleteUser($id);

        // On redirige vers la page d'useristration.
        Utils::redirect("user");
    }
}
