<?php
session_start();
if (isset($_SESSION)) {
    session_destroy();
    echo "<script>alert('Anda Telah Log out'); window.location.replace('../index.php');</script>";
}
?>