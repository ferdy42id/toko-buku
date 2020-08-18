<?php

use APP\Pasok;

session_start();
if ( ! isset($_SESSION['username'])) {
    header('location:login.php');
}
$level = '';
if (isset($_SESSION['level'])) {
    $level = $_SESSION['level'];
}
if ($level != 'admin') {
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pasok</title>
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
        <?php } ?>
    </div>
    <div class="content-wrap">
        <div class="content">
            <?php
            if (isset($_GET['action'])) {
                if ($_GET['action'] == 'input') {
                    include "proses/Pasok.php";
                    $Pasok = new Pasok();
                    echo "
							<h1>Input Pasok</h1>
							<hr>
							<form action=\"proses/proses-input.php\" method=\"post\">
							<div class=\"form-group\">
							<label>Distributor</label>
							<select name=\"idDistributor\">
							";
                    $Pasok->tampilDis(0);
                    echo "
							</select>
							</div>
							<div class=\"form-group\">
							<label>Buku</label>
							<select name=\"idBuku\">
							";
                    $Pasok->tampilBuk(0);
                    echo "
							</select>
							</div>
							<div class=\"form-group\">
							<label>Jumlah</label>
							<input type=\"text\" name=\"jumlah\" required>
							</div>
							<div class=\"form-group\">
							<label>Tanggal Masuk</label>
							<input type=\"text\" name=\"tglMasuk\" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 0' value=\"" . date("Y-m-d") . "\" required readonly>
							</div>
							<div class=\"form-group\">
							<input type=\"submit\" name=\"submit\">
							<input type=\"hidden\" name=\"type\" value=\"4\">
							</div>
							</form>";
                } elseif ($_GET['action'] == 'edit') {
                    if ( ! isset($_GET['id'])) {
                        header('location:pasok.php');
                    } else {
                        include "proses/Pasok.php";
                        $Pasok = new Pasok();
                        $Pasok->data($_GET['id']);
                        echo "
								<h1>Edit Pasok</h1>
								<hr>
								<form action=\"proses/proses-edit.php?id=" . $_GET['id'] . "\" method=\"post\">
								<div class=\"form-group\">
								<label>Distributor</label>
								<select name=\"idDistributor\">
								";
                        $Pasok->tampilDis($Pasok->idDistributor);
                        echo "
								</select>
								</div>
								<div class=\"form-group\">
								<label>Buku</label>
								<select name=\"idBuku\">
								";
                        $Pasok->tampilBuk($Pasok->idBuku);
                        echo "
								</select>
								</div>
								<div class=\"form-group\">
								<label>Jumlah</label>
								<input type=\"text\" name=\"jumlah\" value=\"" . $Pasok->jumlah . "\" required>
								</div>
								<div class=\"form-group\">
								<label>Tanggal Masuk</label>
								<input type=\"text\" name=\"tglMasuk\" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 0' value=\"" . $Pasok->tglMasuk . "\" required>
								</div>
								<div class=\"form-group\">
								<input type=\"submit\" name=\"submit\">
								<input type=\"hidden\" name=\"type\" value=\"4\">
								</div>
								</form>";
                    }
                } elseif ($_GET['action'] == 'tambahpasok') {
                    if ( ! isset($_GET['id'])) {
                        header('location:pasok.php');
                    } else {
                        include "proses/Pasok.php";
                        $Pasok = new Pasok();
                        $Pasok->data($_GET['id']);
                        echo "
								<h1>Tambah Pasok</h1>
								<hr>
								<form action=\"proses/proses-edit.php?id=" . $_GET['id'] . "\" method=\"post\">
								<div class=\"form-group\">
								<label>Distributor</label>
								<select name=\"idDistributor\">
								";
                        echo $Pasok->tampilDisSelected($Pasok->idDistributor);
                        echo "
								</select>
								</div>
								<div class=\"form-group\">
								<label>Buku</label>
								<select name=\"idBuku\">
								";
                        echo $Pasok->tampilBukSelected($Pasok->idBuku);
                        echo "
								</select>
								</div>
								<div class=\"form-group\">
								<label>Jumlah Sebelumnya</label>
								" . $Pasok->jumlah . "
								</div>
								<div class=\"form-group\">
								<label>Jumlah</label>
								<input type=\"text\" name=\"jumlah\" required>
								</div>
								<div class=\"form-group\">
								<label>Tanggal Masuk</label>
								<input type=\"text\" name=\"tglMasuk\" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 0' value=\"" . date('Y-m-d') . "\" required readonly>
								</div>
								<div class=\"form-group\">
								<input type=\"submit\" name=\"submit\">
								<input type=\"hidden\" name=\"type\" value=\"5\">
								</div>
								</form>";
                    }
                } elseif ($_GET['action'] == 'tambahstok') {
                    if ( ! isset($_GET['id'])) {
                        header('location:pasok.php');
                    } else {
                        include "proses/Pasok.php";
                        $Pasok = new Pasok();
                        $Pasok->data($_GET['id']);
                        echo "
								<h1>Tambah Stok</h1>
								<hr>
								<form action=\"proses/proses-edit.php?id=" . $_GET['id'] . "\" method=\"post\">
								<div class=\"form-group\">
								<label>Distributor</label>
								<select name=\"idDistributor\">
								";
                        echo $Pasok->tampilDisSelected($Pasok->idDistributor);
                        echo "
								</select>
								</div>
								<div class=\"form-group\">
								<label>Buku</label>
								<select name=\"idBuku\">
								";
                        $Pasok->tampilBukSelected($Pasok->idBuku);
                        echo "
								</select>
								</div>
								<div class=\"form-group\">
								<label>Pasok</label>
								" . $Pasok->jumlah . "
								<label>Stok</label>
								<input type=\"text\" name=\"jumlah\" required>
								</div>
								<div class=\"form-group\">
								<label>Tanggal Keluar</label>
								<input type=\"text\" name=\"tglKeluar\" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 0' value=\"" . date('Y-m-d') . "\" required readonly>
								</div>
								<div class=\"form-group\">
								<input type=\"submit\" name=\"submit\">
								<input type=\"hidden\" name=\"type\" value=\"6\">
								</div>
								</form>";
                    }
                }
            } else {
                include "proses/Pasok.php";
                $Pasok = new Pasok();
                echo "
						<h1>Pasok</h1>
						<hr>
						<table>
						<thead>
						<tr>
						<th>ID</th>
						<th>Distributor</th>
						<th>Buku</th>
						<th>Jumlah</th>
						<th>Tanggal Masuk</th>
						<th>Tanggal Keluar</th>
						<th>Action</th>
						</tr>
						</thead>
						<tbody>";
                echo $Pasok->select();
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
