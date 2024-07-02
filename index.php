<?php
require 'koneksi.php';
session_start();
if (!isset($_SESSION['log'])) {
    header('location:login.php');
    exit;
}

// Mengambil dan menghitung jumlah data dari tabel produk
$get1 = mysqli_query($koneksi, "SELECT * FROM produk");
if (!$get1) {
    die("Query error: " . mysqli_error($koneksi));
}
$count1 = mysqli_num_rows($get1); // Menghitung jumlah baris

// Mengambil dan menghitung jumlah data dari tabel transaksi
$get2 = mysqli_query($koneksi, "SELECT * FROM transaksi");
if (!$get2) {
    die("Query error: " . mysqli_error($koneksi));
}
$count2 = mysqli_num_rows($get2); // Menghitung jumlah baris

// Mengambil dan menghitung jumlah data dari tabel pengguna
$get3 = mysqli_query($koneksi, "SELECT * FROM users");
if (!$get3) {
    die("Query error: " . mysqli_error($koneksi));
}
$count3 = mysqli_num_rows($get3); // Menghitung jumlah baris

$data = [
    'produk' => $count1,
    'transaksi' => $count2,
    'users' => $count3
];
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">

</head>
<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <h2>FRESH FRUITOPIA</h2>
            <ul>
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="kelola_user.php">Kelola User</a></li>
                <li><a href="kelola_produk.php">Kelola Produk</a></li>
                <li><a href="kelola_transaksi.php">Transaksi</a></li>
            </ul>
            <ul class="logout">
                <li><a href="#" onclick="confirmLogout()">Logout</a></li>
            </ul>
        </div>
        <div class="main-content">
            <div class="header">
                <h1>DASHBOARD</h1>
            </div>
            <div class="content">
                <h2>Welcome to the Admin Dashboard</h2>
                <div class="cards-container">
                    <div class="card-primary">
                        <h3>Total Produk</h3>
                        <h4><?php echo $count1; ?></h4>
                        <a href="kelola_produk.php">View Details &gt;</a>
                    </div>
                    <div class="card-primary">
                        <h3>Total Transaksi</h3>
                        <h4><?php echo $count2; ?></h4>
                        <a href="kelola_transaksi.php">View Details &gt;</a>
                    </div>
                    <div class="card-primary">
                        <h3>Total Pengguna</h3>
                        <h4><?php echo $count3; ?></h4>
                        <a href="kelola_user.php">View Details &gt;</a>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="dataChart" ></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function confirmLogout() {
            if (confirm("Apakah Anda yakin ingin keluar?")) {
                window.location.href = 'logout.php';
            }
        }

        // Prepare the data for the chart
        const dataCounts = <?php echo json_encode($data); ?>;

        // Render the chart
        const ctx = document.getElementById('dataChart').getContext('2d');
        const dataChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Produk', 'Transaksi', 'Pengguna'],
                datasets: [{
                    label: 'Total Count',
                    data: [dataCounts.produk, dataCounts.transaksi, dataCounts.users],
                    backgroundColor: 'rgba(156, 179, 73, 0.6)',
                    borderColor: 'rgba(156, 179, 73, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                layout: {
                    padding: {
                        left: 80,
                        right: 80,
                        top: 20,
                        bottom: 80
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>