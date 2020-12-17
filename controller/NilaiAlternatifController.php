<?php
    include_once ("../config/database.php");

    class NilaiAlternatifController{

        public $kon;

        public function __construct()
        {
            $koneksi = new database;
            $this->kon = $koneksi->koneksi();
        }

        public function getNilai($idAlt, $idKr, $kr)
        {
            $sql = $this->kon->query("SELECT * FROM nilai_alternatif where id_alternatif = '$idAlt' AND id_kriteria = '$idKr'");
            $data = $sql->fetch_assoc();
            
            if($data != null)
                return $data['nilai'];

            return $this->getNilaiRange($idAlt, $kr);
        }

        public function getNilaiRange($idAlt, $kr)
        {
            $sql = $this->kon->query("SELECT * FROM alternatif a where id='$idAlt'");
            $dataA = $sql->fetch_assoc();

            $sqlNilai = "";
            if($kr == Kriteria::JENIS_PICKUP){
                $sqlNilai = "SELECT * FROM range_kriteria WHERE id = '$dataA[jenis_pickup]'";
            }elseif($kr == Kriteria::JENIS_KAYU){
                $sqlNilai = "SELECT * FROM range_kriteria WHERE id = '$dataA[jenis_kayu]'";
            }elseif($kr == Kriteria::MERK){
                $sqlNilai = "SELECT * FROM range_kriteria WHERE id = '$dataA[merk]'";
            }elseif($kr == Kriteria::HARGA){
                $sqlNilai = "SELECT * FROM range_kriteria WHERE id = '$dataA[harga]'";
            }

            $range = $this->kon->query($sqlNilai);
            $row = $range->fetch_assoc();
            return $row['nilai'] ?? null;
        }

        public function saveNilai()
        {
            $nilai = $_POST['nilai'];
            
            $data = [];

            foreach($nilai as $itemAlt => $alt){
                foreach($alt as $itemKr => $kr){
                    foreach($kr as $n){
                        $data[] =[
                            'id_alternatif' => $itemAlt,
                            'id_kriteria' => $itemKr,
                            'nilai' => $n
                        ];
                    }
                }
            }

            foreach($data as $item => $data){
                $allDelete = $this->kon->query("DELETE FROM nilai_alternatif");

                if($item == 0)
                    $sql = "INSERT INTO nilai_alternatif (id_alternatif, id_kriteria, nilai) VALUES ($data[id_alternatif],$data[id_kriteria],$data[nilai]);";
                else
                    $sql .= "INSERT INTO nilai_alternatif (id_alternatif, id_kriteria, nilai) VALUES ($data[id_alternatif],$data[id_kriteria],$data[nilai]);";
            }

            $save = $this->kon->multi_query($sql);
            if($save){
                $_SESSION['message'] = [
                    'status' => 'success',
                    'pesan' => 'Data berhasil disimpan'
                ];
            }

            echo "<script> location.replace('home.php?page=nilai_alternatif'); </script>";
        }

        // fungsi untuk menampilkan informasi kriteria, alternatif serta nilai yang telah dimasukkan
        public function getNilaiByKrAlt($idAlt, $idKr)
        {
            $sql = $this->kon->query("SELECT * FROM nilai_alternatif WHERE id_alternatif='$idAlt' AND id_kriteria='$idKr'");
            $row = $sql->fetch_assoc();

            if($row==null){
                return "<span class='text-danger'>-</span>";
            }
            return $row['nilai'];
        }

    }