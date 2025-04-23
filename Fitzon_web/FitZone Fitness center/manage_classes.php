<?php
@include 'config.php';
session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}

// Delete class
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $delete = mysqli_query($conn, "DELETE FROM classes WHERE id = $id");
    if($delete){
        header('location:manage_classes.php');
    }
}

// Fetch all classes
$select = mysqli_query($conn, "SELECT * FROM classes");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Classes - Fitness Center</title>
    <link rel="stylesheet" href="new.css">
</head>
<body>
    <div class="dashboard-container">
        <nav class="sidebar">
            <h2>Admin Panel</h2>
            <ul>
                <li><a href="manage_user.php">Manage Members</a></li>
                <li><a href="manage_instructors.php">Manage Instructors</a></li>
                <li><a href="manage_classes.php" class="active">Manage Classes</a></li>
                <li><a href="reports.php">Reports</a></li>
                <li><a href="payments.php">Payment History</a></li>
                <li><a href="settings.php">Settings</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>

        <main class="content">
            <h1>Manage Classes</h1>
            <div class="classes-container">
                <div class="class-actions">
                    <button onclick="window.location.href='add_class.php'" class="add-class-btn">Add New Class</button>
                    <div class="class-filters">
                        <select id="filterDay">
                            <option value="">All Days</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                            <option value="Sunday">Sunday</option>
                        </select>
                    </div>
                </div>

                <div class="class-grid">
                    <?php while($row = mysqli_fetch_assoc($select)){ ?>
                    <div class="class-card">
                        <div class="class-header" style="background-color: <?php echo $row['color'] ?? '#3498db'; ?>">
                            <h3><?php echo $row['class_name']; ?></h3>
                            <span class="class-type"><?php echo $row['class_type']; ?></span>
                        </div>
                        <div class="class-body">
                            <p><strong>Instructor:</strong> <?php echo $row['instructor']; ?></p>
                            <p><strong>Time:</strong> <?php echo $row['time']; ?></p>
                            <p><strong>Duration:</strong> <?php echo $row['duration']; ?> minutes</p>
                            <p><strong>Capacity:</strong> <?php echo $row['capacity']; ?> people</p>
                            <p><strong>Room:</strong> <?php echo $row['room']; ?></p>
                        </div>
                        <div class="class-actions">
                            <a href="edit_class.php?id=<?php echo $row['id']; ?>" class="edit-btn">Edit</a>
                            <a href="manage-classes.php?delete=<?php echo $row['id']; ?>" 
                               class="delete-btn" 
                               onclick="return confirm('Are you sure you want to delete this class?')">Delete</a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
