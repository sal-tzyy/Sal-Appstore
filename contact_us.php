<?php
session_start();
?>
<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - SaL Apple Store</title>
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
            min-height: 100vh;
            color: #ffffff;
        }

        /* Navbar Design */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 80px;
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(10px);
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #00d2ff;
            letter-spacing: 1px;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 30px;
        }

        .nav-links li a {
            text-decoration: none;
            color: #ffffff;
            font-size: 16px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-links li a:hover, .nav-links li a.active {
            color: #00d2ff;
        }

        /* Contact Section */
        .contact-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 80px);
            padding: 20px;
        }

        .contact-box {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            width: 100%;
            max-width: 500px;
            padding: 40px 35px;
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            text-align: center;
        }

        .contact-box h2 {
            color: #ffffff;
            margin-bottom: 20px;
            font-size: 26px;
            letter-spacing: 1.5px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 18px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            color: rgba(255, 255, 255, 0.85);
            font-size: 14px;
            font-weight: 500;
        }

        .form-group input, .form-group textarea {
            width: 100%;
            padding: 12px 16px;
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            color: #ffffff;
            font-size: 15px;
            outline: none;
            transition: all 0.3s ease;
        }

        .form-group textarea {
            resize: vertical;
            height: 100px;
        }

        .form-group input::placeholder, .form-group textarea::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .form-group input:focus, .form-group textarea:focus {
            background: rgba(255, 255, 255, 0.12);
            border-color: #00d2ff;
            box-shadow: 0 0 12px rgba(0, 210, 255, 0.3);
        }

        .submit-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, rgba(0, 210, 255, 0.8) 0%, rgba(0, 102, 235, 0.8) 100%);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 210, 255, 0.3);
            transition: all 0.3s ease;
            margin-top: 5px;
            letter-spacing: 1px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 210, 255, 0.5);
            background: linear-gradient(135deg, rgba(0, 229, 255, 0.9) 0%, rgba(0, 119, 255, 0.9) 100%);
        }

        /* Social Media Buttons Style */
        .social-divider {
            margin: 20px 0 15px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
        }

        .social-divider span {
            position: absolute;
            top: -10px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(30, 30, 30, 0.8);
            padding: 0 10px;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.7);
        }

        .social-links {
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .social-btn {
            flex: 1;
            padding: 12px;
            border-radius: 8px;
            text-decoration: none;
            color: #ffffff;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .telegram-btn {
            background: rgba(0, 136, 204, 0.6);
        }

        .telegram-btn:hover {
            background: rgba(0, 136, 204, 0.9);
            transform: translateY(-2px);
        }

        .facebook-btn {
            background: rgba(24, 119, 242, 0.6);
        }

        .facebook-btn:hover {
            background: rgba(24, 119, 242, 0.9);
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav>
        <div class="logo">SaL Apple Store</div>
        <ul class="nav-links">
            <li><a href="frond_end.php">Home</a></li>
            <li><a href="product.php">Product</a></li>
            <li><a href="contact_us.php" class="active">Contact Us</a></li>
            <li>
                <?php if(isset($_SESSION['customer_user'])): ?>
                <?php else: ?>
                    <a href="login.php">Login</a>
                <?php endif; ?>
            </li>
        </ul>
    </nav>

    <!-- Contact Form & Social Section -->
    <div class="contact-container">
        <div class="contact-box">
            <h2>GET IN TOUCH</h2>
            <form action="#" method="POST">
                <div class="form-group">
                    <label>Your Name</label>
                    <input type="text" name="name" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label>Message</label>
                    <textarea name="message" placeholder="Write your message here..." required></textarea>
                </div>
                <button type="submit" class="submit-btn">SEND MESSAGE</button>
            </form>

            <!-- Social Media Direct Links -->
            <div class="social-divider">
                <span>OR CONNECT VIA</span>
            </div>
            
            <div class="social-links">
                <!-- ជំនួស link របស់អ្នកត្រង់ href="..." -->
                <a href="@sal_tzyy" target="_blank" class="social-btn telegram-btn">
                    Telegram
                </a>
                <a href="https://www.facebook.com" target="_blank" class="social-btn facebook-btn">
                    Facebook
                </a>
            </div>
        </div>
    </div>

</body>
</html>