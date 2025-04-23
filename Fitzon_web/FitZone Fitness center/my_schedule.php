<?php
@include 'config.php';
session_start();

if(!isset($_SESSION['member_name'])){
   header('location:login_form.php');
}

// Fetch the logged-in member's scheduled classes from the database
$member_name = $_SESSION['member_name'];
$query = "SELECT * FROM scheduled_classes WHERE member_name = '$member_name' ORDER BY class_date";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Schedule - Fitness Center</title>
    <link rel="stylesheet" href="new.css">
</head>
<body>
    <div class="dashboard-container">
        <nav class="sidebar">
            <h2>Member Portal</h2>
            <ul>
                <li><a href="book-class.php">Book Classes</a></li>
                <li><a href="my_schedule.php">My Schedule</a></li>
                <li><a href="fitness-progress.php">Fitness Progress</a></li>
                <li><a href="membership.php">Membership Details</a></li>
                <li><a href="profile.php">My Profile</a></li>
                <li><a href="payments.php">Payment History</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        
        <main class="content">
            <h1>My Schedule</h1>
            <div class="schedule-table">
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Class</th>
                        <th>Instructor</th>
                    </tr>
                    <?php
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<tr>";
                            echo "<td>" . $row['class_date'] . "</td>";
                            echo "<td>" . $row['class_time'] . "</td>";
                            echo "<td>" . $row['class_name'] . "</td>";
                            echo "<td>" . $row['instructor'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No classes scheduled.</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
