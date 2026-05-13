<?php
require 'db_connect.php'; 


// 1. CRUD: UPDATE ACTIONS (Catching the Form)

// UPDATE USER
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_update_user'])) {
    $id = intval($_POST['user_id']);
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    
    $conn->query("UPDATE userinfo SET UserName='$username', UserEmail='$email', UserPass='$password' WHERE UserID=$id");
    header("Location: AdminDashBoard.php?view=users");
    exit();
}

// UPDATE VENDOR
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_update_vendor'])) {
    $id = intval($_POST['vendor_id']);
    $vendorname = $conn->real_escape_string($_POST['vendorname']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    
    $conn->query("UPDATE vendors SET VendorName='$vendorname', VendorEmail='$email', VendorPassword='$password' WHERE VendorStallID=$id");
    header("Location: AdminDashBoard.php?view=vendors");
    exit();
}


// 2. CRUD: DELETE ACTIONS

if (isset($_GET['delete_user'])) {
    $id = intval($_GET['delete_user']);
    $conn->query("DELETE FROM userinfo WHERE UserID = $id");
    header("Location: AdminDashBoard.php?view=users");
    exit();
}

if (isset($_GET['delete_vendor'])) {
    $id = intval($_GET['delete_vendor']);
    $conn->query("DELETE FROM vendors WHERE VendorStallID = $id");
    header("Location: AdminDashBoard.php?view=vendors");
    exit();
}


// 3. FETCH DASHBOARD STATS
$user_data = $conn->query("SELECT COUNT(*) AS total FROM userinfo")->fetch_assoc();
$total_users = $user_data['total'];

