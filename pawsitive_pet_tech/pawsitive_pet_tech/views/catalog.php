<!DOCTYPE html>
<html>
<head>
  <title>Pawsitive Pet Tech Catalog</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<h1>🐾 Pawsitive Pet Tech Catalog</h1>
<a href="index.php?controller=cart&action=index" class="view-cart">🛒 View Cart</a>

<div class="catalog-container">
<?php foreach ($products as $product): ?>
    <div class="product">
        <h3><?= htmlspecialchars($product['product_name']) ?></h3>
        <img src="images/<?= htmlspecialchars($product['product_code']) ?>.jpg" alt="<?= htmlspecialchars($product['product_name']) ?>">
        <p><?= htmlspecialchars($product['product_description']) ?></p>
        <p><strong>Price:</strong> $<?= number_format($product['price'], 2) ?></p>

        <form method="post" action="index.php?controller=cart&action=add">
            <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
            <label>Quantity: </label>
            <input type="number" name="quantity" value="1" min="1">
            <button type="submit" name="add_to_cart">Add to Cart</button>
        </form>
    </div>
<?php endforeach; ?>
</div>
</body>
</html>
