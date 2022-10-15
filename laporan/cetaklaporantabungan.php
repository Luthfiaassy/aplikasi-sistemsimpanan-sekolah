
<?php
include "../config/koneksi.php";
$tgl1=$_POST['tgl1'];
$tgl2=$_POST['tgl2'];
require('fpdf/fpdf.php');
$pdf = new FPDF("L","cm","A4");


$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',11);
$pdf->MultiCell(19.5,0.5,'',0,'L'); 
$pdf->SetX(4);   
$pdf->SetFont('Arial','B',10);
$pdf->SetX(4);
$pdf->Image('../logo2.jpg',2,1.3,2,1.6);
$pdf->SetX(4); 
$pdf->MultiCell(19.5,0.5,'  SIMPAN PINJAM SMK CAHAYA HATI',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'  YAYASAN PENDIDIKAN AL-MAHMUDAH ',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'  Jl.Marsekal Surya Darma No.50 Kel. Selapajang Jaya RT.004 RW.004 Kec.Neglasari Tangerang Telp. 021-5590254
',0,'L');  
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(25.2,0.7,"Laporan Tabungan Guru",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"\nDi cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(3, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'No Induk Pengajar', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Kode Tabungan', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Besar Tabungan', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Tanggal Mulai', 1, 1, 'C');
$pdf->SetFont('Arial','',10);

	
	$no=1;	
	$query = mysql_query("SELECT * from tb_tabungan ");
	if (isset($_POST['tgl1'])&& isset($_POST['tgl2'])) {
	$query.="where tgl_mulai between '".$tgl1."' and '".$tgl2."'";
	}	

	while($data=mysql_fetch_array($query)){
$pdf->Cell(3, 0.8, $no, 1, 0, 'C');
$pdf->Cell(5, 0.8, $data['nip'], 1, 0, 'C');
$pdf->Cell(4, 0.8, $data['kode_tabungan'], 1, 0, 'C');
$pdf->Cell(4, 0.8, number_format($data['besar_tabungan']), 1, 0, 'C');
$pdf->Cell(4, 0.8, $data['tgl_mulai'], 1, 1, 'C');
$no++;}
$pdf->Output("Laporan Seluruh tabungan guru.pdf","I");

?>

