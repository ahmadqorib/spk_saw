<?php  
    include ("../controller/AlternatifController.php");
    include ("../controller/RangeKriteriaController.php");
    include ("../constants/Kriteria.php");
    $alternatif = new AlternatifController();
    $range = new RangeKriteriaController();

    $id = $_GET['id'];
    $data = $alternatif->edit($id);
    if(isset($_POST['edit'])){
        $alternatif->update($id);
    }
?>
<div class="bg-light shadow rounded">
    <div class="row"> 
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="py-1">
                            <h5 class="card-title">Edit Alternatif</h5>
                        </div>
                        <div class="form-group">
                            <label>Kode<b class="text-danger">*</b></label>
                            <input type="text" name="kode" required class="form-control" placeholder="Input kode kriteria" value="<?php echo $data['kode']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Alternatif / Nama Gitar<b class="text-danger">*</b></label>
                            <input type="text" name="alternatif" required class="form-control" placeholder="Input kriteria" value="<?php echo $data['alternatif']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Jenis Pickup<b class="text-danger">*</b></label>
                            <!-- <input type="text" name="jenis_pickup" required class="form-control" placeholder="Input nilai" value="<?php echo $data['jenis_pickup']; ?>"> -->
                            <select class="form-control select2bs4" name="jenis_pickup" required style="width: 100%;">
                                <?php 
                                    foreach($range->getByKriteria(Kriteria::JENIS_PICKUP) as $r){ 
                                ?>
                                    <option value="<?php echo $r['id'] ?> " <?php if($r['id'] == (int) $data['jenis_pickup']){ echo 'selected'; } ?>><?php echo $r['range_kriteria'] ?></option>
                                <?php }  ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Merek<b class="text-danger">*</b></label>
                            <!-- <input type="text" name="merk" required class="form-control" placeholder="Input nilai" value="<?php echo $data['merk']; ?>"> -->
                            <select class="form-control select2bs4" name="merk" required style="width: 100%;">
                                <?php 
                                    foreach($range->getByKriteria(Kriteria::MERK) as $r){ 
                                ?>
                                    <option value="<?php echo $r['id'] ?> " <?php if($r['id'] == (int) $data['merk']){ echo 'selected'; } ?>><?php echo $r['range_kriteria'] ?></option>
                                <?php }  ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kayu<b class="text-danger">*</b></label>
                            <!-- <input type="text" name="jenis_kayu" required class="form-control" placeholder="Input nilai" value="<?php echo $data['jenis_kayu']; ?>"> -->
                            <select class="form-control select2bs4" name="jenis_kayu" required style="width: 100%;">
                                <?php 
                                    foreach($range->getByKriteria(Kriteria::JENIS_KAYU) as $r){ 
                                ?>
                                    <option value="<?php echo $r['id'] ?> " <?php if($r['id'] == (int) $data['jenis_kayu']){ echo 'selected'; } ?>><?php echo $r['range_kriteria'] ?></option>
                                <?php }  ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Harga<b class="text-danger">*</b></label>
                            <!-- <input type="text" name="harga" required class="form-control" placeholder="Input nilai" value="<?php echo $data['harga']; ?>"> -->
                            <select class="form-control select2bs4" name="harga" required style="width: 100%;">
                                <?php 
                                    foreach($range->getByKriteria(Kriteria::HARGA) as $harga){ 
                                ?>
                                <?php if($harga['id'] == $data['harga']){ echo 'selected'; } ?>
                                    <option value="<?php echo $harga['id'] ?>" <?php if($harga['id'] == (int) $data['harga']){ echo 'selected'; } ?>><?php echo $harga['range_kriteria'] ?></option>
                                <?php }  ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="photo_lama" value="<?php echo $data['photo'] ?>">
                            <label>Photo<b class="text-danger small"> boleh kosong</b></label>
                            <input type="file" name="photo" placeholder="Input foto" class="form-control">
                        </div>
                        <div class="form-group">
                            <a href="?page=alternatif" class="btn btn-danger btn-sm">Batal</a>
                            <button type="submit" name="edit" class="btn btn-success btn-sm">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>