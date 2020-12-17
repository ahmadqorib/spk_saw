<?php
    if( file_exists("../config/database.php")){
        include_once ("../config/database.php");
    }else{
        include_once ("config/database.php");
    }

    class AlternatifController{

        public $kon;

        function __construct()
        {
            $koneksi = new database;
            $this->kon = $koneksi->koneksi();
        }

        // mendapatkan list alternatif dari database
        function getData()
        {
            $data = $this->kon->query("SELECT * FROM alternatif ORDER BY kode ASC");

            $hasil = [];
            while($d = mysqli_fetch_array($data)){
                $hasil[] = $d;
            }
            return $hasil;
        }

        public function getDataByK($id)
        {
            $sql = $this->kon->query("SELECT * FROM range_kriteria WHERE id='$id'");
            $data = $sql->fetch_assoc();

            return $data['range_kriteria'] ?? '-';
        }

        public function store()
        {
            $kode = $_POST['kode'];
            $alternatif = $_POST['alternatif'];
            $jenis_pickup = $_POST['jenis_pickup'];
            $jenis_kayu = $_POST['jenis_kayu'];
            $harga = $_POST['harga'];
            $merk = $_POST['merk'];
            $nama = null;
            
            if($_FILES['photo']['name'] != ""){
                $ekstensi_diperbolehkan	= array('png','jpg', 'jpeg');
                $nama = $_FILES['photo']['name'];
                $x = explode('.', $nama);
                $ekstensi = strtolower(end($x));
                $ukuran	= $_FILES['photo']['size'];
                $file_tmp = $_FILES['photo']['tmp_name'];	

                if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){	
                    move_uploaded_file($file_tmp, '../images/alternatif/'.$nama);
                }
            }

            $save = $this->kon->query ("INSERT INTO alternatif (kode, alternatif, jenis_pickup, jenis_kayu, harga, merk, photo)
                    VALUES ('$kode', '$alternatif', '$jenis_pickup', '$jenis_kayu', '$harga', '$merk', '$nama')");

            if($save === true){
                $_SESSION['pesan'] = [
                    'status' => 'success',
                    'pesan' => 'Data berhasil disimpan'
                ];
            }

            echo "<script> location.replace('home.php?page=alternatif'); </script>";
        }

        function edit($id)
        {
            $sql = $this->kon->query("SELECT * FROM alternatif WHERE id='$id'");
            $data = $sql->fetch_assoc();

            return $data;
        }

        public function update($id)
        {
            $kode = $_POST['kode'];
            $alternatif = $_POST['alternatif'];
            $jenis_pickup = $_POST['jenis_pickup'];
            $jenis_kayu = $_POST['jenis_kayu'];
            $harga = $_POST['harga'];
            $merk = $_POST['merk'];
            $nama = $_POST['photo_lama'];
            
            if($_FILES['photo']['name'] != ""){
                $ekstensi_diperbolehkan	= array('png','jpg', 'jpeg');
                $nama = $_FILES['photo']['name'];
                $x = explode('.', $nama);
                $ekstensi = strtolower(end($x));
                $ukuran	= $_FILES['photo']['size'];
                $file_tmp = $_FILES['photo']['tmp_name'];	

                if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){	
                    move_uploaded_file($file_tmp, '../images/alternatif/'.$nama);
                }
            }

            $save = $this->kon->query ("UPDATE alternatif SET 
                kode = '$kode', 
                alternatif = '$alternatif', 
                jenis_pickup = '$jenis_pickup', 
                jenis_kayu = '$jenis_kayu', 
                harga = '$harga', 
                merk = '$merk', 
                photo = '$nama'
                WHERE id='$id'
            ");

            if($save === true){
                $_SESSION['pesan'] = [
                    'status' => 'success',
                    'pesan' => 'Data berhasil disimpan'
                ];
            }

            echo "<script> location.replace('home.php?page=alternatif'); </script>";
        }

        public function delete($id)
        {

            $delete = $this->kon->query("DELETE FROM alternatif WHERE id = '$id'");

            if($delete){
                $_SESSION['pesan'] = [
                    'status' => 'success',
                    'pesan' => 'Data berhasil dihapus'
                ];
            }

            echo "<script> location.replace('home.php?page=alternatif'); </script>";

        }

    }