<?php
if(empty($_SESSION['id_user'])){
$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login
terlebih dahulu.';
header('Location: ./');
die();
}
else{
if(isset($_REQUEST['simpan'])){
$id_teknisi = $_REQUEST['id_teknisi'];
$nama_teknisi = $_REQUEST['txtNamateknisi'];
$alamat = $_REQUEST['txtAlamat'];
$telp = $_REQUEST['numTelp'];
$sql = mysqli_query($koneksi, "INSERT INTO teknisi(id_teknisi, nama_teknisi, alamat, no_telp)
VALUES('$id_teknisi', '$nama_teknisi', '$alamat', '$telp')");
if($sql == true){

}
else{
echo 'ERROR! Periksa penulisan querynya.';
}
}
else{
?>
<h2>Tambah Teknisi Baru</h2>
<hr>
<form method="post" action="" class="form-horizontal" role="form">
<div class="form-group">
<label for="no_nota" class="col-sm-2 control-label">Id Teknisi</label>
<div class="col-sm-3">
<?php
$sql = mysqli_query($koneksi, "SELECT id_teknisi FROM teknisi");
echo '<input type="text" class="form-control" id="id_teknisi" value="';
$id_teknisi = "T1";
if(mysqli_num_rows($sql) == 0){
echo $id_teknisi;
}
$result = mysqli_num_rows($sql);
$counter = 0;
while(list($id_teknisi) = mysqli_fetch_array($sql)){
if (++$counter == $result) {
$id_teknisi++;
echo $id_teknisi;
}
}
echo '"name="id_teknisi" placeholder="ID Teknisi" readonly>';
?>
</div>
</div>
<div class="form-group">
<label for="Teknisi" class="col-sm-2 control-label">Nama Teknisi</label>
<div class="col-sm-3">
<input type="text" class="form-control" id="teknisi" name="txtNamateknisi" placeholder="Nama Teknisi" required>
</div>
</div>
<div class="form-group">
<label for="alamat" class="col-sm-2 control-label">Alamat</label>
<div class="col-sm-3">
<input type="text" class="form-control" name="txtAlamat" placeholder="Alamat Teknisi" required>
</div>
</div>
<div class="form-group">
<label for="telp" class="col-sm-2 control-label">No. Telp</label>
<div class="col-sm-3">
<input type="number" class="form-control" id="numTelp" name="numTelp" placeholder="Isi dengan angka" required>
</div>
</div>
<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<button type="submit" name="simpan" class="btn btnsuccess">
Simpan</button>
<a href="./admin.php?hlm=teknisi" class="btn btn-danger">Batal</a>
</div>
</div>
</form>
<?php
}
}
?>