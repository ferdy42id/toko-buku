<?php
include "Database.php";
class Distributor{
	public $id;
	public $namaDistributor;
	public $alamat;
	public $telepon;

	function connect(){
		$Database = new Database;
		return $Database->connect;
	}
	function setId($id){
		$this->id = $id;
	}
	function setNamaDistributor($namaDistributor){
		$this->namaDistributor = $namaDistributor;
	}
	function setAlamat($alamat){
		$this->alamat = $alamat;
	}
	function setTelp($telepon){
		$this->telepon = $telepon;
	}
	function getId(){
		return $this->id;
	}
	function getNamaDistributor(){
		return $this->namaDistributor;
	}
	function getAlamat(){
		return $this->alamat;
	}
	function getTelp(){
		return $this->telepon;
	}

	function tampil(){
		$mysql=$this->connect();
		$query=mysql_query("select * from distributor");
		$i=0;
		while($data=mysql_fetch_assoc($query)){
			$i++;
			echo	"<tr>".
			"<td>".$i."</td>".
			"<td>".$data['namaDistributor']."</td>".
			"<td>".$data['alamat']."</td>".
			"<td>".$data['telepon']."</td>".
			"<td>
			<a href='distributor.php?id=".$data['idDistributor']."&action=edit'><button>EDIT</button></a>
			<a href='proses/proses-hapus.php?id=".$data['idDistributor']."&type=1' ><button>HAPUS</button></a>
			</td>".
			"</tr>";
		}
	}
	function input(){
		$mysql=$this->connect();
		$query = mysql_query("insert into distributor(namaDistributor,alamat,telepon) values('".$this->getNamaDistributor()."','".$this->getAlamat()."','".$this->getTelp()."')");
		if($query){
			echo "<script>alert('Data berhasil di tambahkan'); window.location.replace('../distributor.php');</script>";
		}else{
			echo "<script>alert('Data gagal di tambahkan'); window.location.replace('../distributor.php');</script>";
		}

	}
	function edit(){
		$mysql=$this->connect();
		$query = mysql_query("update distributor set namaDistributor='".$this->getNamaDistributor()."',alamat='".$this->getAlamat()."',telepon='".$this->getTelp()."' where idDistributor='".$this->getId()."'");
		if($query){
			echo "<script>alert('Data berhasil di update'); window.location.replace('../distributor.php');</script>";
		}else{
			echo "<script>alert('Data gagal di update'); window.location.replace('../distributor.php');</script>";
		}

	}
	function data($id){
		$mysql=$this->connect();
		$query=mysql_query("select * from distributor where idDistributor=".$id);
		$data=mysql_fetch_assoc($query);
		$this->setId($data['idDistributor']);
		$this->setNamaDistributor($data['namaDistributor']);
		$this->setAlamat($data['alamat']);
		$this->setTelp($data['telepon']);
	}
	function delete(){
		$mysql=$this->connect();
		$query = mysql_query("delete from distributor where idDistributor='".$this->getId()."'");
		if($query){
			echo "<script>alert('Data berhasil di hapus'); window.location.replace('../distributor.php');</script>";
		}else{
			echo "<script>alert('Data gagal di hapus'); window.location.replace('../distributor.php');</script>";
		}

	}
}
?>
