<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['instructor_name'])){
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Instructor Dashboard - Fitness Center</title>
    <link rel="stylesheet" href="new.css">
</head>
<body>
    <div class="dashboard-container">
        <nav class="sidebar">
            <h2>Instructor Panel</h2>
            <ul>
                <li><a href="my-classes.php">My Classes</a></li>
                <li><a href="schedule.php">Class Schedule</a></li>
                <li><a href="members.php">Class Members</a></li>
                <li><a href="attendance.php">Take Attendance</a></li>
                <li><a href="profile.php">My Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        
        <main class="content">
        <h1>welcome <span><?php echo $_SESSION['instructor_name'] ?></span></h1>
            <div class="dashboard-stats">
                <div class="stat-box">
                    <h3>Today's Classes</h3>
                    <p>4</p>
                </div>
                <div class="stat-box">
                    <h3>Total Students</h3>
                    <p>45</p>
                </div>
                <div class="stat-box">
                    <h3>Hours This Week</h3>
                    <p>24</p>
                </div>
                <div class="stat-box">
                    <h3>Rating</h3>
                    <p>4.8/5.0</p>
                </div>
            </div>
            
            <div class="upcoming-classes">
                <h2>Today's Schedule</h2>
                <table>
                    <tr>
                        <th>Time</th>
                        <th>Class</th>
                        <th>Room</th>
                        <th>Participants</th>
                    </tr>
                    <!-- Add PHP loop here to display classes -->
                </table>
            </div>
        </main>
    </div>
</body>
</html>