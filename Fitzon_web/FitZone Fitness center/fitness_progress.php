<?php
@include 'config.php';
session_start();

if(!isset($_SESSION['member_name'])){
   header('location:login_form.php');
}

$member_id = $_SESSION['member_id'];

// Handle form submission for new progress entry
if(isset($_POST['submit'])){
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $bmi = ($weight / ($height * $height)) * 10000; // BMI calculation
    $notes = $_POST['notes'];
    
    $insert_query = "INSERT INTO fitness_progress (member_id, weight, height, bmi, notes) 
                     VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("iddds", $member_id, $weight, $height, $bmi, $notes);
    $stmt->execute();
}

// Fetch progress history
$select_progress = "SELECT * FROM fitness_progress 
                   WHERE member_id = ? 
                   ORDER BY record_date DESC";
$stmt = $conn->prepare($select_progress);
$stmt->bind_param("i", $member_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch latest metrics for charts
$chart_query = "SELECT weight, bmi, record_date 
                FROM fitness_progress 
                WHERE member_id = ? 
                ORDER BY record_date ASC 
                LIMIT 10";
$chart_stmt = $conn->prepare($chart_query);
$chart_stmt->bind_param("i", $member_id);
$chart_stmt->execute();
$chart_result = $chart_stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fitness Progress - Fitness Center</title>
    <link rel="stylesheet" href="fitness_progress.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="dashboard-container">
        <nav class="sidebar">
            <h2>Member Portal</h2>
            <ul>
                <li><a href="book-class.php">Book Classes</a></li>
                <li><a href="my-schedule.php">My Schedule</a></li>
                <li><a href="fitness-progress.php" class="active">Fitness Progress</a></li>
                <li><a href="membership.php">Membership Details</a></li>
                <li><a href="profile.php">My Profile</a></li>
                <li><a href="payments.php">Payment History</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>

        <main class="content">
            <h1>Fitness Progress Tracker</h1>

            <div class="progress-container">
                <div class="progress-form">
                    <h2>Add New Progress Entry</h2>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="weight">Weight (kg)</label>
                            <input type="number" step="0.1" name="weight" required>
                        </div>
                        <div class="form-group">
                            <label for="height">Height (cm)</label>
                            <input type="number" step="0.1" name="height" required>
                        </div>
                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea name="notes" rows="3"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn-submit">Save Progress</button>
                    </form>
                </div>

                <div class="progress-charts">
                    <div class="chart-container">
                        <canvas id="weightChart"></canvas>
                    </div>
                    <div class="chart-container">
                        <canvas id="bmiChart"></canvas>
                    </div>
                </div>

                <div class="progress-history">
                    <h2>Progress History</h2>
                    <table class="progress-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Weight (kg)</th>
                                <th>Height (cm)</th>
                                <th>BMI</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo date('M d, Y', strtotime($row['record_date'])); ?></td>
                                <td><?php echo number_format($row['weight'], 1); ?></td>
                                <td><?php echo number_format($row['height'], 1); ?></td>
                                <td><?php echo number_format($row['bmi'], 1); ?></td>
                                <td><?php echo htmlspecialchars($row['notes']); ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Chart data preparation
        <?php
        $dates = [];
        $weights = [];
        $bmis = [];
        while($chart_data = $chart_result->fetch_assoc()) {
            $dates[] = date('M d', strtotime($chart_data['record_date']));
            $weights[] = $chart_data['weight'];
            $bmis[] = $chart_data['bmi'];
        }
        ?>

        // Weight Chart
        new Chart(document.getElementById('weightChart'), {
            type: 'line',
            data: {
                labels: <?php echo json_encode($dates); ?>,
                datasets: [{
                    label: 'Weight Progress',
                    data: <?php echo json_encode($weights); ?>,
                    borderColor: '#3498db',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Weight Progress Over Time'
                    }
                }
            }
        });

        // BMI Chart
        new Chart(document.getElementById('bmiChart'), {
            type: 'line',
            data: {
                labels: <?php echo json_encode($dates); ?>,
                datasets: [{
                    label: 'BMI Progress',
                    data: <?php echo json_encode($bmis); ?>,
                    borderColor: '#2ecc71',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'BMI Progress Over Time'
                    }
                }
            }
        });
    </script>
</body>
</html>
