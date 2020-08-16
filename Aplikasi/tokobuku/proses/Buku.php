<?php
include 'Database.php';
class Buku{
	public $id;
	public $judul;
	public $noISBN;
	public $penulis;
	public $penerbit;
	public $tahunTerbit;
	public $stok;
	public $hargaPokok;
	public $hargaJual;
	public $PPN;
	public $diskon;	

	function connect(){
		$Database = new Database;
		return $Database->connect;
	}

	function setId($id){
		$this->id = $id;
	}
	function setJudul($judul){
		$this->judul = $judul;
	}
	function setNoISBN($noISBN){
		$this->noISBN = $noISBN;
	}
	function setPenulis($penulis){
		$this->penulis = $penulis;
	}
	function setPenerbit($penerbit){
		$this->penerbit = $penerbit;
	}
	function setTahunTerbit($tahunTerbit){
		$this->tahunTerbit = $tahunTerbit;
	}
	function setStok($stok){
		$this->stok = $stok;
	}
	function setHargaPokok($hargaPokok){
		$this->hargaPokok = $hargaPokok;
	}
	function setHargaJual($hargaJual){
		$this->hargaJual = $hargaJual;
	}
	function setPPN($PPN){
		$this->PPN = $PPN;
	}
	function setDiskon($diskon){
		$this->diskon = $diskon;
	}

	function getId(){
		return	$this->id;
	}
	function getJudul(){
		return	$this->judul;
	}
	function getNoISBN(){
		return	$this->noISBN;
	}
	function getPenulis(){
		return	$this->penulis;
	}
	function getPenerbit(){
		return	$this->penerbit;
	}
	function getTahunTerbit(){
		return	$this->tahunTerbit;
	}
	function getStok(){
		return	$this->stok;
	}
	function getHargaPokok(){
		return	$this->hargaPokok;
	}
	function getHargaJual(){
		return	$this->hargaJual;
	}
	function getPPN(){
		return	$this->PPN;
	}
	function getDiskon(){
		return	$this->diskon;
	}
	function search($keywords){
		$mysql=$this->connect();
		// if($keywords == null){
		// 	$keywords = " ";
		// }
		$query=mysql_query("select * from buku where judulBuku like '%".mysql_real_escape_string($keywords)."%' or penulis like '%".mysql_real_escape_string($keywords)."%' or tahunTerbit like '%".mysql_real_escape_string($keywords)."%'");
		$i=0;
		while($data=mysql_fetch_assoc($query)){
			$i++;
			echo	"<tr>".
			"<td>".$i."</td>".
			"<td>".$data['judulBuku']."</td>".
			"<td>".$data['penulis']."</td>".
			"<td>".$data['tahunTerbit']."</td>".
			"<td>Rp.".number_format($data['hargaJual'],2,',','.')."</td>".
			"<td>".$data['PPN']."%</td>".
			"<td>".$data['diskon']."%</td>".	
			"<td>".$data['stok']."</td>";
			if($_SESSION['level'] == 'admin'){
				echo "<td>
				<form action=\"proses/proses-input.php\" method=\"post\">
										<input style=\"display:block; width:100%;\" type=\"text\" name=\"jumlah\" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 0' required>
										<input type=\"hidden\" name=\"type\" value=\"5\">
										<input type=\"hidden\" name=\"idBuku\" value=\"".$data['idBuku']."\">
						<input type=\"hidden\" name=\"idKasir\" value=\"$_SESSION[idKasir]\">
						<input style=\"display:block; width:100%;\" type=\"submit\" name=\"submit\" value =\"Tambah Keranjang\">
				</form>
				<a href='buku.php?id=".$data['idBuku']."&action=edit'><button>EDIT</button></a>
				<a href='proses/proses-hapus.php?id=".$data['idBuku']."&type=3' ><button>HAPUS</button></a>
				</td>";
			}
			"</tr>";
		}
		mysql_close($mysql);
	}
	function tampil(){
		$mysql=$this->connect();
		$query=mysql_query("select * from buku");
		$i=0;
		while($data=mysql_fetch_assoc($query)){
			$i++;
			echo	"<tr>".
			"<td>".$i."</td>".
			"<td>".$data['judulBuku']."</td>".
			"<td>".$data['penulis']."</td>".
			"<td>".$data['tahunTerbit']."</td>".
			"<td>Rp.".number_format($data['hargaJual'],2,',','.')."</td>".
			"<td>".$data['PPN']."%</td>".
			"<td>".$data['diskon']."%</td>".	
			"<td>".$data['stok']."</td>";
			if($_SESSION['level'] == 'admin'){
				echo "<td>
				<a href='buku.php?id=".$data['idBuku']."&action=edit'><button>EDIT</button></a>
				<a href='proses/proses-hapus.php?id=".$data['idBuku']."&type=3' ><button>HAPUS</button></a>
				</td>";
			}
			"</tr>";
		}
		mysql_close($mysql);
	}
	function input(){
		$mysql=$this->connect();
		$query = mysql_query("insert into buku(judulBuku,noISBN,penulis,penerbit,tahunTerbit,stok,hargaPokok,hargaJual,PPN,diskon) values('".$this->getJudul()."','".$this->getNoISBN()."','".$this->getPenulis()."','".$this->getPenerbit()."','".$this->getTahunTerbit()."','".$this->getStok()."','".$this->getHargaPokok()."','".$this->getHargaJual()."','".$this->getPPN()."','".$this->getDiskon()."')");
		if($query){
			echo "<script>alert('Data berhasil di tambahkan'); window.location.replace('../buku.php');</script>";
		}else{
			echo "<script>alert('Data gagal di tambahkan'); window.location.replace('../buku.php');</script>";
		}

	}
	function edit(){
		$mysql=$this->connect();
		$query = mysql_query("update buku set judulBuku='".$this->getJudul()."',noISBN='".$this->getNoISBN()."',penulis='".$this->getPenulis()."',penerbit='".$this->getPenerbit()."',tahunTerbit='".$this->getTahunTerbit()."',stok='".$this->getStok()."',hargaPokok='".$this->getHargaPokok()."',hargaJual='".$this->getHargaJual()."',PPN='".$this->getPPN()."',diskon='".$this->getDiskon()."' where idBuku='".$this->getId()."'");
		if($query){
			echo "<script>alert('Data berhasil di update'); window.location.replace('../buku.php');</script>";
		}else{
			echo "<script>alert('Data gagal di update'); window.location.replace('../buku.php');</script>";
		}

	}
	function data($id){
		$mysql=$this->connect();
		$query=mysql_query("select * from buku where idBuku=".$id);
		$data=mysql_fetch_assoc($query);
		$this->setId($id);
		$this->setJudul($data['judulBuku']);
		$this->setNoISBN($data['noISBN']);
		$this->setPenulis($data['penulis']);
		$this->setPenerbit($data['penerbit']);
		$this->setTahunTerbit($data['tahunTerbit']);
		$this->setStok($data['stok']);
		$this->setHargaPokok($data['hargaPokok']);
		$this->setHargaJual($data['hargaJual']);
		$this->setPPN($data['PPN']);
		$this->setDiskon($data['diskon']);
	}
	function delete(){
		$mysql=$this->connect();
		$query = mysql_query("delete from buku where idBuku='".$this->getId()."'");
		if($query){
			echo "<script>alert('Data berhasil di hapus'); window.location.replace('../buku.php');</script>";
		}else{
			echo "<script>alert('Data gagal di hapus'); window.location.replace('../buku.php');</script>";
		}

	}


}
?>
