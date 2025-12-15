
<?php
require_once 'components/connection.php';

// Categories en materials
$categories = ['ring' => 'Rings', 'ketting' => 'Necklaces', 'armband' => 'Bracelets', 'oorbellen' => 'Earrings'];
$materials = ['gold' => 'Gold', 'silver' => 'Silver'];

// Verwerk filters uit URL
$whereConditions = [];
$params = [];

// Category filter
if (isset($_GET['category']) && !empty($_GET['category'])) {
    $categoryFilters = is_array($_GET['category']) ? $_GET['category'] : [$_GET['category']];
    $placeholders = str_repeat('?,', count($categoryFilters) - 1) . '?';
    $whereConditions[] = "categorie IN ($placeholders)";
    $params = array_merge($params, $categoryFilters);
}

// Material filter
if (isset($_GET['material']) && !empty($_GET['material'])) {
    $materialFilters = is_array($_GET['material']) ? $_GET['material'] : [$_GET['material']];
    $placeholders = str_repeat('?,', count($materialFilters) - 1) . '?';
    $whereConditions[] = "materiaal IN ($placeholders)";
    $params = array_merge($params, $materialFilters);
}

// Gender filter
if (isset($_GET['gender']) && !empty($_GET['gender'])) {
    $genderFilters = is_array($_GET['gender']) ? $_GET['gender'] : [$_GET['gender']];
    $placeholders = str_repeat('?,', count($genderFilters) - 1) . '?';
    $whereConditions[] = "geslacht IN ($placeholders)";
    $params = array_merge($params, $genderFilters);
}

// Diamond filter
if (isset($_GET['diamond']) && $_GET['diamond'] == '1') {
    $whereConditions[] = "diamant = 1";
}

// Price filter
if (isset($_GET['price']) && !empty($_GET['price'])) {
    $priceFilters = is_array($_GET['price']) ? $_GET['price'] : [$_GET['price']];
    $priceConditions = [];
   
    foreach ($priceFilters as $range) {
        if ($range === '0-100') {
            $priceConditions[] = "prijs < 100";
        } elseif ($range === '100-500') {
            $priceConditions[] = "(prijs >= 100 AND prijs < 500)";
        } elseif ($range === '500-1000') {
            $priceConditions[] = "(prijs >= 500 AND prijs < 1000)";
        } elseif ($range === '1000-5000') {
            $priceConditions[] = "(prijs >= 1000 AND prijs < 5000)";
        } elseif ($range === '5000+') {
            $priceConditions[] = "prijs >= 5000";
        }
    }
   
    if (!empty($priceConditions)) {
        $whereConditions[] = "(" . implode(" OR ", $priceConditions) . ")";
    }
}

// Build query
$sql = "SELECT * FROM product";
if (!empty($whereConditions)) {
    $sql .= " WHERE " . implode(" AND ", $whereConditions);
}

