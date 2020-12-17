<?php
    if( file_exists("../config/database.php")){
        include_once ("../config/database.php");
    }else{
        include_once ("config/database.php");
    }

    class PencarianController{

        public $kon;

        function __construct()
        {
            $koneksi = new database;
            $this->kon = $koneksi->koneksi();
        }

        public function search()
        {
            $param = [];
            if(isset($_POST['jenis_pickup']) && !empty($_POST['jenis_pickup']))
                $param = array_merge($param, $_POST['jenis_pickup']);

            if(isset($_POST['jenis_kayu']) && !empty($_POST['jenis_kayu']))
                $param = array_merge($param, $_POST['jenis_kayu']);
                
            if(isset($_POST['harga']) && !empty($_POST['harga']))
                $param = array_merge($param, $_POST['harga']);

            if(isset($_POST['merek']) && !empty($_POST['merek']))
                $param = array_merge($param, $_POST['merek']);

            // mengecek data parameter yang dicari ada tidak
            $data = [];
            if(!empty($param)){
                // melakukan perulangan karena data yang dicari lebih dari satu
                foreach($param as $q){
                    // mendapatkan data range kriteria berdasarkan data yang dimasukkan
                    $range = $this->kon->query("SELECT * FROM range_kriteria WHERE id='$q'");
                    $data_range = $range->fetch_assoc();

                    // mencocokan data range dengan nilai alternatif
                    // jika merek laptop tidak dimasukkan maka mencari data sesuai kriteria yang dimasukkan
                    $sqlN = "SELECT * FROM nilai_alternatif WHERE id_kriteria='$data_range[id_kriteria]' AND nilai='$data_range[nilai]'";

                    $nilai = $this->kon->query($sqlN);
                    
                    // melakukan perulangan dari data nilai alternatif sehingga data alternatif dapat diperoleh
                    while($d = mysqli_fetch_array($nilai)){
                        // mendapatkan data alternatif sesuai nilai yang diperoleh
                        $alternatif = $this->kon->query("SELECT * FROM alternatif a, hasil h 
                            WHERE a.id='$d[id_alternatif]' AND a.id=h.id_alternatif
                        ");

                        $data_alt = $alternatif->fetch_assoc();
                        
                        // melakukan pengecekan apakah data sudah berada pada variabel data atau belum
                        $cek = 0;
                        foreach($data as $dt){
                            if($dt['kode'] == $data_alt['kode']){
                                $cek++;
                            }
                        }

                        // jika data yang dicek belum ada di variabel data maka data alternatif akan dimasukkan ke variabel data
                        if($cek == 0){
                            $data[] = [
                                'rank' => $data_alt['rank'],
                                'kode' => $data_alt['kode'],
                                'alternatif' => $data_alt['alternatif'],
                                'jenis_pickup' => $data_alt['jenis_pickup'],
                                'jenis_kayu' => $data_alt['jenis_kayu'],
                                'harga' => $data_alt['harga'],
                                'merk' => $data_alt['merk'],
                                'photo' => $data_alt['photo']
                            ];
                        }
                    }
                    
                }
            }
            
            asort($data); //mengurutkan dari yang terkecil (rank)
  
            return $data;
        }

        public function cari()
        {
            $sql = "SELECT a.*, h.rank FROM alternatif a, hasil h WHERE a.id = h.id_alternatif";

            $param = [];
            if(isset($_POST['jenis_pickup']) && !empty($_POST['jenis_pickup'])){
                $param[] = $_POST['jenis_pickup'];
                $inPickup = '(' . implode(',', $_POST['jenis_pickup']) . ')'; 
                $sql .= " AND jenis_pickup IN $inPickup";
            }
       
            if(isset($_POST['jenis_kayu']) && !empty($_POST['jenis_kayu'])){
                $param[] = $_POST['jenis_kayu'];
                $inKayu = '(' . implode(',', $_POST['jenis_kayu']) . ')'; 
                $sql .= " AND jenis_kayu IN $inKayu";
            }
                
            if(isset($_POST['harga']) && !empty($_POST['harga'])){
                $param[] = $_POST['harga'];
                $inHarga = '(' . implode(',', $_POST['harga']) . ')'; 
                $sql .= " AND harga IN $inHarga";
            }

            if(isset($_POST['merek']) && !empty($_POST['merek'])){
                $param[] = $_POST['merek'];
                $inMerk = '(' . implode(',', $_POST['merek']) . ')'; 
                $sql .= " AND merk IN $inMerk";
            }

            if(empty($param)){
                return null;
            }

            $sql .= " ORDER BY rank ASC";
            $data = $this->kon->query($sql);
            $hasil = [];
            while($d = mysqli_fetch_array($data)){
                $hasil[] = $d;
            }
            return $hasil;
        }
    }