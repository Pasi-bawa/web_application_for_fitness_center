<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['member_name'])){
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Member Dashboard - Fitness Center</title>
    <link rel="stylesheet" href="new.css">
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
                <li><a href="profile.php">My Profile</a></li>
                <li><a href="payments.php">Payment History</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        
        <main class="content">
        <h1>welcome <span><?php echo $_SESSION['member_name'] ?></span></h1>
            <div class="dashboard-stats">
                <div class="stat-box">
                    <h3>Membership Status</h3>
                    <p>Active</p>
                </div>
                <div class="stat-box">
                    <h3>Classes This Month</h3>
                    <p>12</p>
                </div>
                <div class="stat-box">
                    <h3>Next Class</h3>
                    <p>Yoga - 2PM</p>
                </div>
                <div class="stat-box">
                    <h3>Fitness Points</h3>
                    <p>850</p>
                </div>
            </div>
            
            <div class="upcoming-classes">
                <h2>Upcoming Classes</h2>
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Class</th>
                        <th>Instructor</th>
                        <th>Action</th>
                    </tr>
                    <!-- Add PHP loop here to display booked classes -->
                </table>
            </div>
        </main>
    </div>
</body>
</html>