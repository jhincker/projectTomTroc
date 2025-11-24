<?php

/**
 * Template pour afficher le formulaire de connexion.
 */
?>
<div class="grid min-h-screen grid-cols-2">
    <div class="connection-form flex items-center justify-center">
        <form action="index.php?action=connectUser" method="post" class="foldedCorner gap-8">
            <h2 class="font-serif text-2xl mb-4">Connexion</h2>
            <div class="formGrid flex flex-col space-y-4">
                <label for="email">Adresse email</label>
                <input class="border border-2 hover:border-blue-500 p-1 rounded-md" type="text" name="email" id="email" required>
                <label for="password">Mot de passe</label>
                <input class="border border-2 hover:border-blue-500 p-1 rounded-md" type="password" name="password" id="password" required>
                <button class="submit bg-[#00AC66] text-white rounded-md h-12">Se connecter</button>
                <p>Pas de compte ? <a class="underline hover:opacity-50" href="index.php?action=signUpForm">Inscrivez-vous</a></p>
            </div>
        </form>
    </div>
    <div class="relative">
        <img src="images/connect.jpg" alt="" class="h-auto w-auto">
    </div>
</div>