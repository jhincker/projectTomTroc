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
        $sql = "INSERT INTO user (username, email, password, creation_date) VALUES (:username, :email, :password, NOW())";
        $this->db->query($sql, [
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword()
        ]);
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
}
