<?php
if (!isset($con)) {
    include("../includes/connect.php");
}

// Fetch core statistics as before
$stats_query = "SELECT 
    (SELECT COUNT(*) FROM `order`) as total_orders,
    (SELECT COUNT(DISTINCT customerID) FROM `order`) as total_customers,
    (SELECT COUNT(*) FROM deliveryagent WHERE availabilityStatus = 'Available') as available_agents,
    (SELECT SUM(total_price) FROM `order` WHERE time >= DATE_FORMAT(NOW() ,'%Y-%m-01')) as current_revenue";
$stats_result = mysqli_query($con, $stats_query);
$stats = mysqli_fetch_assoc($stats_result);

// Fetch brand analytics
$brand_query = "SELECT 
    brand,
    COUNT(*) as product_count,
    AVG(price) as avg_price,
    SUM(stock) as total_stock,
    SUM(qty_bought) as total_sold
FROM product 
GROUP BY brand 
ORDER BY avg_price DESC";
$brand_result = mysqli_query($con, $brand_query);

// Fetch monthly revenue data
$revenue_query = "SELECT DATE_FORMAT(time, '%M %Y') as month, SUM(total_price) as revenue 
                 FROM `order` 
                 GROUP BY DATE_FORMAT(time, '%M %Y')
                 ORDER BY MIN(time) DESC 
                 LIMIT 6";
$revenue_result = mysqli_query($con, $revenue_query);
?>


<!-- Page Header -->
<div class="container-fluid px-4 py-3">
    

    <!-- Welcome Message & Page Description -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-1">Selamat Datang di Dashboard Analytics</h4>
                            <p class="mb-0">Pantau performa toko Anda dengan data real-time dan insights yang akurat</p>
                        </div>
                        <i class="fas fa-chart-line fa-3x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Last Updated Info -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="mb-0">Overview Statistik</h5>
            <small class="text-muted">Terakhir diperbarui: <?php echo date('d M Y H:i'); ?></small>
        </div>
        <button class="btn btn-info" onclick="window.location.reload();">
            <i class="fas fa-sync-alt me-2"></i>Perbarui Data
        </button>
    </div>

    <!-- Rest of the dashboard content... (previous code remains the same) -->
</div>

<!-- Rest of the previous code... -->

<!-- Dashboard Container -->
<div class="container-fluid px-4">
    <!-- Metric Cards Row -->
    <div class="row g-4 mb-4">
        <!-- Core metric cards as before -->
        <div class="col-md-3">
            <div class="card bg-info text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-3">Total Pesanan</h6>
                            <h2 class="mb-0"><?php echo number_format($stats['total_orders']); ?></h2>
                        </div>
                        <i class="fas fa-shopping-cart fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-info text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-3">Pendapatan Bulan Ini</h6>
                            <h2 class="mb-0">Rp <?php echo number_format($stats['current_revenue']); ?></h2>
                        </div>
                        <i class="fas fa-money-bill-wave fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-info text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-3">Total Pelanggan</h6>
                            <h2 class="mb-0"><?php echo number_format($stats['total_customers']); ?></h2>
                        </div>
                        <i class="fas fa-users fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-info text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-3">Kurir Tersedia</h6>
                            <h2 class="mb-0"><?php echo number_format($stats['available_agents']); ?></h2>
                        </div>
                        <i class="fas fa-truck fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Brand Analytics Table -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Analisis Brand</h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-info">
                                <tr>
                                    <th>Brand</th>
                                    <th>Jumlah Produk</th>
                                    <th>Rata-rata Harga</th>
                                    <th>Total Stok</th>
                                    <th>Total Terjual</th>
                                    <th>Performa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($brand = mysqli_fetch_assoc($brand_result)) {
                                    $performance = $brand['total_sold'] / ($brand['total_sold'] + $brand['total_stock']) * 100;
                                    echo "<tr>
                                            <td>{$brand['brand']}</td>
                                            <td>" . number_format($brand['product_count']) . "</td>
                                            <td>Rp " . number_format($brand['avg_price']) . "</td>
                                            <td>" . number_format($brand['total_stock']) . "</td>
                                            <td>" . number_format($brand['total_sold']) . "</td>
                                            <td>
                                                <div class='progress' style='height: 6px;'>
                                                    <div class='progress-bar bg-info' role='progressbar' 
                                                         style='width: {$performance}%' 
                                                         aria-valuenow='{$performance}' 
                                                         aria-valuemin='0' 
                                                         aria-valuemax='100'></div>
                                                </div>
                                            </td>
                                          </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row">
        <!-- Revenue Chart -->
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Trend Pendapatan</h5>
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Brand Distribution Chart -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Distribusi Brand</h5>
                    <canvas id="brandChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Initialize Charts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Revenue Chart
const revenueCtx = document.getElementById('revenueChart').getContext('2d');
new Chart(revenueCtx, {
    type: 'line',
    data: {
        labels: [<?php
            $labels = [];
            $values = [];
            while ($row = mysqli_fetch_assoc($revenue_result)) {
                $labels[] = "'" . $row['month'] . "'";
                $values[] = $row['revenue'];
            }
            echo implode(',', array_reverse($labels));
        ?>],
        datasets: [{
            label: 'Pendapatan',
            data: [<?php echo implode(',', array_reverse($values)); ?>],
            borderColor: 'rgb(13, 202, 240)',
            backgroundColor: 'rgba(13, 202, 240, 0.1)',
            fill: true,
            tension: 0.3
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: value => 'Rp ' + value.toLocaleString('id-ID')
                }
            }
        }
    }
});

// Reset brand query for pie chart
<?php
mysqli_data_seek($brand_result, 0);
?>

// Brand Distribution Chart
const brandCtx = document.getElementById('brandChart').getContext('2d');
new Chart(brandCtx, {
    type: 'pie',
    data: {
        labels: [<?php
            $brand_labels = [];
            $brand_values = [];
            while ($row = mysqli_fetch_assoc($brand_result)) {
                $brand_labels[] = "'" . $row['brand'] . "'";
                $brand_values[] = $row['product_count'];
            }
            echo implode(',', $brand_labels);
        ?>],
        datasets: [{
            data: [<?php echo implode(',', $brand_values); ?>],
            backgroundColor: [
                'rgba(13, 202, 240, 0.8)',
                'rgba(255, 193, 7, 0.8)',
                'rgba(220, 53, 69, 0.8)',
                'rgba(25, 135, 84, 0.8)',
                'rgba(102, 16, 242, 0.8)',
                'rgba(232, 62, 140, 0.8)'
            ]
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
</script>