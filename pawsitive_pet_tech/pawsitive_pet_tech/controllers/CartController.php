<?php
require_once '../config/database.php';
require_once '../models/Product.php';

class CartController {
    private $conn;
    private $productModel;

    public function __construct($conn) {
        $this->conn = $conn;
        $this->productModel = new Product($conn);

        // Make sure cart exists
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    // Display cart
    public function index() {
        $products = [];
        $total = 0;

        if (!empty($_SESSION['cart'])) {
            $ids = implode(',', array_keys($_SESSION['cart']));
            $result = $this->conn->query("SELECT * FROM products WHERE product_id IN ($ids)");

            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $row['quantity'] = $_SESSION['cart'][$row['product_id']];
                    $row['subtotal'] = $row['price'] * $row['quantity'];
                    $products[] = $row;
                    $total += $row['subtotal'];
                }
            }
        }

        // Tax and shipping
        $tax = $total * 0.06;
        $shipping = $total > 0 ? 5.00 : 0;
        $grand_total = $total + $tax + $shipping;

        // Pass variables to view
        require '../views/cart.php';
    }

    // Add product to cart
    public function add() {
        if (isset($_POST['add_to_cart'])) {
            $product_id = $_POST['product_id'];
            $quantity = max(1, (int)$_POST['quantity']); // Ensure min 1

            if (isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                $_SESSION['cart'][$product_id] = $quantity;
            }
        }

        // Redirect to cart page
        header("Location: index.php?controller=cart&action=index");
        exit;
    }

    // Update quantities in cart
    public function update() {
        if (isset($_POST['quantities']) && is_array($_POST['quantities'])) {
            foreach ($_POST['quantities'] as $id => $qty) {
                $qty = max(0, (int)$qty);
                if ($qty <= 0) {
                    unset($_SESSION['cart'][$id]);
                } else {
                    $_SESSION['cart'][$id] = $qty;
                }
            }
        }

        header("Location: index.php?controller=cart&action=index");
        exit;
    }

    // Checkout and clear cart
    public function checkout() {
        $_SESSION['cart'] = [];
        header("Location: index.php?controller=product&action=index");
        exit;
    }
}
