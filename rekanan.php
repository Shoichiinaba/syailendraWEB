<?php
if($_SESSION['level']!=='1'){
echo 'Anda Tidak Memiliki Hak Akses !!!';
}
else{
if(isset( $_REQUEST['aksi'])){
$aksi = $_REQUEST['aksi'];
switch($aksi){
case 'add':
include 'rekananAdd.php';
break;
case 'edit':
include 'rekananEdit.php';
break;
case 'delete':
include 'rekananDeleted.php';
break;
}
}
else{
echo '
<div class="container">
<div class="col-md-15">
<h3 style="margin-bottom: -20px;">Data Rekanan Perusahaan</h3>
<a href="./admin.php?hlm=rekanan&aksi=add" class="btn btn-success btn-s pull-right">Tambah Rekanan</a>
<br/><hr/>
<table class="table table-bordered">
<thead>
<tr class="info">
<th width="2%">No</th>
<th width="5%">ID</th>
<th width="14%">Nama</th>
<th width="14%">Alamat</th>
<th width="10%">No. Telp</th>
<th width="8%">Email</th>
<th width="10%">Tgl Bergabung</th>
<th width="10%">Lama Garansi</th>
<th width="14%">Persyaratan Garansi</th>
<th width="21%">Aksi</th>
</tr>
</thead>
<tbody>';
//skrip untuk menampilkan data dari database
$sql = mysqli_query($koneksi, "SELECT * FROM rekanan_perusahaan where status_delete !=1");
if(mysqli_num_rows($sql) > 0){
$no = 0;
while($row = mysqli_fetch_array($sql)){
$no++;
echo '
<tr>
<td>'.$no.'</td>
<td>'.$row['id_perusahaan'].'</td>
<td>'.$row['nama_perusahaan'].'</td>
<td>'.$row['alamat_perusahaan'].'</td>
<td>'.$row['no_telp_perusahaan'].'</td>
<td>'.$row['email_perusahaan'].'</td>
<td>'.date("d M Y", strtotime($row['tgl_bergabung'])).'</td>
<td>'.$row['lama_garansi'].' Tahun</td>
<td>'.$row['syarat_garansi'].'</td>
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
<a href="?hlm=rekanan&aksi=edit&id_perusahaan='.$row['id_perusahaan'].'" class="btn btn-warning btn-s">Edit</a>
<a href="?hlm=rekanan&aksi=delete&submit=yes&id_perusahaan='.$row['id_perusahaan'].'"onclick="return konfirmasi()" class="btn btn-danger btn-s">Hapus</a>
</td>';
}
}
else{
echo '<td colspan="15"><center><p class="add">Tidak ada data
untuk ditampilkan. <u><a href="?hlm=sparepart&aksi=add">Tambah Sparepart Baru</a></u> </p></center></td></tr>';
}
echo '
</tbody>
</table>
</div>
</div>';
}
}
?>