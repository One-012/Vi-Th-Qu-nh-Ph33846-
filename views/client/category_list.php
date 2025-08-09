<!-- Products Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
            <h6 class="text-primary text-uppercase">Danh mục</h6>
            <h1 class="display-5 text-uppercase mb-0"><?php echo $categoryCurrent['name']?></h1>
        </div>
        
        <div class="container py-4">
            <div class="row g-4">
                <?php
                foreach ($products as $product) {
                    $image = $product['main_image'] ? $product['main_image'] : 'default.png';
                    $image = PATH_IMAGE . $image;
                ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card h-100 text-center shadow-sm border-0">
                            <img src="<?php echo $image; ?>" style="height:300px!important;"
                                class="card-img-top img-fluid p-3" 
                                alt="<?php echo htmlspecialchars($product['name']); ?>">
                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title text-uppercase mb-2">
                                    <?php echo htmlspecialchars($product['name']); ?>
                                </h6>
                                <h5 class="text-primary mb-3">$<?php echo $product['price']; ?></h5>
                                <div class="mt-auto d-flex justify-content-center gap-2">
                                    <a href="<?php echo BASE_URL . 'index.php?action=product&id=' . $product['id']; ?>" 
                                    class="btn btn-primary btn-sm">
                                    <i class="bi bi-cart"></i>
                                    </a>
                                    <a href="<?php echo BASE_URL . 'index.php?action=product&id=' . $product['id']; ?>" 
                                    class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-eye"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <!-- Pagination Start -->
            <?php if ($totalPages > 1): ?>
                <nav aria-label="Page navigation" class="mt-5">
                    <ul class="pagination justify-content-center">
                        <!-- Nút Previous -->
                        <li class="page-item <?php if ($currentPage <= 1) echo 'disabled'; ?>">
                            <a class="page-link" 
                               href="<?php echo BASE_URL . 'index.php?action=category&id=' . $categoryCurrent['id'] . '&page=' . ($currentPage - 1); ?>" 
                               tabindex="-1">«</a>
                        </li>

                        <!-- Các số trang -->
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?php if ($i == $currentPage) echo 'active'; ?>">
                                <a class="page-link" 
                                   href="<?php echo BASE_URL . 'index.php?action=category&id=' . $categoryCurrent['id'] . '&page=' . $i; ?>">
                                   <?php echo $i; ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <!-- Nút Next -->
                        <li class="page-item <?php if ($currentPage >= $totalPages) echo 'disabled'; ?>">
                            <a class="page-link" 
                               href="<?php echo BASE_URL . 'index.php?action=category&id=' . $categoryCurrent['id'] . '&page=' . ($currentPage + 1); ?>">
                               »
                            </a>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?>
            <!-- Pagination End -->

        </div>
    </div>
</div>
<!-- Products End -->
