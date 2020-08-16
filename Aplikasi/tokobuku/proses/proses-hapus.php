
<?php
session_start();
if(isset($_SESSION['level'])){
	$level=$_SESSION['level'];
}
if(isset($_GET['type'])){
	if($_GET['type'] == 1){
		if($level == 'admin'){
			include "Distributor.php";
			$Distributor = new Distributor;
			$Distributor->setId($_GET['id']);
			$Distributor->delete();
		}else{
			header('location:index.php');
		}
	}else if($_GET['type'] == 2){
		if($level == 'admin'){
			include "Kasir.php";
			$Kasir = new Kasir;
			$Kasir->setId($_GET['id']);
			$Kasir->delete();
		}else{
			header('location:index.php');
		}
	}else if($_GET['type'] == 3){
		if($level == 'admin'){
			include "Buku.php";
			$Buku = new Buku;
			$Buku->setId($_GET['id']);
			$Buku->delete();
		}else{
			header('location:index.php');
		}
	}else if($_GET['type'] == 4){
		if($level == 'admin'){
			include "Pasok.php";
			$Pasok = new Pasok;
			$Pasok->setIdPasok($_GET['id']);
			$Pasok->delete();
		}else{
			header('location:index.php');
		}
	}else if($_GET['type'] == 5){
		
	}
}
?>
