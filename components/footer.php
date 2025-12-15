<!-- Footer Component -->
<footer class="relative bg-white border-t border-gray-200">
    <!-- Footer Cards Section -->
    <div class="max-w-full pt-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-0 mb-16">
            <!-- Card 1 -->
            <div class="flex justify-between items-start p-8 border-b md:border-b-0 md:border-r border-gray-200 hover:bg-gray-50 transition-colors duration-300 cursor-pointer">
                <div>
                    <h3 class="font-medium text-base mb-1 transition-colors duration-300">In-Store Appointment</h3>
                    <p class="text-sm text-gray-600">Discover the possibilities of a tailor-made visit</p>
                </div>
                <svg class="w-5 h-5 text-gray-600 flex-shrink-0 ml-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </div>

            <!-- Card 2 -->
            <div class="flex justify-between items-start p-8 border-b md:border-b-0 md:border-r border-gray-200 hover:bg-gray-50 transition-colors duration-300 cursor-pointer">
                <div>
                    <h3 class="font-medium text-base mb-1 transition-colors duration-300">Bit Lux Signature Packaging</h3>
                    <p class="text-sm text-gray-600">An example and emblem of the House's savoir-faire</p>
                </div>
                <svg class="w-5 h-5 text-gray-600 flex-shrink-0 ml-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </div>

            <!-- Card 3 -->
            <div class="flex justify-between items-start p-8 border-b md:border-b-0 hover:bg-gray-50 transition-colors duration-300 cursor-pointer">
                <div>
                    <h3 class="font-medium text-base mb-1 transition-colors duration-300">Free Delivery & Returns</h3>
                    <p class="text-sm text-gray-600">Complimentary standard shipping and returns & exchanges within 30 days</p>
                </div>
                <svg class="w-5 h-5 text-gray-600 flex-shrink-0 ml-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </div>
        </div>

        <!-- Newsletter and Links Grid -->
        <div class="px-4 md:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-[2fr_1fr_1fr] gap-8 lg:gap-32 mb-16">
                <!-- Newsletter Section -->
                <div>
                    <h3 class="text-sm font-medium mb-6 tracking-wide">Inspire me with all the latest Bit Lux news</h3>
                    <div class="flex flex-col sm:flex-row gap-4 max-w-2xl">
                        <input 
                            type="email" 
                            placeholder="* E-mail" 
                            class="flex-1 px-4 py-3 border border-gray-300 focus:outline-none focus:border-gray-500 text-sm"
                        >
                        <button class="bg-black text-white px-8 py-3 hover:bg-gray-800 transition text-sm font-medium border border-black rounded">
                            Confirm
                        </button>
                    </div>
                </div>

                <!-- Client Services -->
                <div>
                    <h3 class="text-sm font-medium mb-6 tracking-wide">Client Services</h3>
                    <div class="flex flex-col space-y-3">
                        <a href="#" class="text-sm text-gray-600 hover:text-gray-900 transition-colors" id="footerContactBtn">Contact</a>
                        <a href="#" class="text-sm text-gray-600 hover:text-gray-900 transition-colors">Delivery & Returns</a>
                        <a href="#" class="text-sm text-gray-600 hover:text-gray-900 transition-colors">FAQ</a>
                    </div>
                </div>

                <!-- The House Of Bit Lux -->
                <div>
                    <h3 class="text-sm font-medium mb-6 tracking-wide">The House Of Bit Lux</h3>
                    <div class="flex flex-col space-y-3">
                        <a href="#" class="text-sm text-gray-600 hover:text-gray-900 transition-colors">Bit Lux Saddle</a>
                        <a href="#" class="text-sm text-gray-600 hover:text-gray-900 transition-colors">Rose Céleste</a>
                        <a href="#" class="text-sm text-gray-600 hover:text-gray-900 transition-colors">Ethics & Compliance</a>
                        <a href="#" class="text-sm text-gray-600 hover:text-gray-900 transition-colors">California Supply Chains Act</a>
                        <a href="#" class="text-sm text-gray-600 hover:text-gray-900 transition-colors">Bit Lux Sustainability</a>
                        <a href="#" class="text-sm text-gray-600 hover:text-gray-900 transition-colors">Careers</a>
                    </div>
                </div>
            </div>

            <!-- Bottom Section -->
            <div class="pt-8 border-t border-gray-200 pb-32 md:pb-16">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <!-- Copyright - Hidden on mobile, shown on desktop -->
                    <div class="hidden md:block text-sm text-gray-600">
                        © 2024 Bit Lux. All rights reserved.
                    </div>

                    <!-- Other Countries / Regions -->
                    <button class="flex items-center gap-2 text-sm text-gray-600 hover:text-gray-900 transition cursor-pointer" id="countryBtn">
                        <span>Other Countries / Regions: International (English)</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Logo (Centered to full viewport width) -->
    <div class="absolute left-1/2 transform -translate-x-1/2 mb-8 md:mb-0" style="bottom: 2rem;">
        <img src="./images/wittelogo.png" 
             alt="BIT LUX" 
             class="h-8 md:h-8"
             style="filter: brightness(0);">
    </div>

    <!-- Copyright at absolute bottom on mobile only -->
    <div class="md:hidden absolute left-0 right-0 text-center text-sm text-gray-600 pb-4" style="bottom: 0;">
        © 2024 Bit Lux. All rights reserved.
    </div>
