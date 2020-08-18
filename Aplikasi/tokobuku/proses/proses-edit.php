<?php

use APP\Buku;
use APP\Distributor;
use APP\Kasir;
use APP\Pasok;
use APP\Hotel;

session_start();
$level = '';
if ( isset( $_SESSION['level'] ) ) {
	$level = $_SESSION['level'];
}
if ( isset( $_POST['type'] ) ) {
	if ( $_POST['type'] == 1 ) {
		if ( $level == 'admin' ) {
			include "Distributor.php";
			$Distributor                  = new Distributor();
			$Distributor->namaDistributor = $_POST['namaDistributor'];
			$Distributor->alamat          = $_POST['alamat'];
			$Distributor->telepon         = $_POST['telp'];
			$Distributor->id              = $_GET['id'];
			$Distributor->update();
		} else {
			header( 'location:index.php' );
		}
	} elseif ( $_POST['type'] == 2 ) {
		if ( $level == 'admin' ) {
			include "Kasir.php";
			$Kasir           = new Kasir();
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
			header( 'location:index.php' );
		}
	} elseif ( $_POST['type'] == 3 ) {
		if ( $level == 'admin' ) {
			include "Buku.php";
			$Buku              = new Buku();
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
			header( 'location:index.php' );
		}
	} elseif ( $_POST['type'] == 4 ) {
		if ( $level == 'admin' ) {
			include "Pasok.php";
			$Pasok                = new Pasok();
			$Pasok->idPasok       = $_GET['id'];
			$Pasok->idDistributor = $_POST['idDistributor'];
			$Pasok->idBuku        = $_POST['idBuku'];
			$Pasok->tglMasuk      = $_POST['tglMasuk'];
			$Pasok->jumlah        = $_POST['jumlah'];
			$Pasok->update();
		} else {
			header( 'location:index.php' );
		}
	} elseif ( $_POST['type'] == 5 ) {
		if ( $level == 'admin' ) {
			include "Pasok.php";
			$Pasok                = new Pasok();
			$Pasok->idPasok       = $_GET['id'];
			$Pasok->idDistributor = $_POST['idDistributor'];
			$Pasok->idBuku        = $_POST['idBuku'];
			$Pasok->tglMasuk      = $_POST['tglMasuk'];
			$Pasok->jumlah        = $_POST['jumlah'];
			$Pasok->tambahPasok();
		} else {
			header( 'location:index.php' );
		}
	} elseif ( $_POST['type'] == 8 ) {
		if ( $level == 'admin' ) {
			include "Hotel.php";
			$Hotel                = new Hotel();
			$Hotel->id            = $_GET['id'];
			$Hotel->namaHotel     = $_POST['namaHotel'];
			$Hotel->namaManager   = $_POST['namaManager'];
			$Hotel->alamat        = $_POST['alamat'];
			$Hotel->telepon       = $_POST['telepon'];
			$Hotel->jumlahKamar   = ( $_POST['jumlahKamar'] );
			$Hotel->tanggalOprasi = $_POST['tanggalOprasi'];
			$Hotel->update();
		} else {
			header( 'location:index.php' );
		}
	}
} elseif ( isset( $_GET['type'] ) ) {
	if ( $_GET['type'] == 6 ) {
		if ( $level == 'admin' ) {
			include "Pasok.php";
			$Pasok                = new Pasok();
			$Pasok->idPasok       = $_GET['id'];
			$Pasok->idDistributor = $_GET['idDistributor'];
			$Pasok->idBuku        = $_GET['idBuku'];
			$Pasok->kirimStok();
		} else {
			header( 'location:index.php' );
		}
	}
	if ( $_GET['type'] == 7 ) {
		if ( $level == 'admin' ) {
			include "Kasir.php";
			$Kasir         = new Kasir();
			$Kasir->id     = $_GET['id'];
			$Kasir->status = $_GET['status'];
			$Kasir->ubahStatus();
		} else {
			header( 'location:index.php' );
		}
	}
}
