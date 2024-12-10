<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

include 'koneksi.php';

if (isset($_POST['todo']) && isset($_POST['color'])) {
    $todo = $_POST['todo'];
    $color = $_POST['color'];
    $created_by = $_SESSION['login'];

    $stmt = $conn->prepare("INSERT INTO tb_todo (todo, color, created_by) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $todo, $color, $created_by);

    if ($stmt->execute()) {
        echo "<script>alert('Catatan berhasil ditambahkan!'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.location.href = 'index.php';</script>";
    }
    $stmt->close();
} else {
    echo "<script>alert('Invalid request'); window.location.href = 'index.php';</script>";
}

$conn->close();
?>