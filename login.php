<?php
include 'admin_simple/connection.php';
session_start();

$error = "";

if (isset($_POST['login_btn'])) {
    $role = $_POST['role'];

    if ($role == 'admin') {
        $username = mysqli_real_escape_string($conn, $_POST['user']);
        $password = $_POST['pw'];

        // ឆែកទិន្នន័យ Admin ក្នុង Database
        $sql = "SELECT * FROM tbl_users WHERE username = '$username' AND pwd = '$password'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['admin_user'] = $row['username'];
            // ផ្លាស់ប្តូរទៅកាន់ file ដែលមានបង្ហាញ Our Product
            header("location: admin_simple/index%20.php"); 
            exit();
        } else {
            $error = "Invalid Admin Username or Password!";
        }
    } 
    elseif ($role == 'customer') {
        $usersname = mysqli_real_escape_string($conn, $_POST['usersname']);
        $phone     = mysqli_real_escape_string($conn, $_POST['phone']);
        $email     = mysqli_real_escape_string($conn, $_POST['email']);

        // ធ្វើការ Query ផ្ទៀងផ្ទាត់ជាមួយ tbl_customer
        $sql = "SELECT * FROM tbl_customer WHERE usersname = '$usersname' AND phone = '$phone' AND email = '$email'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['customer_user'] = $row['usersname'];
            
            // ចូលสำเร็จ លោតទៅកាន់ frond_end.php
            header("Location: frond_end.php");
            exit();
        } else {
            $error = "Customer not found! Please check your information.";
        }
    } 
    else {
        $error = "Please select a login role!";
    }
}
?>
<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Portal</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-section {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            width: 100%;
            max-width: 450px;
            padding: 40px 35px;
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            text-align: center;
        }

        .login-section h2 {
            color: #ffffff;
            margin-bottom: 20px;
            font-size: 26px;
            letter-spacing: 1.5px;
            font-weight: 600;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .error-msg {
            color: #ff6b6b;
            background: rgba(255, 0, 0, 0.15);
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 13px;
            border: 1px solid rgba(255, 107, 107, 0.3);
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

        .form-group input, .form-group select {
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

        .form-group select option {
            background-color: #333;
            color: #fff;
        }

        .form-group input::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .form-group input:focus, .form-group select:focus {
            background: rgba(255, 255, 255, 0.12);
            border-color: #00d2ff;
            box-shadow: 0 0 12px rgba(0, 210, 255, 0.3);
        }

        .customer-fields {
            display: none;
        }

        .login-btn {
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
            margin-top: 10px;
            letter-spacing: 1px;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 210, 255, 0.5);
            background: linear-gradient(135deg, rgba(0, 229, 255, 0.9) 0%, rgba(0, 119, 255, 0.9) 100%);
        }
    </style>
</head>
<body>

    <section class="login-section">
        <h2>LOGIN PORTAL</h2>
        
        <?php if(!empty($error)): ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-group">
                <label>Login As</label>
                <select name="role" id="roleSelect" required onchange="toggleFields()">
                    <option value="" disabled selected>Select Role </option>
                    <option value="admin">Admin</option>
                    <option value="customer">Customer</option>
                </select>
            </div>

            <!-- ប្រអប់សម្រាប់ Admin -->
            <div class="form-group admin-field">
                <label>Username</label>
                <input type="text" name="user" placeholder="Enter admin username">
            </div>

            <!-- ប្រអប់សម្រាប់ Customer (Username, Phone Number, Email) -->
            <div class="customer-fields" id="customerFields">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="usersname" placeholder="Enter customer username">
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone" placeholder="Enter phone number">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Enter email address">
                </div>
            </div>

            <!-- Password (បង្ហាញសម្រាប់ Admin តែប៉ុណ្ណោះ) -->
            <div class="form-group" id="passwordGroup">
                <label>Password</label>
                <input type="password" name="pw" id="passwordField" placeholder="Enter password">
            </div>
            
            <button type="submit" name="login_btn" class="login-btn">ENTER</button>
        </form>
    </section>

    <!-- JavaScript សម្រាប់ប្តូរការបង្ហាញ Form រវាង Admin និង Customer ស្វ័យប្រវត្តិ -->
    <script>
        function toggleFields() {
            var role = document.getElementById('roleSelect').value;
            var customerFields = document.getElementById('customerFields');
            var adminField = document.querySelector('.admin-field');
            var passwordGroup = document.getElementById('passwordGroup');
            
            if (role === 'customer') {
                customerFields.style.display = 'block';
                adminField.style.display = 'none';
                passwordGroup.style.display = 'none'; // លាក់ Password ព្រោះ Customer មិនមានក្នុង DB
                
                adminField.querySelector('input').removeAttribute('required');
                document.getElementById('passwordField').removeAttribute('required');
                customerFields.querySelectorAll('input').forEach(input => input.setAttribute('required', 'true'));
            } else if (role === 'admin') {
                customerFields.style.display = 'none';
                adminField.style.display = 'block';
                passwordGroup.style.display = 'block'; // បង្ហាញ Password សម្រាប់ Admin
                
                adminField.querySelector('input').setAttribute('required', 'true');
                document.getElementById('passwordField').setAttribute('required', 'true');
                customerFields.querySelectorAll('input').forEach(input => input.removeAttribute('required'));
            }
        }
    </script>

</body>
</html>