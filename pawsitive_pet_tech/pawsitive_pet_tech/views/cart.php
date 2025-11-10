<!DOCTYPE html>
<html>
<head>
    <title>Pawsitive Pet Tech - Shopping Cart</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h1>🛒 Your Shopping Cart</h1>
<a href="index.php?controller=product&action=index" class="back-link">← Continue Shopping</a>

<?php if (empty($products)): ?>
    <p>Your cart is empty.</p>
<?php else: ?>
    <form method="post" action="index.php?controller=cart&action=update">
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= htmlspecialchars($product['product_name']) ?></td>
                        <td>$<?= number_format($product['price'], 2) ?></td>
                        <td>
                            <input type="number" 
                                   name="quantities[<?= $product['product_id'] ?>]" 
                                   value="<?= (int)$product['quantity'] ?>" 
                                   min="0">
                        </td>
                        <td>$<?= number_format($product['subtotal'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
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
            </tfoot>
        </table>

        <div class="actions">
            <button type="submit">Update Cart</button>
        </div>
    </form>

    <form method="post" action="index.php?controller=cart&action=checkout">
        <div class="actions">
            <button type="submit">Proceed to Checkout</button>
        </div>
    </form>
<?php endif; ?>
</body>
</html>
