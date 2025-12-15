<?php
require_once 'connection.php';

session_start();

if (!isset($_GET["id"])) {
    header('Location: index.php');
    exit;
}

$id = $_GET["id"];

if (isset($_POST["product_id"])) {

    if (isset($_SESSION['winkelmand'])) {
        if (isset($_SESSION['winkelmand']['aantal'][$id])) {
            $_SESSION['winkelmand']['aantal'][$id] += 1;
        } else {
            $_SESSION['winkelmand']['aantal'][$id] = 1;
        }
    }


}


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
    <title>Monogram Row Bracelet - BIT LUX</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600;700&family=Montserrat:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <?php include('components/navbar.php') ?>


    <!-- Product Page Content -->
    <!-- Product Container -->
    <div class="product-container">
        <!-- Product Images Column -->
        <div class="product-images-column">
            <!-- Main Product Image -->
            <div class="product-image-wrapper">
                <img src="<?= $product['foto1']; ?>" alt="Monogram Row Bracelet" class="product-image">

                <!-- Desktop Wishlist Button (on photo) -->

                <!-- Mobile Carousel Counter -->
                <div class="carousel-counter">1 / 4</div>
            </div>

            <!-- Additional Images -->
            <div class="product-image-wrapper">
                <img src="<?= $product['foto2']; ?>" alt="Monogram Row Bracelet" class="product-image">
            </div>

            <div class="product-image-wrapper">
                <img src="<?= $product['foto3']; ?>" alt="Monogram Row Bracelet" class="product-image">
            </div>

        </div>

        <!-- Product Info Column -->
        <div class="product-info-column">
            <!-- Product Header (Code + Title + Mobile Wishlist) -->
            <div class="product-info-header">
                <div class="product-info-left">
                    <div class="product-code"><?= $product['id']; ?></div>
                    <h1 class="product-title"><?= $product['naam'];
                    var_dump(($_SESSION['winkelmand']['aantal'][$id])) ?></h1>
                </div>

                <button class="wishlist-btn-product">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path
                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                    </svg>
                </button>

                <!-- Mobile Wishlist Button (next to title) -->
                <button class="wishlist-btn-mobile">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path
                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                    </svg>
                </button>
            </div>

            <!-- Price -->
            <p class="product-price"><?= $product['prijs']; ?>€</p>

            <div class="product-actions">
                <form action="#" method="post">
                    <button class="add-to-bag-btn" name="product_id" value="<?= $product['id'] ?>">Add to shopping
                        bag</button>
                </form>
                <div class="contact-advisor">Contact an Advisor</div>
            </div>

            <p class="delivery-info">Order by noon for same day shipment</p>

            <!-- Product Description -->
            <div class="product-description">
                <?= $product['beschrijving']; ?>
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

    <?php include "components/footer.html" ?>

</body>

</html>