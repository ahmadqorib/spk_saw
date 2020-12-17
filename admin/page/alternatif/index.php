<?php 
    include ("../controller/AlternatifController.php");
    $alternatif = new AlternatifController();

    if(isset($_GET['action']) && $_GET['action'] == "delete"){
        $alternatif->delete($_GET['id']);
    }
?>
<div class="bg-light shadow rounded">
    <div class="row"> 
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="py-1">
                        <h5 class="card-title">Lihat Alternatif</h5>
                        <a href="<?php echo $_SERVER['PHP_SELF'].'?page=alternatif&action=tambah'; ?>" class="btn btn-success btn-sm">tambah</a>
                    </div>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="1%">#</th>
                                <th>Photo</th>
                                <th>Kode</th>
                                <th>Alternatif/Nama Bass</th>
                                <th>Jenis Pickup</th>
                                <th>Jenis Kayu</th>
                                <th>Harga</th>
                                <th>Merek</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach($alternatif->getData() as $i => $alt){
                            ?>
                            <tr>
                                <td><?php echo $i + 1 ?>.</td>
                                <td><img src="<?php echo '../images/alternatif/'.$alt['photo'] ?>" width="150" class="img img-fluid img-thumbnail" alt=""></td>
                                <td><?php echo $alt['kode'] ?></td>
                                <td><?php echo $alt['alternatif'] ?></td>
                                <td><?php echo $alternatif->getDataByK($alt['jenis_pickup']) ?></td>
                                <td><?php echo $alternatif->getDataByK($alt['jenis_kayu']) ?></td>
                                <td><?php echo $alternatif->getDataByK($alt['harga']) ?></td>
                                <td><?php echo $alternatif->getDataByK($alt['merk']) ?></td>
                                <td>
                                    <a href="<?php echo $_SERVER['PHP_SELF'].'?page=alternatif&action=delete&id='.$alt['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('anda yakin akan menghapus data ?')">hapus</a>
                                    <a href="<?php echo $_SERVER['PHP_SELF'].'?page=alternatif&action=edit&id='.$alt['id']; ?>" class="btn btn-sm btn-primary">edit</a>
                                </td>
                            </tr>
                            <?php 
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>