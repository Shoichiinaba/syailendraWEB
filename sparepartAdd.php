<?php
if(empty($_SESSION['id_user'])){
$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login
terlebih dahulu.';
header('Location: ./');
die();
}
else{
if(isset($_REQUEST['submit'])){
$nama_part = $_REQUEST['txtNamapart'];
$kode_produk= $_REQUEST['cobkodeproduk'];
$harga_part = $_REQUEST['numHargapart'];
$jml_stok = $_REQUEST['numJmlstok'];

$sqli=mysqli_query($koneksi, "SELECT kode_part FROM sparepart where kode_produk='$kode_produk' "); 
if (mysqli_num_rows($sqli)==0){
$kode_angka='1';
}
else{
$kode_angka=mysqli_num_rows($sqli)+1; 
}
$sql = mysqli_query($koneksi, "INSERT INTO sparepart(kode_part, nama_part, kode_produk, harga_part, jml_stok)
											 VALUES('$kode_produk$kode_angka', '$nama_part', '$kode_produk', '$harga_part','$jml_stok')");
if($sql == true){
echo "<script>alert('PO Berhasil dimasukan!'); window.header('Location: ./admin.php?hlm=sparepart')</script>";    
header('Location: ./admin.php?hlm=sparepart');
die();
}
else{
echo 'ERROR! Periksa penulisan querynya.';
}
}
else{
?>
<h2>Tambah Sparepart Baru</h2>
<hr>
<form method="post" action="" class="form-horizontal" role="form">

<div class="form-group">
<label for="jenis" class="col-sm-2 control-label">Jenis Sparepart</label>
<div class="col-sm-3">
<select name="cobkodeproduk" class="form-control" required>
<option value='+'>-- Pilih Jenis Produk Sparepart --</option>";
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
<label for="Namapart" class="col-sm-2 control-label">Nama Sparepart</label>
<div class="col-sm-3">
<input type="text" class="form-control" id="Namapart" name="txtNamapart" placeholder="Nama Sparepart" required>
</div>
</div>

<div class="form-group">
<label for="jml" class="col-sm-2 control-label">Harga Sparepart</label>
<div class="col-sm-3">
<input type="number" class="form-control" id="numHargapart" name="numHargapart" placeholder="Isi dengan angka" required>
</div>
</div>

<div class="form-group">
<label for="jml" class="col-sm-2 control-label">Jumlah Stok</label>
<div class="col-sm-3">
<input type="number" class="form-control" id="numJmlstok" name="numJmlstok" placeholder="Isi dengan angka" required>
</div>
</div>

<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<button type="submit" name="submit" class="btn btnsuccess">Simpan</button>
<a href="./admin.php?hlm=sparepart" class="btn btn-danger">Batal</a>
</div>
</div>
</form>
<?php
}
}
?>