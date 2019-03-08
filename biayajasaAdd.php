<?php
if($_SESSION['level']!=='1'){
echo 'Anda Tidak Memiliki Hak Akses !!!';
}
else{
if(isset($_REQUEST['submit'])){
$kode_jasa = $_REQUEST['txtKodejasa'];
$kode_produk = $_REQUEST['cobKodeproduk'];
$kategori_jasa = $_REQUEST['txtKategorijasa'];
$biaya_jasa = $_REQUEST['numBiayajasa'];
$sql = mysqli_query($koneksi, "INSERT INTO biaya_jasa(kode_jasa, kode_produk, kategori_jasa, biaya_jasa, tgl_update)
											 VALUES('$kode_jasa', '$kode_produk', '$kategori_jasa', '$biaya_jasa', now())");
if($sql == true){
header('Location: ./admin.php?hlm=biayajasa');
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
<label for="kode_jasa" class="col-sm-2 control-label">Kode Jasa</label>
<div class="col-sm-3">
<?php
$sql = mysqli_query($koneksi, "SELECT kode_jasa FROM biaya_jasa");
echo '<input type="text" class="form-control" id="kode_jasa" value="';
$kode_jasa = 'JS1';
if(mysqli_num_rows($sql) == 0){
echo $kode_jasa;
}
$result = mysqli_num_rows($sql);
$counter = 0;
while(list($kode_jasa) = mysqli_fetch_array($sql)){
if (++$counter == $result) {
$kode_jasa++;
echo $kode_jasa;
}
}
echo '"name="txtKodejasa" placeholder="Kode Jasa" readonly>';
?>
</div>
</div>

<div class="form-group">
	<label for="jenis" class="col-sm-2 control-label">Type Produk</label>
		<div class="col-sm-3">
			<select name="cobKodeproduk" size="1" class="form-control" required>
			<option value='+'>-- Pilih Jenis Produk --</option>";
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
<label for="kategorijasa" class="col-sm-2 control-label">Kategori Jasa</label>
<div class="col-sm-3">
<input type="text" class="form-control" id="Kategorijasa" name="txtKategorijasa" placeholder="Nama Sparepart" required>
</div>
</div>

<div class="form-group">
<label for="biayajasa" class="col-sm-2 control-label">Biaya Jasa</label>
<div class="col-sm-3">
<input type="number" class="form-control" id="biayajasa" name="numBiayajasa" placeholder="Isi dengan angka" required>
</div>
</div>

<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<button type="submit" name="submit" class="btn btnsuccess">
Simpan</button>
<a href="./admin.php?hlm=sparepart" class="btn btn-danger">Batal</a>
</div>
</div>
</form>
<?php
}
}
?>