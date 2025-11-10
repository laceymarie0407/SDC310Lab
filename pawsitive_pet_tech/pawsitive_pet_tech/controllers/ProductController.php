<?php
require_once '../config/database.php';
require_once '../models/Product.php';

class ProductController {
    private $productModel;

    public function __construct($conn) {
        $this->productModel = new Product($conn);
    }

    public function index() {
    $products = $this->productModel->getAllProducts();
    require '../views/catalog.php';
}

}