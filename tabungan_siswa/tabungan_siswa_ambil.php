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
    $ghu=mysql_query("SELECT * FROM tb_tabungansiswa");
$no=1;
while($dataku=mysql_fetch_array($ghu))
{
  $fgh=$dataku['tgl_mulai'];$tang=date("Y-m-d");$kode_tab=$dataku['kode_tabungan'];
  $tempo=date('Y-m-d',strtotime('+30 day',strtotime($fgh)));
  if($tempo==$tang)
  {
    $total=$dataku['besar_tabungan'];
    $tol=mysql_query("UPDATE tb_tabungansiswa set tgl_mulai='$tang',besar_tabungan='$total' where kode_tabungan='$kode_tab'");
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
   <h2 class="mb" align="center"> Data Tabungan Siswa
         <span style="float:right;"><input type="text" id="cari" style="width:230px;height:30px;font-size:15px;" placeholder=" cari ">
  </h2>
<form class="form-inline" role="form">
 <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
		<tr>
             <th>No</th>
             <th>Kode Tabungan</th>
             <th>NIS</th>
             <th>Nama Siswa</th>
             <th>Jumlah Saldo</th>
              <th>Aksi</th>
		<th>Status</th>
       	</tr>
		
    </thead>
    <tbody id="fbody">
<?php
$page = (isset($_GET['page']))? (int) $_GET['page'] : 1;
      
      // Jumlah data per halaman
      $limit = 5;

      $limitStart = ($page - 1) * $limit;
                
          $query = mysql_query( "SELECT * FROM tb_tabungansiswa LIMIT ".$limitStart.",".$limit);
      
      $no = $limitStart + 1;
	while($data=mysql_fetch_array($query)){
?>
    
    	<tr>
			<td><?php echo $no;?></td>
            <td><?php echo $data['kode_tabungan'];echo'</td>
            <td>';echo $d=$data['nis'];echo'</td>';
            $d=$data['nis'];$f=mysql_fetch_array(mysql_query("SELECT nama_siswa from tb_siswa where nis='$d'")); 
            $rty=mysql_fetch_array(mysql_query("SELECT sum(besar_tabungan) as total_asli from tb_tabungansiswa where nis='$d'")); 
            $inves=$data['besar_tabungan']-$rty['total_asli'];?>
            <td><?php echo $f['nama_siswa'];?></td>
            <td>Rp. <?php echo Rp($data['besar_tabungan']);?></td> 
            <td>
              <a class="btn btn-warning btn-xs" href="index.php?pilih=1.5&aksi=ambil&nis=<?php echo $data['nis'];?>&nis=<?php echo $d;?>">Detail Penarikan</a>
            </td>
        </tr> 
	   
<?php
	$no++;}
?>
<tr><td colspan="5" align="center">Total</td>
  <td colspan="2">Rp. <?php $bu=mysql_fetch_array(mysql_query("SELECT sum(besar_tabungan) as besar_tab from tb_tabungansiswa")); echo number_format($bu['besar_tab']);
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
        <li><a href="index.php?pilih=1.5&page=<?php echo $LinkPrev; ?>">Previous</a></li>
      <?php
        }
      ?>

      <?php
      $query = mysql_query("SELECT * FROM tb_tabungansiswa");        
      
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
        <li<?php echo $linkActive; ?>><a href="index.php?pilih=1.5&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
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
        <li><a href="index.php?pilih=1.5&page=<?php echo $linkNext; ?>">Next</a></li>
      <?php
      }
      ?>
    </ul>
  </div>
</div></div></div></div>

<?php }
else if($aksi=='viewambil')
{ $lo=$_GET['kode_tabungan'];$luy=$_GET['nis'];$nama=mysql_fetch_array(mysql_query("SELECT nama_siswa from tb_siswa where nis='$luy'")); ?>
 <div class="row mt">
 <div class="col-lg-12">
  <div class="form-panel">
   <h4 class="mb"><span class='glyphicon glyphicon-briefcase'></span> Data Pengambilan Uang "<?php echo $nama['nama_siswa']; ?>" </span>
                   
   <span style="float:right;"></span>
 </h4>

   <form class="form-inline" role="form">
<table class="table table-bordered table-striped table-condensed">
    <thead>
    <tr class="info">
             <th><a href="#">No</a></th>
             <th><a href="#">Kode Ambil</a></th>
             <th><a href="#">NIS</a></th>
             <th><a href="#">Nama Siswa</a></th>
             <th><a href="#">Kode Tabungan</a></th>
             <th><a href="#">Besar Ambil</a></th>
             <th><a href="#">Tanggal Ambil</a></th>
        </tr>
    
    </thead><tbody>
<?php
  $query=mysql_query("SELECT * FROM tb_pengambilansiswa where nis='$luy' and kode_tabungan='$lo' order by kode_ambil desc");
  $no=1;
  while($data=mysql_fetch_array($query)){
?>
    
      <tr>
      <td><?php echo $no;?></td>
            <td><?php echo $data['kode_ambil'];echo'</td>
            <td>';echo $d=$data['nis'];echo'</td>';
            $d=$data['nis'];$f=mysql_fetch_array(mysql_query("SELECT nama_siswa from tb_siswa where nis='$d'")); $rty=mysql_fetch_array(mysql_query("SELECT sum(besar_ambil) as total_asli from tb_pengambilansiswa where nis='$d'")); $inves=$data['besar_tabungan']-$rty['total_asli'];?>
            <td><?php echo $f['nama_siswa'];?></td>
            <td><?php echo $data['kode_tabungan'];?></td>
            <td>Rp. <?php echo number_format($data['besar_ambil']);?></td>
            <td><?php echo $data['tgl_ambil'];?></td>
      </tr> 
     
<?php
  $no++;} //tutup while
?>
<tr  class="info"><td colspan="5"a align="center">Total</td>
  <td colspan="2">Rp. <?php $bu=mysql_fetch_array(mysql_query("SELECT sum(besar_ambil) as besar_ambil from tb_pengambilansiswa where nis='$luy'")); echo number_format($bu['besar_ambil']);
  echo '</td>';?>
</tr>
</tbody></table></form></div></div></div>
<?php }
 ?>
 