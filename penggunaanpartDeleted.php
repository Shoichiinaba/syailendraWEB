<?php
if(empty($_SESSION['id_user'])){
$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login
terlebih dahulu.';
header('Location: ./');
die();
}
else{
if(isset($_REQUEST['submit'])){
$kode_part = $_REQUEST['kode_part'];
$kode_brg_servis=$_REQUEST['kode_brg_servis'];
$kode_dtl_pengerjaan=$_REQUEST['kode_dtl_pengerjaan'];

//cek sparepart
$sql = mysqli_query($koneksi, "SELECT a.jml_pakai, b.jml_stok
								FROM detail_pengerjaan a, sparepart b
								WHERE a.kode_part=b.kode_part and a.kode_dtl_pengerjaan='$kode_dtl_pengerjaan' and a.kode_part= '$kode_part'");
list($jml_pakai, $jml_stok) = mysqli_fetch_array($sql);
//Kembalikan Ke sttok awal
$sisastok=$jml_pakai + $jml_stok;
$sql = mysqli_query($koneksi, "UPDATE sparepart SET jml_stok='$sisastok'
												 where kode_part='$kode_part'");
//Hapus Data Penggunaan Part pada Detail Pengerjaan
$sql = mysqli_query($koneksi, "DELETE FROM detail_pengerjaan WHERE kode_dtl_pengerjaan='$kode_dtl_pengerjaan' and kode_part='$kode_part'");
if($sql == true){
header('Location: ./admin.php?hlm=barangpengerjaanadd&kode_brg_servis='.$kode_brg_servis.'');
die();
}
}
}
?>