$vendor_data = $conn->query("SELECT COUNT(*) AS total FROM vendors")->fetch_assoc();
$total_vendors = $vendor_data['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#1a1a1a] text-gray-200 font-sans min-h-screen p-10 pb-20">
    <h1 class="text-4xl font-bold mb-8 text-center text-white">Admin Dashboard</h1>
    <div class="nav-link mb-8 flex justify-center">
        <a href="Registration.php?logout=1" class="inline-flex items-center justify-center bg-[#333333] hover:bg-[#444444] text-white font-bold px-6 py-2 rounded transition-colors">Exit</a>
    </div>
    <!-- Stats Boxes Container -->
    <div class="flex flex-col md:flex-row justify-center gap-8 max-w-5xl mx-auto">
        <!-- User Stats Box -->
        <div class="border border-gray-700 bg-[#222222] p-8 w-full md:w-1/2 rounded flex flex-col justify-between">
            <div class="text-center mb-8">
                <h2 class="font-bold text-lg mb-4 text-white">System Users</h2>
                <div class="text-5xl font-bold text-white mb-2"><?php echo $total_users; ?></div>
                <div class="text-sm font-normal text-gray-400">Registered Accounts</div>
            </div>
            <a href="?view=users" class="w-full block bg-[#333333] hover:bg-[#444444] text-center text-white py-3 text-sm font-bold transition-colors rounded">
                Manage Users
            </a>
        </div>

        <!-- Vendor Stats Box -->
        <div class="border border-gray-700 bg-[#222222] p-8 w-full md:w-1/2 rounded flex flex-col justify-between">
            <div class="text-center mb-8">
                <h2 class="font-bold text-lg mb-4 text-white">Active Vendors</h2>
                <div class="text-5xl font-bold text-white mb-2"><?php echo $total_vendors; ?></div>
                <div class="text-sm font-normal text-gray-400">Registered Stalls</div>
            </div>
            <a href="?view=vendors" class="w-full block bg-[#4A7c2f] hover:bg-[#3a6325] text-center text-white py-3 text-sm font-bold transition-colors rounded">
                Manage Vendors
            </a>
        </div>
    </div>

    
    <!-- 4. DYNAMIC CRUD VIEWS (Tables & Forms)-->
    <div class="max-w-5xl mx-auto mt-16">
        <?php
        $view = isset($_GET['view']) ? $_GET['view'] : '';

        // EDIT FORMS (Pop ups when Update is clicked)
        if (isset($_GET['edit_user'])) {
            $id = intval($_GET['edit_user']);
            $result = $conn->query("SELECT * FROM userinfo WHERE UserID = $id");
            $user = $result->fetch_assoc();
            
            echo "
            <div class='bg-[#222222] border border-gray-700 p-8 rounded shadow max-w-lg mx-auto'>
                <h2 class='text-2xl font-bold text-white mb-6'>Update User</h2>
                <form action='AdminDashBoard.php' method='POST' class='space-y-4'>
                    <input type='hidden' name='user_id' value='{$user['UserID']}'>
                    
                    <div>
                        <label class='block text-sm text-gray-400 mb-1'>Username</label>
                        <input type='text' name='username' value='" . htmlspecialchars($user['UserName']) . "' class='w-full bg-[#333] border border-gray-600 px-3 py-2 text-white rounded focus:outline-none focus:border-red-500'>
                    </div>
                    <div>
                        <label class='block text-sm text-gray-400 mb-1'>Email Address</label>
                        <input type='email' name='email' value='" . htmlspecialchars($user['UserEmail']) . "' class='w-full bg-[#333] border border-gray-600 px-3 py-2 text-white rounded focus:outline-none focus:border-red-500'>
                    </div>
                    <div>
                        <label class='block text-sm text-gray-400 mb-1'>Password</label>
                        <input type='text' name='password' value='" . htmlspecialchars($user['UserPass']) . "' class='w-full bg-[#333] border border-gray-600 px-3 py-2 text-white rounded focus:outline-none focus:border-red-500'>
                    </div>
                    
                    <div class='flex gap-4 pt-4'>
                        <button type='submit' name='submit_update_user' class='bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded w-full'>Save Changes</button>
                        <a href='?view=users' class='bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded w-full text-center'>Cancel</a>
                    </div>
                </form>
            </div>";
        }

        elseif (isset($_GET['edit_vendor'])) {
            $id = intval($_GET['edit_vendor']);
            $result = $conn->query("SELECT * FROM vendors WHERE VendorStallID = $id");
            $vendor = $result->fetch_assoc();
            
            echo "
            <div class='bg-[#222222] border border-gray-700 p-8 rounded shadow max-w-lg mx-auto'>
                <h2 class='text-2xl font-bold text-white mb-6'>Update Vendor</h2>
                <form action='AdminDashBoard.php' method='POST' class='space-y-4'>
                    <input type='hidden' name='vendor_id' value='{$vendor['VendorStallID']}'>
                    
                    <div>
                        <label class='block text-sm text-gray-400 mb-1'>Vendor Name</label>
                        <input type='text' name='vendorname' value='" . htmlspecialchars($vendor['VendorName']) . "' class='w-full bg-[#333] border border-gray-600 px-3 py-2 text-white rounded focus:outline-none focus:border-red-500'>
                    </div>
                    <div>
                        <label class='block text-sm text-gray-400 mb-1'>Email Address</label>
                        <input type='email' name='email' value='" . htmlspecialchars($vendor['VendorEmail']) . "' class='w-full bg-[#333] border border-gray-600 px-3 py-2 text-white rounded focus:outline-none focus:border-red-500'>
                    </div>
                    <div>
                        <label class='block text-sm text-gray-400 mb-1'>Password</label>
                        <input type='text' name='password' value='" . htmlspecialchars($vendor['VendorPassword']) . "' class='w-full bg-[#333] border border-gray-600 px-3 py-2 text-white rounded focus:outline-none focus:border-red-500'>
                    </div>
                    
                    <div class='flex gap-4 pt-4'>
                        <button type='submit' name='submit_update_vendor' class='bg-[#4A7c2f] hover:bg-[#3a6325] text-white font-bold py-2 px-6 rounded w-full'>Save Changes</button>
                        <a href='?view=vendors' class='bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded w-full text-center'>Cancel</a>
                    </div>
                </form>
            </div>";
        }

        // SHOW USERS TABLE
        elseif ($view == 'users') {
            echo "<h2 class='text-2xl font-bold text-white mb-6'>User Management</h2>";
            $users = $conn->query("SELECT * FROM userinfo");
            
            echo "<div class='bg-[#222222] border border-gray-700 rounded shadow overflow-hidden'>
                    <table class='w-full text-left border-collapse'>
                        <thead>
                            <tr class='bg-[#333333] text-gray-300 text-sm uppercase'>
                                <th class='py-4 px-6 border-b border-gray-700'>ID</th>
                                <th class='py-4 px-6 border-b border-gray-700'>Username</th>
                                <th class='py-4 px-6 border-b border-gray-700'>Email</th>
                                <th class='py-4 px-6 border-b border-gray-700'>Password</th>
                                <th class='py-4 px-6 border-b border-gray-700 text-right'>Actions</th>
                            </tr>
                        </thead>
                        <tbody>";
            
            if ($users->num_rows > 0) {
                while($row = $users->fetch_assoc()) {
                    echo "<tr class='hover:bg-[#2a2a2a]'>
                            <td class='py-3 px-6 border-b border-gray-700'>{$row['UserID']}</td>
                            <td class='py-3 px-6 border-b border-gray-700'>" . htmlspecialchars($row['UserName']) . "</td>
                            <td class='py-3 px-6 border-b border-gray-700'>" . htmlspecialchars($row['UserEmail']) . "</td>
                            <td class='py-3 px-6 border-b border-gray-700 text-gray-500'>" . htmlspecialchars($row['UserPass']) . "</td>
                            <td class='py-3 px-6 border-b border-gray-700 text-right'>
                                <a href='?edit_user={$row['UserID']}' class='text-blue-400 hover:text-blue-300 font-bold mr-4'>Update</a>
                                <a href='?delete_user={$row['UserID']}' class='text-red-500 hover:text-red-400 font-bold' onclick=\"return confirm('Are you sure you want to delete this user?');\">Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='py-6 px-6 text-center text-gray-500'>No users found. Try registering one!</td></tr>";
            }
            echo "</tbody></table></div>";
        }

        // SHOW VENDORS TABLE
        elseif ($view == 'vendors') {
            echo "<h2 class='text-2xl font-bold text-white mb-6'>Vendor Management</h2>";
            $vendors = $conn->query("SELECT * FROM vendors");
            
            echo "<div class='bg-[#222222] border border-gray-700 rounded shadow overflow-hidden'>
                    <table class='w-full text-left border-collapse'>
                        <thead>
                            <tr class='bg-[#333333] text-gray-300 text-sm uppercase'>
                                <th class='py-4 px-6 border-b border-gray-700'>Stall ID</th>
                                <th class='py-4 px-6 border-b border-gray-700'>Vendor Name</th>
                                <th class='py-4 px-6 border-b border-gray-700'>Email</th>
                                <th class='py-4 px-6 border-b border-gray-700'>Password</th>
                                <th class='py-4 px-6 border-b border-gray-700 text-right'>Actions</th>
                            </tr>
                        </thead>
                        <tbody>";
            
            if ($vendors->num_rows > 0) {
                while($row = $vendors->fetch_assoc()) {
                    echo "<tr class='hover:bg-[#2a2a2a]'>
                            <td class='py-3 px-6 border-b border-gray-700'>{$row['VendorStallID']}</td>
                            <td class='py-3 px-6 border-b border-gray-700'>" . htmlspecialchars($row['VendorName']) . "</td>
                            <td class='py-3 px-6 border-b border-gray-700'>" . htmlspecialchars($row['VendorEmail']) . "</td>
                            <td class='py-3 px-6 border-b border-gray-700 text-gray-500'>" . htmlspecialchars($row['VendorPassword']) . "</td>
                            <td class='py-3 px-6 border-b border-gray-700 text-right'>
                                <a href='?edit_vendor={$row['VendorStallID']}' class='text-blue-400 hover:text-blue-300 font-bold mr-4'>Update</a>
                                <a href='?delete_vendor={$row['VendorStallID']}' class='text-red-500 hover:text-red-400 font-bold' onclick=\"return confirm('Are you sure you want to delete this vendor?');\">Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='py-6 px-6 text-center text-gray-500'>No vendors found.</td></tr>";
            }
            echo "</tbody></table></div>";
        }
        ?>
    </div>
</body>
</html>