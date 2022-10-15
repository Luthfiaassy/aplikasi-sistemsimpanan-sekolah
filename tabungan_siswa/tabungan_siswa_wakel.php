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
            <td>
              <a class="btn btn-warning btn-xs" href="index.php?pilih=1.6&aksi=simpanansiswa&nis=<?php echo $data['nis'];?>&nis=<?php echo $d;?>">Simpan Uang</a>
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
                    <a class="btn btn-warning btn-xs" href="index.php?pilih=1.5&aksi=simpan&nis=<?php echo $ang['nis'];?>">Simpan Uang</a>
<a href="laporan/print_show_simpanan.php?kode=<?php echo $ang['nis'];?>" target="_blank" class="btn btn-primary"><span class='glyphicon glyphicon-print'></span> Print</a> 
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

  else if($aksi=='simpan'){
    $kode=$_GET['nis'];
    $qubah=mysql_query("SELECT * FROM tb_siswa WHERE nis='$kode'");
    $data2=mysql_fetch_array($qubah);
?>

<div class="row mt">
     <div class="col-lg-12">
        <div class="form" style="width:50%;">
            <h2 class="mb" align="center">Transaksi Simpanan Tabungan</h2>
    <form action="tabungan_siswa/aksi-proses-simpan.php?pros=simpan" method="post" id="form" name="mainform" onSubmit="validasiSimpan()">
    <div class="form-group">
            <label>Besar Simpanan</label>
            <input type="number" name="besar_simpanan" class="form-control" id="besar_simpan" size="54" required="Besar simpanan harus diisi" />
        </div>
    <div class="form-group">
            <label>NIS</label>
            <input type="text" name="nis" size="34" title="NIS harus diisi" readonly="" class="form-control" value="<?php echo $data2['nis'];?>">
        </div>
        
        <div class="form-group">
            <label>User Entri</label>
            <input type="text" name="user_entry" class="form-control" size="54" value="<?php session_start(); echo $_SESSION['name'];?>" readonly >
        </div>
        <div class="form-group">
            <label>Tanggal Entri</label>
            <input type="text" name="tgl_entri" class="form-control" size="54" value="<?php echo date("Y-m-d");?>" readonly />
        </div>
        <button class="btn btn-danger" onclick="return confirm('apakah data sudah benar?');">Simpan</button>
         </form>

</div>
</div>
</div>

<?php }
 ?>
 