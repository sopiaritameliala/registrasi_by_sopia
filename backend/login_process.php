<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Contoh query validasi ke tabel admin (anda perlu buat tabel admin di DB)
    $sql = "SELECT * FROM admin WHERE username = ? LIMIT 1";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $admin = $result->fetch_assoc();

        // Asumsikan password sudah di-hash di DB, verifikasi disini
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $admin['username'];
            header("Location: dashboard_admin.php");
            exit;
        } else {
            echo "Password salah. <a href='login.php'>Coba lagi</a>";
            exit;
        }
    } else {
        echo "Username tidak ditemukan. <a href='login.php'>Coba lagi</a>";
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}
