<?php
include 'db.php';

// Fetch approved donations
$donations = $conn->query("SELECT * FROM blood_donations WHERE status='approved'");

// Fetch approved requests
$requests = $conn->query("SELECT * FROM blood_requests WHERE status='approved'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blood Repository</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; }
        .container { width: 80%; margin: auto; padding: 20px; background: #fff; border-radius: 8px; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 12px; text-align: left; }
        th { background: #007BFF; color: white; }
        a { margin: 0 10px; color: #007BFF; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Central Blood Repository</h1>
        <div>
            <a href="register.php">Register</a> | 
            <a href="login.php">Login</a> | 
            <a href="admin_login.php">Admin</a>
        </div>

        <h2>Available Blood</h2>
        <table>
            <tr>
                <th>Blood Type</th>
                <th>Storage Area</th>
                <th>Storage Date</th>
            </tr>
            <?php while ($row = $donations->fetch_assoc()): ?>
            <tr>
                <td><?= $row['blood_type'] ?></td>
                <td><?= $row['storage_area'] ?></td>
                <td><?= $row['storage_date'] ?></td>
            </tr>
            <?php endwhile; ?>
        </table>

        <h2>Blood Requests</h2>
        <table>
            <tr>
                <th>Blood Type</th>
                <th>Status</th>
            </tr>
            <?php while ($row = $requests->fetch_assoc()): ?>
            <tr>
                <td><?= $row['blood_type'] ?></td>
                <td><?= $row['status'] ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
