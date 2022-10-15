
<?php
include "../config/koneksi.php";
$kode=$_GET['nis'];
$kode_tabungan=$_GET['kode_tabungan'];
$kode_setor=$_GET['kode_setor'];
$nama=mysql_fetch_array(mysql_query("SELECT nama_siswa from tb_siswa where nis='$kode'"));


require('pdf/fpdf.php');
$pdf = new FPDF("L","cm","A4");
$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',11);
$pdf->MultiCell(19.5,0.5,'',0,'L'); 
$pdf->SetX(4);   
$pdf->Image('../logo2.jpg',2,1.3,2,1.6);
$pdf->SetX(4); 
$pdf->MultiCell(19.5,0.5,'  SIMPAN PINJAM SMK CAHAYA HATI',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'  YAYASAN PENDIDIKAN AL-MAHMUDAH ',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'  Jl.Marsekal Surya Darma No.50 Kel. Selapajang Jaya RT.004 RW.004 Kec.Neglasari Tangerang Telp. 021-5590254
',0,'L');
$pdf->SetX(4);
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,28.5,3.2);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$angg=mysql_fetch_array(mysql_query("SELECT nama_siswa from tb_siswa where nis='$kode'"));
$angu=mysql_fetch_array(mysql_query("SELECT besar_tabungan from tb_tabungansiswa where nis='$kode'"));
$angu2=mysql_fetch_array(mysql_query("SELECT kode_tabungan from tb_tabungansiswa where nis='$kode'"));
$pdf->Cell(25.2,0.7,"Laporan Setoran Siswa ".$angg['nama_siswa']."",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"\nDi cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->Cell(5,0.7,"\nNo Rek Tabungan : ".$angu2['kode_tabungan']."",0,0,'C');
$pdf->ln(1);
$pdf->Cell(5,0.7,"\nJumlah Saldo Tabungan Saat ini : ".$angu['besar_tabungan']."",0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(2, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Kode setor', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Besar Setor', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'No.Induk Siswa', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Petugas Input', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Tanggal setor', 1, 1, 'C');

$pdf->SetFont('Arial','',10);

$q=mysql_query("SELECT * from tb_setorsiswa where kode_setor='$kode_setor' AND nis='$kode'");
$no=1;
while($data=mysql_fetch_array($q)){
$pdf->Cell(2, 0.8, $no, 1, 0, 'C');
$pdf->Cell(4, 0.8, $data['kode_setor'], 1, 0, 'C');
$pdf->Cell(4, 0.8, $data['besar_simpanan'], 1, 0, 'C');
$pdf->Cell(4, 0.8, $data['nis'], 1, 0, 'C');
$pdf->Cell(4, 0.8, $data['user_entry'], 1, 0, 'C');
$pdf->Cell(4, 0.8, $data['tgl_entri'], 1, 0, 'C');

$pdf->Cell(4, 0.8, "-", 1, 1, 'C');

$no++;}

$pdf->Output("Laporan Tabungan Siswa Setor.pdf","I");

?>

