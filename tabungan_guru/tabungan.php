<?php 
	include "config/koneksi.php";
	include "fungsi/fungsi.php";
  $aksi=$_GET['aksi'];
?>
<head>
<script src="jquery.js"></script>

<script type="text/javascript">
      $(document).ready(function() {
        $("#cari").keyup(function(){
        $("#fbody").find("tr").hide();
        var data = this.value.split("");
        var jo = $("#fbody").find("tr");
        $.each(data, function(i, v)
        {
              jo = jo.filter("*:contains('"+v+"')");
        });
          jo.fadeIn();

        })
  });

</script>

</head>
<?php
if(empty($aksi))
{
    $ghu=mysql_query("SELECT * FROM tb_tabungan");
$no=1;
while($dataku=mysql_fetch_array($ghu))
{
  $fgh=$dataku['tgl_mulai'];$tang=date("Y-m-d");$kode_tab=$dataku['kode_tabungan'];
  $tempo=date('Y-m-d',strtotime('+30 day',strtotime($fgh)));
  if($tempo==$tang)
  {
    $total=$dataku['besar_tabungan'];
    $tol=mysql_query("UPDATE tb_tabungan set tgl_mulai='$tang',besar_tabungan='$total' where kode_tabungan='$kode_tab'");
  }
  else
  {
    
  }
  $no++;
}
?>
<script language="javascript" type="text/javascript" src="js/niceforms.js"></script>
<script language="javascript" type="text/javascript" src="js/validasi.js"></script>
<link rel="stylesheet" type="text/css" href="css/theme1.css" />

</head>
<body>  
<div class="row mt">
 <div class="col-lg-12">
  <div class="form-panel">
   <h2 class="mb" align="center"> Data Tabungan Guru
         <span style="float:right;"><input type="text" id="cari" style="width:230px;height:30px;font-size:15px;" placeholder=" cari ">
  </h2>
 <form class="form-inline" role="form">
  <table class="table table-bordered table-striped table-condensed">
    <thead>
		<tr>
             <th>No</th>
             <th>Kode Tabungan</th>
             <th>NIP</th>
             <th>Nama Guru</th>
             <th>Jumlah Saldo</th>
              <th>Aksi</th>
	
       	</tr>
		
    </thead>
    <tbody id="fbody">
<?php
$page = (isset($_GET['page']))? (int) $_GET['page'] : 1;
      
      // Jumlah data per halaman
      $limit = 5;

      $limitStart = ($page - 1) * $limit;
                
          $query = mysql_query( "SELECT * FROM tb_tabungan LIMIT ".$limitStart.",".$limit);
      
      $no = $limitStart + 1;
	while($data=mysql_fetch_array($query)){
?>
    
    	<tr>
			<td><?php echo $no;?></td>
            <td><?php echo $data['kode_tabungan'];echo'</td>
            <td>';echo $d=$data['nip'];echo'</td>';
            $d=$data['nip'];$f=mysql_fetch_array(mysql_query("SELECT nama_guru from tb_guru where nip='$d'")); 
            $rty=mysql_fetch_array(mysql_query("SELECT sum(besar_tabungan) as total_asli from tb_tabungan where nip='$d'")); 
            $inves=$data['besar_tabungan']-$rty['total_asli'];?>
            <td><?php echo $f['nama_guru'];?></td>
            <td>Rp. <?php echo Rp($data['besar_tabungan']);?></td> 
            <td><a class="btn btn-danger btn-xs" href="index.php?pilih=1.3&aksi=viewambil&kode_tabungan=<?php echo $data['kode_tabungan'];?>&nip=<?php echo $d;?>"> Ambil Uang</a>
              <a class="btn btn-warning btn-xs" href="index.php?pilih=1.3&aksi=simpananguru&nip=<?php echo $data['nip'];?>&nip=<?php echo $d;?>">Simpan Uang</a>
            </td>
        </tr> 
	   
<?php
	$no++;}
?>
<tr><td colspan="5" align="center">Total</td>
  <td colspan="2">Rp. <?php $bu=mysql_fetch_array(mysql_query("SELECT sum(besar_tabungan) as besar_tab from tb_tabungan")); echo number_format($bu['besar_tab']);
  echo '</td>';?>
</tr></tbody></table></form>
<div align="right">
    <ul class="pagination">
      <?php
      // Jika page = 1, maka LinkPrev disable
      if($page == 1){ 
      ?>        
        <!-- link Previous Page disable --> 
        <li class="disabled"><a href="#">Previous</a></li>
      <?php
      }
      else{ 
        $LinkPrev = ($page > 1)? $page - 1 : 1;
      ?>
        <!-- link Previous Page --> 
        <li><a href="index.php?pilih=1.3&page=<?php echo $LinkPrev; ?>">Previous</a></li>
      <?php
        }
      ?>

      <?php
      $query = mysql_query("SELECT * FROM tb_tabungan");        
      
      //Hitung semua jumlah data yang berada pada tabel 
      $JumlahData = mysql_num_rows($query);
      
      // Hitung jumlah halaman yang tersedia
      $jumlahPage = ceil($JumlahData / $limit); 
      
      // Jumlah link number 
      $jumlahNumber = 1; 

      // Untuk awal link number
      $startNumber = ($page > $jumlahNumber)? $page - $jumlahNumber : 1; 
      
      // Untuk akhir link number
      $endNumber = ($page < ($jumlahPage - $jumlahNumber))? $page + $jumlahNumber : $jumlahPage; 
      
      for($i = $startNumber; $i <= $endNumber; $i++){
        $linkActive = ($page == $i)? ' class="active"' : '';
      ?>
        <li<?php echo $linkActive; ?>><a href="index.php?pilih=1.3&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
      <?php
        }
      ?>
      
      <!-- link Next Page -->
      <?php       
      if($page == $jumlahPage){ 
      ?>
        <li class="disabled"><a href="#">Next</a></li>
      <?php
      }
      else{
        $linkNext = ($page < $jumlahPage)? $page + 1 : $jumlahPage;
      ?>
        <li><a href="index.php?pilih=1.3&page=<?php echo $linkNext; ?>">Next</a></li>
      <?php
      }
      ?>
    </ul>
  </div>
</div></div></div></div>
<?php }
else if($aksi=='simpananguru'){
	$kode=$_GET['nip'];
	$q=mysql_query("SELECT *from tb_guru where nip='$kode'");
	$a=mysql_fetch_array(mysql_query("SELECT * from tb_tabungan where nip='$nip'"));
	$ang=mysql_fetch_array($q); 
?>

<div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                    <h4 class="mb"><span class='glyphicon glyphicon-briefcase'></span> Laporan Setoran "<?php echo $ang['nama_guru'];?>" </h4>
                    	
                    	   <h2 class="mb">Total Saldo  : Rp. <?php $bu=mysql_fetch_array(mysql_query("SELECT besar_tabungan from tb_tabungan where nip='$kode'")); 
  echo Rp($bu['besar_tabungan']);?>
                    <span style="float:right;">
                    <a class="btn btn-warning btn-xs" href="index.php?pilih=1.3&aksi=simpan&nip=<?php echo $ang['nip'];?>">Simpan Uang</a>
<a href="laporan/print_show_simpanan.php?kode=<?php echo $ang['nip'];?>" target="_blank" class="btn btn-primary"><span class='glyphicon glyphicon-print'></span> Print</a> 
                    </span></h2>
            
<form class="form-inline" role="form">
  <table class="table table-bordered table-striped table-condensed">
    <thead>
		<tr class="info">
             <th rowspan="2"><a href="#">No</a></th>
             <th><a href="#">Tanggal Simpan</a></th>
			 <th><a href="#">Besar Simpanan</a></th>
       	</tr>
    </thead>
<?php
$query = mysql_query("SELECT * from tb_setroguru where nip='$kode'order by kode_setor desc");
	echo '<tbody>';	
	$no=1;
	while($data=mysql_fetch_array($query)){
?>
    	<tr>
			<td><?php echo $no?></td>
			<td><?php echo Tgl($data['tgl_entri']);?></td>
            <td>Rp. <?php echo Rp($data['besar_simpanan']);?></td>
        </tr> 
<?php
	$no++;}
?>
<tr  class="info"><td colspan="2" align="center">Total</td>

  <td>Rp. <?php $bu=mysql_fetch_array(mysql_query("SELECT sum(besar_simpanan) as besar_simpan from tb_setroguru where nip='$kode'")); echo Rp($bu['besar_simpan']);
  echo '</td>';?>
</tr>
</tbody>   
</table>
</div>
</div>
</div>

<?php }

  else if($aksi=='simpan'){
    $kode=$_GET['nip'];
    $qubah=mysql_query("SELECT * FROM tb_guru WHERE nip='$kode'");
    $data2=mysql_fetch_array($qubah);
?>

<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Transaksi Simpanan Tabungan</h1>
                    </div><!-- /.col-lg-12 -->
                </div><!-- /.row -->

				<div class="row">
					<div class="col-lg-12">
						<form class="form-horizontal" action="tabungan_guru/aksi-proses-simpan.php?pros=simpan" method="POST" enctype="multipart/form-data">
							<div class="panel panel-default">
								<div class="panel-heading"><h3>Tambah Data</h3></div>
								<div class="panel-body">
									<div class="form-group">
										<label class="control-label col-sm-3">Besar Simpanan</label>
										<div class="col-sm-4">     
            <input type="number" name="besar_simpanan" class="form-control" id="besar_simpanan"  required="Besar simpanan harus diisi" />
											<span id="user-availability-status" style="font-size:12px;"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3"> NIP</label>
										<div class="col-sm-4">
                   
            <input type="text" name="nip" title="NIP harus diisi" readonly="" class="form-control" value="<?php echo $data2['nip'];?>">
										</div>
									</div>
			
									<div class="form-group">
										<label class="control-label col-sm-3">	User Entri</label>
										<div class="col-sm-4">
									
            <input type="text" name="u_entri" class="form-control"  value="<?php session_start(); echo $_SESSION['name'];?>" readonly >
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3"> Tanggal Entri</label>
										<div class="col-sm-4">
                   
            <input type="text" name="tgl_entri" class="form-control"  value="<?php echo date("Y-m-d");?>" readonly />
										</div>
									</div>
							
								<div class="panel-footer">
									<button type="submit" name="simpan" class="btn btn-success" onclick="return confirm('apakah data sudah benar?');">Simpan</button>
								</div>
							</div><!-- /.panel -->
						</form>
					</div><!-- /.col-lg-12 -->
				</div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /#page-wrapper -->

<?php }
else if($aksi=='viewambil')
{ $lo=$_GET['kode_tabungan'];$luy=$_GET['nip'];$nama=mysql_fetch_array(mysql_query("SELECT nama_guru from tb_guru where nip='$luy'")); ?>
 <div class="row mt">
 <div class="col-lg-12">
  <div class="form-panel">
   <h4 class="mb"><span class='glyphicon glyphicon-briefcase'></span> Data Pengambilan Uang "<?php echo $nama['nama_guru']; ?>" </span>
                   
   <span style="float:right;">
<form action="tabungan_guru/aksi-proses-tabungan.php" method="get">
<input type="hidden" value="<?php echo $lo; ?>" name="kode_tabungan"> <input type="hidden" value="<?php echo $luy; ?>" name="nip"> 
<?php $rtyu=mysql_fetch_array(mysql_query("SELECT *FROM tb_tabungan where kode_tabungan='$lo' and nip='$luy'")); ?>
<input type="text" style="width:150px;height:30px;" readonly="readonly" id="txt1" onkeyup="sum();" name="saldo" value="<?php echo $rtyu['besar_tabungan'];?>"/>
<script>
        function sum() {
              var txtFirstNumberValue = document.getElementById('txt1').value;
              var txtSecondNumberValue = document.getElementById('txt2').value;
              var result = parseInt(txtFirstNumberValue) - parseInt(txtSecondNumberValue);
              if (!isNaN(result)) {
                 document.getElementById('txt3').value = result;
              }
              else{
                 document.getElementById('txt3').value = txtFirstNumberValue;
              }
        }
        function isNumberKey(evt)
        {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
        return true;
        }
</script>
       <input type="text" placeholder="ambil uang" style="width:150px;height:30px;" id="txt2" onkeyup="sum();" placeholder="" onkeypress="return isNumberKey(event)" name="besar_ambil" required="mohon tidak dikosongkan" />
  <input type="text" placeholder="sisa uang" style="width:150px;height:30px;" id="txt3" onkeyup="sum();" onkeypress="return isNumberKey(event)"/>
   <button class="btn btn-danger"onclick="return confirm('apakah data sudah benar?');"> Ambil Uang</button>
</form>
</span>
   </h4>
   <form class="form-inline" role="form">
<table class="table table-bordered table-striped table-condensed">
    <thead>
    <tr class="info">
             <th><a href="#">No</a></th>
             <th><a href="#">Kode Ambil</a></th>
             <th><a href="#">NIP</a></th>
             <th><a href="#">Nama Guru</a></th>
             <th><a href="#">Kode Tabungan</a></th>
             <th><a href="#">Besar Ambil</a></th>
             <th><a href="#">Tanggal Ambil</a></th>
        </tr>
    
    </thead><tbody>
<?php
  $query=mysql_query("SELECT * FROM tb_pengambilan where nip='$luy' and kode_tabungan='$lo' order by kode_ambil desc");
  $no=1;
  while($data=mysql_fetch_array($query)){
?>
    
      <tr>
      <td><?php echo $no;?></td>
            <td><?php echo $data['kode_ambil'];echo'</td>
            <td>';echo $d=$data['nip'];echo'</td>';
            $d=$data['nip'];$f=mysql_fetch_array(mysql_query("SELECT nama_guru from tb_guru where nip='$d'")); $rty=mysql_fetch_array(mysql_query("SELECT sum(besar_ambil) as total_asli from tb_pengambilansiswa where nis='$d'")); $inves=$data['besar_tabungan']-$rty['total_asli'];?>
            <td><?php echo $f['nama_guru'];?></td>
            <td><?php echo $data['kode_tabungan'];?></td>
            <td>Rp. <?php echo number_format($data['besar_ambil']);?></td>
            <td><?php echo $data['tgl_ambil'];?></td>
      </tr> 
     
<?php
  $no++;} //tutup while
?>
<tr  class="info"><td colspan="5"a align="center">Total</td>
  <td colspan="2">Rp. <?php $bu=mysql_fetch_array(mysql_query("SELECT sum(besar_ambil) as besar_ambil from tb_pengambilan where nip='$luy'")); echo number_format($bu['besar_ambil']);
  echo '</td>';?>
</tr>
</tbody></table></form></div></div></div>
<?php }
 ?>
 