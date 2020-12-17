<?php

    if( file_exists("../config/database.php")){
        include_once ("../config/database.php");
    }else{
        include_once ("config/database.php");
    }

    class RangeKriteriaController{

        public $kon;

        function __construct()
        {
            $koneksi = new database;
            $this->kon = $koneksi->koneksi();
        }

        function getData()
        {
            $data = $this->kon->query("SELECT r.id, id_kriteria, range_kriteria, r.nilai, kriteria FROM range_kriteria r, kriteria k WHERE r.id_kriteria=k.id ORDER BY id_kriteria ASC");

            $hasil = [];
            while($d = mysqli_fetch_array($data)){
                $hasil[] = $d;
            }
            return $hasil;
        }

        public function getByKriteria($kriteria)
        {
            $data = $this->kon->query("SELECT r.id, id_kriteria, range_kriteria, r.nilai, kriteria FROM range_kriteria r, kriteria k WHERE r.id_kriteria=k.id AND k.kriteria='$kriteria' ORDER BY id_kriteria ASC");

            $hasil = [];
            while($d = mysqli_fetch_array($data)){
                $hasil[] = $d;
            }
            return $hasil ?? '';
        }

        public function store()
        {
            $kriteria = $_POST['kriteria'];
            $range = $_POST['range'];
            $nilai = $_POST['nilai'];

            $save = $this->kon->query ("INSERT INTO range_kriteria (id_kriteria, range_kriteria, nilai)
                    VALUES ('$kriteria', '$range', '$nilai')");

            if($save){
                $_SESSION['message'] = [
                    'status' => 'success',
                    'pesan' => 'Data berhasil disimpan'
                ];
            }

            echo "<script> location.replace('home.php?page=range_kriteria'); </script>";
        }

        function edit($id)
        {
            $sql = $this->kon->query("SELECT * FROM range_kriteria WHERE id='$id'");
            $data = $sql->fetch_assoc();

            return $data;
        }

        public function update($id)
        {
            $kriteria = $_POST['kriteria'];
            $range = $_POST['range'];
            $nilai = $_POST['nilai'];

            $save = $this->kon->query ("UPDATE range_kriteria SET 
                id_kriteria = '$kriteria',
                range_kriteria = '$range',
                nilai = '$nilai'
                WHERE id='$id'
            ");

            if($save){
                $_SESSION['message'] = [
                    'status' => 'success',
                    'pesan' => 'Data berhasil diperbaharui'
                ];
            }

            echo "<script> location.replace('home.php?page=range_kriteria'); </script>";
        }

        public function delete($id)
        {

            $delete = $this->kon->query("DELETE FROM range_kriteria WHERE id = '$id'");

            if($delete){
                $_SESSION['message'] = [
                    'status' => 'success',
                    'pesan' => 'Data berhasil dihapus'
                ];
            }

            echo "<script> location.replace('home.php?page=range_kriteria'); </script>";

        }

        public function getDataByKriteria($idKriteria)
        {
            $data = $this->kon->query("SELECT * FROM range_kriteria WHERE id_kriteria='$idKriteria'");

            $hasil = [];
            while($d = mysqli_fetch_array($data)){
                $hasil[] = $d;
            }
            return $hasil;
        }

    }