<?php
require_once '../config/database.php';

// Always define $products
$products = [];

// Query the database
$query = "SELECT * FROM products";
$result = $conn->query($query);

// If the query works, fetch data
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Pawsitive Pet Tech Catalog</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #fafafa;
      padding: 20px;
    }
    h1 {
      color: #333;
    }
    .catalog-container {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
	}
	.product {
	  flex: 1 1 250px;
	  border: 1px solid #ddd;
	  border-radius: 10px;
	  padding: 15px;
	  background: #fff;
	  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
	  text-align: center;
	}

    button {
      background-color: #4CAF50;
      color: white;
      border: none;
      padding: 8px 12px;
      cursor: pointer;
      border-radius: 5px;
    }
    button:hover {
      background-color: #45a049;
    }
    .view-cart {
      background-color: #2196F3;
      color: white;
      text-decoration: none;
      padding: 8px 12px;
      border-radius: 5px;
      margin-bottom: 15px;
      display: inline-block;
    }
    img {
      width: 150px;
      height: auto;
      margin-bottom: 10px;
      border-radius: 6px;
    }
  </style>
</head>
<body>
  <h1>🐾 Pawsitive Pet Tech Catalog</h1>

  <a href="cart.php" class="view-cart">🛒 View Cart</a>

  <?php if (empty($products)): ?>
    <p>No products found. Please check your database table name and data.</p>
  <?php else: ?>
    <?php foreach ($products as $product): ?>
      <div class="product">
        <h3><?= htmlspecialchars($product['product_name']) ?></h3>
        <img src="../images/<?= htmlspecialchars($product['product_code']) ?>.jpg"
             alt="<?= htmlspecialchars($product['product_name']) ?>">
        <p><strong>Product ID:</strong> <?= htmlspecialchars($product['product_id']) ?></p>
        <p><strong>Code:</strong> <?= htmlspecialchars($product['product_code']) ?></p>
        <p><?= htmlspecialchars($product['product_description']) ?></p>
        <p><strong>Price:</strong> $<?= number_format($product['price'], 2) ?></p>

        <form method="post" action="cart.php">
          <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['product_id']) ?>">
          <label>Quantity: </label>
          <input type="number" name="quantity" value="1" min="1">
          <button type="submit" name="add_to_cart">Add to Cart</button>
        </form>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>

</body>
</html>
