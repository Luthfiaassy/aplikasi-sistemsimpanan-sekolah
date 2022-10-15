<?php  
include "config/koneksi.php";
include "fungsi/fungsi.php";
	
?>
<div class="row mt">
 <div class="col-lg-12">
              <h1 class="m-0 font-weight-bold text-primary" align="center">Laporan Transaksi
            <span style="float:right;"></span>
	</div>
	<br/><br/>
	<hr/>
	<br/>
	<div class="col-md-12">
		<form method="POST" class="form-inline">
			<div class="form-group">
				<input type="date" id="tgl1" class="form-control" name="tgl1">
			</div>
			<br/>
			<div class="form-group">
				<label>  Sampai  </label>
				<input type="date" id="tgl2" class="form-control" name="tgl2">
			</div>
			<br/>
			<div class="form-group">
				<button id="proses_tabungan" name="proses_tabungan" class="btn btn-primary"><i class="fa fa-play-circle-o"></i> Proses Tabungan Guru</button>
			</div>
			<br/>
			<div class="form-group">
				<button id="proses_tabungansiswa" name="proses_tabungansiswa" class="btn btn-primary"><i class="fa fa-play-circle-o"></i> Proses Tabungan Siswa</button>
			</div>
			
		</form>
	</div>
</div>
<hr/>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" align="center">
				<?php if (isset($_POST['proses_tabungan'])): ?>
					<a href="laporan/cetaklaporantabungan.php?tgl1=<?php echo $_POST['tgl1']; ?>&tgl2=<?php echo $_POST['tgl2']; ?>" target="_BLANK" class="btn btn-info" onclick="return confirm('apakah anda yakin ingin mencetak?');"><i class="fas fa-print"></i> Cetak</a>
				<?php endif ?>
				<?php if (isset($_POST['proses_tabungansiswa'])): ?>
					<a href="laporan/cetaklaporantabungansiswa.php?tgl1=<?php echo $_POST['tgl1']; ?>&tgl2=<?php echo $_POST['tgl2']; ?>" target="_BLANK" class="btn btn-info" onclick="return confirm('apakah anda yakin ingin mencetak?');"><i class="fas fa-print"></i> Cetak</a>
				<?php endif ?>
				
			</div>

			<?php  
			$nip=$_GET['nip'];
						$nis=$_GET['nis'];
						if (isset($_POST['proses_tabungan'])) {
							
						echo' 
					
              <h1 align="center">Laporan Transaksi Tabungan
            <span style="float:right;"></span></h1>

							<div class="panel-body">
				<table class="table table-bordered table-hover">
					<thead>
						<tr class="active">
							<th>No</th>
							<th>No Induk Pengajar</th>
							<th>Kode Tabungan</th>
							<th>Besar Tabungan</th>
							<th>Tanggal Mulai</th>
						</tr>
					</thead>';
					if (isset($_POST['tgl1'])&& isset($_POST['tgl2'])) {

            $tgl1=date('Y-m-d', strtotime($_POST["tgl1"]));
            $tgl2=date('Y-m-d', strtotime($_POST["tgl2"]));
            $sql=mysql_query("SELECT * from tb_tabungan  where tgl_mulai between '".$tgl1."' and '".$tgl2."' order by nip asc");

        }else {
            $sql=mysql_query("SELECT * from tb_tabungan order by nip asc");
        }

        $no=1;
      
        while ($data = mysql_fetch_array($sql))
							 {		

				?>
					<tbody>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $data['nip']; ?></td>
							<td><?php echo $data['kode_tabungan']; ?></td>
							<td><?php echo $data['besar_tabungan']; ?></td>
							<td><?php echo date_format(date_create($data['tgl_mulai']),'d-m-Y'); ?></td>
						</tr>
					<?php
						$no++;}?> 
				
					</tbody>
				</table>

					<?php
					}
						elseif (isset($_POST['proses_tabungansiswa'])) {
						
						echo' 
					
              <h1 align="center">Laporan Transaksi Tabungan Siswa
            <span style="float:right;"></span></h1>

							<div class="panel-body">
				<table class="table table-bordered table-hover">
					<thead>
						<tr class="active">
							<th>No</th>
							<th>No Induk Siswa</th>
							<th>Kode Tabungan</th>
							<th>Besar Tabungan</th>
							<th>Tanggal Mulai</th>
						</tr>
					</thead>';
					if (isset($_POST['tgl1'])&& isset($_POST['tgl2'])) {

            $tgl1=date('Y-m-d', strtotime($_POST["tgl1"]));
            $tgl2=date('Y-m-d', strtotime($_POST["tgl2"]));
            $sql=mysql_query("SELECT * from tb_tabungansiswa  where tgl_mulai between '".$tgl1."' and '".$tgl2."' order by nis asc");

        }else {
            $sql=mysql_query("SELECT * from tb_tabungansiswa order by nis asc");
        }

        $no=1;
      
        while ($data = mysql_fetch_array($sql))
							 {		

				?>
					<tbody>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $data['nis']; ?></td>
							<td><?php echo $data['kode_tabungan']; ?></td>
							<td><?php echo $data['besar_tabungan']; ?></td>
							<td><?php echo date_format(date_create($data['tgl_mulai']),'d-m-Y'); ?></td>
						</tr>
					<?php
						$no++;}?> 
				<?php
						}
					?>
					</tbody>
				</table>

		
					
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>