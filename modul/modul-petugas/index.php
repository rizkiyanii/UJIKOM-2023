<?php
  include('../../config/database.php');
  include('../../assets/header.php');
  include('../../assets/navbar.php');
  @session_start();
  if($_SESSION['username']==''){
    @header('location:../modul-auth/');
  }
?>

<?php @session_start(); 
    include('../../config/database.php');
    // mencegah masyarakat untuk masuk
    if($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'petugas'){
        true;
    }else{
        @header('location:../modul-masyarakat/');
    }

    if(isset($_POST['hapus'])){
        $nik = $_POST['nik'];
        $q = mysqli_query($con, "DELETE FROM masyarakat WHERE nik = '$nik'");
    }

    if(isset($_POST['verif'])){
        $nik = $_POST['nik'];
        $q = mysqli_query($con, "UPDATE masyarakat SET verif = '1' WHERE nik = '$nik'");
    }
?>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <p class="fs-5 fw-bold">Menunggu Verifikasi</p>
            </div>
            <div class="card-body">
                <table class="table table-success table-striped table-hover mt-3">
                    <tr>
                        <th scope="col">NIK</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Username</th>
                        <th scope="col">No. Telepon</th>
                        <th colspan="2" scope="col">Verifikasi</th>
                    </tr>
                    <?php
                    include('../../config/database.php');
                    $no = 1;
                    $q = mysqli_query($con, "SELECT * FROM masyarakat WHERE verif = '0'");
                    while($m = mysqli_fetch_object($q)){
                    ?>
                    <tr>
                        <td><?= $m -> nik ?></td>
                        <td><?= $m -> nama ?></td>
                        <td><?= $m -> username ?></td>
                        <td><?= $m -> telp ?></td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="nik" value="<?= $m -> nik ?>"> <button class="btn btn-danger" name="hapus" id="hapus"> <i class="fa fas-ban"></i> </button>
                            </form>
                        </td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="nik" value="<?= $m -> nik ?>"><button class="btn btn-success" name="verif" id="verif"><i class="fas fa-check"></i></button>
                            </form>
                        </td>
                    </tr> 
                    <?php   
                }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>