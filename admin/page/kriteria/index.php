<?php 
    include ("../controller/KriteriaController.php");
    include ("../constants/AtributeKriteria.php");
    include ("../constants/Kriteria.php");
    $kriteria = new KriteriaController();
    $atributK = new AtributeKriteria();

    if(isset($_GET['action']) && $_GET['action'] == "delete"){
        $kriteria->delete($_GET['id']);
    }
?>
<div class="bg-light shadow rounded">
    <div class="row"> 
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="py-1">
                        <h5 class="card-title">Lihat Kriteria</h5>
                        <a href="<?php echo $_SERVER['PHP_SELF'].'?page=kriteria&action=tambah'; ?>" class="btn btn-success btn-sm">tambah</a>
                    </div>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="1%">#</th>
                                <th>Kode</th>
                                <th>Kriteria</th>
                                <th>Atribut</th>
                                <th>Nilai/Bobot</th>
                                <th>Keterangan</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach($kriteria->getData() as $i => $kriteria){
                            ?>
                            <tr>
                                <td><?php echo $i + 1 ?>.</td>
                                <td><?php echo $kriteria['kode'] ?></td>
                                <td><?php echo Kriteria::label($kriteria['kriteria']) ?></td>
                                <td><?php echo $atributK::label($kriteria['atribut']) ?></td>
                                <td><?php echo $kriteria['nilai'] ?></td>
                                <td><?php echo $kriteria['keterangan'] ?></td>
                                <td>
                                    <a href="<?php echo $_SERVER['PHP_SELF'].'?page=kriteria&action=delete&id='.$kriteria['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('anda yakin akan menghapus data ?')">hapus</a>
                                    <a href="<?php echo $_SERVER['PHP_SELF'].'?page=kriteria&action=edit&id='.$kriteria['id']; ?>" class="btn btn-sm btn-primary">edit</a>
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