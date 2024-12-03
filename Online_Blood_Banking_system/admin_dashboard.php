<?php
include 'db.php';
session_start();

// Ensure that the user is logged in and has an 'admin' role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Handle donation approval and rejection
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // For donation approval
    if (isset($_POST['approve_donation'])) {
        $donation_id = $_POST['donation_id'];
        $stmt = $conn->prepare("UPDATE blood_donations SET status = 'approved' WHERE id = ?");
        $stmt->bind_param("i", $donation_id);
        $stmt->execute();
    }
    // For donation rejection
    elseif (isset($_POST['reject_donation'])) {
        $donation_id = $_POST['donation_id'];
        $stmt = $conn->prepare("UPDATE blood_donations SET status = 'rejected' WHERE id = ?");
        $stmt->bind_param("i", $donation_id);
        $stmt->execute();
    }
    // For request approval
    elseif (isset($_POST['approve_request'])) {
        $request_id = $_POST['request_id'];
        $stmt = $conn->prepare("UPDATE blood_requests SET status = 'approved' WHERE id = ?");
        $stmt->bind_param("i", $request_id);
        $stmt->execute();
    }
    // For request rejection
    elseif (isset($_POST['reject_request'])) {
        $request_id = $_POST['request_id'];
        $stmt = $conn->prepare("UPDATE blood_requests SET status = 'rejected' WHERE id = ?");
        $stmt->bind_param("i", $request_id);
        $stmt->execute();
    }
}

// Fetch pending blood donations
$donations = $conn->query("SELECT * FROM blood_donations WHERE status = 'pending'");

// Fetch pending blood requests
$requests = $conn->query("SELECT * FROM blood_requests WHERE status = 'pending'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        button {
            padding: 8px 16px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        button.reject {
            background-color: #dc3545;
        }
        .actions {
            display: flex;
            gap: 10px;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Dashboard</h2>
        <a href="logout.php">Logout</a>

        <h3>Pending Blood Donations</h3>
        <?php if ($donations->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Donor ID</th>
                        <th>Blood Type</th>
                        <th>Storage Area</th>
                        <th>Storage Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($donation = $donations->fetch_assoc()): ?>
                        <tr>
                            <td><?= $donation['donor_id'] ?></td>
                            <td><?= $donation['blood_type'] ?></td>
                            <td><?= $donation['storage_area'] ?></td>
                            <td><?= $donation['storage_date'] ?></td>
                            <td class="actions">
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="donation_id" value="<?= $donation['id'] ?>">
                                    <button type="submit" name="approve_donation">Approve</button>
                                </form>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="donation_id" value="<?= $donation['id'] ?>">
                                    <button type="submit" name="reject_donation" class="reject">Reject</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No pending blood donations.</p>
        <?php endif; ?>

        <h3>Pending Blood Requests</h3>
        <?php if ($requests->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Requester ID</th>
                        <th>Blood Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($request = $requests->fetch_assoc()): ?>
                        <tr>
                            <td><?= $request['requester_id'] ?></td>
                            <td><?= $request['blood_type'] ?></td>
                            <td class="actions">
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="request_id" value="<?= $request['id'] ?>">
                                    <button type="submit" name="approve_request">Approve</button>
                                </form>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="request_id" value="<?= $request['id'] ?>">
                                    <button type="submit" name="reject_request" class="reject">Reject</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No pending blood requests.</p>
        <?php endif; ?>
    </div>
</body>
</html>
