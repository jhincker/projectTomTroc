<?php

/**
 * Page Messagerie – Version Complète Corrigée
 */
?>

<div class="bg-[#FAF9F7] h-[589px] grid grid-cols-4 ml-28">

    <!-- ============================== -->
    <!--        COLONNE DE GAUCHE       -->
    <!-- ============================== -->
    <div class="col-span-1 flex flex-col h-full">
        <h2 class="pt-12 pb-4 ml-16 text-2xl font-serif">Messagerie</h2>

        <div id="messages-thread" class="w-full text-left text-xs bg-white h-full overflow-y-auto">

            <?php if (!empty($threads)): ?>
                <?php foreach ($threads as $t): ?>

                    <?php
                    $senderId = $t->getIdSender();
                    if ($senderId === null) {
                        $senderId = $t->getIdRecipient() ?? null;
                    }
                    if ($senderId === null) {
                        continue;
                    }

                    $sender = $userManager->getUserById((int)$senderId);
                    if (!$sender) {
                        continue;
                    }

                    $senderPic = $sender->getUserPicture();
                    $avatar = !empty($senderPic) ? htmlspecialchars($senderPic, ENT_QUOTES) : null;
                    $isActive = ($sender->getId() === $activeRecipientId);
                    ?>

                    <a href="index.php?action=messaging&chat=<?= $sender->getId() ?>">
                        <div class="flex items-center gap-3 p-4 w-full cursor-pointer
                        <?= $isActive ? 'bg-white shadow-sm rounded-md' : 'bg-[#FAF9F7]' ?>">

                            <!-- Avatar du sender -->
                            <div class="w-[50px] aspect-square rounded-full overflow-hidden shadow">
                                <?php if (!empty($avatar)): ?>
                                    <img src="<?= $avatar ?>" class="w-full h-full object-cover">
                                <?php endif; ?>
                            </div>

                            <div class="flex flex-col w-full">

                                <!-- Username + date -->
                                <div class="flex justify-between">
                                    <span class="font-semibold text-gray-800">
                                        <?= htmlspecialchars($sender->getUsername()) ?>
                                    </span>

                                    <span class="text-gray-500 text-[13px]">
                                        <?= $t->getCreationDate()->format("H:i") ?>
                                    </span>
                                </div>

                                <!-- Aperçu du dernier message -->
                                <p class="line-clamp-2 max-w-xs pt-1 text-gray-700">
                                    <?= htmlspecialchars($t->getMessage()) ?>
                                </p>

                            </div>

                        </div>
                    </a>

                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-gray-500 p-4">Aucune conversation.</p>
            <?php endif; ?>

        </div>
    </div>

    <!-- ============================== -->
    <!--         DISCUSSION DROITE      -->
    <!-- ============================== -->
    <div id="discussion" class="flex flex-col col-span-3 h-full bg-[#F5F3EF]">

        <div class="pl-6 flex flex-col h-full">

            <!-- HEADER DU CHAT -->
            <?php
            // Protéger l'accès à l'utilisateur actif (activeRecipientId peut être null)
            $activeUser = null;
            if (!empty($activeRecipientId)) {
                $activeUser = $userManager->getUserById((int)$activeRecipientId);
            }
            // Fallback sur l'utilisateur courant si l'actif est introuvable
            if (!$activeUser) {
                $activeUser = $user;
            }
            $activePic = $activeUser->getUserPicture();
            $activeAvatar = !empty($activePic) ? htmlspecialchars($activePic, ENT_QUOTES) : null;
            ?>

            <div class="flex flex-row items-center gap-2 pt-6">
                <a href="index.php?action=myAccount&id=<?= $activeRecipientId; ?>"
                    class="duration-200">
                    <div class="w-[50px] h-[50px] rounded-full overflow-hidden shadow">
                        <?php if (!empty($activeAvatar)): ?>
                            <img src="<?= $activeAvatar ?>" class="w-full h-full object-cover">
                        <?php endif; ?>
                    </div>

                    <span class="font-semibold text-gray-800 text-sm">
                        <?= htmlspecialchars($activeUser->getUsername()) ?>
                    </span>
                </a>
            </div>

            <!-- =============================== -->
            <!--        FIL DES MESSAGES         -->
            <!-- =============================== -->
            <div id="message-bubble" class="flex flex-col gap-2 mt-auto overflow-y-auto pr-6">

                <?php foreach ($messages as $msg): ?>

                    <?php
                    $isMine = $msg->getIdSender() === $user->getId();
                    $sender = $isMine ? $user : $userManager->getUserById($msg->getIdSender());
                    $sPic = $sender->getUserPicture();
                    $senderAvatar = !empty($sPic) ? htmlspecialchars($sPic, ENT_QUOTES) : null;
                    ?>

                    <div class="flex w-full <?= $isMine ? 'justify-end' : 'justify-start' ?> mb-4">

                        <div class="max-w-xs flex flex-col <?= $isMine ? 'items-end' : 'items-start' ?>">

                            <!-- DATE POUR MES MESSAGES -->
                            <?php if ($isMine): ?>
                                <span class="text-gray-400 text-[11px] mb-1">
                                    <?= $msg->getCreationDate()->format("d-m H:i") ?>
                                </span>
                            <?php endif; ?>

                            <!-- AVATAR + DATE À DROITE pour les messages reçus -->
                            <?php if (!$isMine): ?>
                                <div class="flex items-center gap-2 mb-1">
                                    <!-- Avatar -->
                                    <div class="w-[20px] h-[20px] rounded-full overflow-hidden shadow">
                                        <?php if (!empty($senderAvatar)): ?>
                                            <img src="<?= $senderAvatar ?>" class="w-full h-full object-cover">
                                        <?php endif; ?>
                                    </div>

                                    <!-- Date à droite -->
                                    <span class="text-gray-400 text-[11px]">
                                        <?= $msg->getCreationDate()->format("d-m H:i") ?>
                                    </span>
                                </div>
                            <?php endif; ?>

                            <!-- BULLE DE MESSAGE -->
                            <div class="px-3 py-2 rounded-lg text-sm
                <?= $isMine ? 'bg-blue-100 text-gray-800' : 'bg-white text-gray-800' ?>">
                                <?= htmlspecialchars($msg->getMessage()) ?>
                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>



            </div>

            <!-- =============================== -->
            <!--          INPUT MESSAGE           -->
            <!-- =============================== -->
            <form action="index.php?action=sendMessage" method="POST"
                class="flex items-center gap-3 w-full pr-6 pb-12 pt-2">

                <input type="hidden" name="recipient" value="<?= $activeRecipientId ?>">

                <input
                    type="text"
                    name="message"
                    placeholder="Tapez votre message ici"
                    class="flex-1 border border-gray-200 rounded-md px-3 py-2 text-sm
                    focus:ring-2 focus:ring-[#00AC66] focus:outline-none bg-white">

                <button
                    type="submit"
                    class="bg-[#00AC66] text-white px-4 py-2 rounded-md text-sm hover:bg-[#009157] transition">
                    Envoyer
                </button>

            </form>

        </div>

    </div>

</div>