<?php  
	session_start();
	//set jam
	date_default_timezone_set('Asia/Jakarta');
	class DataBase{
		private $host = "localhost";
		private $user = "root";
		private $pass = "";
		private $db = "db_sijam";

		public function sambungkan(){
			mysql_connect($this->host,$this->user,$this->pass);
			mysql_select_db($this->db);
		}
	}
	class Laporan{
		public function tampil_tabungan_bulan($bln1,$bln2){
			$qry = mysql_query("SELECT * FROM tb_tabungan BETWEEN '$bln1' AND '$bln2'");
			while ($pecah = mysql_fetch_array($qry)) {
				$data[]=$pecah;
			}
			$hitung = mysql_num_rows($qry);
			if ($hitung > 0) {
				return $data;
			}
			else{
				error_reporting(0);
			}
		}
		public function cek_penjualan_bulan($bln1,$bln2){
			$qry = mysql_query("SELECT * FROM tb_tabungan BETWEEN '$bln1' AND '$bln2'");
			$hitung = mysql_num_rows($qry);
			if ($hitung >=1) {
				return true;
			}
			else{
				return false;
			}
		}
		public function hitung_total_tabungan(){
			$qry = mysql_query("SELECT sum(besar_tabungan) as jumlah FROM tb_tabungan");
			$pecah = mysql_fetch_array($qry);
			$subtotal = $pecah['jumlah'];
			return $subtotal;
		}
		public function tampil_tabungan(){
			$qry = mysql_query("SELECT * FROM tb_tabungan");
			while ($pecah = mysql_fetch_array($qry)) {
				$data[]=$pecah;
			}
			$hitung = mysql_num_rows($qry);
			if ($hitung > 0) {
				return $data;
			}
			else{
				error_reporting(0);
			}
		}
		public function cek_tabungan(){
			$qry = mysql_query("SELECT * FROM tb_tabungan");
			$hitung = mysql_num_rows($qry);
			if ($hitung >=1) {
				return true;
			}
			else{
				return false;
			}
		}
		public function hitung_total_tabungan_bulan($bln1,$bln2){
			$qry = mysql_query("SELECT sum(besar_tabungan) as jumlah FROM tb_tabungan
				WHERE tgl_entri='$tgl_entri' BETWEEN '$bln1' AND '$bln2'");
			$pecah = mysql_fetch_array($qry);
			$subtotal = $pecah['jumlah'];
			return $subtotal;
		}
		//end penjualan

		public function tampil_pinjaman_bulan($bln1,$bln2){
			$qry = mysql_query("SELECT * FROM tb_pinjam pin
				JOIN tb_angsur ang ON pin.kode_pinjam = ang.kode_pinjam
				WHERE ang.tgl_entri BETWEEN '$bln1' AND '$bln2'");
			while ($pecah = mysql_fetch_array($qry)) {
				$data[]=$pecah;
			}
			$hitung = mysql_num_rows($qry);
			if ($hitung > 0) {
				return $data;
			}
			else{
				error_reporting(0);
			}
		}
		public function cek_pinjaman_bulan($bln1,$bln2){
			$qry = mysql_query("SELECT * FROM tb_pinjam pin
				JOIN tb_angsur ang ON pin.kode_pinjam = ang.kode_pinjam
				WHERE ang.tgl_entri BETWEEN '$bln1' AND '$bln2'");
			$hitung = mysql_num_rows($qry);
			if ($hitung >=1) {
				return true;
			}
			else{
				return false;
			}
		}
		public function hitung_total_pinjaman_bulan($bln1,$bln2){
			$qry = mysql_query("SELECT sum(pin.besar_pinjaman) as jumlah FROM tb_pinjam pin
				JOIN tb_angsur ang ON pin.kode_pinjam = ang.kode_pinjam
				WHERE ang.tgl_entri BETWEEN '$bln1' AND '$bln2'");
			$pecah = mysql_fetch_array($qry);
			$subtotal = $pecah['jumlah'];
			return $subtotal;
		}
		public function hitung_total_pinjaman(){
			$qry = mysql_query("SELECT sum(pin.besar_pinjaman) as jumlah FROM tb_pinjam pin
				JOIN tb_angsur ang ON pin.kode_pinjam = ang.kode_pinjam
				WHERE ang.tgl_entri BETWEEN '$bln1' AND '$bln2'");
			$pecah = mysql_fetch_array($qry);
			$subtotal = $pecah['jumlah'];
			return $subtotal;
		}
		public function tampil_pinjaman(){
			$qry = mysql_query("SELECT * FROM tb_pinjam pin
				JOIN tb_angsur ang ON pin.kode_pinjam = ang.kode_pinjam");
			while ($pecah = mysql_fetch_array($qry)) {
				$data[]=$pecah;
			}
			$hitung = mysql_num_rows($qry);
			if ($hitung > 0) {
				return $data;
			}
			else{
				error_reporting(0);
			}
		}
		public function cek_pinjaman(){
			$qry = mysql_query("SELECT * FROM tb_pinjam pin
				JOIN tb_angsur ang ON pin.kode_pinjam = ang.kode_pinjam");
			$hitung = mysql_num_rows($qry);
			if ($hitung >=1) {
				return true;
			}
			else{
				return false;
			}
		}

	class Cetak_Laporan{
		public function laporan_tabungan_bulan($bln1,$bln2){
			$qry = mysql_query("SELECT * FROM tb_tabungan
				WHERE tgl_entri='$tgl_entri' BETWEEN '$bln1' AND '$bln2'");
			while ($pecah = mysql_fetch_array($qry)) {
				$data[]=$pecah;
			}
			$hitung = mysql_num_rows($qry);
			if ($hitung > 0) {
				return $data;
			}
			else{
				error_reporting(0);
			}
		}
		public function laporan_semua_tabungan(){
			$qry = mysql_query("SELECT * FROM tb_tabungan");
			while ($pecah = mysql_fetch_array($qry)) {
				$data[]=$pecah;
			}
			$hitung = mysql_num_rows($qry);
			if ($hitung > 0) {
				return $data;
			}
			else{
				error_reporting(0);
			}
		}
		public function laporan_pinjaman_bulan($bln1,$bln2){
			$qry = mysql_query("SELECT * FROM tb_pinjam pin
				JOIN tb_angsur ang ON pin.kode_pinjam = ang.kode_pinjam
				WHERE ang.tgl_entri BETWEEN '$bln1' AND '$bln2'");
			while ($pecah = mysql_fetch_array($qry)) {
				$data[]=$pecah;
			}
			$hitung = mysql_num_rows($qry);
			if ($hitung > 0) {
				return $data;
			}
			else{
				error_reporting(0);
			}
		}
		public function laporan_semua_pinjaman(){
			$qry = mysql_query("SELECT * FROM tb_pinjam pin
				JOIN tb_angsur ang ON pin.kode_pinjam = ang.kode_pinjam
				");
			while ($pecah = mysql_fetch_array($qry)) {
				$data[]=$pecah;
			}
			$hitung = mysql_num_rows($qry);
			if ($hitung > 0) {
				return $data;
			}
			else{
				error_reporting(0);
			}
		}
	}
}
?>