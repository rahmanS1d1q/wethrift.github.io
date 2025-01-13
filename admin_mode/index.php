<?php
include("../functions/common_function.php"); 

if(isset($_GET['admin_id'])) {
    $admin_id = $_GET['admin_id'];
    if($admin_id == 1) { $name = "RAHMAN"; }
    if($admin_id == 2) { $name = "YUNUS"; }
    if($admin_id == 3) { $name = "KHAFID"; }
    if($admin_id == 4) { $name = "WILDAN"; }
    if($admin_id == 5) { $name = "lecture"; }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Mode</title>
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            overflow-x: hidden;
        }

        .prod_image {
            width: 100px;
            height: 100px;
            object-fit: contain;
        }

        .edit_image {
            width: 100%;
            height: 100px;
            object-fit: contain;
        }

        /* Enhanced Button Styles */
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

        /* Button Icons */
        .button .nav-link::before {
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            margin-right: 8px;
        }

        .button button:nth-child(1) .nav-link::before { content: "\f080"; }
        .button button:nth-child(2) .nav-link::before { content: "\f067"; }
        .button button:nth-child(3) .nav-link::before { content: "\f03a"; }
        .button button:nth-child(4) .nav-link::before { content: "\f07b"; }
        .button button:nth-child(5) .nav-link::before { content: "\f07c"; }
        .button button:nth-child(6) .nav-link::before { content: "\f291"; }
        .button button:nth-child(7) .nav-link::before { content: "\f0c0"; }
        .button button:nth-child(8) .nav-link::before { content: "\f0d1"; }
        .button button:nth-child(9) .nav-link::before { content: "\f005"; }
        .button button:nth-child(10) .nav-link::before { content: "\f15c"; }
        .button button:last-child .nav-link::before { content: "\f2f5"; }
    </style>
</head>

<body>
    <div class="container-fluid p-0">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i> WeThrift
                </a>
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" 
                               href="index.php?admin_id=<?php echo $admin_id; ?>&home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link text-dark">Welcome <?php echo $name; ?></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>

        <!-- Title -->
        <div class="bg-light">
            <h3 class="text-center p-2">Managemen Inventory/View Analysis</h3>
        </div>

        <!-- Menu Buttons -->
        <div class="row">
            <div class="col-md-12 bg-secondary p-1">
                <div class="button text-center">
                    <button>
                        <a href="index.php?admin_id=<?php echo $admin_id; ?>&diagram_admin" 
                           class="nav-link text-dark bg-info">View Diagram</a>
                    </button>
                    <button>
                        <a href="index.php?admin_id=<?php echo $admin_id; ?>&insert_product" 
                           class="nav-link text-dark bg-info">Insert Products</a>
                    </button>
                    <button>
                        <a href="index.php?admin_id=<?php echo $admin_id; ?>&view_product" 
                           class="nav-link text-dark bg-info">View Products</a>
                    </button>
                    <button>
                        <a href="index.php?admin_id=<?php echo $admin_id; ?>&insert_category" 
                           class="nav-link text-dark bg-info">Insert Categories</a>
                    </button>
                    <button>
                        <a href="index.php?admin_id=<?php echo $admin_id; ?>&view_category" 
                           class="nav-link text-dark bg-info">View Categories</a>
                    </button>
                    <button>
                        <a href="index.php?admin_id=<?php echo $admin_id; ?>&view_orders" 
                           class="nav-link text-dark bg-info">All Orders</a>
                    </button>
                    <button>
                        <a href="index.php?admin_id=<?php echo $admin_id; ?>&list_customers" 
                           class="nav-link text-dark bg-info">List Customers</a>
                    </button>
                    <button>
                        <a href="index.php?admin_id=<?php echo $admin_id; ?>&list_agents" 
                           class="nav-link text-dark bg-info">List Delivery Agents</a>
                    </button>
                    <button>
                        <a href="index.php?admin_id=<?php echo $admin_id; ?>&order_review" 
                           class="nav-link text-dark bg-info">View Order Reviews</a>
                    </button>
                    <button>
                        <a href="index.php?admin_id=<?php echo $admin_id; ?>&delivery_review" 
                           class="nav-link text-dark bg-info">View Delivery Reviews</a>
                    </button>
                    <button>
                        <a href="../start.php" class="nav-link text-dark bg-info">Logout</a>
                    </button>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="container my-3">
            <?php
            if(isset($_GET['diagram_admin'])) { include('diagram_admin.php'); }
            if(isset($_GET['insert_category'])) { include('insert_category.php'); }
            if(isset($_GET['insert_product'])) { include('insert_product.php'); }
            if(isset($_GET['view_product'])) { include('view_product.php'); }
            if(isset($_GET['edit_product'])) { include('edit_product.php'); }
            if(isset($_GET['delete_product'])) { include('delete_product.php'); }
            if(isset($_GET['view_category'])) { include('view_category.php'); }
            if(isset($_GET['edit_category'])) { include('edit_category.php'); }
            if(isset($_GET['delete_category'])) { include('delete_category.php'); }
            if(isset($_GET['view_orders'])) { include('view_orders.php'); }
            if(isset($_GET['list_customers'])) { include('list_customers.php'); }
            if(isset($_GET['list_agents'])) { include('list_agents.php'); }
            if(isset($_GET['order_review'])) { include('order_review.php'); }
            if(isset($_GET['delivery_review'])) { include('delivery_review.php'); }
            if(isset($_GET['home'])) { include('home.php'); }
            if(isset($_GET['dispatch_order'])) { include('dispatch_order.php'); }
            ?>
        </div>

        <!-- Footer -->
        <?php include("../includes/footer.php"); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>