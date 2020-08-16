
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
			$Distributor->input();
		}else{
			header('location:index.php');
		}
		
	}else if($_POST['type'] == 2){
		if($level == 'admin'){
			$kode = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
			$acak=substr(str_shuffle($kode), 0,5);
			include "Kasir.php";
			$Kasir = new Kasir;
			$Kasir->setNama($_POST['namaKasir']);
			$Kasir->setAlamat($_POST['alamat']);
			$Kasir->setTelp($_POST['telp']);
			$Kasir->setUsername($_POST['username']);
			$Kasir->setPassword($acak);
			$Kasir->setStatus($_POST['status']);
			$Kasir->setLevel($_POST['level']);
			$Kasir->input();
		}else{
			header('location:index.php');
		}
	}else if($_POST['type'] == 3){
		if($level == 'admin'){
			include "Buku.php";
			$Buku = new Buku;
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
			$Buku->input();
		}else{
			header('location:index.php');
		}
	}else if($_POST['type'] == 4){
		if($level == 'admin'){
			include "Pasok.php";
			$Pasok = new Pasok;
			$Pasok->setIdDistributor($_POST['idDistributor']);
			$Pasok->setIdBuku($_POST['idBuku']);
			$Pasok->setJumlah($_POST['jumlah']);
			$Pasok->setTglMasuk($_POST['tglMasuk']);
			$Pasok->input();
		}else{
			header('location:index.php');
		}
		
	}else if($_POST['type'] == 5){
		include "Penjualan.php";
		$Penjualan = new Penjualan;
		$Penjualan->setIdKasir($_POST['idKasir']);
		$Penjualan->setJumlah($_POST['jumlah']);
		$Penjualan->setIdBuku($_POST['idBuku']);
		$Penjualan->tambahCart();
	}else if($_POST['type'] == 6){
		include "Buku.php";
		$Buku = new Buku;
		$Buku->search($_POST['search']);
	}
}
?>
