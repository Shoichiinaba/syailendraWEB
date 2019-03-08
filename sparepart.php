<?php
if($_SESSION['level']!=='1'){
echo 'Anda Tidak Memiliki Hak Akses !!!';
}
else { 
?>
<div class="container">
<div class="col-md-12">
<form method="post" action="" class="form-horizontal" role="form">
<select name="cobkodeproduk" size="1" class="form-control" required>
<option value='+'>-- Pilih dan Klik Cari Untuk Mencari Sparepart Berdasarkan Produk/Sparepart --</option>";
<option value='semua'>Tampilkan Semua Data</option>";
<?php
$sql = mysqli_query($koneksi, "select*from jenis_produk");
while($data = mysqli_fetch_array($sql)){
echo "<option value='$data[kode_produk]'>$data[nama_produk]</option>";
}
?>
</select>
<button type="submit" name="cari" class="btn btn-warning pull-right">Cari</button>
<a href="./admin.php?hlm=sparepartAdd" class="btn btn-success btn-s pull-right">Tambah Sparepart</a>
</form>
</div>
</div>
<?php
}
?>
<?php
if(isset( $_REQUEST['cari'])){
$kode_produk=$_REQUEST['cobkodeproduk'];
echo '
<div class="container">
<div class="col-md-12">
<h3 style="margin-bottom: -20px;">Data Sparepart Berdasarkan Jenis Produk/Sparepart</h3>
<br/><hr/>
<table class="table table-bordered">
<thead>
<tr class="info">
<th width="3%">No</th>
<th width="13%">Kode Sparepart</th>
<th width="22%">Nama Sparepart</th>
<th width="15%">Harga Sparepart</th>
<th width="15%">Jenis Sparepart</th>
<th width="10%">Jumlah Stok</th>
<th width="15%">Aksi</th>
</tr>
</thead>
<tbody>';

//skrip untuk menampilkan data dari database
if ($kode_produk=="semua"){
$sql = mysqli_query($koneksi, "SELECT a.kode_part, a.nama_part, a.harga_part, a.jml_stok, b.nama_produk 
									FROM sparepart a, jenis_produk b 
									where a.status_delete !=1 and a.kode_produk=b.kode_produk and a.kode_produk is not null");
}
else{
$sql = mysqli_query($koneksi, "SELECT a.kode_part, a.nama_part, a.harga_part, a.jml_stok, b.nama_produk 
									FROM sparepart a, jenis_produk b 
									where a.status_delete !=1 and a.kode_produk=b.kode_produk and a.kode_produk='$kode_produk'");
}
$level=$_SESSION['level'];
if(mysqli_num_rows($sql) > 0){
$no = 0;
while($row = mysqli_fetch_array($sql)){
$no++;
echo '
<tr>
<td>'.$no.'</td>
<td>'.$row['kode_part'].'</td>
<td>'.$row['nama_part'].'</td>
<td>Rp.'.$row['harga_part'].'</td>
<td>'.$row['nama_produk'].'</td>
<td>'.$row['jml_stok'].' PCS</td>

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
<a href="?hlm=sparepartEdit&kode_part='.$row['kode_part'].'" class="btn btn-warning btn-s">Update</a>
<a href="?hlm=sparepartDeleted&submit=yes&kode_part='.$row['kode_part'].'"onclick="return konfirmasi()" class="btn btn-danger btn-s">Hapus</a>
</td>
';
}
}
else{
echo '<td colspan="8"><center><p class="add">Tidak ada data untuk ditampilkan. <u><a href="?hlm=sparepartAdd">Tambah Sparepart Baru</a></u> </p></center></td></tr>';
}
echo '
</tbody>
</table>
</div>
</div>';

}
?>
