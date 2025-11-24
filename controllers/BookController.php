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
        $users = $userManager->getUserById($book->getIdUser());

        $view = new View($book->getTitle());
        $view->render("bookDetails", ['book' => $book, 'user' => $users]);
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

        // On affiche la page de modification de l'book.
        $view = new View("Modifier les informations d'un livre");
        $view->render("bookDetails", [
            'book' => $book
        ]);
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
        $id = Utils::request("id", -1);
        $title = Utils::request("title");
        $content = Utils::request("content");

        // On vérifie que les données sont valides.
        if (empty($title) || empty($content)) {
            throw new Exception("Tous les champs sont obligatoires. 2");
        }

        // On crée l'objet Book.
        $book = new Book([
            'id' => $id, // Si l'id vaut -1, l'book sera ajouté. Sinon, il sera modifié.
            'title' => $title,
            'content' => $content,
            'id_user' => $_SESSION['idUser']
        ]);

        // On ajoute l'book.
        $bookManager = new BookManager();
        $bookManager->addOrUpdateBook($book);

        // On redirige vers la page user.
        Utils::redirect("user");
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
        Utils::redirect("user");
    }
}
