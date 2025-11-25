<?php

/**
 * Template pour afficher le formulaire d'ajout ou mise à jour des livres.
 */
?>

<div class="pb-20 bg-[#FAF9F7] px-6 md:px-12 lg:px-20">

    <!-- Bouton retour -->
    <button class="back-button pt-12 pb-4 text-gray-500">← retour</button>

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
            <div class="flex flex-col items-center lg:items-start">

                <p class="pb-2 text-gray-500 w-[320px] flex justify-start">Photo</p>

                <!-- Photo du livre -->
                <div id="book-cover" class="w-[320px] max-w-xs aspect-square overflow-hidden rounded-lg shadow">
                    <img src="images/bookDetails.jpg" alt="" class="w-full h-full object-cover">
                </div>
                <div class="w-[320px] flex justify-end" id="button-modify">
                    <!-- Modifier photo -->
                    <button class="underline hover:opacity-50 self-end text-gray-600">
                        Modifier la photo
                    </button>
                </div>

            </div>


            <!-- FORMULAIRE -->
            <div id="connection-form" class="flex row-span-2 items-start justify-center text-gray-700">
                <form action="index.php?action=updateBook" method="post"
                    class="w-full max-w-xl space-y-4">

                    <div class="flex flex-col space-y-4">

                        <label for="title">Titre</label>
                        <input class="border border-gray-300 hover:border-blue-500 p-3 rounded-md w-full"
                            type="text" name="title" id="title" required>

                        <label for="author">Auteur</label>
                        <input class="border border-gray-300 hover:border-blue-500 p-3 rounded-md w-full"
                            type="text" name="author" id="author" required>

                        <label for="content">Description</label>
                        <textarea class="border border-gray-300 hover:border-blue-500 p-3 rounded-md w-full"
                            name="content" id="content" rows="8" required></textarea>

                        <label for="availabilty">Disponibilité</label>
                        <select class="border border-gray-300 hover:border-blue-500 p-3 rounded-md w-full"
                            name="availabilty">
                            <option value="true">Disponible</option>
                            <option value="false">Non disponible</option>
                        </select>

                        <button class="bg-[#00AC66] text-white rounded-md py-3 w-full hover:opacity-80 transition">
                            Valider
                        </button>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>