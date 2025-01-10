<?php
// Mempertahankan semua include dan logika PHP di awal
include('../includes/connect.php');

if(isset($_GET['agent_id'])) {
    $agent_id = $_GET['agent_id'];
    $get_data = "SELECT * FROM deliveryAgent WHERE agentID = $agent_id;";
    $result_get = mysqli_query($con, $get_data);
    $row_data = mysqli_fetch_assoc($result_get);
    
    $agent_id = $row_data["agentID"];
    $agent_fname = $row_data['first_name'];
    $agent_lname = $row_data['last_name'];
    $pass = $row_data['password'];
    $email = $row_data['email'];
    $phone = $row_data['phone_no'];
    $dob = $row_data['dob'];
    $age = $row_data['age'];
    $agent_status = $row_data['availabilityStatus'];
    
    if($agent_lname === null) {
        $agent_name = $agent_fname;
    } else {
        $agent_name = $agent_fname . ' ' . $agent_lname;
    }

    $get_data = "SELECT * FROM delivery_agent_wallet WHERE agentID = $agent_id;";
    $result_get = mysqli_query($con, $get_data);
    $row_data = mysqli_fetch_assoc($result_get);
    
    $earning_balance = $row_data["earning_balance"];
    $earning_paid = $row_data["earning_paid"];
    $earning_total = $row_data["earning_total"];

    if($agent_status == "Offline") {
        $nextPage = "offlineHome";
    } else {
        $nextPage = "home";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            overflow-x: hidden;
        }

        .button {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            padding: 10px;
            background: linear-gradient(to right, #6c757d, #495057);
            border-radius: 8px;
        }

        .button button {
            border: none;
            background: none;
            padding: 0;
            margin: 8px;
            transition: transform 0.3s ease;
        }

        .button button:hover {
            transform: translateY(-3px);
        }

        .button .nav-link {
            white-space: normal;
            min-width: 120px;
            min-height: 48px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 8px 16px;
            margin: 0;
            background: linear-gradient(145deg, #0dcaf0, #0bb5d7);
            color: white !important;
            border-radius: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border: 2px solid rgba(255,255,255,0.1);
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .button .nav-link:hover {
            background: linear-gradient(145deg, #0bb5d7, #0dcaf0);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
            border: 2px solid rgba(255,255,255,0.2);
        }

        .button button:last-child .nav-link {
            background: linear-gradient(145deg, #dc3545, #c82333);
        }

        .button button:last-child .nav-link:hover {
            background: linear-gradient(145deg, #c82333, #dc3545);
        }

        .button .nav-link::before {
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            margin-right: 8px;
        }

        .button button:nth-child(1) .nav-link::before { content: "\f007"; }
        .button button:nth-child(2) .nav-link::before { content: "\f1da"; }
        .button button:nth-child(3) .nav-link::before { content: "\f53a"; }
        .button button:nth-child(4) .nav-link::before { content: "\f0d1"; }
        .button button:nth-child(5) .nav-link::before { content: "\f005"; }
        .button button:last-child .nav-link::before { content: "\f2f5"; }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg bg-info">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <i class="fa fa-shopping-basket" aria-hidden="true"> WeThrift</i>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" 
                               href='profile_page.php?agent_id=<?php echo $agent_id; ?>'>My Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page"
                               href="index.php?agent_id=<?php echo $agent_id . '&' . $nextPage; ?>">Home</a>
                        </li>
                    </ul>
                </div>
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="" class="nav-link text-dark">Welcome <?php echo $agent_name; ?></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>

        <!-- Menu Buttons -->
        <div class="row">
            <div class="col-md-12 bg-secondary p-1">
                <div class="button text-center">
                    <button>
                        <a href="profile_page.php?agent_id=<?php echo $agent_id; ?>&view_profile" 
                           class="nav-link text-dark">View Profile</a>
                    </button>
                    <button>
                        <a href="profile_page.php?agent_id=<?php echo $agent_id; ?>&wallet_history" 
                           class="nav-link text-dark">Your Wallet History</a>
                    </button>
                    <button>
                        <a href="profile_page.php?agent_id=<?php echo $agent_id; ?>&top_up" 
                           class="nav-link text-dark">Withdraw Money</a>
                    </button>
                    <button>
                        <a href="profile_page.php?agent_id=<?php echo $agent_id; ?>&history" 
                           class="nav-link text-dark">Delivery History</a>
                    </button>
                    <button>
                        <a href="profile_page.php?agent_id=<?php echo $agent_id; ?>&view_reviews" 
                           class="nav-link text-dark">My Reviews</a>
                    </button>
                    <button>
                        <a href="../start.php" class="nav-link text-dark">Logout</a>
                    </button>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="container my-3">
            <?php
            if(isset($_GET['view_profile'])) { include('view_profile.php'); }
            if(isset($_GET['edit_profile'])) { include('edit_profile.php'); }
            if(isset($_GET['history'])) { include('agent_history.php'); }
            if(isset($_GET['top_up'])) { include('top_up.php'); }
            if(isset($_GET['wallet_history'])) { include('wallet_history.php'); }
            if(isset($_GET['view_reviews'])) { include('agent_reviews.php'); }
            ?>
        </div>

        <!-- Footer -->
        <?php include("../includes/footer.php"); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>