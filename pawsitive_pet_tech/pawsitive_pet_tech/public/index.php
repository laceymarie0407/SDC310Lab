<?php
session_start();
require_once '../config/database.php';

// Default controller and action
$controller = $_GET['controller'] ?? 'product';
$action = $_GET['action'] ?? 'index';

// Include the correct controller
switch ($controller) {
    case 'cart':
        require_once '../controllers/CartController.php';
        $controllerInstance = new CartController($conn);
        break;
    case 'product':
    default:
        require_once '../controllers/ProductController.php';
        $controllerInstance = new ProductController($conn);
        break;
}

// Call the requested action
if (method_exists($controllerInstance, $action)) {
    $controllerInstance->$action();
} else {
    echo "Action '$action' not found!";
}