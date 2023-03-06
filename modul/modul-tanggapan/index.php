<?php
  include('../../config/database.php');
  include('../../assets/header.php');
  include('../../assets/navbar.php');
  @session_start();
  if(isset($_SESSION['username'])){
    true;
}else{
    @header('location:../modul-auth/');
}
?>

<?php
// hapus tanggapan
if (isset($_POST['hapusTanggapan'])) {
    $id_tanggapan = $_POST['id_tanggapan'];
    mysqli_query($con, "DELETE FROM `tanggapan` WHERE id_tanggapan = '$id_tanggapan'");
}
// update tanggapan
if (isset($_POST['ubahTanggapan'])) {
    $id_tanggapan =  $_POST['id_tanggapan'];
    $tgl_tanggapan = $_POST['tgl_tanggapan'];
    $tanggapan = $_POST['tanggapan'];
    mysqli_query($con, "UPDATE `tanggapan` SET tgl_tanggapan = '$tgl_tanggapan', tanggapan = '$tanggapan' WHERE `id_tanggapan` = '$id_tanggapan'");
}
?>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <p class="fs-4 fw-bold">Tanggapan</p>
            </div>
            <div class="card-body">
                <table class="table table-dark table-striped table-hover mt-3">
                    <tr>
                        <th scope="col">ID Tanggapan</th>
                        <th scope="col">ID Pengaduan</th>
                        <th scope="col">Tgl Tanggapan</th>
                        <th scope="col">Tanggapan</th>
                        <th scope="col">ID Petugas</th>
                    </tr>
                    <?php 
                    include('../../config/database.php');
                    $no = 1;
                    $q = mysqli_query($con, "SELECT * FROM tanggapan");
                    while($t = mysqli_fetch_object($q)){
                        ?>  
                            <tr>
                                <td><?= $t -> id_tanggapan ?></td>
                                <td><?= $t -> id_pengaduan ?></td>
                                <td><?= $t -> tgl_tanggapan ?></td>
                                <td><?= $t -> tanggapan ?></td>
                                <td><?= $t -> id_petugas ?></td>
                            </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>