 
<style>
/* Only essential CSS for .active states and navbar scroll */
.navbar.scrolled { 
    background: white !important; 
    box-shadow: 0 2px 8px rgba(139, 115, 85, 0.1); 
}
.navbar.scrolled .logo-image { filter: brightness(0) invert(0) !important; }
.navbar.scrolled .nav-icon { color: #1a1a1a !important; }
.navbar.scrolled .nav-link-item { color: #1a1a1a !important; }
.navbar.scrolled .bag-badge { background: #8B7355 !important; }

.side-menu.active { left: 0; }
.contact-menu.active, .create-account-menu.active { right: 0; }
.menu-overlay.active { opacity: 1; visibility: visible; }
.search-overlay.active { opacity: 1; visibility: visible; }

/* Force scrollbar to always be visible */
html {
    overflow-y: scroll;
}

/* Hide scrollbar ONLY for popups/menus, NOT for main page */
#sideMenu::-webkit-scrollbar,
#contactMenu::-webkit-scrollbar,
#accountMenu::-webkit-scrollbar,
#createAccountMenu::-webkit-scrollbar,
#cartMenu::-webkit-scrollbar,
#wishlistMenu::-webkit-scrollbar,
#searchOverlay::-webkit-scrollbar {
    display: none;
}

#sideMenu,
#contactMenu,
#accountMenu,
#createAccountMenu,
#cartMenu,
#wishlistMenu,
#searchOverlay {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>

<nav class="navbar fixed top-0 left-0 right-0 z-[1001] transition-all duration-400 bg-transparent" id="navbar">
    <div class="relative flex justify-between items-center px-8 py-6 pb-3 max-w-full overflow-x-clip">
        
        <div class="flex items-center gap-6 z-10">
            
            <button class="nav-icon text-white transition-colors duration-400 flex items-center gap-2 hover:opacity-70 cursor-pointer" id="menuBtn">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <line x1="3" y1="12" x2="21" y2="12"/>
                    <line x1="3" y1="18" x2="21" y2="18"/>
                </svg>
            </button>

            
            <button class="mobile-search-icon nav-icon text-white transition-colors duration-400 hover:opacity-70 cursor-pointer md:hidden" id="mobileSearchBtn">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8"/>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
            </button>

            
            <button class="desktop-search nav-icon text-white transition-colors duration-400 hidden md:flex items-center gap-2 hover:opacity-70 cursor-pointer" id="searchBtn">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8"/>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <span class="text-sm font-normal">Search</span>
            </button>
        </div>

        
        <div class="absolute left-1/2 transform -translate-x-1/2 flex justify-center items-center transition-all duration-400 pointer-events-none">
            <a href="/index.php" class="pointer-events-auto">
                <img src="./images/wittelogo.png" 
                     alt="Bit Lux" 
                     class="logo-image h-11 w-auto transition-all duration-400"
                     style="filter: brightness(0) invert(1);">
            </a>
        </div>

        
        <div class="flex items-center gap-6 z-10">
            <button class="nav-icon text-white transition-colors duration-400 hover:opacity-70 cursor-pointer hidden md:block" id="contactBtn">
                <span class="text-sm font-normal">Contact us</span>
            </button>

            <button class="nav-icon text-white transition-colors duration-400 hover:opacity-70 cursor-pointer hidden md:block" aria-label="Wishlist" id="wishlistBtn">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                </svg>
            </button>

            <button class="nav-icon text-white transition-colors duration-400 hover:opacity-70 cursor-pointer" aria-label="Account" id="accountBtn">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
            </button>

            <button class="nav-icon text-white transition-colors duration-400 hover:opacity-70 cursor-pointer relative" aria-label="Shopping Bag" id="cartBtn">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <path d="M16 10a4 4 0 0 1-8 0"/>
                </svg>
                <span class="bag-badge absolute -top-1.5 -right-1.5 bg-[#1a1a1a] text-white rounded-full w-3.5 h-3.5 flex items-center justify-center text-[0.6rem] font-semibold" id="cartCount">0</span>
            </button>
        </div>
    </div>

    
    <div class="hidden md:flex justify-center gap-8 px-8 py-3 w-full">
        <a href="collectie.php?gender[]=0" class="nav-link-item text-white text-sm font-medium no-underline hover:opacity-70 transition-all duration-300">Holiday Gifts for Her</a>
        <a href="collectie.php?gender=1" class="nav-link-item text-white text-sm font-medium no-underline hover:opacity-70 transition-all duration-300">Holiday Gifts for Him</a>
    </div>
</nav>

 
<div class="search-overlay fixed top-0 left-0 w-full h-screen bg-white z-[2001] opacity-0 invisible transition-all duration-400 overflow-y-auto" id="searchOverlay">
    
    <div class="flex justify-center items-center px-8 py-10 pb-8 border-b border-gray-200 relative">
        <img src="./images/wittelogo.png" 
             alt="BIT LUX" 
             class="h-11 w-auto block absolute left-1/2 transform -translate-x-1/2"
             style="filter: brightness(0);">
        <button class="absolute right-8 bg-none border-none cursor-pointer p-2 hover:opacity-60 transition" id="closeSearchBtn">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"/>
                <line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>
    </div>

    
    <div class="max-w-4xl mx-auto px-8 py-12 pb-8">
        <div class="relative">
            <input 
                type="text" 
                class="w-full px-6 py-3 border border-gray-300 rounded-full text-base outline-none focus:border-gray-900 transition" 
                placeholder="Search for Jewelry"
                autofocus
            >
        </div>

        
        <div class="flex flex-wrap justify-center gap-4 mt-8">
            <span class="px-6 py-2 border border-gray-200 rounded-2xl text-sm cursor-pointer hover:border-gray-900 hover:bg-gray-50 transition">TRENDING SEARCHES</span>
            <span class="px-6 py-2 border border-gray-200 rounded-2xl text-sm cursor-pointer hover:border-gray-900 hover:bg-gray-50 transition">Rings</span>
            <span class="px-6 py-2 border border-gray-200 rounded-2xl text-sm cursor-pointer hover:border-gray-900 hover:bg-gray-50 transition">Bracelet</span>
            <span class="px-6 py-2 border border-gray-200 rounded-2xl text-sm cursor-pointer hover:border-gray-900 hover:bg-gray-50 transition">Chains</span>
            <span class="px-6 py-2 border border-gray-200 rounded-2xl text-sm cursor-pointer hover:border-gray-900 hover:bg-gray-50 transition">Earrings</span>
        </div>
    </div>


</div>

<div class="menu-overlay fixed top-0 left-0 w-full h-screen bg-black bg-opacity-60 z-[1999] opacity-0 invisible transition-all duration-400" id="menuOverlay"></div>

 
<div class="side-menu fixed top-0 -left-full w-full max-w-[420px] h-screen bg-white z-[2000] transition-all duration-500 overflow-y-auto shadow-[4px_0_30px_rgba(0,0,0,0.2)]" id="sideMenu">
    <div class="p-8">
        <button class="mb-8 hover:opacity-70 transition cursor-pointer" id="closeMenuBtn">
            <svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"/>
                <line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>

        <div class="space-y-2">
            <a href="/collectie.php" class="block text-base font-medium py-4 border-b border-gray-100 cursor-pointer hover:pl-4 hover:text-[#8B7355] transition-all">Holiday Gifts for Her</a>
            <div class="block text-base font-medium py-4 border-b border-gray-100 cursor-pointer hover:pl-4 hover:text-[#8B7355] transition-all">Holiday Gifts for Him</div>
            <div class="block text-base font-medium py-4 border-b border-gray-100 cursor-pointer hover:pl-4 hover:text-[#8B7355] transition-all">Wedding Rings</div>
            <div class="block text-base font-medium py-4 border-b border-gray-100 cursor-pointer hover:pl-4 hover:text-[#8B7355] transition-all">Chains</div>
            <div class="block text-base font-medium py-4 border-b border-gray-100 cursor-pointer hover:pl-4 hover:text-[#8B7355] transition-all">Rings</div>
            <div class="block text-base font-medium py-4 border-b border-gray-100 cursor-pointer hover:pl-4 hover:text-[#8B7355] transition-all">Bracelets</div>
            <div class="block text-base font-medium py-4 border-b border-gray-100 cursor-pointer hover:pl-4 hover:text-[#8B7355] transition-all">Earrings</div>
            <div class="block text-base font-medium py-4 border-b border-gray-100 cursor-pointer hover:pl-4 hover:text-[#8B7355] transition-all">Silver Collection</div>
            <div class="block text-base font-medium py-4 border-b border-gray-100 cursor-pointer hover:pl-4 hover:text-[#8B7355] transition-all">Gold Collection</div>
        </div>

        <div class="mt-12">
            <div class="space-y-4 text-sm">
                <a href="#" class="block hover:text-[#8B7355] transition">Customer Service</a>
                <a href="#" class="block hover:text-[#8B7355] transition" id="menuContactBtn">Contact us</a>
                <a href="#" class="block hover:text-[#8B7355] transition">Stores</a>
                <a href="#" class="block hover:text-[#8B7355] transition">About Bit Lux</a>
            </div>
        </div>
    </div>
</div>

 
<div class="contact-menu fixed top-0 -right-full w-full max-w-[500px] h-screen bg-white z-[2000] transition-all duration-500 overflow-y-auto shadow-[-4px_0_30px_rgba(0,0,0,0.2)]" id="contactMenu">
    <div class="p-8">
        <div class="flex items-start justify-between mb-6">
            <h2 class="text-xl font-normal">Contact us</h2>
            <button class="hover:opacity-70 transition cursor-pointer" id="closeContactBtn">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <p class="mb-6 leading-relaxed text-sm text-[#8B7355]">
            Wherever you are, Bit Lux Client Advisors will be delighted to assist you
        </p>

        <div class="mb-8">
            <div class="flex items-center gap-4 py-4 border-b border-gray-100 cursor-pointer hover:text-[#8B7355] transition text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                </svg>
                <span>+31 207 219 441</span>
            </div>

            <div class="flex items-center gap-4 py-4 border-b border-gray-100 cursor-pointer hover:text-[#8B7355] transition text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                </svg>
                <div>
                    <div>Chat with an advisor</div>
                    <div class="text-xs text-[#8B7355]">Available</div>
                </div>
            </div>

            <div class="flex items-center gap-4 py-4 border-b border-gray-100 cursor-pointer hover:text-[#8B7355] transition text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                    <polyline points="22,6 12,13 2,6"/>
                </svg>
                <span>Send an Email</span>
            </div>
        </div>

        <div class="pt-6 border-t border-gray-200">
            <h3 class="font-medium mb-4 text-sm">Need Help ?</h3>
            <div class="space-y-3">
                <a href="#" class="block text-sm hover:text-[#8B7355] transition">FAQ</a>
                <a href="#" class="block text-sm hover:text-[#8B7355] transition">CARE SERVICES</a>
                <a href="#" class="block text-sm hover:text-[#8B7355] transition">Locate stores</a>
            </div>
        </div>
    </div>
</div>

 
<div class="contact-menu fixed top-0 -right-full w-full max-w-[500px] h-screen bg-white z-[2000] transition-all duration-500 overflow-y-auto shadow-[-4px_0_30px_rgba(0,0,0,0.2)]" id="accountMenu">
    <div class="p-8">
        <div class="flex items-start justify-between mb-8">
            <h2 class="text-xl font-normal">My Email</h2>
            <button class="hover:opacity-70 transition cursor-pointer" id="closeAccountBtn">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <div class="pb-8 border-b border-gray-200 mb-8">
            <h3 class="text-base font-normal mb-6">I already have an account</h3>
            
            <div class="text-right text-xs text-gray-600 mb-4">Mandatory fields*</div>
            <form action="components/login.php" method="post">
            <div class="mb-4">
                <label class="block text-sm text-gray-900 mb-2">Login*</label>
                <input type="email"  name="username" class="w-full px-4 py-3 border border-gray-300 text-sm focus:outline-none focus:border-gray-900 transition">
            </div>

            <div class="mb-4">
                <label class="block text-sm text-gray-900 mb-2">Password*</label>
                <input type="password"  name="password" class="w-full px-4 py-3 border border-gray-300 text-sm focus:outline-none focus:border-gray-900 transition">
            </div>

            <div class="mb-6">
                <a href="#" class="text-sm underline hover:text-[#8B7355] transition">Forgot your password?</a>
            </div>

            <div class="mb-6 text-sm text-gray-600">
                Or use a one-time login link to Sign In <a href="#" class="underline hover:text-[#8B7355] transition">Email me the link</a>
            </div>

            <button class="w-full bg-black text-white px-8 py-4 border-none rounded-full text-sm font-medium cursor-pointer hover:bg-gray-800 transition">Continue</button>
            </form>
        </div>

        <div>
            <h3 class="text-base font-normal mb-4">I don't have an account</h3>
            <p class="text-sm text-gray-600 mb-6">Enjoy added benefits and richer experience by creating a personal account.</p>
            <button class="create-account-btn w-full bg-white text-black px-8 py-4 border border-gray-900 rounded-full text-sm font-medium cursor-pointer hover:bg-gray-50 transition">Create an account</button>
        </div>
    </div>
</div>

 
<div class="create-account-menu fixed top-0 -right-full w-full max-w-[500px] h-screen bg-white z-[2000] transition-all duration-400 overflow-y-auto shadow-[-4px_0_30px_rgba(0,0,0,0.2)]" id="createAccountMenu">
    <div class="p-8 border-b border-gray-100 flex justify-between items-center">
        <h2 class="text-2xl font-normal">Create an account</h2>
        <button class="hover:opacity-70 transition cursor-pointer" id="closeCreateAccountBtn">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"/>
                <line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>
    </div>

    <div class="p-8">
        <p class="text-sm text-gray-600 leading-relaxed mb-8">Enjoy added benefits and richer experience by creating a personal account.</p>

        <form>
            <div class="mb-6">
                <label class="block text-sm text-gray-900 mb-2">Email address *</label>
                <input type="email" class="w-full px-4 py-3 border border-gray-300 text-sm focus:outline-none focus:border-gray-900 transition" placeholder="Email">
            </div>

            <div class="mb-6">
                <label class="block text-sm text-gray-900 mb-2">Password *</label>
                <input type="password" class="w-full px-4 py-3 border border-gray-300 text-sm focus:outline-none focus:border-gray-900 transition" placeholder="Password">
            </div>

            <div class="mb-6">
                <label class="block text-sm text-gray-900 mb-2">First name *</label>
                <input type="text" class="w-full px-4 py-3 border border-gray-300 text-sm focus:outline-none focus:border-gray-900 transition" placeholder="First name">
            </div>

            <div class="mb-6">
                <label class="block text-sm text-gray-900 mb-2">Last name *</label>
                <input type="text" class="w-full px-4 py-3 border border-gray-300 text-sm focus:outline-none focus:border-gray-900 transition" placeholder="Last name">
            </div>

            <button type="submit" class="w-full bg-black text-white px-8 py-4 border-none rounded-full text-sm font-medium cursor-pointer hover:bg-gray-800 transition">Create an account</button>
        </form>

        <div class="mt-8 pt-8 border-t border-gray-200">
            <p class="text-sm text-gray-600 text-center">
                Already have an account? 
                <a href="#" id="backToSignIn" class="text-gray-900 underline">Sign in</a>
            </p>
        </div>
    </div>
</div>

 
<div class="contact-menu fixed top-0 -right-full w-full max-w-[500px] h-screen bg-white z-[2000] transition-all duration-500 overflow-y-auto shadow-[-4px_0_30px_rgba(0,0,0,0.2)]" id="cartMenu">
    <div class="p-8">
        <div class="flex items-start justify-between mb-8">
            <h2 class="text-xl font-normal">Your shopping bag (<span id="cartCount">0</span>)</h2>
            <button class="hover:opacity-70 transition cursor-pointer" id="closeCartBtn">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <div id="cartItems">
            
        </div>

        <div id="cartFooter" class="hidden">
            <div class="flex justify-between items-center py-8 text-lg font-medium">
                <span>Total</span>
                <span id="cartTotal">$0.00</span>
            </div>
            <button class="w-full bg-black text-white px-8 py-5 border-none rounded-full text-base font-medium cursor-pointer hover:bg-gray-800 transition">View your Shopping Cart</button>
        </div>
    </div>
</div>

 
<div class="contact-menu fixed top-0 -right-full w-full max-w-[500px] h-screen bg-white z-[2000] transition-all duration-500 overflow-y-auto shadow-[-4px_0_30px_rgba(0,0,0,0.2)]" id="wishlistMenu">
    <div class="p-8">
        <div class="flex items-start justify-between mb-8">
            <h2 class="text-xl font-normal">Your wishlist</h2>
            <button class="hover:opacity-70 transition cursor-pointer" id="closeWishlistBtn">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <div class="text-center py-16 px-8 text-gray-600" id="wishlistEmpty">
            <p class="text-lg mb-4">Your wishlist is empty!</p>
            <p class="text-sm text-gray-600 mb-2">Add your favorite items and share them.</p>
            <p class="text-sm text-gray-600 mb-6">Need inspiration?</p>
            <button class="w-full bg-black text-white px-8 py-4 border-none rounded-full text-sm font-medium cursor-pointer hover:bg-gray-800 transition">Sign in</button>
        </div>

        <div id="wishlistItems" class="hidden">
            
        </div>
    </div>
</div>

