<?php

use APP\Penjualan;

session_start();
if ( ! isset($_SESSION['username'])) {
    header('location:login.php');
}
$level = '';
if (isset($_SESSION['level'])) {
    $level = $_SESSION['level'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Penjualan</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="wrapper">
    <nav>
        <div class="navbar">
            <div class="pull-left">
                <a class="brand" href="#"><b>TOKO BUKU </b></a>
            </div>
            <div class="pull-right">
                <div class="navbar-menu">
                    <ul>
                        <li>
                            <form action="buku.php" method="get">
                                <input type="text" name="search"
                                       placeholder="Masukan judul penulis atau tahun buku ...">
                                <input type="submit" name="submit" class="btnsearch" value="">
                            </form>
                        </li>
                        <li><a href="proses/proses-logout.php">Log Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="sidebar">
        <a href="#" class="btnclose">X</a>
        <?php
        if ($level == 'admin') {
            ?>
            <div class="dropdown">
                <a href="index.php" class="active">Home</a>
            </div>
            <div class="dropdown">
                <a href="kasir.php" class="dropbtn">Kasir</a>
                <div class="dropdown-content">
                    <a href="kasir.php?action=input">Input</a>
                </div>
            </div>
            <div class="dropdown">
                <a href="buku.php" class="dropbtn">Buku</a>
                <div class="dropdown-content">
                    <a href="buku.php?action=input">Input</a>
                </div>
            </div>
            <div class="dropdown">
                <a href="distributor.php" class="dropbtn">Distributor</a>
                <div class="dropdown-content">
                    <a href="distributor.php?action=input">Input</a>
                </div>
            </div>
            <div class="dropdown">
                <a href="pasok.php" class="dropbtn">Pasok</a>
                <div class="dropdown-content">
                    <a href="pasok.php?action=input">Input</a>
                </div>
            </div>
            <div class="dropdown">
                <a href="penjualan.php" class="dropbtn">Penjualan</a>
                <div class="dropdown-content">
                    <a href="penjualan.php?action=input">Input</a>
                </div>
            </div>
            <div class="dropdown">
                <a href="laporan.php" class="dropbtn">Laporan</a>
            </div>
            <div class="dropdown">
                <a href="hotel.php" class="dropbtn">Form Master Hotel</a>
                <div class="dropdown-content">
                    <a href="hotel.php?action=input">Input</a>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="dropdown">
                <a href="index.php" class="active">Home</a>
            </div>
            <div class="dropdown">
                <a href="buku.php" class="dropbtn">Buku</a>
            </div>

            <div class="dropdown">
                <a href="penjualan.php" class="dropbtn">Penjualan</a>
                <div class="dropdown-content">
                    <a href="penjualan.php?action=input">Input</a>
                </div>
            </div>
            <div class="dropdown">
                <a href="laporan.php" class="dropbtn">Laporan</a>
            </div>
            <div class="dropdown">
                <a href="hotel.php" class="dropbtn">Form Master Hotel</a>
                <div class="dropdown-content">
                    <a href="hotel.php?action=input">Input</a>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="content-wrap" style="overflow-y: scroll;">
        <?php
        include 'proses/Penjualan.php';
        $Penjualan = new Penjualan();

        if (isset($_GET['action'])) {
            if ($_GET['action'] == 'input') {
                echo "
						<div class=\"content\" style=\"max-height: 200px;\">
						<h1>List Buku</h1>
						<hr>
						<form action=\"proses/proses-input.php\" method=\"post\">
						<table style=\"text-align: left;\">
						<thead>
						<tr>
						<th>Nama Buku</th>
						<th>Jumlah</th>
						<th>Aksi</th>
						</tr>
						</thead>
						<tbody>
						<tr>
						<td style=\"text-align: left;\">
						";
                // <select name=\"idBuku\" >";
                // echo $Penjualan->tampilBuk(0);
                echo "
						</select>
						<input placeholder=\"Masukan id Buku ...\" type=\"text\" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 0' name=\"idBuku\" >
						</td>
						<td style=\"text-align: left;\">
						<input type=\"text\" name=\"jumlah\" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 0' required>
						</td>
						<td style=\"text-align: left;\">
						<input type=\"hidden\" name=\"type\" value=\"5\">
						<input type=\"hidden\" name=\"idKasir\" value=\"$_SESSION[idKasir]\">
						<input type=\"submit\" name=\"submit\" value =\"Tambah\">
						</td>
						</tr>
						</tbody>
						</table>
						</form>
						</div>
						<div class=\"content content-lanjutan\">
						<h1>Penjualan</h1>
						<hr>
						<table>
						<thead>
						<tr>
						<th>No</th>
						<th>ID Penjualan</th>
						<th>No Transaksi</th>
						<th>Judul Buku</th>
						<th>Nama Kasir</th>
						<th>Jumlah</th>
						<th>Total</th>
						<th>Aksi</th>
						</tr>
						</thead>
						<tbody>";
                $Penjualan->idKasir = $_SESSION['idKasir'];
                echo $Penjualan->select();
                echo "</tbody>
						</table>
						</div>";
            }
        } else {
            echo "<div class=\"content\">
					<h1>Penjualan</h1>
					<div style=\"clear:both;\"></div>

					<hr>
					<table>
					<thead>
					<tr>
					<th>No</th>
					<th>Nama Kasir</th>
					<th>No Transaksi</th>
					<th>Tanggal Transaksi</th>
					<th>buku yang dijual</th>
					<th>Total Bayar</th>
					<th>Aksi</th>
					</tr>
					</thead>
					<tbody>";
            if ($level == "admin") {
                echo $Penjualan->tampilLaporan();
            } else {
                echo $Penjualan->tampilLaporanCari($_SESSION['idKasir'], 0, 0);
            }
            echo "</tbody>
					</table>
					</div>";
        }

        ?>
        <div style="clear:both;"></div>
    </div>
</body>
</html>

