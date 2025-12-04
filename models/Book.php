<?php

/**
 * Entité Book, un book est défini par les champs
 * id, id_user, title, content, date_creation, date_update
 */
class Book extends AbstractEntity
{
    private int $idUser;
    private string $title = "";
    private string $author = "";
    private string $content = "";
    private int $availability = 1;
    private string $picture = "";
    private ?DateTime $creationDate = null;
    private ?DateTime $dateUpdate = null;


    /**
     * Setter pour l'id de l'utilisateur. 
     * @param int $idUser
     */
    public function setIdUser(int $idUser): void
    {
        $this->idUser = $idUser;
    }

    /**
     * Getter pour l'id de l'utilisateur.
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->idUser;
    }

    /**
     * Setter pour le titre.
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Getter pour le titre.
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Setter pour le author.
     * @param string $author
     */
    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    /**
     * Getter pour le author.
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }


    /**
     * Setter pour le contenu.
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }


    /**
     * Getter pour le contenu.
     * Retourne les $length premiers caractères du contenu.
     * @param int $length : le nombre de caractères à retourner.
     * Si $length n'est pas défini (ou vaut -1), on retourne tout le contenu.
     * Si le contenu est plus grand que $length, on retourne les $length premiers caractères avec "..." à la fin.
     * @return string
     */
    public function getContent(int $length = -1): string
    {
        if ($length > 0) {
            // Ici, on utilise mb_substr et pas substr pour éviter de couper un caractère en deux (caractère multibyte comme les accents).
            $content = mb_substr($this->content, 0, $length);
            if (strlen($this->content) > $length) {
                $content .= "...";
            }
            return $content;
        }
        return $this->content;
    }

    /**
     * Getter pour la dispo.
     * @return string
     */
    public function getAvailability(): int
    {
        return $this->availability;
    }


    /**
     * Setter pour la dispo.
     * @param string $picture
     */
    public function setAvailability(int $availability): void
    {
        $this->availability = $availability;
    }

    /**
     * Getter pour le picture.
     * @return string
     */
    public function getPicture(): string
    {
        return $this->picture;
    }


    /**
     * Setter pour le picture.
     * @param string $picture
     */
    public function setPicture(string $picture): void
    {
        $this->picture = $picture;
    }



    /* Setter pour la date de création. Si la date est une string, on la convertit en DateTime.
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
     * Getter pour la date de création.
     * Grâce au setter, on a la garantie de récupérer un objet DateTime.
     * @return DateTime
     */
    public function getCreationDate(): ?DateTime
    {
        return $this->creationDate;
    }

    /**
     * Setter pour la date de mise à jour. Si la date est une string, on la convertit en DateTime.
     * @param string|DateTime $dateUpdate
     * @param string $format : le format pour la convertion de la date si elle est une string.
     * Par défaut, c'est le format de date mysql qui est utilisé.
     */
    public function setDateUpdate(string|DateTime $dateUpdate, string $format = 'Y-m-d H:i:s'): void
    {
        if (is_string($dateUpdate)) {
            $dateUpdate = DateTime::createFromFormat($format, $dateUpdate);
        }
        $this->dateUpdate = $dateUpdate;
    }

    /**
     * Getter pour la date de mise à jour.
     * Grâce au setter, on a la garantie de récupérer un objet DateTime ou null
     * si la date de mise à jour n'a pas été définie.
     * @return DateTime|null
     */
    public function getDateUpdate(): ?DateTime
    {
        return $this->dateUpdate;
    }
}