// Sorting
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'featured';
switch ($sort) {
    case 'price-asc':
        $sql .= " ORDER BY prijs ASC";
        break;
    case 'price-desc':
        $sql .= " ORDER BY prijs DESC";
        break;
    case 'name-asc':
        $sql .= " ORDER BY naam ASC";
        break;
    case 'name-desc':
        $sql .= " ORDER BY naam DESC";
        break;
    default:
        $sql .= " ORDER BY id DESC"; // Featured = newest first
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Helper function to build URL with/without specific filter
function buildFilterUrl($paramName, $value, $add = true) {
    $params = $_GET;
   
    if ($add) {
        // Add filter
        if (isset($params[$paramName])) {
            if (is_array($params[$paramName])) {
                if (!in_array($value, $params[$paramName])) {
                    $params[$paramName][] = $value;
                }
            } else {
                $params[$paramName] = [$params[$paramName], $value];
            }
        } else {
            $params[$paramName] = [$value];
        }
    } else {
        // Remove filter
        if (isset($params[$paramName])) {
            if (is_array($params[$paramName])) {
                $params[$paramName] = array_diff($params[$paramName], [$value]);
                if (empty($params[$paramName])) {
                    unset($params[$paramName]);
                }
            } else {
                unset($params[$paramName]);
            }
        }
    }
   
    return '?' . http_build_query($params);
}

// Helper function to check if filter is active
function isFilterActive($paramName, $value) {
    if (!isset($_GET[$paramName])) return false;
   
    if (is_array($_GET[$paramName])) {
        return in_array($value, $_GET[$paramName]);
    }
   
    return $_GET[$paramName] == $value;
}

// Helper to remove all filters
function clearAllFilters() {
    return '?';
}

// Get sort label
function getSortLabel($sort) {
    $labels = [
        'featured' => 'Featured',
        'price-asc' => 'Price: Low to High',
        'price-desc' => 'Price: High to Low',
        'name-asc' => 'Name: A to Z',
        'name-desc' => 'Name: Z to A'
    ];
    return $labels[$sort] ?? 'Sort by';
}

// Check if any filters are active
$hasFilters = !empty($_GET['category']) || !empty($_GET['material']) || !empty($_GET['gender']) || !empty($_GET['diamond']) || !empty($_GET['price']);
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

    <?php include('components/navbar.php') ?>

    <!-- Hero Section -->
    <section class="relative w-full h-[40vh] md:h-[60vh] overflow-hidden">
        <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover">
            <source src="./images/banner.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="absolute inset-0 bg-black/30"></div>
        <div class="absolute bottom-16 left-16 max-w-xl text-white z-10">
            <h1 class="text-3xl md:text-4xl font-light mb-4 tracking-wide">
                Best Gifts for Her
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
                <span class="text-sm font-medium">
                    <?= count($products); ?> Result<?= count($products) !== 1 ? 's' : ''; ?>
                </span>
               
                <!-- Active Filters Container -->
                <?php if ($hasFilters): ?>
                <div class="flex items-center gap-3">
                    <span class="text-xs text-gray-400">|</span>
                    <div class="flex items-center gap-2">
                       
                        <!-- Category filters -->
                        <?php if (isset($_GET['category'])): ?>
                            <?php $categoryFilters = is_array($_GET['category']) ? $_GET['category'] : [$_GET['category']]; ?>
                            <?php foreach ($categoryFilters as $cat): ?>
                                <a href="<?= buildFilterUrl('category', $cat, false) ?>" class="flex items-center gap-2 px-3 py-1.5 bg-gray-100 text-sm rounded-full hover:bg-gray-200 transition-colors">
                                    <span><?= $categories[$cat] ?? ucfirst($cat) ?></span>
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                       
                        <!-- Material filters -->
                        <?php if (isset($_GET['material'])): ?>
                            <?php $materialFilters = is_array($_GET['material']) ? $_GET['material'] : [$_GET['material']]; ?>
                            <?php foreach ($materialFilters as $mat): ?>
                                <a href="<?= buildFilterUrl('material', $mat, false) ?>" class="flex items-center gap-2 px-3 py-1.5 bg-gray-100 text-sm rounded-full hover:bg-gray-200 transition-colors">
                                    <span><?= $materials[$mat] ?? ucfirst($mat) ?></span>
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                       
                        <!-- Gender filters -->
                        <?php if (isset($_GET['gender'])): ?>
                            <?php $genderFilters = is_array($_GET['gender']) ? $_GET['gender'] : [$_GET['gender']]; ?>
                            <?php foreach ($genderFilters as $gen): ?>
                                <a href="<?= buildFilterUrl('gender', $gen, false) ?>" class="flex items-center gap-2 px-3 py-1.5 bg-gray-100 text-sm rounded-full hover:bg-gray-200 transition-colors">
                                    <span><?= $gen == '0' ? 'For Her' : 'For Him' ?></span>
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                       
                        <!-- Diamond filter -->
                        <?php if (isset($_GET['diamond']) && $_GET['diamond'] == '1'): ?>
                            <a href="<?= buildFilterUrl('diamond', '1', false) ?>" class="flex items-center gap-2 px-3 py-1.5 bg-gray-100 text-sm rounded-full hover:bg-gray-200 transition-colors">
                                <span>With Diamonds</span>
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </a>
                        <?php endif; ?>
                       
                        <!-- Price filters -->
                        <?php if (isset($_GET['price'])): ?>
                            <?php $priceFilters = is_array($_GET['price']) ? $_GET['price'] : [$_GET['price']]; ?>
                            <?php foreach ($priceFilters as $price): ?>
                                <?php
                                $priceLabel = '';
                                if ($price == '0-100') $priceLabel = 'Under $100';
                                elseif ($price == '100-500') $priceLabel = '$100 - $500';
                                elseif ($price == '500-1000') $priceLabel = '$500 - $1,000';
                                elseif ($price == '1000-5000') $priceLabel = '$1,000 - $5,000';
                                elseif ($price == '5000+') $priceLabel = '$5,000+';
                                ?>
                                <a href="<?= buildFilterUrl('price', $price, false) ?>" class="flex items-center gap-2 px-3 py-1.5 bg-gray-100 text-sm rounded-full hover:bg-gray-200 transition-colors">
                                    <span><?= $priceLabel ?></span>
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                       
                        <a href="<?= clearAllFilters() ?>" class="text-xs text-gray-500 hover:text-gray-900 underline transition-colors ml-2">
                            Clear all
                        </a>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Right: Sort + Filter buttons -->
            <div class="flex items-center gap-4">
                <!-- Sort Dropdown -->
                <div class="relative group">
                    <button class="flex items-center gap-2 px-4 py-2 text-sm font-medium hover:opacity-70 transition-opacity">
                        <span><?= getSortLabel($sort) ?></span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <!-- Sort Dropdown Menu -->
                    <div class="hidden group-hover:block absolute right-0 top-full mt-2 w-56 bg-white border border-gray-200 shadow-lg z-50 rounded-md overflow-hidden">
                        <?php
                        $sortOptions = [
                            'featured' => 'Featured',
                            'price-asc' => 'Price: Low to High',
                            'price-desc' => 'Price: High to Low',
                            'name-asc' => 'Name: A to Z',
                            'name-desc' => 'Name: Z to A'
                        ];
                        foreach ($sortOptions as $key => $label):
                            $sortParams = $_GET;
                            $sortParams['sort'] = $key;
                        ?>
                            <a href="?<?= http_build_query($sortParams) ?>" class="block w-full text-left px-4 py-3 text-sm hover:bg-gray-50 transition-colors <?= $sort === $key ? 'bg-gray-50 font-medium' : '' ?>">
                                <?= $label ?>
                            </a>
                        <?php endforeach; ?>
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
    <form method="GET" action="" id="filterForm">
        <!-- Preserve sort parameter -->
        <?php if (isset($_GET['sort'])): ?>
            <input type="hidden" name="sort" value="<?= htmlspecialchars($_GET['sort']) ?>">
        <?php endif; ?>
       
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
                                <input type="checkbox" name="category[]" value="<?= $key ?>" class="w-4 h-4 border-gray-300 accent-black" <?= isFilterActive('category', $key) ? 'checked' : '' ?>>
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
                                <input type="checkbox" name="material[]" value="<?= $key ?>" class="w-4 h-4 border-gray-300 accent-black" <?= isFilterActive('material', $key) ? 'checked' : '' ?>>
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
                                <input type="checkbox" name="gender[]" value="0" class="w-4 h-4 border-gray-300 accent-black" <?= isFilterActive('gender', '0') ? 'checked' : '' ?>>
                                <span class="ml-3 text-sm">For Her</span>
                            </label>
                            <label class="flex items-center cursor-pointer hover:opacity-70">
                                <input type="checkbox" name="gender[]" value="1" class="w-4 h-4 border-gray-300 accent-black" <?= isFilterActive('gender', '1') ? 'checked' : '' ?>>
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
                                <input type="checkbox" name="diamond" value="1" class="w-4 h-4 border-gray-300 accent-black" <?= isset($_GET['diamond']) && $_GET['diamond'] == '1' ? 'checked' : '' ?>>
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
                                <input type="checkbox" name="price[]" value="0-100" class="w-4 h-4 border-gray-300 accent-black" <?= isFilterActive('price', '0-100') ? 'checked' : '' ?>>
                                <span class="ml-3 text-sm">Under $100</span>
                            </label>
                            <label class="flex items-center cursor-pointer hover:opacity-70">
                                <input type="checkbox" name="price[]" value="100-500" class="w-4 h-4 border-gray-300 accent-black" <?= isFilterActive('price', '100-500') ? 'checked' : '' ?>>
                                <span class="ml-3 text-sm">$100 - $500</span>
                            </label>
                            <label class="flex items-center cursor-pointer hover:opacity-70">
                                <input type="checkbox" name="price[]" value="500-1000" class="w-4 h-4 border-gray-300 accent-black" <?= isFilterActive('price', '500-1000') ? 'checked' : '' ?>>
                                <span class="ml-3 text-sm">$500 - $1,000</span>
                            </label>
                            <label class="flex items-center cursor-pointer hover:opacity-70">
                                <input type="checkbox" name="price[]" value="1000-5000" class="w-4 h-4 border-gray-300 accent-black" <?= isFilterActive('price', '1000-5000') ? 'checked' : '' ?>>
                                <span class="ml-3 text-sm">$1,000 - $5,000</span>
                            </label>
                            <label class="flex items-center cursor-pointer hover:opacity-70">
                                <input type="checkbox" name="price[]" value="5000+" class="w-4 h-4 border-gray-300 accent-black" <?= isFilterActive('price', '5000+') ? 'checked' : '' ?>>
                                <span class="ml-3 text-sm">$5,000+</span>
                            </label>
                        </div>
                    </div>

                </div>

                <!-- Footer -->
                <div class="px-8 py-6 border-t border-gray-200">
                    <button type="submit" style="border-radius: 2rem;" class="w-full bg-black text-white py-3 font-medium hover:bg-gray-800 transition-colors mb-3">
                        Show Results
                    </button>
                    <a href="?" class="block w-full text-center text-sm text-gray-500 hover:text-gray-900 transition-colors">
                        Clear All Filters
                    </a>
                </div>
            </div>
        </div>
    </form>

    <!-- Products Grid -->
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-0.5 bg-white p-0">
        <?php foreach ($products as $product): ?>
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
                    <a href="product.php?id=<?= $product['id']; ?>">
                        <img
                            src="<?= $product["foto1"]; ?>"
                            alt="<?= htmlspecialchars($product["naam"]); ?>"
                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                        >
                    </a>
                </div>
                <a href="product.php?id=<?= $product['id']; ?>" class="block pl-4">
                    <h3 class="text-black mb-1" style="font-size: 0.75rem;">
                        <?= htmlspecialchars($product["naam"]); ?>
                    </h3>
                    <p class="text-gray-600" style="font-size: 0.7rem;">
                        $<?= number_format($product["prijs"], 2); ?>
                    </p>
                </a>
            </div>
        <?php endforeach; ?>
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
    </script>

</body>
</html>
