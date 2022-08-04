<?php 
  include('../include/koneksi.php'); 
  include('include/akses admin.php');
?>


<!DOCTYPE html>
<html>
<title>KAS-Pemasukan</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="../css/w3.css">
<link rel="stylesheet" href="../css/font-awesome.min.css">
<link rel="shortcut icon" href="../KUNING.png" type="image/x-icon" />
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Adobe Fan Heiti Std B", sans-serif}


/* latin-ext */
@font-face {
  font-family: 'Raleway';
  font-style: normal;
  font-weight: 400;
  src: local('Raleway'), local('Raleway-Regular'), url(https://fonts.gstatic.com/s/raleway/v12/1Ptug8zYS_SKggPNyCMIT5lu.woff2) format('woff2');
  unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
  font-family: 'Raleway';
  font-style: normal;
  font-weight: 400;
  src: local('Raleway'), local('Raleway-Regular'), url(https://fonts.gstatic.com/s/raleway/v12/1Ptug8zYS_SKggPNyC0ITw.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}

table, td, th {    
    border: 1px solid #ddd;
    text-align: left;
}

table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    padding: 15px;
}
.a, a:hover{text-decoration: none;}
</style>
<body class="w3-light-grey w3-content" style="max-width:1600px">
<?php
        $username = $_SESSION['username'];
      
        $cek = $koneksi->query("SELECT * FROM user WHERE username='$username'"); 
        if($cek->num_rows == 0){
          header("Location:../index.php");
        }else{
          $row = $cek->fetch_assoc();
        }
    ?>
<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>

  <a href="#" onclick="w3_close()" class="w3-button w3-display-topright w3-xlarge w3-hide-large">X</a>

    <div class="w3-padding-large w3-center">
      <img class="w3-circle" src="foto/<?php echo $row['foto']; ?>" style="width:100px; height:100px;" alt="avatar">
   </div>
   <div class="w3-hover-opacity">
     <h4><center><a href="profile.php" class="a"><?php echo strtoupper($row['nama']); ?></a></center></h4>
   </div>
   <hr>

  <div class="w3-bar-block">
    <a href="index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-home fa-fw w3-margin-right"></i>Home</a>
    <a href="pembayaran.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Pembayaran</a> 
    <a href="pemasukan.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-money fa-fw w3-margin-right"></i>Pemasukan</a> 
    <a href="pengeluaran.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-money fa-fw w3-margin-right"></i>Pengeluaran</a>
    <a href="data anggota.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw w3-margin-right"></i>Data Anggota</a>
    <a href="../logout.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-lock fa-fw w3-margin-right"></i>Logout</a>
  </div>
  <div class="w3-panel w3-large">
    <i class="fa fa-facebook w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>
  </div>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">

  <!-- Header -->
  <header id="portfolio">
    <a href="#"><img src="foto/<?php echo $row['foto']; ?>" style="width:40px; height:40px;" class="w3-circle w3-right w3-margin w3-hide-large w3-hover-opacity"></a>
    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-home"></i><b><font face="Andalus"> Masuk</font></b></span>
    <div class="w3-container">
    <span class="w3-hide-small"><h1><b><font face="Andalus"><li class="fa fa-money"> Pemasukan</li></font></b></h1></span>
     <br>
      <form action="" method="get">
          <div class="w3-third">
            <input class="w3-input w3-border-0" type="text" name="cari" placeholder="cari data disini.......">
          </div>
          <div class="w3-third">
            <button type="submit" class="w3-button w3-white w3-hide-small"><i class="fa fa-search w3-margin-right"></i>Cari</button>
          </div>
      </form>
      <div class="w3-section w3-bottombar w3-padding-16"></div>
    </div>
  </header>
  
  <?php
      if(isset($_GET['aksi']) == 'delete'){ 
        $id_iuran = $_GET['id_iuran']; 
        $cek = $koneksi->query("SELECT * FROM iuran WHERE id_iuran='$id_iuran'"); 
        if($cek->num_rows == 0){ 
          $pesan = ''; 
        }else{
          
          $delete = $koneksi->query("DELETE FROM iuran WHERE id_iuran='$id_iuran'");
          if($delete){
            $pesan = '<div class="w3-margin"><div class="w3-panel w3-pale-green w3-leftbar w3-border-green"><p>Data Berhasil Di Hapus.</p></div></div>';
          }else{ 
            $pesan = '<div class="w3-margin"><div class="w3-panel w3-pale-red w3-leftbar w3-border-red"><p>Ups, Data Gagal Di Hapus..!</p></div></div>';
          }
        }
      }else{
        $pesan = '';
      }
  ?>

  <?php echo $pesan; ?>
  <?php
      $perhalaman=10;
      $data=mysqli_query($koneksi, "select * from iuran natural join anggota");
      $jum=mysqli_num_rows($data);
      $halaman=ceil($jum/$perhalaman);
      $page=(isset($_GET['page']))?(int)$_GET['page']:1;
      $start=($page - 1) * $perhalaman;
  ?>


  <div class="w3-margin">
  <div class="w3-container w3-white w3-card-1">
    <div class="w3-responsive">
      <br>
      <table>
        <tr class="w3-light-grey">
          <th>No</th>
          <th>Nama</th>
          <th>Bulan</th>
          <th>Tanggal Bayar</th>
          <th>Nominal</th>
          <th>Opsi</th>
        </tr>
  <?php 
    if(isset($_GET['cari'])){
        $cari=$_GET['cari'];
        $tampil=$koneksi->query("SELECT*FROM anggota NATURAL JOIN iuran WHERE nama like '%".$cari."%' or npm like '%".$cari."' or bulan like '%".$cari."%' or tanggal_bayar like '%".$cari."%' or nominal like '%".$cari."%' ORDER BY nama") or die($koneksi->error._LINE_);;
          if($tampil->num_rows == 0){
            echo '';
          }else{
            $tampil=$koneksi->query("SELECT*FROM anggota NATURAL JOIN iuran WHERE nama like '%".$cari."%' or npm like '%".$cari."' or bulan like '%".$cari."%' or tanggal_bayar like '%".$cari."%' or nominal like '%".$cari."%' ORDER BY nama");
          }
    }else{    
      $tampil=$koneksi->query("SELECT*FROM anggota NATURAL JOIN iuran LIMIT $start,$perhalaman");
      } 
      if($tampil->num_rows == 0){
        echo '<tr>
            <th colspan="9"><center>Tidak ada data masukan saat ini.</center></th>
           </tr>';
      }else{

        $jml=0;
        $no = 1;
        while($row = $tampil->fetch_assoc()){
          extract($row)
  ?>
  <?php
      $jml +=$row['nominal'];
  ?>
  <?php
    echo '<tr>
            <th scope="row">'.$no.'</th>
            <td>'.$row['nama'].'</td>
            <td>'.$row['bulan'].'</td>
            <td>'.$row['tanggal_bayar'].'</td>
            <td>Rp. '.$row['nominal'].'</td>
            <td>
              <div class="w3-col" style="width:100%">
              <a href="pemasukan.php?aksi=delete&id_iuran='.$row['id_iuran'].'" onclick="return confirm(\'Anda yakin akan menghapus data '.$row['tanggal_bayar'].'?\')" class="w3-input w3-border w3-button w3-white">Hapus</a>
              </div>
            </td>
          </tr>';
          $no++;
        }
    echo '<tr>
            <td colspan="4"><center><b>Jumlah</b></center></td>
            <td colspan="2"><b>Rp. '.$jml.'.00,-</b></td>
          </tr>';
              
      }
  echo'</table>
                            
        <br>    
        <div class="w3-center">
          <div class="w3-bar w3-border">';
            if ($page>1) { 
              echo' <a href="?page='; echo $page - 1; echo '" class="w3-bar-item w3-button w3-hover-black"><span aria-hidden="true">&laquo;</span>
                    </a>';
            }else{
              echo '<div class="w3-bar-item w3-button w3-hover-block"><span aria-hidden="true">&laquo;</span></div>';
            }
            for ($x=1; $x<=$halaman ; $x++) {
              if ($page==$x) {
                  $ini="w3-bar-item w3-black";
              }else{
                  $ini="w3-bar-item w3-button w3-hover-black";
              }
              echo'<a href="?page='; echo "$x"; echo'"'; echo 'class="'; echo $ini; echo '">'; echo "$x"; echo'</a>';
            }
            if ($page<$x-1) {
              echo' <a href="?page='; echo $page + 1; echo'" aria-label="Next" class="w3-bar-item w3-button w3-hover-black">
                  <span aria-hidden="true">&raquo;</span>
                    </a>';
            }else{
               echo' <div class="w3-bar-item w3-button w3-hover-block"><span aria-hidden="true">&raquo;</span></div>';
            }
  echo '  </div>
        </div>
      </div>';
      
  ?> 
      <br>
        </div>
      </div>
<br>
  <!-- Footer -->
  <footer class="w3-container w3-padding-24 w3-dark-grey">
  <div class="w3-row-padding">
    <div class="w3-third">
      <h3>BENDAHARA</h3>
      <i class="fa fa-envelope w3-text-light-grey"></i> &nbsp; email@gmail.com<br>
      <i class="fa fa-phone w3-text-light-grey"></i> &nbsp; 03166XXXXXXXX
    </div>
  
    <div class="w3-third">
      <h3>WALI KELAS</h3>
      <i class="fa fa-envelope w3-text-light-grey"></i> &nbsp; email@hmail.com<br>
      <i class="fa fa-phone w3-text-light-grey"></i> &nbsp; 03166XXXXXXXX
    </div>

    <div class="w3-third">
      <h3>BENDAHARA</h3>
      <i class="fa fa-envelope w3-text-light-grey"></i> &nbsp; email@gmail.com<br>
      <i class="fa fa-phone w3-text-light-grey"></i> &nbsp; 03166XXXXXXXX
    </div>
  </div>
  </footer>

</div>

<script>
// Script to open and close sidebar
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}
</script>

</body>
</html>
