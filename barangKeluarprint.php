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
$kode_brg_servis = $_REQUEST['kode_brg_servis'];
$id_user=$_SESSION['id_user'];
$sql = mysqli_query($koneksi, "SELECT a.type_brg, a.keluhan_brg, a.kelengkapan_brg, a.kode_statusgaransi,
									  b.nama_konsumen, b.alamat_konsumen, b.no_telp_konsumen,
									  c.kategori_jasa, c.biaya_jasa,
									  d.nama_teknisi,
									  e.kode_pengerjaan,
									  f.tgl_pengerjaan, f.statusbrg_update,
									  g.keterangan
									  
					FROM barang_servis a, konsumen b , biaya_jasa c, teknisi d, pengerjaan e, statusbrg_update f, status_garansi g
					where a.kode_brg_servis=f.kode_brg_servis and a.kode_statusgaransi=g.kode_statusgaransi and a.kode_brg_servis=e.kode_brg_servis and e.kode_jasa=c.kode_jasa and e.id_teknisi=d.id_teknisi and a.id_konsumen = b.id_konsumen and a.kode_brg_servis='$kode_brg_servis'");
list($type_brg, $keluhan_brg, $kelengkapan_brg, $kode_statusgaransi,
	$nama_konsumen, $alamat, $no_telp,
	$kategori_jasa, $biaya_jasa,
	$nama_teknisi,
	$kode_pengerjaan,
	$tgl_pengerjaan, $statusbrg_update,
	$keterangan_garansi)=mysqli_fetch_array($sql);
$kode_brg_keluar='K'.$kode_brg_servis;	
if(mysqli_num_rows($sql) > 0){
$no = 0;
echo '
<center><b><h3>ASC SYAILENDRA ELEKTRONIK</h3></B></center>									
<center><h5>Jl. Tlogobiru II No.28 Semarang Telp 024-76743033/76729880</h5></center>
<center><h3><b>------------------------- Tanda Terima Servis Keluar-------------------------</b></h3></center>
<hr>
</br>
<table width="1000" bordered=0 style="font-size:18px">
<tr class="info">
		<th width="14%"></th>
		<th width="2%"></th>
		<th width="20%"></th>
		<th width="14%"></th>
		<th width="2%"></th>
		<th width="20%"></th>
		<th width="14%">No TTSK</h4></th>
		<th width="2%">:</th>
		<th width="20%">'.$kode_brg_keluar.'</th>
</tr>
<tr class="info">
		<th width="14%"></th>
		<th width="2%"></th>
		<th width="20%"></th>
		<th width="14%"></th>
		<th width="2%"></th>
		<th width="20%"></th>
		<th width="14%">Tanggal</h4></th>
		<th width="2%">:</th>
		<th width="20%">'.date("d M Y").'</th>
</tr>
</table>
</br>
<table width="1000" bordered=0 style="font-size:18px">
<tr class="info">
		<th width="14%">Type Barang</th>
		<th width="2%">:</th>
		<th width="20%">'.$type_brg.'</th>
		<th width="14%">No TTSM</th>
		<th width="2%">:</th>
		<th width="20%">'.$kode_brg_servis.'</th>
		<th width="14%">No PBS</th>
		<th width="2%">:</th>
		<th width="20%">'.$kode_pengerjaan.'</th>
</tr>

<tr class="info">
		<th width="14%">Nama Kons</th>
		<th width="2%">:</th>
		<th width="20%">'.$nama_konsumen.'</th>
		<th width="14%">Alamat Kons</th>
		<th width="2%">:</th>
		<th width="20%">'.$alamat.'</th>
		<th width="14%">No Telpon</th>
		<th width="2%">:</th>
		<th width="20%">'.$no_telp.'</th>
</tr>
</table>
</br>
<table width="1000" bordered=0 style="font-size:18px">
<tr class="info">
		<th width="14%">Keluhan</th>
		<th width="2%">:</th>
		<th width="20%">'.$keluhan_brg.'</th>
		<th width="14%">Kelengkapan</th>
		<th width="2%">:</th>
		<th width="20%">'.$kelengkapan_brg.'</h4></th>
		<th width="14%"></th>
		<th width="2%"></th>
		<th width="20%"></th>
</tr>
</table>
</br></br>
<table class="table table-nobordered" style="font-size:18px">
   <tr>
    <th width=12%>Teknisi</th>
    <th>:</th>
    <th width=84%>'.$nama_teknisi.'</th>
  </tr>
  <tr>
    <th>Jenis Jasa</th>
    <th>:</th>
    <th>'.$kategori_jasa.'</th>
  </tr>
  <tr>
    <th><b>Garansi</th>
    <th>:</th>
    <th>'.$keterangan_garansi.'</td>
  </tr>
  <tr>
    <td ></td>
    <td></td>
    <td ></b></td>
  </tr>

  
  </table>

<div class="col-sm-7">
<center><h3><b>Rincian Biaya</b></h3></center>
<table class="table table-bordered" style="font-size:18px">
<thead>
<tr class="info">
<b><th width="2%"><center>No</center></th>
<th width="10%"><center>Kode Sparepart</center></th>
<th width="20%"><center>Nama Sparepart</center></th>
<th width="8%"><center>Jumlah Pakai</center></th>
<th width="10%"><center>Harga</center></th>
</b>
</tr>
</thead>
';
$sql = mysqli_query($koneksi, "SELECT a.kode_part, a.jml_pakai,
									b.nama_part	,b.harga_part
									FROM detail_pengerjaan a, sparepart b
									where a.kode_part=b.kode_part and a.kode_brg_servis='$kode_brg_servis'");
$totalbiayapart=0;
$potongangaransi=0;
if(mysqli_num_rows($sql) > 0){
$no = 0;
while($row = mysqli_fetch_array($sql)){
$no++;
//total biaya per item part
$biayapart=$row['harga_part']*$row['jml_pakai'];
echo '
	<tr>
		<td><center>'.$no.'</center></td>
		<td>'.$row['kode_part'].'</td>
		<td>'.$row['nama_part'].'</td>
		<td><center>'.$row['jml_pakai'].' PCS</center></td>
		<td align=right>Rp.&nbsp;&nbsp;'.number_format($biayapart,0,".",".").'</td>
	</tr>' ;
//Total biaya All Sparepart
	$totalbiayapart=$totalbiayapart+$biayapart;
}
}
else{
	echo '<td colspan="8"><center><p class="add"><b>Tidak Ada Penggantian Sparepart</b></p></center></td></tr>';
}
//Grand Total Biaya
$grandtotal=$totalbiayapart+$biaya_jasa;
//Potongan Garansi
if ($kode_statusgaransi=='FG'){
$potongangaransi=$grandtotal;
}
else if($kode_statusgaransi=='GP'){
$potongangaransi=$totalbiayapart;
}
else if($kode_statusgaransi=='GS'){
$potongangaransi=$biaya_jasa;
}
else{
$potongangaransi=0;
}
//Total Bayar
$totalbayar=$grandtotal-$potongangaransi;
echo'
</table>
<tbody>
<div class="col-sm-13">
<table class="table table-nobordered" style="font-size:18px">
  <tr>
    <th width="40%">&nbsp;</th>
    <th width="30%">Total Biaya Sparepart</th>
    <th width="3%">:</b></h5></th>
	<th width="3%">Rp.</th>
    <th width="12%" align=right>'.number_format($totalbiayapart,0,".",".").'</th>
  </tr>
  <tr>
    <th>&nbsp;</th>
    <th>Biaya Jasa</th>
    <th>:</th>
	<th>Rp.</th>
    <th align=right>'.number_format($biaya_jasa,0,".",".").'</th>
  </tr>
  <tr>
    <th>&nbsp;</th>
    <th>Grand Total</th>
    <th>:</th>
	<th>Rp.</th>
    <th align=right>'.number_format($grandtotal,0,".",".").'</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <th>Potongan Garansi</th>
    <th>:</th>
	<th>Rp.</th>
    <th align=right>'.number_format($potongangaransi,0,".",".").'</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td Align=right><h4><b>Total Bayar</b></h4></td>
    <td><h4><b>:</b></h4></td>
	<td><h4><b>Rp.</b></h4></td>
    <td align=right><center><b><h4>'.number_format($totalbayar,0,".",".").'<h/4></b></center></td>
  </tr>

  <tr>
	<td width="40%">&nbsp;</td>
	<td align=right>
		<a href="?hlm=barangKeluarcari" id="tombol" class="btn btn-info pullleft"><span class="glyphicon glyphicon-chevron-left" ariahidden="true"></span> Kembali</a><br/><br/><br/>
	</td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

  </table>
</div>';
$sql = mysqli_query($koneksi, "SELECT nama FROM user WHERE id_user='$id_user'");
list($nama) = mysqli_fetch_array($sql);
echo'
<table width="1000" bordered=0 style="font-size:18px">
 <tr>
    <th width=33%><center>Yang Menerima</center></th>
    <th width=33%><center>Yang Menyerahkan</center></th>
	<th width=33%><center>Admin</center></th>
  </tr>
</table>
</br></br></br>
<table width="1000" bordered=0 style="font-size:18px">   
	<tr>
		<th width=33%><center>_____________</center></th>
		<th width=33%><center>_____________</center></td>
		<th width=33%><center><u>'.$nama.'</u></center></td>
	</tr>
 </table>
<hr>

<center><h3>----------------- Terima Kasih ----------------</h3></center>
</div>
</div>
</body>
</html>';
}
?>
<?php
}
?>

