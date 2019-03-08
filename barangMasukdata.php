<?php
if(empty($_SESSION['id_user'])){
$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login
terlebih dahulu.';
header('Location: ./');
die();
}
else{
?>
<html>
<head>
<link href="css/bootstrap.css" rel="stylesheet"/>
</head>

<div class="container">
<?php
$kode_brg_servis = $_REQUEST['kode_brg_servis'];
$id_user = $_SESSION['id_user'];
$sql = mysqli_query($koneksi, "SELECT a.kode_produk, a.id_perusahaan, a.type_brg, a.no_seri_brg, a.kode_statusgaransi, a.keluhan_brg,a.kelengkapan_brg,
									  b.nama_konsumen, b.alamat_konsumen, b.no_telp_konsumen
								FROM barang_servis a, konsumen b 
								where a.id_konsumen = b.id_konsumen and  a.kode_brg_servis='$kode_brg_servis'");			
//Variabel Data Barang Dan Konsumen
list($kode_produk, $id_perusahaan, $type_brg, $no_seri_brg, $status_garansi, $keluhan_brg,$kelengkapan_brg, 
										$nama_konsumen, $alamat_konsumen, $no_telp_konsumen) = mysqli_fetch_array($sql);										
//Variabel Data Status				
$sqlstts = mysqli_query($koneksi, "SELECT tgl_masuk, statusbrg_update from statusbrg_update where kode_brg_servis='$kode_brg_servis'");						
list($tanggal,$statusbrg_update )= mysqli_fetch_array($sqlstts);

//Variabel Data Status				
$sqlmodel = mysqli_query($koneksi, "SELECT nama_produk from jenis_produk where kode_produk='$kode_produk'");						
list($jenis_barang)= mysqli_fetch_array($sqlmodel);
																
echo '
<center><h3>Data Barang Servis Masuk</h3></center>
<hr/>
<h4>No TTSM : <b>'.$kode_brg_servis.'</b></h4>
<table class="table table-nobordered">

<tr class="info">
		<th width="22%">Tanggal</th>
		<td width="75%%">:  '.date("d M Y", strtotime($tanggal)).'</td>
		
</tr>
<tr class="info">
	    <th width="22%">Jenis Barang</th>
		<td width="75%">:  '.$jenis_barang.'</td>
</tr>
<tr class="info">
	    <th>Type Barang</th>
		<td width="75%">:  '.$type_brg.'</td>
</tr>
<tr class="info">
		<th>No Seri</th>
		<td width="75%">:  '.$no_seri_brg.'</td>
</tr>
<tr class="info">
		<th>Status Garansi</th>
		<td width="75%">:  '.$status_garansi.'</td>
</tr>
<tr class="info">		
		<th>Keluhan/Kerusakan</th>
		<td width="75%">:  '.$keluhan_brg.'</td>
</tr>
<tr class="info">
		<th>Kelengkapan</th>
		<td width="75%">:  '.$kelengkapan_brg.'</td>
</tr>

<tr class="info">
		<th>Nama Konsumen</th>
		<td width="75%">:  '.$nama_konsumen.'</td>
</tr>

<tr class="info">
	<th>Alamat Konsumen</th>
	<td width="75%">:  '.$alamat_konsumen.'</td>
</tr>

<tr class="info">
	<th>No Telp Konsumen</th>
	<td width="75%">:  '.$no_telp_konsumen.'</td>
</tr>

<tr class="info">
	<th><h4>Status Update Barang</h4></th>
	<th width="75%"><h4>:  '.$statusbrg_update.'</h4></th>
</tr>



</table>

<div style="margin: 0 0 50px 75%;">';
if ($statusbrg_update!=='Keluar'){
echo '<a href="./admin.php?hlm=barangmasukedit&kode_brg_servis='.$kode_brg_servis.'" class="btn btn-danger">Edit</a>
<a href="?hlm=barangmasukprint&kode_brg_servis='.$kode_brg_servis.'" id="tombol"   class="btn btn-success btn-s"><span class="glyphicon glyphicon-print" ariahidden="true"></span>Cetak</a>';
}
echo '
<a href="?hlm=barangmasukcari" id="tombol" class="btn btn-info pullleft"><span class="glyphicon glyphicon-chevron-left" ariahidden="true"></span> Kembali</a><br/><br/><br/>
</div>
</br>
</div>
</body>
</html>';
}
?>