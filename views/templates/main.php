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
    <header class="fixed top-0 left-0 w-full z-50 bg-[#F5F3EF]">
        <nav class="grid grid-cols-4 items-center overflow-auto gap-4 p-4 nav-font">
            <div class="logo">
                <img src="images/logoTomTroc.png" alt="Tom Troc">
            </div>
            <div class="navleft flex gap-8 col-span-2">
                <a class="hover:opacity-50" href="index.php">Accueil</a>
                <a class="hover:opacity-50" href="index.php?action=apropos">Nos livres à l'échange</a>
            </div>
            <div class="navright flex gap-8">
                <a class="hover:opacity-50" href="index.php?action=user">Messagerie</a>
                <a class="hover:opacity-50" href="index.php?action=user">Mon compte</a>
                <?php
                if (isset($_SESSION['user'])) {
                    echo '<a class="hover:opacity-50" href="index.php?action=disconnectUser">Déconnexion</a>';
                } else {
                    echo '<a class="hover:opacity-50" href="index.php?action=connectionForm">Connexion</a>';
                }
                ?>
            </div>
        </nav>
    </header>

    <!-- CONTENU QUI S'ADAPTE À L'ÉCRAN -->
    <!-- pt-[80px] = laisse la place pour le header fixe (à ajuster si besoin) -->
    <main class="flex-1 pt-[80px]">
        <?= $content ?>
    </main>

    <!-- FOOTER FIXE -->
    <footer class="bottom-0 left-0 w-full h-[61px] flex bg-white items-center gap-8 justify-end nav-font z-50">
        <a class="hover:opacity-50" href="index.php">Politique de confidentialité</a>
        <a class="hover:opacity-50" href="index.php?action=apropos">Mentions légales</a>
        <p>Tom Troc©</p>
        <img class="h-[30px] mr-8" src="images/logoFooter.png" alt="Logo footer">
    </footer>

</body>

</html>