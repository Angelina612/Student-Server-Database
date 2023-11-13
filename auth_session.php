<?php
    session_start();
    if(!isset($_SESSION["stdid"])) {
        header("Location: login.php");
        exit();
    }
?>