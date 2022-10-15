<?php
include "config/koneksi.php";
$ba=mysql_query("SELECT * FROM tb_tabungan");
$no=1;
while($datak=mysql_fetch_array($ba))
{
  $ct=$dataku['tgl_mulai'];$tang=date("Y-m-d");$kode_tab=$datak['kode_tabungan'];
  $tempo=date('Y-m-d',strtotime('+30 day',strtotime($ct)));
  if($tempo==$tang)
  {
    $total=$dataku['besar_tabungan']+10000;
    $tol=mysql_query("UPDATE tb_tabungan set tgl_mulai='$tang',besar_tabungan='$total' where kode_tabungan='$kode_tab'");
  }
  else
  {
    
  }
  $no++;
} 
$a=mysql_query("SELECT * from tb_siswa");
$b=mysql_num_rows($a);
$c=mysql_query("SELECT * from tb_guru");
$e=mysql_fetch_array(mysql_query("SELECT SUM(besar_tabungan) as total_tabungan from tb_tabungan"));
$f=mysql_fetch_array(mysql_query("SELECT SUM(besar_tabungan) as total_tabungan from tb_tabungansiswa"));


?>
<?php 
if($_SESSION['level']=='admin')
 { ?>
 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Dashboard</h1>
                    </div><!-- /.col-lg-12 -->
                </div><!-- /.row -->
  <div class="row">
  <div class="col-xl-3 col-md-6 mb-4">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-check-circle fa-3x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge"><?php echo $b; ?></div>
										<div><h4>Siswa Terdaftar</h4></div>
									</div>
								</div>
							</div>
							<a href="index.php?pilih=1.4">
								<div class="panel-footer">
									<span class="pull-left">Lihat Rincian</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div><!-- /.panel-green -->
					
         
        
          <div class="col-xl-3 col-lg-6 col-md-6">
						<div class="panel panel-danger">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-plus-circle fa-3x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">Rp.<?=number_format($e['total_tabungan'],2,',','.');?></div>
										<div><h4>Tabungan Guru</h4></div>
									</div>
								</div>
							</div>
							<a href="index.php?pilih=1.3">
								<div class="panel-footer">
									<span class="pull-left">Lihat Rincian</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div><!-- /.panel-green -->
          <div class="col-xl-3 col-lg-6 col-md-6">
						<div class="panel panel-danger">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-plus-circle fa-3x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">Rp.<?=number_format($f['total_tabungan'],2,',','.');?></div>
										<div><h4>Tabungan Siswa</h4></div>
									</div>
								</div>
							</div>
							<a href="index.php?pilih=1.5">
								<div class="panel-footer">
									<span class="pull-left">Lihat Rincian</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div><!-- /.panel-green -->
      
 <?php }
else if($_SESSION['level']=='kepsek')
 { ?>
<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>
          <div class="row">
  <div class="col-xl-3 col-md-6 mb-4">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-check-circle fa-3x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge"><?php echo $b; ?></div>
										<div><h4>Siswa Terdaftar</h4></div>
									</div>
								</div>
							</div>
							<a href="index.php?pilih=1.4">
								<div class="panel-footer">
									<span class="pull-left">Lihat Rincian</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div><!-- /.panel-green -->
			
  
        <div class="col-xl-3 col-md-6 mb-4">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-dollar-sign fa-3x"></i>
									</div>
									<div class="col-xs-9 text-right"><h3>Tabungan</h3></div>
                      <div class="h3 mb-0 font-weight-bold text-white-800">Rp.<?=number_format($e['total_tabungan'],2,',','.');?></div>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
        </div>
        <?php }
else if($_SESSION['level']=='guru')
 { ?>
<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>
          <div class="row">
  <div class="col-xl-3 col-md-6 mb-4">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-check-circle fa-3x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge"><?php echo $c; ?></div>
										<div><h4>Guru Terdaftar</h4></div>
									</div>
								</div>
							</div>
						</div>
					</div><!-- /.panel-green -->
		
				
        <div class="col-xl-3 col-md-6 mb-4">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-dollar-sign fa-3x"></i>
									</div>
									<div class="col-xs-9 text-right"><h3>Tabungan</h3></div>
                      <div class="h3 mb-0 font-weight-bold text-white-800">Rp.<?=number_format($e['total_tabungan'],2,',','.');?></div>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
        </div>
<?php }
 ?>

</div></div></div>
<div class="row mt">
  <div class="col-lg-12">
     <div class="form-panel">
     <div class="row">
        <?php 
        
        $tabung=mysql_fetch_array(mysql_query("SELECT sum(besar_tabungan) as tabung from tb_tabungan"));

        $ambil=mysql_fetch_array(mysql_query("SELECT sum(besar_ambil) as ambil from tb_pengambilan"));
        
      
        $pengambilan=$ambil['ambil'];
        $sisapen=$pendapatan-$pengambilan;
 $tabunga=mysql_fetch_array(mysql_query("SELECT sum(besar_tabungan) as tabunga from tb_tabungansiswa"));
 $ambil1=mysql_fetch_array(mysql_query("SELECT sum(besar_ambil) as ambil1 from tb_pengambilansiswa"));
 $pendapp=$tabunga['tabunga'];
 $pengambil=$$ambil1['ambil1'];
        ?>
           <div class="col-xl-3 col-lg-6 col-md-6">
						<div class="panel panel-danger">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-plus-circle fa-3x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge"><?php echo 'Rp. '.number_format($pendapp);?></div>
										<div><h4>Saldo Tabungan siswa</h4></div>
									</div>
								</div>
							</div>
							
						</div>
					</div><!-- /.panel-green -->
			
					
					  <div class="col-xl-3 col-lg-6 col-md-6">
						<div class="panel panel-danger">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-plus-circle fa-3x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge"><?php echo 'Rp. '.number_format($pengambilan);?></div>
										<div><h4>Pengambilan</h4></div>
									</div>
								</div>
							</div>
							
						</div>
					</div><!-- /.panel-green -->
					 <div class="col-xl-3 col-lg-6 col-md-6">
						<div class="panel panel-danger">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-plus-circle fa-3x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge"><?php echo 'Rp. '.number_format($sisapen);?></div>
										<div><h4>Saldo Tabungan Guru Tersisa</h4></div>
									</div>
								</div>
							</div>
							
						</div>
					</div><!-- /.panel-green -->
     
            </div>
          </div>
        </div>
          
  </div>
</div>
</div>