<?php

use APP\Kasir;

session_start();
if (isset($_POST['submit'])) {
    include "Kasir.php";
    $Kasir           = new Kasir();
    $mysqli          = $Kasir->connection()->mysqli();
    $Kasir->username = $mysqli->real_escape_string($_POST['username']);
    $Kasir->password = $mysqli->real_escape_string($_POST['password']);
    $Kasir->login();
}
