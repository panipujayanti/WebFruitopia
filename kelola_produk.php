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
                <li><a href="index.php">Home</a></li>
                <li><a href="kelola_user.php">Kelola User</a></li>
                <li><a href="kelola_produk.php" class="active">Kelola Produk</a></li>
                <li><a href="kelola_transaksi.php">Transaksi</a></li>
            </ul>
            <ul class="logout">
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="main-content">
            <div class="header">
                <h1>KELOLA PRODUK</h1>
                <button type="button" class="tambah-barang-button" data-toggle="modal" data-target="#myModal">Tambah Produk</button>
            </div>
            <div class="content">
                <div id="produk" class="section">
                    <h2>Kelola Produk</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $addtotable = mysqli_query($koneksi, "SELECT * FROM produk");
                            while ($data = mysqli_fetch_array($addtotable)) {
                                $nama_buah = $data['nama_buah'];
                                $harga = $data['harga'];
                                $id = $data['id'];

                                //cek gambar
                                $gambar = $data['img'];
                                if ($gambar == null) {
                                    $img = 'No Photo';
                                } else {
                                    $img = '<img src="' . $gambar . '" width="100px" height="100px">';
                                }
                            ?>
                                <tr>
                                    <td><?php echo $img; ?></td>
                                    <td><?php echo $nama_buah; ?></td>
                                    <td><?php echo $harga; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $id; ?>">Update</button>
                                        <input type="hidden" name="buahdihapus" value="<?= $id; ?>">
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $id; ?>">Delete</button>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="edit<?= $id; ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Produk</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <!-- Modal body -->
                                            <form method="post" action="update_produk.php" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <input type="text" name="nama_buah" value="<?= $nama_buah ?>" class="form-control" required>
                                                    <br>
                                                    <input type="text" name="harga" value="<?= $harga ?>" class="form-control" required>
                                                    <br>
                                                    <input type="text" name="img" value="<?= $gambar ?>" class="form-control" placeholder="Link Gambar">
                                                    <br>
                                                    <input type="hidden" name="id" value="<?= $id; ?>">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Delete Modal -->
                                <div class="modal fade" id="delete<?= $id; ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Delete Produk</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <!-- Modal body -->
                                            <form method="post" action="hapus_produk.php">
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus <?= $nama_buah; ?>?
                                                    <input type="hidden" name="id" value="<?= $id; ?>">
                                                    <br><br>
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            };
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Produk -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Produk</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;"></button>
                </div>
                <!-- Modal body -->
                <form method="post" action="tambah_produk.php">
                    <div class="modal-body">
                        <input type="text" name="nama_buah" placeholder="Nama Produk" class="form-control" required>
                        <br>
                        <input type="text" name="harga" placeholder="Harga" class="form-control" required>
                        <br>
                        <input type="text" name="img" placeholder="Link Gambar" class="form-control">
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
