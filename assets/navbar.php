<nav class="navbar navbar-dark navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">JENOMAS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../modul-masyarakat/"><i class="fas fa-users"></i> Masyarakat</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../modul-pengaduan/"><i class="fas fa-ellipsis-v "></i> Pengaduan</a>
        </li>

        <?php
            if($_SESSION['level'] == 'masyarakat'){
                ?> 
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-current="page" href="../modul-petugas/"><i class="fas fa-life-ring"></i> Petugas</a>
                    </li>
                <?php
            }else{
                ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../modul-petugas/"><i class="fas fa-life-ring"></i> Petugas</a>
                    </li>
                <?php
            }
        ?>

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../modul-tanggapan/"><i class="fas fa-reply"></i> Tanggapan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../modul-auth/logout.php"><i class="fas fa-lock"></i> Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>