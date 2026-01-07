<?php

/**
 * Page mon compte / profil public.
 */

$isOwnProfile = isset($_SESSION['idUser']) && $user->getId() === $_SESSION['idUser'];

?>

<div class="pb-20 bg-[#FAF9F7]">

    <!-- Titre -->
    <div class="">
        <h2 class="pt-12 pl-16 text-2xl font-serif">
            <?= $isOwnProfile ? "Mon compte" : "" ?>
        </h2>

        <div id="account-info" class="flex grid grid-cols-2 ml-16 mr-20 gap-4">

            <!-- =================================== -->
            <!--         COLONNE DE GAUCHE          -->
            <!-- =================================== -->
            <div id="account-profile" class="flex flex-col items-center justify-center gap-4 bg-white mt-6 p-6 rounded-lg shadow-md">

                <?php
                $picturePath = $user->getUserPicture();
                ?>

                <!-- PHOTO DE PROFIL -->
                <div id="account-picture" class="w-32 h-32 max-w-xs rounded-full overflow-hidden shadow flex items-center justify-center bg-gray-100">
                    <?php if (!empty($picturePath)): ?>
                        <img src="<?php echo htmlspecialchars($picturePath, ENT_QUOTES); ?>"
                            alt=""
                            class="w-full h-full object-cover">
                    <?php else: ?>
                        <div class="text-center px-2">
                            <svg class="mx-auto mb-2 w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.6 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <div class="text-sm text-gray-600">Veuillez ajouter votre photo de profil</div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- PSEUDO -->
                <div id="username" class="text-2xl font-serif">
                    <span><?= htmlspecialchars($user->getUsername()); ?></span>
                </div>

                <!-- DATE D'INSCRIPTION -->
                <?php
                $creationDate = $user->getCreationDate();
                $now = new DateTime();
                $interval = $creationDate->diff($now);

                if ($interval->y >= 1) {
                    echo '<div id="member-since" class="opacity-50">Membre depuis ' . $creationDate->format('Y') . '</div>';
                } else {
                    echo '<div id="member-since" class="opacity-50">Membre depuis le ' . $creationDate->format('d/m/Y') . '</div>';
                }
                ?>

                <p class="opacity-70">BIBLIOTHÈQUE</p>
                <div id="listed-books-number" class="flex flex-row text-xl text-gray-700">
                    <img src="images/iconBook.svg" class="pr-2" alt="icône livre">
                    <?= $bookCount ?> livre<?= $bookCount > 1 ? 's' : '' ?>
                </div>

                <?php if ($isOwnProfile): ?>
                    <a href="index.php?action=showUpdateBookForm"
                        class="text-black text-center bg-[#F5F3EF] border border-black w-[150px] rounded-md py-3 hover:opacity-80">
                        Ajouter un livre
                    </a>
                <?php else: ?>
                    <a href="index.php?action=messaging&chat=<?= $user->getId(); ?>"
                        class="text-[#00AC66] bg-[#F5F3EF] text-center border border-[#00AC66] w-[150px] rounded-md py-3 hover:opacity-80">
                        Écrire un message
                    </a>
                <?php endif; ?>

            </div>

            <!-- =================================== -->
            <!--         COLONNE DE DROITE          -->
            <!-- =================================== -->
            <div id="personal-info" class="bg-white mt-6 p-6 rounded-lg shadow-md">

                <?php if ($isOwnProfile): ?>

                    <!-- FORMULAIRE INFOS PERSO (MON COMPTE) -->
                    <div class="flex items-center justify-center">
                        <form action="index.php?action=updateUser" method="post" enctype="multipart/form-data"
                            class="w-full max-w-md bg-white p-8 space-y-6">

                            <input type="hidden" name="id" value="<?= $user->getId(); ?>">

                            <h2 class="text-md text-gray-800">Vos informations personnelles</h2>

                            <div class="flex flex-col space-y-4 text-gray-700">

                                <label class="opacity-70" for="email">Adresse email</label>
                                <input
                                    class="bg-gray-200 focus:border-blue-500 p-3 rounded-md w-full"
                                    type="text"
                                    name="email"
                                    id="email"
                                    value="<?= htmlspecialchars($user->getEmail()); ?>"
                                    required>

                                <label class="opacity-70" for="password">Mot de passe</label>
                                <input
                                    class="bg-gray-200 focus:border-blue-500 p-3 rounded-md w-full"
                                    type="password"
                                    name="password"
                                    id="password"
                                    value="<?= htmlspecialchars($user->getPassword()); ?>"
                                    required>

                                <label class="opacity-70" for="username">Pseudo</label>
                                <input
                                    class="bg-gray-200 focus:border-blue-500 p-3 rounded-md w-full"
                                    type="text"
                                    name="username"
                                    id="username"
                                    value="<?= htmlspecialchars($user->getUsername()); ?>"
                                    required>

                                <label class="opacity-70" for="image">Photo de profil</label>
                                <input type="file" name="image" id="image" accept="image/*"
                                    class="block text-md text-gray-600">

                                <button type="submit"
                                    class="text-[#00AC66] bg-[#F5F3EF] border border-[#00AC66] w-[150px] rounded-md py-3 hover:opacity-80">
                                    Enregistrer
                                </button>
                            </div>
                        </form>
                    </div>

                <?php else: ?>

                    <!-- PROFIL PUBLIC : TABLEAU DES LIVRES ICI, SANS DISPONIBILITÉ / ACTION -->
                    <div id="books-list-public" class="w-full text-left text-xs bg-white mt-2 p-2 rounded-lg">
                        <?php if (!empty($books) && is_array($books)) : ?>
                            <table class="w-full">
                                <thead>
                                    <tr>
                                        <th class="w-1/6 px-6 py-4">PHOTO</th>
                                        <th class="w-1/6 px-6 py-4">TITRE</th>
                                        <th class="w-1/6 px-6 py-4">AUTEUR</th>
                                        <th class="w-1/6 px-6 py-4">DESCRIPTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($books as $book): ?>
                                        <tr class="odd:bg-gray-200 even:bg-white">
                                            <td class="px-6 py-4">
                                                <div class="w-[50px] max-w-xs aspect-square overflow-hidden shadow">
                                                    <img src="<?= $book->getPicture(); ?>" alt="" class="w-full h-full object-cover">
                                                </div>
                                            </td>
                                            <td class="px-6 py-4"><?= htmlspecialchars($book->getTitle()); ?></td>
                                            <td class="px-6 py-4"><?= htmlspecialchars($book->getAuthor()); ?></td>
                                            <td class="px-6 py-4">
                                                <p class="line-clamp-4 max-w-xs">
                                                    <?= htmlspecialchars($book->getContent()); ?>
                                                </p>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p>Aucun livre trouvé.</p>
                        <?php endif; ?>
                    </div>

                <?php endif; ?>

            </div>

            <!-- =================================== -->
            <!--      2ème ROW : TABLEAU COMPLET     -->
            <!--      (UNIQUEMENT MON COMPTE)        -->
            <!-- =================================== -->
            <?php if ($isOwnProfile): ?>
                <div id="books-list" class="w-[1296px] text-left text-xs bg-white mt-6 p-6 rounded-lg shadow-md">
                    <?php if (!empty($books) && is_array($books)) : ?>
                        <table class="w-full" id="bookMonitoring">
                            <thead>
                                <tr>
                                    <th class="w-1/6 px-6 py-4">PHOTO</th>
                                    <th class="w-1/6 px-6 py-4">TITRE</th>
                                    <th class="w-1/6 px-6 py-4">AUTEUR</th>
                                    <th class="w-1/6 px-6 py-4">DESCRIPTION</th>
                                    <th class="w-1/6 px-6 py-4">DISPONIBILITÉ</th>
                                    <th class="w-1/6 px-6 py-4">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($books as $book): ?>
                                    <tr class="odd:bg-gray-200 even:bg-white">
                                        <td class="px-6 py-4">
                                            <div class="w-[50px] max-w-xs aspect-square overflow-hidden shadow">
                                                <img src="<?= $book->getPicture(); ?>" alt="" class="w-full h-full object-cover">
                                            </div>
                                        </td>
                                        <td class="px-6 py-4"><?= htmlspecialchars($book->getTitle()); ?></td>
                                        <td class="px-6 py-4"><?= htmlspecialchars($book->getAuthor()); ?></td>
                                        <td class="px-6 py-4">
                                            <p class="line-clamp-4 max-w-xs">
                                                <?= htmlspecialchars($book->getContent()); ?>
                                            </p>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php if ($book->getAvailability() == 1): ?>
                                                <span class="text-white rounded-xl bg-green-500 pt-1 pb-1 pr-2 pl-2">
                                                    disponible
                                                </span>
                                            <?php else: ?>
                                                <span class="text-white rounded-xl bg-red-500 pt-1 pb-1 pr-2 pl-2">
                                                    non dispo.
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a class="underline mr-1"
                                                href="index.php?action=showUpdateBookForm&id=<?= $book->getId(); ?>">
                                                Éditer
                                            </a>
                                            <a class="text-red-500 underline ml-1"
                                                href="index.php?action=deleteBook&id=<?= $book->getId(); ?>">
                                                Supprimer
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>Aucun livre trouvé.</p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>