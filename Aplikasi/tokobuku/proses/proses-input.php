<?php

use APP\Buku;
use APP\Distributor;
use APP\Kasir;
use APP\Pasok;
use APP\Penjualan;
use APP\Hotel;

session_start();
$level = '';
if (isset($_SESSION['level'])) {
    $level = $_SESSION['level'];
}
if (isset($_POST['type'])) {
    if ($_POST['type'] == 1) {
        if ($level == 'admin') {
            include "Distributor.php";
            $Distributor                  = new Distributor();
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
            $Kasir           = new Kasir();
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
            $Buku              = new Buku();
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
            $Buku->insert();
        } else {
            header('location:index.php');
        }
    } elseif ($_POST['type'] == 4) {
        if ($level == 'admin') {
            include "Pasok.php";
            $Pasok                = new Pasok();
            $Pasok->idDistributor = $_POST['idDistributor'];
            $Pasok->idBuku        = $_POST['idBuku'];
            $Pasok->jumlah        = $_POST['jumlah'];
            $Pasok->tglMasuk      = $_POST['tglMasuk'];
            $Pasok->insert();
        } else {
            header('location:index.php');
        }

    } elseif ($_POST['type'] == 5) {
        include "Penjualan.php";
        $Penjualan          = new Penjualan();
        $Penjualan->idKasir = $_POST['idKasir'];
        $Penjualan->jumlah  = $_POST['jumlah'];
        $Penjualan->idBuku  = $_POST['idBuku'];
        $Penjualan->insert();
    } elseif ($_POST['type'] == 6) {
        include "Buku.php";
        $Buku = new Buku;
        $Buku->search($_POST['search']);
    } elseif ($_POST['type'] == 7) {
        if ($level == 'admin') {
            include "Hotel.php";
            $Hotel           = new Hotel();
            $Hotel->namaHotel     = $_POST['namaHotel'];
            $Hotel->namaManager     = $_POST['namaManager'];
            $Hotel->alamat   = $_POST['alamat'];
            $Hotel->telepon  = $_POST['telepon'];
            $Hotel->jumlahKamar = ($_POST['jumlahKamar']);
            $Hotel->tanggalOprasi    = $_POST['tanggalOprasi'];
            $Hotel->insert();
        } else {
            header('location:index.php');
        }
    }
}
?>
