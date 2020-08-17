<?php
session_start();
if (isset($_POST['submit'])) {
    include "Kasir.php";
    $Kasir    = new Kasir();
    $mysqli  = $Kasir->connection()->mysqli();
    $Kasir->__set('username', $mysqli->real_escape_string($_POST['username']));
    $Kasir->__set('password', $mysqli->real_escape_string($_POST['password']));
    $Kasir->login();
}
