<?php 
	include "config/koneksi.php";
	include "fungsi/fungsi.php";

	$aksi=$_GET['aksi'];
	$cari = ($cari = $_POST['input_cari'])? $cari: $_GET['input_cari'];
   
?>

<head>
	 <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

<!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
	if(empty($aksi)){
?>
<body>  
 <div class="row mt">
 <div class="col-lg-12">
 	<div class="form-panel">
              <h2 class="m-0 font-weight-bold text-primary" align="center">Data Guru
            <span style="float:right;">
            <input type="text" id="cari" name="input_cari" style="width:230px;height:30px;font-size:15px;" placeholder=" cari"> </span>  </h2>
      <a href="?pilih=1.2&aksi=tambah" class="btn btn-primary" sstype="button" data-dismiss="modal">Tambah Data Guru</a>
       <form class="form-inline" role="form">
                        <table class="table table-bordered table-striped table-condensed">
                          <thead>
                          <tr>
                     <th>No</th>
                     <th>NIP</th>
                     <th>Nama Guru</th>
                      <th>Alamat</th>
                     <th>Telepon</th>
                     <th>Jenis Kelamin</th>
                     <th>Setoran</th>
                     <th colspan="3"><a>Aksi</a></th>
                          </tr>
                      </thead>
                      <tbody id="fbody">
                         <?php
$page = (isset($_GET['page']))? (int) $_GET['page'] : 1;
      
      // Jumlah data per halaman
      $limit = 5;

      $limitStart = ($page - 1) * $limit;
                
       $query = mysql_query( "SELECT * FROM tb_guru LIMIT ".$limitStart.",".$limit);
      
      $no = $limitStart + 1;
                      while($data=mysql_fetch_array($query)){
            ?>
              <tr>
              <td><?php echo $no;?></td>
                    <td><?php echo $data['nip'];?></td>
                    <td><?php echo $data['nama_guru'];?></td>
                       <td><?php echo $data['alamat'];?></td>
                    <td><?php echo $data['telp_guru'];?></td>
                    <td><?php echo $data['jk_guru'];?></td>
                    <td><?php echo $data['setoran'];?></td>
                    <td align="center">
          <a class="btn btn-success btn-xs" href="index.php?pilih=1.2&aksi=ubah&nip=<?php echo $data['nip'];?>"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
             <script type="text/javascript">
    function hapus(){
    var msg = confirm("Jika anda menghapus data ini ,seluruh transaksi data ini juga akan dihapus. Anda Yakin ?");
    if(msg==true){
    window.location="guru/aksi-proses-guru.php?pros=hapus&nip=<?php echo $data['nip'];?>";  
    }
    else{
    
    }
    }
    </script>
             <a class="btn btn-danger btn-xs" href="guru/aksi-proses-guru.php?pros=hapus&nip=<?php echo $data['nip'];?>"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
             </td>
                </tr>   
          <?php
            $no++;} //tutup while
          ?>
            </tbody> </table>
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
        <li><a href="index.php?pilih=1.2&page=<?php echo $LinkPrev; ?>">Previous</a></li>
      <?php
        }
      ?>

      <?php
      $query = mysql_query("SELECT * FROM tb_guru");        
      
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
        <li<?php echo $linkActive; ?>><a href="index.php?pilih=1.2&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
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
        <li><a href="index.php?pilih=1.2&page=<?php echo $linkNext; ?>">Next</a></li>
      <?php
      }
      ?>
    </ul>
  </div>
</div>
</div>
</div>
</form>

