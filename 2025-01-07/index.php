<?php
include_once 'Database.php';
include_once 'Barang.php';

// Koneksi database
$database = new Database();
$db = $database->getConnection();
$barang = new Barang($db);

// Menangani aksi tambah barang
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        // Menangani Create (Tambah barang)
        if ($_POST['action'] == 'create') {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                $barang->gambar = $target_file;
            }

            $barang->nama_barang = $_POST['nama_barang'];
            $barang->harga = $_POST['harga'];
            $barang->stok = $_POST['stok'];

            if ($barang->create()) {
                echo "Barang berhasil ditambahkan!";
            } else {
                echo "Gagal menambahkan barang.";
            }
        }

        // Menangani Update (Edit barang)
        if ($_POST['action'] == 'update') {
            if ($_FILES["gambar"]["name"]) {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
                if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                    $barang->gambar = $target_file;
                }
            }

            $barang->id = $_POST['id'];
            $barang->nama_barang = $_POST['nama_barang'];
            $barang->harga = $_POST['harga'];
            $barang->stok = $_POST['stok'];

            if ($barang->update()) {
                echo "Barang berhasil diperbarui!";
            } else {
                echo "Gagal memperbarui barang.";
            }
        }
    }
}

// Menampilkan daftar barang
$barang->read();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Tambah Barang</h2>
        <form action="index.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="create">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" name="nama_barang" id="nama_barang" required placeholder="Nama Barang">

            <label for="harga">Harga</label>
            <input type="number" name="harga" id="harga" required placeholder="Harga Barang">

            <label for="stok">Stok</label>
            <input type="number" name="stok" id="stok" required placeholder="Jumlah Stok">

            <label for="gambar">Gambar Barang</label>
            <input type="file" name="gambar" id="gambar" required>

            <button type="submit">Tambah Barang</button>
        </form>

        <h2>Daftar Barang</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Tampilkan semua barang
                $stmt = $barang->read();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nama_barang']}</td>
                        <td>{$row['harga']}</td>
                        <td>{$row['stok']}</td>
                        <td><img src='{$row['gambar']}' width='100'></td>
                        <td>
                            <a href='?action=edit&id={$row['id']}'>Edit</a> | 
                            <a href='?action=delete&id={$row['id']}'>Hapus</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>

        <?php
        // Menangani penghapusan barang
        if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
            $barang->id = $_GET['id'];
            if ($barang->delete()) {
                echo "<script>alert('Barang berhasil dihapus!');window.location='index.php';</script>";
            } else {
                echo "<script>alert('Gagal menghapus barang.');</script>";
            }
        }

        // Menangani edit barang: Menampilkan form edit hanya jika tombol Edit ditekan
        if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
            $barang->id = $_GET['id'];
            $barang->readOne();
        ?>
            <!-- Form Edit Barang -->
            <h2>Edit Barang</h2>
            <form action="index.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="id" value="<?php echo $barang->id; ?>">
                
                <label for="nama_barang">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" value="<?php echo $barang->nama_barang; ?>" required>

                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" value="<?php echo $barang->harga; ?>" required>

                <label for="stok">Stok</label>
                <input type="number" name="stok" id="stok" value="<?php echo $barang->stok; ?>" required>

                <label for="gambar">Gambar Barang</label>
                <input type="file" name="gambar" id="gambar">
                <img src="uploads<?php echo $barang->gambar; ?>" width="100">
                
                <button type="submit">Perbarui Barang</button>
            </form>
        <?php } ?>
    </div>
</body>
</html>
