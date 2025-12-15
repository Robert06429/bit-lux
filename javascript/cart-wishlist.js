// cart-wishlist.js - Werkt samen met PHP sessies

// ===== ADD TO CART =====
function addToCart(productId) {
    fetch('./components/cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=add_to_cart&product_id=${productId}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update badge
            updateCartBadge(data.cart_count);
            
            // Update cart display
            updateCartDisplay(data.cart_items, data.cart_count);
            
            // Open cart automatisch - gebruik je bestaande openCart functie uit script.js
            const cartMenu = document.getElementById('cartMenu');
            const menuOverlay = document.getElementById('menuOverlay');
            if (cartMenu && menuOverlay) {
                cartMenu.classList.add('active');
                menuOverlay.classList.add('active');
                document.documentElement.style.overflowY = 'scroll';
                document.body.style.overflowY = 'hidden';
            }
        }
    })
    .catch(error => console.error('Error:', error));
}

// ===== ADD TO WISHLIST =====
function addToWishlist(productId) {
    fetch('./components/cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=add_to_wishlist&product_id=${productId}`
    })
    .then(response => response.json())
    .then(data => {
        // Update wishlist display altijd
        if (data.wishlist_items) {
            updateWishlistDisplay(data.wishlist_items);
        }
        
        // Toon altijd een notificatie
        if (data.success) {
            showNotification('✓ Toegevoegd aan wishlist!');
        } else {
            showNotification(data.message || '! Product zit al in wishlist');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('! Fout bij toevoegen');
    });
}

// ===== REMOVE FROM CART =====
function removeFromCart(productId) {
    fetch('./components/cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=remove_from_cart&product_id=${productId}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateCartBadge(data.cart_count);
            updateCartDisplay(data.cart_items, data.cart_count);
        }
    })
    .catch(error => console.error('Error:', error));
}

// ===== REMOVE FROM WISHLIST =====
function removeFromWishlist(productId) {
    fetch('./components/cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=remove_from_wishlist&product_id=${productId}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateWishlistDisplay(data.wishlist_items);
        }
    })
    .catch(error => console.error('Error:', error));
}

// ===== UPDATE QUANTITY =====
function updateQuantity(productId, quantity) {
    fetch('./components/cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=update_quantity&product_id=${productId}&quantity=${quantity}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateCartBadge(data.cart_count);
            updateCartDisplay(data.cart_items, data.cart_count);
        }
    })
    .catch(error => console.error('Error:', error));
}

function increaseQuantity(productId, currentQuantity) {
    updateQuantity(productId, currentQuantity + 1);
}

function decreaseQuantity(productId, currentQuantity) {
    if (currentQuantity > 1) {
        updateQuantity(productId, currentQuantity - 1);
    } else {
        removeFromCart(productId);
    }
}

// ===== UPDATE CART BADGE =====
function updateCartBadge(count) {
    const badge = document.getElementById('bagBadge');
    if (badge) {
        badge.textContent = count;
    }
}

// ===== UPDATE CART DISPLAY =====
function updateCartDisplay(items, totalCount) {
    const cartItemsContainer = document.getElementById('cartItems');
    const cartFooter = document.getElementById('cartFooter');
    const cartCount = document.getElementById('cartCount');
    const cartTotal = document.getElementById('cartTotal');
    
    if (!cartItemsContainer) return;
    
    // Update count
    if (cartCount) cartCount.textContent = totalCount;
    
    // Als cart leeg is
    if (!items || items.length === 0) {
        cartItemsContainer.innerHTML = `
            <div class="text-center py-16 px-8 text-gray-600">
                <p class="text-lg">Your shopping bag is empty</p>
                <p class="text-sm text-gray-500 mt-2">Add items to get started</p>
            </div>
        `;
        if (cartFooter) cartFooter.classList.add('hidden');
        return;
    }
    
    // Toon cart items
    cartItemsContainer.innerHTML = items.map(item => `
        <div class="flex gap-6 py-6 border-b border-gray-100">
            <img src="${item.foto}" alt="${item.naam}" class="w-40 h-40 object-cover bg-gray-100 flex-shrink-0">
            <div class="flex-1 flex flex-col">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <div class="text-xs text-gray-600 mb-1">${item.id}</div>
                        <div class="text-base font-medium">${item.naam}</div>
                    </div>
                    <button onclick="removeFromCart(${item.id})" class="hover:opacity-70 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <line x1="18" y1="6" x2="6" y2="18"/>
                            <line x1="6" y1="6" x2="18" y2="18"/>
                        </svg>
                    </button>
                </div>
                <div class="text-lg font-medium mt-auto mb-4">€${parseFloat(item.prijs).toFixed(2)}</div>
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-4 border border-gray-200 px-4 py-2">
                        <button onclick="decreaseQuantity(${item.id}, ${item.quantity})" class="hover:opacity-60 transition">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="2" y1="6" x2="10" y2="6"/>
                            </svg>
                        </button>
                        <span>${item.quantity}</span>
                        <button onclick="increaseQuantity(${item.id}, ${item.quantity})" class="hover:opacity-60 transition">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="6" y1="2" x2="6" y2="10"/>
                                <line x1="2" y1="6" x2="10" y2="6"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `).join('');
    
    // Bereken totaal
    const total = items.reduce((sum, item) => sum + (parseFloat(item.prijs) * item.quantity), 0);
    if (cartTotal) cartTotal.textContent = `€${total.toFixed(2)}`;
    if (cartFooter) cartFooter.classList.remove('hidden');
}

