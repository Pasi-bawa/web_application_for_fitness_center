<?php
@include 'config.php';
session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}

// Handle user deletion
if(isset($_POST['delete_member'])){
    $id = $_POST['member_id'];
    $delete = "DELETE FROM user_form WHERE id = '$id'";
    mysqli_query($conn, $delete);
}

// Fetch all users
$select = "SELECT * FROM user_form";
$result = mysqli_query($conn, $select);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users - Fitness Center</title>
    <link rel="stylesheet" href="new.css">
</head>
<body>
    <div class="dashboard-container">
        <nav class="sidebar">
            <h2>Admin Panel</h2>
            <ul>
                <li><a href="admin_page.php">Dashboard</a></li>
                <li><a href="manage_member.php" class="active">Manage Members</a></li>
                <li><a href="manage_instructors.php">Manage Instructors</a></li>
                <li><a href="manage_classes.php">Manage Classes</a></li>
                <li><a href="reports.php">Reports</a></li>
                <li><a href="payments.php">Payment History</a></li>
                <li><a href="settings.php">Settings</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>

        <main class="content">
            <h1>Manage members</h1>
            <div class="add-user-section">
                <a href="register_form.php" class="add-btn">Add New memberr</a>
            </div>

            <table class="user-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>User Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['user_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['user_type']; ?></td>
                        <td class="action-buttons">
                            <a href="edit_member.php?user_id=<?php echo $row['user_id']; ?>" class="edit-btn">Edit</a>
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="member_id" value="<?php echo $row['user_id']; ?>">
                                <button type="submit" name="delete_member" class="delete-btn" 
                                        onclick="return confirm('Are you sure you want to delete this member?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>

