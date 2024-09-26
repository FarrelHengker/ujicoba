<?php
include 'koneksi.php';

// Tangani data formulir jika di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Ambil data dari formulir
    $id_inventory = $_POST['id_inventory'];
    $nama_barang = $_POST['nama_barang'];
    $jenis_barang = $_POST['jenis_barang'];
    $harga_barang = $_POST['harga_barang'];
    $kuantitas_stok = $_POST['kuantitas_stok'];
    $lokasi = $_POST['lokasi'];
    $serial_number = $_POST['serial_number'];

    // Siapkan dan eksekusi pernyataan SQL untuk menyimpan data
    $sql_insert = "INSERT INTO inventory (id_inventory, nama_barang, jenis_barang, harga_barang, kuantitas_stok, lokasi, serial_number) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_insert);

    if ($stmt) {
        $stmt->bind_param("sssdiss", $id_inventory, $nama_barang, $jenis_barang, $harga_barang, $kuantitas_stok, $lokasi, $serial_number);

        if ($stmt->execute()) {
            echo "<p>Data berhasil ditambahkan!</p>";
        } else {
            echo "<p>Terjadi kesalahan: " . $stmt->error . "</p>";
        }

        $stmt->close();
    } else {
        echo "<p>Terjadi kesalahan dalam persiapan pernyataan: " . $conn->error . "</p>";
    }
}

// Ambil data dari tabel inventory
$sql = "SELECT * FROM inventory";
$inventory = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="stylesheet" href="dash.css"> <!-- Sesuaikan dengan file CSS Anda -->
    <style>
        table { 
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Inventory</h2>
        <ul>
            <li><a href="inventory.php"><i class="fas fa-building"></i> Inventory</a></li>
            <li><a href="storage.php"><i class="fas fa-user-graduate"></i> Storage</a></li>
            <li><a href="vendor.php"><i class="fas fa-book"></i> Vendor</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
        <header>
            <h1>Inventory</h1>
        </header>

        <!-- Formulir Insert -->
        <section>
            <h2>Tambah Data Inventory</h2>
            <form action="" method="post">
                <label for="id_inventory">Id Inventory:</label>
                <input type="text" id="id_inventory" name="id_inventory" required><br><br>
                
                <label for="nama_barang">Nama Barang:</label>
                <input type="text" id="nama_barang" name="nama_barang" required><br><br>

                <label for="jenis_barang">Jenis Barang:</label>
                <input type="text" id="jenis_barang" name="jenis_barang" required><br><br>

                <label for="harga_barang">Harga Barang:</label>
                <input type="number" id="harga_barang" name="harga_barang" required><br><br>

                <label for="kuantitas_stok">Kuantitas Stok:</label>
                <input type="number" id="kuantitas_stok" name="kuantitas_stok" required><br><br>

                <label for="lokasi">Lokasi:</label>
                <input type="text" id="lokasi" name="lokasi" required><br><br>

                <label for="serial_number">Serial Number:</label>
                <input type="text" id="serial_number" name="serial_number" required><br><br>

                <input type="submit" name="submit" value="Tambah Data">
            </form>
        </section>

        <!-- Tabel Data Inventory -->
        <table>
            <thead>
                <tr>
                    <th>Id Inventory</th>
                    <th>Nama Barang</th>
                    <th>Jenis Barang</th>
                    <th>Harga Barang</th>
                    <th>Kuantitas Stok</th>
                    <th>Lokasi</th>
                    <th>Serial Number</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Memeriksa apakah ada data yang dikembalikan
                if ($inventory->num_rows > 0) {
                    while($row = $inventory->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["id_inventory"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["nama_barang"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["jenis_barang"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["harga_barang"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["kuantitas_stok"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["lokasi"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["serial_number"]) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Tidak ada data inventory ditemukan</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