// ===== UPDATE WISHLIST DISPLAY =====
function updateWishlistDisplay(items) {
    const wishlistItemsContainer = document.getElementById('wishlistItems');
    const wishlistEmpty = document.getElementById('wishlistEmpty');
    
    if (!wishlistItemsContainer || !wishlistEmpty) return;
    
    if (!items || items.length === 0) {
        wishlistEmpty.classList.remove('hidden');
        wishlistItemsContainer.classList.add('hidden');
        return;
    }
    
    wishlistEmpty.classList.add('hidden');
    wishlistItemsContainer.classList.remove('hidden');
    
    wishlistItemsContainer.innerHTML = items.map(item => `
        <div class="flex gap-6 py-6 border-b border-gray-100">
            <img src="${item.foto}" alt="${item.naam}" class="w-40 h-40 object-cover bg-gray-100 flex-shrink-0">
            <div class="flex-1 flex flex-col">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <div class="text-xs text-gray-600 mb-1">${item.id}</div>
                        <div class="text-base font-medium">${item.naam}</div>
                    </div>
                    <button onclick="removeFromWishlist(${item.id})" class="hover:opacity-70 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <line x1="18" y1="6" x2="6" y2="18"/>
                            <line x1="6" y1="6" x2="18" y2="18"/>
                        </svg>
                    </button>
                </div>
                <div class="text-lg font-medium mt-auto mb-4">€${parseFloat(item.prijs).toFixed(2)}</div>
                <button onclick="addToCart(${item.id})" 
                        class="w-full bg-black text-white px-6 py-3 rounded-full text-sm font-medium hover:bg-gray-800 transition">
                    Add to Cart
                </button>
            </div>
        </div>
    `).join('');
}

// ===== LOAD CART & WISHLIST ON PAGE LOAD =====
function loadCartAndWishlist() {
    // Load cart
    fetch('./components/cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=get_cart'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateCartBadge(data.cart_count);
            // Alleen cart display updaten als we in het cart menu zijn
            if (document.getElementById('cartItems')) {
                updateCartDisplay(data.cart_items, data.cart_count);
            }
        }
    })
    .catch(error => console.error('Error loading cart:', error));
    
    // Load wishlist
    fetch('./components/cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=get_wishlist'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Alleen wishlist display updaten als we in het wishlist menu zijn
            if (document.getElementById('wishlistItems')) {
                updateWishlistDisplay(data.wishlist_items);
            }
        }
    })
    .catch(error => console.error('Error loading wishlist:', error));
}

// ===== NOTIFICATION =====
function showNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'fixed top-24 right-8 bg-black text-white px-6 py-4 rounded-lg shadow-lg z-[9999] transition-all duration-300';
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.opacity = '0';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// ===== INITIALISATIE - WERKT OP ALLE PAGINA'S =====
document.addEventListener('DOMContentLoaded', function() {
    // Laad altijd de cart badge, op elke pagina
    loadCartAndWishlist();
    
    // Update cart/wishlist wanneer menu opent
    const cartBtn = document.getElementById('cartBtn');
    if (cartBtn) {
        cartBtn.addEventListener('click', function() {
            // Reload cart data when opening
            setTimeout(() => {
                fetch('./components/cart.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'action=get_cart'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateCartDisplay(data.cart_items, data.cart_count);
                    }
                });
            }, 100);
        });
    }
    
    const wishlistBtn = document.getElementById('wishlistBtn');
    if (wishlistBtn) {
        wishlistBtn.addEventListener('click', function() {
            // Reload wishlist data when opening
            setTimeout(() => {
                fetch('./components/cart.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'action=get_wishlist'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateWishlistDisplay(data.wishlist_items);
                    }
                });
            }, 100);
        });
    }
});