// Add product-page class to html element if on product page
if (document.body.classList.contains('product-page')) {
    document.documentElement.classList.add('product-page');
}

// Navbar scroll effect (only for homepage, not product page)
const navbar = document.getElementById('navbar');

// Check if this is the homepage or product page
const isProductPage = document.body.classList.contains('product-page');

if (!isProductPage) {
    // Only add scroll effect for homepage
    window.addEventListener('scroll', () => {
        if (window.scrollY > 100) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
}

// Menu functionality
const menuBtn = document.getElementById('menuBtn');
const closeMenuBtn = document.getElementById('closeMenuBtn');
const sideMenu = document.getElementById('sideMenu');
const menuOverlay = document.getElementById('menuOverlay');

// Contact functionality
const contactBtn = document.getElementById('contactBtn');
const closeContactBtn = document.getElementById('closeContactBtn');
const contactMenu = document.getElementById('contactMenu');

// Account functionality
const accountBtn = document.getElementById('accountBtn');
const closeAccountBtn = document.getElementById('closeAccountBtn');
const accountMenu = document.getElementById('accountMenu');

// Cart functionality
const cartBtn = document.getElementById('cartBtn');
const closeCartBtn = document.getElementById('closeCartBtn');
const cartMenu = document.getElementById('cartMenu');

// Wishlist functionality
const wishlistBtn = document.getElementById('wishlistBtn');
const closeWishlistBtn = document.getElementById('closeWishlistBtn');
const wishlistMenu = document.getElementById('wishlistMenu');

// Search functionality
const searchBtn = document.getElementById('searchBtn');
const closeSearchBtn = document.getElementById('closeSearchBtn');
const searchOverlay = document.getElementById('searchOverlay');

function openMenu() {
    sideMenu.classList.add('active');
    menuOverlay.classList.add('active');
    document.body.style.overflow = 'hidden';
    // Force overflow-x hidden when popup is open
    document.documentElement.classList.add('popup-open');
    document.body.classList.add('popup-open');
}

function closeMenu() {
    sideMenu.classList.remove('active');
    menuOverlay.classList.remove('active');
    document.body.style.overflow = '';
    // Remove overflow-x hidden
    document.documentElement.classList.remove('popup-open');
    document.body.classList.remove('popup-open');
}

function openContact() {
    contactMenu.classList.add('active');
    menuOverlay.classList.add('active');
    document.body.style.overflow = 'hidden';
    document.documentElement.classList.add('popup-open');
    document.body.classList.add('popup-open');
}

function closeContact() {
    contactMenu.classList.remove('active');
    menuOverlay.classList.remove('active');
    document.body.style.overflow = '';
    document.documentElement.classList.remove('popup-open');
    document.body.classList.remove('popup-open');
}

function openAccount() {
    accountMenu.classList.add('active');
    menuOverlay.classList.add('active');
    document.body.style.overflow = 'hidden';
    document.documentElement.classList.add('popup-open');
    document.body.classList.add('popup-open');
}

function closeAccount() {
    accountMenu.classList.remove('active');
    menuOverlay.classList.remove('active');
    document.body.style.overflow = '';
    document.documentElement.classList.remove('popup-open');
    document.body.classList.remove('popup-open');
}

function openCart() {
    cartMenu.classList.add('active');
    menuOverlay.classList.add('active');
    document.body.style.overflow = 'hidden';
    document.documentElement.classList.add('popup-open');
    document.body.classList.add('popup-open');
}

function closeCart() {
    cartMenu.classList.remove('active');
    menuOverlay.classList.remove('active');
    document.body.style.overflow = '';
    document.documentElement.classList.remove('popup-open');
    document.body.classList.remove('popup-open');
}

function openWishlist() {
    wishlistMenu.classList.add('active');
    menuOverlay.classList.add('active');
    document.body.style.overflow = 'hidden';
    document.documentElement.classList.add('popup-open');
    document.body.classList.add('popup-open');
}

function closeWishlist() {
    wishlistMenu.classList.remove('active');
    menuOverlay.classList.remove('active');
    document.body.style.overflow = '';
    document.documentElement.classList.remove('popup-open');
    document.body.classList.remove('popup-open');
}

function openCreateAccount() {
    const createAccountMenu = document.getElementById('createAccountMenu');
    createAccountMenu.classList.add('active');
    accountMenu.classList.remove('active');
    menuOverlay.classList.add('active');
    document.body.style.overflow = 'hidden';
    document.documentElement.classList.add('popup-open');
    document.body.classList.add('popup-open');
}

function closeCreateAccount() {
    const createAccountMenu = document.getElementById('createAccountMenu');
    createAccountMenu.classList.remove('active');
    menuOverlay.classList.remove('active');
    document.body.style.overflow = '';
    document.documentElement.classList.remove('popup-open');
    document.body.classList.remove('popup-open');
}

function openSearch() {
    searchOverlay.classList.add('active');
    document.body.style.overflow = 'hidden';
    document.documentElement.classList.add('popup-open');
    document.body.classList.add('popup-open');
}

function closeSearch() {
    searchOverlay.classList.remove('active');
    document.body.style.overflow = '';
    document.documentElement.classList.remove('popup-open');
    document.body.classList.remove('popup-open');
}

// Event listeners
if (menuBtn) menuBtn.addEventListener('click', openMenu);
if (closeMenuBtn) closeMenuBtn.addEventListener('click', closeMenu);

if (contactBtn) contactBtn.addEventListener('click', openContact);
if (closeContactBtn) closeContactBtn.addEventListener('click', closeContact);

if (accountBtn) accountBtn.addEventListener('click', openAccount);
if (closeAccountBtn) closeAccountBtn.addEventListener('click', closeAccount);

if (cartBtn) cartBtn.addEventListener('click', openCart);
if (closeCartBtn) closeCartBtn.addEventListener('click', closeCart);

if (wishlistBtn) wishlistBtn.addEventListener('click', openWishlist);
if (closeWishlistBtn) closeWishlistBtn.addEventListener('click', closeWishlist);

// Create account functionality
const createAccountBtn = document.querySelector('.create-account-btn');
const closeCreateAccountBtn = document.getElementById('closeCreateAccountBtn');
const backToSignIn = document.getElementById('backToSignIn');

if (createAccountBtn) {
    createAccountBtn.addEventListener('click', (e) => {
        e.preventDefault();
        openCreateAccount();
    });
}

if (closeCreateAccountBtn) {
    closeCreateAccountBtn.addEventListener('click', closeCreateAccount);
}

if (backToSignIn) {
    backToSignIn.addEventListener('click', (e) => {
        e.preventDefault();
        closeCreateAccount();
        setTimeout(openAccount, 300);
    });
}

// Search functionality
if (searchBtn) searchBtn.addEventListener('click', openSearch);
if (closeSearchBtn) closeSearchBtn.addEventListener('click', closeSearch);

// Mobile search icon functionality
const mobileSearchBtn = document.getElementById('mobileSearchBtn');
if (mobileSearchBtn) {
    mobileSearchBtn.addEventListener('click', openSearch);
}

// Menu Contact button functionality
const menuContactBtn = document.getElementById('menuContactBtn');
if (menuContactBtn) {
    menuContactBtn.addEventListener('click', (e) => {
        e.preventDefault();
        closeMenu();
        setTimeout(openContact, 300);
    });
}

// Footer Contact button functionality
const footerContactBtn = document.getElementById('footerContactBtn');
if (footerContactBtn) {
    footerContactBtn.addEventListener('click', (e) => {
        e.preventDefault();
        openContact();
    });
}

// Country selector functionality
const countryBtn = document.getElementById('countryBtn');
const closeCountryBtn = document.getElementById('closeCountryBtn');
const countrySelector = document.getElementById('countrySelector');

function openCountrySelector() {
    if (countrySelector) {
        countrySelector.classList.add('active');
        document.body.style.overflow = 'hidden';
        document.documentElement.classList.add('popup-open');
        document.body.classList.add('popup-open');
    }
}

function closeCountrySelector() {
    if (countrySelector) {
        countrySelector.classList.remove('active');
        document.body.style.overflow = '';
        document.documentElement.classList.remove('popup-open');
        document.body.classList.remove('popup-open');
    }
}

if (countryBtn) countryBtn.addEventListener('click', openCountrySelector);
if (closeCountryBtn) closeCountryBtn.addEventListener('click', closeCountrySelector);

// Menu overlay click
if (menuOverlay) {
    menuOverlay.addEventListener('click', () => {
        closeMenu();
        closeContact();
        closeAccount();
        closeCart();
        closeWishlist();
        closeCreateAccount();
    });
}

// Close menus on escape key
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        closeMenu();
        closeContact();
        closeAccount();
        closeCart();
        closeWishlist();
        closeSearch();
        closeCountrySelector();
        closeCreateAccount();
    }
});

