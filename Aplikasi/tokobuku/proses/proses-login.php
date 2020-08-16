<?php
session_start();
if(isset($_POST['submit'])){
	include "Kasir.php";
	$Kasir = new Kasir;
	$Kasir->setUsername(mysql_real_escape_string($_POST['username']));
	$Kasir->setPassword(mysql_real_escape_string($_POST['password']));
	$Kasir->login();
}
?>