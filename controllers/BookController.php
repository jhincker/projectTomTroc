<?php

class BookController
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showHome(): void
    {
        $bookManager = new BookManager();
        $userManager = new UserManager();
        $users = $userManager->getAllUsers();
        $usernames = [];

        foreach ($users as $user) {
            $usernames[$user->getId()] = $user->getUsername();
        }

        $books = $bookManager->getAllBooks();
        $lastBooks = $bookManager->getFourLastBooks();

        $view = new View("Accueil");
        $view->render("home", [
            'books' => $books,
            'lastBooks' => $lastBooks,
            'usernames' => $usernames,
        ]);
    }

    /**
     * Affiche le détail d'un book.
     * @return void
     */
    public function showBook(): void
    {
        // Récupération de l'id de le livre demandé.
        $id = Utils::request("id", -1);

        $bookManager = new BookManager();
        $book = $bookManager->getBookById($id);

        if (!$book) {
            throw new Exception("Le livre demandé n'existe pas.");
        }

        $userManager = new UserManager();
        $user = $userManager->getUserById($book->getIdUser());

        $view = new View($book->getTitle());
        $view->render("bookDetails", ['book' => $book, 'user' => $user]);
    }

    /**
     * Affiche le formulaire d'ajout d'un book.
     * @return void
     */
    public function addBook(): void
    {
        $view = new View("Ajouter un book");
        $view->render("addBook");
    }

    /**
     * Affichage du formulaire d'ajout d'un livre.
     * @return void
     */
    public function showUpdateBookForm(): void
    {
        $userController = new UserController();
        $userController->checkIfUserIsConnected();
        // On récupère l'id de du livre s'il existe.
        $id = Utils::request("id", -1);

        // On récupère le livre associé.
        $bookManager = new BookManager();
        $book = $bookManager->getBookById($id);

        // Si le livre n'existe pas, on en crée un vide. 
        if (!$book) {
            $book = new Book();
        }

        // On affiche la page de modification du livre.
        $view = new View("Ajouter ou modifier les informations du livre");
        $view->render("bookDetails", [
            'book' => $book
        ]);
    }

    /**
     * Affichage des infos d'un livre.
     * @return void
     */
    public function showBookInfo(): void
    {
        $userController = new UserController();
        $userController->checkIfUserIsConnected();
        // On récupère l'id du livre s'il existe.
        $id = Utils::request("id", -1);
        // Récupération de l'id depuis la session du user.
        $idUser = $_SESSION['idUser'];

        // On récupère le livre associé.
        $bookManager = new BookManager();
        $book = $bookManager->getBookById($id);

        $userManager = new UserManager();
        $user = $userManager->getUserById($book->getIdUser());

        //RÉCUPERER LA PHOTO D'IDENTITÉ
        $userPicture = null;

        $title = Utils::request("title");
        $author = Utils::request("author");
        $content = Utils::request("content");
        $username = Utils::request("username");


        // On affiche la page des détails du livre.
        $view = new View("Voir les informations d'un livre");
        $view->render("bookInfo", [
            'id' => $id,
            'book' => $book,
            'userPicture' => $userPicture,
            'user' => $user,
            'title' => $title,
            'author' => $author,
            'content' => $content,
            'id_user' => $idUser,
            'username' => $username,
        ]);
    }

    /**
     * Affichage de la vue Nos livres à l'échange.
     * @return void
     */
    public function showOurBooks(): void
    {
        // Récupération de l'id de le livre demandé.
        $title = Utils::request("title", '');

        $bookManager = new BookManager();
        $userManager = new UserManager();
        $users = $userManager->getAllUsers();
        $usernames = [];

        foreach ($users as $user) {
            $usernames[$user->getId()] = $user->getUsername();
        }

        if (empty($title)) {
            $books = $bookManager->getAllBooks();
        } else {
            $books = $bookManager->searchBooksByTitle($title);
        }

        $view = new View('ourBooks');
        $view->render("ourBooks", ['books' => $books, 'usernames' => $usernames]);
    }

    /**
     * Ajout et modification d'un book. 
     * On sait si un book est ajouté car l'id vaut -1.
     * @return void
     */
    public function updateBook(): void
    {
        $userController = new UserController();
        $userController->checkIfUserIsConnected();

        $id = (int)Utils::request("id", -1);
        $title = Utils::request("title");
        $author = Utils::request("author");
        $content = Utils::request("content");
        $availability = Utils::request("availability");
        $file = $_FILES['image'] ?? null;

        if (trim($title) === '' || trim($author) === '' || trim($content) === '' || !in_array($availability, ['0', '1', 0, 1], true)) {
            throw new Exception("Tous les champs sont obligatoires.");
        }

        $bookManager = new BookManager();
        $picturePath = null;

        // 1. Récupère le livre existant si update
        if ($id !== -1) {
            $book = $bookManager->getBookById($id);
            if (!$book) {
                throw new Exception("Livre introuvable.");
            }
            $picturePath = $book->getPicture(); // valeur actuelle
        }

        // 2. Gère l'upload si fichier fourni
        if ($file && $file['error'] === UPLOAD_ERR_OK && $file['size'] > 0) {
            $rootDir = __DIR__ . '/../..';
            $uploadDir = "/Website_TomTroc/images/books/";
            if (!is_dir($rootDir . $uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array($ext, $allowed)) {
                throw new Exception("Format image non autorisé.");
            }

            $tmpPath = $_FILES['image']['tmp_name'];
            $filename = uniqid('book_', true) . '.' . $ext;
            $targetPath = $uploadDir . $filename;

            if (!move_uploaded_file($tmpPath, $rootDir . $targetPath)) {
                throw new Exception("Erreur de téléchargement de l'image.");
            }

            $picturePath = $targetPath; // nouveau chemin

            // Supprimer l'ancienne image si existante
            if ($book && !empty($book->getPicture()) && file_exists($book->getPicture())) {
                unlink($book->getPicture());
            }
        }

        // 3. Crée l'objet Book avec le chemin
        $book = new Book([
            'id'          => $id,
            'title'       => $title,
            'author'      => $author,
            'content'     => $content,
            'availability' => $availability,
            'picture'     => $picturePath,
            'id_user'     => $_SESSION['idUser']
        ]);

        $bookManager->addOrUpdateBook($book);
        Utils::redirect("myAccount");
    }



    /**
     * Suppression d'un book.
     * @return void
     */
    public function deleteBook(): void
    {
        $userController = new UserController();
        $userController->checkIfUserIsConnected();

        $id = Utils::request("id", -1);

        // On supprime l'book.
        $bookManager = new BookManager();
        $bookManager->deleteBook($id);

        // On redirige vers la page d'useristration.
        Utils::redirect("myAccount");
    }
}
