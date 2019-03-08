<?php
if($_SESSION['level']!=='1'){
echo 'Anda Tidak Memiliki Hak Akses !!!';
}
else{
if(isset( $_REQUEST['aksi'])){
$aksi = $_REQUEST['aksi'];
switch($aksi){
case 'add':
include 'biayajasaAdd.php';
break;
case 'edit':
include 'biayajasaEdit.php';
break;
case 'delete':
include 'biayajasaDeleted.php';
break;
}
}
else{
echo '
<div class="container">
<div class="col-md-12">
<h3 style="margin-bottom: -20px;">Data Biaya Jasa</h3>
<a href="./admin.php?hlm=biayajasa&aksi=add" class="btn btn-success btn-s pull-right">Tambah Data</a>
<br/><hr/>
<table class="table table-bordered">
<thead>
<tr class="info">
<th width="3%">No</th>
<th width="8%">Kode Jasa</th>
<th width="12%">Kategori Produk</th>
<th width="30%">Kategori Jasa</th>
<th width="10%">Biaya Jasa</th>
<th width="10%">Tanggal Update</th>
<th width="20%">Aksi</th>
</tr>
</thead>
<tbody>';
//skrip untuk menampilkan data dari database
$sql = mysqli_query($koneksi, "SELECT a.kode_jasa, a.kategori_jasa, a.biaya_jasa, a.tgl_update,
 										b.nama_produk
										FROM biaya_jasa a, jenis_produk b
										where a.kode_produk=b.kode_produk and a.status_delete !=1 order by a.kode_produk");


if(mysqli_num_rows($sql) > 0){
$no = 0;
while($row = mysqli_fetch_array($sql)){
$no++;
echo '
<tr>
<td>'.$no.'</td>
<td>'.$row['kode_jasa'].'</td>
<td>'.$row['nama_produk'].'</td>
<td>'.$row['kategori_jasa'].'</td>
<td>Rp. '.$row['biaya_jasa'].'</td>
<td>'.date("d M Y", strtotime($row['tgl_update'])).'</td>
<td>
<script type="text/javascript" language="JavaScript">
function konfirmasi(){
tanya = confirm("Anda yakin akan menghapus data ini?");
if (tanya == true)
return true;
else
return false;
}
</script>
<a href="?hlm=biayajasa&aksi=edit&kode_jasa='.$row['kode_jasa'].'" class="btn
btn-warning btn-s">Update Biaya</a>
<a
href="?hlm=biayajasa&aksi=delete&submit=yes&kode_jasa='.$row['kode_jasa'].'"
onclick="return konfirmasi()" class="btn btn-danger btn-s">Hapus</a>
</td>';
}
}
else{
echo '<td colspan="8"><center><p class="add">Tidak ada data untuk ditampilkan. <u><a href="?hlm=biayajasa&aksi=add">Tambah Sparepart Baru</a></u> </p></center></td></tr>';
}
echo '
</tbody>
</table>
</div>
</div>';
}
}
?>