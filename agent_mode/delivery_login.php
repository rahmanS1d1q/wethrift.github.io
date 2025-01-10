<?php
include('../includes/connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Agent Login - WeThrift</title>
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
        }

        .back-button {
            position: absolute;
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
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .login-container {
            max-width: 450px;
            margin: 2rem auto;
            padding: 2.5rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header .logo {
            color: #0dcaf0;
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .login-header h2 {
            color: #0dcaf0;
            font-weight: 600;
            margin-bottom: 0.5rem;
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

        .btn-login {
            background: #0dcaf0;
            color: white;
            padding: 0.75rem;
            border-radius: 5px;
            border: none;
            transition: all 0.3s;
            font-weight: 500;
            width: 100%;
        }

        .btn-login:hover {
            background: #0bb5d7;
            transform: translateY(-2px);
        }

        .register-link {
            color: #0dcaf0;
            text-decoration: none;
            transition: color 0.3s;
        }

        .register-link:hover {
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
        <div class="login-container">
            <div class="login-header">
                <div class="logo">
                    <i class="fas fa-truck"></i>
                </div>
                <h2>Delivery Agent Login</h2>
                <p class="text-muted">Please enter your credentials</p>
            </div>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-group">
                        <input type="email" id="email" class="form-control" 
                               placeholder="Enter your email" 
                               required name="email" />
                        <span class="input-group-text">
                            <i class="fas fa-envelope text-muted"></i>
                        </span>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" id="password" class="form-control" 
                               placeholder="Enter your password" 
                               required name="password" />
                        <span class="input-group-text" onclick="togglePassword()">
                            <i class="fas fa-eye-slash text-muted" id="toggleIcon"></i>
                        </span>
                    </div>
                </div>

                <div class="mb-4">
                    <button type="submit" class="btn btn-login" name="delivery_login">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </button>
                </div>

                <div class="text-center">
                    <p class="mb-0">
                        Don't have an account? 
                        <a href="delivery_signup.php" class="register-link">Register now</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
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
if(isset($_POST['delivery_login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $select_query = "SELECT * FROM deliveryAgent WHERE email='$email' AND password='$password';";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);

    if($rows_count > 0) {
        $row_data = mysqli_fetch_assoc($result);
        $agent_id = $row_data["agentID"];
        $agent_status = $row_data["availabilityStatus"];
        if($agent_status == "Offline") {
            $next_page = "index.php?agent_id=" . $agent_id . "&offlineHome";
        } else {
            $next_page = "index.php?agent_id=" . $agent_id . "&home";
        }
        
        echo "<script>alert('Logged In successfully'); window.location.href ='$next_page';</script>";
    } else {
        echo "<script>alert('Invalid Credentials')</script>";
    }
}
?>