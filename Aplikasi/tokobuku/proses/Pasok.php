
<?php
include "Database.php";
class Pasok{
	public $idPasok;
	public $idDistributor;
	public $idBuku;
	public $jumlah;
	public $tglMasuk;
	public $tglKeluar;

	function connect(){
		$Database = new Database;
		return $Database->connect;
	}
	function setIdPasok($idPasok){
		$this->idPasok = $idPasok;
	}
	function setIdDistributor($idDistributor){
		$this->idDistributor = $idDistributor;
	}
	function setIdBuku($idBuku){
		$this->idBuku = $idBuku;
	}
	function setJumlah($jumlah){
		$this->jumlah = $jumlah;
	}
	function setTglMasuk($tglMasuk){
		$this->tglMasuk = $tglMasuk;
	}
	function setTglKeluar($tglKeluar){
		$this->tglKeluar = $tglKeluar;
	}

	function getIdPasok(){
		return	$this->idPasok;
	}
	function getIdDistributor(){
		return	$this->idDistributor;
	}
	function getIdBuku(){
		return	$this->idBuku;
	}
	function getJumlah(){
		return	$this->jumlah;
	}
	function getTglMasuk(){
		return	$this->tglMasuk;
	}
	function getTglKeluar(){
		return	$this->tglKeluar;
	}
	function tampilBukSelected($id){
		$mysql=$this->connect();
		$query = mysql_query("select * from buku where idBuku=".$id);
		$data=mysql_fetch_assoc($query);
		echo "<option value=\"".$data['idBuku']."\">".$data['judulBuku']."</option>";
		mysql_close($mysql);

	}
	function tampilDisSelected($id){
		$mysql=$this->connect();
		$query = mysql_query("select * from distributor where idDistributor=".$id);
		$data=mysql_fetch_assoc($query);
		echo "<option value=\"".$data['idDistributor']."\">".$data['namaDistributor']."</option>";
		mysql_close($mysql);

	}
	function tampilDis($id){
		$mysql=$this->connect();
		$query=mysql_query("select * from distributor");
		if($id==0){
			while($data=mysql_fetch_assoc($query)){
				echo "<option value=\"".$data['idDistributor']."\">".$data['namaDistributor']."</option>";
			}
		}else{
			while($data=mysql_fetch_assoc($query)){
				echo "<option value=\"".$data['idDistributor']."\" ".($data['idDistributor'] == $id ? "selected" : "").">".$data['namaDistributor']."</option>";
			}
		}
		mysql_close($mysql);
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
	function tampil(){
		$mysql=$this->connect();
		$query=mysql_query("select * from pasok join buku using(idBuku) join distributor using(idDistributor)");
		$i=0;
		while($data=mysql_fetch_assoc($query)){
			$i++;
			echo	"<tr>".
			"<td>".$i."</td>".
			"<td>".$data['namaDistributor']."</td>".
			"<td>".$data['judulBuku']."</td>".
			"<td>".$data['jumlah']."</td>".
			"<td>".$data['tglMasuk']."</td>".
			"<td>".$data['tglKeluar']."</td>".
			"<td>".($data['tglKeluar'] == '0000-00-00' ? 
				"<a href='proses/proses-edit.php?id=".$data['idPasok']."&idDistributor=".$data['idDistributor']."&idBuku=".$data['idBuku']."&type=6'><button>KIRIM</button></a>
				
				<a href='pasok.php?id=".$data['idPasok']."&action=edit'><button>EDIT</button></a>
				<a href='proses/proses-hapus.php?id=".$data['idPasok']."&type=4' ><button>HAPUS</button></a>


				" : '')
			."
			".
						//<a href='pasok.php?id=".$data['idPasok']."&action=tambahpasok'><button>TAMBAH PASOK</button></a>
						//<a href='pasok.php?id=".$data['idPasok']."&action=tambahstok'><button>TAMBAH STOCK</button></a>
			"
			</td>".
			"</tr>";
		}
	}
	function input(){
		$mysql=$this->connect();
		$query = mysql_query("insert into pasok(idDistributor,idBuku,jumlah,tglMasuk,tglKeluar) values('".$this->getIdDistributor()."','".$this->getIdBuku()."','".$this->getJumlah()."','".$this->getTglMasuk()."','".$this->getTglKeluar()."')");
		if($query){
			echo "<script>alert('Data berhasil di tambahkan'); window.location.replace('../pasok.php');</script>";
		}
		mysql_close($mysql);

	}
	function tambahPasok(){
		$mysql=$this->connect();
		$query = mysql_query("update pasok set idDistributor='".$this->getIdDistributor()."',idBuku='".$this->getIdBuku()."',jumlah=jumlah+".$this->getJumlah().",tglMasuk='".$this->getTglMasuk()."',tglKeluar='".$this->getTglKeluar()."' where idPasok='".$this->getIdPasok()."'");
		if($query){
			echo "<script>alert('Pasok berhasil di tambah'); window.location.replace('../pasok.php');</script>";
		}
		mysql_close($mysql);

	}
	function kirimStok(){
		$mysql=$this->connect();
		$query = mysql_query("select * from pasok where idPasok=".$this->getIdPasok());
		$data=mysql_fetch_assoc($query);
		$jumlah=$data['jumlah'];
		$query = mysql_query("update buku set stok=stok+$jumlah where idBuku=".$this->getIdBuku());
		$query = mysql_query("update pasok set tglKeluar=DATE(NOW()) where idPasok=".$this->getIdPasok());
		if($query){
			echo "<script>alert('Stok berhasil di tambah'); window.location.replace('../pasok.php');</script>";
		}

	}
	function tambahStok(){
		$mysql=$this->connect();
		$query = mysql_query("select * from pasok where idPasok=".$this->getIdPasok());
		$data=mysql_fetch_assoc($query);
		if($data['jumlah']-$this->getJumlah() < 0){
			echo "<script>alert('Buku Tidak Mencukupi');window.location.replace('../pasok.php');</script>";
		}else{
			$query = mysql_query("update pasok join buku using(idBuku) set pasok.idDistributor='".$this->getIdDistributor()."',pasok.idBuku='".$this->getIdBuku()."',pasok.jumlah=jumlah-".$this->getJumlah().",buku.stok=buku.stok+".$this->getJumlah()." where idPasok='".$this->getIdPasok()."'");
			$query2=mysql_query("select * from pasok where idPasok=".$this->getIdPasok());
			$data=mysql_fetch_assoc($query2);
			if($data['jumlah'] == 0){
				$query=mysql_query("update pasok set tglKeluar='".date('Y-m-d')."' where idPasok=".$this->getIdPasok());
			}
			if($query){
				echo "<script>alert('Stok berhasil di tambah'); window.location.replace('../pasok.php');</script>";
			}
		}
		mysql_close($mysql);

	}
	function edit(){
		$mysql=$this->connect();
		$query = mysql_query("update pasok set idDistributor='".$this->getIdDistributor()."',idBuku='".$this->getIdBuku()."',jumlah='".$this->getJumlah()."',tglMasuk='".$this->getTglMasuk()."',tglKeluar='".$this->getTglKeluar()."' where idPasok='".$this->getIdPasok()."'");
		if($query){
			echo "<script>alert('Data berhasil di update'); window.location.replace('../pasok.php');</script>";
		}

	}
	function data($id){
		$mysql=$this->connect();
		$query=mysql_query("select * from pasok where idPasok=".$id);
		$data=mysql_fetch_assoc($query);
		$this->setIdPasok($id);
		$this->setIdDistributor($data['idDistributor']);
		$this->setIdBuku($data['idBuku']);
		$this->setJumlah($data['jumlah']);
		$this->setTglMasuk($data['tglMasuk']);
		$this->setTglKeluar($data['tglKeluar']);
	}
	function delete(){
		$mysql=$this->connect();
		$query = mysql_query("delete from pasok where idPasok='".$this->getIdPasok()."'");
		if($query){
			echo "<script>alert('Data berhasil di hapus'); window.location.replace('../pasok.php');</script>";
		}

	}
}
?>
