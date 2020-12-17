<?php 
    include ("../controller/KriteriaController.php");
    include ("../constants/AtributeKriteria.php");
    include ("../controller/AlternatifController.php");
    include ("../controller/NilaiAlternatifController.php");
    include ("../controller/HitungSawController.php");
    $alternatif = new AlternatifController();
    $kriteria = new KriteriaController();
    $nilai = new NilaiAlternatifController();
    $hitung = new HitungSawController();
    $atributK = new AtributeKriteria();

    if(isset($_POST['updateNilai'])){
        $nilai->saveNilai();
    }

    if(isset($_POST['sync'])){
        $hitung->syncData();
    }
?>
<div class="bg-light shadow rounded">
    <div class="row"> 
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Perhitungan Metode Simple Additive Weighting (SAW)
                </div>
                <div class="card-body">
                    <div class="py-1">
                        <h6 class="card-title">Data Kriteria</h6>
                    </div>
                    <table class="table table-sm table-striped">
                            <tr>
                                <th>Kriteria</th>
                                <?php 
                                    foreach($kriteria->getData() as $kri){
                                ?>
                                    <td><?php echo $kri['kriteria'].' ('.$kri['kode'].')' ?></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <th>Bobot</th>
                                <?php 
                                    foreach($kriteria->getData() as $kri){
                                ?>
                                    <td><?php echo $kri['nilai'] ?></td>
                                <?php } ?>
                            </tr>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row"> 
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="py-1">
                        <h6 class="card-title">Nilai Alternatif Dari Setiap Kriteria</h6>
                    </div>
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode Alternatif</th>
                                <th>Alternatif</th>
                                <?php 
                                    foreach($kriteria->getData() as $kr){
                                ?>
                                <th><?php echo $kr['kode'] ?></th>
                                    <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $no = 0;
                            foreach($alternatif->getData() as $alt){
                                $no ++;
                        ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $alt['kode'] ?></td>
                                <td><?php echo $alt['alternatif'] ?></td>
                                <?php 
                                    foreach($kriteria->getData() as $kr){
                                ?>
                                    <td><?php echo $nilai->getNilaiByKrAlt($alt['id'], $kr['id']); ?></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-light shadow rounded mt-3">
    <div class="row"> 
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Hasil Perhitungan Metode Simple Additive Weighting (SAW)
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    Matriks Keputusan Ternormalisasi (r)
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Kode Alternatif</th>
                                                <?php 
                                                    foreach($kriteria->getData() as $kr){
                                                ?>
                                                <th><?php echo $kr['kode'] ?></th>
                                                    <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $no = 0;
                                            foreach($alternatif->getData() as $alt){
                                                $no ++;
                                        ?>
                                            <tr>
                                                <td><?php echo $no ?></td>
                                                <td><?php echo $alt['kode'] ?></td>
                                                <?php 
                                                    foreach($kriteria->getData() as $kr){
                                                ?>
                                                    <td><?php echo $hitung->getNormalisasi($kr['id'], $alt['id']) ?></td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <form action="" method="post">
                            <div class="card">
                                <div class="card-header">
                                    Hasil Metode Simple Additive Weighting (SAW) Pemilihan Gitar Elektrik
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Kode Alternatif</th>
                                                <th>Alternatif</th>
                                                <th>Jenis Pickup</th>
                                                <th>Jenis Kayu</th>
                                                <th>Harga</th>
                                                <th>Merek</th>
                                                <th>Hasil</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $no = 0;
                                            foreach($hitung->hitungHasil() as $ht){
                                                $no ++;
                                        ?>
                                            <input type="hidden" name="rank[]" value="<?php echo $no; ?>">
                                            <input type="hidden" name="id[]" value="<?php echo $ht['id_alternatif']; ?>">
                                            <tr>
                                                <td><?php echo $no ?></td>
                                                <td><?php echo $ht['kode']; ?> </td>
                                                <td><?php echo $ht['alternatif']; ?></td>
                                                <td><?php echo $alternatif->getDataByK($ht['jenis_pickup']); ?></td>
                                                <td><?php echo $alternatif->getDataByK($ht['jenis_kayu']); ?></td>
                                                <td><?php echo $alternatif->getDataByK($ht['harga']); ?></td>
                                                <td><?php echo $alternatif->getDataByK($ht['merk']); ?></td>
                                                <td><?php echo $ht['hasil']; ?></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer">
                                    <div class="float-right">
                                        <button type="submit" class="btn btn-success btn-sm" name="sync">update data</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>