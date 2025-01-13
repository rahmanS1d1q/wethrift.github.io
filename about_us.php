<?php
    // ===== KONFIGURASI BAHASA DAN KONTEN =====
    $pageTitle = "About Us - WeThrift"; // Judul halaman default
    // Mengambil preferensi bahasa dari URL, default ke bahasa Indonesia jika tidak ada
    $lang = isset($_GET['lang']) ? $_GET['lang'] : 'id';

    // Array multi-dimensi untuk menyimpan konten dalam dua bahasa
    $content = [
        // Konten dalam Bahasa Indonesia
        'id' => [
            'title' => 'Tentang Kami - WeThrift',
            'nav_home' => 'Beranda',
            'nav_register' => 'Daftar',
            'nav_login' => 'Masuk',
            'welcome' => 'Selamat Datang di WeThrift',
            'tagline' => 'Di Mana Gaya Bertemu Keberlanjutan',
            'environmental' => 'Pelestarian Lingkungan',
            'environmental_desc' => 'Kami berkomitmen untuk melestarikan lingkungan melalui fashion yang akan berkelanjutan dengan pengurangan limbah.',
            'price' => 'Harga Terjangkau',
            'price_desc' => 'Fashion berkualitas tidak harus mahal. Kami menawarkan barang premium dengan harga yang terjangkau untuk semua orang.',
            'quality' => 'Jaminan Kualitas',
            'quality_desc' => 'Setiap barang diperiksa dengan teliti untuk memastikan memenuhi standar kualitas dan keaslian produk yang tinggi.',
            'our_story' => 'Cerita Kami',
            'story_lead' => 'WeThrift didirikan dengan visi sederhana namun kuat: menjadikan fashion berkelanjutan dapat diakses oleh semua orang sambil melestarikan lingkungan alam.',
            'story_desc' => 'Kami percaya pada konsumsi yang bertanggung jawab dan kemampuannya untuk menciptakan perubahan positif. Setiap barang dalam koleksi kami merepresentasikan kesempatan untuk mengurangi limbah, mendukung kegiatan berkelanjutan, dan tetap tampil modis dan keren.',
            'copyright' => 'Hak Cipta'
        ],
        // Konten dalam Bahasa Inggris
        'en' => [
            'title' => 'About Us - WeThrift',
            'nav_home' => 'Home',
            'nav_register' => 'Register',
            'nav_login' => 'Login',
            'welcome' => 'Welcome to WeThrift',
            'tagline' => 'Where Style Meets Sustainability',
            'environmental' => 'Environmental Stewardship',
            'environmental_desc' => 'We are committed to preserving the environment through sustainable fashion practices and waste reduction.',
            'price' => 'Affordable Prices',
            'price_desc' => 'Quality fashion doesn\'t have to be expensive. We offer premium items at prices everyone can afford.',
            'quality' => 'Quality Assurance',
            'quality_desc' => 'Every item is carefully inspected to ensure it meets our high standards for quality and authenticity.',
            'our_story' => 'Our Story',
            'story_lead' => 'WeThrift was founded with a simple yet powerful vision: to make sustainable fashion accessible to everyone while preserving our environment.',
            'story_desc' => 'We believe in the power of conscious consumption and its ability to create positive change. Each item in our collection represents an opportunity to reduce waste, support sustainable practices, and look great doing it.',
            'copyright' => 'Copyright'
        ]
    ];
?>

