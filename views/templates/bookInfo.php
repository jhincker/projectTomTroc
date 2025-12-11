<?php

/**
 * Template pour afficher le formulaire d'inscription.
 */
?>
<div class="grid min-h-screen grid-cols-2">
    <div class="relative">
        <?php
        $imageBase64 = base64_encode($book->getPicture());
        $imageSrc = "data:image/jpeg;base64,{$imageBase64}";
        ?>
        <img src="<?= $imageSrc; ?>" alt="" class="h-auto w-auto">
    </div>
    <div class="flex flex-col justify-center ml-20 items-start gap-2">
        <h2 class="text-2xl font-serif"><?= htmlspecialchars($book->getTitle()); ?></h2>
        <p class="opacity-30">Par <?= htmlspecialchars($book->getAuthor()); ?></p>
        <p class="opacity-40">__________</p>
        <h3 class="text-xs pt-6">DESCRIPTION</h3>
        <span class="text-sm w-[500px]"><?= htmlspecialchars($book->getContent()); ?></span>
        <h3 class="text-xs pt-6">PROPRIÉTAIRE</h3>
        <div class="pt-2">
            <a href="index.php?action=myAccount&id=<?= $user->getId(); ?>"
                class="flex items-center gap-2 duration-200">
                <div class="w-[50px] h-[50px] rounded-full overflow-hidden shadow">
                    <?php
                    $imageBase64 = base64_encode($user->getUserPicture());
                    $imageSrc = "data:image/jpeg;base64,{$imageBase64}";
                    ?>
                    <img src="<?= $imageSrc; ?>" alt="" class="w-full h-full object-cover">
                </div>

                <span class="font-semibold text-gray-800 text-sm">
                    <?= htmlspecialchars($user->getUsername()) ?>
                </span>
            </a>
        </div>
        <a href="index.php?action=messaging&chat=<?= $user->getId(); ?>"
            class="text-white bg-[#00AC66] text-center border mt-6 w-[500px] rounded-md py-3 hover:opacity-80">
            Écrire un message
        </a>
    </div>
</div>