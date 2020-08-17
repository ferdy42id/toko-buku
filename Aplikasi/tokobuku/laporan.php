
<?php
session_start();
if(!isset($_SESSION['username'])) {
	header('location:login.php');
}if(isset($_SESSION['level'])){
	$level=$_SESSION['level'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Penjualan</title>
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
									<input type="text" name="search" placeholder="Masukan judul penulis atau tahun buku ...">
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
			if($level=='admin'){
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
			}else{
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
			<div class="content-wrap" style="overflow-y: scroll;">
				<?php
				include 'proses/Penjualan.php';
				$Penjualan = new \APP\Penjualan();
				echo "
				<div class=\"content\" style=\"max-height: 400px;\">
				<h1>Laporan</h1>
				<hr>
				<form action=\"laporan.php\" method=\"post\">
				<table style=\"text-align: left;\">
				<thead>
				<tr>
				<th colspan=\"3\" align=\"center\">PENCARIAN</th>
				</tr>
				</thead>
				<tbody>";
				if($level == "staff"){
					echo "<input type=\"hidden\" name=\"idKasir\" value=\"".$_SESSION['idKasir']."\" >";
				}else{
					echo "<tr>
					<td colspan=\"3\">
					<select style=\"width:100%;\" name=\"idKasir\" >";
					echo $Penjualan->tampilKasir();
					echo "
					</select>
					</td>
					</tr>";
				}
				echo "
				<tr>
				<td>
				<input style=\"width:100%;\" type=\"date\" name=\"awal\" value=\"".date('Y-m-d')."\">
				</td>
				<td>-</td>
				<td>
				<input style=\"width:100%;\" type=\"date\" name=\"tujuan\" value=\"".date('Y-m-d')."\">
				</td>
				</tr>
				<tr>
				<td colspan=\"3\">
				<input class=\"btnsubmit\" type=\"submit\" value=\"Cari\">
				</td>
				</tr>
				</tbody>
				</table>
				</form>
				</div>
				<div class=\"content content-lanjutan\">
				<h1>Penjualan</h1>
				<div style=\"clear:both;\"></div>

				<hr>
				<table>
				<thead>
				<tr>
				<th>No</th>
				<th>Nama Kasir</th>
				<th>No Transaksi</th>
				<th>Tanggal Transaksi</th>
				<th>buku yang dijual</th>
				<th>Total Bayar</th>
				<th>Aksi</th>
				</tr>
				</thead>
				<tbody>";
				if($level == "admin"){
					if(isset($_POST['idKasir'])){
						echo $Penjualan->tampilLaporanCari($_POST['idKasir'],$_POST['awal'],$_POST['tujuan']);
					}else{
						echo $Penjualan->tampilLaporan();
					}
				}else{
					if(isset($_POST['idKasir'])){
						echo $Penjualan->tampilLaporanCari($_POST['idKasir'],$_POST['awal'],$_POST['tujuan']);
					}else{
						echo $Penjualan->tampilLaporanCari($_SESSION['idKasir'],0,0);
					}
				}
				echo	"</tbody>
				</table>
				</div>";

				?>
				<div style="clear:both;"></div>
			</div>
		</body>
		</html>

