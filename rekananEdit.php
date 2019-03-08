<?php
if(empty( $_SESSION['id_user'])){
$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login
terlebih dahulu.';
header('Location: ./');
die();
}
else {
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
$sql = mysqli_query($koneksi, "UPDATE rekanan_perusahaan SET nama_perusahaan='$nama_perusahaan',merek='$merek' ,alamat_perusahaan='$alamat_perusahaan',no_telp_perusahaan='$no_telp_perusahaan', email_perusahaan='$email_perusahaan', tgl_bergabung='$tgl_bergabung', lama_garansi='$lama_garansi', syarat_garansi='$syarat_garansi'
														where id_perusahaan='$id_perusahaan' ");
if($sql == true){
header('Location: ./admin.php?hlm=rekanan');
die();
}
else{
echo 'ERROR! Periksa penulisan querynya.';
}
}
else {
$id_perusahaan = $_REQUEST['id_perusahaan'];
$sql = mysqli_query($koneksi, "SELECT * FROM rekanan_perusahaan WHERE id_perusahaan ='$id_perusahaan'");
while($row = mysqli_fetch_array($sql)){
?>
<h2>Update Data Rekanan Perusahaan</h2>
<hr>

<form method="post" action="" class="form-horizontal" role="form">
<div class="form-group">
<input type="hidden" name="id" value="<?php echo $row['id_perusahaan']; ?>">
<label for="Idperusahaan" class="col-sm-2 controllabel">ID Perusahaan</label>
<div class="col-sm-3">
<input type="text" class="form-control" id="kode_part" value="<?php echo $row['id_perusahaan']; ?>" name="txtIdperusahaan" placeholder="ID Perusahaan">
</div>
</div>

<div class="form-group">
<label for="Namaperusahan" class="col-sm-2 control-label">Nama Perusahaan</label>
<div class="col-sm-3">
<input type="text" class="form-control" id="Namaperusahaan" value="<?php echo $row['nama_perusahaan']; ?>" name="txtNamaperusahaan" placeholder="Nama Perusahaan Rekanan" required>
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
<div class="col-sm-3">
<input type="text" class="form-control" id="Alamatperusahaan" value="<?php echo $row['alamat_perusahaan']; ?>" name="txtAlamatperusahaan" placeholder="Alamat Perusahaan Rekanan" required>
</div>
</div>

<div class="form-group">
<label for="Notelpperusaan" class="col-sm-2 control-label">NO. Telp Perusahaan</label>
<div class="col-sm-3">
<input type="number" class="form-control" id="Notelpperusahaan" value="<?php echo $row['no_telp_perusahaan']; ?>" name="txtNotelpperusahaan" placeholder="No. Telp Perusahaan Rekanan" required>
</div>
</div>

<div class="form-group">
<label for="Emailperusahan" class="col-sm-2 control-label">Email Perusahaan</label>
<div class="col-sm-3">
<input type="text" class="form-control" id="Emailperusahaan" value="<?php echo $row['email_perusahaan']; ?>" name="txtEmailperusahaan" placeholder="Email Perusahaan Rekanan" required>
</div>
</div>

<div class="form-group">
<label for="Tglbergabung" class="col-sm-2 control-label">Tanggal Bergabung</label>
<div class="col-sm-3">
<input type="date" class="form-control" id="tglbergabung" value="<?php echo $row['tgl_bergabung']; ?>" name="dateTglbergabung" placeholder="pilih tanggal bergabung" required>
</div>
</div>

<div class="form-group">
<label for="Lamagaransi" class="col-sm-2 control-label">Lama Garansi</label>
<div class="col-sm-3">
<input type="number" class="form-control" id="numlamagaransi" value="<?php echo $row['lama_garansi']; ?>" name="numLamagaransi" placeholder="Isi dengan angka" required>
</div>
</div>

<div class="form-group">
<label for="syaratgaransi" class="col-sm-2 control-label">Syarat Klaim Garansi</label>
<div class="col-sm-3">
<input type="text" class="form-control" id="syaratgaransi" value="<?php echo $row['syarat_garansi']; ?>" name="txtSyaratgaransi" placeholder="Nama Perusahaan Rekanan" required>
</div>
</div>

<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<button type="submit" name="submit" class="btn btnupdate">Update</button>
<a href="./admin.php?hlm=rekanan" class="btn btn-danger">Batal</a>
</div>
</div>
</form>
<?php
}
}
}
?>