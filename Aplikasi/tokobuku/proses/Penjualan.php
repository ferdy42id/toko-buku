<?php
include "Database.php";
class Penjualan{
	public $idPenjualan;
	public $noTransaksi;
	public $idBuku;
	public $idKasir;
	public $namaKasir;
	public $jumlah;
	public $totalBayar;
	public $tglTransaksi;
	public $status;

	function connect(){
		$Database = new Database;
		return $Database->connect;
	}
	function setIdPenjualan($idPenjualan){
		$this->idPenjualan = $idPenjualan;
	}
	function setNoTransaksi($noTransaksi){
		$this->noTransaksi = $noTransaksi;
	}
	function setIdBuku($idBuku){
		$this->idBuku = $idBuku;
	}
	function setIdKasir($idKasir){
		$this->idKasir = $idKasir;
	}
	function setNamaKasir($namaKasir){
		$this->namaKasir = $namaKasir;
	}
	function setJumlah($jumlah){
		$this->jumlah = $jumlah;
	}
	function setTotalBayar($totalBayar){
		$this->totalBayar = $totalBayar;
	}
	function setStatus($status){
		$this->status = $status;
	}
	function setTglTransaksi($tglTransaksi){
		$this->tglTransaksi = $tglTransaksi;
	}

	function getIdPenjualan(){
		return $this->idPenjualan;
	}
	function getNoTransaksi(){
		return $this->noTransaksi;
	}
	function getIdBuku(){
		return $this->idBuku;
	}
	function getIdKasir(){
		return $this->idKasir;
	}
	function getNamaKasir(){
		return $this->namaKasir;
	}
	function getJumlah(){
		return $this->jumlah;
	}
	function getTotalBayar(){
		return $this->totalBayar;
	}
	function getStatus(){
		return $this->status;
	}
	function getTglTransaksi(){
		return $this->tglTransaksi;
	}

