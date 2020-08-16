<?php
session_start();
if(isset($_SESSION['level'])){
	$level=$_SESSION['level'];
}
if(isset($_POST['type'])){
	if($_POST['type'] == 1){
		if($level == 'admin'){
			include "Distributor.php";
			$Distributor = new Distributor;
			$Distributor->setNamaDistributor($_POST['namaDistributor']);
			$Distributor->setAlamat($_POST['alamat']);
			$Distributor->setTelp($_POST['telp']);
			$Distributor->setId($_GET['id']);
			$Distributor->edit();
		}else{
			header('location:index.php');
		}
	}else if($_POST['type'] == 2){
		if($level == 'admin'){
			include "Kasir.php";
			$Kasir = new Kasir;
			$Kasir->setNama($_POST['namaKasir']);
			$Kasir->setAlamat($_POST['alamat']);
			$Kasir->setTelp($_POST['telp']);
			$Kasir->setUsername($_POST['username']);
			$Kasir->setPassword($_POST['password']);
			$Kasir->setStatus($_POST['status']);
			$Kasir->setLevel($_POST['level']);
			$Kasir->setId($_GET['id']);
			$Kasir->edit();
		}else{
			header('location:index.php');
		}
	}else if($_POST['type'] == 3){
		if($level == 'admin'){
			include "Buku.php";
			$Buku = new Buku;
			$Buku->setId($_GET['id']);
			$Buku->setJudul($_POST['judulBuku']);
			$Buku->setNoISBN($_POST['noISBN']);
			$Buku->setPenulis($_POST['penulis']);
			$Buku->setPenerbit($_POST['penerbit']);
			$Buku->setTahunTerbit($_POST['tahunTerbit']);
			$Buku->setStok($_POST['stok']);
			$Buku->setHargaPokok($_POST['hargaPokok']);
			$Buku->setHargaJual($_POST['hargaJual']);
			$Buku->setPPN($_POST['PPN']);
			$Buku->setDiskon($_POST['diskon']);
			$Buku->edit();
		}else{
			header('location:index.php');
		}
	}else if($_POST['type'] == 4){
		if($level == 'admin'){
			include "Pasok.php";
			$Pasok = new Pasok;
			$Pasok->setIdPasok($_GET['id']);
			$Pasok->setIdDistributor($_POST['idDistributor']);
			$Pasok->setIdBuku($_POST['idBuku']);
			$Pasok->setTglMasuk($_POST['tglMasuk']);
			$Pasok->setJumlah($_POST['jumlah']);
			$Pasok->edit();
		}else{
			header('location:index.php');
		}
	}else if($_POST['type'] == 5){
		if($level == 'admin'){
			include "Pasok.php";
			$Pasok = new Pasok;
			$Pasok->setIdPasok($_GET['id']);
			$Pasok->setIdDistributor($_POST['idDistributor']);
			$Pasok->setIdBuku($_POST['idBuku']);
			$Pasok->setTglMasuk($_POST['tglMasuk']);
			$Pasok->setJumlah($_POST['jumlah']);
			$Pasok->tambahPasok();
		}else{
			header('location:index.php');
		}
	}
}else if(isset($_GET['type'])){
	if($_GET['type'] == 6){
		if($level == 'admin'){
			include "Pasok.php";
			$Pasok = new Pasok;
			$Pasok->setIdPasok($_GET['id']);
			$Pasok->setIdDistributor($_GET['idDistributor']);
			$Pasok->setIdBuku($_GET['idBuku']);
			// $Pasok->setTglKeluar($_POST['tglKeluar']);
			// $Pasok->setJumlah($_POST['jumlah']);
			// $Pasok->tambahStok();
			$Pasok->kirimStok();
			
		}else{
			header('location:index.php');
		}
	}
	if($_GET['type'] == 7){
		if($level == 'admin'){
			include "Kasir.php";
			$Kasir = new Kasir;
			$Kasir->setId($_GET['id']);
			$Kasir->setStatus($_GET['status']);
			$Kasir->ubahStatus();
			
		}else{
			header('location:index.php');
		}
	}
}
?>
