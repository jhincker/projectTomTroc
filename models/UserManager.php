<?php

/** 
 * Classe UserManager pour gérer les requêtes liées aux users et à l'authentification.
 */

class UserManager extends AbstractEntityManager
{
    /**
     * Récupère un user par son username.
     * @param string $username
     * @return ?User
     */
    public function getUserByUsername(string $username): ?User
    {
        $sql = "SELECT * FROM user WHERE username = :username";
        $result = $this->db->query($sql, ['username' => $username]);
        $user = $result->fetch();
        if ($user) {
            return new User($user);
        }
        return null;
    }

    /**
     * Récupère un user par son id.
     * @param int $id : l'id du user.
     * @return User|null : un objet User ou null si le user n'existe pas.
     */
    public function getUserById(int $id): ?User
    {
        $sql = "SELECT * FROM user WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $user = $result->fetch();
        if ($user) {
            return new User($user);
        }
        return null;
    }

    /**
     * Récupère un user par son email.
     * @param string $email
     * @return ?User
     */
    public function getUserByEmail(string $email): ?User
    {
        $sql = "SELECT * FROM user WHERE email = :email";
        $result = $this->db->query($sql, ['email' => $email]);
        $user = $result->fetch();
        if ($user) {
            return new User($user);
        }
        return null;
    }

    /**
     * Ajoute un user.
     * @param User $user : le user à ajouter.
     * @return void
     */
    public function addUser(User $user): void
    {
        $sql = "INSERT INTO user (username, email, password, user_picture, creation_date) VALUES (:username, :email, :password, :user_picture, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'user_picture' => $user->getUserPicture(),
        ]);
        // Récupérer l'id généré par MySQL et l'affecter à l'objet User
        try {
            $lastId = (int)$this->db->getPDO()->lastInsertId();
            if ($lastId > 0) {
                $user->setId($lastId);
            }
        } catch (Exception $e) {
            // En cas d'échec, on ne bloque pas l'exécution ; l'id restera la valeur par défaut (-1)
        }
    }

    /**
     * Supprime un user.
     * @param int $id : l'id de le livre à supprimer.
     * @return void
     */
    public function deleteUser(int $id): void
    {
        $sql = "DELETE FROM user WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
    }

    /**
     * Récupère tous les livres.
     * @return array : un tableau d'objets Book.
     */
    public function getAllUsers(): array
    {
        $sql = "SELECT * FROM user";
        $result = $this->db->query($sql);
        $users = [];

        while ($user = $result->fetch()) {
            $users[] = new User($user);
        }
        return $users;
    }

    /**
     * Modifie un user.
     * @param User $user : le user à modifier.
     * @return void
     */
    public function updateUser(User $user): void
    {
        $sql = "UPDATE user SET email = :email, password = :password, username = :username, user_picture = :picture WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'username' => $user->getUsername(),
            'user_picture' => $user->getUserPicture()
        ]);
    }

    /**
     * Ajoute ou modifie un user.
     * On sait si le livre est un nouvel user car son id sera -1.
     * @param User $user : le user à ajouter ou modifier.
     * @return void
     */
    public function addOrUpdateUser(User $user): void
    {
        if ($user->getId() == -1) {
            $this->addUser($user);
        } else {
            $this->updateUser($user);
        }
    }
}
