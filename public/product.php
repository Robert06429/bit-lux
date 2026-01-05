<?php
require_once './components/connection.php';

session_start();

if (!isset($_GET["id"])) {
    header('Location: index.php');
    exit;
}

$id = $_GET["id"];

$stmt = $pdo->prepare("SELECT * FROM product WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['naam']); ?> - BIT LUX</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body class="bg-white">

    
    <div class="bg-black"> <?php include './components/navbar.php'; ?></div>

    
    <div class="flex items-start gap-0 mt-24 max-w-screen overflow-x-hidden">
        
        <div class="w-full lg:w-[55%] flex-shrink-0 relative">
            
            <div id="imageCarousel" class="relative overflow-hidden">
                
                <div id="carouselTrack" class="flex transition-transform duration-500 ease-in-out">
                    
                    <div class="w-full h-[700px] bg-gray-50 flex-shrink-0">
                        <img src="<?= htmlspecialchars($product['foto1']); ?>"
                            alt="<?= htmlspecialchars($product['naam']); ?>" class="w-full h-full object-cover">
                    </div>

                    
                    <?php if (!empty($product['foto2'])): ?>
                        <div class="w-full h-[700px] bg-gray-50 flex-shrink-0">
                            <img src="<?= htmlspecialchars($product['foto2']); ?>"
                                alt="<?= htmlspecialchars($product['naam']); ?>" class="w-full h-full object-cover">
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($product['foto3'])): ?>
                        <div class="w-full h-[700px] bg-gray-50 flex-shrink-0">
                            <img src="<?= htmlspecialchars($product['foto3']); ?>"
                                alt="<?= htmlspecialchars($product['naam']); ?>" class="w-full h-full object-cover">
                        </div>
                    <?php endif; ?>
                </div>

                
                <button id="prevBtn"
                    class="hidden lg:flex absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/90 hover:bg-white rounded-full items-center justify-center shadow-lg transition z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                
                <button id="nextBtn"
                    class="hidden lg:flex absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/90 hover:bg-white rounded-full items-center justify-center shadow-lg transition z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                
                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-10">
                    <button class="carousel-dot w-2 h-2 rounded-full bg-white transition" data-index="0"></button>
                    <?php if (!empty($product['foto2'])): ?>
                        <button class="carousel-dot w-2 h-2 rounded-full bg-white/50 transition" data-index="1"></button>
                    <?php endif; ?>
                    <?php if (!empty($product['foto3'])): ?>
                        <button class="carousel-dot w-2 h-2 rounded-full bg-white/50 transition" data-index="2"></button>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="hidden lg:block w-full lg:w-[45%] px-14 py-12 sticky top-24 self-start h-fit bg-white">
            
            <div class="relative">
                <div class="pr-12">
                    <div class="text-xs text-gray-500 mb-2 uppercase tracking-wider">
                        <?= htmlspecialchars($product['id']); ?>
                    </div>
                    <h1 class="text-3xl font-light mb-4">
                        <?= htmlspecialchars($product['naam']); ?>
                    </h1>
                </div>

                
                <button onclick="addToWishlist(<?= $product['id']; ?>)"
                    class="absolute top-0 right-0 p-2 hover:opacity-70 transition">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path
                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                    </svg>
                </button>
            </div>

            
            <p class="text-base mb-6">
                €<?= number_format($product['prijs'], 2, ',', '.'); ?>
            </p>

            
            <div class="space-y-3 mb-6">
                
                <button onclick="addToCart(<?= $product['id']; ?>)"
                    class="w-full bg-black text-white py-4 text-sm font-medium hover:bg-gray-800 transition rounded-full">
                    Add to shopping bag
                </button>

                
                <button onclick="openContact()"
                    class="w-full text-center text-sm underline hover:opacity-70 transition">
                    Contact an Advisor
                </button>
            </div>

            
            <p class="text-sm text-gray-600 mb-6">
                Order by noon for same day shipment
            </p>

            
            <div class="text-sm leading-relaxed text-gray-700 mb-4">
                <?= nl2br(htmlspecialchars($product['beschrijving'])); ?>
            </div>

            
            <div class="border-t border-gray-200">
                
                <div class="border-b border-gray-200">
                    <button onclick="toggleAccordion(this)"
                        class="w-full flex justify-between items-center py-5 text-left hover:opacity-70 transition">
                        <span class="text-sm font-medium">In-store service</span>
                        <svg class="accordion-icon w-4 h-4 transition-transform duration-300" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <line x1="8" y1="4" x2="8" y2="12" />
                            <line x1="4" y1="8" x2="12" y2="8" />
                        </svg>
                    </button>
                    <div class="accordion-content max-h-0 overflow-hidden transition-all duration-300">
                        <p class="text-sm text-gray-600 pb-5">
                            Book an appointment with a Bit Lux Client Advisor in a Store.
                        </p>
                    </div>
                </div>

                
                <div class="border-b border-gray-200">
                    <button onclick="toggleAccordion(this)"
                        class="w-full flex justify-between items-center py-5 text-left hover:opacity-70 transition">
                        <span class="text-sm font-medium">Delivery & Returns</span>
                        <svg class="accordion-icon w-4 h-4 transition-transform duration-300" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <line x1="8" y1="4" x2="8" y2="12" />
                            <line x1="4" y1="8" x2="12" y2="8" />
                        </svg>
                    </button>
                    <div class="accordion-content max-h-0 overflow-hidden transition-all duration-300">
                        <p class="text-sm text-gray-600 pb-5">
                            Free delivery and returns. All orders are dispatched from our European warehouse.
                            Customs and import duties are paid for all orders.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="lg:hidden w-full px-6 py-8 bg-white -mt-20 rounded-t-3xl relative z-10">
            
            <div class="flex justify-between items-start mb-3">
                <div class="flex-1">
                    <div class="text-xs text-gray-500 mb-2 uppercase tracking-wider">
                        <?= htmlspecialchars($product['id']); ?>
                    </div>
                    <h1 class="text-2xl font-light">
                        <?= htmlspecialchars($product['naam']); ?>
                    </h1>
                </div>

                
                <button onclick="addToWishlist(<?= $product['id']; ?>)" class="ml-4 p-2">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path
                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                    </svg>
                </button>
            </div>

            
            <p class="text-lg mb-4">
                €<?= number_format($product['prijs'], 2, ',', '.'); ?>
            </p>

            
            <div class="space-y-2 mb-4">
                <button onclick="addToCart(<?= $product['id']; ?>)"
                    class="w-full bg-black text-white py-4 text-sm font-medium hover:bg-gray-800 transition rounded-full">
                    Add to shopping bag
                </button>

                <button onclick="openContact()"
                    class="w-full text-center text-sm underline hover:opacity-70 transition">
                    Contact an Advisor
                </button>
            </div>

            
            <p class="text-sm text-gray-600 mb-4">
                Order by noon for same day shipment
            </p>

            
            <div class="text-sm leading-relaxed text-gray-700 mb-3">
                <?= nl2br(htmlspecialchars($product['beschrijving'])); ?>
            </div>

            
            <div class="border-t border-gray-200">
                
                <div class="border-b border-gray-200">
                    <button onclick="toggleAccordion(this)"
                        class="w-full flex justify-between items-center py-4 text-left">
                        <span class="text-sm font-medium">In-store service</span>
                        <svg class="accordion-icon w-4 h-4 transition-transform duration-300" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <line x1="8" y1="4" x2="8" y2="12" />
                            <line x1="4" y1="8" x2="12" y2="8" />
                        </svg>
                    </button>
                    <div class="accordion-content max-h-0 overflow-hidden transition-all duration-300">
                        <p class="text-sm text-gray-600 pb-4">
                            Book an appointment with a Bit Lux Client Advisor in a Store.
                        </p>
                    </div>
                </div>

                
                <div class="border-b border-gray-200">
                    <button onclick="toggleAccordion(this)"
                        class="w-full flex justify-between items-center py-4 text-left">
                        <span class="text-sm font-medium">Delivery & Returns</span>
                        <svg class="accordion-icon w-4 h-4 transition-transform duration-300" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <line x1="8" y1="4" x2="8" y2="12" />
                            <line x1="4" y1="8" x2="12" y2="8" />
                        </svg>
                    </button>
                    <div class="accordion-content max-h-0 overflow-hidden transition-all duration-300">
                        <p class="text-sm text-gray-600 pb-4">
                            Free delivery and returns. All orders are dispatched from our European warehouse.
                            Customs and import duties are paid for all orders.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <?php include './components/footer.php'; ?>

    

    <script>
        // Accordion toggle function
        function toggleAccordion(button) {
            const content = button.nextElementSibling;
            const icon = button.querySelector('.accordion-icon');
            const isOpen = content.style.maxHeight && content.style.maxHeight !== '0px';

            // Close all accordions
            document.querySelectorAll('.accordion-content').forEach(item => {
                item.style.maxHeight = '0px';
            });
            document.querySelectorAll('.accordion-icon').forEach(item => {
                item.classList.remove('rotate-45');
            });

            // Open clicked accordion if it wasn't open
            if (!isOpen) {
                content.style.maxHeight = content.scrollHeight + 'px';
                icon.classList.add('rotate-45');
            }
        }

        // Carousel functionality
        const carouselTrack = document.getElementById('carouselTrack');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const dots = document.querySelectorAll('.carousel-dot');
        let currentIndex = 0;
        const totalSlides = dots.length;

        function updateCarousel() {
            // Move carousel
            carouselTrack.style.transform = `translateX(-${currentIndex * 100}%)`;

            // Update dots
            dots.forEach((dot, index) => {
                if (index === currentIndex) {
                    dot.classList.remove('bg-white/50');
                    dot.classList.add('bg-white');
                } else {
                    dot.classList.remove('bg-white');
                    dot.classList.add('bg-white/50');
                }
            });

            // Show/hide buttons
            if (currentIndex === 0) {
                prevBtn.classList.add('hidden', 'lg:hidden');
            } else {
                prevBtn.classList.remove('hidden', 'lg:hidden');
                prevBtn.classList.add('lg:flex');
            }

            if (currentIndex === totalSlides - 1) {
                nextBtn.classList.add('hidden', 'lg:hidden');
            } else {
                nextBtn.classList.remove('hidden', 'lg:hidden');
                nextBtn.classList.add('lg:flex');
            }
        }

        // Previous button
        prevBtn.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                updateCarousel();
            }
        });

        // Next button
        nextBtn.addEventListener('click', () => {
            if (currentIndex < totalSlides - 1) {
                currentIndex++;
                updateCarousel();
            }
        });

        // Dot navigation
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentIndex = index;
                updateCarousel();
            });
        });

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft' && currentIndex > 0) {
                currentIndex--;
                updateCarousel();
            } else if (e.key === 'ArrowRight' && currentIndex < totalSlides - 1) {
                currentIndex++;
                updateCarousel();
            }
        });

        // Touch/swipe support for mobile
        let touchStartX = 0;
        let touchEndX = 0;

        carouselTrack.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        });

        carouselTrack.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });

        function handleSwipe() {
            if (touchEndX < touchStartX - 50 && currentIndex < totalSlides - 1) {
                // Swipe left - next
                currentIndex++;
                updateCarousel();
            }
            if (touchEndX > touchStartX + 50 && currentIndex > 0) {
                // Swipe right - previous
                currentIndex--;
                updateCarousel();
            }
        }

        // Initialize
        updateCarousel();
    </script>

    <script>
        // Detecteer of dit de product pagina is
        const isProductPage = window.location.pathname.includes('product.php');

        if (isProductPage) {
            const navbar = document.getElementById('navbar');

            // Maak navbar meteen wit
            navbar.classList.add('bg-white', 'shadow-md');
            navbar.classList.remove('bg-transparent');

            // Maak alle icons en text zwart
            navbar.querySelectorAll('.nav-icon, .nav-link-item').forEach(el => {
                el.classList.remove('text-white');
                el.classList.add('text-[#1a1a1a]');
            });

            // Maak logo zwart
            const logo = navbar.querySelector('.logo-image');
            logo.style.filter = 'brightness(0)';

            // Maak badge goud
            const badge = navbar.querySelector('.bag-badge');
            badge.classList.remove('bg-[#1a1a1a]');
            badge.classList.add('bg-[#8B7355]');
        }
    </script>


    <script src="./javascript/script.js"></script>
    <script src="./javascript/cart-wishlist.js"></script>

</body>

</html>