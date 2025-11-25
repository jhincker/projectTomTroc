<?php

/**
 * Template pour afficher le formulaire de connexion.
 */
?>

<div class="min-h-screen grid grid-cols-1 lg:grid-cols-2 gap-10 px-6 md:px-12 lg:px-20 py-10">

    <!-- FORMULAIRE -->
    <div class="flex items-center justify-center">
        <form action="index.php?action=connectUser" method="post"
            class="w-full max-w-md bg-white rounded-xl shadow-md p-8 space-y-6">

            <h2 class="font-serif text-3xl text-gray-800">Connexion</h2>

            <div class="flex flex-col space-y-4 text-gray-700">

                <label for="email">Adresse email</label>
                <input
                    class="border border-gray-300 focus:border-blue-500 p-3 rounded-md w-full"
                    type="text"
                    name="email"
                    id="email"
                    required>

                <label for="password">Mot de passe</label>
                <input
                    class="border border-gray-300 focus:border-blue-500 p-3 rounded-md w-full"
                    type="password"
                    name="password"
                    id="password"
                    required>

                <button
                    class="bg-[#00AC66] text-white rounded-md py-3 w-full hover:opacity-80 transition">
                    Se connecter
                </button>

                <p class="text-sm">
                    Pas de compte ?
                    <a class="underline hover:opacity-50" href="index.php?action=signUpForm">
                        Inscrivez-vous
                    </a>
                </p>

            </div>
        </form>
    </div>

    <!-- IMAGE -->
    <div class="flex items-center justify-center">
        <img src="images/connect.jpg"
            alt=""
            class="w-full max-w-lg rounded-xl shadow object-cover">
    </div>
</div>