</footer>

<!-- Country Selector Popup -->
<style>
#countrySelector.active {
    opacity: 1 !important;
    visibility: visible !important;
}
</style>
<div class="fixed top-0 left-0 w-full h-screen bg-white z-[2002] opacity-0 invisible transition-all duration-400 overflow-y-auto" id="countrySelector">
    <div class="bg-white w-full min-h-screen">
        <div class="flex flex-col md:flex-row justify-between items-center md:items-center p-6 md:p-12 border-b border-gray-200 sticky top-0 bg-white z-10 gap-4 md:gap-0">
            <img src="./images/wittelogo.png" alt="BIT LUX" class="h-8 md:flex-shrink-0 order-1" style="filter: brightness(0);">
            <h2 class="text-xs md:text-sm font-normal tracking-widest md:flex-1 text-left md:text-right md:pr-12 order-2">CHOOSE YOUR COUNTRY/REGION</h2>
            <button class="absolute right-6 top-6 md:static bg-none border-none cursor-pointer p-2 flex-shrink-0 hover:opacity-60 transition-opacity order-3" id="closeCountryBtn">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-12 p-8 md:p-12 max-w-[1400px] mx-auto">
            <!-- Americas -->
            <div>
                <h3 class="text-sm font-medium mb-6 tracking-wide">Americas</h3>
                <ul class="list-none space-y-0">
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        USA
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        Brazil
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        Canada (English)
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        Canada (Français)
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        Mexico
                    </li>
                </ul>
            </div>

            <!-- Europe -->
            <div>
                <h3 class="text-sm font-medium mb-6 tracking-wide">Europe</h3>
                <ul class="list-none space-y-0">
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        Belgium (English)
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        Denmark (English)
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        Deutschland
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        España
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        Finland (English)
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        France
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        Ireland
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        Italia
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        Luxembourg (English)
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        Nederland (English)
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        Österreich (English)
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        Sweden (English)
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        United Kingdom
                    </li>
                </ul>
            </div>

            <!-- Asia -->
            <div>
                <h3 class="text-sm font-medium mb-6 tracking-wide">Asia</h3>
                <ul class="list-none space-y-0">
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        中国大陆
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        日本
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        대한민국
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        Hong Kong SAR
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        香港特別行政區
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        Singapore
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        Malaysia
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        臺灣地區
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        ประเทศไทย
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        Việt Nam
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        Indonesia (English)
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        Indonesia (Bahasa)
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        India
                    </li>
                </ul>
            </div>

            <!-- Oceania -->
            <div>
                <h3 class="text-sm font-medium mb-6 tracking-wide">Oceania</h3>
                <ul class="list-none space-y-0">
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        Australia
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        New Zealand
                    </li>
                </ul>
            </div>

            <!-- Middle East -->
            <div>
                <h3 class="text-sm font-medium mb-6 tracking-wide">Middle East</h3>
                <ul class="list-none space-y-0">
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        UAE (English)
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        الإمارات العربية المتحدة (العربية)
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        KSA (English)
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        المملكة العربية السعودية (العربية)
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        Kuwait (English)
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        الكويت (العربية)
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        Qatar (English)
                    </li>
                    <li class="py-3 text-sm cursor-pointer transition-colors hover:text-[#8B7355] flex items-center gap-2">
                        <svg class="w-5 h-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="10" r="2"/></svg>
                        قطر (العربية)
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-200 p-8 md:p-12 text-sm text-gray-600">
            Other Countries / Regions: International (English)
        </div>
    </div>
</div>