<?php
if (session_status() == PHP_SESSION_NONE) { // mengecek apakah session belum dimulai
    session_start(); // maka mulai session
}
if(!isset($_SESSION['username'])){ // jika session yg sedang berjalan bukan user
	echo '<script language="javascript">document.location="../index.php";</script>'; // maka diarahkan ke halaman login
}
?>