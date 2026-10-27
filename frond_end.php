<?php
include 'admin_simple/connection.php';
session_start();
?>
<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Apple Store</title>
    <link href="https://fonts.googleapis.com/css2?family=Segoe+UI:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-image: url('iphone.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
            color: #fff;
        }

        /* Navbar Style */
        nav {
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
            padding: 20px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 1px;
            color: #00d2ff;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 30px;
        }

        .nav-links a {
            text-decoration: none;
            color: #fff;
            font-size: 16px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-links a:hover, .nav-links a.active {
            color: #00d2ff;
            text-shadow: 0 0 10px rgba(0, 210, 255, 0.5);
        }

        /* Hero Section */
        .hero {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 80vh;
            text-align: center;
            padding: 0 20px;
        }

        .hero h1 {
            font-size: 48px;
            margin-bottom: 15px;
            text-shadow: 0 4px 10px rgba(0,0,0,0.5);
        }

        .hero p {
            font-size: 20px;
            margin-bottom: 25px;
            color: rgba(255, 255, 255, 0.85);
        }

        .btn-explore {
            padding: 12px 30px;
            background: linear-gradient(135deg, rgba(0, 210, 255, 0.8) 0%, rgba(0, 102, 235, 0.8) 100%);
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: transform 0.3s ease;
        }

        .btn-explore:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav>
        <div class="logo"> SaL Apple Store</div>
        <ul class="nav-links">
            <li><a href="frond_end.php" class="active">Home</a></li>
            <li><a href="login.php" class="active"></a></li>
             <li><a href="product.php">Product</a></li>
            <li><a href="contact_us.php">Contact Us</a></li>

        </ul>
    </nav>

    <!-- Hero Content -->
    <div class="hero">
        <h1>Welcome to SaL Apple Store</h1>
        <p>Discover the latest iPhone models with the best prices and quality.</p>
    
    </div>

</body>
</html>