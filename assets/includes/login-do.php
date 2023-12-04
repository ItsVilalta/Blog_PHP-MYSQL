<?php
if (!isset($_SESSION)) {
    session_start();
}

$_SESSION['logeao'] = true;

header('Location: ../../index.php');
die();
?>