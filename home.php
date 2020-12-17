<?php 
    include ("controller/AlternatifController.php");
    $alternatif = new AlternatifController();

?>
    <div class="row justify-content-md-center p-3">
        <div class="col-md-8 text-login text-center">
        <h3>SISTEM INFORMASI PENDUKUNG KEPUTUSAN PEMILIHAN BASS ELEKTRIK MENGGUNAKAN METODE SIMPLE ADDITIVE WEIGHTING (SAW) </h3>
        </div>
    </div>
    <div class="row justify-content-md-center"> 
        
    <!-- <?php 
        foreach($alternatif->getData() as $i => $d){
    ?>
        <div class="col-md-3 my-2">
            <div class="card">
                <img class="card-img-top" src="images/alternatif/<?php echo $d['photo']; ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $d['alternatif'] ?></h5>
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
    <?php } ?> -->
    </div>
    <div class="mb-3"></div>
