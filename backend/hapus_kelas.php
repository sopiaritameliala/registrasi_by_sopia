<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $koneksi->prepare("DELETE FROM kelas WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: kelas.php");
exit;
