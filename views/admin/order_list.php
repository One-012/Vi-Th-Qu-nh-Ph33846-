<!-- Main content -->
<main class="col-md-9 col-lg-10 content">
    <h2>Quản lý đơn hàng</h2>
    
    <div class="card">
        <div class="card-header">
            <strong>Danh sách đơn hàng</strong>          
        </div>
        <div class="card-body">
            <?php
            // Giả sử $orders là mảng chứa danh sách đơn hàng
            if (empty($orders)) {
                echo "<p>Không có đơn hàng nào.</p>";
            } else {
                echo '<table class="table table-bordered">';
                echo '<thead class="table-light">';
                echo '<tr>';
                echo '<th>TT</th>';
                echo '<th>Mã đơn hàng</th>';
                echo '<th>Ngày đặt</th>';
                echo '<th>Tổng tiền</th>';
                echo '<th>Trạng thái</th>';
                echo '<th>Chi tiết</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                $i = 1;
                foreach ($orders as $order) {
                    echo "<tr>";
                    echo "<td>{$i}</td>";
                    echo "<td>{$order['id']}</td>";
                    echo "<td>" . date('d-m-Y H:i:s', strtotime($order['created_at'])) . "</td>";
                    echo "<td>" . number_format($order['total'], 0, ',', '.') . " VNĐ</td>";
                    echo "<td>{$order['status']}</td>";
                    echo "<td><a href='" . BASE_URL . "admin.php?action=order-detail&id={$order['id']}' class='btn btn-info'>Xem chi tiết</a></td>";
                    echo "</tr>";
                    $i++;
                }
                echo '</tbody>';
                echo '</table>';
            }   
            ?>

           
        </div>
    </div>
</main>

