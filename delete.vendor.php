<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_vendor = $_POST['id_vendor'];

    $sql_delete = "DELETE FROM vendor WHERE id_vendor = ?";
    $stmt = $conn->prepare($sql_delete);

    if ($stmt) {
        $stmt->bind_param("s", $id_vendor);
        
        if ($stmt->execute()) {
            header("Location: vendor.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error dalam persiapan pernyataan: " . $conn->error;
    }
}

$conn->close();
?>
