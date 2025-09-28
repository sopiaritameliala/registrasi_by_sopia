<?php
session_start();
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: dashboard_admin.php");
    exit;
}

// Tampilkan pesan timeout jika ada parameter timeout di URL
if (isset($_GET['timeout'])) {
    echo '<p style="color:red;">Session Anda telah habis waktu. Silakan login kembali.</p>';
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<title>Login Admin</title>
</head>
<body>
<h2>Login Admin</h2>
<form action="login_process.php" method="post">
    <label for="username">Username:</label><br />
    <input type="text" name="username" id="username" required><br />
    <label for="password">Password:</label><br />
    <input type="password" name="password" id="password" required><br /><br />
    <input type="submit" value="Login">
</form>
</body>
</html>
