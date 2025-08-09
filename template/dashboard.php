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

      <a href="#"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
      <a href="#"><i class="fas fa-cogs me-2"></i> Settings</a>
      <a href="#"><i class="fas fa-table me-2"></i> Tables</a>
      <a href="#"><i class="fas fa-sign-out-alt me-2 text-danger"></i> <span class="text-danger">Đăng xuất</span></a>
    </nav>

    <!-- Main content -->
    <main class="col-md-9 col-lg-10 content">
      <h2>Simple Tables</h2>

      <div class="card">
        <div class="card-header">
          <strong>Bordered Table</strong>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <thead class="table-light">
              <tr>
                <th>#</th>
                <th>Task</th>
                <th>Progress</th>
                <th>Label</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1.</td>
                <td>Update software</td>
                <td>
                  <div class="progress">
                    <div class="progress-bar bg-primary" style="width: 55%"></div>
                  </div>
                </td>
                <td><span class="badge bg-danger">55%</span></td>
              </tr>
              <tr>
                <td>2.</td>
                <td>Clean database</td>
                <td>
                  <div class="progress">
                    <div class="progress-bar bg-warning" style="width: 70%"></div>
                  </div>
                </td>
                <td><span class="badge bg-warning text-dark">70%</span></td>
              </tr>
              <tr>
                <td>3.</td>
                <td>Cron job running</td>
                <td>
                  <div class="progress">
                    <div class="progress-bar bg-info" style="width: 30%"></div>
                  </div>
                </td>
                <td><span class="badge bg-info text-dark">30%</span></td>
              </tr>
              <tr>
                <td>4.</td>
                <td>Fix and squish bugs</td>
                <td>
                  <div class="progress">
                    <div class="progress-bar bg-success" style="width: 90%"></div>
                  </div>
                </td>
                <td><span class="badge bg-success">90%</span></td>
              </tr>
            </tbody>
          </table>

          <!-- Pagination -->
          <nav class="mt-3">
            <ul class="pagination justify-content-end mb-0">
              <li class="page-item disabled"><a class="page-link" href="#">«</a></li>
              <li class="page-item active"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">»</a></li>
            </ul>
          </nav>

        </div>
      </div>
    </main>
  </div>
</div>

</body>
</html>
