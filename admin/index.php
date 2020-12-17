<?php session_start();
    if(isset($_SESSION['user'])){
        echo "<script> location.replace('home.php?page=dashboard'); </script>";
    }else{
        echo "<script> location.replace('../login.php'); </script>";
    }