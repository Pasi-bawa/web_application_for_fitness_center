<?php
@include 'config.php';
session_start();

if (!isset($_SESSION['member_name'])) {
    header('location:login_form.php');
    exit;
}

$member_id = $_SESSION['member_id'];

// Fetch member details
$query = "SELECT * FROM member WHERE member_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $member_id);
$stmt->execute();
$result = $stmt->get_result();
$member_data = $result->fetch_assoc();

// Handle profile update
if (isset($_POST['update_profile'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $emergency_contact = $_POST['emergency_contact'];
    $address = $_POST['address'];

    // Update profile information
    $update_query = "UPDATE member SET 
                    member_name = ?, 
                    email = ?, 
                    phone = ?, 
                    emergency_contact = ?, 
                    address = ? 
                    WHERE member_id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("sssssi", $name, $email, $phone, $emergency_contact, $address, $member_id);
    
    if ($update_stmt->execute()) {
        $_SESSION['member_name'] = $name;
        $success_msg = "Profile updated successfully!";
    } else {
        $error_msg = "Failed to update profile.";
    }
}

// Handle password change
if (isset($_POST['change_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password === $confirm_password) {
        // Verify current password
        $verify_query = "SELECT password FROM member WHERE member_id = ?";
        $verify_stmt = $conn->prepare($verify_query);
        $verify_stmt->bind_param("i", $member_id);
        $verify_stmt->execute();
        $current_pwd = $verify_stmt->get_result()->fetch_assoc()['password'];

        if (password_verify($current_password, $current_pwd)) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $password_query = "UPDATE member SET password = ? WHERE member_id = ?";
            $password_stmt = $conn->prepare($password_query);
            $password_stmt->bind_param("si", $hashed_password, $member_id);

            if ($password_stmt->execute()) {
                $password_success = "Password updated successfully!";
            } else {
                $password_error = "Failed to update password.";
            }
        } else {
            $password_error = "Current password is incorrect!";
        }
    } else {
        $password_error = "New passwords do not match!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile - Fitness Center</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <div class="dashboard-container">
        <nav class="sidebar">
            <h2>Member Portal</h2>
            <ul>
                <li><a href="book-class.php">Book Classes</a></li>
                <li><a href="my_schedule.php">My Schedule</a></li>
                <li><a href="fitness_progress.php">Fitness Progress</a></li>
                <li><a href="membership.php">Membership Details</a></li>
                <li><a href="profile.php" class="active">My Profile</a></li>
                <li><a href="payments.php">Payment History</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>

        <main class="content">
            <h1>My Profile</h1>

            <?php if (isset($success_msg)): ?>
                <div class="alert success"><?php echo $success_msg; ?></div>
            <?php elseif (isset($error_msg)): ?>
                <div class="alert error"><?php echo $error_msg; ?></div>
            <?php endif; ?>

            <div class="profile-container">
                <div class="profile-section">
                    <h2>Personal Information</h2>
                    <form action="" method="POST" class="profile-form">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" value="<?php echo htmlspecialchars($member_data['member_name']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" value="<?php echo htmlspecialchars($member_data['email']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="tel" name="phone" value="<?php echo htmlspecialchars($member_data['phone']); ?>">
                        </div>
                        <div class="form-group">
                            <label>Emergency Contact</label>
                            <input type="tel" name="emergency_contact" value="<?php echo htmlspecialchars($member_data['emergency_contact']); ?>">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address" rows="3"><?php echo htmlspecialchars($member_data['address']); ?></textarea>
                        </div>
                        <button type="submit" name="update_profile" class="btn-update">Update Profile</button>
                    </form>
                </div>

                <div class="profile-section">
                    <h2>Change Password</h2>
                    <?php if (isset($password_success)): ?>
                        <div class="alert success"><?php echo $password_success; ?></div>
                    <?php elseif (isset($password_error)): ?>
                        <div class="alert error"><?php echo $password_error; ?></div>
                    <?php endif; ?>

                    <form action="" method="POST" class="password-form">
                        <div class="form-group">
                            <label>Current Password</label>
                            <input type="password" name="current_password" required>
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="new_password" required>
                        </div>
                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <input type="password" name="confirm_password" required>
                        </div>
                        <button type="submit" name="change_password" class="btn-password">Change Password</button>
                    </form>
                </div>

                <div class="profile-section">
                    <h2>Account Information</h2>
                    <div class="account-info">
                        <p><strong>Member ID:</strong> <?php echo $member_data['member_id']; ?></p>
                        <p><strong>Join Date:</strong> <?php echo date('F d, Y', strtotime($member_data['join_date'])); ?></p>
                        <p><strong>Membership Status:</strong> <?php echo $member_data['membership_status']; ?></p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
