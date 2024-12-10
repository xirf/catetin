<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

include 'koneksi.php';

if (isset($_POST['todo']) && isset($_POST['color']) && isset($_POST['id'])) {
    $todo = $_POST['todo'];
    $color = $_POST['color'];
    $id = $_POST['id'];
    $created_by = $_SESSION['login'];

    $stmt = $conn->prepare("UPDATE tb_todo SET todo = ?, color = ? WHERE id = ? AND created_by = ?");
    $stmt->bind_param("ssii", $todo, $color, $id, $created_by);

    if ($stmt->execute()) {
        echo "<script>alert('Catatan berhasil diubah!'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.location.href = 'index.php';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('Invalid request'); window.location.href = 'index.php';</script>";
}

$conn->close();
?>