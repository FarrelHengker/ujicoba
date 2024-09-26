<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_inventory = $_POST['id_inventory'];

    // Menghapus data
    $stmt = $conn->prepare("DELETE FROM inventory WHERE id_inventory = ?");
    $stmt->bind_param("s", $id_inventory);

    if ($stmt->execute()) {
        echo "Data berhasil dihapus.";
    } else {
        echo "Error menghapus data: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

    // Redirect back to inventory page
    header("Location: inventory.php");
    exit();
}
?>
