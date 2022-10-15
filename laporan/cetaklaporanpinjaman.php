
<?php
error_reporting(0);
include "../config/koneksi.php";
$tgl1=$_POST['tgl1'];
$tgl2=$_POST['tgl2'];
?>


<tr>
	<a href="#" style="font-size: 30px;"><img src="../img/logo2.jpg" width="10%">    &nbsp SMK CAHAYA HATI YAYASAN PENDIDIKAN AL-MAHMUDAH </a>
	<hr>
	<h4>Jl.Marsekal Surya Darma No.50 Kel. Selapajang Jaya RT.004 RW.004 Kec.Neglasari Tangerang Telp. 021-5590254</h4>
</tr>
<center>
Laporan Pinjaman Guru
</center>

<table class="table table-striped">
					<tr>
						<th>
							No
						</th>
						<th>
							NIP
						</th>
						<th>
							Kode Pinjam
						</th>
						<th>
							Tanggal 
						</th>
						<th>
							Besar Pinjam
						</th>
					</tr>
					
	<?php
	$no=1;	
	$query = mysql_query("SELECT * from tb_pinjam ");
	if (isset($_POST['tgl1'])&& isset($_POST['tgl2'])) {
	$query.="where tgl_mulai between '".$tgl1."' and '".$tgl2."'";
	}	

	while($data=mysql_fetch_array($query)){
		?>
		<tr>
						<td>
							<?php echo $no ; ?>
						</td>
					
						<td>
							<?php echo $data['nip'] ; ?>
						</td>
							<td>
							<?php echo $data['kode_pinjam'] ; ?>
						</td>
							<td>

							<?php echo date('d-m-Y', strtotime(($data['tgl_entri']))) ; ?>
						</td>
						<td>
							<?php echo $data['besar_pinjam'] ; ?>
						</td>
					</tr>
					<?php
					$no++;
						}
					?>
				</table>
			<br><br>
	<script>
					window.print();
				</script>



