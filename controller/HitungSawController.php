<?php
    include_once ("../config/database.php");

    class HitungSawController{

        public $kon;

        function __construct()
        {
            $koneksi = new database;
            $this->kon = $koneksi->koneksi();
        }

        public function syncData()
        {
            $rank = $_POST['rank'];
            $id = $_POST['id'];
            
            $toDelete = $this->kon->query("DELETE FROM hasil");

            foreach($rank as $i => $r){
                $toSave = $this->kon->query("INSERT INTO hasil (rank, id_alternatif) VALUES ('$r','$id[$i]')");
            }
            echo "<script> location.replace('home.php?page=keputusan'); </script>";
        }

        // proses menghitung nilai kriteria 
        public function getNilaiNormalisasi($idKr, $nilai)
        {
            $sql = $this->kon->query("SELECT MAX(n.nilai) as max_nilai, MIN(n.nilai) as min_nilai, kriteria, atribut 
                    FROM nilai_alternatif n, kriteria k WHERE id_kriteria='$idKr' AND n.id_kriteria = k.id");
            $row = $sql->fetch_assoc();
            
            $result = 0;
            // menghitung kriteria jika atribut cost
            if($row['atribut'] == AtributeKriteria::COST){
                $result = $row['min_nilai'] == 0 ? 0 : $row['min_nilai'] / $nilai;
            }else{
                // menghitung kriteria jika atribut benefit
                $result = $row['max_nilai'] == 0 ? 0 : $nilai / $row['max_nilai'];
            }

            return $result;
        }

        // menghitung normalisasi (mendapakan nilai alternatif dari kriteria/alternatif)
        public function getNormalisasi($idKr, $idAlt)
        {
            $sql = $this->kon->query("SELECT * FROM nilai_alternatif WHERE id_alternatif='$idAlt' AND id_kriteria='$idKr'");
            $row = $sql->fetch_assoc();

            // memanggil fungsi untuk proses menghitung nilai kriteria
            $nilai =  $this->getNilaiNormalisasi($idKr, $row['nilai']);
            return number_format($nilai, 4);
        }

        // menghitung hasil metode saw setiap alternatif
        public function hitungHasil()
        {
            // dapatkan data seluruh alternatif
            $alternatif = $this->kon->query("SELECT * FROM alternatif");

            $data = [];
            // perulangan seluruh data alternatif, kemudian cek satu persatu nilainya
            while($alt = mysqli_fetch_array($alternatif)){
                // query dari nilai alternatif yang berelasi dengan alternatif & kriteria
                $hitung = $this->kon->query("SELECT a.id, na.id_alternatif, na.id_kriteria, k.nilai as nilai_kriteria FROM 
                        alternatif a, nilai_alternatif na, kriteria k WHERE 
                        a.id = na.id_alternatif AND k.id = na.id_kriteria AND na.id_alternatif = '$alt[id]'");
          
                $hasil = 0;
                // perulangan seluruh nilai dari setiap alternatif
                while($hit = mysqli_fetch_array($hitung)){
                    // melakukan proses perhitungan nilai yang diperoleh dari setiap alternatif
                    $hasil = $hasil + ($hit['nilai_kriteria'] * $this->getNormalisasi($hit['id_kriteria'], $hit['id_alternatif']));
                }
                
                // hasil dimasukkan divariabel data
                $data[] = [
                    'hasil' => $hasil,
                    'kode' => $alt['kode'],
                    'id_alternatif' => $alt['id'],
                    'alternatif' => $alt['alternatif'],
                    'jenis_pickup' => $alt['jenis_pickup'],
                    'jenis_kayu' => $alt['jenis_kayu'],
                    'harga' => $alt['harga'],
                    'merk' => $alt['merk']
                ];
            }
            rsort($data);
            return $data;
        }

    }