<?php
  include('../../config/database.php');
  include('../../assets/header.php');
  include('../../assets/navbar.php');
  @session_start();
  if($_SESSION['username']==''){
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
  <div class="card">
    <div class="card-header">
      <h4 class="fw-bold">Masyarakat</h4>
    </div>
    <div class="card-body">
    <table class="table table-dark table-striped">
      <thead>
        <tr>
          <th>NIK</th>
          <th>Nama</th>
          <th>Username</th>
          <th>Telp</th>
          <th>Status</th>
          <?php
            if($_SESSION['level']=='admin' || $_SESSION['level'] == 'petugas'){
              ?>
                <th scope="col">Tindakan</th>
              <?php
            }
          ?>
        </tr>
      </thead>
      <tbody >
        <?php
          $q = mysqli_query($con,"SELECT * FROM masyarakat WHERE verif = '1'");
          while($o = mysqli_fetch_object($q)){
            ?> 
              <tr>
                <td><?= $o -> nik ?></td>
                <td><?= $o -> nama ?></td>
                <td><?= $o -> username ?></td>
                <td><?= $o -> telp ?></td>
                <td>
                  <form action="" method="post">                    
                    <button class="btn btn-primary">Close</i></button>
                    <button class="btn btn-primary">Save changes</button>
                  </form>
                </td>
                <?php 
                  if($_SESSION['level']=='admin' || $_SESSION['level'] == 'petugas'){
                    ?> 
                      <td>
                        <form action="" method="post">
                          <input type="hidden" name="nik" value="<?= $o -> nik ?>">
                          <button class="btn btn-primary"><i class="fas fa-trash"></i></button>
                          <button class="btn btn-primary"><i class="fas fa-pen"></i></button>
                        </form>
                      </td>
                    <?php
                  }
                ?>
              </tr>
            <?php
          }
        ?>
      </tbody>
    </table>
    </div>
  </div>
</body>