<?php
if(empty($_SESSION['id_user'])){
$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login
terlebih dahulu.';
header('Location: ./');
die();
}
else{
if(isset($_REQUEST['submit'])){
$id_teknisi = $_REQUEST['id_teknisi'];
$nama_teknisi = $_REQUEST['txtNamateknisi'];
$alamat = $_REQUEST['txtAlamat'];
$telp = $_REQUEST['numTelp'];
$sql = mysqli_query($koneksi, "UPDATE teknisi SET nama_teknisi='$nama_teknisi', alamat='$alamat', no_telp='$telp' 
							   WHERE id_teknisi='$id_teknisi'");
if($sql == true){
header('Location: ./admin.php?hlm=teknisi');
die();
}
else{
echo 'ERROR! Periksa penulisan querynya.';
}
}
else{
$id_teknisi = $_REQUEST['id_teknisi'];
$sql = mysqli_query($koneksi, "SELECT * FROM teknisi WHERE id_teknisi='$id_teknisi'");
while($row = mysqli_fetch_array($sql)){
?>
<h2>Edit Data Teknisi</h2>
<hr>
<form method="post" action="" class="form-horizontal" role="form">
<div class="form-group">
<label for="id_teknisi" class="col-sm-2 control-label">ID Teknisi</label>
<div class="col-sm-3">
<input type="text" class="form-control" id="id_teknisi" value="<?php
echo $row['id_teknisi']; ?>"name="id_teknisi" placeholder="ID Teknisi"
readonly>
</div>
</div>

<div class="form-group">
<label for="Teknisi" class="col-sm-2 control-label">Nama Teknisi</label>
<div class="col-sm-3">
<input type="text" class="form-control" id="teknisi" name="txtNamateknisi" value="<?php echo $row['nama_teknisi']; ?>" placeholder="Nama Teknisi" required>
</div>
</div>

<div class="form-group">
<label for="alamat" class="col-sm-2 control-label">Alamat</label>
<div class="col-sm-3">
<input type="text" class="form-control" name="txtAlamat" value="<?php echo $row['alamat']; ?>" placeholder="Alamat Teknisi" required>
</div>
</div>

<div class="form-group">
<label for="telp" class="col-sm-2 control-label">No. Telp</label>
<div class="col-sm-3">
<input type="number" class="form-control" id="numTelp" name="numTelp" value="<?php echo $row['no_telp']; ?>" placeholder="Isi dengan angka" required>
</div>
</div>

<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<button type="submit" name="submit" class="btn btnsuccess">
Update</button>
<a href="./admin.php?hlm=teknisi" class="btn btn-danger">Batal</a>
</div>
</div>
</form>
<?php
}
}
}
?>