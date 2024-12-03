<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $role = $_POST['role'];
    $contact = $_POST['contact'];

    $stmt = $conn->prepare("INSERT INTO users (username, password, role, contact) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $password, $role, $contact);

    if ($stmt->execute()) {
        header('Location: login.php');
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        form { width: 300px; margin: auto; padding: 20px; background: #fff; border-radius: 8px; }
        input, select { display: block; width: 100%; margin: 10px 0; padding: 10px; }
        button { padding: 10px 20px; background: #007BFF; color: white; border: none; }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Register</h2>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="contact" placeholder="Contact Number" required>
        <select name="role" required>
            <option value="donor">Donor</option>
            <option value="requester">Requester</option>
        </select>
        <button type="submit">Register</button>
    </form>
</body>
</html>
