<?php

$action = $_GET['action'] ?? '/';
$homeController = new HomeController();
$authController = new AuthController();
$categoryController = new CategoryController();
$productController = new ProductController();
match ($action) {
    '/'         => $homeController->index(),
    'login'     => $authController->login(),
    'logout'    => $authController->logout(),
    'register'  => $authController->register(),
    'category'  => $categoryController->index(),
    'product'   => $productController->show(),
    'cart'      => (new CartController())->index(),
    'cart-add'  => (new CartController())->add(),
    'cart-remove' => (new CartController())->remove(),
    'cart-update' => (new CartController())->update(),
    'order'     => (new OrderController())->index(),
    'order-add' => (new OrderController())->add(),
    'order-success' => (new OrderController())->success(),
};