// Cart quantity functions
function increaseQuantity() {
    console.log('Increase quantity');
}

function decreaseQuantity() {
    console.log('Decrease quantity');
}

// Product page specific functionality
if (isProductPage) {
    // Accordion functionality
    window.toggleAccordion = function(header) {
        const content = header.nextElementSibling;
        const icon = header.querySelector('.accordion-icon');
        const allContents = document.querySelectorAll('.accordion-content');
        const allIcons = document.querySelectorAll('.accordion-icon');
        
        allContents.forEach(item => {
            if (item !== content) {
                item.classList.remove('active');
            }
        });
        
        allIcons.forEach(item => {
            if (item !== icon) {
                item.classList.remove('active');
            }
        });
        
        content.classList.toggle('active');
        icon.classList.toggle('active');
    };

    // Carousel slide counter update on scroll (Mobile only)
    if (window.innerWidth <= 1024) {
        const imagesColumn = document.querySelector('.product-images-column');
        const currentSlideSpan = document.querySelector('.current-slide');
        
        if (imagesColumn && currentSlideSpan) {
            imagesColumn.addEventListener('scroll', () => {
                const scrollLeft = imagesColumn.scrollLeft;
                const width = imagesColumn.offsetWidth;
                const currentIndex = Math.round(scrollLeft / width) + 1;
                currentSlideSpan.textContent = currentIndex;
            });
        }
    }
}

// Mobile Product Image Carousel Counter
const productImagesColumn = document.querySelector('.product-images-column');
const carouselCounter = document.querySelector('.carousel-counter');

if (productImagesColumn && carouselCounter) {
    const imageWrappers = productImagesColumn.querySelectorAll('.product-image-wrapper');
    const totalImages = imageWrappers.length;
    
    productImagesColumn.addEventListener('scroll', () => {
        const scrollLeft = productImagesColumn.scrollLeft;
        const imageWidth = imageWrappers[0].offsetWidth;
        const currentIndex = Math.round(scrollLeft / imageWidth) + 1;
        
        carouselCounter.textContent = `${currentIndex} / ${totalImages}`;
    });
}

