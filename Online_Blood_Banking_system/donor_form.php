<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'donor') {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $blood_type = $_POST['blood_type'];
    $storage_area = $_POST['storage_area'];
    $storage_date = $_POST['storage_date'];
    $donor_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO blood_donations (blood_type, storage_area, storage_date, donor_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $blood_type, $storage_area, $storage_date, $donor_id);

    if ($stmt->execute()) {
        echo "Blood donation details submitted successfully. Waiting for admin approval.";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blood Donation Form</title>
    <style>
        form { width: 300px; margin: auto; padding: 20px; background: #fff; border-radius: 8px; }
        input, select { display: block; width: 100%; margin: 10px 0; padding: 10px; }
        button { padding: 10px 20px; background: #007BFF; color: white; border: none; }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Blood Donation Form</h2>
        <input type="text" name="blood_type" placeholder="Blood Type" required>
        <input type="text" name="storage_area" placeholder="Storage Area" required>
        <input type="date" name="storage_date" placeholder="Storage Date" required>
        <button type="submit">Submit Donation</button>
    </form>
</body>
</html>
