<?php
include 'Database.php';
class Kasir{
	public $id;
	public $username;
	public $password;
	public $nama;
	public $alamat;
	public $telepon;
	public $status;
	public $level;

	function connect(){
		$Database = new Database;
		return $Database->connect;
		
	}
	function setId($id){
		$this->id = $id;
	}
	function setUsername($username){
		$this->username = $username;
	}
	function setPassword($password){
		$this->password = $password;
	}
	function setNama($nama){
		$this->nama = $nama;
	}
	function setAlamat($alamat){
		$this->alamat = $alamat;
	}
	function setTelp($telepon){
		$this->telepon = $telepon;
	}
	function setStatus($status){
		$this->status = $status;
	}
	function setLevel($level){
		$this->level = $level;
	}

	function getId(){
		return $this->id;
	}
	function getUsername(){
		return $this->username;
	}
	function getPassword(){
		return $this->password;
	}
	function getNama(){
		return $this->nama;
	}
	function getAlamat(){
		return $this->alamat;
	}
	function getTelp(){
		return $this->telepon;
	}
	function getStatus(){
		return $this->status;
	}
	function getLevel(){
		return $this->level;
	}

	function login(){
		$mysql = $this->connect();
		$query=mysql_query("SELECT * FROM kasir WHERE username='".$this->getUsername()."'");
		$data=mysql_fetch_assoc($query);
		if(mysql_num_rows($query) == 0){
			echo "username tidakada";
		}else{

			if($this->getPassword() == $data['password']){
				if($data['status'] == 0){
					echo "<script>alert('Anda sedang tidak aktif'); window.location.replace('../index.php');</script>";
				}else{
					$_SESSION['username'] = $data['username'];
					$_SESSION['level'] = $data['level'];
					$_SESSION['idKasir'] = $data['idKasir'];
					echo "<script>alert('Login Berhasil'); window.location.replace('../index.php');</script>";
				}
			}else{
				echo "password salah";
			}
		}
		mysql_close($mysql);

	}

	function tampil(){
		$mysql=$this->connect();
		$query=mysql_query("select * from kasir");
		$i=0;
		while($data=mysql_fetch_assoc($query)){
			$i++;
			echo	"<tr>".
			"<td>".$i."</td>".
			"<td>".$data['nama']."</td>".
			"<td>".$data['alamat']."</td>".
			"<td>".$data['telepon']."</td>".
			"<td>".$data['level']."</td>".
			"<td>".$data['username']."</td>";
			if($data['status'] == 1){
				echo "<td><a href='proses/proses-edit.php?id=".$data['idKasir']."&type=7&status=0'><button>ON</button></a></td>";
			}else{
				echo "<td><a href='proses/proses-edit.php?id=".$data['idKasir']."&type=7&status=1'><button>OFF</button></a></td>";
			}
			echo "<td>
			<a href='kasir.php?id=".$data['idKasir']."&action=edit'><button>EDIT</button></a>
			<a href='proses/proses-hapus.php?id=".$data['idKasir']."&type=2'><button>HAPUS</button></a>
			</td>".
			"</tr>";
		}
		mysql_close($mysql);
	}
	function input(){
		$mysql=$this->connect();
		$query = mysql_query("insert into kasir(nama,alamat,telepon,status,level,username,password) values('".$this->getNama()."','".$this->getAlamat()."','".$this->getTelp()."','".$this->getStatus()."','".$this->getLevel()."','".$this->getUsername()."','".$this->getPassword()."')");
		if($query){
			echo "<script>alert('Simpan Password anda : ".$this->getPassword()."'); window.location.replace('../kasir.php');</script>";
		}
		mysql_close($mysql);

	}
	function ubahStatus(){
		$mysql=$this->connect();
		$query = mysql_query("update kasir set status=".$this->getStatus()." where idKasir=".$this->getId());
		if($query){
			echo "<script>window.location.replace('../kasir.php');</script>";
		}
		mysql_close($mysql);
	}
	function edit(){
		$mysql=$this->connect();
		$query = mysql_query("update kasir set nama='".$this->getNama()."',alamat='".$this->getAlamat()."',telepon='".$this->getTelp()."',status='".$this->getStatus()."',level='".$this->getLevel()."',username='".$this->getUsername()."',password='".$this->getPassword()."' where idKasir='".$this->getId()."'");
		if($query){
			echo "<script>alert('Data berhasil di update'); window.location.replace('../kasir.php');</script>";
		}
		mysql_close($mysql);
	}
	function data($id){
		$mysql=$this->connect();
		$query=mysql_query("select * from kasir where idKasir=".$id);
		$data=mysql_fetch_assoc($query);
		$this->setId($data['idKasir']);
		$this->setNama($data['nama']);
		$this->setAlamat($data['alamat']);
		$this->setTelp($data['telepon']);
		$this->setStatus($data['status']);
		$this->setLevel($data['level']);
		$this->setUsername($data['username']);
		$this->setPassword($data['password']);
		mysql_close($mysql);
	}
	function delete(){
		$mysql =$this->connect();
		$query = mysql_query("delete from kasir where idKasir='".$this->getId()."'");
		if($query){
			echo "<script>alert('Data berhasil di hapus'); window.location.replace('../kasir.php');</script>";
		}
		mysql_close($mysql);

	}


}
?>
