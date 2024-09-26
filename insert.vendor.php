<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $id_vendor = isset($_POST['id_vendor']) ? htmlspecialchars(trim($_POST['id_vendor'])) : '';
    $nama = isset($_POST['nama']) ? htmlspecialchars(trim($_POST['nama'])) : '';
    $kontak = isset($_POST['kontak']) ? htmlspecialchars(trim($_POST['kontak'])) : '';
    $nama_barang = isset($_POST['nama_barang']) ? htmlspecialchars(trim($_POST['nama_barang'])) : '';

    if ($conn) {
        // Prepare an SQL statement
        $stmt = $conn->prepare("INSERT INTO vendor (id_vendor, nama, kontak, nama_barang) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $id_vendor, $nama, $kontak, $nama_barang);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect back to vendor page after successful insertion
            header("Location: vendor.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "Koneksi ke database gagal.";
    }
} else {
    echo "Invalid request method.";
}
?>
