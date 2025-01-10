<?php include('../includes/connect.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Agent Registration - WeThrift</title>
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        .back-button {
            position: fixed;
            top: 20px;
            left: 20px;
            text-decoration: none;
            color: #0dcaf0;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s;
            font-weight: 500;
            padding: 8px 15px;
            border-radius: 5px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            z-index: 1000;
        }

        .back-button:hover {
            color: #0bb5d7;
            transform: translateX(-3px);
        }

        .registration-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .registration-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .registration-header .logo {
            color: #0dcaf0;
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .registration-header h2 {
            color: #0dcaf0;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .form-section {
            border-bottom: 1px solid #eee;
            padding-bottom: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-section:last-child {
            border-bottom: none;
        }

        .form-control {
            border: 1px solid #ced4da;
            padding: 0.75rem;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #0dcaf0;
            box-shadow: 0 0 0 0.2rem rgba(13, 202, 240, 0.25);
        }

        .form-label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 0.5rem;
        }

        .required-field::after {
            content: "*";
            color: #dc3545;
            margin-left: 4px;
        }

        .btn-register {
            background: #0dcaf0;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 5px;
            border: none;
            transition: all 0.3s;
            font-weight: 500;
        }

        .btn-register:hover {
            background: #0bb5d7;
            transform: translateY(-2px);
        }

        .login-link {
            color: #0dcaf0;
            text-decoration: none;
            transition: color 0.3s;
        }

        .login-link:hover {
            color: #0bb5d7;
        }

        .input-group-text {
            background: transparent;
            border-left: none;
            cursor: pointer;
        }

        .input-group .form-control {
            border-right: none;
        }
    </style>
</head>
<body>
    <!-- Back Button -->
    <a href="../start.php" class="back-button">
        <i class="fas fa-arrow-left"></i>
        Back to Home
    </a>

    <div class="container">
        <div class="registration-container">
            <div class="registration-header">
                <div class="logo">
                    <i class="fas fa-truck"></i>
                </div>
                <h2>Delivery Agent Registration</h2>
                <p class="text-muted">Join our delivery team</p>
            </div>

            <form action="" method="post" enctype="multipart/form-data">
                <!-- Personal Information Section -->
                <div class="form-section">
                    <h5 class="mb-3">Personal Information</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="first_name" class="form-label required-field">First Name</label>
                            <input type="text" id="first_name" class="form-control" 
                                   placeholder="Enter your first name" required name="first_name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" id="last_name" class="form-control" 
                                   placeholder="Enter your last name" name="last_name">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="dob" class="form-label required-field">Date of Birth</label>
                        <input type="text" id="dob" class="form-control" pattern="\d{4}-\d{2}-\d{2}"
                               placeholder="YYYY-MM-DD" required name="dob">
                        <small class="text-muted">Format: YYYY-MM-DD (Must be 18 or older)</small>
                    </div>
                </div>

                <!-- Contact Information Section -->
                <div class="form-section">
                    <h5 class="mb-3">Contact Information</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="phone_no" class="form-label required-field">Phone Number</label>
                            <div class="input-group">
                                <input type="number" id="phone_no" class="form-control" 
                                       placeholder="Enter your phone number" required name="phone_no" min="0">
                                <span class="input-group-text">
                                    <i class="fas fa-phone text-muted"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label required-field">Email Address</label>
                            <div class="input-group">
                                <input type="email" id="email" class="form-control" 
                                       placeholder="Enter your email" required name="email">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope text-muted"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Security Section -->
                <div class="form-section">
                    <h5 class="mb-3">Security</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label required-field">Password</label>
                            <div class="input-group">
                                <input type="password" id="password" class="form-control" 
                                       placeholder="Enter password" required name="password">
                                <span class="input-group-text" onclick="togglePassword('password', 'toggleIcon1')">
                                    <i class="fas fa-eye-slash text-muted" id="toggleIcon1"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="conf_agent_password" class="form-label required-field">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" id="conf_agent_password" class="form-control" 
                                       placeholder="Confirm password" required name="conf_agent_password">
                                <span class="input-group-text" onclick="togglePassword('conf_agent_password', 'toggleIcon2')">
                                    <i class="fas fa-eye-slash text-muted" id="toggleIcon2"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Section -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-register" name="delivery_signup">
                        <i class="fas fa-user-plus me-2"></i>Create Account
                    </button>
                    <p class="mt-3">
                        Already have an account? 
                        <a href="delivery_login.php" class="login-link">Login here</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.getElementById(iconId);
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            }
        }
    </script>
</body>
</html>

<?php
// PHP registration logic remains unchanged
if(isset($_POST['delivery_signup'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_no = $_POST['phone_no'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $conf_password = $_POST['conf_agent_password'];
    $dob = $_POST['dob'];

    $dob_timestamp = strtotime($dob);
    $age = date('Y') - date('Y', $dob_timestamp);
    if(date('md', $dob_timestamp) > date('md')) {
        $age--;
    }

    $select_query = "SELECT * FROM deliveryAgent WHERE email='$email' OR phone_no='$phone_no';";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);

    if($rows_count > 0) {
        echo "<script>alert('Delivery Agent with given Email or Phone Number already exist. Please use Login option to login into your account')</script>";
    } else if($password != $conf_password) {
        echo "<script>alert('Passwords do not match. Please try again.')</script>";
    } else if($age < 18) {
        echo "<script>alert('You must be at least 18 years old to register as a delivery agent.')</script>";
    } else {
        $insert_query = "INSERT INTO deliveryAgent (first_name, last_name, availabilityStatus, phone_no, email, password, dob, age) VALUES ('$first_name','$last_name', DEFAULT, '$phone_no','$email','$password', '$dob', DEFAULT);";
        $sql_execute = mysqli_query($con, $insert_query);

        $new_cust = mysqli_insert_id($con);
        $upi_id = 'agent'.$new_cust.'@upi';
        $current_date = date("d-m-Y");
        $trans = "$current_date^ You Created QuickCart Wallet Account!^ 0^ 0^ 0";

        $insert_wallet = "INSERT INTO delivery_agent_wallet (agentID, earning_balance, earning_paid, earning_total, Transaction_history, upiID) VALUES ('$new_cust', DEFAULT, DEFAULT, DEFAULT, '$trans', '$upi_id');";
        $sql_wallet = mysqli_query($con, $insert_wallet);

        if($sql_execute and $sql_wallet) {
            echo "<script>alert('You are registered successfully. Kindly login into your account.');  window.location.href = 'delivery_login.php';</script>";
        } else {
            die(mysqli_error($con));
        }
    }
}
?>