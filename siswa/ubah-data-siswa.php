<?php 
  include "config/koneksi.php";
  include "fungsi/fungsi.php";

?>
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header">
      <div class="modal-content">
      
        <div class="modal-header">
          <h4 class="modal-title"> Ubah Data Anggota
                  </h4>
                 </div>
                 <?php

    $kode_anggota=$_GET['kode_anggota'];
    $qubah=mysql_query("SELECT * FROM tb_anggota WHERE kode_anggota='$kode_anggota'");
    $data2=mysql_fetch_array($qubah);?>                 
<form action="anggota/edit_anggota.php" method="get" id="form" role="form" enctype="multipart/form-data">
   <div class="modal-body">
						  <div class="form-group">
                              <label>Kode Anggota</label>
                              <input type="text" name="kode_anggota" class="form-control" size="54px" id="kd_anggota"value="<?php echo $data2['kode_anggota'];?>" readonly />
                          </div>
                          <div class="form-group">
                              <label>Tanggal Masuk</label>
                              <input type="date" value="<?php echo $data2['tgl_masuk'];?>" class="form-control" id="tgl_masuk" name="tgl_masuk" required />
                          </div>
                          <div class="form-group">
                              <label>Nama Lengkap</label>
                              <input type="text" name="nama_anggota" class="form-control" id="nama_anggota" size="54" class="required" value="<?php echo $data2['nama_anggota'];?>" required />
                          </div>
                          <div class="form-group">
                              <label>No Identitas (NISN/NIP)</label>
                              <input type="text" name="no_identitas" id="no_identitas" class="form-control" size="54" class="required" value="<?php echo $data2['no_identitas'];?>" required />
                          </div>
                          <div class="form-group">
                              <label>Jenis Kelamin</label>
                              <?php	
								if ($data2['jenis_kelamin'] == "Laki-laki"){
									echo "<input type='radio' name='jenis_kelamin' id='jenis_kelamin' value='Laki-laki' checked>Laki-laki <input type='radio' name='jenis_kelamin' value='Perempuan'>Perempuan";
								}else if ($data2['jenis_kelamin'] == "Perempuan"){
									echo "<input type='radio' name='jenis_kelamin' id='jenis_kelamin' value='Laki-laki'>Laki-laki <input type='radio' name='jenis_kelamin' value='Perempuan' checked>Perempuan";
								}
							?>	
                          </div>
                          <div class="form-group">
                              <label>Tempat Lahir</label>
                              <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir"size="54" class="required" value="<?php echo $data2['tempat_lahir'];?>" required/>
                          </div>
                          <div class="form-group">
                              <label>Tanggal Lahir</label>
                               <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir" size="54" class="required" value="<?php echo $data2['tgl_lahir'];?>" required />
                          </div>
                          <div class="form-group">
                              <label>Alamat Anggota</label>
                              <input type="text" name="alamat_anggota" id="alamat_anggota"value="<?php echo $data2['alamat_anggota'];?>" class="form-control" required />
                          </div>
                          <div class="form-group">
                              <label>Telepon</label>
                              <input type="text" class="form-control" id="no_telp" value="<?php echo $data2['telp'];?>" name="telp" required />
                          </div>
                          <div class="form-group">
                              <label>Pekerjaan</label>
                              <input type="text" name="pekerjaan" size="54" class="form-control" id="pekerjaan" value="<?php echo $data2['pekerjaan'];?>" required />
                          </div>
                          <div class="form-group">
                              <label>Status</label>
                              <input type="text" name="status" size="54" class="form-control" id="status" value="<?php echo $data2['status'];?>" required />
                          </div>
                          <div class="form-group">
                              <label>Tanggal Entri</label>
                              <input type="date" name="tgl_entri" class="form-control" id="tgl_entri"value="<?php echo date("Y-m-d");?>" readonly>
                          </div>
                          <button id="formbtn" class="btn btn-danger" onclick="return confirm('apakah data sudah benar?');"><span class='glyphicon glyphicon-pencil' value="edit" name="edit"></span> Edit</button>
                          </form>
</div></div></div>
    </div>
                </div>
</div>
                    
