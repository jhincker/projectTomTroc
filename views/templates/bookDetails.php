<?php

/**
 * Template pour afficher le formulaire de connexion.
 * MODIFIER COULEURS
 */
?>
<div class="pb-20 bg-[#FAF9F7]">
    <button class="back-button pt-12 pb-4 pl-24 text-gray-500">← retour</button>
    <h2 class="font-serif text-2xl pl-24">Modifier les informations</h2>

    <div class="book-square bg-white ml-24 mr-24 mt-4 rounded-lg">
        <div class="grid min-h-screen grid-cols-2 ml-20 mr-20">
            <div class="relative mt-6 w-full max-w-sm aspect-square overflow-hidden">
                <p class="pb-2 text-gray-500">Photo</p>
                <img src="images/bookDetails.jpg" alt="" class="-z-10 w-full h-full object-cover">
                <div class="flex justify-end mt-2">
                    <button class="underline hover:opacity-50 z-40">Modifier la photo</button>
                </div>
            </div>
            <div class="connection-form flex items-center justify-center text-gray-500">
                <form action="index.php?action=updateBook" method="post"
                    class="foldedCorner gap-8 w-full max-w-xl mx-auto">

                    <div class="formGrid flex flex-col space-y-4">

                        <label for="title">Titre</label>
                        <input class="border border-2 hover:border-blue-500 p-1 rounded-md w-full h-8" type="text" name="title" id="title" required>

                        <label for="author">Auteur</label>
                        <input class="border border-2 hover:border-blue-500 p-1 rounded-md w-full h-8" type="text" name="author" id="author" required>

                        <label for="content">Description</label>
                        <textarea class="border border-2 hover:border-blue-500 p-1 rounded-md w-full" name="content" id="content" rows="10" required></textarea>

                        <label for="availabilty">Disponibilité</label>
                        <select class="border border-2 hover:border-blue-500 rounded-md w-full h-8" name="availabilty">
                            <option value="true">Disponible</option>
                            <option value="false">Non disponible</option>
                        </select>

                        <button class="submit bg-[#00AC66] text-white rounded-md h-12 w-full">
                            Valider
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>