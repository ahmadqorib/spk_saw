<?php
    class database{
        var $host = "localhost";
        var $username = "root";
        var $password = "";
        var $database = "saw";
        
        function koneksi(){
            $koneksi = mysqli_connect($this->host, $this->username, $this->password,$this->database);
            if ($koneksi->connect_error) {
                die("Connection failed: " . $koneksi->connect_error);
            }

            return $koneksi;
        }
    }