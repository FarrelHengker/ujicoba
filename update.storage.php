<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_storage = $_POST['id_storage'];

    // Mengambil data saat ini
    $stmt = $conn->prepare("SELECT * FROM storage WHERE id_storage = ?");
    $stmt->bind_param("s", $id_storage);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();

    if (!$item) {
        echo "Item tidak ditemukan.";
        exit();
    }

    // Update item data
    if (isset($_POST['update'])) {
        $nama_gudang = $_POST['nama_gudang'];
        $lokasi = $_POST['lokasi'];

        // Persiapkan pernyataan update
        $stmt = $conn->prepare("UPDATE storage SET nama_gudang = ?, lokasi = ? WHERE id_storage = ?");
        $stmt->bind_param("ssi", $nama_gudang, $lokasi, $id_storage);

        if ($stmt->execute()) {
            echo "Data berhasil diperbarui.";
        } else {
            echo "Error memperbarui data: " . $conn->error;
        }

        $stmt->close();
        $conn->close();

        // Redirect back to storage page
        header("Location: storage.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Storage</title>
</head>
<body>
    <h1>Update Storage</h1>
    <form action="" method="post">
        <input type="hidden" name="id_storage" value="<?php echo htmlspecialchars($item['id_storage']); ?>">

        <label for="nama_gudang">Nama Gudang:</label>
        <input type="text" id="nama_gudang" name="nama_gudang" value="<?php echo htmlspecialchars($item['nama_gudang']); ?>" required><br><br>

        <label for="lokasi">Lokasi:</label>
        <input type="text" id="lokasi" name="lokasi" value="<?php echo htmlspecialchars($item['lokasi']); ?>" required><br><br>

        <input type="submit" name="update" value="Update Data">
    </form>
</body>
</html>
