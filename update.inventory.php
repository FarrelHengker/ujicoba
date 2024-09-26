<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_inventory = $_POST['id_inventory'];

    // Mengambil data saat ini
    $stmt = $conn->prepare("SELECT * FROM inventory WHERE id_inventory = ?");
    $stmt->bind_param("s", $id_inventory);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();

    if (!$item) {
        echo "Item tidak ditemukan.";
        exit();
    }

    // Memperbarui data item
    if (isset($_POST['update'])) {
        $nama_barang = $_POST['nama_barang'];
        $jenis_barang = $_POST['jenis_barang'];
        $harga_barang = $_POST['harga_barang'];
        $kuantitas_stok = $_POST['kuantitas_stok'];
        $lokasi = $_POST['lokasi'];
        $serial_number = $_POST['serial_number'];

        // Persiapkan pernyataan update
        $stmt = $conn->prepare("UPDATE inventory SET nama_barang = ?, jenis_barang = ?, harga_barang = ?, kuantitas_stok = ?, lokasi = ?, serial_number = ? WHERE id_inventory = ?");
        $stmt->bind_param("ssissss", $nama_barang, $jenis_barang, $harga_barang, $kuantitas_stok, $lokasi, $serial_number, $id_inventory);

        if ($stmt->execute()) {
            echo "Data berhasil diperbarui.";
        } else {
            echo "Error memperbarui data: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();

        // Redirect kembali ke halaman inventory
        header("Location: inventory.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Inventory</title>
</head>
<body>
    <h1>Update Inventory</h1>
    <form action="" method="post">
        <input type="hidden" name="id_inventory" value="<?php echo htmlspecialchars($item['id_inventory']); ?>">

        <label for="nama_barang">Nama Barang:</label>
        <input type="text" id="nama_barang" name="nama_barang" value="<?php echo htmlspecialchars($item['nama_barang']); ?>" required><br><br>

        <label for="jenis_barang">Jenis Barang:</label>
        <input type="text" id="jenis_barang" name="jenis_barang" value="<?php echo htmlspecialchars($item['jenis_barang']); ?>" required><br><br>

        <label for="harga_barang">Harga Barang:</label>
        <input type="number" id="harga_barang" name="harga_barang" value="<?php echo htmlspecialchars($item['harga_barang']); ?>" required><br><br>

        <label for="kuantitas_stok">Kuantitas Stok:</label>
        <input type="number" id="kuantitas_stok" name="kuantitas_stok" value="<?php echo htmlspecialchars($item['kuantitas_stok']); ?>" required><br><br>

        <label for="lokasi">Lokasi:</label>
        <input type="text" id="lokasi" name="lokasi" value="<?php echo htmlspecialchars($item['lokasi']); ?>" required><br><br>

        <label for="serial_number">Serial Number:</label>
        <input type="text" id="serial_number" name="serial_number" value="<?php echo htmlspecialchars($item['serial_number']); ?>" required><br><br>

        <input type="submit" name="update" value="Update Data">
    </form>
</body>
</html>
