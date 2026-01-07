<?php

class MessageManager extends AbstractEntityManager
{


    public function getAllMessagesByRecipientId(int $idRecipient): array
    {
        $sql = "SELECT * FROM message WHERE id_recipient = :id_recipient";
        $result = $this->db->query($sql, ['id_recipient' => $idRecipient]);
        $messages = [];

        while ($message = $result->fetch()) {
            $messages[] = new Message($message);
        }
        return $messages;
    }


    public function getAllSendersIdByRecipientId(int $idRecipient): array
    {
        $sql = "SELECT DISTINCT id_sender FROM message WHERE id_recipient = :id_recipient ORDER BY creation_date";
        $result = $this->db->query($sql, ['id_recipient' => $idRecipient]);
        $chats = [];

        while ($chat = $result->fetch()) {
            $chats[] = $chat;
        }
        return $chats;
    }

    public function getUnreadMessagesByRecipientId(int $idRecipient): int
    {
        $sql = "SELECT COUNT(*) FROM message WHERE id_recipient = :id_recipient AND is_read = 0";
        $result = $this->db->query($sql, ['id_recipient' => $idRecipient]);

        return (int) $result->fetchColumn();
    }

    public function getLastMessagesByRecipient(int $idRecipient): array
    {
        $sql = "
        SELECT m.*
        FROM message m
        INNER JOIN (
            SELECT id_sender, MAX(creation_date) AS last_date
            FROM message
            WHERE id_recipient = :id_recipient
            GROUP BY id_sender
        ) t
        ON m.id_sender = t.id_sender AND m.creation_date = t.last_date
        ORDER BY m.creation_date DESC
    ";

        $result = $this->db->query($sql, ['id_recipient' => $idRecipient]);
        $threads = [];

        while ($msg = $result->fetch()) {
            $threads[] = new Message($msg);
        }

        return $threads;
    }

    public function getConversation(int $idUser, int $otherUser): array
    {
        $sql = "
        SELECT * FROM message
        WHERE 
            (id_sender = :idUser AND id_recipient = :otherUser)
        OR 
            (id_sender = :otherUser AND id_recipient = :idUser)
        ORDER BY creation_date ASC
    ";

        $result = $this->db->query($sql, [
            'idUser' => $idUser,
            'otherUser' => $otherUser
        ]);

        $messages = [];
        while ($msg = $result->fetch()) {
            $messages[] = new Message($msg);
        }

        return $messages;
    }

    public function addMessage(Message $message)
    {
        $sql = "INSERT INTO message (id_sender, id_recipient, message, is_read, creation_date)
            VALUES (:id_sender, :id_recipient, :message, :is_read, NOW())";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'id_sender'    => $message->getIdSender(),
            'id_recipient' => $message->getIdRecipient(),
            'message'      => $message->getMessage(),
            'is_read'      => 0,
        ]);
    }

    public function markMessagesAsRead(int $senderId, int $recipientId): void
    {
        $sql = "UPDATE message 
            SET is_read = 1 
            WHERE id_sender = :sender 
              AND id_recipient = :recipient 
              AND is_read = 0";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'sender'    => $senderId,
            'recipient' => $recipientId
        ]);
    }
}
