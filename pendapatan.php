<?php
include 'config/koneksi.php';
//pendapatan
$a=mysql_fetch_array(mysql_query("SELECT SUM('besar_tabungan') as besar_tabungan from tb_tabungan"));
$b=$a['besar_tabungan'];
$c=mysql_fetch_array(mysql_query("SELECT SUM('besar_angsuran') as besar_angsur from tb_angsur"));

?>