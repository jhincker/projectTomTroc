<div class="flex flex-col">
    <div id="title-searchbar" class="flex justify-between items-center pt-16 pb-8">
        <div class="" id="h2-ourBooks">
            <h2 class="text-2xl font-serif pl-28">Nos livres à l'échange</h2>
        </div>
        <form action="index.php" method="GET" class="relative pr-28">

            <input type="hidden" name="action" value="showOurBooks">

            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <img src="images/iconSearch.png" alt="icône searchbar">
            </span>

            <input
                type="search"
                name="title"
                class="w-full border rounded-md pl-10 py-2 text-gray-700 placeholder-gray-400"
                placeholder="Rechercher un livre">
        </form>
    </div>

    <!-- Books Grid -->
    <div class="max-w-7xl mx-auto px-6 lg:px-8 pb-12">
        <?php if (empty($books)): ?>
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">Aucun livre disponible pour le moment.</p>
            </div>
        <?php else: ?>
            <div id="books-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <?php foreach ($books as $book): ?>
                    <div class="book-card bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden"
                        data-title="<?= strtolower(htmlspecialchars($book->getTitle())) ?>"
                        data-author="<?= strtolower(htmlspecialchars($book->getAuthor())) ?>"
                        data-content="<?= strtolower(htmlspecialchars($book->getContent())) ?>"
                        data-availability="<?= $book->getAvailability() ? 'disponible' : 'non dispo.' ?>">

                        <!-- Image du livre -->
                        <div class="aspect-[3/4] bg-gray-200 overflow-hidden">
                            <?php if ($book->getPicture()): ?>
                                <img src="data:image/jpeg;base64,<?= base64_encode($book->getPicture()) ?>"
                                    alt="<?= htmlspecialchars($book->getTitle()) ?>"
                                    class="w-full h-full object-cover">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center bg-gray-300">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Informations du livre -->
                        <div class="p-4">
                            <h3 class="font-serif text-lg font-semibold text-gray-800 mb-2 line-clamp-2">
                                <?= htmlspecialchars($book->getTitle()) ?>
                            </h3>
                            <p class="text-sm text-gray-600 mb-3">
                                par <?= htmlspecialchars($book->getAuthor()) ?>
                            </p>
                            <p class="text-sm text-gray-500 line-clamp-3 mb-4">
                                <?= htmlspecialchars(substr($book->getContent(), 0, 150)) ?>...
                            </p>

                            <!-- Livre vendu par : -->
                            <div class="flex items-center justify-between mb-4 text-sm">
                                <span>Vendu par : <?= $usernames[$book->getIdUser()]; ?></span>
                            </div>

                            <!-- Bouton voir détails -->
                            <a href="index.php?action=showUpdateBookForm&id=<?= $book->getId(); ?>"
                                class="block w-full text-center bg-[#00AC66] hover:bg-[#009955] text-white font-medium py-2 px-4 rounded-md transition-colors duration-200">
                                Voir les détails
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>