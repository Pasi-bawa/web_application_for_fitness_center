<?php
@include 'config.php';
session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}

// Delete instructor
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $delete = mysqli_query($conn, "DELETE FROM instructor WHERE id = $id");
    if($delete){
        header('location:manage_instructors.php');
    }
}

// Fetch all instructors
$select = mysqli_query($conn, "SELECT * FROM instructor");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Instructors - Fitness Center</title>
    <link rel="stylesheet" href="new.css">
</head>
<body>
    <div class="dashboard-container">
        <nav class="sidebar">
            <h2>Admin Panel</h2>
            <ul>
                <li><a href="manage_user.php">Manage Members</a></li>
                <li><a href="manage_instructors.php" class="active">Manage Instructors</a></li>
                <li><a href="manage-classes.php">Manage Classes</a></li>
                <li><a href="reports.php">Reports</a></li>
                <li><a href="payments.php">Payment History</a></li>
                <li><a href="settings.php">Settings</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>

        <main class="content">
            <h1>Manage Instructors</h1>
            <div class="instructors-container">
                <div class="add-instructor">
                    <button onclick="window.location.href='add_instructors.php'">Add New Instructor</button>
                </div>
                
                <table class="instructors-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Profile</th>
                            <th>Name</th>
                            <th>Specialization</th>
                            <th>Contact</th>
                            <th>Schedule</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($select)){ ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td>
                                <img src="<?php echo $row['profile_image'] ?? 'images/default.jpg'; ?>" 
                                     class="instructor-image" 
                                     alt="Instructor">
                            </td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['specialization']; ?></td>
                            <td><?php echo $row['contact']; ?></td>
                            <td><?php echo $row['schedule']; ?></td>
                            <td>
                                <span class="status <?php echo $row['status']; ?>">
                                    <?php echo $row['status']; ?>
                                </span>
                            </td>
                            <td class="actions">
                                <a href="edit_instructor.php?id=<?php echo $row['id']; ?>" class="edit-btn">Edit</a>
                                <a href="manage_instructors.php?delete=<?php echo $row['id']; ?>" 
                                   class="delete-btn" 
                                   onclick="return confirm('Are you sure you want to delete this instructor?')">Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
