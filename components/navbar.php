<?php

require_once __DIR__ . '/../connection.php';



$id = $_SESSION['winkelmand']['aantal'];


$stmt = $pdo->prepare("SELECT * FROM product WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

?>

    <nav class="navbar" id="navbar">
        <div class="navbar-content">
            <!-- Left Side -->
            <div class="nav-left">
                <!-- Menu Button -->
                <button class="nav-icon flex items-center gap-2 hover:opacity-70 transition" id="menuBtn">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <line x1="3" y1="6" x2="21" y2="6" />
                        <line x1="3" y1="12" x2="21" y2="12" />
                        <line x1="3" y1="18" x2="21" y2="18" />
                    </svg>
                    <span class="hidden md:inline text-sm font-medium">Menu</span>
                </button>

                <!-- Mobile Search Icon -->
                <button class="mobile-search-icon nav-icon hover:opacity-70 transition" id="mobileSearchBtn">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                </button>

                <!-- Search - Desktop only -->
                <button class="desktop-search nav-icon flex items-center gap-2 hover:opacity-70 transition"
                    id="searchBtn">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                    <span class="text-sm font-medium">Search</span>
                </button>
            </div>

            <!-- Logo (Centered) -->
            <div class="logo-container">
                <a href="/index.html" class="nav-link-item">
                    <img src="./images/wittelogo.png" alt="Bit Lux" class="logo-image">
                </a>
            </div>


            <!-- Right Side -->
            <div class="nav-right">
                <button class="nav-icon hover:opacity-70 transition hidden md:block" id="contactBtn">
                    <span class="text-sm font-medium">Contact us</span>
                </button>

                <button class="nav-icon hover:opacity-70 transition" aria-label="Wishlist" id="wishlistBtn">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path
                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                    </svg>
                </button>

                <button class="nav-icon hover:opacity-70 transition" aria-label="Account" id="accountBtn">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                </button>

                <button class="nav-icon hover:opacity-70 transition relative" aria-label="Shopping Bag" id="cartBtn">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z" />
                        <line x1="3" y1="6" x2="21" y2="6" />
                        <path d="M16 10a4 4 0 0 1-8 0" />
                    </svg>
                    <span class="bag-badge" id="bagBadge">0</span>
                </button>
            </div>
        </div>

        <!-- Secondary Navigation Links (inside navbar) -->
        <div class="nav-links-secondary" id="navLinksSecondary">
            <a href="/collectie.php" class="nav-link-item">Holiday Gifts for Her</a>
            <a href="collectie.php" class="nav-link-item">Holiday Gifts for Him</a>
        </div>
    </nav>

    <!-- Mobile Hero -->
    <div class="mobile-hero-carousel">
        <video autoplay muted loop playsinline class="mobile-hero-video">
            <source src="./images/bannervideo.mp4" type="video/mp4">
        </video>
        <div class="mobile-hero-content">
            <h2 class="mobile-hero-title">Holiday Season Gift Ideas</h2>
            <p class="mobile-hero-subtitle">Bit Lux Enchanted World</p>
            <a href="#" class="mobile-hero-link">Discover</a>
        </div>
    </div>

    <!-- Search Overlay -->
    <div class="search-overlay" id="searchOverlay">
        <!-- Header with Logo and Close -->
        <div class="search-overlay-header">
            <img src="./images/wittelogo.png" alt="BIT LUX" class="search-overlay-logo">
            <button class="search-overlay-close" id="closeSearchBtn">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </div>

        <!-- Search Bar -->
        <div class="search-bar-container">
            <div class="search-bar-wrapper">
                <input type="text" class="search-overlay-input" placeholder="Search for Jewelry" autofocus>
            </div>

            <!-- Trending Search Tags -->
            <div class="search-tags">
                <span class="search-tag">TRENDING SEARCHES</span>
                <span class="search-tag">Rings</span>
                <span class="search-tag">Bracelet</span>
                <span class="search-tag">Chains</span>
                <span class="search-tag">Earrings</span>
            </div>
        </div>

        <!-- Footer -->
        <div class="search-footer">
            <p class="search-footer-text">Customer Service Available 7/7 on <a href="#" class="search-footer-link">+31
                    207 219 441</a></p>
            <p class="search-footer-text"><a href="#" class="search-footer-link">FAQs</a></p>
        </div>
    </div>

    <div class="menu-overlay" id="menuOverlay"></div>

    <!-- Side Menu (Left) -->
    <div class="side-menu" id="sideMenu">
        <div class="p-8">
            <!-- Close Button -->
            <button class="mb-8 hover:opacity-70 transition" id="closeMenuBtn">
                <svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>

            <!-- Menu Items -->
            <div class="space-y-2">
                <a href="/collectie.php" class="menu-item">Holiday Gifts for Her</a>
                <div class="menu-item">Holiday Gifts for Him</div>
                <div class="menu-item">Wedding Rings</div>
                <div class="menu-item">Chains</div>
                <div class="menu-item">Rings</div>
                <div class="menu-item">Bracelets</div>
                <div class="menu-item">Earrings</div>
                <div class="menu-item">Silver Collection</div>
                <div class="menu-item">Gold Collection</div>
            </div>

            <!-- Menu Footer -->
            <div class="mt-12">
                <div class="space-y-4 text-sm">
                    <a href="#" class="block hover:text-[var(--lv-gold)] transition">Customer Service</a>
                    <a href="#" class="block hover:text-[var(--lv-gold)] transition" id="menuContactBtn">Contact us</a>
                    <a href="#" class="block hover:text-[var(--lv-gold)] transition">Stores</a>
                    <a href="#" class="block hover:text-[var(--lv-gold)] transition">About Bit Lux</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Menu (Right) -->
    <div class="contact-menu" id="contactMenu">
        <div class="p-8">
            <!-- Header with title and close button -->
            <div class="flex items-start justify-between mb-6">
                <h2 class="text-xl font-normal">Contact us</h2>
                <button class="hover:opacity-70 transition" id="closeContactBtn">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
            </div>

            <!-- Description -->
            <p class="mb-6 leading-relaxed text-sm" style="color: #8B7355;">
                Wherever you are, Bit Lux Client Advisors will be delighted to assist you
            </p>

            <!-- Contact Options -->
            <div class="mb-8">
                <!-- Phone -->
                <div class="contact-item">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path
                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                    </svg>
                    <span>+31 207 219 441</span>
                </div>

                <!-- Chat -->
                <div class="contact-item">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                    </svg>
                    <div>
                        <div>Chat with an advisor</div>
                        <div class="text-xs" style="color: #8B7355;">Available</div>
                    </div>
                </div>

                <!-- Email -->
                <div class="contact-item">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                        <polyline points="22,6 12,13 2,6" />
                    </svg>
                    <span>Send an Email</span>
                </div>
            </div>

            <!-- Additional Links -->
            <div class="pt-6 border-t border-gray-200">
                <h3 class="font-medium mb-4 text-sm">Need Help ?</h3>
                <div class="space-y-3">
                    <a href="#" class="block text-sm hover:text-[var(--lv-gold)] transition">FAQ</a>
                    <a href="#" class="block text-sm hover:text-[var(--lv-gold)] transition">CARE SERVICES</a>
                    <a href="#" class="block text-sm hover:text-[var(--lv-gold)] transition">Locate stores</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Account/Login Menu (Right) -->
    <div class="contact-menu" id="accountMenu">
        <div class="p-8">
            <!-- Header with title and close button -->
            <div class="flex items-start justify-between mb-8">
                <h2 class="text-xl font-normal">My Email</h2>
                <button class="hover:opacity-70 transition" id="closeAccountBtn">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
            </div>

            <!-- Login Section -->
            <div class="login-section">
                <h3 class="text-base font-normal mb-6">I already have an account</h3>

                <div class="text-right text-xs text-gray-600 mb-4">Mandatory fields*</div>

                <!-- Login Form -->
                <form action="login.php" method="post">
                    <div class="mb-4">
                        <label class="form-label">Login*</label>
                        <input type="email" id="username" name="username" class="form-input">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Password*</label>
                        <input type="password" id="password" name="password" class="form-input">
                    </div>


                    <div class="mb-6">
                        <a href="#" class="text-sm underline hover:text-[var(--lv-gold)] transition">Forgot your
                            password?</a>
                    </div>

                    <div class="mb-6 text-sm text-gray-600">
                        Or use a one-time login link to Sign In <a href="#"
                            class="underline hover:text-[var(--lv-gold)] transition">Email me the link</a>
                    </div>

                    <button class="continue-btn" type="submit">Continue</button>
                    <div>
                        <?php if (!empty($errorMessage)): ?>
                            <div class="bg-red-600 text-white px-6 py-3 rounded shadow-lg m-4 text-center">
                                <?php echo htmlspecialchars($errorMessage)?>
                            </div>
                        <?php endif; ?>
                    </div>
                </form>
            </div>

            <!-- Create Account Section -->
            <div>
                <h3 class="text-base font-normal mb-4">I don't have an account</h3>
                <p class="text-sm text-gray-600 mb-6">Enjoy added benefits and richer experience by creating a personal
                    account.</p>
                <button class="create-account-btn">Create an account</button>
            </div>
        </div>
    </div>

    <!-- Create Account Menu (Right) -->
    <div class="create-account-menu" id="createAccountMenu">
        <div class="create-account-header">
            <h2 class="create-account-title">Create an account</h2>
            <button class="hover:opacity-70 transition" id="closeCreateAccountBtn">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </div>

        <div class="create-account-content">
            <p class="create-account-subtitle">Enjoy added benefits and richer experience by creating a personal
                account.</p>

            <form>
                <div class="form-group">
                    <label class="form-label">Email address *</label>
                    <input type="email" class="form-input" placeholder="Email">
                </div>

                <div class="form-group">
                    <label class="form-label">Password *</label>
                    <input type="password" class="form-input" placeholder="Password">
                </div>

                <div class="form-group">
                    <label class="form-label">First name *</label>
                    <input type="text" class="form-input" placeholder="First name">
                </div>

                <div class="form-group">
                    <label class="form-label">Last name *</label>
                    <input type="text" class="form-input" placeholder="Last name">
                </div>

                <button type="submit" class="continue-btn">Create an account</button>
            </form>

            <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #e5e5e5;">
                <p style="font-size: 0.875rem; color: #666; text-align: center;">
                    Already have an account?
                    <a href="#" id="backToSignIn" style="color: var(--lv-dark); text-decoration: underline;">Sign in</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Shopping Cart Menu (Right) -->
    <div class="contact-menu" id="cartMenu">
        <div class="p-8">
            <!-- Header with title and close button -->
            <div class="flex items-start justify-between mb-8">
                <h2 class="text-xl font-normal">Your shopping bag (<span id="cartCount">0</span>)</h2>
                <button class="hover:opacity-70 transition" id="closeCartBtn">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
            </div>

            <!-- Cart Items Container -->
            <div id="cartItems">
                <!-- Empty State -->
                <!-- <div class="cart-empty" id="cartEmpty">
                    <p class="text-lg">Your shopping bag is empty</p>
                    <p class="text-sm text-gray-500 mt-2">Add items to get started</p>
                </div> -->

                <!-- Example Cart Item (hidden by default) -->
                <div class="cart-item" style="display: none;">
                    <img src="https://via.placeholder.com/160" alt="Product" class="cart-item-image">
                    <div class="cart-item-details">
                        <div class="cart-item-header">
                            <div>
                                <div class="cart-item-code">M27216</div>
                                <div class="cart-item-name">Alma Trunk PM</div>
                            </div>
                            <svg class="wishlist-icon" width="20" height="20" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path
                                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                            </svg>
                        </div>
                        <div class="cart-item-meta">Color: Monogram</div>
                        <div class="cart-item-meta">Material: Monogram</div>
                        <div class="cart-item-price">$3,700.00</div>
                        <div class="cart-item-actions">
                            <div class="cart-quantity">
                                <!-- <button onclick="decreaseQuantity()"> -->
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <line x1="2" y1="6" x2="10" y2="6" />
                                </svg>
                                </button>
                                <span>1</span>
                                <!-- <button onclick="increaseQuantity()"> -->
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <line x1="6" y1="2" x2="6" y2="10" />
                                    <line x1="2" y1="6" x2="10" y2="6" />
                                </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cart Footer (shown when items exist) -->
            <div id="cartFooter" style="display: none;">
                <div class="cart-total">
                    <span>Total</span>
                    <span id="cartTotal">$0.00</span>
                </div>
                <button class="cart-checkout-btn">View your Shopping Cart</button>
            </div>
        </div>
    </div>

    <!-- Wishlist Menu (Right) -->
    <div class="contact-menu" id="wishlistMenu">
        <div class="p-8">
            <!-- Header with title and close button -->
            <div class="flex items-start justify-between mb-8">
                <h2 class="text-xl font-normal">Your wishlist</h2>
                <button class="hover:opacity-70 transition" id="closeWishlistBtn">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
            </div>

            <!-- Wishlist Empty State (when not logged in) -->
            <div class="cart-empty" id="wishlistEmpty">
                <p class="text-lg mb-4">Your wishlist is empty!</p>
                <p class="text-sm text-gray-600 mb-2">Add your favorite items and share them.</p>
                <p class="text-sm text-gray-600 mb-6">Need inspiration?</p>
                <button class="continue-btn">Sign in</button>
            </div>

            <!-- Wishlist Items (when logged in and has items) -->
            <div id="wishlistItems" style="display: none;">
                <!-- Wishlist items will be displayed here -->
            </div>
        </div>
    </div>
