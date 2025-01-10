<?php
include('../includes/connect.php');
include('age_trigger.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration - WeThrift</title>
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
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
            margin-bottom: 2.5rem;
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

        .form-section h5 {
            color: #495057;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .form-control, .form-select {
            padding: 0.75rem;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .form-control:focus, .form-select:focus {
            border-color: #0dcaf0;
            box-shadow: 0 0 0 0.2rem rgba(13, 202, 240, 0.25);
        }

        .form-label {
            font-weight: 500;
            color: #495057;
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
            width: 100%;
            max-width: 200px;
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
        }

        .back-button:hover {
            color: #0bb5d7;
            transform: translateX(-3px);
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
                    <i class="fas fa-user-plus"></i>
                </div>
                <h2>New Customer Registration</h2>
                <p class="text-muted">Create your WeThrift account</p>
            </div>

            <form action="" method="post" enctype="multipart/form-data">
                <!-- Personal Information -->
                <div class="form-section">
                    <h5><i class="fas fa-user me-2"></i>Personal Information</h5>
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

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="dob" class="form-label required-field">Date of Birth</label>
                            <input type="text" id="dob" class="form-control" pattern="\d{4}-\d{2}-\d{2}"
                                   placeholder="YYYY-MM-DD" required name="dob">
                            <small class="text-muted">Format: YYYY-MM-DD</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label required-field">Gender</label>
                            <select id="gender" class="form-select" required name="gender">
                                <option value="" disabled selected>Select your gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="form-section">
                    <h5><i class="fas fa-address-book me-2"></i>Contact Information</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="phone_no" class="form-label required-field">Phone Number</label>
                            <input type="number" id="phone_no" class="form-control" 
                                   placeholder="Enter your phone number" required name="phone_no" min="0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label required-field">Email Address</label>
                            <input type="email" id="email" class="form-control" 
                                   placeholder="Enter your email" required name="email">
                        </div>
                    </div>
                </div>

                <!-- Address Information -->
                <div class="form-section">
                    <h5><i class="fas fa-home me-2"></i>Address Information</h5>
                    <div class="mb-3">
                        <label for="address_street" class="form-label required-field">Street Address</label>
                        <input type="text" id="address_street" class="form-control" 
                               placeholder="Enter your street address" required name="address_street">
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="address_city" class="form-label required-field">City</label>
                            <input type="text" id="address_city" class="form-control" 
                                   placeholder="Enter your city" required name="address_city">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="address_state" class="form-label required-field">State</label>
                            <input type="text" id="address_state" class="form-control" 
                                   placeholder="Enter your state" required name="address_state">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="pincode" class="form-label required-field">Pincode</label>
                            <input type="number" id="pincode" class="form-control" 
                                   placeholder="Enter pincode" required name="pincode" min="0">
                        </div>
                    </div>
                </div>

                <!-- Password Section -->
                <div class="form-section">
                    <h5><i class="fas fa-lock me-2"></i>Security</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label required-field">Password</label>
                            <input type="password" id="password" class="form-control" 
                                   placeholder="Enter password" required name="password">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="conf_customer_password" class="form-label required-field">Confirm Password</label>
                            <input type="password" id="conf_customer_password" class="form-control" 
                                   placeholder="Confirm password" required name="conf_customer_password">
                        </div>
                    </div>
                </div>

                <!-- Submit Section -->
                <div class="text-center">
                    <button type="submit" class="btn btn-register" name="customer_register">
                        <i class="fas fa-user-plus me-2"></i>Create Account
                    </button>
                    <p class="mt-3">
                        Already have an account? 
                        <a href="customer_login.php" class="login-link">Login here</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
if(isset($_POST['customer_register'])) {
    // Your existing PHP code remains exactly the same
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address_street = $_POST['address_street'];
    $address_city = $_POST['address_city'];
    $address_state = $_POST['address_state'];
    $pincode = $_POST['pincode'];
    $phone_no = $_POST['phone_no'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $conf_password = $_POST['conf_customer_password'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];

    $select_query = "SELECT * FROM customer WHERE email='$email' OR phone_no='$phone_no'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);

    if($rows_count > 0) {
        echo "<script>alert('Customer with given Email or Phone Number already exist. Please use Login option to login into your account')</script>";
    } else if($password != $conf_password) {
        echo "<script>alert('Passwords do not match. Please try again.')</script>";
    } else {
        mysqli_begin_transaction($con);
        
        try {
            $insert_query = "INSERT INTO customer (first_name, last_name, address_street, address_city, 
                           address_state, pincode, phone_no, email, password, dob, age, gender) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, DATEDIFF(CURDATE(), ?)/365, ?)";
            
            $stmt = mysqli_prepare($con, $insert_query);
            mysqli_stmt_bind_param($stmt, "ssssssssssss", 
                $first_name, $last_name, $address_street, $address_city,
                $address_state, $pincode, $phone_no, $email, $password, $dob, $dob, $gender);
            
            $sql_execute = mysqli_stmt_execute($stmt);
            
            if(!$sql_execute) {
                throw new Exception("Error creating customer account");
            }

            $new_cust_id = mysqli_insert_id($con);
            $upi_id = 'customer'.$new_cust_id.'@upi';
            $insert_wallet = "INSERT INTO wallet (customerID, balance, upiID, rewardPoints) 
                            VALUES (?, 0, ?, 0)";
            
            $stmt = mysqli_prepare($con, $insert_wallet);
            mysqli_stmt_bind_param($stmt, "is", $new_cust_id, $upi_id);
            $sql_wallet = mysqli_stmt_execute($stmt);

            if(!$sql_wallet) {
                throw new Exception("Error creating wallet");
            }

            mysqli_commit($con);
            echo "<script>
                    alert('Registration successful! Please login to your account.');
                    window.location.href = 'customer_login.php';
                  </script>";

        } catch(Exception $e) {
            mysqli_rollback($con);
            echo "<script>alert('Registration failed: ".mysqli_real_escape_string($con, $e->getMessage())."');</script>";
        }
    }
}
?>