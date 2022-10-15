
<?php
include "../config/koneksi.php";
$luy=$_GET['nip']; 
$nama=mysql_fetch_array(mysql_query("SELECT nama_guru from tb_guru where nip='$luy'"));
require('pdf/fpdf.php');
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
$pdf->MultiCell(19.5,0.5,'  Jl.Marsekal Surya Darma No.50 Kel. Selapajang Jaya RT.004 RW.004 Kec.Neglasari Tangerang 
',0,'L');
$pdf->MultiCell(19.5,0.5,'  Telp. 021-5590254',0,'L');
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,28.5,3.2);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(25.2,0.7,"Laporan Penarikan Guru ".$nama['nama_guru']."",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"\nDi cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(3, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Kode Ambil', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'NIP', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Kode Tabungan', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Besar Ambil', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Tanggal', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$query = mysql_query("SELECT * from  tb_pengambilan where nip='$luy'");
$no=1;
while($data=mysql_fetch_array($query)){
	$pdf->Cell(3, 0.8, $no,1, 0, 'C');
    $pdf->Cell(4, 0.8, $data['kode_ambil'],1, 0, 'C');
    $pdf->Cell(4, 0.8, $data['nip'], 1, 0,'C');
   
    $pdf->Cell(4, 0.8, $data['kode_tabungan'], 1, 0,'C');
    $pdf->Cell(4, 0.8, $data['besar_ambil'], 1, 0,'C');
     $pdf->Cell(4, 0.8, $data['tgl_ambil'], 1, 1,'C');$no++;}
$hasil=mysql_fetch_array(mysql_query("SELECT sum(besar_ambil) as besar from tb_pengambilanguru where nip='$luy'"));
$pdf->Cell(15, 0.8, 'Total', 1, 0, 'C');
$pdf->Cell(8, 0.8, number_format($hasil['besar']), 1, 0, 'C');

$pdf->Output("Laporan Penarikan guru.pdf","I");

?>

