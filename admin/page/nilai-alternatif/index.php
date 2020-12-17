<?php 
    include ("../controller/KriteriaController.php");
    include ("../constants/AtributeKriteria.php");
    include ("../controller/AlternatifController.php");
    include ("../controller/NilaiAlternatifController.php");
    include ("../controller/RangeKriteriaController.php");
    include ("../constants/Kriteria.php");

    $alternatif = new AlternatifController();
    $kriteria = new KriteriaController();
    $nilai = new NilaiAlternatifController();
    $atributK = new AtributeKriteria();
    $range = new RangeKriteriaController();

    if(isset($_POST['updateNilai'])){
        $nilai->saveNilai();
    }
?>
<div class="bg-light shadow rounded">
    <div class="row"> 
        <div class="col-md-12">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    Keterangan nilai range
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php 
                            foreach($kriteria->getData() as $kri){
                        ?>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    Range <?php echo Kriteria::label($kri['kriteria']); ?> (<?php echo $kri['kode'] ?>)
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm table-striped">
                                        <thead>
                                            <tr>
                                                <th>Range</th>
                                                <th>Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                foreach($range->getDataByKriteria($kri['id']) as $r){
                                            ?>
                                            <tr>
                                                <td><?php echo $r['range_kriteria'] ?></td>
                                                <td><span class="badge badge-danger"><?php echo $r['nilai']; ?></span></td>
                                            </tr>
                                                <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
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
                    <form action="" method="post">
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th width="20%">Alternatif</th>
                                <?php 
                                    foreach($kriteria->getData() as $kr){
                                ?>
                                <th><?php echo $kr['kode'] ?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach($alternatif->getData() as $alt){
                            ?>
                            <tr>
                                <td><?php echo $alt['kode'] ?></td>
                                <td><?php echo $alt['alternatif'] ?></td>
                                <?php 
                                    foreach($kriteria->getData() as $kr){
                                    $idAlt = $alt['id'];
                                    $idKr = $kr['id'];
                                    $nAlt = $nilai->getNilai($idAlt, $idKr, $kr['kriteria']);
                                ?>
                                <td>
                                    <input type="number" class="form-control form-control-sm nilai" value="<?php echo $nAlt ?>" name="nilai[<?php echo $idAlt ?>][<?php echo $idKr ?>][]">
                                </td>
                                <?php } ?>
                            </tr>
                                <?php } ?>
                        </tbody>
                    </table>
                    <div class="float-right">
                        <input type="submit" class="btn btn-sm btn-success" value="update nilai" name="updateNilai">
                    </div>
                </div>
                <div class="card-footer">
                    
                </div>
                </form>
            </div>
        </div>
    </div>
</div>