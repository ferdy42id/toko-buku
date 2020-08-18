<?php

use APP\Hotel;

session_start();
if ( ! isset( $_SESSION['username'] ) ) {
	header( 'location:login.php' );
}
$level = '';
if ( isset( $_SESSION['level'] ) ) {
	$level = $_SESSION['level'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Hotel</title>
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
                                <input type="text" name="search"
                                       placeholder="Masukan judul penulis atau tahun buku ...">
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
		if ( $level == 'admin' ) {
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
            <div class="dropdown">
                <a href="hotel.php" class="dropbtn">Form Master Hotel</a>
                <div class="dropdown-content">
                    <a href="hotel.php?action=input">Input</a>
                </div>
            </div>
			<?php
		} else {
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
            <div class="dropdown">
                <a href="hotel.php" class="dropbtn">Form Master Hotel</a>
                <div class="dropdown-content">
                    <a href="hotel.php?action=input">Input</a>
                </div>
            </div>
		<?php } ?>
    </div>
    <div class="content-wrap">
        <div class="content">
			<?php
			if ( isset( $_GET['action'] ) ) {
				if ( $_GET['action'] == 'input' ) {
					echo "
							<h1>Form Master Hotel</h1>
							<hr>
							<form action=\"proses/proses-input.php\" method=\"post\">
							<div class=\"form-group\">
							<label>Nama Hotel</label>
							<input type=\"text\" name=\"namaHotel\" required>
							</div>
							<div class=\"form-group\">
							<label>Nama Manager</label>
							<input type=\"text\" name=\"namaManager\" required>
							</div>
							<div class=\"form-group\">
							<label>Alamat</label>
							<input type=\"text\" name=\"alamat\" required>
							</div>
							<div class=\"form-group\">
							<label>Nomor Telepon</label>
							<input type=\"text\" name=\"telepon\" required>
							</div>
							<div class=\"form-group\">
							<label>Jumlah Kamar</label>
							<input type=\"text\" name=\"jumlahKamar\" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 0' required>
							</div>
							<div class=\"form-group\">
							<label>Tanggal Mulai Beroprasi</label>
							<input type=\"text\" name=\"tanggalOprasi\" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 0' required>
							</div>
							<div class=\"form-group\">
							<input type=\"submit\" name=\"submit\">
							<input type=\"hidden\" name=\"type\" value=\"7\">
							</div>
							</form>";
				} elseif ( $_GET['action'] == 'edit' ) {
					if ( ! isset( $_GET['id'] ) ) {
						header( 'location:hotel.php' );
					} else {
						include "proses/Hotel.php";
						$Hotel = new Hotel();
						$Hotel->data( $_GET['id'] );
						echo '
								<h1>Edit Buku</h1>
								<hr>
								<form action="proses/proses-edit.php?id=' . $_GET['id'] . '" method="post">
								<div class="form-group">
								<label>Nama Hotel</label>
								<input type="text" name="namaHotel" value="' . $Hotel->namaHotel . '" required>
								</div>
								<div class="form-group">
								<label>Nama Manager</label>
								<input type="text" name="namaManager" value="' . $Hotel->namaManager . '" required>
								</div>
								<div class="form-group">
								<label>alamat</label>
								<input type="text" name="alamat" value="' . $Hotel->alamat . '"required>
								</div>
								<div class="form-group">
								<label>Nomor Telepon</label>
								<input type="text" name="telepon" value="' . $Hotel->telepon . '" required>
								</div>
								<div class="form-group">
								<label>Jumlah Kamar</label>
								<input type="text" name="jumlahKamar" value="' . $Hotel->jumlahKamar . "\" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 0' required>
								</div>
								<div class=\"form-group\">
								<label>Tanggal Mulai Beroprasi</label>
								<input type=\"text\" name=\"tanggalOprasi\" value=\"" . $Hotel->tanggalOprasi . "\" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 0' required>
								</div>
								<div class=\"form-group\">
								<input type=\"submit\" name=\"submit\">
								<input type=\"hidden\" name=\"type\" value=\"8\">
								</div>
								</form>";
					}
				}
			} else {
				include "proses/Hotel.php";
				$Hotel = new Hotel();
				echo '
						<h1>Hotel</h1>
						<hr>
						<table>
						<thead>
						<tr>
						<th>Nomor</th>
						<th>Nama Hotel</th>
						<th>Nama Manager</th>
						<th>Alamat</th>
						<th>Telepon</th>
						<th>Jumlah Kamar</th>
						<th>Tanggal Beroprasi</th>';
				if ( $level == 'admin' ) {
					echo '<th>Action</th>';
				}
				echo "
						</tr>
						</thead>
						<tbody>";
				echo $Hotel->select();
				echo "</tbody>
						</table>";
			}
			?>
        </div>
    </div>
    <div style="clear:both;"></div>
</div>
</body>
</html>
