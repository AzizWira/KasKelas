<?php 
  include('include/koneksi.php');
  include("include/akses anggota.php"); 
?>

<!DOCTYPE html>
<html>
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">
<link rel="shortcut icon" href="KUNING.png" type="image/x-icon" />
<body >

<?php
	if(isset($_POST['login'])){
		$user = mysqli_real_escape_string($koneksi, htmlentities($_POST['username']));
		$pass = mysqli_real_escape_string($koneksi, htmlentities(md5($_POST['password'])));

		$sql = mysqli_query($koneksi, "SELECT * FROM anggota WHERE username='$user' AND password='$pass'") or die(mysqli_error($koneksi));
		if(mysqli_num_rows($sql) == 0){
			echo '<center><span class="label label-danger">User tidak ditemukan</span></center>';
		}else{
			$row = mysqli_fetch_assoc($sql);
			if($row){
				$_SESSION['username']=$user;
				echo '<script language="javascript">document.location="anggota/index.php";</script>';
			}else{
				echo '<center><div class="alert alert-danger">Upss...!!! Login gagal.</div></center>';
			}
		}
	}
	?>


<div class="w3-margin" style="padding: 50px 470px;">
  <div class="w3-card-4 w3-margin" style="width: 100%;" >
	<div class="w3-container w3-light-grey">
		<h2>Please login</h2>
	</div>
	<form class="w3-container" method="POST" action="">
		<p>
			<input class="w3-input" type="text" name="username" placeholder="Username">
		</p>
		<p>     
			<input class="w3-input" type="password" name="password" placeholder="Password">
		</p>
		<div>
			<button type="submit" class="w3-input w3-border w3-button w3-white" name="login">Masuk</button>
			<br>
		</div>
	</form>
	<div class="w3-container w3-light-grey">
		<p><font size="2">Lupa password ? &nbsp; <a href="#">klik disini</a></font></p> 
	</div>
  </div>
</div>
</body>

<!-- Mirrored from www.w3schools.com/w3css/tryit.asp?filename=tryw3css_cards_buttons2 by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 13 Mar 2016 11:04:48 GMT -->
</html> 