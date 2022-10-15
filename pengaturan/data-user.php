<?php 
  include "config/koneksi.php";
  include "fungsi/fungsi.php";

  $aksi=$_GET['aksi'];
  $kategori = ($kategori=$_POST['kategori'])?$kategori : $_GET['kategori'];
  $cari = ($cari = $_POST['input_cari'])? $cari: $_GET['input_cari'];
?>

<?php
  // **STYLE FORM
?>
<script language="javascript" type="text/javascript" src="js/niceforms.js"></script>
<link rel="stylesheet" type="text/css" href="css/theme1.css" />
</head>

<?php
  if(empty($aksi)){
?>
<body>  
<div class="row mt">
 <div class="col-lg-12">
    <div class="form-panel">
   
 <h2 class="mb" align="center">Setting Data User</h2>
                    <span style="float:right;">
        
<a href="index.php?pilih=4.3&aksi=tambah" class="btn btn-primary"><span class='glyphicon glyphicon-plus'></span> Tambah User Baru</a> 
</span>
      <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
    <tr class="info">
             <th>No</th>
             <th>Kode User</th>
             <th>Nama</th>
             <th>Username</th>
              <th>Password</th>
              
             <th>Level</th>
             <th>Aksi</th>
        </tr>
    
    </thead><tbody>
<?php
$page = (isset($_GET['page']))? (int) $_GET['page'] : 1;
      
      // Jumlah data per halaman
      $limit = 5;

      $limitStart = ($page - 1) * $limit;
                
          $sqlku= mysql_query( "SELECT * FROM tb_user LIMIT ".$limitStart.",".$limit);
      
      $no = $limitStart + 1;
  while($data=mysql_fetch_array($sqlku)){
?>
    
      <tr>
      <td><?php echo $no;?></td>
            <td><?php echo $data['kode_user'];?></td>
             <td><?php echo $data['nama'];?></td>
      <td><?php echo $data['username'];?></td>
      <td><?php echo $data['password'];?></td>
     
      <td><?php echo $data['level'];?></td>
<td align="center">
<a class="btn btn-success btn-xs" href=index.php?pilih=4.3&aksi=ubah&kode_user=<?php echo $data['kode_user'];?>><i class="glyphicon glyphicon-pencil"></i> Edit</a>
<script type="text/javascript">
    function hapus(){
    var msg = confirm("Apakah Anda yakin ?");
    if(msg==true){
    window.location="pengaturan/aksi-user.php?pros=hapus&kode_user=<?php echo $data['kode_user'];?>";  
    }
    else{
    }
    }
    </script>
<a class="btn btn-danger btn-xs" href="#" onclick="hapus();"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
      </td>
        </tr> 
  
<?php
  $no++;} //tutup while
?>
</tbody></table>
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
        <li><a href="index.php?pilih=4.3&page=<?php echo $LinkPrev; ?>">Previous</a></li>
      <?php
        }
      ?>

      <?php
      $query = mysql_query("SELECT * FROM tb_user");        
      
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
        <li<?php echo $linkActive; ?>><a href="index.php?pilih=4.3&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
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
        <li><a href="index.php?pilih=4.3&page=<?php echo $linkNext; ?>">Next</a></li>
      <?php
      }
      ?>
    </ul>
  </div>
</div>
</div>
</div>
</form>

</div></div></div>
    
<?php
  }elseif($aksi=='tambah'){
?>
 <div class="row">
					<div class="col-lg-12">
						<form class="form-horizontal" action="pengaturan/aksi-input-user.php" method="POST" enctype="multipart/form-data">
							<div class="panel panel-default">
								<div class="panel-heading"><h3>Tambah Data</h3></div>
								<div class="panel-body">
<div class="form-group">
<label class="control-label col-sm-3">Nama</label>
<div class="col-sm-4">
<input type="text" name="nama" class="form-control" type="text" required/>
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3">Username</label>
<div class="col-sm-4">
 <input type="text"  class="form-control" name="username" size="54" title="Nama harus diisi" required>
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3">Password</label>
<div class="col-sm-4">
 <input type="password" class="form-control" name="password" size="54" title="password harus diisi"required/>
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3">Level</label>
<div class="col-sm-4">
<select class="form-control" name="level" required >
              <option value="">pilih</option>
                <option value="admin">Admin</option>
 <option value="kepsek">Kepala Sekolah</option>
 <option value="walikelas">Walikelas</option>
                <option value="guru">Guru</option>
 <option value="siswa">Siswa</option>
            </select>
</div>
</div>
<button class="btn btn-danger" onclick="return confirm('apakah data sudah benar?');"><h3>Tambah</h3></button>
 </div></div></div>
 </form>
<?php
  }elseif($aksi=='ubah'){
    $kode=$_GET['kode_user'];
    $q=mysql_query("SELECT * FROM tb_user WHERE kode_user='$kode'");
    $data2=mysql_fetch_array($q);
?>
<div class="row">
					<div class="col-lg-12">
						<form class="form-horizontal" action="pengaturan/aksi-edit-user.php" method="POST" enctype="multipart/form-data">
							<div class="panel panel-default">
								<div class="panel-heading"><h3>Edit Data</h3></div>
								<div class="panel-body">
<div class="form-group">
<label class="control-label col-sm-3">Kode User</label>
<div class="col-sm-4">
 <input type="text" class="form-control" name="kode_user" size="54" value="<?php echo $data2['kode_user'];?>" readonly />
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3">Username</label>
<div class="col-sm-4">
 <input type="text" class="form-control" name="username" size="54"  value="<?php echo $data2['username'];?>" required/>
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3">Password</label>
<div class="col-sm-4">
 <input type="text" class="form-control" name="password" size="54" class="required" title="Telepon harus diisi" value="<?php echo $data2['password'];?>" required/>
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3">Nama</label>
<div class="col-sm-4">
<input name="nama" class="form-control" type="text" value="<?php echo $data2['nama'];?>" required/>
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3">Level</label>
<div class="col-sm-4">
<select name="level" class="form-control">
    <?php
      $q=mysql_query("SELECT * FROM tb_user where kode_user='$kode'");
      while($a=mysql_fetch_array($q)){
      ?>
            <option value="admin" <?php if($a['level']=='admin'){?>selected="selected"<?php }?>>Admin</option>
            <option value="operator" <?php if($a['level']=='operator'){?>selected="selected"<?php }?>>Operator</option>
            <option value="kepsek" <?php if($a['level']=='anggota'){?>selected="selected"<?php }?>>Kepala Sekolah</option>
             <option value="walikelas" <?php if($a['level']=='admin'){?>selected="selected"<?php }?>>Wali Kelas</option>
            <option value="guru" <?php if($a['level']=='operator'){?>selected="selected"<?php }?>>Guru</option>
            <option value="siswa" <?php if($a['level']=='anggota'){?>selected="selected"<?php }?>>Siswa</option>
 <?php
            }
    ?>
</select>
</div>
</div>
<button class="btn btn-danger"  onclick="return confirm('apakah data sudah benar?');">Edit</button>
</form></div></div></div>
<?php
  }
?>

