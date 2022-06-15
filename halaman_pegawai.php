<?php 
session_start();
 
  // cek apakah yang mengakses halaman ini sudah login
  if($_SESSION['level']==""){
    header("location:index.php?pesan=gagal");
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
<head>
    <title>SKP Badan Pusat Statistik Bali</title>
    <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body id="page-top">

<!-- Page Wrapper -->
  <div id="wrapper">
<!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-folder"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SKP</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="halaman_pegawai.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Beranda</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Fitur Utama
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="kegiatan.php" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-folder"></i>
          <span>Rincian Pekerjaan</span>
        </a>    
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="target.php" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-folder"></i>
          <span>Target Kegiatan</span>
        </a>    
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="buku_harian.php" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-folder"></i>
          <span>Buku Harian</span>
        </a>    
      </li>
      <li class="nav-item">
        <?php
                include 'koneksi.php';
                $koneksi =mysqli_connect("localhost","root","","db_skp");
                if(@$_SESSION['admin']){
                  @$sesi = $_SESSION['admin'];
                }else if(@$_SESSION['pegawai']){
                  @$sesi = $_SESSION['pegawai'];
                }else if(@$_SESSION['penilai']){
                  @$sesi = $_SESSION['penilai'];
                }
                $koneksi =mysqli_connect("localhost","root","","db_skp");
                $profile = "SELECT penilaian.pegawai, user.id_pegawai, penilaian.pk
                  FROM penilaian INNER JOIN user
                  ON penilaian.pegawai=user.id_pegawai WHERE id_user='".@$sesi."'" or die(mysqli_error());
                $sql = mysqli_query($koneksi, $profile);
                $data = mysqli_fetch_array($sql);
                ?>
        <a class="nav-link collapsed" href="penilaianpgw.php?id=<?php echo $data['id_pegawai']; ?>" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-folder"></i>
          <span>Penilaian</span>
        </a>    
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="pengaturanpgw.php" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-folder"></i>
          <span>Data Diri</span>
        </a>    
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

    

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="logout.php">
          <i class="fas fa-arrow-right"></i>
          <span>Logout</span></a>
      </li>

    </ul>
    <!-- End of Sidebar -->    
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">
      
      <?php include "topbar.php";?>
      
       <!-- Begin Page Content -->
        <div class="container-fluid">
         <!-- Page Heading -->
           <div class="d-sm-flex align-items-center justify-content-between mb-4">
             <h1 class="h3 mb-0 text-gray-800"></h1>
           </div>
            
            <!-- Content Row -->
          <div class="row">
          <!-- Greeting -->
            <div class="col-lg-12">
            <?php
                include 'koneksi.php';
                $koneksi =mysqli_connect("localhost","root","","db_skp");
                $profile = "SELECT * FROM admin WHERE iduser" or die(mysqli_error());
                $sql = mysqli_query($koneksi, $profile);
                $data = mysqli_fetch_array($sql);
                ?>
  <div class="card" style="width: 18rem;">
  <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
    <span class="visually-hidden"></span>
  </span>
  <div class="card-body">
    <h5 class="card-title"><?php echo $data['keterangan'];?></h5>
    <p class="card-text"></p>
  </div>
  </div>
  <br>
  <script src="Chart.js"></script>
  <canvas id="myChart"></canvas>
    <?php
    $kon = mysqli_connect("localhost","root","","db_skp");
    //Query untuk menampilkan tabel mahasiswa1
        $nama_jurusan1= "";
        $jumlah1=null;
        $data_barang = mysqli_query($koneksi,"SELECT * FROM target WHERE id ='".@$sesi."' AND periode='".date("Y")."'");
                $jumlah_barang = mysqli_num_rows($data_barang);
        $sql="SELECT target.periode, SUM((((buku_harian.kuantitas_/target.kuantitas*100)+(buku_harian.kualitas_/target.kualitas*100)+((1.76 * target.waktu)-buku_harian.waktu_)/target.waktu*100)/3)/$jumlah_barang) as capaian, SUM((((target.kuantitas/target.kuantitas*100)+(target.kualitas/target.kualitas*100)+((1.76 * target.waktu)-target.waktu)/target.waktu*100)/3)/$jumlah_barang) as capaian_t
                  FROM target INNER JOIN buku_harian
                  ON target.kegiatan=buku_harian.keg WHERE user ='".@$sesi."' GROUP BY periode" or die(mysqli_error());

    $hasil=mysqli_query($kon,$sql);

    while ($data = mysqli_fetch_array($hasil)) {
        $jur1=$data['periode'];
        $nama_jurusan1 .= "'$jur1'". ", ";

        $jum1=$data['capaian_t'];
        $jumlah1 .= "$jum1". ", ";
    }
    //Query untuk menampilkan tabel mahasiswa2
    $nama_jurusan2= "";
    $jumlah2=null;
$data_barang = mysqli_query($koneksi,"SELECT * FROM target WHERE id ='".@$sesi."' AND periode='".date("Y")."'");
                $jumlah_barang = mysqli_num_rows($data_barang);
        $sql="SELECT target.periode, SUM((((buku_harian.kuantitas_/target.kuantitas*100)+(buku_harian.kualitas_/target.kualitas*100)+((1.76 * target.waktu)-buku_harian.waktu_)/target.waktu*100)/3)/$jumlah_barang) as capaian, SUM((((target.kuantitas/target.kuantitas*100)+(target.kualitas/target.kualitas*100)+((1.76 * target.waktu)-target.waktu)/target.waktu*100)/3)/$jumlah_barang) as capaian_t
                  FROM target INNER JOIN buku_harian
                  ON target.kegiatan=buku_harian.keg WHERE user ='".@$sesi."' GROUP BY periode" or die(mysqli_error());

    $hasil=mysqli_query($kon,$sql);

    while ($data = mysqli_fetch_array($hasil)) {
        $jur2=$data['periode'];
        $nama_jurusan2 .= "'$jur2'". ", ";

        $jum2=$data['capaian'];
        $jumlah2 .= "$jum2". ", ";
         }
    ?>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: [<?php echo $nama_jurusan1; ?>],
            datasets: [{
                label:'Target Capaian',
                backgroundColor: ['rgb(255, 99, 132)', 'rgba(56, 86, 255, 0.87)', 'rgb(60, 179, 113)','rgb(175, 238, 239)'],
                borderColor: ['rgb(255, 99, 132)'],
                data: [<?php echo $jumlah1; ?>]
            },
                {
                    label:'Realisasi Capaian',
                    backgroundColor: ['rgb(190, 99, 132)', 'rgba(56, 86, 255, 0.87)', 'rgb(60, 179, 113)','rgb(175, 238, 239)'],
                    borderColor: ['rgb(255, 99, 132)'],
                    data: [<?php echo $jumlah2; ?>]
                },

            ]
        },

        // Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
</script>
            </div>
          </div>
          <!-- End Content Row -->
          
        </div>
         <!-- End Page Content -->
      </div>
      <!-- End Content Wrapper -->
     <?php include "footer.php";?>

    </div>
    <!-- End Main Content -->
    </div>
    
</body>
</html>