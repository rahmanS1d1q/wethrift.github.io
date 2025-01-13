<?php
// ===== BAGIAN INISIALISASI =====
// Mencoba untuk memasukkan file common_function.php yang berisi fungsi-fungsi umum
if (file_exists('./functions/common_function.php')) {
    include('./functions/common_function.php');
} else {
    // Jika file common_function.php tidak ditemukan, buat koneksi database manual
    $con = mysqli_connect("153.92.15.44", "u523791406_wethrift", "", "u523791406_wethrift");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
}

// Mengambil ID pelanggan dari URL jika ada, jika tidak set sebagai null
$cust_id = isset($_GET['customer_id']) ? $_GET['customer_id'] : null;
// Set nama pelanggan - jika ada ID tampilkan "User", jika tidak tampilkan "Guest"
$cust_name = $cust_id ? "User" : "Guest";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ===== BAGIAN HEAD ===== -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeThrift</title>
    <!-- Favicon untuk ikon di tab browser -->
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">

    <!-- Memasukkan CSS Bootstrap dari CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Memasukkan Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- ===== BAGIAN CSS KUSTOM ===== -->
    <style>
        /* Mencegah scroll horizontal */
        body {
            overflow-x: hidden;
        }

        /* Grid layout untuk produk dengan responsive design */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
            padding: 1.5rem;
        }

        /* Styling untuk kartu produk */
        .product-card {
            height: 100%;
            display: flex;
            flex-direction: column;
            background: white;
            border: 1px solid rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        /* Efek hover pada kartu produk */
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        /* Container untuk gambar produk dengan aspect ratio 1:1 */
        .product-image-container {
            position: relative;
            padding-top: 100%;
            background: #f8f9fa;
        }

        /* Styling untuk gambar produk */
        .product-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 1rem;
        }

        /* Styling untuk informasi produk */
        .product-info {
            padding: 1rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        /* Styling untuk judul produk dengan batasan 2 baris */
        .product-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            height: 2.4em;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        /* Styling untuk ukuran dan harga produk */
        .product-size {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .product-price {
            font-weight: bold;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        /* Styling untuk navbar dan banner promo */
        .navbar .nav-link {
            color: white !important;
        }

        .promo-banner {
            background: linear-gradient(45deg, #0dcaf0, #0d6efd);
            color: white;
            padding: 1rem;
            text-align: center;
            font-weight: 500;
        }

        /* Styling untuk tombol Add to Cart */
        .btn-add-cart {
            background-color: #0dcaf0;
            color: white;
            border: none;
            width: 100%;
            padding: 0.75rem;
            border-radius: 4px;
            transition: background-color 0.2s;
        }

        .btn-add-cart:hover {
            background-color: #0bb5d7;
            color: white;
        }
    </style>
</head>

<body>
    <!-- ===== BAGIAN NAVBAR ===== -->
    <nav class="navbar navbar-expand-lg bg-info">
        <!-- Navbar dengan logo dan menu -->
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#">
                <i class="fa fa-shopping-basket"></i> WeThrift
            </a>
            <!-- Tombol hamburger untuk tampilan mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Menu navbar -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <div class="d-flex gap-2">
                    <a href="./about_us.php" class="btn btn-info text-white">About Us</a>
                    <a href="./customer_mode/customer_registration.php" class="btn btn-light">Signup</a>
                    <a href="./start.php" class="btn btn-dark">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- ===== WELCOME BANNER ===== -->
    <!-- Banner yang menampilkan nama user -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container-fluid">
            <span class="navbar-text text-white">
                Welcome <?php echo $cust_name; ?>
            </span>
        </div>
    </nav>

    <!-- ===== PROMO BANNER ===== -->
    <div class="promo-banner">
        Splash into Savings this NEW YEAR Season with WeThrift!!!
    </div>

    <!-- ===== PRODUCT GRID ===== -->
    <div class="container-fluid px-4">
        <div class="product-grid">
            <?php
            // Query untuk mengambil semua produk dari database
            $query = "SELECT * FROM product";
            $result = mysqli_query($con, $query);

            // Jika ada produk, tampilkan dalam grid
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <!-- Card untuk setiap produk -->
                    <div class="product-card">
                        <div class="product-image-container">
                            <img src="images/<?php echo htmlspecialchars($row['prod_image']); ?>" 
                                 class="product-image" 
                                 alt="<?php echo htmlspecialchars($row['name']); ?>">
                        </div>
                        <div class="product-info">
                            <h5 class="product-title"><?php echo htmlspecialchars($row['name']); ?></h5>
                            <div class="product-size"><?php echo htmlspecialchars($row['description']); ?></div>
                            <div class="product-price">
                                Rp. <?php echo number_format($row['price'], 0, ',', '.'); ?>
                            </div>
                            <a href="start.php" class="btn btn-add-cart">Add to Cart</a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                // Jika tidak ada produk, tampilkan pesan
                echo "<div class='col-12 text-center'><p>No products available.</p></div>";
            }
            ?>
        </div>
    </div>

    <!-- ===== FOOTER ===== -->
    <footer class="bg-info text-white mt-4">
        <div class="container py-3">
            <div class="row">
                <!-- Copyright text -->
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">All rights reserved © 2024 WeThrift | Rahman Shiddiq</p>
                </div>
                <!-- Social media links -->
                <div class="col-md-6 text-center text-md-end">
                    <a href="https://www.facebook.com/profile.php?id=100005492715647" class="text-white me-3">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-white me-3">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.instagram.com/_rahmannn09/" class="text-white me-3">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://wa.me/081913868745" class="text-white">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Memasukkan JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>