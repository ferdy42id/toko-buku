<?php
session_start();
if (isset($_SESSION['level'])) {
    $level = $_SESSION['level'];
}
if (isset($_POST['type'])) {
    if ($_POST['type'] == 1) {
        if ($level == 'admin') {
            include "Distributor.php";
            $Distributor = new \APP\Distributor();
            $Distributor->namaDistributor = $_POST['namaDistributor'];
            $Distributor->alamat          = $_POST['alamat'];
            $Distributor->telepon         = $_POST['telp'];
            $Distributor->insert();
        } else {
            header('location:index.php');
        }

    } elseif ($_POST['type'] == 2) {
        if ($level == 'admin') {
            $kode = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
            $acak = substr(str_shuffle($kode), 0, 5);
            include "Kasir.php";
            $Kasir           = new \APP\Kasir();
            $Kasir->nama     = $_POST['namaKasir'];
            $Kasir->alamat   = $_POST['alamat'];
            $Kasir->telepon  = $_POST['telp'];
            $Kasir->username = ($_POST['username']);
            $Kasir->password = $acak;
            $Kasir->status   = $_POST['status'];
            $Kasir->level    = $_POST['level'];
            $Kasir->insert();
        } else {
            header('location:index.php');
        }
    } elseif ($_POST['type'] == 3) {
        if ($level == 'admin') {
            include "Buku.php";
            $Buku              = new \APP\Buku();
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
            $Buku->input();
        } else {
            header('location:index.php');
        }
    } elseif ($_POST['type'] == 4) {
        if ($level == 'admin') {
            include "Pasok.php";
            $Pasok = new \APP\Pasok();
            $Pasok->idDistributor = $_POST['idDistributor'];
            $Pasok->idBuku = $_POST['idBuku'];
            $Pasok->jumlah = $_POST['jumlah'];
            $Pasok->tglMasuk = $_POST['tglMasuk'];
            $Pasok->insert();
        } else {
            header('location:index.php');
        }

    } elseif ($_POST['type'] == 5) {
        include "Penjualan.php";
        $Penjualan = new \APP\Penjualan();
        $Penjualan->idKasir = $_POST['idKasir'];
        $Penjualan->jumlah = $_POST['jumlah'];
        $Penjualan->idBuku = $_POST['idBuku'];
        $Penjualan->insert();
    } elseif ($_POST['type'] == 6) {
        include "Buku.php";
        $Buku = new Buku;
        $Buku->search($_POST['search']);
    }
}
?>
