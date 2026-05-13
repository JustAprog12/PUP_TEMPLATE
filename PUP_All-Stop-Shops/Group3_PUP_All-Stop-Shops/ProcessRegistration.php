<?php
// 1. Bring in the database connection
require 'db_connect.php';

session_start();

function clean_value($value) {
    return trim($value ?? '');
}

function is_valid_stall_name($value) {
    return (bool)preg_match("/^[A-Za-z0-9][A-Za-z0-9 .,'-]{1,79}$/", $value);
}

function is_valid_user_name($value) {
    return (bool)preg_match("/^[A-Za-z][A-Za-z0-9 .,'-]{1,59}$/", $value);
}

function is_valid_password($value) {
    return (bool)preg_match("/^[A-Za-z0-9!@#$%^&*?_+.]{6,64}$/", $value);
}

function is_valid_email_address($value) {
    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    return (bool)preg_match("/^[A-Za-z0-9][A-Za-z0-9._%+-]*@[A-Za-z0-9][A-Za-z0-9.-]*\.[A-Za-z]{2,}$/", $value);
}

// 2. Check if the form was actually submitted
if (isset($_POST['registerVendor_btn'])) {
    
    // Grab the text data from the form
    $stall_name = clean_value($_POST['stall_name'] ?? '');
    $owner_email = clean_value($_POST['owner_email'] ?? '');
    $category = clean_value($_POST['category'] ?? '');
    $raw_password = clean_value($_POST['VendorPassword'] ?? '');

    if ($stall_name === '' || $owner_email === '' || $category === '' || $raw_password === '') {
        echo "<script>alert('Please fill in all required fields.'); window.history.back();</script>";
        exit();
    }

    if (!is_valid_stall_name($stall_name)) {
        echo "<script>alert('Stall name has invalid characters.'); window.history.back();</script>";
        exit();
    }

    if (!is_valid_email_address($owner_email)) {
        echo "<script>alert('Please enter a valid email address.'); window.history.back();</script>";
        exit();
    }

    if (!is_valid_password($raw_password)) {
        echo "<script>alert('Password must be 6-64 characters and use only letters, numbers, and !@#$%^&*?_+.'); window.history.back();</script>";
        exit();
    }

    // Grab the uploaded photo's name (You'll need a separate script to move the actual file to a folder)
    $photo_name = $_FILES['stall_photo']['name'];

    // 3. Store the password as-is to match existing login checks.
    $vendor_password = $raw_password;

    // 4. The SQL Command (The ? marks are placeholders for security)
    $sql = "INSERT INTO vendors (VendorName, VendorEmail, VendorPassword, Stall_Name, Category, Stall_Photo) VALUES (?, ?, ?, ?, ?, ?)";

    // 5. Prepare the statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind the variables to the ? placeholders
        // The "ssssss" means we are sending 6 Strings
        $stmt->bind_param("ssssss", $stall_name, $owner_email, $vendor_password, $stall_name, $category, $photo_name);

        // 6. Execute the command!
        if ($stmt->execute()) {
            echo "<script>alert('Stall successfully registered!'); window.location.href='HomePageVendor.php';</script>";
        } else {
            echo "Error saving to database: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Database query preparation failed: " . $conn->error;
    }
}

if (isset($_POST['registerUser_btn'])) {
    $user_name = clean_value($_POST['UserName'] ?? '');
    $student_id = clean_value($_POST['StudentID'] ?? '');
    $user_email = clean_value($_POST['UserEmail'] ?? '');
    $user_pass = clean_value($_POST['UserPass'] ?? '');

    if ($user_name !== '' && $user_email !== '' && $user_pass !== '') {
        if (!is_valid_user_name($user_name)) {
            echo "<script>alert('Full name has invalid characters.'); window.history.back();</script>";
            exit();
        }

        if (!is_valid_email_address($user_email)) {
            echo "<script>alert('Please enter a valid email address.'); window.history.back();</script>";
            exit();
        }

        if (!is_valid_password($user_pass)) {
            echo "<script>alert('Password must be 6-64 characters and use only letters, numbers, and !@#$%^&*?_+.'); window.history.back();</script>";
            exit();
        }

        $sql = "INSERT INTO userinfo (UserName, StudentID, UserEmail, UserPass) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssss", $user_name, $student_id, $user_email, $user_pass);

            if ($stmt->execute()) {
                $_SESSION['role'] = 'user';
                echo "<script>alert('User successfully registered!'); window.location.href='HomePageRegistered.php';</script>";
            } else {
                echo "Error saving to database: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Database query preparation failed: " . $conn->error;
        }
    } else {
        echo "<script>alert('Please fill in all required fields.'); window.history.back();</script>";
    }
}

$conn->close();
?>