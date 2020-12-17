<?php session_start();
    if($_SESSION['user'] == NULL){
        echo "<script> location.replace('../login.php'); </script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <title>SPK SAW</title>
    <style>
        body{
            background-color: #353b48;
            padding: 0;
            margin: 0;
        }

        .navbar{
            background-color: #c23616;
        }

        #konten{
            margin-top: 100px;
        }

        .table{
            font-size: 14px;
        }

        .sidebar {
            position: fixed;
            top: 51px;
            bottom: 0;
            left: 0;
            z-index: 1000;
            display: block;
            padding: 20px;
            overflow-x: hidden;
            overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
            background-color: #f5f5f5;
            border-right: 1px solid #eee;
        }

        .sidebar .menu ul li{
            padding: 2px;
        }

        .sidebar .menu ul li .active{
            background-color: #f1c40f;
        }

        .sidebar .menu-logout{
            bottom: 0;
            margin-top: 30px;
        }

        .sidebar .menu-logout ul li .active{
            background-color: #c23616;
        }

        .sidebar .user{
            text-align: center;
            margin-bottom: 5px;
        }

        .main {
            padding: 20px;
            top: 55px;
        }
    </style>
</head>
<body>
        <?php if(isset($_SESSION['message']) && $_SESSION['message']['status'] == "success"){ ?>
                <div class="alert alert-success alert-dismissible fade show float-right" role="alert" style="position: fixed; right: 0; z-index:1" >
                    <?php echo $_SESSION['message']['pesan']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        <?php
                unset($_SESSION['message']);
            }
        ?>
        <header >
            <nav class="navbar navbar-expand-lg shadow-sm fixed-top">
                <div class="container">
                    <a class="navbar-brand" href="#">
                        <img src="../images/loggo.jpg" alt="" width="100" class="d-inline-block align-top">
                    </a>
                </div>
            </nav>
        </header>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    <div class="user">
                        <img src="../images/foto.jpeg" class="img img-fluid rounded-circle" alt="">
                        <span>Riko Rivandi H</span>
                    </div>
                    <div class="menu">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" href="?page=dashboard">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="?page=kriteria">Kriteria</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="?page=range_kriteria">Range Kriteria</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="?page=alternatif">Alternatif</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="?page=nilai_alternatif">Nilai Alternatif</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="?page=keputusan">Nilai Keputusan</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link active" data-toggle="collapse" href="#item-1">Item 1</a>
                                <div id="item-1" class="collapse">
                                    <ul class="nav flex-column ml-3">
                                        <li class="nav-item">
                                        <a class="nav-link" href="#">Sub 1</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link" href="#">Sub 2</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link" href="#">Sub 3</a>
                                        </li>
                                    </ul>
                                </div>
                            </li> -->
                        </ul>
                    </div>
                    <div class="menu-logout">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item text-center">
                                <a class="nav-link active" href="logout.php">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-10 offset-md-2 main">
                    <?php if(isset($_SESSION['pesan']) && $_SESSION['pesan']['status'] == "success"){ ?>
                        <div class="row"> 
                            <div class="col-md-12">
                                <div class="alert alert-success alert-dismissible fade show float-right" role="alert" style="position: absolute; right: 0; z-index:1" >
                                    <?php echo $_SESSION['pesan']['pesan']; ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php

                        }
                        unset($_SESSION['pesan']);
                    ?>

                    <?php 
                        if(isset($_GET['page'])){
                            $page = $_GET['page'];

                            if(isset($page) && $page == "kriteria"){
                                $action = $_GET['action'] ?? null;

                                if($action == "tambah"){
                                    include "page/kriteria/tambah.php";
                                }elseif($action == "edit"){
                                    include "page/kriteria/edit.php";
                                }else{
                                    include "page/kriteria/index.php";
                                }
                            }elseif(isset($page) && $page == "alternatif"){
                                $action = $_GET['action'] ?? null;

                                if($action == "tambah"){
                                    include "page/alternatif/tambah.php";
                                }elseif($action == "edit"){
                                    include "page/alternatif/edit.php";
                                }else{
                                    include "page/alternatif/index.php";
                                }
                            }elseif(isset($page) && $page == "nilai_alternatif"){
                                include "page/nilai-alternatif/index.php";
                            }elseif(isset($page) && $page == "range_kriteria"){
                                include "page/range/index.php";
                            }elseif(isset($page) && $page == "keputusan"){
                                include "page/keputusan/index.php";
                            }elseif(isset($page) && $page == "dashboard"){
                                include "dashboard.php";
                            }
                        }
                    ?>
                </div>
            </div>
        </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- <script src="style/bootstrap/js/bootstrap.min.js"></script>
    <script src="style/jquery-3.3.1.min.js"></script> -->

    <script>
        $(document).ready(function() {
            $('.alternatif').select2({
                placeholder: "Pilih alternatif",
            });
            $('.kriteria').select2({
                placeholder: "Pilih kriteria",
            });
        });
    </script>
</body>
</html>