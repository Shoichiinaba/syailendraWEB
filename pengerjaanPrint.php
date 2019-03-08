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
<body onload="window.print()">
<div class="container">
<?php
$id_user=$_SESSION['id_user'];
$kode_brg_servis = $_REQUEST['kode_brg_servis'];
$sql = mysqli_query($koneksi, "SELECT a.type_brg, a.keluhan_brg,a.kelengkapan_brg, 
									  b.nama_konsumen, b.alamat_konsumen, b.no_telp_konsumen,
									  c.kategori_jasa,
									  d.nama_teknisi,
									  e.kode_pengerjaan,
									  f.tgl_pengerjaan
					FROM barang_servis a, konsumen b , biaya_jasa c, teknisi d, pengerjaan e, statusbrg_update f
					where a.kode_brg_servis=f.kode_brg_servis and a.kode_brg_servis=e.kode_brg_servis and e.kode_jasa=c.kode_jasa and e.id_teknisi=d.id_teknisi and a.id_konsumen = b.id_konsumen and a.kode_brg_servis='$kode_brg_servis'");
list($type_brg, $keluhan_brg, $kelengkapan_brg, 
	$nama_konsumen, $alamat, $no_telp,
	$kategori_jasa,
	$nama_teknisi,
	$kode_pengerjaan,
	$tanggal)=mysqli_fetch_array($sql);
					
if(mysqli_num_rows($sql) > 0){
$no = 0;
echo '

<center><h3><b>ASC SYAILENDRA ELEKTRONIK</b></h3></center>
<center><h3><b>------------------------- Form Pengerjaan Teknisi -------------------------</b></h3></center>
<hr>
</br>
<table width="1000" bordered=0 style="font-size:18px">
<tr class="info">
		<th width="14%">No TTSM</th>
		<th width="2%">:</th>
		<th width="20%">'.$kode_brg_servis.'</th>
		<th width="14%">Type Barang</th>
		<th width="2%">:</th>
		<th width="20%">'.$type_brg.'</th>
		<th width="14%">Tangal Masuk</th>
		<th width="2%">:</th>
		<th width="20%">'.date("d M Y", strtotime($tanggal)).'</th>
</tr>
<tr class="info">
		<th width="14%">Nama Kons</th>
		<th width="2%">:</th>
		<th width="20%">'.$nama_konsumen.'</th>
		<th width="14%">Alamat</th>
		<th width="2%">:</th>
		<th width="20%">'.$alamat.'</th>
		<th width="14%">No. Telp</th>
		<th width="2%">:</th>
		<th width="20%">'.$no_telp.'</th>

</tr>
</table>
</br>
</br>
</br>
<table class="table table-nobordered" style="font-size:18px">
  <tr>
    <th width="12%">Keluhan/Kerusakan</th>
    <th width="3%">:</th>
    <th width="80%">'.$keluhan_brg.'</th>
  </tr>
  <tr>
    <th >Kelengkapan</th>
    <th>:</th>
    <th >'.$kelengkapan_brg.'</th>
  </tr>
    <tr>
    <td ></td>
    <td></td>
    <td ></td>
  </tr>
</table>

<table width="1000" bordered=0 style="font-size:18px">
<tr class="info">
		<th width="14%">Teknisi</th>
		<th width="2%">:</th>
		<th width="80%">'.$nama_teknisi.'</th>
</tr>
<tr class="info">
		<th width="14%">Jenis Jasa</th>
		<th width="2%">:</th>
		<th width="80%">'.$kategori_jasa.'</th>
</tr>
</table>
</br>
<center><h3><b>Penggantian Sparepart</b></h3></center>
<div class="col-sm-7">
<table class="table table-bordered" style="font-size:18px">
<thead>
<tr class="info">
<th width="2%">No</th>
<th width="15%">Kode Sparepart</th>
<th width="15%">Nama Sparepart</th>
<th width="5%">Jumlah Pakai</th>
</tr>
</thead>
';
$sql = mysqli_query($koneksi, "SELECT a.kode_part, a.jml_pakai,
									b.nama_part	,b.harga_part
									FROM detail_pengerjaan a, sparepart b
									where a.kode_part=b.kode_part and a.kode_brg_servis='$kode_brg_servis'");

if(mysqli_num_rows($sql) > 0){
$no = 0;
while($row = mysqli_fetch_array($sql)){
$no++;
echo '
		<tr>
			<td>'.$no.'</td>
			<td>'.$row['kode_part'].'</td>
			<td>'.$row['nama_part'].'</td>
			<td><center>'.$row['jml_pakai'].'</center></td>
		</tr>';
}
}
else{
echo '<td colspan="8"><center><p class="add"><b>Tidak Ada Penggantian Sparepart</b></p></center></td></tr>';
}

echo'
</table>
<tbody>
</br></br></br></br>
</div>';

$sql = mysqli_query($koneksi, "SELECT nama FROM user WHERE id_user='$id_user'");
list($nama) = mysqli_fetch_array($sql);
echo '

<table width="1000" bordered=0 style="font-size:18px">
 
 <tr>
    <td width=50%><center>Teknisi</center></td>
    <td width=50%><center>Admin</center></td>
  </tr>
</table>
</br></br></br>
<table width="1000" bordered=0 style="font-size:18px">   
	<tr>
		<td width=50%><center><u>'.$nama_teknisi.'</u></center></td>
		<td width=50% ><center><u>'.$nama.'</u></center></td>
	</tr>
 </table>
<hr>

</div>
</body>
</html>';
}
?>
<?php
}
?>