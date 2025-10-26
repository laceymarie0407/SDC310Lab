<?php
require_once '../models/Product.php';

class ProductController {
    private $productModel;

    public function __construct($conn) {
        $this->productModel = new Product($conn);
    }

    public function listProducts() {
        return $this->productModel->getAllProducts();
    }
}

// Usage
$controller = new ProductController($conn);
$products = $controller->listProducts();
?>