<?php
	}else if($aksi=='tambah'){

      ?>
    <div class="row">
					<div class="col-lg-12">
						<form class="form-horizontal" action="guru/aksi-input-guru.php" method="POST" enctype="multipart/form-data">
							<div class="panel panel-default">
								<div class="panel-heading"><h3>Tambah Data Guru</h3></div>
								<div class="panel-body">
						  <div class="form-group">
              <label class="control-label col-sm-3">NIP</label>
              <div class="col-sm-4">
                              <input type="text" name="nip" class="form-control" size="54px" />
                          </div>
                          </div>
               <div class="form-group">
               <label class="control-label col-sm-3">Nama Lengkap</label>
               <div class="col-sm-4">
                              <input type="text" name="nama_guru" class="form-control" size="54" title="Nama harus diisi" required />
                          </div>
                          </div>
                          <div class="form-group">
                          <label class="control-label col-sm-3">Alamat Guru</label>
                          <div class="col-sm-4">
                              <input type="text" name="alamat" class="form-control"  rows="5" cols="41" title="Alamat harus diisi" required />
                          </div>
                          </div>
                          <div class="form-group">
                          <label class="control-label col-sm-3">Telepon</label>
                          <div class="col-sm-4">
                              <input type="text" name="telp_guru" size="54" class="form-control" required/>
                          </div>
                          </div>
                             <div class="form-group">
                             <label class="control-label col-sm-3">Setoran Awal</label>
                             <div class="col-sm-4">
                                <input type="text" name="setoran" class="form-control" size="54" id="setoran" required/>
                          </div>
                          </div>
                          <div class="form-group">
                          <label class="control-label col-sm-3">Jenis Kelamin</label>
                          <div class="col-sm-4">
                              <input type="radio" name="jk_guru" value="Laki-laki"  title="Jenis Kelamin harus diisi" required /> Laki-laki
                               <input type="radio" name="jk_guru" value="Perempuan" title="Jenis Kelamin harus diisi" required /> Perempuan
                          </div>
                          </div>
                          <div class="form-group">
                          <label class="control-label col-sm-3">Tanggal</label>
                          <div class="col-sm-4">
                              <input type="date" name="tgl_entri" size="54" class="form-control" required/>
                          </div>
                          </div>
                         <button class="btn btn-danger" onclick="return confirm('apakah data sudah benar?');">Simpan</button>


                          </form>
                          

</div></div></div>

<?php
	}else if($aksi=='ubah'){
		$kode=$_GET['nip'];
		$qubah=mysql_query("SELECT * FROM tb_guru WHERE nip='$kode'");
		$data2=mysql_fetch_array($qubah);
?> <div class="row">
<div class="col-lg-12">
  <form class="form-horizontal" action="guru/edit_guru.php" method="GET" enctype="multipart/form-data">
    <div class="panel panel-default">
      <div class="panel-heading"><h3>Edit Data Guru</h3></div>
      <div class="panel-body">
						  <div class="form-group">
              <label class="control-label col-sm-3">NIP</label>
              <div class="col-sm-4">
                              <input type="text" name="nip" class="form-control" size="54px" id="nip"value="<?php echo $data2['nip'];?>" readonly />
                          </div>
                          </div>
                          <div class="form-group">
                          <label class="control-label col-sm-3">Nama Lengkap</label>
                          <div class="col-sm-4">
                              <input type="text" name="nama_guru" class="form-control" id="nama_guru" size="54" class="required" value="<?php echo $data2['nama_guru'];?>" required />
                          </div>
                          </div>
                            <div class="form-group">
                          <label class="control-label col-sm-3">Alamat Guru</label>
                          <div class="col-sm-4">
                              <input type="text" name="alamat" id="alamat"value="<?php echo $data2['alamat'];?>" class="form-control" required />
                          </div>
                          </div>
                             <div class="form-group">
                          <label class="control-label col-sm-3">Telepon</label>
                          <div class="col-sm-4">
                              <input type="number" class="form-control" id="telp_guru" value="<?php echo $data2['telp_guru'];?>" name="telp_guru" required />
                          </div>
                          </div>
                          <div class="form-group">
                          <label class="control-label col-sm-3">Jenis Kelamin</label>
                          <div class="col-sm-4">
                              <?php	
								if ($data2['jk_guru'] == "Laki-laki"){
									echo "<input type='radio' name='jk_guru' value='Laki-laki' checked>Laki-laki <input type='radio' name='jk_guru' value='Perempuan'>Perempuan";
								}else if ($data2['jk_guru'] == "Perempuan"){
									echo "<input type='radio' name='jk_guru'  value='Laki-laki'>Laki-laki <input type='radio' name='jk_guru' value='Perempuan' checked>Perempuan";
								}
							?>	
                          </div>
                          </div>
                        
                       
                          <button id="formbtn" class="btn btn-danger" onclick="return confirm('apakah data sudah benar?');"><span class='glyphicon glyphicon-pencil' value="edit" name="edit"></span> Edit</button>
                          </form>
</div></div></div>
    </div>
                </div>
</div>
                    

<?php } ?>
</html>