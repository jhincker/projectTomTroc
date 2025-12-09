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
        $books = $bookManager->getAllBooks();
        $view = new View("Accueil");
        $view->render("home", ['books' => $books]);
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

        // On récupère les données du formulaire.
        $id = (int)Utils::request("id", -1);
        $title = Utils::request("title");
        $author = Utils::request("author");
        $content = Utils::request("content");
        $availability = Utils::request("availability");
        $file = $_FILES['image'];

        // On vérifie que les données sont valides.
        if (empty($title) || empty($author) || empty($content) || empty($availability)) {
            throw new Exception("Tous les champs sont obligatoires.");
        }
        // Récupère le contenu du fichier
        $picture = file_get_contents($file['tmp_name']);

        // On crée l'objet Book.
        $book = new Book([
            'id' => $id, // Si l'id vaut -1, l'book sera ajouté. Sinon, il sera modifié.
            'title' => $title,
            'author' => $author,
            'content' => $content,
            'availability' => $availability,
            'picture' => $picture,
            'id_user' => $_SESSION['idUser']
        ]);



        // On ajoute l'book.
        $bookManager = new BookManager();
        $bookManager->addOrUpdateBook($book);

        // On redirige vers la page myAccount.
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
