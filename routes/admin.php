<?php

$action = $_GET['action'] ?? '/';
$dashboardController = new DashboardController();

match ($action) {
    '/'         => $dashboardController->index(),
    'add-product' => $dashboardController->addProduct(),
    'edit-product' => $dashboardController->editProduct(),
    'delete-product' => $dashboardController->deleteProduct(),
    'category'  => (new CategoryController())->index(),
    'add-category' => (new CategoryController())->addCategory(),
    'edit-category' => (new CategoryController())->editCategory(),
    'delete-category' => (new CategoryController())->deleteCategory(),
    'order'     => (new OrderController())->index(),
    default    => $dashboardController->index(),
};