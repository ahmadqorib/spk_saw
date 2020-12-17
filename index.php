<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/bootstrap/css/bootstrap.min.css">
    <title>SPK SAW</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        body{
            background-color: #353b48;
            padding: 0;
            margin: 0;
        }
        .navbar{
            background-color: #c23616;
            border: 0;
        }

        .navbar .nav-item a{
            color: #FFFF;
        }

        .text-login h3{
            color: #ecf0f1;
            font-weight: 900;
        }

        .text-login h6{
            color: #ecf0f1;
            font-weight: 900;
        }

        .img__container {
            margin: 0;
            padding: 0;
        }

        .img__container img {
            position: absolute;
            min-height: 100%;
            min-width: 100%;
            margin: 0;
            padding: 0;
            width: 0;
        }

        #footer{
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 50px;
            text-align: center;
            vertical-align: middle;
            line-height: 50px; 
            color: #ecf0f1;
            background-color: #c23616;
        }
    </style>
</head>
<body>
        <header>
            <nav class="navbar navbar-expand-lg shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="#">
                        <img src="images/loggo.jpg" alt="" width="100" class="d-inline-block align-top">
                    </a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="?page=home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?page=cari">Cari Gitar</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <section>
            <div class="container">
                <div class="row">
                    <!-- <div class="col-md-4 img__container">
                        <img src="images/coba.jpg" alt="">
                    </div>
                    <div class="col-md-8 p-4" style="height: 100%"> -->
                    <?php
                        //include "login.php";
                    ?>
                    <!-- </div> -->
                    <div class="col-md-12">
                        <?php
                            if(isset($_GET['page']) && $_GET['page'] == "cari"){
                                include "cari.php";
                            }else{
                                include "home.php";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <div id="footer">
            <p>Copyright Riko</p>
        </div>
        


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <!-- <script src="style/bootstrap/js/bootstrap.min.js"></script>
    <script src="style/jquery-3.3.1.min.js"></script> -->
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
</body>
</html>