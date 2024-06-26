<?php
//cek No IP komputer host
$ip=$_SERVER['REMOTE_ADDR'];
//lihat apakah user sudah melakukan peramalan
$query="SELECT * FROM tmp WHERE no_ip='$ip'";
$ramal=mysqli_query($conn,$qry) or die(mysqli_error($conn));
$row_ramal=mysqli_fetch_assoc($ramal);
$num_ramal=mysqli_num_rows($ramal);

if ((isset($_POST["aksi"])) && ($_POST["aksi"] == "cari")) {
  $tahun=$_POST['tahun'];
  $x=$_POST['x'];
  $qry_cari="SELECT SUM(stok) AS stok FROM barang WHERE DATE_FORMAT(tanggal,'%Y')='$tahun'"; //filter stok barang berdasarkan tahun
  $cari=mysqli_query($conn,$qry_cari) or die(mysqli_error($conn));
  $num_cari=mysqli_num_rows($cari);
  if ($num_cari>0) //apabila ketemu
   { $row_cari=mysqli_fetch_assoc($cari);
     $stok=$row_cari['stok'];} 
	 else {$stok=0;}
  //masukan data ke tb_tmp 
  $qry_add="INSERT INTO tmp VALUES ('','$ip','$tahun','$x','$stok')";
  $add=mysqli_query($conn,$qry_add) or die(mysqli_error($conn)); 
  ?><script language="javascript">document.location.href='?page=peramalan' </script> <?php
 } else if ((isset($_GET["aksi"])) && ($_GET["aksi"] == "del")) {
  $id=$_GET['id'];
  $qry_del="DELETE FROM tmp WHERE id_tmp='$id'";
  $del=mysqli_query($conn,$qry_del) or die(mysqli_error($conn));
  ?><script language="javascript">document.location.href='?page=peramalan' </script> <?php
 }
?>
<div class="row">
  <div class="col-lg-6">
  <h3>Input Rekapitulasi Stok</h3>
    <form role="form" method="post">
      <div class="form-group">
        <label>Tahun Ke-n</label>
        <input class="form-control" type="text" name="tahun">
        <p class="help-block">Format  <em>yyyy</em></p>
      </div>
      <div class="form-group">
        <label>X Tahun ke-n</label>
        <input class="form-control" type="text" name="x" />
      </div>
      <div class="form-group">
        <label></label>
      </div>
      <div class="form-group">
        <label></label>
      </div>
      <input type="submit" class="btn btn-primary" name="aksi" value="cari">
      <input type="reset" class="btn btn-default" onclick="self.history.back()" value="batal">
    </form>
  </div>
  <div class="col-lg-6">
  <h3>Pencarian Trend</h3>
  <div class="table-responsive">
  <table class="table table-bordered table-hover table-striped tablesorter">
    <thead>
      <tr>
        <th>No <i class="fa fa-sort"></i></th>
        <th>Tahun Y <i class="fa fa-sort"></i>          </th>
        <th>Stok <i class="fa fa-sort"></i></th>
        <th>X <i class="fa fa-sort"></i></th>
        <th>X^2 <i class="fa fa-sort"></i></th>
        <th>XY <i class="fa fa-sort"></i></th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
    <?php 
  $no=0; //inisialisasi awal
  $tot_penjualan=0;
  $tot_x=0;
  $tot_x2=0;
  $tot_xy=0;
   do { $no++;
  ?>
      <tr>
        <td><?php echo $no ?></td>
        <td><?php echo $row_ramal['tahun']; ?></td>
        <td><?php echo $row_ramal['stok']; ?></td>
        <td><?php echo $row_ramal['nilai_x']; ?></td>
        <td>
		<?php 
		$x2=$row_ramal['nilai_x']*$row_ramal['nilai_x']; 
		echo $x2;
		?>        </td>
        <td><?php 
		$xy=$row_ramal['stok']*$row_ramal['nilai_x']; 
		echo $xy;
		?></td>
        <td><a href="?page=peramalan&id=<?php echo $row_ramal['id_tmp'];?>&aksi=del" onclick="return confirm('Apakah Anda yakin menghapus data ini ?')"><button type="button" class="btn btn-danger">Delete</button>
        </a></td>
      </tr>
      <?php 
	    $tot_penjualan=$tot_penjualan+$row_ramal['stok']; //menghitung baris total
		$tot_x=$tot_x+$row_ramal['nilai_x'];
		$tot_x2=$tot_x2+$x2;
		$tot_xy=$tot_xy+$xy;
	  } while($row_ramal=mysqli_fetch_assoc($ramal));?>
      <tr>
        <td colspan="2"><div align="center"><strong>Total</strong></div></td>
        <td><?php echo $tot_penjualan;?></td>
        <td><?php echo $tot_x; ?></td>
        <td><?php echo $tot_x2; ?></td>
        <td><?php echo $tot_xy; ?></td>
        <td>&nbsp;</td>
      </tr>
      </tbody>
  </table>
</div>
  <?php  
  if ($num_ramal>0) {
	$a=$tot_penjualan/$num_ramal; //mencari nilai a dan b
	$b=$tot_xy/$tot_x2;
  } else {
     $a=0;
	 $b=0;
  }
?>
  Nilai a => <?php echo $tot_penjualan;?> : <?php echo $num_ramal;?> = <?php echo round($a,2);?> <br />
  Nilai b => <?php echo $tot_xy;?> : <?php echo $tot_x2;?> = <?php echo round($b,2);?>  
  <h4>Trend => Y = <?php echo round($a,2);?> + <?php echo round($b,2);?>X</h4>
  <form role="form" method="post" action="?page=hasil">
  <div class="form-group">
  <label>Tahun Depan </label>
  <input class="form-control" type="text" name="tahun" />
  </div>
  <div class="form-group">
  <label>nilai_X Tahun Depan </label>
  <input class="form-control" type="text" name="x_next" />
  <input type="hidden" value="<?php echo round($a,2);?>" name="a" />
  <input type="hidden" value="<?php echo round($b,2);?>" name="b" />
  </div>
  <input type="submit" class="btn btn-success" value="Prediksi">
  </form>
  </div>
</div>
<br><br>

