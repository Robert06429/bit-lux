<?php
// cart.php
require_once __DIR__ . '/connection.php';
session_start();

// Initialize cart and wishlist if not exists
if (!isset($_SESSION['winkelmand'])) {
    $_SESSION['winkelmand'] = [
        'items' => [],
        'count' => 0
    ];
}

if (!isset($_SESSION['wishlist'])) {
    $_SESSION['wishlist'] = [
        'items' => [],
        'count' => 0
    ];
}

// Handle AJAX requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = ['success' => false, 'message' => ''];
    
    $action = $_POST['action'] ?? '';
    $productId = $_POST['product_id'] ?? 0;
    
    if ($action === 'add_to_cart') {
        // Haal product info op
        $stmt = $pdo->prepare("SELECT * FROM product WHERE id = :id");
        $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($product) {
            // Check of product al in cart zit
            $found = false;
            foreach ($_SESSION['winkelmand']['items'] as &$item) {
                if ($item['id'] == $productId) {
                    $item['quantity']++;
                    $found = true;
                    break;
                }
            }
            
            // Nieuw product toevoegen
            if (!$found) {
                $_SESSION['winkelmand']['items'][] = [
                    'id' => $product['id'],
                    'naam' => $product['naam'],
                    'prijs' => $product['prijs'],
                    'foto' => $product['foto1'],
                    'quantity' => 1
                ];
            }
            
            // Update count
            $_SESSION['winkelmand']['count'] = array_sum(array_column($_SESSION['winkelmand']['items'], 'quantity'));
            
            $response['success'] = true;
            $response['message'] = 'Product toegevoegd aan winkelwagen';
            $response['cart_count'] = $_SESSION['winkelmand']['count'];
            $response['cart_items'] = $_SESSION['winkelmand']['items'];
        }
    }
    
    elseif ($action === 'add_to_wishlist') {
        // Haal product info op
        $stmt = $pdo->prepare("SELECT * FROM product WHERE id = :id");
        $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($product) {
            // Check of product al in wishlist zit
            $found = false;
            foreach ($_SESSION['wishlist']['items'] as $item) {
                if ($item['id'] == $productId) {
                    $found = true;
                    break;
                }
            }
            
            if (!$found) {
                $_SESSION['wishlist']['items'][] = [
                    'id' => $product['id'],
                    'naam' => $product['naam'],
                    'prijs' => $product['prijs'],
                    'foto' => $product['foto1']
                ];
                $_SESSION['wishlist']['count']++;
                
                $response['success'] = true;
                $response['message'] = 'Product toegevoegd aan wishlist';
            } else {
                $response['success'] = false;
                $response['message'] = 'Product zit al in wishlist';
            }
            
            $response['wishlist_count'] = $_SESSION['wishlist']['count'];
            $response['wishlist_items'] = $_SESSION['wishlist']['items'];
        }
    }
    
    elseif ($action === 'remove_from_cart') {
        foreach ($_SESSION['winkelmand']['items'] as $key => $item) {
            if ($item['id'] == $productId) {
                unset($_SESSION['winkelmand']['items'][$key]);
                break;
            }
        }
        $_SESSION['winkelmand']['items'] = array_values($_SESSION['winkelmand']['items']);
        $_SESSION['winkelmand']['count'] = array_sum(array_column($_SESSION['winkelmand']['items'], 'quantity'));
        
        $response['success'] = true;
        $response['cart_count'] = $_SESSION['winkelmand']['count'];
        $response['cart_items'] = $_SESSION['winkelmand']['items'];
    }
    
    elseif ($action === 'remove_from_wishlist') {
        foreach ($_SESSION['wishlist']['items'] as $key => $item) {
            if ($item['id'] == $productId) {
                unset($_SESSION['wishlist']['items'][$key]);
                break;
            }
        }
        $_SESSION['wishlist']['items'] = array_values($_SESSION['wishlist']['items']);
        $_SESSION['wishlist']['count'] = count($_SESSION['wishlist']['items']);
        
        $response['success'] = true;
        $response['wishlist_count'] = $_SESSION['wishlist']['count'];
        $response['wishlist_items'] = $_SESSION['wishlist']['items'];
    }
    
    elseif ($action === 'update_quantity') {
        $quantity = $_POST['quantity'] ?? 1;
        
        foreach ($_SESSION['winkelmand']['items'] as &$item) {
            if ($item['id'] == $productId) {
                $item['quantity'] = max(1, $quantity);
                break;
            }
        }
        
        $_SESSION['winkelmand']['count'] = array_sum(array_column($_SESSION['winkelmand']['items'], 'quantity'));
        
        $response['success'] = true;
        $response['cart_count'] = $_SESSION['winkelmand']['count'];
        $response['cart_items'] = $_SESSION['winkelmand']['items'];
    }
    
    elseif ($action === 'get_cart') {
        $response['success'] = true;
        $response['cart_count'] = $_SESSION['winkelmand']['count'];
        $response['cart_items'] = $_SESSION['winkelmand']['items'];
    }
    
    elseif ($action === 'get_wishlist') {
        $response['success'] = true;
        $response['wishlist_count'] = $_SESSION['wishlist']['count'];
        $response['wishlist_items'] = $_SESSION['wishlist']['items'];
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>