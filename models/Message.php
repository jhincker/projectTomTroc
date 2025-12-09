<?php
class Message extends AbstractEntity
{

    private int $idSender;
    private int $idRecipient;
    private string $message = "";
    private bool $isRead = false;
    private ?DateTime $creationDate = null;

    /**
     * Setter pour l'id du sender. 
     * @param int $idSender
     */
    public function setIdSender(int $idSender): void
    {
        $this->idSender = $idSender;
    }

    /**
     * Getter pour l'id du sender.
     * @return int
     */
    public function getIdSender(): int
    {
        return $this->idSender;
    }

    /**
     * Setter pour l'id du recipient. 
     * @param int $idRecipient
     */
    public function setIdRecipient(int $idRecipient): void
    {
        $this->idRecipient = $idRecipient;
    }

    /**
     * Getter pour l'id du recipient.
     * @return int
     */
    public function getIdRecipient(): int
    {
        return $this->idRecipient;
    }

    /**
     * Setter pour le message. 
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * Getter pour le message.
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Setter pour isRead. 
     * @param bool $isRead
     */
    public function setIsRead(bool $isRead): void
    {
        $this->isRead = $isRead;
    }

    /**
     * Getter pour l'id de l'utilisateur.
     * @return int
     */
    public function getIsRead(): bool
    {
        return $this->isRead;
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
}
