<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=? AND role='admin'");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['user_id'] = $result->fetch_assoc()['id'];
        $_SESSION['role'] = 'admin';
        header('Location: admin_dashboard.php');
    } else {
        echo "Invalid admin credentials!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        form { width: 300px; margin: auto; padding: 20px; background: #fff; border-radius: 8px; }
        input { display: block; width: 100%; margin: 10px 0; padding: 10px; }
        button { padding: 10px 20px; background: #007BFF; color: white; border: none; }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Admin Login</h2>
        <input type="text" name="username" placeholder="Admin Username" required>
        <input type="password" name="password" placeholder="Admin Password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>
