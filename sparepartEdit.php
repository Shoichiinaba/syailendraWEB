<?php
if(empty( $_SESSION['id_user'])){
$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login
terlebih dahulu.';
header('Location: ./');
die();
}
else {
if(isset($_REQUEST['submit'])){
$kode_part = $_REQUEST['kode_part'];
$nama_part = $_REQUEST['txtNamapart'];
$jenis_part = $_REQUEST['cobjenispart'];
$jml_stok = $_REQUEST['numJmlstok'] + $_REQUEST['numTmbstok'];
$sql = mysqli_query($koneksi, "UPDATE sparepart SET nama_part='$nama_part',  jml_stok='$jml_stok' WHERE kode_part='$kode_part'");
if($sql == true){
header('Location: ./admin.php?hlm=sparepart');
die();
}
else {
echo 'ERROR! Periksa penulisan querynya.';
}
}
else {
$kode_part = $_REQUEST['kode_part'];
$sql = mysqli_query($koneksi, "SELECT a.kode_part, a.nama_part, a.harga_part, a.jml_stok,b.kode_produk, b.nama_produk FROM sparepart a, jenis_produk b where a.kode_produk=b.kode_produk and a.kode_part='$kode_part'");


while($row = mysqli_fetch_array($sql)){
?>
<h2>Update Data Sparepart</h2>
<hr>

<form method="post" action="" class="form-horizontal" role="form">
<div class="form-group">
<input type="hidden" name="kode_part" value="<?php echo $row['kode_part']; ?>">
<label for="kode_part" class="col-sm-2 control-label">Kode Sparepart</label>
<div class="col-sm-3">
<input type="text" class="form-control" id="kode_part" value="<?php echo $row['kode_part']; ?>" name="kodepart" placeholder="Kode Sparepart" readonly>
</div>
</div>

<div class="form-group">
<label for="namapart" class="col-sm-2 control-label">Nama Sparepart</label>
<div class="col-sm-4">
<input type="text" class="form-control" id="nama" value="<?php echo $row['nama_part']; ?>" name="txtNamapart" placeholder="Nama Sparepart" readonly>
</div>
</div>

<div class="form-group">
<label for="jenis" class="col-sm-2 control-label">Jenis Sparepart</label>
<div class="col-sm-3">
<select name="cobjenispart" class="form-control" required readonly>
<option value="<?php echo $row['kode_produk']; ?>"><?php echo $row['nama_produk']; ?></option>";

<?php
$sql = mysqli_query($koneksi, "select*from jenis_produk");
while($data = mysqli_fetch_array($sql)){
echo "<option value='$data[kode_produk]'>$data[nama_produk]</option>";
}
?>
</select>
</div>
</div>

<div class="form-group">
<label for="jmlstok" class="col-sm-2 control-label">Jumlah Stok</label>
<div class="col-sm-3">
<input type="numeric" class="form-control" id="jmlstok" value="<?php echo $row['jml_stok']; ?>"name="numJmlstok" placeholder="Jml Stok" readonly>
</div>
</div>

<div class="form-group">
<label for="tmbstok" class="col-sm-2 control-label">Tambah Stok</label>
<div class="col-sm-3">
<input type="numeric" class="form-control" id="tmbstok" name="numTmbstok" placeholder="Masukkan stok yang akan di tambah" >
</div>
</div>

<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<button type="submit" name="submit" class="btn btn-success">Update</button>
<a href="./admin.php?hlm=sparepart" class="btn btn-danger">Batal</a>
</div>
</div>
</form>
<?php
}
}
}
?>