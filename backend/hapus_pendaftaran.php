<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $delete = mysqli_query($koneksi, "DELETE FROM pendaftaran WHERE id = $id");
    if ($delete) {
        header('Location: list_pendaftaran.php');
        exit;
    } else {
        echo "Gagal menghapus  " . mysqli_error($koneksi);
    }
} else {
    echo "ID tidak valid.";
}
?>
