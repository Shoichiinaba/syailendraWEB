<?php
if(empty($_SESSION['id_user'])){
$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login
terlebih dahulu.';
header('Location: ./');
die();
}
else{
?>
<?php
if(isset($_REQUEST['submit'])){
$kode_brg_servis=$_REQUEST['kode_brg_servis'];
//update status barang
$sql = mysqli_query($koneksi, "UPDATE statusbrg_update SET statusbrg_update='Keluar', tgl_keluar=now()
												 where kode_brg_servis='$kode_brg_servis'");
//Hitung Biaya	Sparepart											 
$sql = mysqli_query($koneksi, "SELECT a.kode_part, a.jml_pakai,
									b.nama_part	,b.harga_part
									FROM detail_pengerjaan a, sparepart b
									where a.kode_part=b.kode_part and a.kode_brg_servis='$kode_brg_servis'");
//Hitung Biaya Jasa
$sqljasa = mysqli_query($koneksi, "SELECT a.biaya_jasa, c.kode_statusgaransi
									FROM biaya_jasa a, pengerjaan b, barang_servis c 
									where a.kode_jasa=b.kode_jasa and b.kode_brg_servis=c.kode_brg_servis and b.kode_brg_servis='$kode_brg_servis'");
list($biaya_jasa, $kode_statusgaransi)=mysqli_fetch_array($sqljasa);
 
	$totalbiayapart=0;
	$potongangaransi=0;
		if(mysqli_num_rows($sql) > 0){
		$no = 0;
			while($row = mysqli_fetch_array($sql)){
			$no++;
			//total biaya per item part
			$biayapart=$row['harga_part']*$row['jml_pakai'];												 
			$totalbiayapart=$totalbiayapart+$biayapart;
			}
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
												 
//Simpan data ke tabel barang_keluar
		$sql = mysqli_query($koneksi, "INSERT INTO barang_keluar(kode_brg_keluar,kode_brg_servis, kode_pengerjaan, grand_total,potongan, total_bayar)
											 VALUES('K$kode_brg_servis','$kode_brg_servis','P$kode_brg_servis', '$grandtotal','$potongangaransi','$totalbayar')");



			if($sql == true){
			header('Location: ./admin.php?hlm=barangKeluarprint&kode_brg_servis='.$kode_brg_servis.'');	
			die();
			}	

}
$kode_brg_servis = $_REQUEST['kode_brg_servis'];
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
<center><h3><b>Data Barang Keluar</b></h3></center>
<hr>
</br>
<table width="1000" bordered=0>
<tr class="info">
		<th width="14%"></th>
		<th width="2%"></th>
		<th width="20%"></th>
		<th width="14%"></th>
		<th width="2%"></th>
		<th width="20%"></th>
		<th width="14%"><h4>No TTSK</h4></th>
		<th width="2%"><h4>:</h4></th>
		<th width="20%"><h4>'.$kode_brg_keluar.'</h4></th>
</tr>
</table>
<table width="1000" bordered=0>
<tr class="info">
		<th width="14%"></th>
		<th width="2%"></th>
		<th width="20%"></th>
		<th width="14%"></th>
		<th width="2%"></th>
		<th width="20%"></th>
		<th width="14%"><h4>Tanggal</h4></th>
		<th width="2%"><h4>:</h4></th>
		<th width="20%"><h4>'.date("d M Y").'</h4></th>
</tr>
</table>
</br>
<table width="1000" bordered=0>
<tr class="info">
		<th width="14%"><h4>No TTSM</h4></th>
		<th width="2%"><h4>:</h4></th>
		<th width="20%"><h4>'.$kode_brg_servis.'</h4></th>
		<th width="14%"><h4>No PBS</h4></th>
		<th width="2%"><h4>:</h4></th>
		<th width="20%"><h4>'.$kode_pengerjaan.'</h4></th>
		<th width="14%"><h4>Type Barang</h4></th>
		<th width="2%"><h4>:</h4></th>
		<th width="20%"><h4>'.$type_brg.'</h4></th>
</tr>
</table>
</br>
<table width="1000" bordered=0>


<table class="table table-nobordered">
  <tr>
	<td width=14%><h5><b>Nama Konsumen</b></h5></td>
    <td width=1%>:</td>
    <td width=80%><h5><b>'.$nama_konsumen.'</b></h5></td>
  </tr>	
  <tr>
	<td><h5><b>Alamat Konsumen</b></h5></td>
    <td>:</td>
    <td><h5><b>'.$alamat.'</b></h5></td>
  </tr>
  <tr>
  <td><h5><b>No Telpon</b></h5></td>
    <td>:</td>
    <td><h5><b>'.$no_telp.'</b></h5></td>
  </tr>
  <tr>
    <td><h5><b>Keluhan/Kerusakan</b></h5></td>
    <td>:</td>
    <td><h5><b>'.$keluhan_brg.'</b></h5></td>
  </tr>
   <tr>
    <td><h5><b>Kelengkapan</b></h5></td>
    <td>:</td>
    <td><h5><b>'.$kelengkapan_brg.'</b></h5></td>
  </tr>
  <tr>
    <td><h5><b>Teknisi</b></h5></td>
    <td>:</td>
    <td><h5><b>'.$nama_teknisi.'</b></h5></td>
  </tr>
  <tr>
    <td><h5><b>Jenis Jasa</b></h5></td>
    <td>:</td>
    <td><h5><b>'.$kategori_jasa.'</b></h5></td>
  </tr>
  <tr>
    <td><h5><b>Garansi</b></h5></td>
    <td>:</td>
    <td><h5><b>'.$keterangan_garansi.'</b></h5></td>
  </tr>
  <tr>
    <td ></h4></td>
    <td></td>
    <td ></b></td>
  </tr>

  
  </table>

<div class="col-sm-7">
<center><h3><b>Rincian Biaya</b></h3></center>
<table class="table table-bordered">
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
<table class="table table-nobordered">
  <tr>
    <td width="40%">&nbsp;</td>
    <td width="30%"><h5><b>Total Biaya Sparepart</b></h5></td>
    <td width="3%"><h5><b>:</b></h5></td>
	<td width="3%"><h5><b>Rp.</b></h5></td>
    <td width="12%" align=right><h5><b>'.number_format($totalbiayapart,0,".",".").'</b></h5></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><h5><b>Baiaya Jasa</b></h5></td>
    <td><h5><b>:</b></h5></td>
	<td><h5><b>Rp.</b></h5></td>
    <td align=right><h5><b>'.number_format($biaya_jasa,0,".",".").'</b></h5></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><h5><b>Grand Total</b></h5></td>
    <td><h5><b>:</b></h5></td>
	<td><h5><b>Rp.</b></h5></td>
    <td align=right><h5><b>'.number_format($grandtotal,0,".",".").'</b></h5></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><h5><b>Potongan Garansi</b></h5></td>
    <td><h5><b>:</b></h5></td>
	<td><h5><b>Rp.</b></h5></td>
    <td align=right><h5><b>'.number_format($potongangaransi,0,".",".").'</b></h5></td>
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
	<td>
	<form  role="form" method="post" action=""> ';
	if ($statusbrg_update==="Keluar"){
		echo'	<a href="?hlm=barangKeluarprint&kode_brg_servis='.$kode_brg_servis.'" id="tombol"   class="btn btn-success btn-s"><span class="glyphicon glyphicon-print" ariahidden="true"></span>Cetak</a>';}
	else{
		echo'<button id="tombol" type="submit" name="submit" class="btn btn-warning btn-s">Proses</button>';}
	echo'
	</form>
	</td>
  </tr>

  </table>
</div>



</br></br></br></br>
</div>
';
}
?>
<?php
}
?>

