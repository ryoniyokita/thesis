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
        <a class="nav-link" href="halaman_penilai.php">
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
        <a class="nav-link collapsed" href="penilaianpnl.php" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-folder"></i>
          <span>Penilaian</span>
        </a>    
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="laporan.php" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-folder"></i>
          <span>Laporan</span>
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
                $profilee = "SELECT penilai.id_penilai, user.id_penilai, user.id_user
                  FROM penilai INNER JOIN user
                  ON penilai.id_penilai=user.id_penilai WHERE id_user='".@$sesi."'" or die(mysqli_error());
                $sqll = mysqli_query($koneksi, $profilee);
                $datab = mysqli_fetch_array($sqll);
                ?>
        <a class="nav-link collapsed" href="pengaturanpnl.php?id=<?php echo $datab['id_penilai']; ?>" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
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
      
     <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="assets/css/bootstrap.css"> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
  <link rel="stylesheet" href="assets/css/bootstrap.css"> 
  <script src="assets/js/jquery.js"></script> 
  <script src="assets/js/popper.js"></script> 
  <script src="assets/js/bootstrap.js"></script>

        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
          </form>
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Pencarian..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>
            <!-- Nav Webiste URL -->
            
            <div class="topbar-divider d-none d-sm-block"></div>
            <!-- Nav Item - User Information -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalfade">
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
                
                $profile = "SELECT * FROM user WHERE id_user ='".@$sesi."'" or die(mysqli_error());
                $sql = mysqli_query($koneksi, $profile);
                $data = mysqli_fetch_array($sql);
                ?>
<?php echo $data['nama'];?>
  
</button>
<div class="modal fade" id="modalfade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width="100%">
    <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Edit Profil</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
              <fieldset>
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
                
                $profile = "SELECT * FROM user WHERE id_user ='".@$sesi."'" or die(mysqli_error());
                $sql = mysqli_query($koneksi, $profile);
                $data = mysqli_fetch_array($sql);
                ?>
                <form action="update_pnl.php" method="post">
                  <table>
                    <tr>
                      <td>Username</td>
                      <td>:</td>
                      <td>
                        <input type="text" name="username" value="<?php echo $data['username'];?>" size="40" disabled>
                      </td>
                    </tr>
                    <tr>
                      <td>Nama</td>
                      <td>:</td>
                      <td><input type="hidden" name="id_user" value="<?php echo $data['id_user'];?>">
                      <input type="text" name="nama" value="<?php echo $data['nama'];?>" size="40"></td>
                    </tr>
                    <tr>
                      <td>Password</td>
                      <td>:</td>
                      <td>
                        <input type="password" name="password" value="<?php echo $data['password'];?>" size="40">
                      </td>
                    </tr>
                    <tr>
                    <td></td>
                    <td></td>
                      <td>
                      <input type="submit" value="Simpan" class="btn btn-primary">
                      </td>        
                  </table>
                </form>
              </fieldset>
          </div>
          <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="profile.php">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="profile-password.php">
                  <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                  Ubah Password
                </a>
              </div>
            </li>
          </ul>
        </nav>
      
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
  <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<div id="container" style="min-width: 310px; height: 400px; max-width:90%; margin: 0 auto"></div>
<script>
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Statistik Pegawai yang Berhasil Mencapai Target'
    },
    xAxis: { 
    //INI ADALAH UNTUK KOLOM KETERANGAN
        categories: [ 
            '2020', '2021', '2022'],
         title: {
            text: 'Tahun'
        },
        crosshair: true
    },
    yAxis: {
         
        title: {
            text: 'Jumlah'
        }
    },
     
    tooltip: {
        headerFormat: '<span style="font-size:8pt">{point.key}</span><table style="font-size:8pt">',
        pointFormat: '<tr><td style="color:{series.color};padding:0">Jml.: </td>' +
            '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.,
            borderWidth: 0
        }
    },
    series: [{
         colorByPoint: true,
       showInLegend: false,
        
        data: [
        <?php 
                include 'koneksi.php';
                $koneksi =mysqli_connect("localhost","root","","db_skp");
                    $d = mysqli_query($koneksi,"SELECT * FROM penilaian WHERE penilaian.target_capaian=penilaian.capaian AND periode='2021'");
                    echo mysqli_num_rows($d);
                    ?>,
        <?php 
                include 'koneksi.php';
                $koneksi =mysqli_connect("localhost","root","","db_skp");
                    $a = mysqli_query($koneksi,"SELECT * FROM penilaian WHERE penilaian.target_capaian=penilaian.capaian AND periode='2021'");
                    echo mysqli_num_rows($a);
                    ?>,
                    <?php 
                include 'koneksi.php';
                $koneksi =mysqli_connect("localhost","root","","db_skp");
                    $b = mysqli_query($koneksi,"SELECT * FROM penilaian WHERE penilaian.target_capaian=penilaian.capaian AND periode='2022'");
                    echo mysqli_num_rows($b);
                    ?>,] //INI ADALAH UNTUK JUMLAH
 
    },
    ]
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