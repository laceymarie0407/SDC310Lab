<?php
session_start();
require_once '../config/database.php';

// Initialize cart
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add to cart
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = (int) $_POST['quantity'];

    if ($quantity > 0) {
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id] += $quantity;
        } else {
            $_SESSION['cart'][$product_id] = $quantity;
        }
    }
    header("Location: cart.php");
    exit;
}

// Update quantities
if (isset($_POST['update_cart'])) {
    foreach ($_POST['quantities'] as $id => $qty) {
        $qty = (int) $qty;
        if ($qty <= 0) {
            unset($_SESSION['cart'][$id]);
        } else {
            $_SESSION['cart'][$id] = $qty;
        }
    }
    header("Location: cart.php");
    exit;
}

// Get product info for items in cart
$products = [];
$total = 0;
if (!empty($_SESSION['cart'])) {
    $ids = implode(',', array_keys($_SESSION['cart']));
    $result = $conn->query("SELECT * FROM products WHERE product_id IN ($ids)");

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
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fafafa;
            padding: 20px;
        }
        h1 { text-align: center; }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th { background-color: #f2f2f2; }
        .actions {
            display: flex;
            justify-content: space-between;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover { background-color: #45a049; }
        .back-link {
            display: inline-block;
            background: #555;
            color: #fff;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 5px;
        }
        .back-link:hover { background: #333; }
    </style>
</head>
<body>
    <h1>🛒 Your Shopping Cart</h1>
    <div class="actions">
        <a href="catalog.php" class="back-link">← Continue Shopping</a>
    </div>

    <?php if (empty($products)): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <form method="post">
            <table>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product['product_name']) ?></td>
                    <td>$<?= number_format($product['price'], 2) ?></td>
                    <td>
                        <input type="number" name="quantities[<?= $product['product_id'] ?>]" 
                               value="<?= $product['quantity'] ?>" min="0" style="width:60px;">
                    </td>
                    <td>$<?= number_format($product['subtotal'], 2) ?></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" align="right"><strong>Tax (6%)</strong></td>
                    <td>$<?= number_format($tax, 2) ?></td>
                </tr>
                <tr>
                    <td colspan="3" align="right"><strong>Shipping</strong></td>
                    <td>$<?= number_format($shipping, 2) ?></td>
                </tr>
                <tr>
                    <td colspan="3" align="right"><strong>Total</strong></td>
                    <td><strong>$<?= number_format($grand_total, 2) ?></strong></td>
                </tr>
            </table>

            <div class="actions">
                <button type="submit" name="update_cart">Update Cart</button>
                <button type="button" onclick="alert('Checkout feature coming soon!')">Checkout</button>
            </div>
        </form>
    <?php endif; ?>
</body>
</html>
