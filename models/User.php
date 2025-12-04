<?php

/**
 * Entité User : un user est défini par son id, un username et un password.
 */
class User extends AbstractEntity
{
    private string $username = "";
    private string $password = "";
    private string $email = "";
    private ?DateTime $creationDate = null;
    private string $userPicture = "";


    /**
     * Setter pour le username.
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * Getter pour le username.
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Setter pour le password.
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * Getter pour le password.
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Setter pour le email.
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * Getter pour le email.
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Getter pour la date de création.
     * @return DateTime
     */
    public function getCreationDate(): ?DateTime
    {
        return $this->creationDate;
    }

    /**
     * Setter pour la date de création. Si la date est une string, on la convertit en DateTime.
     * @param string|DateTime $creationDate
     * @param string $format : le format pour la convertion de la date si elle est une string.
     * Par défaut, c'est le format de date mysql qui est utilisé. 
     */
    public function setCreationDate(string|DateTime $creationDate, string $format = 'Y-m-d H:i:s'): void
    {
        if (is_string($creationDate)) {
            $creationDate = DateTime::createFromFormat($format, $creationDate);
        }
        $this->creationDate = $creationDate;
    }

    /**
     * Getter pour le user picture.
     * @return string
     */
    public function getUserPicture(): string
    {
        return $this->userPicture;
    }


    /**
     * Setter pour le user picture.
     * @param string $userPicture
     */
    public function setUserPicture(?string $userPicture): void
    {
        $this->userPicture = $userPicture;
    }
}