	function tampilKasir(){
		$mysql=$this->connect();
		$query=mysql_query("select * from kasir");
		while($data=mysql_fetch_assoc($query)){
			echo "<option value=\"".$data['idKasir']."\">".$data['nama']."</option>";
		}
		
		
	}
	function tampilBuk($id){
		$mysql=$this->connect();
		$query=mysql_query("select * from buku");
		if($id==0){
			while($data=mysql_fetch_assoc($query)){
				echo "<option value=\"".$data['idBuku']."\">".$data['judulBuku']."</option>";
			}
		}
		while($data=mysql_fetch_assoc($query)){
			echo "<option value=\"".$data['idBuku']."\" ".($data['idBuku'] == $id ? "selected" : "").">".$data['judulBuku']."</option>";
		}
		mysql_close($mysql);
	}
	function bayar(){
		$mysql=$this->connect();
		$query = mysql_query("update penjualan set noTransaksi='".$this->getNoTransaksi()."'  where status=0 and idKasir='".$this->getIdKasir()."'");
	}
	function konfirmasiBayar(){
		$mysql=$this->connect();
		$query = mysql_query("update penjualan set status=1, tglTransaksi=NOW() where noTransaksi='".$this->getNoTransaksi()."' and status=0 and idKasir='".$this->getIdKasir()."'");
	}
	function prosesBayar(){
		$mysql=$this->connect();
		$query = mysql_query("select *, penjualan.status as statusPenjualan from penjualan join buku using(idBuku) join kasir using(idKasir) where noTransaksi='".$this->getNoTransaksi()."' and penjualan.status=0");
		$totalBayar=0;
		$i=0;
		while ($data=mysql_fetch_assoc($query)) {
			$i++;
			echo "<tr>".
			"<td>".$i."</td>".
			"<td>".$data['judulBuku']."</td>".
			"<td>".$data['noISBN']."</td>".
			"<td>Rp.".number_format($data['hargaJual'],0,0,'.').",-</td>".
			"<td>".$data['jumlah']." buah</td>".
			"<td>".$data['PPN']."%</td>".
			"<td>".$data['diskon']."%</td>".
			"<td>Rp.".number_format($data['totalBayar'],0,0,'.').",-</td>".
			"</tr>";
			$totalBayar+=$data['totalBayar'];
		}
		echo "<tr>".
		"<th colspan=\"7\"></th>".
		"<th>Rp.".number_format($totalBayar,0,0,'.').",-</th>".
		"</tr>".
		"<th colspan=\"8\"><a href=\"pembayaran.php?action=konfirmasipembayaran&noTransaksi=".$this->getNoTransaksi()."\"><button>Bayar</button></a></th>".
		"</tr>";
		mysql_close($mysql);
	}
	function prosesCetak(){
		$mysql=$this->connect();
		$query = mysql_query("select *, penjualan.status as statusPenjualan from penjualan join buku using(idBuku) join kasir using(idKasir) where noTransaksi='".$this->getNoTransaksi()."' and penjualan.status=1");
		$totalBayar=0;
		$i=0;
		while ($data=mysql_fetch_assoc($query)) {
			$i++;
			echo "<tr>".
			"<td>".$i."</td>".
			"<td>".$data['judulBuku']."</td>".
			"<td>".$data['noISBN']."</td>".
			"<td>Rp.".number_format($data['hargaJual'],0,0,'.').",-</td>".
			"<td>".$data['jumlah']." buah</td>".
			"<td>".$data['PPN']."%</td>".
			"<td>".$data['diskon']."%</td>".
			"<td>Rp.".number_format($data['totalBayar'],0,0,'.').",-</td>".
			"</tr>";
			$totalBayar+=$data['totalBayar'];
		}
		echo "<tr>".
		"<th colspan=\"7\"></th>".
		"<th>Rp.".number_format($totalBayar,0,0,'.').",-</th>".
		"</tr>".
		"<th colspan=\"8\"><a href=\"cetak.php?action=cetaknota&noTransaksi=".$this->getNoTransaksi()."\"><button>Cetak</button></a></th>".
		"</tr>";
		mysql_close($mysql);
	}
	function cetakNota(){
		$mysql=$this->connect();
		$query = mysql_query("select *, penjualan.status as statusPenjualan from penjualan join buku using(idBuku) join kasir using(idKasir) where noTransaksi='".$this->getNoTransaksi()."' and penjualan.status=1");
		$totalBayar=0;
		$i=0;
		while ($data=mysql_fetch_assoc($query)) {
			$i++;
			echo "<tr>".
			"<td>".$i."</td>".
			"<td>".$data['judulBuku']."</td>".
			"<td>".$data['noISBN']."</td>".
			"<td>Rp.".number_format($data['hargaJual'],0,0,'.').",-</td>".
			"<td>".$data['jumlah']." buah</td>".
			"<td>".$data['PPN']."%</td>".
			"<td>".$data['diskon']."%</td>".
			"<td>Rp.".number_format($data['totalBayar'],0,0,'.').",-</td>".
			"</tr>";
			$totalBayar+=$data['totalBayar'];
		}
		echo "<tr>".
		"<th colspan=\"7\"></th>".
		"<th>Rp.".number_format($totalBayar,0,0,'.').",-</th>".
		"</tr>";
		mysql_close($mysql);	
	}
	function tambahCart(){
		$mysql=$this->connect();
		$query = mysql_query("select * from buku where idBuku='".$this->getIdBuku()."'");
		$data=mysql_fetch_assoc($query);
		$jumlahAwal=$data['stok'];
		$query = mysql_query("select * from penjualan where idBuku='".$this->getIdBuku()."'");
		$data=mysql_fetch_assoc($query);
		$jumlahPesan=$data['jumlah'];
		if(($jumlahAwal-$jumlahPesan)-$this->getJumlah() <= 0){
			echo "<script>alert('Stok tidak cukup'); window.location='../penjualan.php';</script>";
		}else{
			$query = mysql_query("select * from penjualan where idBuku='".$this->getIdBuku()."' and status=0 and idKasir='".$this->getIdKasir()."'");
			if(mysql_num_rows($query) > 0){
				$query = mysql_query("update penjualan join buku using(idBuku) set jumlah=jumlah+". $this->getJumlah().", 
					totalBayar=(
						(hargaJual*(jumlah+".$this->getJumlah()."))+
						(hargaJual*(jumlah+".$this->getJumlah().")*(PPN/100))-
						(hargaJual*(jumlah+".$this->getJumlah().")*(diskon/100))
					) where idBuku='".$this->getIdBuku()."' and status=0 and idKasir='".$this->getIdKasir()."'");	
			}else{
				$query = mysql_query("insert into penjualan(idBuku,idKasir,jumlah,totalBayar,status) values('".$this->getIdBuku()."','".$this->getIdKasir()."','".$this->getJumlah()."',
					(select (hargaJual*".$this->getJumlah().")+
					((hargaJual*".$this->getJumlah().")*(PPN/100))-
					((hargaJual*".$this->getJumlah().")*(diskon/100)) from buku where idBuku='".$this->getIdBuku()."'),0)");
			}
			if($query){
				echo "<script>alert('Pemesanan berhasil dimasukan'); window.location.replace('../penjualan.php?action=input');</script>";
			}
		}

	}
	function tampil(){
		$mysql=$this->connect();
		$query = mysql_query("select *, penjualan.status as statusPenjualan from penjualan join buku using(idBuku) join kasir using(idKasir) where penjualan.status=0 and idKasir=".$this->getIdKasir());
		$totalBayar=0;
		$i=0;
		$kode = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
		$acak=substr(str_shuffle($kode), 0,4).date('Y-m');
		while($data=mysql_fetch_assoc($query)){
			$i++;
			echo	"<tr>".
			"<td>".$i."</td>".
			"<td>".$data['idPenjualan']."</td>".
			"<td>".$data['noTransaksi']."</td>".
			"<td>".$data['judulBuku']."</td>".
			"<td>".$data['nama']."</td>".
			"<td>".$data['jumlah']."</td>".
			"<td>Rp.".number_format($data['totalBayar'],2,",",".")."</td>".
			"<td>
			<a href='proses/proses-hapus.php?id=".$data['idPenjualan']."&type=5' ><button>HAPUS</button></a>
			</td>".
			"</tr>";
			$totalBayar+=$data['totalBayar'];
		}
		echo	"<tr style=\"background-color: #555; color:#fff;\">".
		"<th colspan=\"7\" style=\"text-align:right;\">Total Harga	:</th>".
		"<th>Rp.".number_format($totalBayar,2,",",".")."</th>".
		"</tr>".
		"<tr style=\"background-color: #555; color:#fff;\">".
		"<th colspan=\"7\" style=\"text-align:right;\"></th>".
		"<th>
		<a href=\"pembayaran.php?action=pembayaran&noTransaksi=$acak\" target=\"_blank\"><button>Pembayaran</button></a>
		</th>".
		"</tr>";
		mysql_close($mysql);
	}
	function tampilLaporanCari($idKasir,$awal,$tujuan){
		$mysql=$this->connect();
		if($idKasir == 0 && $awal == 0 && $tujuan == 0){
			$query=mysql_query("select *,SUM(jumlah),SUM(totalBayar) from penjualan join kasir using(idKasir) where noTransaksi!='' and penjualan.status=1 group by noTransaksi");	
		}else if($awal == 0 && $tujuan == 0){
			$query=mysql_query("select *,SUM(jumlah),SUM(totalBayar) from penjualan join kasir using(idKasir) where noTransaksi!='' and penjualan.status=1 and idKasir=".$idKasir." group by noTransaksi");
		}else{
			$query=mysql_query("select *,SUM(jumlah),SUM(totalBayar) from penjualan join kasir using(idKasir) where noTransaksi!='' and penjualan.status=1 and idKasir=".$idKasir." and (tglTransaksi between '$awal' and '$tujuan') group by noTransaksi");
		}
		$i=0;
		while ($data=mysql_fetch_assoc($query)) {
			$i++;
			echo	"<tr>".
			"<td>".$i."</td>".
			"<td>".$data['nama']."</td>".
			"<td>".$data['noTransaksi']."</td>".
			"<td>".$data['tglTransaksi']."</td>".
			"<td>".$data['SUM(jumlah)']."</td>".
			"<td>Rp.".number_format($data['SUM(totalBayar)'],2,",",".")."</td>".
			"<td>
			<a href='cetak.php?action=cetaknota&noTransaksi=".$data['noTransaksi']."' target=\"_blank\" ><button>Detail</button></a>
			</td>".
			"</tr>";
		}
	}
function tampilLaporanCariPrint($idKasir,$awal,$tujuan){
		$mysql=$this->connect();
		if($idKasir == 0 && $awal == 0 && $tujuan == 0){
			$query=mysql_query("select *,SUM(jumlah),SUM(totalBayar) from penjualan join kasir using(idKasir) where noTransaksi!='' and penjualan.status=1 group by noTransaksi");	
		}else if($awal == 0 && $tujuan == 0){
			$query=mysql_query("select *,SUM(jumlah),SUM(totalBayar) from penjualan join kasir using(idKasir) where noTransaksi!='' and penjualan.status=1 and idKasir=".$idKasir." group by noTransaksi");
		}else{
			$query=mysql_query("select *,SUM(jumlah),SUM(totalBayar) from penjualan join kasir using(idKasir) where noTransaksi!='' and penjualan.status=1 and idKasir=".$idKasir." and (tglTransaksi between '$awal' and '$tujuan') group by noTransaksi");
		}
		$i=0;
		while ($data=mysql_fetch_assoc($query)) {
			$i++;
			echo	"<tr>".
			"<td>".$i."</td>".
			"<td>".$data['nama']."</td>".
			"<td>".$data['noTransaksi']."</td>".
			"<td>".$data['tglTransaksi']."</td>".
			"<td>".$data['SUM(jumlah)']."</td>".
			"<td>Rp.".number_format($data['SUM(totalBayar)'],2,",",".")."</td>".
			"</tr>";
		}
	}

	function tampilLaporan(){
		$mysql=$this->connect();

		$query=mysql_query("select *,SUM(jumlah),SUM(totalBayar) from penjualan join kasir using(idKasir) where noTransaksi!='' and penjualan.status=1 group by noTransaksi");
		$i=0;
		while ($data=mysql_fetch_assoc($query)) {
			$i++;
			echo	"<tr>".
			"<td>".$i."</td>".
			"<td>".$data['nama']."</td>".
			"<td>".$data['noTransaksi']."</td>".
			"<td>".$data['tglTransaksi']."</td>".
			"<td>".$data['SUM(jumlah)']."</td>".
			"<td>Rp.".number_format($data['SUM(totalBayar)'],2,",",".")."</td>".
			"<td>
			<a href='cetak.php?action=cetaknota&noTransaksi=".$data['noTransaksi']."'  target=\"_blank\"><button>Detail</button></a>
			</td>".
			"</tr>";
		}
	}
	function edit(){
		$mysql=$this->connect();
		$query = mysql_query("update penjualan join buku using(idBuku) set jumlah=".$this->getJumlah().", totalBayar=((buku.hargaJual*(jumlah+".$this->getJumlah()."))+((buku.hargaJual*(jumlah+".$this->getJumlah()."))*(buku.PPN/100))-((buku.hargaJual*(jumlah+".$this->getJumlah()."))*(diskon/100))) where idPenjualan='".$this->getIdPenjualan()."'");
		if($query){
			echo "<script>alert('Data berhasil di update'); window.location.replace('../distributor.php');</script>";
		}

	}
	function delete(){
		$mysql=$this->connect();
		$query = mysql_query("delete from penjualan where idPenjualan='".$this->getIdPenjualan()."'");
		if($query){
			echo "<script>alert('Data berhasil di hapus'); window.location.replace('../penjualan.php');</script>";
		}

	}
	function dataNoTransaksi(){
		$mysql=$this->connect();
		$query=mysql_query("select *, penjualan.status as statusBayar from penjualan join kasir using(idKasir) where noTransaksi='".$this->getNoTransaksi()."'");
		$data=mysql_fetch_assoc($query);
		$this->setIdPenjualan($data['idPenjualan']);
		$this->setIdBuku($data['idBuku']);
		$this->setIdKasir($data['idKasir']);
		$this->setJumlah($data['jumlah']);
		$this->setTotalBayar($data['totalBayar']);
		$this->setTglTransaksi($data['tglTransaksi']);
		$this->setStatus($data['statusBayar']);
		$this->setNamaKasir($data['nama']);
		mysql_close($mysql);
	}
}
?>
