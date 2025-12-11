<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tom Troc</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/Website_TomTroc/css/style.css">
</head>

<body class="flex flex-col min-h-screen bg-[#F5F3EF]">

    <!-- HEADER FIXE -->
    <header class="fixed top-0 left-0 w-full z-50 bg-[#F5F3EF] shadow-md">
        <nav class="grid grid-cols-3 items-center px-4 md:px-10 py-3 nav-font">

            <!-- Logo -->
            <div class="flex justify-center flex-shrink-0">
                <img src="images/logoTomTroc.png" alt="Tom Troc" class="h-10 md:h-12">
            </div>

            <!-- Liens du centre -->
            <div class="hidden md:flex flex justify-start gap-8 text-gray-700 font-medium">
                <a class="hover:opacity-50" href="index.php?action=home">Accueil</a>
                <a class="hover:opacity-50" href="index.php?action=showOurBooks">Nos livres à l'échange</a>
            </div>

            <!-- Liens à droite -->
            <div class="flex justify-end hidden md:flex gap-8 text-gray-700 font-medium">
                <?php if (isset($_SESSION['user'])): ?>
                    <?php
                    $unreadCount = 0;
                    try {
                        if (isset($_SESSION['idUser'])) {
                            $messageManager = new MessageManager();
                            $unreadCount = $messageManager->getUnreadMessagesByRecipientId((int)$_SESSION['idUser']);
                        }
                    } catch (Throwable $e) {
                        $unreadCount = 0;
                    }
                    ?>
                    <a class="relative flex items-center gap-2 hover:opacity-50" href="index.php?action=messaging">
                        <div class="relative">
                            <img src="images/iconMessaging.svg" alt="Icône Messagerie" class="w-5 h-5">
                        </div>
                        Messagerie
                        <?php if ($unreadCount > 0): ?>
                            <span class="inline-flex items-center justify-center rounded-md bg-black text-white text-[10px] leading-none px-1 py-0.5 min-w-[9px] h-[18px]">
                                <?= $unreadCount ?>
                            </span>
                        <?php endif; ?>
                    </a>
                    <a class="flex items-center gap-2 hover:opacity-50" href="index.php?action=myAccount">
                        <img src="images/iconMyAccount.svg" alt="Icône Mon Compte" class="w-5 h-5">
                        Mon compte
                    </a>
                    <a class="hover:opacity-50" href="index.php?action=disconnectUser">Déconnexion</a>
                <?php else: ?>
                    <a class="hover:opacity-50" href="index.php?action=connectionForm">Connexion</a>
                <?php endif; ?>
            </div>

            <!-- Burger menu mobile -->
            <div class="md:hidden flex col-span-2 items-center justify-end">
                <button class="text-gray-500 text-3xl">☰</button>
            </div>

        </nav>
    </header>

    <!-- CONTENU -->
    <main class="flex-1 pt-[72px]">
        <?= $content ?>
    </main>

    <!-- FOOTER NON FIXE -->
    <footer class="w-full h-auto py-4 bg-white flex flex-wrap items-center gap-4 justify-center md:justify-end px-4 md:px-10 nav-font text-gray-700">
        <a class="hover:opacity-50" href="index.php">Politique de confidentialité</a>
        <a class="hover:opacity-50" href="index.php?action=apropos">Mentions légales</a>
        <p>Tom Troc©</p>
        <img class="h-[30px]" src="images/logoFooter.png" alt="Logo footer">
    </footer>

</body>

</html>