<!DOCTYPE html>
<!-- Set bahasa HTML sesuai preferensi yang dipilih -->
<html lang="<?php echo $lang; ?>">
<head>
    <!-- ===== META TAGS & RESOURCES ===== -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $content[$lang]['title']; ?></title>
    
    <!-- External CSS Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    
    <!-- ===== CUSTOM CSS STYLES ===== -->
    <style>
        /* Hero section styling dengan gradient background */
        .hero-section {
            background: linear-gradient(45deg, #0dcaf0, #0d6efd);
            color: white;
            padding: 4rem 2rem;
            text-align: center;
        }
        
        /* Mission section styling dengan background abu-abu */
        .mission-section {
            padding: 4rem 0;
            background-color: #f8f9fa;
        }
        
        /* Card styling untuk value proposition */
        .value-card {
            padding: 2rem;
            border-radius: 10px;
            background: white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            height: 100%;
            transition: transform 0.3s;
        }
        
        /* Hover effect untuk value card */
        .value-card:hover {
            transform: translateY(-5px);
        }
        
        /* Styling untuk lingkaran ikon */
        .icon-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #0dcaf0;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }
        
        /* Styling untuk ikon di dalam lingkaran */
        .icon-circle i {
            font-size: 2rem;
            color: white;
        }

        /* Styling untuk language switcher */
        .lang-switch {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }

        /* Styling untuk tombol language switcher */
        .lang-switch a {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
            transition: background-color 0.3s;
        }

        .lang-switch a:hover {
            background-color: rgba(0, 0, 0, 0.7);
        }

        /* Style untuk tombol bahasa yang aktif */
        .lang-switch a.active {
            background-color: #0dcaf0;
        }
    </style>
</head>
<body>
    <!-- ===== LANGUAGE SWITCHER ===== -->
    <!-- Tombol untuk mengganti bahasa antara ID dan EN -->
    <div class="lang-switch">
        <a href="?lang=id" class="<?php echo $lang === 'id' ? 'active' : ''; ?>">ID</a>
        <a href="?lang=en" class="<?php echo $lang === 'en' ? 'active' : ''; ?>">EN</a>
    </div>

    <!-- ===== NAVBAR ===== -->
    <nav class="navbar navbar-expand-lg bg-info">
        <div class="container">
            <!-- Logo dan Brand -->
            <a class="navbar-brand text-white" href="#">
                <i class="fa fa-shopping-basket"></i> WeThrift
            </a>
            <!-- Tombol hamburger untuk tampilan mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Menu navigasi -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <div class="d-flex gap-2">
                    <a href="index.php" class="btn btn-info text-white">
                        <?php echo $content[$lang]['nav_home']; ?>
                    </a>
                    <a href="./customer_mode/customer_registration.php" class="btn btn-light">
                        <?php echo $content[$lang]['nav_register']; ?>
                    </a>
                    <a href="./start.php" class="btn btn-dark">
                        <?php echo $content[$lang]['nav_login']; ?>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- ===== HERO SECTION ===== -->
    <!-- Bagian banner utama dengan welcome message -->
    <section class="hero-section">
        <div class="container">
            <h1 class="display-4 mb-4"><?php echo $content[$lang]['welcome']; ?></h1>
            <p class="lead"><?php echo $content[$lang]['tagline']; ?></p>
        </div>
    </section>

    <!-- ===== MISSION SECTION ===== -->
    <!-- Bagian yang menampilkan value proposition perusahaan -->
    <section class="mission-section">
        <div class="container">
            <div class="row g-4">
                <!-- Card Pelestarian Lingkungan -->
                <div class="col-md-4">
                    <div class="value-card">
                        <div class="icon-circle">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <h3 class="text-center mb-3"><?php echo $content[$lang]['environmental']; ?></h3>
                        <p class="text-center"><?php echo $content[$lang]['environmental_desc']; ?></p>
                    </div>
                </div>
                
                <!-- Card Harga Terjangkau -->
                <div class="col-md-4">
                    <div class="value-card">
                        <div class="icon-circle">
                            <i class="fas fa-tag"></i>
                        </div>
                        <h3 class="text-center mb-3"><?php echo $content[$lang]['price']; ?></h3>
                        <p class="text-center"><?php echo $content[$lang]['price_desc']; ?></p>
                    </div>
                </div>
                
                <!-- Card Jaminan Kualitas -->
                <div class="col-md-4">
                    <div class="value-card">
                        <div class="icon-circle">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h3 class="text-center mb-3"><?php echo $content[$lang]['quality']; ?></h3>
                        <p class="text-center"><?php echo $content[$lang]['quality_desc']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== ABOUT CONTENT SECTION ===== -->
    <!-- Bagian yang menjelaskan cerita perusahaan -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="text-center mb-4"><?php echo $content[$lang]['our_story']; ?></h2>
                    <p class="lead text-center mb-4"><?php echo $content[$lang]['story_lead']; ?></p>
                    <p class="text-center"><?php echo $content[$lang]['story_desc']; ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== FOOTER ===== -->
    <footer class="bg-info text-white py-4">
        <div class="container">
            <div class="row">
                <!-- Copyright text -->
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0"><?php echo $content[$lang]['copyright']; ?> © 2024 WeThrift | Rahman Shiddiq</p>
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

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>