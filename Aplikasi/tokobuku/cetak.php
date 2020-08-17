<?php
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
	body{
		border-style: solid;
		border-color: black;
	}
	@page{
		size:auto;
		margin:20px;
		border: 2px solid #000;
	}
	table.s{
		border-collapse: collapse;
		width: 100%;
		}thead{
			background: #000 !important;
			color: #fff !important;
		}
	</style>
</head>
<body>
	<center>
		<h1>TOKO BUKU </h1>
	</center>
	<?php
	if($_GET['action'] == 'cetaklaporan'){
		include 'proses/Penjualan.php';
		$Penjualan = new \APP\Penjualan();
		echo "
		<center>
		<table class=\"s\" border=\"1\">
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
		echo $Penjualan->cetaklaporan();
		echo	"</tbody>
		</table>
		</center>";
	}else if($_GET['action'] == 'cetaknota'){
		include 'proses/Penjualan.php';
		$Penjualan = new \APP\Penjualan();
		$Penjualan->data($_GET['noTransaksi']);
		$Penjualan->noTransaksi = $_GET['noTransaksi'];
		echo "
		<div style=\"text-align: left\">
		<table>
		<tr>
		<td>Nomor Transaksi</td>
		<td>:</td>
		<td>".$_GET['noTransaksi']."</td>
		</tr>
		<tr>
		<td>Tanggal Transaksi</td>
		<td>:</td>
		<td>".date('Y-m-d')."</td>
		</tr>
		<tr>
		<td>Kasir</td>
		<td>:</td>
		<td>".$Penjualan->namaKasir."</td>
		</tr>
		</table>
		</div>
		<center>
		<table class=\"s\" border=\"1\">
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

		echo $Penjualan->cetakNota();
		echo	"</tbody>
		</table>
		</center>";
	}
	?>
</body>
<script>
	window.print();
</script>
</html>
