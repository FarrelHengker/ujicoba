<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_storage = $_POST['id_storage'];

    // Menghapus data
    $stmt = $conn->prepare("DELETE FROM storage WHERE id_storage = ?");
    $stmt->bind_param("s", $id_storage);

    if ($stmt->execute()) {
        echo "Data berhasil dihapus.";
    } else {
        echo "Error menghapus data: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

    // Redirect back to storage page
    header("Location: storage.php");
    exit();
}
?>
