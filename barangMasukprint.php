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
<body onLoad="window.print()">
<div class="container">
<?php
$kode_brg_servis = $_REQUEST['kode_brg_servis'];
$id_user = $_SESSION['id_user'];
$sql = mysqli_query($koneksi, "SELECT a.kode_produk, a.id_perusahaan, a.type_brg, a.no_seri_brg, a.kode_statusgaransi, a.keluhan_brg,a.kelengkapan_brg, 
									  b.nama_konsumen, b.alamat_konsumen, b.no_telp_konsumen,
									c.merek
					FROM barang_servis a, konsumen b ,rekanan_perusahaan c
					where a.id_konsumen = b.id_konsumen and a.id_perusahaan=c.id_perusahaan and a.kode_brg_servis='$kode_brg_servis'");
					
					
//Variabel Data Barang Dan Konsumen
list($kode_produk, $id_perusahaan, $type_brg, $no_seri_brg, $kode_statusgaransi, $keluhan_brg,$kelengkapan_brg, 
										$nama_konsumen, $alamat_konsumen, $no_telp_konsumen,
										$merek) = mysqli_fetch_array($sql);										
//Variabel Data Status				
$sqlstts = mysqli_query($koneksi, "SELECT tgl_masuk, statusbrg_update from statusbrg_update where kode_brg_servis='$kode_brg_servis'");						
list($tanggal,$statusbrg_update )= mysqli_fetch_array($sqlstts);

//Variabel Data Status				
$sqlmodel = mysqli_query($koneksi, "SELECT nama_produk from jenis_produk where kode_produk='$kode_produk'");						
list($jenis_barang)= mysqli_fetch_array($sqlmodel);
																
										echo '
<center><b><h3>ASC SYAILENDRA ELEKTRONIK</h3></B></center>									
<center><h5>Jl. Tlogobiru II No.28 Semarang Telp 024-76743033/76729880</h5></center>
<center><h3>---------------------------Tanda Trima Servis Masuk----------------------------</h3></center>
<hr/>
<table class="table table-nobordered" style="font-size:18px">
<thead>
<tr class="info">
		<th width="14%">TTSM</th>
		<th width="2%">:</th>
		<th width="35%">'.$kode_brg_servis.'</th>
		<th width="0%"></th>
		<th align=right width="14%">Tgl Masuk</th>
		<th width="2%">:</th>
		<th align=right width="35%">'.date("d M Y", strtotime($tanggal)).'</th>
</tr>

<tr class="info" >
		<th width="14%">Merek</th>
		<th width="2%">:</th>
		<th width="35%%">'.$merek.'</th>
		<th width="0%"></th>
		<th width="14%">Type Barang</th>
		<th width="2%">:</th>
		<th width="35%">'.$type_brg.'</th>
</tr>

<tr class="info">
		<th width="14%">Nama Konsumen</th>
		<th width="2%">:</th>
		<th width="35%%">'.$nama_konsumen.'</th>
		<th width="0%"></th>
		<th width="14%">Status Garansi</th>
		<th width="2%">:</th>
		<th width="35%">'.$kode_statusgaransi.'</th>
</tr>

<tr class="info">
		<th width="14%">Alamat Konsumen</th>
		<th width="2%">:</th>
		<th width="35%%">'.$alamat_konsumen.'</th>
		<th width="0%"></th>
		<th width="14%">No Telp</th>
		<th width="2%">:</th>
		<th width="35%">'.$no_telp_konsumen.'</th>
</tr>
</thead>
</table>

</br>

<table width="1000" bordered=0 style="font-size:18px" >
<thead>
<tr class="info">
		<th width="20%">Kelengkapan Barang</th>
		<th width="2%">:</th>
		<th width="78%">'.$kelengkapan_brg.'</th>
</tr>
<tr class="info">
		<th width="20%">Keluhan/Kerusakan</th>
		<th width="2%">:</th>
		<th width="78%">'.$keluhan_brg.'</th>
</tr>
</thead>
</table>
<p>';

$sql = mysqli_query($koneksi, "SELECT nama FROM user WHERE id_user='$id_user'");
list($nama) = mysqli_fetch_array($sql);
echo '
</br>
<hr>
<table width="1000" bordered=0 style="font-size:18px">
 
 <tr>
    <td width=50%><h5><b><center>Konsumen</center></b></h5></td>
    <td width=50%><h5><b><center>Admin</center></b></h5></td>
  </tr>
</table>
</br>
<table width="1000" bordered=0 style="font-size:18px">   
	<tr>
		<td width=50%><h5><b><center><u>__________________</u></center></b></h5></td>
		<td width=50% ><h5><b><center><u>'.$nama.'</u></center></b></h5></td>
	</tr>
 </table>
<hr>';



echo '
<center>----------------- Simpan Dan Bawa Tanda Terima Ini Untuk Pengambilan Barang ---------------- </center>
</br>
<center>----------------------------------------------------------------------------------------------------potong disini---------------------------------------------------------------------------------------------------</center>
<center><h3><b>ASC SYAILENDRA ELEKTRONIK</b></h3></center>
<center><h3><b>------------------------- Form Pengerjaan Teknisi -------------------------</b></h3></center>
<hr>
<table width="1000" bordered=0 style="font-size:18px">
<tr class="info">
		<th width="14%">No TTSM</th>
		<th width="2%">:</th>
		<th width="20%">'.$kode_brg_servis.'</th>
		<th width="14%">Nama Kons</th>
		<th width="2%">:</th>
		<th width="20%">'.$nama_konsumen.'</th>
		<th width="14%">Tangal Masuk</th>
		<th width="2%">:</th>
		<th width="20%">'.date("d M Y", strtotime($tanggal)).'</th>
</tr>
<tr class="info">
		<th width="14%">Merek</th>
		<th width="2%">:</th>
		<th width="20%">'.$merek.'</th>
		<th width="14%">Jenis Barang</th>
		<th width="2%">:</th>
		<th width="20%">'.$jenis_barang.'</th>
		<th width="14%">Type Barang</th>
		<th width="2%">:</th>
		<th width="20%">'.$type_brg.'</th>
</tr>
</table>
<hr>
<table width="1000" bordered=0 style="font-size:18px">
<thead>
<tr class="info">
		<th width="20%">Kelengkapan Barang</th>
		<th width="2%">:</th>
		<th width="78%">'.$kelengkapan_brg.'</th>
</tr>
<tr class="info">
		<th width="20%">Keluhan/Kerusakan</th>
		<th width="2%">:</th>
		<th width="78%">'.$keluhan_brg.'</th>
</tr>
</thead>
</table>
<center><h3><b>Penggantian Sparepart</b></h3></center>
<table class="table table-bordered" style="font-size:18px">
  <tr>
    <td width="5%">No</td>
    <td width="30%">Kode Sparepart</td>
    <td width="50%">Nama Sparepart</td>
    <td width="15%">Jumlah Ganti</td>
  </tr>
  ';
   for($no=1;$no<=4;$no++){
  echo'
  <tr>
    <td>'.$no.'</td>
	<td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>';
   }
   echo'
  
</table>

<table width="1000" bordered=0>
 
 <tr>
    <td width=50%><h5><b><center>Teknisi</center></b></h5></td>
    <td width=50%><h5><b><center>Admin</center></b></h5></td>
  </tr>
</table>
</br></br></br>
<table width="1000" bordered=0>   
	<tr>
		<td width=50%><h5><b><center><u>__________________</u></center></b></h5></td>
		<td width=50% ><h5><b><center><u>'.$nama.'</u></center></b></h5></td>
	</tr>
 </table>
<hr>


</div>
</div>
</body>
</html>';
}
?>