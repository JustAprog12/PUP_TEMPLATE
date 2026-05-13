<?php
    require 'db_connect.php';
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PUP Vendor Portal - Home</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <style>
        :root {
            --maroon: #800000;
            --gold: #f2c413;
            --text-main: #1a1a1a;
            --text-muted: #666;
            --border-color: #eeeeee;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #ffffff;
            color: var(--text-main);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar {
            background-color: var(--pup-maroon);
            color: rgb(173, 17, 17);
            padding: 20px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar h3 { margin: 10px; letter-spacing: 1px; }

        .nav-links a {
            color: rgb(173, 17, 17);
            text-decoration: none;
            margin-left: 20px;
            font-size: 0.9rem;
            font-weight: bold;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 60px 20px;
            width: 100%;
            box-sizing: border-box;
        }

        header h1 {
            color: rgb(173, 17, 17);
            font-size: 3.5rem;
            margin: 0;
            font-weight: 700;
        }

        header p {
            color: var(--text-muted);
            font-size: 1.1rem;
            margin: 10px 0 40px 0;
        }

        .separator {
            border: 5px solid black;
            border-top: 0.5 solid var(--border-color);
            margin: 40px 0;
        }

        .section-label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-label h2 {
            color: var(--pup-maroon);
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin: 0;
        }

        .vendor-list {
            border-top: 1px solid var(--border-color);
        }

        .vendor-item {
            display: flex;
            align-items: center;
            padding: 25px 0;
            border-bottom: 1px solid var(--border-color);
            text-decoration: none;
            color: inherit;
            transition: padding-left 0.3s ease;
        }

        .vendor-item:hover {
            padding-left: 10px;
            background-color: #fafafa;
        }

        .vendor-img {
            width: 60px;
            height: 60px;
            background: #f5f5f5;
            border-radius: 4px;
            margin-right: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
        }

        .vendor-info { flex: 1; }
        .vendor-info strong { display: block; font-size: 1.15rem; color: var(--pup-maroon); }
        .vendor-info span { font-size: 0.9rem; color: var(--text-muted); }

        .arrow { color: #ddd; }
    </style>
</head>
<body>

<div class="navbar">
    <h3>PUP ★ All-Stop-Shops</h3>

    <div class="nav-links">
        <a href="Registration.php">Register</a>
        <a href="AboutUs.php">About Us</a>
    </div>
</div>

<div class="container">
    <header>
        <h1>Welcome.</h1>
        <p>Find university vendors and essential services in one place.</p>
    </header>
    <hr class="separator">

    <div class="section-label">
        <h2>Browse Vendors</h2>
        <span class="" style="color: var(--pup-maroon);"></span>
    </div>

    <div class="vendor-list">
        <a href="Canteen_StallsUI.php" class="vendor-item">
            <div class="vendor-img">
                <span class="material-icons-outlined">storefront</span>
            </div>
            <div class="vendor-info">
                <strong>Food Stalls</strong>
                <span>Home-cooked meals & snacks • North Wing</span>
            </div>
            <span class="material-icons-outlined arrow">chevron_right</span>
        </a>

        <a href="SchoolSupplies_StallsUI.php" class="vendor-item">
            <div class="vendor-img">
                <span class="material-icons-outlined">print</span>
            </div>
            <div class="vendor-info">
                <strong>Services Stalls</strong>
                <span>Printing, Stationery & Uniforms • East Wing</span>
            </div>
            <span class="material-icons-outlined arrow">chevron_right</span>
        </a>

        <a href="Vanity_StallsUI.php" class="vendor-item">
            <div class="vendor-img">
                <span class="material-icons-outlined">search</span>
            </div>
            <div class="vendor-info">
                <strong>Vanity/School Supplies</strong>
                <span>Accessories, School • North Wing</span>
            </div>
            <span class="material-icons-outlined arrow">chevron_right</span>
        </a>
    </div>
</div>

</body>
</html>