<?php
include 'koneksi.php';

if (isset($_POST['todo']) && isset($_POST['color']) && isset($_POST['id'])) {
    $todo = $_POST['todo'];
    $color = $_POST['color'];
    $id = $_POST['id'];

    $stmt = $conn->prepare("UPDATE tb_todo SET todo = ?, color = ? WHERE id = ?");
    $stmt->bind_param("ssi", $todo, $color, $id);

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