<?php
@include 'config.php';
session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}

// Fetch all payments
$select = mysqli_query($conn, "SELECT * FROM payments ORDER BY payment_date DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment History - Fitness Center</title>
    <link rel="stylesheet" href="table.css">
</head>
<body>
    <div class="dashboard-container">
        <nav class="sidebar">
            <h2>Admin Panel</h2>
            <ul>
                <li><a href="manage_user.php">Manage Members</a></li>
                <li><a href="manage_instructors.php">Manage Instructors</a></li>
                <li><a href="manage_classes.php">Manage Classes</a></li>
                <li><a href="reports.php">Reports</a></li>
                <li><a href="payments.php" class="active">Payment History</a></li>
                <li><a href="settings.php">Settings</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>

        <main class="content">
            <h1>Payment History</h1>
            
            <div class="payments-container">
                <div class="payment-summary">
                    <div class="summary-card">
                        <h3>Total Revenue</h3>
                        <p>$45,250</p>
                    </div>
                    <div class="summary-card">
                        <h3>This Month</h3>
                        <p>$15,000</p>
                    </div>
                    <div class="summary-card">
                        <h3>Pending</h3>
                        <p>$2,500</p>
                    </div>
                </div>

                <div class="payment-filters">
                    <input type="text" id="searchPayment" placeholder="Search payments...">
                    <select id="filterStatus">
                        <option value="">All Status</option>
                        <option value="completed">Completed</option>
                        <option value="pending">Pending</option>
                        <option value="failed">Failed</option>
                    </select>
                    <button class="export-btn">Export Data</button>
                </div>

                <div class="payment-table-container">
                    <table class="payment-table">
                        <thead>
                            <tr>
                                <th>Invoice ID</th>
                                <th>Member Name</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Payment Method</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($select)){ ?>
                            <tr>
                                <td>#<?php echo $row['invoice_id']; ?></td>
                                <td><?php echo $row['member_name']; ?></td>
                                <td>$<?php echo $row['amount']; ?></td>
                                <td><?php echo date('d M Y', strtotime($row['payment_date'])); ?></td>
                                <td><?php echo $row['payment_method']; ?></td>
                                <td>
                                    <span class="payment-status <?php echo strtolower($row['status']); ?>">
                                        <?php echo $row['status']; ?>
                                    </span>
                                </td>
                                <td class="payment-actions">
                                    <button class="view-btn" onclick="viewPayment(<?php echo $row['id']; ?>)">View</button>
                                    <button class="print-btn" onclick="printInvoice(<?php echo $row['id']; ?>)">Print</button>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
