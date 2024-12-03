<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'donor') {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $blood_type = $_POST['blood_type'];
    $storage_area = $_POST['storage_area'];
    $storage_date = $_POST['storage_date'];

    $stmt = $conn->prepare("INSERT INTO blood_donations (blood_type, storage_area, storage_date, donor_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $blood_type, $storage_area, $storage_date, $user_id);

    if ($stmt->execute()) {
        $success = "Blood donation added successfully. Awaiting admin approval.";
    } else {
        $error = "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Donor Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; }
        .container { width: 80%; margin: auto; padding: 20px; background: #fff; border-radius: 8px; }
        form { margin: 20px 0; }
        input { display: block; margin: 10px 0; padding: 10px; width: 100%; }
        button { padding: 10px 20px; background: #007BFF; color: white; border: none; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, <?= $_SESSION['username'] ?> (Donor)</h2>
        <a href="logout.php">Logout</a>

        <h3>Add Blood Donation</h3>
        <?php if (isset($success)): ?>
            <p style="color: green;"><?= $success ?></p>
        <?php elseif (isset($error)): ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="blood_type" placeholder="Blood Type (e.g., A+)" required>
            <input type="text" name="storage_area" placeholder="Storage Area" required>
            <input type="date" name="storage_date" required>
            <button type="submit">Add Donation</button>
        </form>
    </div>
</body>
</html>
