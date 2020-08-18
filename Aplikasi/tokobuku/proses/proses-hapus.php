<?php

use APP\Buku;
use APP\Distributor;
use APP\Kasir;
use APP\Pasok;
use APP\Hotel;

session_start();
$level = '';
if (isset($_SESSION['level'])) {
    $level = $_SESSION['level'];
}
if (isset($_GET['type'])) {
    if ($_GET['type'] == 1) {
        if ($level == 'admin') {
            include "Distributor.php";
            $Distributor     = new Distributor();
            $Distributor->id = $_GET['id'];
            $Distributor->delete();
        } else {
            header('location:index.php');
        }
    } elseif ($_GET['type'] == 2) {
        if ($level == 'admin') {
            include "Kasir.php";
            $Kasir     = new Kasir();
            $Kasir->id = $_GET['id'];
            $Kasir->delete();
        } else {
            header('location:index.php');
        }
    } elseif ($_GET['type'] == 3) {
        if ($level == 'admin') {
            include "Buku.php";
            $Buku     = new Buku();
            $Buku->id = $_GET['id'];
            $Buku->delete();
        } else {
            header('location:index.php');
        }
    } elseif ($_GET['type'] == 4) {
        if ($level == 'admin') {
            include "Pasok.php";
            $Pasok          = new Pasok();
            $Pasok->idPasok = $_GET['id'];
            $Pasok->delete();
        } else {
            header('location:index.php');
        }
    } elseif ($_GET['type'] == 5) {

    } elseif ($_GET['type'] == 6) {
	    if ($level == 'admin') {
		    include "Hotel.php";
		    $Hotel     = new Hotel();
		    $Hotel->id = $_GET['id'];
		    $Hotel->delete();
	    } else {
		    header('location:index.php');
	    }
    }
}
