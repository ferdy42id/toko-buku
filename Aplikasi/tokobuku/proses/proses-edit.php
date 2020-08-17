<?php
session_start();
if (isset($_SESSION['level'])) {
    $level = $_SESSION['level'];
}
if (isset($_POST['type'])) {
    if ($_POST['type'] == 1) {
        if ($level == 'admin') {
            include "Distributor.php";
            $Distributor = new Distributor;
            $Distributor->setNamaDistributor($_POST['namaDistributor']);
            $Distributor->setAlamat($_POST['alamat']);
            $Distributor->setTelp($_POST['telp']);
            $Distributor->setId($_GET['id']);
            $Distributor->edit();
        } else {
            header('location:index.php');
        }
    } elseif ($_POST['type'] == 2) {
        if ($level == 'admin') {
            include "Kasir.php";
            $Kasir           = new \APP\Kasir();
            $Kasir->nama     = $_POST['namaKasir'];
            $Kasir->alamat   = $_POST['alamat'];
            $Kasir->telepon  = $_POST['telp'];
            $Kasir->username = $_POST['username'];
            $Kasir->password = $_POST['password'];
            $Kasir->status   = $_POST['status'];
            $Kasir->level    = $_POST['level'];
            $Kasir->id       = $_GET['id'];
            $Kasir->update();
        } else {
            header('location:index.php');
        }
    } elseif ($_POST['type'] == 3) {
        if ($level == 'admin') {
            include "Buku.php";
            $Buku              = new \APP\Buku();
            $Buku->id          = $_GET['id'];
            $Buku->judul       = $_POST['judulBuku'];
            $Buku->noISBN      = $_POST['noISBN'];
            $Buku->penulis     = $_POST['penulis'];
            $Buku->penerbit    = $_POST['penerbit'];
            $Buku->tahunTerbit = $_POST['tahunTerbit'];
            $Buku->stok        = $_POST['stok'];
            $Buku->hargaPokok  = $_POST['hargaPokok'];
            $Buku->hargaJual   = $_POST['hargaJual'];
            $Buku->PPN         = $_POST['PPN'];
            $Buku->diskon      = $_POST['diskon'];
            $Buku->update();
        } else {
            header('location:index.php');
        }
    } elseif ($_POST['type'] == 4) {
        if ($level == 'admin') {
            include "Pasok.php";
            $Pasok = new Pasok;
            $Pasok->setIdPasok($_GET['id']);
            $Pasok->setIdDistributor($_POST['idDistributor']);
            $Pasok->setIdBuku($_POST['idBuku']);
            $Pasok->setTglMasuk($_POST['tglMasuk']);
            $Pasok->setJumlah($_POST['jumlah']);
            $Pasok->edit();
        } else {
            header('location:index.php');
        }
    } elseif ($_POST['type'] == 5) {
        if ($level == 'admin') {
            include "Pasok.php";
            $Pasok = new Pasok;
            $Pasok->setIdPasok($_GET['id']);
            $Pasok->setIdDistributor($_POST['idDistributor']);
            $Pasok->setIdBuku($_POST['idBuku']);
            $Pasok->setTglMasuk($_POST['tglMasuk']);
            $Pasok->setJumlah($_POST['jumlah']);
            $Pasok->tambahPasok();
        } else {
            header('location:index.php');
        }
    }
} elseif (isset($_GET['type'])) {
    if ($_GET['type'] == 6) {
        if ($level == 'admin') {
            include "Pasok.php";
            $Pasok = new Pasok;
            $Pasok->setIdPasok($_GET['id']);
            $Pasok->setIdDistributor($_GET['idDistributor']);
            $Pasok->setIdBuku($_GET['idBuku']);
            // $Pasok->setTglKeluar($_POST['tglKeluar']);
            // $Pasok->setJumlah($_POST['jumlah']);
            // $Pasok->tambahStok();
            $Pasok->kirimStok();
        } else {
            header('location:index.php');
        }
    }
    if ($_GET['type'] == 7) {
        if ($level == 'admin') {
            include "Kasir.php";
            $Kasir         = new \APP\Kasir();
            $Kasir->id     = $_GET['id'];
            $Kasir->status = $_GET['status'];
            $Kasir->ubahStatus();
        } else {
            header('location:index.php');
        }
    }
}
