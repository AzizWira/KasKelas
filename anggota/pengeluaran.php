<?php 
  include('../include/koneksi.php');
  include('include/akses anggota.php'); 
?>


<!DOCTYPE html>
<html>
<title>KAS-Pengeluaran</title>
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
.a, a:hover{ text-decoration: none;}
</style>
<body class="w3-light-grey w3-content" style="max-width:1600px">
      
      <?php
        $username = $_SESSION['username']; 
      
        $cek = $koneksi->query("SELECT * FROM anggota WHERE username='$username'");
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
    <a href="pemasukan.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-money fa-fw w3-margin-right"></i>Pemasukan</a> 
    <a href="pengeluaran.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-money fa-fw w3-margin-right"></i>Pengeluaran</a>
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
    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-home"></i><b><font face="Andalus"> Keluar</font></b></span>
    <div class="w3-container">
    <span class="w3-hide-small"><h1><b><font face="Andalus"><li class="fa fa-money"> Pengeluaran</li></font></b></h1></span>
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
      $perhalaman=10;
      $data=mysqli_query($koneksi, "select * from pengeluaran");
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
                <thead>
                  <tr>
                    <th>NIK</th>
                    <th colspan="2"><?php echo ''.$row['npm'].'';?></th>
                    <th><center>Total Dana</center></th>
                    <th><center>Total Pengeluaran</center></th>
                  </tr>
                  <tr>
                    <th>Nama</th>
                    <th colspan="2"><?php echo''.$row['nama'].'';?></th>
                    <th>
                    <?php
                      $tampil = mysqli_query($koneksi, "SELECT * FROM dana WHERE id_dana='0'");
                      if(mysqli_num_rows($tampil) == 0){
                        echo 'Rp. 0';
                      }else{
                      $rows = mysqli_fetch_assoc($tampil);
                        echo '<center>Rp. '.$rows['jumlah'].'.00,-</center>';
                      }
                    ?></th>
                    <th>
                    <?php
                      $tampil = mysqli_query($koneksi, "SELECT * FROM dana WHERE id_dana='0'");
                      if(mysqli_num_rows($tampil) == 0){
                        echo 'Rp. 0';
                      }else{
                      $rows = mysqli_fetch_assoc($tampil);
                        echo '<center>Rp. '.$rows['pengeluaran'].'.00,-</center>';
                      }
                    ?></th>
                  </tr>
                </thead>
                <thead>
                  <tr class="w3-light-grey">
                    <th>No</th>
                    <th>Tanggal</th>
                    <th colspan="2">Jenis</th>
                    <th>Nominal</th>
                  </tr>
                </thead>
              <tbody>
  <?php 
    if(isset($_GET['cari'])){
        $cari=$_GET['cari'];
        $tampil=$koneksi->query("select * from pengeluaran where jenis like '%".$cari."%' 
                                   or tanggal_keluar like '%".$cari."'
                                   or nominal like '%".$cari."%'
                                   ORDER BY tanggal_keluar") or die($koneksi->error._LINE_);
          if($tampil->num_rows == 0){
            echo '';
          }else{
            $tampil=$koneksi->query("select * from pengeluaran where jenis like '%".$cari."%'
                                       or tanggal_keluar like '%".$cari."'
                                         or nominal like '%".$cari."%'
                                       ORDER BY tanggal_keluar");
          }
      }else{    
        $tampil=$koneksi->query("select * from pengeluaran LIMIT $start,$perhalaman");
      }
      if($tampil->num_rows == 0){
        echo '<tr>
                <th colspan="9"><center>Tidak ada data pengeluaran dana saat ini.</center></th>
              </tr>';
      }else{
        $no = 1; 
        while($row = $tampil->fetch_assoc()){
          extract($row)
          ?>
          <?php
        echo ' <tr>
                  <th scope="row">'.$no.'</th>
                  <td>'.$row['tanggal_keluar'].'</td>
                  <td colspan="2">'.$row['jenis'].'</td>
                  <td>Rp. '.$row['nominal'].'</td>
                </tr>
              </tbody>';
            $no++;
          }
      }
      
      echo '</table>
             <br>
        <div class="w3-center">
          <div class="w3-bar w3-border">';
            if ($page>1) { 
                echo'<a href="?page='; echo $page - 1; echo '" class="w3-bar-item w3-button w3-hover-black"><span aria-hidden="true">&laquo;</span>
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
              echo'<a href="?page='; echo $page + 1; echo'" aria-label="Next" class="w3-bar-item w3-button w3-hover-black">
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

<!-- End page content -->
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

function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
 
        return false;
      return true;
    }
</script>

</body>
</html>
