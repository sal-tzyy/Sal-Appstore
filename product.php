<?php
// 1. ភ្ជាប់ Database (ដោយសារ product.php នៅខាងក្រៅ និង connection.php ស្ថិតក្នុង admin_simple/)
include 'admin_simple/connection.php';
session_start();

$sql = "SELECT * FROM tbl_product";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Apple Store</title>
    <link href="https://fonts.googleapis.com/css2?family=Segoe+UI:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f4f6f9;
            min-height: 100vh;
            color: #333;
        }

        /* Navbar Style */
        nav {
            background: rgba(0, 0, 0, 0.85);
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
            color: #00d2ff;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 30px;
            align-items: center;
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
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 35px;
            font-size: 32px;
            color: #2c3e50;
        }

        /* Product Grid Layout */
        .product-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 25px;
        }

        .product-card {
            background: #ffffff;
            border: 1px solid #e1e8ed;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            padding: 15px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: contain;
            background-color: #fafafa;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .product-info {
            padding: 5px;
            flex-grow: 1;
        }

        .product-product {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 12px;
            color: #2c3e50;
            display: block;
        }

        .product-info-row {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin-bottom: 8px;
            color: #555;
        }

        .label {
            color: #777;
        }

        .product-price {
            font-size: 16px;
            color: #e74c3c;
            font-weight: bold;
        }

        /* Buy Now Button Style */
        .buy-now-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #00d2ff 0%, #0066eb 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 15px;
            cursor: pointer;
            margin-top: 15px;
            transition: 0.3s;
        }
        .buy-now-btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        /* Modal Popup Styles */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 2000; 
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.6);
            backdrop-filter: blur(5px);
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: #1e1e1e;
            color: #fff;
            padding: 30px;
            border-radius: 14px;
            width: 100%;
            max-width: 450px;
            position: relative;
            box-shadow: 0 20px 40px rgba(0,0,0,0.5);
            border: 1px solid rgba(255,255,255,0.15);
        }

        .close-btn {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 26px;
            cursor: pointer;
            color: #aaa;
        }
        .close-btn:hover { color: #fff; }

        .modal-content h2 {
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
            color: #00d2ff;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
            color: rgba(255,255,255,0.85);
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 11px 14px;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 8px;
            color: #fff;
            outline: none;
            font-size: 14px;
        }
        .form-group input:focus, .form-group textarea:focus {
            border-color: #00d2ff;
            background: rgba(255,255,255,0.12);
        }
        .form-group textarea { height: 80px; resize: none; }

        .submit-order-btn {
            width: 100%;
            padding: 13px;
            background: #00d2ff;
            color: #000;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
            transition: 0.3s;
        }
        .submit-order-btn:hover { background: #00b8e6; }

        .no-products {
            text-align: center;
            grid-column: 1 / -1;
            font-size: 18px;
            color: #777;
            padding: 40px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav>
        <div class="logo">SaL Apple Store</div>
        <ul class="nav-links">
            <li><a href="frond_end.php">Home</a></li>
            <li><a href="product.php" class="active">Product</a></li>
            <li><a href="contact_us.php">Contact Us</a></li>
            <li>
                <?php if(isset($_SESSION['customer_user'])): ?>

                <?php else: ?>
                    <a href="login.php">Login</a>
                <?php endif; ?>
            </li>
        </ul>
    </nav>

    <!-- Main Container -->
    <div class="container">
        <h1>Our Product</h1>

        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            echo '<div class="product-list">';

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="product-card">';
                
                $imagePath = 'admin_simple/img/' . $row['img'];
                echo '<img src="' . htmlspecialchars($imagePath) . '" class="product-image" alt="Product image">';

                echo '<div class="product-info">';
                echo '<span class="product-product">' . htmlspecialchars($row['product']) . '</span>';
                
                echo '<div class="product-info-row">';
                echo '<span class="label">Storage:</span>';
                echo '<span class="product-storage">' . htmlspecialchars($row['storage']) . '</span>';
                echo '</div>';

                echo '<div class="product-info-row">';
                echo '<span class="label">Price:</span>';
                echo '<span class="product-price">$' . number_format($row['price']) . '</span>';
                echo '</div>';

                echo '<div class="product-info-row">';
                echo '<span class="label">Quantity:</span>';
                echo '<span class="product-qty">' . htmlspecialchars($row['qty']) . '</span>';
                echo '</div>';

                echo '</div>'; // ចប់ product-info

                // ប៊ូតុង Buy Now ដែលបញ្ជូនឈ្មោះ និងតម្លៃផលិតផលចូលទៅក្នុង Function JavaScript
                $prodName = htmlspecialchars($row['product'], ENT_QUOTES);
                $prodPrice = '$' . number_format($row['price']);
                echo '<button class="buy-now-btn" onclick="openCheckout(\'' . $prodName . '\', \'' . $prodPrice . '\')">Buy Now</button>';

                echo '</div>'; // ចប់ product-card
            }

            echo '</div>'; // ចប់ product-list
        } else {
            echo '<div class="no-products">No products found in database!</div>';
        }
        ?>
    </div>

    <!-- Modal Popup សម្រាប់ Checkout & QR Code -->
    <div id="checkoutModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeCheckout()">&times;</span>
            <h2>Checkout Form</h2>
            
            <form id="orderForm" onsubmit="showQRCode(event)">
                <!-- Step 1: Input Fields (Name, Phone Number, Email, Address) -->
                <div id="formFields">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" id="custName" placeholder="Enter your full name" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" id="custPhone" placeholder="Enter your phone number" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="custEmail" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea id="custAddress" placeholder="Enter delivery address" required></textarea>
                    </div>
                    <button type="submit" class="submit-order-btn">Submit & Show QR</button>
                </div>
                
                <!-- Step 2: QR Code Display (លាក់ទុកមុនសិន ពេល Submit ទើបបង្ហាញ) -->
                <div id="qrSection" style="display: none; text-align: center;">
                    <h3 style="color: #00d2ff; margin-bottom: 5px;">Scan to Pay</h3>
                    <p style="font-size: 13px; color: #ccc;">Please scan the KHQR to complete your payment.</p>
                    
                    <!-- រូបភាព QR Code ដាក់ក្នុងโฟลเดอร์ admin_simple/img/ ឈ្មោះ qr_code.jpg -->
                    <img src="admin_simple/qr.png" alt="Payment QR Code" style="width: 200px; height: 200px; margin: 15px 0; border-radius: 8px; border: 2px solid #fff;">
                    
                    <p style="font-weight: bold; font-size: 16px; margin-bottom: 15px;" id="displayProductInfo"></p>
                    
                    <button type="button" class="submit-order-btn" onclick="completeOrder()" style="background: #28a745; color: #fff;">Done / Finish</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript គ្រប់គ្រង Modal និងការបង្ហាញ QR Code -->
    <script>
        function openCheckout(productName, productPrice) {
            document.getElementById('checkoutModal').style.display = 'flex';
            document.getElementById('displayProductInfo').innerText = productName + " - " + productPrice;
        }

        function closeCheckout() {
            document.getElementById('checkoutModal').style.display = 'none';
            // Reset form និងបង្ហាញ input វិញ
            document.getElementById('formFields').style.display = 'block';
            document.getElementById('qrSection').style.display = 'none';
            document.getElementById('orderForm').reset();
        }

        function showQRCode(event) {
            event.preventDefault(); // មិនឱ្យ Reload ទំព័រ
            // លាក់ប្រអប់ Input ចេញ ហើយបង្ហាញ QR Code
            document.getElementById('formFields').style.display = 'none';
            document.getElementById('qrSection').style.display = 'block';
        }

        function completeOrder() {
            alert("Order placed successfully! Thank you for your purchase.");
            closeCheckout();
        }
    </script>

</body>
</html>