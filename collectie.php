
<?php
require_once 'components/connection.php';

// Define categories and materials for filter sidebar
$categories = [
    'ring' => 'Rings',
    'ketting' => 'Necklaces',
    'armband' => 'Bracelets',
    'oorbellen' => 'Earrings',
];
$materials = [
    'gold' => 'Gold',
    'silver' => 'Silver',
];

$isAjax = ($_GET['ajax'] ?? '') === '1';

$where = [];
$params = [];

/**
 * Helper functie voor IN-filters
 */

function addInFilter($field, $key, &$where, &$params) {
    if (!isset($_GET[$key])) return;

    $values = is_array($_GET[$key]) ? $_GET[$key] : explode(',', $_GET[$key]);
    $placeholders = implode(',', array_fill(0, count($values), '?'));

    $where[] = "$field IN ($placeholders)";
    $params = array_merge($params, $values);
}

/**
 * Standaard filters
 */
addInFilter('categorie', 'category', $where, $params);
addInFilter('materiaal', 'material', $where, $params);
addInFilter('geslacht', 'gender', $where, $params);

/**
 * Diamant filter
 */
if (!empty($_GET['diamond'])) {
    $where[] = 'diamant = 1';
}

/**
 * Prijs filter
 */
if (!empty($_GET['price'])) {
    $ranges = is_array($_GET['price']) ? $_GET['price'] : explode(',', $_GET['price']);
    $priceWhere = [];

    $map = [
        '0-100'    => 'prijs < 100',
        '100-500'  => 'prijs BETWEEN 100 AND 499',
        '500-1000' => 'prijs BETWEEN 500 AND 999',
        '1000-5000'=> 'prijs BETWEEN 1000 AND 4999',
        '5000+'    => 'prijs >= 5000'
    ];

    foreach ($ranges as $range) {
        if (isset($map[$range])) {
            $priceWhere[] = $map[$range];
        }
    }

    if ($priceWhere) {
        $where[] = '(' . implode(' OR ', $priceWhere) . ')';
    }
}

/**
 * Basis query
 */
$sql = "SELECT * FROM product";
if ($where) {
    $sql .= " WHERE " . implode(' AND ', $where);
}

/**
 * Sortering
 */
$sortMap = [
    'price-asc'  => 'prijs ASC',
    'price-desc' => 'prijs DESC',
    'name-asc'   => 'naam ASC',
    'name-desc'  => 'naam DESC',
    'featured'   => 'id DESC'
];

$sort = $_GET['sort'] ?? 'featured';
$sql .= " ORDER BY " . ($sortMap[$sort] ?? 'id DESC');

/**
 * Query uitvoeren
 */
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

/**
 * AJAX response
 */
