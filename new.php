<?php
include 'koneksi.php';

if (isset($_POST['todo']) && isset($_POST['color'])) {
    $todo = $_POST['todo'];
    $color = $_POST['color'];

    $stmt = $conn->prepare("INSERT INTO tb_todo (todo, color) VALUES (?, ?)");
    $stmt->bind_param("ss", $todo, $color);

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