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
            // Ne pas divulguer le hash dans les messages d'erreur
            throw new Exception("Le mot de passe est incorrect.");
        }

        // Si l'algorithme / le cost change, rehasher le mot de passe et mettre à jour la BDD
        $rehashOptions = ['cost' => 12];
        if (password_needs_rehash($user->getPassword(), PASSWORD_BCRYPT, $rehashOptions)) {
            $newHash = password_hash($password, PASSWORD_BCRYPT, $rehashOptions);
            $user->setPassword($newHash);
            // Met à jour l'utilisateur en base (addOrUpdateUser gère insert/update)
            $userManager->addOrUpdateUser($user);
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
        $hashed = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
        // B_Crypt

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
        // s'assurer que l'utilisateur est connecté
        $this->checkIfUserIsConnected();

        // Récupération de l'id depuis la session du user
        $idUser = $_SESSION['idUser'] ?? -1;

        $bookManager = new BookManager();

        $userManager = new UserManager();
        $profileUser = (isset($_GET['id']) ? (int)$_GET['id'] : 0);
        $isOwnProfile = ($profileUser == 0 || $profileUser == $idUser) ? true : false;

        if ($isOwnProfile) {
            $user = $userManager->getUserById($idUser);
        } else {
            $user = $userManager->getUserById($profileUser);
        }

        $books = $bookManager->getAllBooksByUserId($user->getId());

        // Si l'utilisateur n'existe pas, afficher une page d'erreur explicite
        if (!$user) {
            $view = new View("Erreur");
            $view->render('errorPage', ['errorMessage' => 'Utilisateur' . $idUser . 'introuvable.']);
            return;
        }

        // RÉCUPERER LA DATE ET LA CHANGER EN ANNÉE (protéger si null)
        $creationDate = $user->getCreationDate();
        if ($creationDate instanceof DateTime) {
            $year = $creationDate->diff(new DateTime())->y;
        } else {
            $year = 0;
        }
        // COMPTER LES LIVRES
        $bookCount = $bookManager->countBooksByUser($user->getId());
        //RÉCUPERER LA PHOTO D'IDENTITÉ
        $userPicture = null;
        // PROFIL PUBLIC/MON COMPTE



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
            'isOwnProfile' => $isOwnProfile,
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

    /**
     * Ajout et modification d'un user. 
     * On sait si un user est ajouté car l'id vaut -1.
     * @return void
     */
    public function updateUser(): void
    {
        $this->checkIfUserIsConnected();  // self call (au lieu de new)

        $id = (int)Utils::request("id", -1);
        $email = Utils::request("email");
        $password = Utils::request("password");
        $username = Utils::request("username");
        $file = $_FILES['image'] ?? null;

        if (empty($email) || empty($password) || empty($username)) {
            throw new Exception("Tous les champs sont obligatoires.");
        }

        $userManager = new UserManager();
        $picturePath = null;

        // 1. Récupère user existant si update (comme BookController)
        if ($id !== -1) {
            $existingUser = $userManager->getUserById($id);
            if (!$existingUser) {
                throw new Exception("Utilisateur introuvable.");
            }
            $picturePath = $existingUser->getUserPicture();
        }

        // 2. Upload si fichier (exactement comme BookController)
        if ($file && $file['error'] === UPLOAD_ERR_OK && $file['size'] > 0) {
            $rootDir = __DIR__ . '/../..';
            $uploadDir = "/Website_TomTroc/images/";
            if (!is_dir($rootDir . $uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array($ext, $allowed)) {
                throw new Exception("Format image non autorisé.");
            }

            $tmpPath = $file['tmp_name'];
            $filename = uniqid('user_', true) . '.' . $ext;
            $targetPath = $uploadDir . $filename;

            if (!move_uploaded_file($tmpPath, $rootDir . $targetPath)) {
                throw new Exception("Erreur de téléchargement de l'image.");
            }

            $picturePath = $targetPath;

            // Supprime ancienne
            if (isset($existingUser) && !empty($existingUser->getUserPicture()) && file_exists($existingUser->getUserPicture())) {
                unlink($existingUser->getUserPicture());
            }
        }

        // Hash password (conservé)
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

        $user = new User([
            'id'            => $id,
            'email'         => $email,
            'password'      => $hashedPassword,
            'username'      => $username,
            'user_picture'  => $picturePath,  // chemin string
        ]);

        $userManager->addOrUpdateUser($user);
        Utils::redirect("myAccount");
    }
}
