<?php
// Menyertakan file fungsi umum untuk mendukung berbagai fitur
include ('../functions/common_function.php'); 

// Mengecek apakah parameter 'agent_id' dikirim melalui URL
if (isset ($_GET['agent_id'])) {
    $agent_id = $_GET['agent_id']; // Mendapatkan agent_id dari URL

    // Query untuk mengambil data agen berdasarkan agentID
    $get_data = "SELECT * FROM deliveryAgent WHERE agentID = $agent_id;";
    $result_get = mysqli_query($con, $get_data); // Menjalankan query
    $row_data = mysqli_fetch_assoc($result_get); // Mengambil hasil query sebagai array asosiatif

    // Menyimpan data agen ke dalam variabel
    $agent_fname = $row_data['first_name']; // Nama depan agen
    $agent_lname = $row_data['last_name']; // Nama belakang agen (bisa null)
    $current_status = $row_data['availabilityStatus']; // Status ketersediaan agen

    // Mengecek apakah nama belakang agen kosong
    if ($agent_lname === null) {
        $agent_name = $agent_fname; // Jika nama belakang kosong, hanya gunakan nama depan
    } else {
        $agent_name = $agent_fname . ' ' . $agent_lname; // Gabungkan nama depan dan nama belakang
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeThrift</title>
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">

    <!-- Bootstrap CSS untuk styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Link ke file CSS tambahan -->
    <link rel="stylesheet" href="style.css">

    <style>
        /* Styling tambahan untuk halaman */
        body {
            overflow-x: hidden; /* Menyembunyikan scroll horizontal */
        }
    </style>
</head>

<body>

    <!-- Navbar untuk navigasi -->
    <div class="container-fluid p-0">

        <!-- Bagian pertama: Navbar -->
        <nav class="navbar navbar-expand-lg bg-info">
            <div class="container-fluid">
                <!-- Logo aplikasi -->
                <a class="navbar-brand" href="#"><i class="fa fa-shopping-basket" aria-hidden="true"> WeThrift</i></a>

                <!-- Tombol toggle untuk layar kecil -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Menu navigasi -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <!-- Link ke profil agen -->
                            <a class="nav-link active" aria-current="page"
                                href='profile_page.php?agent_id=<?php echo "$agent_id"; ?>'>My Profile</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Bagian ketiga: Konten utama -->
        <div class="row">
            <div class="col-md-10">
                <div class="row">
                    <!-- Area untuk menampilkan pesanan dari database -->
                    <?php
                    // Fungsi untuk menampilkan pesanan agen akan ditempatkan di sini
                    ?>
                </div>
            </div>
        </div>

        <!-- Bagian keempat: Konten tambahan -->
        <?php
        // Memuat konten dinamis berdasarkan parameter URL
        if (isset ($_GET['offlineHome'])) {
            include ('offlineHome.php'); // Menampilkan halaman offlineHome
        }
        if (isset ($_GET['home'])) {
            include ('home.php'); // Menampilkan halaman home
        }
        if (isset ($_GET['deliver_order'])) {
            include ('deliver_order.php'); // Menampilkan halaman untuk mengantarkan pesanan
        }
        if (isset ($_GET['takeToHome'])) {
            include ('takeToHome.php'); // Menampilkan halaman untuk kembali ke home
        }
        if (isset ($_GET['takeToOffline'])) {
            include ('takeToOffline.php'); // Menampilkan halaman untuk status offline
        }
        ?>

    </div>

    <!-- Bagian terakhir: Footer -->
    <?php
    include ("../includes/footer.php"); // Menyertakan footer halaman
    ?>

    <!-- Bootstrap JS untuk mendukung interaktivitas -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>
