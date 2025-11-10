<?php
require_once '../controllers/ProductController.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pawsitive Pet Tech Products </title>
    <link rel="stylesheet" href="/public/styles.css">
</head>
<body>
<h1>🐾 Pawsitive Pet Tech Products </h1>

<?php foreach($products as $product): ?>
    <div>
        <h3><?= htmlspecialchars($product['product_name']) ?></h3>
        <p><strong>ID:</strong> <?= $product['product_id'] ?></p>
        <p><?= htmlspecialchars($product['product_description']) ?></p>
        <p><strong>Price:</strong> $<?= number_format($product['price'], 2) ?></p>
    </div>
<?php endforeach; ?>

</body>
</html>
