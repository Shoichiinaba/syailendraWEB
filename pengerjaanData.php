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
<center><h4>No PBS : <b>'.$kode_pengerjaan.' </b>-----Nama Konsumen :<b>'.$nama_konsumen.' </b>-----'.date("d M Y", strtotime($tanggal)).'</h3> </center>
</br>
<h5>No TTSM : <b>'.$kode_brg_servis.'</b></h5>
<h5>Type Brg : <b>'.$type_brg.'</b></h5>
<table class="table table-nobordered">
  <tr>
    <td width="25%">Alamat</td>
    <td width="5%">:</td>
    <td width="70%"><b>'.$alamat.' </b></td>
  </tr>
  <tr>
    <td width="25%">No Telpon</td>
    <td width="5%">:</td>
    <td width="70%"><b>'.$no_telp.' </b></td>
  </tr>
  <tr>
    <td width="25%">Keluhan/Kerusakan</td>
    <td width="5%">:</td>
    <td width="70%"><b>'.$keluhan_brg.' </b></td>
  </tr>
  <tr>
    <td >Kelengkapan</td>
    <td>:</td>
    <td ><b>'.$kelengkapan_brg.' </b></td>
  </tr>
  <tr>
    <td ></h4></td>
    <td></td>
    <td ></b></td>
  </tr>
</table>
<h5>Teknisi    : <b>'.$nama_teknisi.'</b></h5>
<h5>Jenis Jasa : <b>'.$kategori_jasa.'</b></h5>
</br>

<div class="col-sm-1">
<a href="?hlm=barangpengerjaanEdit&kode_brg_servis='.$kode_brg_servis.'" id="tombol" class="btn btn-info pullleft"><span  ariahidden="true"></span> Edit Data</a></br>
<a href="?hlm=pengerjaanPrint&kode_brg_servis='.$kode_brg_servis.'" class="btn btn-warning btn-s"><span class="glyphicon glyphicon-print" ariahidden="true"></span> Cetak</a>
</div>


<div class="col-sm-7">
<table class="table table-bordered">
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
while($row = mysqli_fetch_array($sql)){
$no++;
echo '
<tr>
<td>'.$no.'</td>
<td>'.$row['kode_part'].'</td>
<td>'.$row['nama_part'].'</td>
<td>'.$row['jml_pakai'].'</td>
</tr>
' ;
}

echo'
</table>
<tbody>
</br></br></br></br>
</div>';
}
?>
<?php
}
?>