if ($isAjax) {
    header('Content-Type: application/json');
    echo json_encode([
        'products' => $products,
        'count' => count($products)
    ]);
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collection - Bit Lux</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>


<body class="bg-black">
    <?php include './components/navbar.php'; ?>

    <!-- Hero Section -->
    <section class="relative w-full h-[40vh] md:h-[60vh] overflow-hidden">
        <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover">
            <source src="./images/banner.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="absolute inset-0 bg-black/30"></div>
        <div class="absolute bottom-16 left-16 max-w-xl text-white z-10">
            <h1 class="text-3xl md:text-4xl font-light mb-4 tracking-wide">
                Best Gifts for christmas
            </h1>
            <p class="text-sm md:text-base font-light leading-relaxed">
                Discover Bit Lux's exquisite collection of luxury gifts, thoughtfully curated for the discerning woman who appreciates timeless elegance and refined craftsmanship.
            </p>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="bg-white border-b border-gray-200">
        <div class="flex justify-between items-center py-8 px-12">
            <!-- Left: Results + Active Filters -->
            <div class="flex items-center gap-6">
                <span class="text-sm font-medium" id="resultsCount">
                    <?= count($products); ?> Result<?= count($products) !== 1 ? 's' : ''; ?>
                </span>
                
                <!-- Active Filters Container -->
                <div id="activeFiltersContainer" class="flex items-center gap-3">
                    <!-- Active filters will be dynamically inserted here -->
                </div>
            </div>

            <!-- Right: Sort + Filter buttons -->
            <div class="flex items-center gap-4">
                <!-- Sort Dropdown -->
                <div class="relative group">
                    <button class="flex items-center gap-2 px-4 py-2 text-sm font-medium hover:opacity-70 transition-opacity">
                        <span id="sortLabel"><?= ['featured' => 'Featured', 'price-asc' => 'Price: Low to High', 'price-desc' => 'Price: High to Low', 'name-asc' => 'Name: A to Z', 'name-desc' => 'Name: Z to A'][$sort] ?? 'Featured' ?></span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <!-- Sort Dropdown Menu -->
                    <div class="hidden group-hover:block absolute right-0 top-full mt-2 w-56 bg-white border border-gray-200 shadow-lg z-50 rounded-md overflow-hidden">
                        <button type="button" onclick="updateSort('featured')" class="block w-full text-left px-4 py-3 text-sm hover:bg-gray-50 transition-colors <?= $sort === 'featured' ? 'bg-gray-50 font-medium' : '' ?>">
                            Featured
                        </button>
                        <button type="button" onclick="updateSort('price-asc')" class="block w-full text-left px-4 py-3 text-sm hover:bg-gray-50 transition-colors <?= $sort === 'price-asc' ? 'bg-gray-50 font-medium' : '' ?>">
                            Price: Low to High
                        </button>
                        <button type="button" onclick="updateSort('price-desc')" class="block w-full text-left px-4 py-3 text-sm hover:bg-gray-50 transition-colors <?= $sort === 'price-desc' ? 'bg-gray-50 font-medium' : '' ?>">
                            Price: High to Low
                        </button>
                        <button type="button" onclick="updateSort('name-asc')" class="block w-full text-left px-4 py-3 text-sm hover:bg-gray-50 transition-colors <?= $sort === 'name-asc' ? 'bg-gray-50 font-medium' : '' ?>">
                            Name: A to Z
                        </button>
                        <button type="button" onclick="updateSort('name-desc')" class="block w-full text-left px-4 py-3 text-sm hover:bg-gray-50 transition-colors <?= $sort === 'name-desc' ? 'bg-gray-50 font-medium' : '' ?>">
                            Name: Z to A
                        </button>
                    </div>
                </div>

                <!-- Filter Button -->
                <button id="filterBtn" class="flex items-center gap-2 text-sm font-medium hover:opacity-70 transition-opacity">
                    <span>Filters</span>
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <line x1="4" y1="6" x2="20" y2="6"></line>
                        <line x1="4" y1="12" x2="20" y2="12"></line>
                        <line x1="4" y1="18" x2="14" y2="18"></line>
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <!-- Filter Sidebar Overlay -->
    <div id="filterOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden transition-opacity duration-300"></div>

    <!-- Filter Sidebar -->
    <div id="filterSidebar" class="fixed top-0 right-0 h-full w-[400px] bg-white z-50 transform translate-x-full transition-transform duration-300 ease-in-out shadow-2xl">
        <div class="flex flex-col h-full">
            <!-- Header -->
            <div class="flex items-center justify-between px-8 py-6 border-b border-gray-200">
                <h2 class="text-lg font-medium">Filters</h2>
                <button type="button" id="closeFilter" class="hover:opacity-70 transition-opacity">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

            <!-- Filter Content -->
            <div class="flex-1 overflow-y-scroll px-8 py-6 scrollbar-hide">
                
                <!-- Category Filter -->
                <div style="margin-bottom: 1rem;">
                    <button type="button" class="flex items-center justify-between w-full py-3 text-left font-medium" onclick="toggleFilter('category')">
                        <span>Category</span>
                        <svg class="w-5 h-5 transform transition-transform" id="categoryArrow" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <div id="categoryFilter" class="mt-3 space-y-2 hidden">
                        <?php foreach ($categories as $key => $name): ?>
                        <label class="flex items-center cursor-pointer hover:opacity-70">
                            <input type="checkbox" data-filter="category" value="<?= $key ?>" class="w-4 h-4 border-gray-300 accent-black filter-checkbox">
                            <span class="ml-3 text-sm"><?= $name ?></span>
                        </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="border-t border-gray-200" style="margin-bottom: 1rem;"></div>

                <!-- Material Filter -->
                <div style="margin-bottom: 1rem;">
                    <button type="button" class="flex items-center justify-between w-full py-3 text-left font-medium" onclick="toggleFilter('material')">
                        <span>Materials</span>
                        <svg class="w-5 h-5 transform transition-transform" id="materialArrow" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <div id="materialFilter" class="mt-3 space-y-2 hidden">
                        <?php foreach ($materials as $key => $name): ?>
                        <label class="flex items-center cursor-pointer hover:opacity-70">
                            <input type="checkbox" data-filter="material" value="<?= $key ?>" class="w-4 h-4 border-gray-300 accent-black filter-checkbox">
                            <span class="ml-3 text-sm"><?= $name ?></span>
                        </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="border-t border-gray-200" style="margin-bottom: 1rem;"></div>

                <!-- Gender Filter -->
                <div style="margin-bottom: 1rem;">
                    <button type="button" class="flex items-center justify-between w-full py-3 text-left font-medium" onclick="toggleFilter('gender')">
                        <span>Gender</span>
                        <svg class="w-5 h-5 transform transition-transform" id="genderArrow" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <div id="genderFilter" class="mt-3 space-y-2 hidden">
                        <label class="flex items-center cursor-pointer hover:opacity-70">
                            <input type="checkbox" data-filter="gender" value="0" class="w-4 h-4 border-gray-300 accent-black filter-checkbox">
                            <span class="ml-3 text-sm">For Her</span>
                        </label>
                        <label class="flex items-center cursor-pointer hover:opacity-70">
                            <input type="checkbox" data-filter="gender" value="1" class="w-4 h-4 border-gray-300 accent-black filter-checkbox">
                            <span class="ml-3 text-sm">For Him</span>
                        </label>
                    </div>
                </div>

                <div class="border-t border-gray-200" style="margin-bottom: 1rem;"></div>

                <!-- Diamond Filter -->
                <div style="margin-bottom: 1rem;">
                    <button type="button" class="flex items-center justify-between w-full py-3 text-left font-medium" onclick="toggleFilter('diamond')">
                        <span>Features</span>
                        <svg class="w-5 h-5 transform transition-transform" id="diamondArrow" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <div id="diamondFilter" class="mt-3 space-y-2 hidden">
                        <label class="flex items-center cursor-pointer hover:opacity-70">
                            <input type="checkbox" data-filter="diamond" value="1" class="w-4 h-4 border-gray-300 accent-black filter-checkbox">
                            <span class="ml-3 text-sm">With Diamonds</span>
                        </label>
                    </div>
                </div>

                <div class="border-t border-gray-200" style="margin-bottom: 1rem;"></div>

                <!-- Price Range Filter -->
                <div style="margin-bottom: 1rem;">
                    <button type="button" class="flex items-center justify-between w-full py-3 text-left font-medium" onclick="toggleFilter('price')">
                        <span>Price Range</span>
                        <svg class="w-5 h-5 transform transition-transform" id="priceArrow" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <div id="priceFilter" class="mt-3 space-y-2 hidden">
                        <label class="flex items-center cursor-pointer hover:opacity-70">
                            <input type="checkbox" data-filter="price" value="0-100" class="w-4 h-4 border-gray-300 accent-black filter-checkbox">
                            <span class="ml-3 text-sm">Under $100</span>
                        </label>
                        <label class="flex items-center cursor-pointer hover:opacity-70">
                            <input type="checkbox" data-filter="price" value="100-500" class="w-4 h-4 border-gray-300 accent-black filter-checkbox">
                            <span class="ml-3 text-sm">$100 - $500</span>
                        </label>
                        <label class="flex items-center cursor-pointer hover:opacity-70">
                            <input type="checkbox" data-filter="price" value="500-1000" class="w-4 h-4 border-gray-300 accent-black filter-checkbox">
                            <span class="ml-3 text-sm">$500 - $1,000</span>
                        </label>
                        <label class="flex items-center cursor-pointer hover:opacity-70">
                            <input type="checkbox" data-filter="price" value="1000-5000" class="w-4 h-4 border-gray-300 accent-black filter-checkbox">
                            <span class="ml-3 text-sm">$1,000 - $5,000</span>
                        </label>
                        <label class="flex items-center cursor-pointer hover:opacity-70">
                            <input type="checkbox" data-filter="price" value="5000+" class="w-4 h-4 border-gray-300 accent-black filter-checkbox">
                            <span class="ml-3 text-sm">$5,000+</span>
                        </label>
                    </div>
                </div>

            </div>

            <!-- Footer -->
            <div class="px-8 py-6 border-t border-gray-200">
                <button type="button" onclick="applyFilters()" style="border-radius: 2rem;" class="w-full bg-black text-white py-3 font-medium hover:bg-gray-800 transition-colors mb-3">
                    Show Results
                </button>
                <button type="button" onclick="clearAllFilters()" class="block w-full text-center text-sm text-gray-500 hover:text-gray-900 transition-colors">
                    Clear All Filters
                </button>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <section id="productsGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-0.5 bg-white p-0">
        <!-- Products will be dynamically loaded here -->
    </section>

    <!-- Load All Section -->
    <section class="bg-white py-16 px-12 text-center">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-2xl font-bold tracking-wider mb-6">NEW ARRIVALS WOMEN</h2>
            <p class="text-base text-gray-600 leading-relaxed mb-8">
                Explore new in women's ready-to-wear collection and the latest arrivals in shoes.
            </p>
            <div class="flex items-center justify-center gap-2 text-sm">
                <a href="#" class="text-gray-900 underline hover:opacity-70 transition-opacity">What's New</a>
                <span class="text-gray-900">/</span>
                <a href="#" class="text-gray-900 underline hover:opacity-70 transition-opacity">New In</a>
                <span class="text-gray-900">/</span>
                <span class="text-gray-600">New Arrivals Women</span>
            </div>
        </div>
    </section>

    <?php include './components/footer.php'; ?>
    <script src="./javascript/script.js"></script>

    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    <script>
        // Filter state
        let currentFilters = {
            category: [],
            material: [],
            gender: [],
            diamond: null,
            price: [],
            sort: 'featured'
        };

        // Category and material labels
        const labels = {
            category: {
                'ring': 'Rings',
                'ketting': 'Necklaces',
                'armband': 'Bracelets',
                'oorbellen': 'Earrings'
            },
            material: {
                'gold': 'Gold',
                'silver': 'Silver'
            },
            gender: {
                '0': 'For Her',
                '1': 'For Him'
            },
            price: {
                '0-100': 'Under $100',
                '100-500': '$100 - $500',
                '500-1000': '$500 - $1,000',
                '1000-5000': '$1,000 - $5,000',
                '5000+': '$5,000+'
            },
            sort: {
                'featured': 'Featured',
                'price-asc': 'Price: Low to High',
                'price-desc': 'Price: High to Low',
                'name-asc': 'Name: A to Z',
                'name-desc': 'Name: Z to A'
            }
        };

        // Initialize filters from URL
        function initFiltersFromURL() {
            const urlParams = new URLSearchParams(window.location.search);
            
            // Category
            if (urlParams.has('category')) {
                currentFilters.category = urlParams.get('category').split(',');
            }
            
            // Material
            if (urlParams.has('material')) {
                currentFilters.material = urlParams.get('material').split(',');
            }
            
            // Gender
            if (urlParams.has('gender')) {
                currentFilters.gender = urlParams.get('gender').split(',');
            }
            
            // Diamond
            if (urlParams.has('diamond')) {
                currentFilters.diamond = urlParams.get('diamond');
            }
            
            // Price
            if (urlParams.has('price')) {
                currentFilters.price = urlParams.get('price').split(',');
            }
            
            // Sort
            if (urlParams.has('sort')) {
                currentFilters.sort = urlParams.get('sort');
            }
            
            // Update checkboxes
            document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
                const filterType = checkbox.dataset.filter;
                const value = checkbox.value;
                
                if (filterType === 'diamond') {
                    checkbox.checked = currentFilters.diamond === value;
                } else if (currentFilters[filterType]) {
                    checkbox.checked = currentFilters[filterType].includes(value);
                }
            });
            
            // Load products
            loadProducts();
        }

        // Load products via AJAX
        function loadProducts() {
            const params = new URLSearchParams();
            params.append('ajax', '1');
            
            if (currentFilters.category.length > 0) {
                params.append('category', currentFilters.category.join(','));
            }
            if (currentFilters.material.length > 0) {
                params.append('material', currentFilters.material.join(','));
            }
            if (currentFilters.gender.length > 0) {
                params.append('gender', currentFilters.gender.join(','));
            }
            if (currentFilters.diamond) {
                params.append('diamond', currentFilters.diamond);
            }
            if (currentFilters.price.length > 0) {
                params.append('price', currentFilters.price.join(','));
            }
            params.append('sort', currentFilters.sort);
            
            fetch('?' + params.toString())
                .then(response => response.json())
                .then(data => {
                    renderProducts(data.products);
                    updateResultsCount(data.count);
                    updateActiveFilters();
                    updateURL();
                })
                .catch(error => console.error('Error:', error));
        }

        // Render products
        function renderProducts(products) {
            const grid = document.getElementById('productsGrid');
            
            if (products.length === 0) {
                grid.innerHTML = '<div class="col-span-full text-center py-16"><p class="text-gray-500">No products found matching your criteria.</p></div>';
                return;
            }
            
            grid.innerHTML = products.map(product => `
                <div class="group cursor-pointer mb-3">
                    <div class="relative aspect-[3/4] lg:aspect-[2/3] overflow-hidden bg-gray-100 mb-3">
                        <button 
                            type="button"
                            class="absolute top-4 right-4 z-10 hover:opacity-70 transition-opacity"
                            onclick="event.preventDefault(); event.stopPropagation();"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="black" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </button>
                        <a href="product.php?id=${product.id}">
                            <img 
                                src="${product.foto1}" 
                                alt="${product.naam}"
                                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                            >
                        </a>
                    </div>
                    <a href="product.php?id=${product.id}" class="block pl-4">
                        <h3 class="text-black mb-1" style="font-size: 0.75rem;">
                            ${product.naam}
                        </h3>
                        <p class="text-gray-600" style="font-size: 0.7rem;">
                            $${parseFloat(product.prijs).toFixed(2)}
                        </p>
                    </a>
                </div>
            `).join('');
        }

        // Update results count
        function updateResultsCount(count) {
            document.getElementById('resultsCount').textContent = `${count} Result${count !== 1 ? 's' : ''}`;
        }

        // Update active filters display
        function updateActiveFilters() {
            const container = document.getElementById('activeFiltersContainer');
            const hasFilters = currentFilters.category.length > 0 || 
                              currentFilters.material.length > 0 || 
                              currentFilters.gender.length > 0 || 
                              currentFilters.diamond || 
                              currentFilters.price.length > 0;
            
            if (!hasFilters) {
                container.innerHTML = '';
                return;
            }
            
            let html = '<span class="text-xs text-gray-400">|</span><div class="flex items-center gap-2">';
            
            // Category filters
            currentFilters.category.forEach(cat => {
                html += `
                    <button onclick="removeFilter('category', '${cat}')" class="flex items-center gap-2 px-3 py-1.5 bg-gray-100 text-sm rounded-full hover:bg-gray-200 transition-colors">
                        <span>${labels.category[cat] || cat}</span>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                `;
            });
            
            // Material filters
            currentFilters.material.forEach(mat => {
                html += `
                    <button onclick="removeFilter('material', '${mat}')" class="flex items-center gap-2 px-3 py-1.5 bg-gray-100 text-sm rounded-full hover:bg-gray-200 transition-colors">
                        <span>${labels.material[mat] || mat}</span>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                `;
            });
            
            // Gender filters
            currentFilters.gender.forEach(gen => {
                html += `
                    <button onclick="removeFilter('gender', '${gen}')" class="flex items-center gap-2 px-3 py-1.5 bg-gray-100 text-sm rounded-full hover:bg-gray-200 transition-colors">
                        <span>${labels.gender[gen]}</span>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                `;
            });
            
            // Diamond filter
            if (currentFilters.diamond) {
                html += `
                    <button onclick="removeFilter('diamond', '1')" class="flex items-center gap-2 px-3 py-1.5 bg-gray-100 text-sm rounded-full hover:bg-gray-200 transition-colors">
                        <span>With Diamonds</span>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                `;
            }
            
            // Price filters
            currentFilters.price.forEach(price => {
                html += `
                    <button onclick="removeFilter('price', '${price}')" class="flex items-center gap-2 px-3 py-1.5 bg-gray-100 text-sm rounded-full hover:bg-gray-200 transition-colors">
                        <span>${labels.price[price]}</span>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                `;
            });
            
            html += '<button onclick="clearAllFilters()" class="text-xs text-gray-500 hover:text-gray-900 underline transition-colors ml-2">Clear all</button>';
            html += '</div>';
            
            container.innerHTML = html;
        }

        // Update URL without reload
        function updateURL() {
            const params = new URLSearchParams();
            
            if (currentFilters.category.length > 0) {
                params.append('category', currentFilters.category.join(','));
            }
            if (currentFilters.material.length > 0) {
                params.append('material', currentFilters.material.join(','));
            }
            if (currentFilters.gender.length > 0) {
                params.append('gender', currentFilters.gender.join(','));
            }
            if (currentFilters.diamond) {
                params.append('diamond', currentFilters.diamond);
            }
            if (currentFilters.price.length > 0) {
                params.append('price', currentFilters.price.join(','));
            }
            if (currentFilters.sort !== 'featured') {
                params.append('sort', currentFilters.sort);
            }
            
            const newURL = window.location.pathname + (params.toString() ? '?' + params.toString() : '');
            window.history.pushState({}, '', newURL);
        }

        // Apply filters
        function applyFilters() {
            // Collect all checked filters
            currentFilters = {
                category: [],
                material: [],
                gender: [],
                diamond: null,
                price: [],
                sort: currentFilters.sort
            };
            
            document.querySelectorAll('.filter-checkbox:checked').forEach(checkbox => {
                const filterType = checkbox.dataset.filter;
                const value = checkbox.value;
                
                if (filterType === 'diamond') {
                    currentFilters.diamond = value;
                } else {
                    currentFilters[filterType].push(value);
                }
            });
            
            loadProducts();
            closeFilterSidebar();
        }

        // Remove single filter
        function removeFilter(filterType, value) {
            // Always reload with reset to clear PHP session filter
            window.location.href = window.location.pathname + '?reset=1';
        }

        // Clear all filters
        function clearAllFilters() {
            // Always reload with reset to clear PHP session filters
            window.location.href = window.location.pathname + '?reset=1';
        }

        // Update sort
        function updateSort(sortValue) {
            currentFilters.sort = sortValue;
            document.getElementById('sortLabel').textContent = labels.sort[sortValue];
            loadProducts();
        }

        // Filter sidebar controls
        const filterBtn = document.getElementById('filterBtn');
        const closeFilter = document.getElementById('closeFilter');
        const filterOverlay = document.getElementById('filterOverlay');
        const filterSidebar = document.getElementById('filterSidebar');

        filterBtn.addEventListener('click', () => {
            filterOverlay.classList.remove('hidden');
            filterSidebar.classList.remove('translate-x-full');
            document.body.style.overflow = 'hidden';
        });

        function closeFilterSidebar() {
            filterSidebar.classList.add('translate-x-full');
            setTimeout(() => {
                filterOverlay.classList.add('hidden');
            }, 300);
            document.body.style.overflow = 'auto';
        }

        closeFilter.addEventListener('click', closeFilterSidebar);
        filterOverlay.addEventListener('click', closeFilterSidebar);

        function toggleFilter(filterName) {
            const filterDiv = document.getElementById(filterName + 'Filter');
            const arrow = document.getElementById(filterName + 'Arrow');
            
            filterDiv.classList.toggle('hidden');
            arrow.classList.toggle('rotate-180');
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeFilterSidebar();
            }
        });

        // Initialize on page load
        window.addEventListener('DOMContentLoaded', initFiltersFromURL);
    </script>

</body>
<script src="./javascript/cart-wishlist.js"></script>
</html>