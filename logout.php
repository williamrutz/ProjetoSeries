<?php
    session_start();
    include "conecta.php";
    if(isset($_SESSION['id_user'])){
        session_destroy();
        header("location: index.php");
    }
?>
