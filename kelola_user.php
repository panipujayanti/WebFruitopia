<?php
require 'koneksi.php'; 

if (isset($_POST['addnewuser'])) {
    $email = $_POST['email'];
    $nama = $_POST['nama'];
    $password = $_POST['password'];

    $stmt = $koneksi->prepare("INSERT INTO users (email, nama, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $nama, $password);
    $stmt->execute();
    $stmt->close();
}

if (isset($_POST['updateuser'])) {
    $email = $_POST['email'];
    $nama = $_POST['nama'];
    $password = $_POST['password'];
    $id = $_POST['id'];

    $stmt = $koneksi->prepare("UPDATE users SET email=?, nama=?, password=? WHERE id=?");
    $stmt->bind_param("sssi", $email, $nama, $password, $id);
    $stmt->execute();
    $stmt->close();
}

if (isset($_POST['deleteuser'])) {
    $id = $_POST['id'];

    $stmt = $koneksi->prepare("DELETE FROM users WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

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
                <li><a href="kelola_user.php" class="active">Kelola User</a></li>
                <li><a href="kelola_produk.php">Kelola Produk</a></li>
                <li><a href="kelola_transaksi.php">Transaksi</a></li>
            </ul>
            <ul class="logout">
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="main-content">
            <div class="header">
                <h1>KELOLA USER</h1>
                <button type="button" class="tambah-barang-button" data-toggle="modal" data-target="#myModal">Tambah User</button>
            </div>
            <div class="content">
                <div id="user" class="section">
                    <h2>Kelola User</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Nama User</th>
                                <th>Password</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch users from database
                            $result = mysqli_query($koneksi, "SELECT * FROM users");
                            while ($data = mysqli_fetch_array($result)) {
                                $email = $data['email'];
                                $nama = $data['nama'];
                                $password = $data['password'];
                                $id = $data['id'];
                            ?>
                                <tr>
                                    <td><?php echo $email; ?></td>
                                    <td><?php echo $nama; ?></td>
                                    <td><?php echo $password; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$id;?>">Update</button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$id;?>">Delete</button>
                                    </td>
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

    <!-- Modals -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah User</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="email" name="email" placeholder="Email" class="form-control" required>
                        <br>
                        <input type="text" name="nama" placeholder="Nama User" class="form-control" required>
                        <br>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <br>
                        <button type="submit" class="btn btn-primary" name="addnewuser">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit and Delete Modals -->
    <?php
    // Fetch users again for modals
    $result = mysqli_query($koneksi, "SELECT * FROM users");
    while ($data = mysqli_fetch_array($result)) {
        $email = $data['email'];
        $nama = $data['nama'];
        $password = $data['password'];
        $id = $data['id'];
    ?>
        <!-- Edit Modal -->
        <div class="modal fade" id="edit<?=$id;?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Edit User</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <form method="post">
                        <div class="modal-body">
                            <input type="email" name="email" value="<?=$email?>" class="form-control" required>
                            <br>
                            <input type="text" name="nama" value="<?=$nama?>" class="form-control" required>
                            <br>
                            <input type="password" name="password" class="form-control" value="<?=$password?>" required>
                            <br>
                            <input type="hidden" name="id" value="<?=$id;?>">
                            <button type="submit" class="btn btn-primary" name="updateuser">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="delete<?=$id;?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Hapus User</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <form method="post">
                        <div class="modal-body">
                            Apakah Anda yakin ingin menghapus user <?=$nama;?>?
                            <input type="hidden" name="id" value="<?=$id;?>">
                            <br><br>
                            <button type="submit" class="btn btn-danger" name="deleteuser">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php
    }
    ?>

</body>
</html>
