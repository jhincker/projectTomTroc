<?php
?>

<div class="pb-20">

    <div class="pt-20">

        <div class="flex grid grid-cols-2 ml-20 mr-20 gap-4 pb-20">

            <!-- =================================== -->
            <!--         COLONNE DE GAUCHE          -->
            <!-- =================================== -->
            <div class="flex flex-col items-start justify-center w-[280px] text-wrap gap-2 ml-48">

                <h2 class="font-serif text-3xl">Rejoignez nos lecteurs passionnés</h2>
                <p class="text-md opacity-50">Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres. </p>
                <a href="index.php?action=showOurBooks"
                    class="text-white bg-[#00AC66] text-center text-sm border mt-6 rounded-lg py-3 hover:opacity-80 pl-4 pr-4">
                    Découvrir</a>
            </div>

            <!-- =================================== -->
            <!--         COLONNE DE DROITE          -->
            <!-- =================================== -->
            <div id="personal-info" class="flex flex-col items-end mr-48">

                <img class="w-[404px] h-[539px]" src="images/frontBookStore.jpg" alt="bookstore">
                <p class="opacity-40 text-sm italic">Hamza
                <p>
            </div>
        </div>
    </div>
    <div class="bg-[#FAF9F7] pt-20 pb-20 flex flex-col items-center justify-center">
        <h3 class="font-serif text-2xl pb-16">Les derniers livres ajoutés</h3>
        <div id="books-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 pb-8">
            <?php
            foreach ($lastBooks as $book): ?>

                <div class="book-card w-[200px] h-[324px] bg-white hover:shadow-xl transition-shadow duration-300 overflow-hidden"
                    data-title="<?= strtolower(htmlspecialchars($book->getTitle(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?>"
                    data-author="<?= strtolower(htmlspecialchars($book->getAuthor(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?>"
                    data-content="<?= strtolower(htmlspecialchars($book->getContent(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?>"
                    data-availability="<?= $book->getAvailability() ? 'disponible' : 'non dispo.' ?>">
                    <a href="index.php?action=showBookInfo&id=<?= $book->getId(); ?>"
                        class="hover:bg-[#009955] duration-200">

                        <!-- Image du livre -->
                        <div class="aspect-square bg-gray-200 overflow-hidden">
                            <?php if ($book->getPicture()): ?>
                                <img src="<?= $book->getPicture(); ?>" alt="" class="w-full h-full object-cover">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center bg-gray-300">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Informations du livre -->
                        <div class="p-4">
                            <h3 class="text-md text-gray-800 mb-2 line-clamp-2">
                                <?= htmlspecialchars($book->getTitle()) ?>
                            </h3>
                            <p class="text-sm text-gray-400 mb-3">
                                <?= htmlspecialchars($book->getAuthor()) ?>
                            </p>

                            <!-- Livre vendu par : -->
                            <div class="flex items-center justify-between mb-4 text-xs text-gray-400 italic gap-2">
                                <span>Vendu par : <?= htmlspecialchars($usernames[$book->getIdUser()] ?? 'inconnu', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></span>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <a href="index.php?action=showOurBooks"
            class="text-white bg-[#00AC66] text-center text-sm border mt-6 rounded-lg py-3 hover:opacity-80 pl-4 pr-4">
            Voir tous les livres</a>
    </div>
    <div class="pt-20 pb-20 flex flex-col items-center justify-center">
        <h3 class="font-serif text-2xl pb-6">Comment ça marche ?</h3>
        <p class="text-md opacity-50 text-wrap w-[400px]">Échanger des livres avec TomTroc c’est simple et amusant ! Suivez ces étapes pour commencer :</p>
        <div id="books-container" class="flex items-center justify-center gap-8 pb-8 mt-8">

            <div class="p-6 flex items-center justify-center w-[215px] h-[139px] bg-white text-sm text-wrap">
                <p>Inscrivez-vous gratuitement sur notre plateforme.</p>
            </div>
            <div class="p-6 flex items-center justify-center w-[215px] h-[139px] bg-white text-sm text-wrap">
                <p>Ajoutez les livres que vous souhaitez échanger à votre profil.</p>
            </div>
            <div class="p-6 flex items-center justify-center w-[215px] h-[139px] bg-white text-sm text-wrap">
                <p>Parcourez les livres disponibles chez d'autres membres.</p>
            </div>
            <div class="p-6 flex items-center justify-center w-[215px] h-[139px] bg-white text-sm text-wrap">
                <p>Proposez un échange et discutez avec d'autres passionnés de lecture.</p>
            </div>
        </div>
        <a href="index.php?action=showOurBooks"
            class="text-[#00AC66] bg-[#F5F3EF] border border-[#00AC66] text-center text-sm mt-6 rounded-lg py-3 hover:opacity-80 pl-4 pr-4">
            Voir tous les livres</a>
    </div>
    <div>
        <img src="images/banner.png" alt="library">
    </div>
    <div class="flex flex-col items-center justify-center pt-20">
        <h3 class="font-serif text-2xl pb-6 text-left w-[350px]">Nos valeurs</h3>
        <p class="text-md opacity-50 text-wrap w-[350px]">Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes. Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé. Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.</p>
        <p class="opacity-40 text-sm italic w-[350px] pt-6">L'équipe Tom Troc
        <p>
            <img class="ml-80" src="images/greenHeart.svg" alt="green heart">
    </div>
</div>