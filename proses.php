<?php
    session_start();
    include_once ("config/database.php");
    $kon = (new database)->koneksi();

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $login = $kon->query("SELECT * FROM user WHERE username='$username' && password='$password'");
        $count = $login->num_rows;
        if($count > 0){
            $_SESSION['user'] = $login;
            header('location:admin/home.php?page=dashboard');
            
        }else{
            header('location:login.php');
            $_SESSION['message'] = true;
        }
    }