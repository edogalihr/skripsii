<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['id_admin'])){ ?>
		<script language="javascript"> alert("Maaf, Silahkan Login Dahulu!");
		document.location.href='index.php'; </script>
	  <?php
	}
?>
