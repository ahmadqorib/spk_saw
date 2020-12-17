<?php 
    include ("controller/PencarianController.php");
    include ("controller/AlternatifController.php");
    include ("controller/RangeKriteriaController.php");
    include ("constants/Kriteria.php");
    $cari = new PencarianController();
    $range = new RangeKriteriaController();
    $alternatif = new AlternatifController();

?>
    <div class="row justify-content-md-center p-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="post">
                        <div class="form-row">
                            <div class="col">
                            <select name="jenis_pickup[]" class="js-example-basic-multiple custom-select" data-placeholder="Pilih Jenis Pickup" multiple="multiple">
                            <?php 
                                foreach($range->getData() as $r){ 
                                    if($r['kriteria'] == Kriteria::JENIS_PICKUP){
                            ?>
                                <option value="<?php echo $r['id'] ?>" <?php if(isset($_POST['jenis_pickup']) && in_array($r['id'], $_POST['jenis_pickup'])){ echo 'selected'; } ?>><?php echo $r['range_kriteria'] ?></option>
                            <?php 
                                    } 
                                }
                            ?>
                            </select>
                            </div>
                            <div class="col">
                                <select class="js-example-basic-multiple custom-select" name="jenis_kayu[]" data-placeholder="Pilih Jenis Kayu" multiple="multiple">
                                <?php 
                                    foreach($range->getData() as $r){ 
                                        if($r['kriteria'] == Kriteria::JENIS_KAYU){
                                ?>
                                    <option value="<?php echo $r['id'] ?>" <?php if(isset($_POST['jenis_kayu']) && in_array($r['id'], $_POST['jenis_kayu'])){ echo 'selected'; } ?>><?php echo $r['range_kriteria'] ?></option>
                                <?php 
                                        } 
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="col">
                                <select class="js-example-basic-multiple custom-select" name="harga[]" data-placeholder="Pilih Harga" multiple="multiple">
                                <?php 
                                    foreach($range->getData() as $r){ 
                                        if($r['kriteria'] == Kriteria::HARGA){
                                ?>
                                    <option value="<?php echo $r['id'] ?>" <?php if(isset($_POST['harga']) && in_array($r['id'], $_POST['harga'])){ echo 'selected'; } ?>><?php echo $r['range_kriteria'] ?></option>
                                <?php 
                                        } 
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="col">
                                <select class="js-example-basic-multiple custom-select" name="merek[]" data-placeholder="Pilih Merek" multiple="multiple">
                                <?php 
                                    foreach($range->getData() as $r){ 
                                        if($r['kriteria'] == Kriteria::MERK){
                                ?>
                                    <option value="<?php echo $r['id'] ?>" <?php if(isset($_POST['merek']) && in_array($r['id'], $_POST['merek'])){ echo 'selected'; } ?>><?php echo $r['range_kriteria'] ?></option>
                                <?php 
                                        } 
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="col">
                                <button type="submit" name="cari" class="btn btn-primary">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-md-center"> 
    <?php 
        if(isset($_POST['cari'])){
            $get = $cari->cari();
            if(is_null($get)){
    ?>
        <div class="col-md-12 my-2">
                <div class="card">
                    <div class="card-body">
                        <h6 class="text-muted text-center">Pencarian tidak ditemukan, anda belum mengisi kriteria</h6>
                    </div>
                </div>
            </div>
    <?php 
            }elseif(count($get) > 0){
                $r = 0;
                foreach($get as $d){
                    $r++;
                ?>    
                    <div class="col-md-3 my-2">
                        <div class="card">
                            <img class="card-img-top" src="images/alternatif/<?php echo $d['photo']; ?>">
                            <div class="card-body">
                                
                                <h5 class="card-title"><span class="badge badge-danger"><?php echo $r ?></span> <?php echo $d['alternatif'] ?></h5>
                                <p class="card-text">
                                <ul>
                                <li>Rp <?php echo $alternatif->getDataByK($d['harga']) ?></li>
                                <li>Merek :<?php echo $alternatif->getDataByK($d['merk']) ?></li>
                                <li>Jenis Pickup :<?php echo $alternatif->getDataByK($d['jenis_pickup']) ?></li>
                                <li>Jenis Kayu :<?php echo $alternatif->getDataByK($d['jenis_kayu']) ?></li>
                                </ul>
                                </p>
                            </div>
                        </div>
                    </div>
    <?php 
                } 
            } else {

            ?>
            <div class="col-md-12 my-2">
                <div class="card">
                    <div class="card-body">
                        <h6 class="text-muted text-center">Pencarian tidak ditemukan</h6>
                    </div>
                </div>
            </div>
    <?php 
            }
        } 
    ?>
    </div>
    <div class="mb-3"></div>
