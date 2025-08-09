<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      min-height: 100vh;
    }
    .sidebar {
      height: 100vh;
      background-color: #343a40;
      color: white;
    }
    .sidebar a {
      color: white;
      text-decoration: none;
      display: block;
      padding: 12px 20px;
    }
    .sidebar a:hover {
      background-color: #495057;
    }
    .content {
      padding: 20px;
    }
    .progress {
      height: 18px;
    }
  </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 sidebar d-flex flex-column">
            <h4 class="text-center py-3 border-bottom">👤 </h4>

            <a href="<?php echo BASE_URL. 'admin.php' ?>"><i class="fas fa-tachometer-alt me-2"></i> Quản lý sản phẩm</a>      
            <a href="<?php echo BASE_URL. 'admin.php?action=category' ?>"><i class="fas fa-cogs me-2"></i> Quản lý danh mục</a>
            <a href="<?php echo BASE_URL. 'admin.php?action=order' ?>"><i class="fas fa-cogs me-2"></i> Quản lý đơn hàng</a>
            <a href="<?php echo BASE_URL. 'index.php?action=logout' ?>"><i class="fas fa-sign-out-alt me-2 text-danger"></i> <span class="text-danger">Đăng xuất</span></a>
            </nav>