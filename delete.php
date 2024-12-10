<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $created_by = $_SESSION['login'];

    $stmt = $conn->prepare("DELETE FROM tb_todo WHERE id = ? AND created_by = ?");
    $stmt->bind_param("ii", $id, $created_by);

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
?>