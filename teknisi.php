<?php
if($_SESSION['level']!=='1'){
echo 'Anda Tidak Memiliki Hak Akses !!!';
}
else{
if(isset( $_REQUEST['aksi'])){
$aksi = $_REQUEST['aksi'];
switch($aksi){
case 'add':
include 'teknisiAdd.php';
break;
case 'edit':
include 'teknisiEdit.php';
break;
case 'delete':
include 'teknisiDeleted.php';
break;
}
}
else{
echo '
<div class="container">
<div class="col-md-12">
<h3 style="margin-bottom: -20px;">Data Teknisi</h3>
<a href="./admin.php?hlm=teknisi&aksi=add" class="btn btn-success
btn-s pull-right">Tambah Teknisi</a>
<br/><hr/>
<table class="table table-bordered">
<thead>
<tr class="info">
<th width="5%">No</th>
<th width="13%">ID Teknisi</th>
<th width="20%">Nama</th>
<th width="30%">Alamat</th>
<th width="12%">No Telp</th>
<th width="12%">Aksi</th>
</tr>
</thead>
<tbody>';
//skrip untuk menampilkan data dari database
$sql = mysqli_query($koneksi, "SELECT * FROM teknisi where status_delete !=1");
if(mysqli_num_rows($sql) > 0){
$no = 0;
while($row = mysqli_fetch_array($sql)){
$no++;
echo '
<tr>
<td>'.$no.'</td>
<td>'.$row['id_teknisi'].'</td>
<td>'.$row['nama_teknisi'].'</td>
<td>'.$row['alamat'].'</td>
<td>'.$row['no_telp'].'</td>
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
<a href="?hlm=teknisi&aksi=edit&id_teknisi='.$row['id_teknisi'].'" class="btn
btn-warning btn-s">Edit</a>
<a
href="?hlm=teknisi&aksi=delete&submit=yes&id_teknisi='.$row['id_teknisi'].'"
onclick="return konfirmasi()" class="btn btn-danger btn-s">Hapus</a>
</td>';
}
}
else{
echo '<td colspan="8"><center><p class="add">Tidak ada data
untuk ditampilkan. <u><a href="?hlm=teknisi&aksi=add">Tambah Teknisi
baru</a></u> </p></center></td></tr>';
}
echo '
</tbody>
</table>
</div>
</div>';
}
}
?>