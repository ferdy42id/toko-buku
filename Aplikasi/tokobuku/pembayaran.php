
<?php
session_start();
if(!isset($_SESSION['username'])) {
	header('location:login.php');
}
if(isset($_GET['action'])){
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<style>

	@page{
		size:auto;
		margin:20px;
		border: 2px solid #000;
	}
	table{
		border-collapse: collapse;
		width: 100%;
		}thead{
			background: #000 !important;
			color: #fff !important;
		}
	</style>
</head>
<body>
	<div style="text-align: left;">
		<p>Nomor Transaksi <?php echo $_GET['noTransaksi']; ?></p>
	</div>
	<?php
	if($_GET['action'] == 'pembayaran'){
		include 'proses/Penjualan.php';
		$Penjualan = new Penjualan;
		echo "
		<center>
		<table border=\"1\">
		<tbody>
		<tr>
		<th>No</th>
		<th>Judul Buku</th>
		<th>No ISBN</th>
		<th>Harga Jual</th>
		<th>Jumlah</th>
		<th>PPN</th>
		<th>Diskon</th>
		<th>Total Bayar</th>
		</tr>
		";
		$Penjualan->setIdKasir($_SESSION['idKasir']);
		$Penjualan->setNoTransaksi($_GET['noTransaksi']);
		$Penjualan->bayar();
		echo $Penjualan->prosesBayar();
		echo	"</tbody>
		</table>
		</center>";
	}
	else if($_GET['action'] == 'konfirmasipembayaran'){
		include 'proses/Penjualan.php';
		$Penjualan = new Penjualan;
		echo "
		<center>
		<table border=\"1\">
		<tbody>
		<tr>
		<th>No</th>
		<th>Judul Buku</th>
		<th>No ISBN</th>
		<th>Harga Jual</th>
		<th>Jumlah</th>
		<th>PPN</th>
		<th>Diskon</th>
		<th>Total Bayar</th>
		</tr>
		";
		$Penjualan->setIdKasir($_SESSION['idKasir']);
		$Penjualan->setNoTransaksi($_GET['noTransaksi']);
		$Penjualan->konfirmasiBayar();
		echo $Penjualan->prosescetak();
		echo	"</tbody>
		</table>
		</center>";
	}
	?>
</body>
<script>
	// window.print();
</script>
</html>
