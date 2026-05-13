
<?php
    require 'db_connect.php';
    session_start();
    if (isset($_GET['logout']) && $_GET['logout'] === '1') {
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"], $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        header("Location: Registration.php");
        exit();
    }

    if (isset($_SESSION['role']) && $_SESSION['role'] !== 'guest' && $_SERVER['REQUEST_METHOD'] !== 'POST') {
        if ($_SESSION['role'] === 'admin') {
            header("Location: AdminDashBoard.php");
            exit();
        } elseif ($_SESSION['role'] === 'vendor') {
            header("Location: HomePageVendor.php");
            exit();
        } elseif ($_SESSION['role'] === 'user') {
            header("Location: HomePageRegistered.php");
            exit();
        }
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Grab the inputs from the HTML form
    $email = $_POST['email'] ?? '';
    $UserPass = $_POST['password'] ?? '';

    if (!empty($email) && !empty($UserPass)) {

    // CHECK 1: IS THIS AN ADMIN?
        $stmtAdmin = $conn->prepare("SELECT * FROM admin WHERE AdminEmail = ? AND AdminPassword = ?");
        $stmtAdmin->bind_param("ss", $email, $UserPass);
        $stmtAdmin->execute();
        $resultAdmin = $stmtAdmin->get_result();

        if ($resultAdmin->num_rows > 0) {
            $_SESSION['role'] = 'admin';
            header("Location: AdminDashBoard.php");
            exit();
        }

        // CHECK 2: IS THIS A VENDOR?
        $stmtUser = $conn->prepare("SELECT * FROM vendors WHERE VendorEmail = ? AND VendorPassword = ?");
        $stmtUser->bind_param("ss", $email, $UserPass);
        $stmtUser->execute();
        $resultUser = $stmtUser->get_result();

        if ($resultUser->num_rows > 0) {
            $_SESSION['role'] = 'vendor';
            header("Location: HomePageVendor.php");
            exit();
        }

        // CHECK 3: IS THIS A CONSUMER?
        $stmtUser = $conn->prepare("SELECT * FROM userinfo WHERE UserEmail = ? AND UserPass = ?");
        $stmtUser->bind_param("ss", $email, $UserPass);
        $stmtUser->execute();
        $resultUser = $stmtUser->get_result();

        if ($resultUser->num_rows > 0) {
            $_SESSION['role'] = 'user';
            header("Location: HomePageRegistered.php");
            exit();
        }

        // CHECK 3: NO MATCH FOUND
        echo "<script>alert('Invalid email or password');</script>";

    } else {
        echo "<script>alert('Please enter a valid email and password');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PUP Vendor Portal - Access</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <style>
        :root {
            --pup-maroon: #800000;
            --pup-gold: #f2c413;
            --text-main: #1a1a1a;
            --text-muted: #666;
            --border-color: #eeeeee;
        }

        body {
        background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('484748438_9229689640460290_8097397456022904595_n.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-color: #121212; 
        margin: 0;
        padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-position: center;
            background-size: cover;
            background-attachment: fixed;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar {
            background-color: var(--pup-maroon);
            color: white;
            padding: 10px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }

        .navbar h3 { margin: 0; letter-spacing: 1px; }

        .nav-links a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-size: 0.9rem;
            font-weight: bold;
        }

        .container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        .card {
            background: rgba(255, 255, 255, 0.98);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.4);
            width: 100%;
            max-width: 450px;
            border-top: 6px solid var(--pup-maroon);
        }

        .tab-group {
            display: flex;
            margin-bottom: 30px;
            border-bottom: 2px solid var(--border-color);
        }

        .tab {
            flex: 1;
            text-align: center;
            padding: 10px;
            cursor: pointer;
            font-weight: bold;
            color: var(--text-muted);
            transition: 0.3s;
        }

        .tab.active {
            color: var(--pup-maroon);
            border-bottom: 3px solid var(--pup-maroon);
        }

        .form-section { display: none; }
        .form-section.active { display: block; }

        label {
            font-size: 0.8rem; 
            font-weight: bold; 
            color: #666;
            display: block;
            margin-bottom: 5px;
        }

        input, select, textarea {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
            box-sizing: border-box;
            display: block;
        }

        .photo-upload {
            border: 2px dashed #ccc;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            margin-bottom: 20px;
            cursor: pointer;
        }

        button {
            width: 100%;
            padding: 14px;
            background-color: var(--pup-maroon);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover { background-color: #600000; transform: translateY(-2px); }

        .consumer-notice {
            margin-top: 25px;
            text-align: center;
            padding: 15px;
            background: #fff9f9;
            border-radius: 8px;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .consumer-notice a { color: var(--pup-maroon); font-weight: bold; text-decoration: none; }
    </style>
</head>
<body>

<div class="navbar">
    <h3>PUP ★ All-Stop-Shops</h3>
    <a href="AboutUs.php" style = "color: white; text-decoration: underline;">FAQ</a>
</div>

<div class="container">
    <div class="card">
        <div class="tab-group">
            <div class="tab active" onclick="switchTab('login')">Login</div>
            <div class="tab" onclick="switchTab('register')">New Registration Vendor</div>
            <div class="tab" onclick="switchTab('user')">Register as a User</div>
        </div>

        <!-- LOGIN FORM -->
        <div id="login-form" class="form-section active">
            <form method="POST" action="">
                <label>OWNER EMAIL</label>
                <input type="email" name="email" placeholder="Enter your email" required>
                
                <label>PASSWORD</label>
                <input type="password" name="password" placeholder="••••••••" required>
                
                <button type="submit">Login to Dashboard</button>
            </form>
       
             <div class="consumer-notice">
                Just looking for a stall? <br>
                <a href="HomePageUnRegistered.php">Continue as Consumer (Guest)</a>
            </div>

        </div>

        <div id="register-form" class="form-section">
            <form action="ProcessRegistration.php" method="POST" enctype="multipart/form-data">
                <label>STALL NAME</label>
                <input type="text" name="stall_name" placeholder="e.g. Sisigan Ni Man Bento" pattern="[A-Za-z0-9][A-Za-z0-9 .,'-]{1,79}" title="Use 2-80 characters: letters, numbers, spaces, and . , ' - only." required>

                <label>OWNER EMAIL</label>
                <input type="email" name="owner_email" placeholder="Enter your email" pattern="[A-Za-z0-9][A-Za-z0-9._%+\-]*@[A-Za-z0-9][A-Za-z0-9.\-]*\.[A-Za-z]{2,}" title="Enter a valid email address." required>

                <label>CATEGORY</label>
                <select name="category" required>
                    <option>Food</option>
                    <option>Service</option>
                    <option>Vanity/School Supplies</option>
                </select>

                <label>OWNER PASSWORD</label>
                <input type="password" name="VendorPassword" placeholder="Create a password" pattern="[A-Za-z0-9!@#$%^&*?_+.]{6,64}" title="6-64 characters. Letters, numbers, and !@#$%^&*?_+. only." required>
                
                <label>IMPORTANT STALL PHOTO</label>
                <div class="photo-upload" onclick="document.getElementById('fileInput').click()">
                    <input type="file" id="fileInput" name="stall_photo" accept="image/*">
                    <button type="submit" name="registerVendor_btn"> Register Stall</button>
                </div>
            </form>
        
             <div class="consumer-notice">
                Just looking for a stall? <br>
                <a href="HomePageUnRegistered.php">Continue as Consumer (Guest)</a>
            </div>

        </div>

        <div id="user-form" class="form-section">
            <form action="ProcessRegistration.php" method="POST" enctype="multipart/form-data">
                <label>FULL NAME</label>
                <input type="text" name="UserName" placeholder="Enter your full name" pattern="[A-Za-z][A-Za-z0-9 .,'-]{1,59}" title="Use 2-60 characters: letters, numbers, spaces, and . , ' - only." required>    
                <label>USER EMAIL</label>
                <input type="email" name="UserEmail" placeholder="Enter your email" pattern="[A-Za-z0-9][A-Za-z0-9._%+\-]*@[A-Za-z0-9][A-Za-z0-9.\-]*\.[A-Za-z]{2,}" title="Enter a valid email address." required>
                <label>USER PASSWORD</label>
                <input type="password" name="UserPass" placeholder="Create a password" pattern="[A-Za-z0-9!@#$%^&*?_+.]{6,64}" title="6-64 characters. Letters, numbers, and !@#$%^&*?_+. only." required>
                <button type="submit" name="registerUser_btn"> Register User</button>
            </form>

            <div class="consumer-notice">
                Just looking for a stall? <br>
                <a href="HomePageUnRegistered.php">Continue as Consumer (Guest)</a>
            </div>
        </div>
    </div>
</div>

<script>
    function switchTab(type) {
        const tabs = document.querySelectorAll('.tab');
        const forms = document.querySelectorAll('.form-section');
        
        tabs.forEach(t => t.classList.remove('active'));
        forms.forEach(f => f.classList.remove('active'));
        
        if (type === 'login') {
            tabs[0].classList.add('active');
            document.getElementById('login-form').classList.add('active');
        } else if (type === 'register') {
            tabs[1].classList.add('active');
            document.getElementById('register-form').classList.add('active');
        } else {
            tabs[2].classList.add('active');
            document.getElementById('user-form').classList.add('active');
        }
    }

    function handleAccess(type) {
        alert(type === 'login' ? 'Logging in as Stall Owner...' : 'Submitting registration for approval...');
        alert(type === 'login' ? 'Logging in as User...' : 'Submitting user registration...');
    }
</script>

</body>
</html>