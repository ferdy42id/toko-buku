<?php

use APP\Buku;

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
    <title>Buku</title>
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
    <div class="content-wrap">
        <div class="content">
            <?php
            if (isset($_GET['action'])) {
                if ($_GET['action'] == 'input') {
                    echo "
							<h1>Input Buku</h1>
							<hr>
							<form action=\"proses/proses-input.php\" method=\"post\">
							<div class=\"form-group\">
							<label>Judul Buku</label>
							<input type=\"text\" name=\"judulBuku\" required>
							</div>
							<div class=\"form-group\">
							<label>Nomor ISBN</label>
							<input type=\"text\" name=\"noISBN\" required>
							</div>
							<div class=\"form-group\">
							<label>penulis</label>
							<input type=\"text\" name=\"penulis\" required>
							</div>
							<div class=\"form-group\">
							<label>penerbit</label>
							<input type=\"text\" name=\"penerbit\" required>
							</div>
							<div class=\"form-group\">
							<label>Tahun Terbit</label>
							<input type=\"text\" name=\"tahunTerbit\" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 0' required>
							</div>
							<div class=\"form-group\">
							<label>Stok</label>
							<input type=\"text\" name=\"stok\" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 0' required>
							</div>
							<div class=\"form-group\">
							<label>Harga Pokok</label>
							<input type=\"text\" name=\"hargaPokok\" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 0' required>
							</div>
							<div class=\"form-group\">
							<label>Harga Jual</label>
							<input type=\"text\" name=\"hargaJual\" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 0' required>
							</div>
							<div class=\"form-group\">
							<label>PPN</label>
							<input type=\"text\" name=\"PPN\" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 0' required>
							</div>
							<div class=\"form-group\">
							<label>Diskon</label>
							<input type=\"text\" name=\"diskon\" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 0' required>
							</div>
							<div class=\"form-group\">
							<input type=\"submit\" name=\"submit\">
							<input type=\"hidden\" name=\"type\" value=\"3\">
							</div>
							</form>";
                } elseif ($_GET['action'] == 'edit') {
                    if ( ! isset($_GET['id'])) {
                        header('location:buku.php');
                    } else {
                        include "proses/Buku.php";
                        $Buku = new Buku();
                        $Buku->data($_GET['id']);
                        echo "
								<h1>Edit Buku</h1>
								<hr>
								<form action=\"proses/proses-edit.php?id=" . $_GET['id'] . "\" method=\"post\">
								<div class=\"form-group\">
								<label>Judul Buku</label>
								<input type=\"text\" name=\"judulBuku\" value=\"" . $Buku->judul . "\" required>
								</div>
								<div class=\"form-group\">
								<label>Nomor ISBN</label>
								<input type=\"text\" name=\"noISBN\" value=\"" . $Buku->noISBN . "\" required>
								</div>
								<div class=\"form-group\">
								<label>penulis</label>
								<input type=\"text\" name=\"penulis\" value=\"" . $Buku->penulis . "\"required>
								</div>
								<div class=\"form-group\">
								<label>penerbit</label>
								<input type=\"text\" name=\"penerbit\" value=\"" . $Buku->penerbit . "\" required>
								</div>
								<div class=\"form-group\">
								<label>Tahun Terbit</label>
								<input type=\"text\" name=\"tahunTerbit\" value=\"" . $Buku->tahunTerbit . "\" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 0' required>
								</div>
								<div class=\"form-group\">
								<label>Stok</label>
								<input type=\"text\" name=\"stok\" value=\"" . $Buku->stok . "\" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 0' required>
								</div>
								<div class=\"form-group\">
								<label>Harga Pokok</label>
								<input type=\"text\" name=\"hargaPokok\" value=\"" . $Buku->hargaPokok . "\" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 0' required>
								</div>
								<div class=\"form-group\">
								<label>Harga Jual</label>
								<input type=\"text\" name=\"hargaJual\" value=\"" . $Buku->hargaJual . "\" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 0' required>
								</div>
								<div class=\"form-group\">
								<label>PPN</label>
								<input type=\"text\" name=\"PPN\" value=\"" . $Buku->PPN . "\" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 0' required>
								</div>
								<div class=\"form-group\">
								<label>Diskon</label>
								<input type=\"text\" name=\"diskon\" value=\"" . $Buku->diskon . "\" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 0' required>
								</div>
								<div class=\"form-group\">
								<input type=\"submit\" name=\"submit\">
								<input type=\"hidden\" name=\"type\" value=\"3\">
								</div>
								</form>";
                    }
                }
            } else {
                include "proses/Buku.php";
                $Buku = new Buku();
                echo "
						<h1>Buku</h1>
						<hr>
						<table>
						<thead>
						<tr>
						<th>ID</th>
						<th>Judul</th>
						<th>Penulis</th>
						<th>Tahun Terbit</th>
						<th>Harga Jual</th>
						<th>PPN</th>
						<th>Diskon</th>
						<th>Stok</th>";
                if ($level == 'admin') {
                    echo "<th>Action</th>";
                }
                echo "
						</tr>
						</thead>
						<tbody>";
                if (isset($_GET['search'])) {
                    echo $Buku->search($_GET['search']);
                } else {
                    echo $Buku->select();

                }
                echo "</tbody>
						</table>";
            }
            ?>
        </div>
    </div>
    <div style="clear:both;"></div>
</div>
</body>
</html>
