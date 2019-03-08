<?php
if(empty($_SESSION['id_user'])){
$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login
terlebih dahulu.';
header('Location: ./');
die();
}
else{
if(isset($_REQUEST['submit'])){
$id_perusahaan = $_REQUEST['txtIdperusahaan'];
$nama_perusahaan = $_REQUEST['txtNamaperusahaan'];
$merek=$_REQUEST['txtMerek'];
$alamat_perusahaan = $_REQUEST['txtAlamatperusahaan'];
$no_telp_perusahaan = $_REQUEST['txtNotelpperusahaan'];
$email_perusahaan = $_REQUEST['txtEmailperusahaan'];
$tgl_bergabung = $_REQUEST['dateTglbergabung'];
$lama_garansi = $_REQUEST['numLamagaransi'];
$syarat_garansi = $_REQUEST['txtSyaratgaransi'];
$sql = mysqli_query($koneksi, "INSERT INTO rekanan_perusahaan(id_perusahaan, nama_perusahaan, merek , alamat_perusahaan, no_telp_perusahaan, email_perusahaan, tgl_bergabung, lama_garansi, syarat_garansi)
									 VALUES('$id_perusahaan', '$nama_perusahaan','$merek','$alamat_perusahaan', '$no_telp_perusahaan', '$email_perusahaan', '$tgl_bergabung', '$lama_garansi', '$syarat_garansi' )");
if($sql == true){
header('Location: ./admin.php?hlm=rekanan');
die();
}
else{
echo 'ERROR! Periksa penulisan querynya.';
}
}
else{
?>
<h2>Tambah Rekanan Perusahaan Baru</h2>
<hr>
<form method="post" action="" class="form-horizontal" role="form">
<div class="form-group">
<label for="id_perusahaan" class="col-sm-2 control-label">ID Perusahaan</label>
<div class="col-sm-4">
<input type="text" class="form-control" id="id_perusahaan" name="txtIdperusahaan" placeholder="Masukkan 3 buah Huruf Balok Sebagai Kode" required>
</div>
</div>

<div class="form-group">
<label for="Namaperusahan" class="col-sm-2 control-label">Nama Perusahaan</label>
<div class="col-sm-3">
<input type="text" class="form-control" id="Namaperusahaan" name="txtNamaperusahaan" placeholder="Nama Perusahaan Rekanan" required>
</div>
</div>

<div class="form-group">
<label for="Merek" class="col-sm-2 control-label">Merek</label>
<div class="col-sm-3">
<input type="text" class="form-control" id="merek" name="txtMerek" placeholder="Merek/Braind Perusahaan" required>
</div>
</div>

<div class="form-group">
<label for="Alamatperusahan" class="col-sm-2 control-label">Alamat Perusahaan</label>
<div class="col-sm-5">
<input type="text" class="form-control" id="Alamatperusahaan" name="txtAlamatperusahaan" placeholder="Alamat Perusahaan Rekanan" required>
</div>
</div>

<div class="form-group">
<label for="Notelpperusaan" class="col-sm-2 control-label">NO. Telp Perusahaan</label>
<div class="col-sm-3">
<input type="number" class="form-control" id="Notelpperusahaan" name="txtNotelpperusahaan" placeholder="No. Telp Perusahaan Rekanan" required>
</div>
</div>

<div class="form-group">
<label for="Emailperusahan" class="col-sm-2 control-label">Email Perusahaan</label>
<div class="col-sm-3">
<input type="text" class="form-control" id="Emailperusahaan" name="txtEmailperusahaan" placeholder="Email Perusahaan Rekanan" required>
</div>
</div>

<div class="form-group">
<label for="Tglbergabung" class="col-sm-2 control-label">Tanggal Bergabung</label>
<div class="col-sm-3">
<input type="date" class="form-control" id="tglbergabung" name="dateTglbergabung" placeholder="pilih tanggal bergabung" required>
</div>
</div>

<div class="form-group">
<label for="Lamagaransi" class="col-sm-2 control-label">Lama Garansi</label>
<div class="col-sm-3">
<input type="number" class="form-control" id="numlamagaransi" name="numLamagaransi" placeholder="Isi dengan angka" required>
</div>
</div>

<div class="form-group">
<label for="syaratgaransi" class="col-sm-2 control-label">Syarat Klaim Garansi</label>
<div class="col-sm-5">
<input type="text" class="form-control" id="syaratgaransi" name="txtSyaratgaransi" placeholder="Nama Perusahaan Rekanan" required>
</div>
</div>

<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<button type="submit" name="submit" class="btn btnsuccess">Simpan</button>
<a href="./admin.php?hlm=rekanan" class="btn btn-danger">Batal</a>
</div>
</div>
</form>
<?php
}
}
?>