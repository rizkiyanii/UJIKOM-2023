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

    if(isset($_SESSION['username'])){
        true;
    }else{
        @header('location:../modul-auth/');
    }

    if(isset($_POST['buat'])){
        $tgl = $_POST['tgl'];
        $nik = $_POST['nik'];
        $pengaduan = $_POST['pengaduan'];
        $foto = $_POST['foto'];

        $q = mysqli_query($con, "INSERT INTO pengaduan (`tgl_pengaduan`, `nik`, `isi_laporan`, `foto`) VALUES ('$tgl', '$nik', '$pengaduan', '$foto')");
    }

    if(isset($_POST['tanggap'])){
        $id_pengaduan = $_POST['id_pengaduan'];
        $tgl_tanggap = $_POST['tgl'];
        $tanggapan = $_POST['tanggapan'];
        $id_petugas = $_POST['idPetugas'];
        $status = $_POST['status'];

        $s = mysqli_query($con, "UPDATE pengaduan SET status = '$status' WHERE id_pengaduan = '$id_pengaduan'");
        $q = mysqli_query($con, "INSERT INTO tanggapan (id_pengaduan, tgl_tanggapan, tanggapan, id_petugas) VALUES ('$id_pengaduan', '$tgl_tanggap', '$tanggapan', '$id_petugas')");
    }
?>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <p class="fs-4 fw-bold">Pengaduan</p>
            </div>
            <div class="card-body">
                <table id="tabel_pengaduan" class="table table-dark table-striped table-hover mt-3">
                    <tr>
                        <th scope="col">ID Pengaduan</th>
                        <th scope="col">Tanggal Pengaduan</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Pengaduan</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Status</th>
                        <?php 
                            if($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'petugas'){
                                ?> 
                                    <th scope="col">Tindakan</th>
                                <?php
                            }
                        ?>
                    </tr>
                    <?php 
                    include('../../config/database.php');
                    $no = 1;
                    $q = mysqli_query($con, "SELECT * FROM pengaduan");
                    while($p = mysqli_fetch_object($q)){
                        ?> 
                            <tr>
                                <td><?= $p -> id_pengaduan ?></td>
                                <td><?= $p -> tgl_pengaduan ?></td>
                                <td><?= $p -> nik ?></td>
                                <td><?= $p -> isi_laporan ?></td>
                                    <?php 
                                        if(!empty($p -> foto)){
                                            ?> 
                                                <td><img src="../../assets/img/<?= $p -> foto ?>" style="width: 50px;"></td>
                                            <?php
                                        }else{
                                            ?> 
                                                <td><img src="../../assets/img/noimg.png" style="width: 150px;"></td>
                                            <?php
                                        }
                                    ?>
                                <td><?= $p -> status ?></td>
                                <?php 
                                    if($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'petugas'){
                                        ?> 
                                            <td>
                                                <a href="#beri-tanggapan" name="tanggapi" id="tanggapi" class="btn text-decoration-underline"><i class="fas fa-reply"></i>Tanggapi</a>
                                            </td>
                                        <?php
                                    }
                                ?>
                            </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>

            <?php 
            @session_start();
            if($_SESSION['level'] == 'masyarakat'){
                ?> 
                    <div class="card-footer">
                    <h5 class="fw-bold mb-5">Buat Pengaduan</h5>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="tgl" class="form-label">Tanggal Pengaduan</label>
                                <input type="date" class="form-control" id="tgl" name="tgl" required>
                            </div>
                            <div class="mb-3">
                                <label for="nik" class="form-label">NIK (terisi otomatis)</label>
                                <input type="text" readonly class="form-control-plaintext" id="nik" name="nik" value="<?= $_SESSION['nik'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="pengaduan" class="form-label">Hal yang ingin Dilaporkan</label>
                                <textarea class="form-control" id="pengaduan" name="pengaduan" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto</label>
                                <input type="file" class="form-control" id="foto" name="foto" placeholder="Gambar yang Berhubungan dengan Hal yang Dilaporkan" >
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-4">
                                    <button type="submit" class="btn w-100 text-white" name="buat" id="buat" style="background-color: darkcyan;">Buat Laporan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php
            }else{
                ?> 
                    <div class="card-footer" id="beri-tanggapan">
                        <h5 class="fw-bold mb-5">Beri Tanggapan</h5>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="id_pengaduan" class="mb-3">Pilih ID Pengaduan yang Ingin ditanggapi</label>
                                <select name="id_pengaduan" class="form-select" aria-label="Default select example">
                                    <?php
                                        include('../../configuration/koneksi.php'); 
                                        $q = mysqli_query($con, "SELECT * FROM pengaduan");
                                        while($o = mysqli_fetch_object($q)){
                                            ?> 
                                                <option value="<?= $o -> id_pengaduan ?>"><?= $o -> id_pengaduan ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tgl" class="form-label">Tanggal Tanggapan</label>
                                <input type="date" class="form-control" id="tgl" name="tgl" required>
                            </div>
                            <div class="mb-3">
                                <select name="status" id="status" class="form-select" aria-label="Default select example">
                                    <option value="proses">Diproses</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tanggapan" class="form-label">Tanggapan</label>
                                <textarea class="form-control" id="tanggapan" name="tanggapan" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="idPetugas" id="idPetugas" value="<?= $_SESSION['id_petugas'] ?>">
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-4">
                                    <button type="submit" class="btn w-100 text-white" name="tanggap" id="tanggap" style="background-color: darkcyan;">Kirim Tanggapan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php
            }
            ?>
        </div>
    </div>
</body>