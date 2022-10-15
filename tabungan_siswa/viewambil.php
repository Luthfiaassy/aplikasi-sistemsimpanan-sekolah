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
    $total=$dataku['besar_tabungan']+10000;
    $tol=mysql_query("UPDATE tb_tabungan set tgl_mulai='$tang',besar_tabungan='$total' where nis='$kode_tab'");
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
   <h2 class="mb" align="center"> Data Tabungan 
     <?php
      $am=mysql_query("select*from tb_tabungansiswa");
        $jum=mysql_num_rows($am);
         echo'<kbd style="background-color:#d9534f;">'.$jum.'</kbd>';?> 
         <span style="float:right;"><input type="text" id="cari" style="width:230px;height:30px;font-size:15px;" placeholder=" cari disini...">
                    

                    </span>
  </h2>
<form class="form-inline" role="form">
<table class="table table-bordered table-striped table-condensed">
    <thead>
		<tr class="info">
             <th><a href="#">No</a></th>
             <th><a href="#">Kode Tabungan</a></th>
             <th><a href="#">NIS</a></th>
             <th><a href="#">Nama Siswa</a></th>
   
             <th><a href="#">Jumlah Saldo</a></th>
              <th><a href="#">Aksi</a></th>
       	</tr>
		
    </thead><tbody id="fbody">
<?php
	$query=mysql_query("SELECT * FROM tb_tabungansiswa order by kode_tabungan desc");
	$no=1;
	while($data=mysql_fetch_array($query)){
?>
    
    	<tr>
			<td><?php echo $no;?></td>
            <td><?php echo $data['kode_tabungan'];echo'</td>
            <td>';echo $d=$data['nis'];echo'</td>';
            $d=$data['nis'];$f=mysql_fetch_array(mysql_query("SELECT nama_siswa from tb_siswa where nis='$d'")); $rty=mysql_fetch_array(mysql_query("SELECT sum(besar_simpanan) as total_asli from tb_simpansiswa where nis='$d'")); $inves=$data['besar_tabungan']-$rty['total_asli'];?>
            <td><?php echo $f['nama_siswa'];?></td>
            <td>Rp. <?php echo Rp($data['besar_tabungan']);?></td> 
            <td><a class="btn btn-danger btn-xs" href="index.php?pilih=1.8&aksi=viewambil&kode_tabungan=<?php echo $data['kode_tabungan'];?>&nis=<?php echo $d;?>">detail penarikan</a>

            <a class="btn btn-danger btn-xs" href="index.php?pilih=1.8&aksi=simpanansiswa&kode_tabungan=<?php echo $data['kode_tabungan'];?>&nis=<?php echo $d;?>">detail setoran</a>
  </td>
          </a> 
        </tr> 
	   
<?php
	$no++;} //tutup while
?>
<tr  class="info"><td colspan="5" align="center">Total</td>
  <td colspan="2">Rp. <?php $bu=mysql_fetch_array(mysql_query("SELECT sum(besar_tabungan) as besar_tab from tb_tabungansiswa")); echo number_format($bu['besar_tab']);
  echo '</td>';?>
</tr></tbody></table></form></div></div></div>
<?php }
else if($aksi=='simpanansiswa'){
	$kode=$_GET['nis'];
	$q=mysql_query("SELECT *from tb_siswa where nis='$kode'");
	$a=mysql_fetch_array(mysql_query("SELECT * from tb_tabungansiswa where nis='$nis'"));
	$ang=mysql_fetch_array($q); 
?>

<div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                    <h4 class="mb"><span class='glyphicon glyphicon-briefcase'></span> Laporan Setoran "<?php echo $ang['nama_siswa'];?>" </h4>
                    	
                    	   <h2 class="mb">Total Saldo  : Rp. <?php $bu=mysql_fetch_array(mysql_query("SELECT besar_tabungan from tb_tabungansiswa where nis='$kode'")); 
  echo Rp($bu['besar_tabungan']);?>
                    <span style="float:right;">

<a href="laporan/print_show_setoransiswa.php?kode=<?php echo $ang['nis'];?>" target="_blank" class="btn btn-primary"><span class='glyphicon glyphicon-print'></span> Print</a> 
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
$query = mysql_query("SELECT * from tb_setorsiswa where nis='$kode'order by kode_setor desc");
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

  <td>Rp. <?php $bu=mysql_fetch_array(mysql_query("SELECT sum(besar_simpanan) as besar_simpan from tb_setorsiswa where nis='$kode'")); echo Rp($bu['besar_simpan']);
  echo '</td>';?>
</tr>
</tbody>   
</table>
</div>
</div>
</div>


<?php }
else if($aksi=='viewambil')
{ $lo=$_GET['kode_tabungan'];
$luy=$_GET['nis']; 
$nama=mysql_fetch_array(mysql_query("SELECT nama_siswa from tb_siswa where nis='$luy'")); 
$q=mysql_query("SELECT *from tb_siswa where nis='$luy'");
$ang=mysql_fetch_array($q); ?>
 <div class="row mt">
 <div class="col-lg-12">
  <div class="form-panel">
   <h4 class="mb"><span class='glyphicon glyphicon-briefcase'></span> Data Pengambilan Uang "<?php echo $nama['nama_siswa']; ?>" </span>       
   <span style="float:right;">
<input type="hidden" value="<?php echo $lo; ?>" name="kode_tabungan"> <input type="hidden" value="<?php echo $luy; ?>" name="nis"> 
<?php $rtyu=mysql_fetch_array(mysql_query("SELECT *FROM tb_tabungansiswa where kode_tabungan='$lo' and nis='$luy'")); ?></span>
   </h4>
   <h2 class="mb">Total Saldo  : Rp. <?php $bu=mysql_fetch_array(mysql_query("SELECT besar_tabungan from tb_tabungansiswa where nis='$luy'")); 
  echo Rp($bu['besar_tabungan']);?></h2>
  <a href="laporan/print_show_penarikansiswa.php?nis=<?php echo $ang['nis'];?>" target="_blank" class="btn btn-primary"><span class='glyphicon glyphicon-print'></span> Print</a> 
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
            $d=$data['nis'];$f=mysql_fetch_array(mysql_query("SELECT nama_siswa from tb_siswa where nis='$d'")); $rty=mysql_fetch_array(mysql_query("SELECT sum(besar_simpanan) as total_asli from tb_setoransiswa where nis='$d'")); $inves=$data['besar_tabungan']-$rty['total_asli'];?>
            <td><?php echo $f['nama_siswa'];?></td>
            <td><?php echo $data['kode_tabungan'];?></td>
            <td>Rp. <?php echo number_format($data['besar_ambil']);?></td>
            <td><?php echo $data['tgl_ambil'];?></td>
     
     
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
