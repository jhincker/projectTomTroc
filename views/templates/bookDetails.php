<?php

/**
 * Template pour afficher le formulaire d'ajout ou mise à jour des livres.
 */
?>

<div class="pb-20 bg-[#FAF9F7] px-6 md:px-12 lg:px-20">

    <div class="mr-32 ml-32">
        <button onclick="history.back()"
            class="back-button pt-12 pb-4 text-gray-500">
            ← retour
        </button>
        <!-- Titre -->
        <?php if (empty($book->getTitle())): ?>
            <h2 class="font-serif text-2xl md:text-3xl text-gray-800">Ajouter un livre</h2>
        <?php else: ?>
            <h2 class="font-serif text-2xl md:text-3xl text-gray-800">Modifier les informations</h2>
        <?php endif; ?>

        <!-- Conteneur principal -->
        <div id="book-square" class="bg-white mt-6 p-6 md:p-10 rounded-lg shadow-md">

            <!-- GRID RESPONSIVE -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

                <!-- IMAGE + BOUTON -->
                <div class="flex flex-col gap-4 items-center lg:items-start">

                    <p class="text-gray-500 w-[320px] flex justify-start">Photo</p>

                    <?php
                    $picturePath = $book->getPicture();
                    ?>

                    <div id="book-cover" class="w-[320px] max-w-xs aspect-square overflow-hidden rounded-lg shadow">
                        <?php if (!empty($picturePath)): ?>
                            <img src="<?php echo htmlspecialchars($picturePath, ENT_QUOTES); ?>"
                                alt=""
                                class="w-full h-full object-cover">
                        <?php else: ?>
                            <!-- Optionnel: image par défaut -->
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">
                                Aucune image enregistrée
                            </div>
                        <?php endif; ?>
                    </div>


                </div>


                <!-- FORMULAIRE -->
                <div id="connection-form" class="flex row-span-2 items-start justify-center text-gray-700">
                    <form action="index.php?action=updateBook" method="post"
                        enctype="multipart/form-data"
                        class="w-full max-w-xl space-y-4">
                        <?php if (!empty($book->getTitle())):
                            echo "<input type='hidden' name='id' value='" . $book->getId() . "'>";
                        endif; ?>

                        <div class="flex flex-col space-y-4">

                            <label for="title">Titre</label>
                            <input class="border border-gray-300 hover:border-blue-500 p-3 rounded-md w-full"
                                type="text" name="title" id="title" value="<?php echo $book->getTitle() ?>" required>

                            <label for="author">Auteur</label>
                            <input class="border border-gray-300 hover:border-blue-500 p-3 rounded-md w-full"
                                type="text" name="author" id="author" value="<?php echo $book->getAuthor() ?>" required>

                            <label for="content">Description</label>
                            <textarea class="border border-gray-300 hover:border-blue-500 p-3 rounded-md w-full"
                                name="content" id="content" rows="8" required><?php echo $book->getContent() ?></textarea>

                            <label for="availability">Disponibilité</label>
                            <select class="border border-gray-300 hover:border-blue-500 p-3 rounded-md w-full"
                                name="availability">
                                <option value="1" <?php echo $book->getAvailability() === 1 ? "selected" : ""  ?>>Disponible</option>
                                <option value="0" <?php echo $book->getAvailability() === 0 ? "selected" : ""  ?>>Non disponible</option>
                            </select>

                            <div class="flex flex-col gap-2">
                                <label for="image">Photo du livre</label>
                                <input type="file" name="image" id="image"
                                    accept="image/*" class="border border-gray-300 p-3 rounded-md w-full">
                            </div>
                            <button type="submit" class="bg-[#00AC66] text-white rounded-md py-3 w-full hover:opacity-80 transition">
                                Valider
                            </button>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>