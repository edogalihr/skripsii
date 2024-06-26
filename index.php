<?php 
require_once('lib/config.php'); 
require_once('lib/antiinjection.php');
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}
if ((isset($_POST["login"])) && ($_POST["login"] == "LOGIN")) {
$user=anti_injection($_POST['username']);
$pass=anti_injection(md5($_POST['password']));
$query="SELECT * FROM admin WHERE username='$user' AND password='$pass'";
$login=mysqli_query($conn,$qry) or die(mysqli_error($conn));
$num_login=mysqli_num_rows($login);
if ($num_login>0) {
  $row_login=mysqli_fetch_assoc($login);
  $_SESSION['id_admin']=$row_login['id_admin'];
  ?><script language="javascript">document.location.href='dashboard.php'</script><?php
  }
else {
  session_destroy();
  ?><script language="javascript">alert("Login Gagal..!! Cek kembali");
			 document.location.href='index.php' </script><?php
  }
}
?>
<html>
<head>
    <title>.:Login:.</title>
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<body onLoad="document.postform.elements['username'].focus();">
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="19%" border="0" cellpadding="0" cellspacing="0" bordercolor="#99CC99" align="center">
<tr> 
	<td width="4%" align="right"><img src="images/kiri.jpg" width="13" height="31"></td>
	<td width="74%" bgcolor="#5686c6" ><div align="center"><strong><font face="verdana" size="2" color="#FFFFFF">Login Admin </font></strong></div></td>
	<td width="21%"><img src="images/kanan.jpg"></td>
</tr>
<tr>
	<td background="images/b-kiri.jpg">&nbsp; </td>
	<td>
	<table width="259" align="center">
		<tr><td width="251"><font face="verdana" size="2">&nbsp;
		</font>
		
		<form method="POST" name="postform">
		  <table width="251" height="101" border="0" align="center">
		  <tr valign="bottom">
			<td width="104" height="35"><font color="#666666" size="4" face="verdana">Username</font></td>
			  <td width="137"><font size="4" face="verdana">
				<input type="text" name="username" size="20" id="username">
			  </font></td>
		  </tr>
		  
		  <tr valign="top">
			<td height="34"><font color="#666666" size="4" face="verdana">Password</font></td>
			  <td><font size="4" face="verdana">
				<input type="password" name="password" size="20">
			  </font></td>
		  </tr>
		  
		  <tr>
		  	<td>&nbsp;</td>
		  	<td><font size="4" face="verdana">
				<input type="submit" value="LOGIN" name="login">
			  </font></td>
		  </tr>
		  </table>
		</form>
		
				
		</td></tr>
	</table>
	</td>
	<td background="images/b-kanan.jpg">&nbsp;</td>
	<td width="1%"></td>
</tr>
<tr> 
	<td align="right"><img src="images/kib.jpg"></td>
	<td bgcolor="#5686c6" ><div align="center"><font face="verdana" size="2" color="#FFFFFF"><strong>Copyright &copy; <?php echo date("Y"); ?></strong> </font></div></td>
	<td><img src="images/kab.jpg"></td>
</tr>
</table>
</body>
</html>