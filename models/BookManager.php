<?php

/**
 * Classe qui gère les livres.
 */
class BookManager extends AbstractEntityManager
{
    /**
     * Récupère tous les livres.
     * @return array : un tableau d'objets Book.
     */
    public function getAllBooks(): array
    {
        $sql = "SELECT * FROM book";
        $result = $this->db->query($sql);
        $books = [];

        while ($book = $result->fetch()) {
            $books[] = new Book($book);
        }
        return $books;
    }

    public function getAllBooksOrdered(string $column, string $sort_order): array
    {
        $sql = "SELECT * FROM book order by " . $column . " " . $sort_order;
        $result = $this->db->query($sql);
        $books = [];

        while ($book = $result->fetch()) {
            $books[] = new Book($book);
        }
        return $books;
    }

    /**
     * Récupère un book par son id.
     * @param int $id : l'id de le livre.
     * @return Book|null : un objet Book ou null si le livre n'existe pas.
     */
    public function getBookById(int $id): ?Book
    {
        $sql = "SELECT * FROM book WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $book = $result->fetch();
        if ($book) {
            return new Book($book);
        }
        return null;
    }

    /**
     * Ajoute ou modifie un book.
     * On sait si le livre est un nouvel book car son id sera -1.
     * @param Book $book : le livre à ajouter ou modifier.
     * @return void
     */
    public function addOrUpdateBook(Book $book): void
    {
        if ($book->getId() == -1) {
            $this->addBook($book);
        } else {
            $this->updateBook($book);
        }
    }

    /**
     * Ajoute un book.
     * @param Book $book : le livre à ajouter.
     * @return void
     */
    public function addBook(Book $book): void
    {
        $sql = "INSERT INTO book (id_user, title, author, content, creation_date, date_update) VALUES (:id_user, :title, :author, :content, :creation_date, NOW())";
        $this->db->query($sql, [
            'id_user' => $book->getIdUser(),
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'content' => $book->getContent(),
            'availabilty' => $book->getAvailability(),
            'picture' => $book->getPicture(),
            'creation_date' => $book->getCreationDate()
        ]);
    }

    /**
     * Modifie un book.
     * @param Book $book : le livre à modifier.
     * @return void
     */
    public function updateBook(Book $book): void
    {
        $sql = "UPDATE book SET id_user = :id_user, title = :title, author = :author, content = :content, date_update = NOW() WHERE id = :id";
        $this->db->query($sql, [
            'id_user' => $book->getIdUser(),
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'content' => $book->getContent()
        ]);
    }

    /**
     * Supprime un book.
     * @param int $id : l'id de le livre à supprimer.
     * @return void
     */
    public function deleteBook(int $id): void
    {
        $sql = "DELETE FROM book WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
    }
}
