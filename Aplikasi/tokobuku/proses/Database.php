<?php
class Database{
	public $connect;
	function __construct(){
		$this->connect=mysql_connect("localhost","root","") and mysql_select_db("dbtokobuku");
		return $this->connect;
	}
}
?>
