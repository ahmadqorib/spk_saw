<?php  
    include ("../controller/KriteriaController.php");
    include ("../constants/AtributeKriteria.php");
    include ("../constants/Kriteria.php");
    $kriteria = new KriteriaController();

    if(isset($_POST['simpan'])){
        $kriteria->store();
    }
?>
<div class="bg-light shadow rounded">
    <div class="row"> 
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post">
                        <div class="py-1">
                            <h5 class="card-title">Tambah Kriteria</h5>
                        </div>
                        <div class="form-group">
                            <label>Kode<b class="text-danger">*</b></label>
                            <input type="text" name="kode" required class="form-control" placeholder="Input kode kriteria" value="">
                        </div>
                        <div class="form-group">
                            <label>Kriteria<b class="text-danger">*</b></label>
                            <select name="kriteria" required class="form-control">
                                <?php 
                                    foreach(Kriteria::labels() as $k => $kr){
                                ?>
                                <option value="<?php echo $kr; ?>"><?php echo $k; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nilai<b class="text-danger">*</b></label>
                            <input type="text" name="nilai" required class="form-control" placeholder="Input nilai" value="">
                        </div>
                        <div class="form-group">
                            <label>Atribut<b class="text-danger">*</b></label>
                            <!-- <input type="text" name="kriteria" required class="form-control" placeholder="Input kriteria" value=""> -->
                            <select class="form-control select2bs4" name="atribut" required style="width: 100%;">
                                <?php foreach(AtributeKriteria::labels() as $item => $kri){ ?>
                                    <option value="<?php echo $kri ?> "><?php echo $item ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Keterangan<b class="text-danger small"> boleh kosong</b></label>
                            <textarea name="keterangan" id="" placeholder="Input keterangan" cols="30" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <a href="" class="btn btn-danger btn-sm">Batal</a>
                            <button type="submit" name="simpan" class="btn btn-success btn-sm">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>