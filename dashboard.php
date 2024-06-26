<?php 
require_once("lib/config.php"); 
require_once('lib/restricted.php');
// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}
if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session variables
  $_SESSION['id_admin'] = NULL;
  unset($_SESSION['id_admin']);
  session_destroy();
  ?><script language="javascript"> document.location.href='index.php' </script><?php  
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard - Least Square</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <script type="text/javascript" src="js/jquery-1.4.js"></script>
    
    <!-- Untuk memunculkan harga otomatis -->
    <script type="text/javascript">
    $(document).ready(function() {
		$("#barang").change(function() {
			var id_barang=$(this).val();
			$.ajax({
			 type:"POST",
			 url:"lib/auto_hrg.php",
			 data:"id_barang=" + id_barang,
			 success: function(data) {
			 	$("#harga").val(data);
			 }
			});
		});
	});
    </script>
    <!-- Untuk memunculkan pajak otomatis -->
    <script type="text/javascript">
    $(document).ready(function() {
		$("#qty").click(function() {
			var harga=$("#harga").val();
			$.ajax({
			 type:"POST",
			 url:"lib/auto_pajak.php",
			 data:"harga=" + harga,
			 success: function(data) {
			 	$("#pajak").val(data);
			 }
			});
		});
	});
    </script>
    
    <!-- Untuk memunculkan total otomatis -->
    <script type="text/javascript">
    $(document).ready(function() {
		$("#qty").blur(function() {
			var qty=$(this).val();
			var harga=$("#harga").val();
			var pajak=$("#pajak").val();
			$.ajax({
			 type:"POST",
			 url:"lib/auto_total.php",
			 data:"harga=" + harga + "&qty=" + qty + "&pajak=" + pajak,
			 success: function(data) {
			 	$("#total").val(data);
			 }
			});
		});
	});
    </script>
    
  </head>

  <body>

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="dashboard.php">Dashboard</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li <?php if ((isset($_GET['page']))&&($_GET['page']=="welcome")) {echo "class=active";}?>><a href="?page=welcome"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li <?php if ((isset($_GET['page']))&&($_GET['page']=="karyawan")) {echo "class=active";}?>><a href="?page=karyawan"><i class="fa fa-bar-chart-o"></i> Data Karyawan</a></li>
            <li <?php if ((isset($_GET['page']))&&($_GET['page']=="barang")) {echo "class=active";}?>><a href="?page=barang"><i class="fa fa-table"></i> Data barang</a></li>
            <li <?php if ((isset($_GET['page']))&&($_GET['page']=="supplier")) {echo "class=active";}?>><a href="?page=supplier"><i class="fa fa-edit"></i> Data Supplier</a></li>            
            <li <?php if ((isset($_GET['page']))&&($_GET['page']=="peramalan")) {echo "class=active";}?>><a href="?page=peramalan"><i class="fa fa-desktop"></i> Peramalan</a></li>
            <li <?php if ((isset($_GET['page']))&&($_GET['page']=="pembelian")) {echo "class=active";}?>><a href="?page=pembelian"><i class="fa fa-file"></i> Perencanaan Pembelian</a></li>
         </ul>
          <ul class="nav navbar-nav navbar-right navbar-user">
           <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> User Menu<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="?page=profil"><i class="fa fa-user"></i> Profile</a></li>
                <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo $logoutAction ?>"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Peramalan Pengadaaan barang <small> Metode Least Square</small></h1>
           
          </div>
        </div><!-- /.row -->

        <div class="row">
          <div class="col-lg-12">
            <ol class="breadcrumb">
              <li class="active"><i class="fa fa-dashboard"></i>
                <?php if (isset($_GET['page'])) {echo "DATA ".strtoupper($_GET['page']);} else {echo "Halaman Kosong";} ?>
              </li>
            </ol>
            <div class="panel panel-primary">
              <?php 
			if (isset($_GET['page'])) {
				$get=htmlentities($_GET['page']);
				$page=$get.".php";
				$cek=strlen($page);
							
							if($cek<=0 || !file_exists($page) || empty($page)){
								echo "Halaman yang diminta tidak ada";
							}else{
								include ("$page");
								}
			}
			 else
			  {include ("welcome.php");}
							
			?>
            </div>
          </div>
        </div>
        <!-- /.row -->

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>


    <script src="js/morris/chart-data-morris.js"></script>
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    <script src="js/tablesorter/tables.js"></script>

  </body>
</html>
