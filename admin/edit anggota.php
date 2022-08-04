<?php 
  include('../include/koneksi.php');
  include('include/akses admin.php'); 
?>

<!DOCTYPE html>
<html>
<title>KAS-Edit Anggota</title>
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
    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-user"></i><b><font face="Andalus"> Edit</font></b></span>
    <div class="w3-container">
    <span class="w3-hide-small"><h1><b><font face="Andalus"><li class="fa fa-user"> Edit Anggota</li></font></b></h1></span>
    <div class="w3-section w3-bottombar w3-padding-16">
      <!--Garias-->
    </div>
    </div>
  </header>

   

<div class="w3-margin">

    <?php

      $id_anggota = $_GET['id_anggota']; 
      $cek = $koneksi->query("SELECT * FROM anggota WHERE id_anggota='$id_anggota'"); 
      if($cek->num_rows == 0){
        echo "";
      }else{
        $erow = $cek->fetch_assoc();
      }
      if(isset($_POST['simpan'])){
        $nama           = $_POST['nama'];
        $jenis_kelamin  = $_POST['jenis_kelamin'];
        $tempat_lahir   = $_POST['tempat_lahir'];
        $tanggal_lahir  = $_POST['tanggal_lahir'];
        $alamat         = $_POST['alamat'];
        
        $update = $koneksi->query("UPDATE anggota SET 
                                  nama='$nama',
                                  jenis_kelamin='$jenis_kelamin',
                                  tempat_lahir='$tempat_lahir',
                                  tanggal_lahir='$tanggal_lahir',
                                  alamat='$alamat'
                                  WHERE id_anggota='$id_anggota'") or die(mysqli_error()); 
        if($update){ 
          header("Location:data anggota.php");
        }else{ 
          echo $pesan  = '<div class="w3-margin"><div class="w3-panel w3-pale-red w3-leftbar w3-border-red"><p>Data gagal disimpan, silahkan coba lagi. Atau kembali ke <a href="data anggota.php"> -> Data Anggota. </a></p></div></div>';
        }
      }else{
        echo $pesan ='';
      }

    ?>


<form class="w3-container" method="POST" action="" enctype="multipart/form-data">
  
  <div class="w3-padding">&nbsp;</div>
  <div class="w3-card-2 w3-white w3-padding">
      <h2>Identitas</h2>
                
                
                <input class="w3-input" name="nama" type="text" value="<?php echo $erow['nama']; ?>" placeholder="Nama" required="">

                <select class="w3-input" name="jenis_kelamin">
                  <option value="<?php echo $erow['jenis_kelamin']; ?>"><?php echo $erow['jenis_kelamin']; ?></option>
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>

                  <div class="w3-col" style="width:49%">
                    <input class="w3-input" name="tempat_lahir" type="text" value="<?php echo $erow['tempat_lahir']; ?>" placeholder="Tempat Lahir" required="">
                  </div>
                <div class="w3-col" style="width:2%">&nbsp;</div>
                  <div class="w3-col" style="width:49%">
                    <input class="w3-input" name="tanggal_lahir" type="date" value="<?php echo $erow['tanggal_lahir']; ?>" placeholder="Tanggal Lahir" required="">
                  </div>
                <textarea class="w3-input" name="alamat" placeholder="alamat" required=""><?php echo $erow['alamat']; ?></textarea>
                <br>
                <div class="w3-col" style="width:49%">
                  <button class="w3-input w3-border w3-button w3-white" type="submit" name="simpan">Simpan</button>
                </div>
                <div class="w3-col" style="width:2%">&nbsp;</div>
                  <div class="w3-col" style="width:49%">
                    <button class="w3-input w3-border w3-button w3-white" type="reset">Batal</button>
                  </div>
                  <br>
                  <br>
  </div>
  </form>
 
  </div>
 <br>
 <br>
 <br>

  <!-- Footer -->
  <footer class="w3-container w3-padding-27 w3-dark-grey">
  <div class="w3-row-padding">
    <div class="w3-third">
      <h3>TEAM 1</h3>
      <i class="fa fa-envelope w3-text-light-grey"></i> &nbsp; email@gmail.com<br>
      <i class="fa fa-phone w3-text-light-grey"></i> &nbsp; 03166XXXXXXXX
    </div>
  
    <div class="w3-third">
      <h3>TEAM 2</h3>
      <i class="fa fa-envelope w3-text-light-grey"></i> &nbsp; emai@gmail.com<br>
      <i class="fa fa-phone w3-text-light-grey"></i> &nbsp; 03166XXXXXXXX
    </div>

    <div class="w3-third">
      <h3>TEAM 3</h3>
      <i class="fa fa-envelope w3-text-light-grey"></i> &nbsp; email@gmail.com<br>
      <i class="fa fa-phone w3-text-light-grey"></i> &nbsp; 03166XXXXXXXX
    </div>
  </div>
  </footer>
  
  <div class="w3-black w3-center w3-padding-22">Powered by Codei Chanel | &copy; 2020</div>
<!-- End page content -->
</div>
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
