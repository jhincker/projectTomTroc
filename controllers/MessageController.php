<?php

/**
 * Affiche la page mon compte.
 * @return void
 */
class MessageController
{

    public function displayMyMessages(): void
    {
        // ID utilisateur connecté
        $idUser = $_SESSION['idUser'];

        // Vérification de connexion
        $userController = new UserController();
        $userController->checkIfUserIsConnected();

        $messageManager = new MessageManager();
        $userManager    = new UserManager();

        // Récupérer la liste des threads
        // threads = un message par sender (dernier message)
        $threads = $messageManager->getLastMessagesByRecipient($idUser);

        // Si aucun thread → afficher une vue vide
        if (empty($threads)) {
            $view = new View("Messagerie");
            $view->render("messaging", [
                'threads'          => [],
                'messages'         => [],
                'user'             => $userManager->getUserById($idUser),
                'activeRecipientId'  => null,
                'userManager'      => $userManager
            ]);
            return;
        }


        // Déterminer la discussion active

        // Paramètre GET ?chat=ID
        $activeRecipientId = isset($_GET['chat']) ? (int) $_GET['chat'] : null;

        // Pas de chat sélectionné → prendre le dernier thread automatiquement
        if ($activeRecipientId === null || $activeRecipientId === 0) {
            $activeRecipientId = $threads[0]->getIdSender();
        }

        // Marquer comme lus tous les messages du sender actif
        $messageManager->markMessagesAsRead(
            $activeRecipientId,  // sender
            $idUser            // recipient (user connecté)
        );


        // Récupérer la conversation
        $messageManager->markMessagesAsRead($activeRecipientId, $idUser);
        $messages = $messageManager->getConversation($idUser, $activeRecipientId);

        // Calcul des messages non lus
        $unreadCount = $messageManager->getUnreadMessagesByRecipientId($idUser);


        // User connecté

        $user = $userManager->getUserById($idUser);

        // Envoi à la vue

        $view = new View("Messagerie");
        $view->render("messaging", [
            'threads'          => $threads,
            'messages'         => $messages,
            'user'             => $user,
            'activeRecipientId'  => $activeRecipientId,
            'userManager'      => $userManager,
            'unreadCount'      => $unreadCount,
        ]);
    }




    public function sendMessage(): void
    {
        $userController = new UserController();
        $userController->checkIfUserIsConnected();

        $idSender = $_SESSION['idUser'];
        $idRecipient = Utils::request('recipient');

        $text = Utils::request('message', '');

        if (empty($text)) {
            header("Location: index.php?action=messaging");
            exit;
        }

        $message = new Message([
            'idSender' => $idSender,
            'idRecipient' => $idRecipient,
            'message' => $text,
            'isRead' => false
        ]);

        $manager = new MessageManager();
        $manager->addMessage($message);

        header("Location: index.php?action=messaging&chat={$idRecipient}");
        exit;
    }
}
