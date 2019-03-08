<?php
if($_SESSION['level']!=='1'){
echo 'Anda Tidak Memiliki Hak Akses !!!';
}
else{
if(isset($_REQUEST['submit'])){
$kode_jasa = $_REQUEST['txtKodejasa'];
$kategori_produk = $_REQUEST['combKategoriproduk'];
$kategori_jasa = $_REQUEST['txtKategorijasa'];
$biaya_jasa = $_REQUEST['numBiayajasa'];
$tgl_update = $_REQUEST['dateTglupdate'];
$sql = mysqli_query($koneksi, "UPDATE biaya_jasa SET biaya_jasa='$biaya_jasa', kategori_jasa='$kategori_jasa', tgl_update=now()
												 where kode_jasa='$kode_jasa'");
if($sql == true){
header('Location: ./admin.php?hlm=biayajasa');
die();
}
else{
echo 'ERROR! Periksa penulisan querynya.';
}
}
else {
$kode_jasa = $_REQUEST['kode_jasa'];
$sql = mysqli_query($koneksi, "SELECT * FROM biaya_jasa WHERE kode_jasa ='$kode_jasa'");
while($row = mysqli_fetch_array($sql)){
?>
<h2>Update Data Sparepart</h2>
<hr>
<form method="post" action="" class="form-horizontal" role="form">
<div class="form-group">
<div class="form-group">
<input type="hidden" name="txtKodejasa" value="<?php echo $row['kode_jasa']; ?>">
<label for="kode_jasa" class="col-sm-2 control-label">Kode Jasa</label>
<div class="col-sm-3">
<input type="text" class="form-control" id="kode_jasa" value="<?php echo $row['kode_jasa']; ?>" name="txtKodejasa" placeholder="Kode Jasa" readonly>
</div>
</div>

<div class="form-group">
<label for="kategoriproduk" class="col-sm-2 control-label">Kategori Produk</label>
<div class="col-sm-3">
<input type="text" class="form-control" id="Kategoriproduk" value="<?php echo $row['kategori_produk']; ?>" name="combKategoriproduk" placeholder="Masukkan kategori/keterangan jasa" readonly required>
</div>
</div>

<div class="form-group">
<label for="kategorijasa" class="col-sm-2 control-label">Kategori Jasa</label>
<div class="col-sm-3">
<input type="text" class="form-control" id="Kategorijasa" value="<?php echo $row['kategori_jasa']; ?>" name="txtKategorijasa" placeholder="Masukkan kategori/keterangan jasa"  required>
</div>
</div>

<div class="form-group">
<label for="biayajasa" class="col-sm-2 control-label">Biaya Jasa</label>
<div class="col-sm-3">
<input type="number" class="form-control" id="biayajasa" value="<?php echo $row['biaya_jasa']; ?>" name="numBiayajasa" placeholder="Isi dengan angka" required>
</div>
</div>

<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<button type="submit" name="submit" class="btn btnsuccess">
Update</button>
<a href="./admin.php?hlm=biayajasa" class="btn btn-danger">Batal</a>
</div>
</div>
</form>
<?php
}
}
}
?>