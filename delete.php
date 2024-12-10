<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM tb_todo WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Catatan berhasil dihapus!'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.location.href = 'index.php';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('Invalid request'); window.location.href = 'index.php';</script>";
}

$conn->close();
