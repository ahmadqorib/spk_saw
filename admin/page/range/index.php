<?php 
    include ("../controller/KriteriaController.php");
    include ("../controller/RangeKriteriaController.php");
    include ("../constants/Kriteria.php");

    $kriteria = new KriteriaController();
    $range = new RangeKriteriaController();

    if(isset($_POST['save'])){
        $range->store();
    }

    if(isset($_POST['update'])){
        $range->update($_GET['id']);
    }

    if(isset($_GET['action']) && $_GET['action']=="delete" && $_GET['page'] == "range_kriteria"){
        $range->delete($_GET['id']);
    }

    if(isset($_GET['action']) && $_GET['action']=="edit" && $_GET['page'] == "range_kriteria"){
        $edit = $range->edit($_GET['id']);
    }
?>

<div class="bg-light shadow rounded">
    <div class="row"> 
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="py-1">
                        <h5 class="card-title">Lihat Range Kriteria</h5>
                    </div>
                    <?php 
                        foreach($kriteria->getData() as $kri){
                    ?>
                        <h5 class="card-title"><?php echo Kriteria::label($kri['kriteria']) ?></h5>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Kriteria</th>
                                    <th>Keterangan Range</th>
                                    <th>Nilai Range</th>
                                    <th style="width: 80px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no = 0;
                                    foreach($range->getByKriteria($kri['kriteria']) as $data){
                                        $no++;
                                ?>
                                <tr>
                                    <td><?php echo $no.'.' ?></td>
                                    <td><?php echo Kriteria::label($data['kriteria']) ?></td>
                                    <td><?php echo $data['range_kriteria'] ?></td>
                                    <td><?php echo $data['nilai'] ?></td>
                                    <td>
                                        <a href="<?php echo $_SERVER['PHP_SELF'].'?page=range_kriteria&action=edit&id='.$data['id']; ?>" class="btn btn-sm btn-primary my-1">edit</a>
                                        <a href="<?php echo $_SERVER['PHP_SELF'].'?page=range_kriteria&action=delete&id='.$data['id']; ?>" onclick="return confirm('anda yakin akan menghapus data ?')" class="btn btn-sm btn-danger"> hapus</a>
                                    </td>
                                </tr>
                                    <?php } ?>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                <?php 
                    if(isset($_GET['action']) && $_GET['action']=="edit" && $_GET['page'] == "range_kriteria"){
                        include_once ("page/range/edit.php");
                    }else{
                        include_once ("page/range/create.php");
                    }
                ?>
                </div>
            </div>
        </div>
    </div>
</div>
