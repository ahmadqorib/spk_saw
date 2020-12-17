<?php
    include_once ("../config/database.php");

    class KriteriaController{

        public $kon;

        function __construct()
        {
            $koneksi = new database;
            $this->kon = $koneksi->koneksi();
        }

        // mendapatkan list kriterai dari database
        function getData()
        {
            $data = $this->kon->query("SELECT * FROM kriteria ORDER BY kode ASC");

            $hasil = [];
            while($d = mysqli_fetch_array($data)){
                $hasil[] = $d;
            }
            return $hasil;
        }

        public function store()
        {
            $kode = $_POST['kode'];
            $kriteria = $_POST['kriteria'];
            $nilai = $_POST['nilai'];
            $atribut = $_POST['atribut'];
            $keterangan = $_POST['keterangan'];

            $save = $this->kon->query ("INSERT INTO kriteria (kode, kriteria, nilai, atribut, keterangan)
                    VALUES ('$kode', '$kriteria', '$nilai', '$atribut', '$keterangan')");

            if($save === true){
                $_SESSION['pesan'] = [
                    'status' => 'success',
                    'pesan' => 'Data berhasil disimpan'
                ];
            }

            echo "<script> location.replace('home.php?page=kriteria'); </script>";
        }

        function edit($id)
        {
            $sql = $this->kon->query("SELECT * FROM kriteria WHERE id='$id'");
            $data = $sql->fetch_assoc();

            return $data;
        }

        public function update($id)
        {
            $kode = $_POST['kode'];
            $kriteria = $_POST['kriteria'];
            $nilai = $_POST['nilai'];
            $atribut = $_POST['atribut'];
            $keterangan = $_POST['keterangan'];

            $save = $this->kon->query ("UPDATE kriteria SET 
                kode = '$kode',
                kriteria = '$kriteria',
                nilai = '$nilai',
                atribut = '$atribut',
                keterangan = '$keterangan'
                WHERE id='$id'
            ");

            if($save){
                $_SESSION['pesan'] = [
                    'status' => 'success',
                    'pesan' => 'Data berhasil diperbaharui'
                ];
            }

            echo "<script> location.replace('home.php?page=kriteria'); </script>";
        }

        public function delete($id)
        {

            $delete = $this->kon->query("DELETE FROM kriteria WHERE id = '$id'");

            if($delete){
                $_SESSION['pesan'] = [
                    'status' => 'success',
                    'pesan' => 'Data berhasil dihapus'
                ];
            }

            echo "<script> location.replace('home.php?page=kriteria'); </script>";

        }

    }