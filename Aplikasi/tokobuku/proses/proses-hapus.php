<?php
session_start();
if (isset($_SESSION['level'])) {
    $level = $_SESSION['level'];
}
if (isset($_GET['type'])) {
    if ($_GET['type'] == 1) {
        if ($level == 'admin') {
            include "Distributor.php";
            $Distributor = new \APP\Distributor();
            $Distributor->id = $_GET['id'];
            $Distributor->delete();
        } else {
            header('location:index.php');
        }
    } elseif ($_GET['type'] == 2) {
        if ($level == 'admin') {
            include "Kasir.php";
            $Kasir     = new \APP\Kasir();
            $Kasir->id = $_GET['id'];
            $Kasir->delete();
        } else {
            header('location:index.php');
        }
    } elseif ($_GET['type'] == 3) {
        if ($level == 'admin') {
            include "Buku.php";
            $Buku     = new \APP\Buku();
            $Buku->id = $_GET['id'];
            $Buku->delete();
        } else {
            header('location:index.php');
        }
    } elseif ($_GET['type'] == 4) {
        if ($level == 'admin') {
            include "Pasok.php";
            $Pasok = new \APP\Pasok();
            $Pasok->idPasok = $_GET['id'];
            $Pasok->delete();
        } else {
            header('location:index.php');
        }
    } elseif ($_GET['type'] == 5) {
    }
}
