<div class="flex flex-col">
    <div id="title-searchbar" class="flex justify-between items-center pt-16 pb-8">
        <div class="" id="h2-ourBooks">
            <h2 class="text-2xl font-serif pl-64">Nos livres à l'échange</h2>
        </div>
        <form action="index.php" method="GET" class="relative pr-64" aria-label="Recherche de livres">

            <input type="hidden" name="action" value="showOurBooks">

            <label for="search-title" class="visually-hidden">Rechercher un livre</label>
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <img src="images/iconSearch.png" alt="Recherche">
            </span>

            <input
                id="search-title"
                type="search"
                name="title"
                class="w-full border rounded-md pl-10 py-2 text-gray-700 placeholder-gray-400"
                placeholder="Rechercher un livre"
                aria-label="Rechercher un livre">
        </form>
    </div>

    <!-- Books Grid -->
    <div class="max-w-7xl mx-auto px-6 lg:px-8 pb-12">
        <?php if (empty($books)): ?>
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">Aucun livre disponible pour le moment.</p>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-11">
                <?php
                foreach ($books as $book): ?>
                    <div class="book-card bg-white shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden"
                        data-title="<?= strtolower(htmlspecialchars($book->getTitle(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?>"
                        data-author="<?= strtolower(htmlspecialchars($book->getAuthor(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?>"
                        data-content="<?= strtolower(htmlspecialchars($book->getContent(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?>"
                        data-availability="<?= $book->getAvailability() ? 'disponible' : 'non dispo.' ?>">
                        <a href="index.php?action=showBookInfo&id=<?= $book->getId(); ?>"
                            class="hover:bg-[#009955] duration-200">

                            <!-- Image du livre -->
                            <div class="aspect-square w-[200px] bg-gray-200 overflow-hidden">
                                <?php if ($book->getPicture()): ?>
                                    <img src="<?= $book->getPicture(); ?>" alt="<?= htmlspecialchars($book->getTitle(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center bg-gray-300">
                                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
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
        <?php endif; ?>
    </div>
</div>