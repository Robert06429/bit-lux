<?php
require_once 'components/connection.php';

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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600;700&family=Montserrat:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="product-page">
    
    <!-- Include Navbar -->
    <?php include './components/navbar.php'; ?>

    <!-- Product Container -->
    <div class="product-container">
        <!-- Product Images Column -->
        <div class="product-images-column">
            <!-- Main Product Image -->
            <div class="product-image-wrapper">
                <img src="<?= htmlspecialchars($product['foto1']); ?>" alt="<?= htmlspecialchars($product['naam']); ?>" class="product-image">

                <!-- Mobile Carousel Counter -->
                <div class="carousel-counter">1 / 3</div>
            </div>

            <!-- Additional Images -->
            <?php if (!empty($product['foto2'])): ?>
            <div class="product-image-wrapper">
                <img src="<?= htmlspecialchars($product['foto2']); ?>" alt="<?= htmlspecialchars($product['naam']); ?>" class="product-image">
            </div>
            <?php endif; ?>

            <?php if (!empty($product['foto3'])): ?>
            <div class="product-image-wrapper">
                <img src="<?= htmlspecialchars($product['foto3']); ?>" alt="<?= htmlspecialchars($product['naam']); ?>" class="product-image">
            </div>
            <?php endif; ?>
        </div>

        <!-- Product Info Column -->
        <div class="product-info-column">
            <!-- Product Header (Code + Title + Mobile Wishlist) -->
            <div class="product-info-header">
                <div class="product-info-left">
                    <div class="product-code"><?= htmlspecialchars($product['id']); ?></div>
                    <h1 class="product-title"><?= htmlspecialchars($product['naam']); ?></h1>
                </div>

                <!-- Desktop Wishlist Button -->
                <button class="wishlist-btn-product" onclick="addToWishlist(<?= $product['id']; ?>)">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path
                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                    </svg>
                </button>

                <!-- Mobile Wishlist Button -->
                <button class="wishlist-btn-mobile" onclick="addToWishlist(<?= $product['id']; ?>)">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path
                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                    </svg>
                </button>
            </div>

            <!-- Price -->
            <p class="product-price">€<?= number_format($product['prijs'], 2, ',', '.'); ?></p>

            <div class="product-actions">
                <!-- Add to Cart Button -->
                <button class="add-to-bag-btn" onclick="addToCart(<?= $product['id']; ?>)">
                    Add to shopping bag
                </button>
                
                <div class="contact-advisor" onclick="openContact()">Contact an Advisor</div>
            </div>

            <p class="delivery-info">Order by noon for same day shipment</p>

            <!-- Product Description -->
            <div class="product-description">
                <?= nl2br(htmlspecialchars($product['beschrijving'])); ?>
            </div>

            <!-- Product Details Accordion -->
            <div class="product-details">
                <!-- In-store service -->
                <div class="accordion-item">
                    <button class="accordion-header" onclick="toggleAccordion(this)">
                        <span>In-store service</span>
                        <svg class="accordion-icon" width="16" height="16" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <line x1="8" y1="4" x2="8" y2="12" />
                            <line x1="4" y1="8" x2="12" y2="8" />
                        </svg>
                    </button>
                    <div class="accordion-content">
                        <p>Book an appointment with a Bit Lux Client Advisor in a Store.</p>
                    </div>
                </div>

                <!-- Delivery & Returns -->
                <div class="accordion-item">
                    <button class="accordion-header" onclick="toggleAccordion(this)">
                        <span>Delivery & Returns</span>
                        <svg class="accordion-icon" width="16" height="16" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <line x1="8" y1="4" x2="8" y2="12" />
                            <line x1="4" y1="8" x2="12" y2="8" />
                        </svg>
                    </button>
                    <div class="accordion-content">
                        <p>Free delivery and returns. All orders are dispatched from our European warehouse. Customs and
                            import duties are paid for all orders.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Footer -->
    <?php include './components/footer.php'; ?>

    <!-- Scripts -->
    <script src="./javascript/script.js"></script>
    <script src="./javascript/cart-wishlist.js"></script>
    

</body>
</html>