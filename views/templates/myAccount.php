<?php

/**
 * Page mon compte.
 */
?>

<div class="pb-20 bg-[#FAF9F7]">



    <!-- Mon compte -->
    <div class="">
        <h2 class="pt-12 pl-16 text-2xl font-serif">Mon compte</h2>
        <div id="account-info" class="flex grid grid-cols-2 ml-16 mr-20 gap-4">
            <div id="account-profile" class="flex flex-col items-center justify-center gap-4 bg-white mt-6 p-6 rounded-lg shadow-md">
                <div id="account-picture" class="w-32 h-32 max-w-xs rounded-full overflow-hidden shadow">
                    <?php
                    // Convert BLOB to base64 data URL
                    $imageBase64 = base64_encode($user->getUserPicture());
                    $imageSrc = "data:{image/jpeg};base64,{$imageBase64}";
                    ?>
                    <img src="<?php echo $imageSrc; ?>" alt="" class="w-full h-full object-cover">
                </div>
                <div class="flex pl-32" id="button-modify">
                    <div class="grid-rows-2">
                        <label class="block text-md font-medium text-gray-700 mb-2">Ajouter ou modifier la photo :<br></label>
                        <input type="file" name="image" accept="image/*" required
                            class="underline hover:opacity-50 self-end text-md text-gray-600">
                    </div>
                </div>
                <div id="username" class="text-2xl font-serif">
                    <span><?php echo $user->getUsername(); ?></span>
                </div>
                <?php
                $creationDate = $user->getCreationDate();
                $now = new DateTime();

                $interval = $creationDate->diff($now);

                if ($interval->y >= 1) {
                    // Plus de 1 an → affiche seulement l’année
                    echo '<div id="member-since" class="opacity-50">Membre depuis ' . $creationDate->format('Y') . '</div>';
                } else {
                    // Moins de 1 an → affiche la date complète
                    echo '<div id="member-since" class="opacity-50">Membre depuis le ' . $creationDate->format('d/m/Y') . '</div>';
                }
                ?>
                <p class="opacity-70">BIBLIOTHÈQUE</p>
                <div id="listed-books-number" class="flex flex-row text-xl text-gray-700">
                    <img src="images/iconBook.svg" class="pr-2" alt="icône livre">
                    <?= $bookCount ?> livre<?= $bookCount > 1 ? 's' : '' ?>
                </div>
                <a href="index.php?action=showUpdateBookForm" type="button" class="text-black text-center bg-[#F5F3EF] border border-black w-[150px] rounded-md py-3 hover:opacity-80">Ajouter un livre</a>
            </div>
            <div id="personal-info" class="bg-white mt-6 p-6 rounded-lg shadow-md">
                <!-- FORMULAIRE -->
                <div class="flex items-center justify-center">
                    <form action="index.php?action=connectUser" method="post"
                        class="w-full max-w-md bg-white p-8 space-y-6">

                        <h2 class="text-md text-gray-800">Vos informations personnelles</h2>

                        <div class="flex flex-col space-y-4 text-gray-700">

                            <label class="opacity-70" for="email">Adresse email</label>
                            <input
                                class="bg-gray-200 focus:border-blue-500 p-3 rounded-md w-full"
                                type="text"
                                name="email"
                                id="email"
                                required>

                            <label class="opacity-70" for="password">Mot de passe</label>
                            <input
                                class="bg-gray-200 focus:border-blue-500 p-3 rounded-md w-full"
                                type="password"
                                name="password"
                                id="password"
                                required>

                            <label class="opacity-70" for="username">Pseudo</label>
                            <input
                                class="bg-gray-200 focus:border-blue-500 p-3 rounded-md w-full"
                                type="text"
                                name="username"
                                id="username"
                                required>

                            <button type="submit" class="text-[#00AC66] bg-[#F5F3EF] border border-[#00AC66] w-[150px] rounded-md py-3 hover:opacity-80">
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div id="books-list" class="w-[1296px] text-left text-xs bg-white mt-6 p-6 rounded-lg shadow-md">
                <?php if (!empty($books) && is_array($books)) : ?>
                    <table class="w-full" id="bookMonitoring">
                        <thead>
                            <tr class="">
                                <th class="w-1/6 px-6 py-4" id="col picture">PHOTO</th>
                                <th class="w-1/6 px-6 py-4" id="col title">TITRE</th>
                                <th class="w-1/6 px-6 py-4" id="col author">AUTEUR</th>
                                <th class="w-1/6 px-6 py-4" id="col content">DESCRIPTION</th>
                                <th class="w-1/6 px-6 py-4" id="col availability">DISPONIBILITE</th>
                                <th class="w-1/6 px-6 py-4" id="col action">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($books as $book): ?>
                                <tr class="odd:bg-gray-200 even:bg-white">
                                    <td class="px-6 py-4" id="col picture"><!-- Photo du livre -->
                                        <div id="book-cover" class="w-[50px] max-w-xs aspect-square overflow-hidden shadow">
                                            <?php
                                            // Convert BLOB to base64 data URL
                                            $imageBase64 = base64_encode($book->getPicture());
                                            $imageSrc = "data:{image/jpeg};base64,{$imageBase64}";
                                            ?>
                                            <img src="<?php echo $imageSrc; ?>" alt="" class="w-full h-full object-cover">
                                        </div>
                                    </td>
                                    <td class="px-6 py-4" id="col title"><?= htmlspecialchars($book->getTitle()); ?></td>
                                    <td class="px-6 py-4" id="col author"><?= htmlspecialchars($book->getAuthor()); ?></td>
                                    <td class="px-6 py-4" id="col content">
                                        <p class="line-clamp-4 max-w-xs"><?= htmlspecialchars($book->getContent()); ?>``
                                        </p>
                                    </td>
                                    <td class="px-6 py-4" id="col availability"><?php if (htmlspecialchars($book->getAvailability()) == 1) {
                                                                                    echo '<span class="text-white rounded-xl bg-green-500 pt-1 pb-1 pr-2 pl-2">disponible</span>';
                                                                                } else {
                                                                                    echo '<span class="text-white rounded-xl bg-red-500 pt-1 pb-1 pr-2 pl-2">non dispo.</span>';
                                                                                }
                                                                                ?></td>
                                    <td class="px-6 py-4" id="col action"><a class="underline mr-1" href="index.php?action=showUpdateBookForm&id=<?php $book->getId() ?>">Editer</a><a class="text-red-500 underline ml-1" href="index.php?action=displayMyAccount&id=<?php $book->getId() ?>">Supprimer</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Aucun livre trouvé.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>