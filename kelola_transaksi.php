<?php
require 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
</head>
<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <h2>FRESH FRUITOPIA</h2>
            <ul>
                <li><a href="index.php" >Home</a></li>
                <li><a href="kelola_user.php" >Kelola User</a></li>
                <li><a href="kelola_produk.php" >Kelola Produk</a></li>
                <li><a href="kelola_transaksi.php" class="active">Transaksi</a></li>
            </ul>
            <ul class="logout">
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="main-content">
            <div class="header">
                <h1> DATA TRANSAKSI </h1>
                <button type="button" class="tambah-barang-button" data-toggle="modal" data-target="#myModal">+ Data Transaksi</button>
            </div>
            <div class="content">
            <div id="transaksi" class="section">
            <h2>Kelola Transaksi</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Buah</th>
                        <th>Jumlah Barang</th>
                        <th>Harga Satuan</th>
                        <th>Total Harga</th>
                        <th>Nama Penerima</th>
                        <th>Alamat</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $addtotable = mysqli_query($koneksi, "SELECT * FROM transaksi");
                        while($data = mysqli_fetch_array($addtotable)){
                            $nama_buah = $data['nama_buah'];
                            $jumlah_barang = $data['jumlah_barang'];
                            $price_per_item = $data['price_per_item'];
                            $harga = $data['harga'];
                            $nama_penerima = $data['nama_penerima'];
                            $alamat = $data['alamat'];
                            $tanggal = $data['tanggal'];
                    ?>
                    <tr>
                        <td><?php echo $nama_buah; ?></td>
                        <td><?php echo $jumlah_barang; ?></td>
                        <td><?php echo $price_per_item; ?></td>
                        <td><?php echo $harga; ?></td>
                        <td><?php echo $nama_penerima; ?></td>
                        <td><?php echo $alamat; ?></td>
                        <td><?php echo $tanggal; ?></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
            </div>
        </div>
    </div>
</body>
<!-- Add New Barang Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <form method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <select name="nama_buah" class="form-control" required>
                        <?php
                        $ambilmuuatdatanya = mysqli_query($koneksi, "SELECT * FROM produk");
                        while($fetcharray = mysqli_fetch_array($ambilmuuatdatanya)){
                            $namabarangnya = $fetcharray['nama_buah'];
                            $idbarangnya = $fetcharray['id'];
                        ?>
                            <option value="<?=$namabarangnya;?>"><?=$namabarangnya;?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <br>
                    <input type="number" name="jumlah_barang" placeholder="Quantity" class="form-control" required>
                    <br>
                    <input type="number" name="price_per_item" placeholder="price_per_item" class="form-control" required>
                    <br>
                    <input type="number" name="harga" placeholder="Harga" class="form-control" required>
                    <br>
                    <input type="text" name="nama_penerima" class="form-control" placeholder="Penerima" required>
                    <br>
                    <input type="text" name="alamat" class="form-control" placeholder="Alamat" required>
                    <br>
                    <input type="date" name="tanggal" class="form-control" required>
                    <br>
                    <button type="submit" class="btn btn-primary" name="addnewkeluar">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>

<?php
if(isset($_POST['addnewkeluar'])){
    $nama_buah = $_POST['nama_buah'];
    $jumlah_barang = $_POST['jumlah_barang'];
    $price_per_item = $_POST['price_per_item'];
    $harga = $_POST['harga'];
    $nama_penerima = $_POST['nama_penerima'];
    $alamat = $_POST['alamat'];
    $tanggal = $_POST['tanggal'];

    // Masukkan data ke dalam tabel transaksi
    $addtotransaksi = mysqli_query($koneksi, "INSERT INTO transaksi (nama_buah, jumlah_barang, harga, price_per_item, nama_penerima, alamat, tanggal) VALUES ('$nama_buah', '$harga', '$jumlah_barang', '$nama_penerima', '$alamat', '$tanggal')");

    if($addtotransaksi){
        echo "<script>alert('Berhasil menambahkan data'); window.location='kelola_transaksi.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data'); window.location='kelola_transaksi.php';</script>";
    }
}
?>
