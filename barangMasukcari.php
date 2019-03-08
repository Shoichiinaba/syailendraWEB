<?php
if(empty($_SESSION['id_user'])){
$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login
terlebih dahulu.';
header('Location: ./');
die();
}
else{
?>
<h2>Transaksi Barang Servis Masuk.</h2><hr>
<div class="well well-sm noprint">
	<form class="form-inline" role="form" method="post" action=""> <div class="form-group">
		<div class="form-group">
			<input type="text" class="form-control" id="no_nota" name="kode_brg_servis" placeholder="Masukkan No TTSM" required>
		</div>
		<div class="form-group">
			<button type="submit" name="submit" class="btn btn-warning btn-s">Cari</button>
		</div>
		<div class="form-group">
			<a href="./admin.php?hlm=barangmasuk" class="btn btn-success btn-s pull-right">Tambah Transaksi</a>
		</div>
	</form>
</div>
</br>
<?php
if(isset($_REQUEST['submit'])){
$kode_brg_servis = $_REQUEST['kode_brg_servis'];
$sql= mysqli_query($koneksi, "select kode_brg_servis from barang_servis where kode_brg_servis='$kode_brg_servis' ");
$row = mysqli_fetch_array($sql);	

if ($kode_brg_servis ===$row['kode_brg_servis']){
header('Location: ./admin.php?hlm=barangmasukdata&kode_brg_servis='.$kode_brg_servis.'');
}
else {
echo "
<div class='alert alert-danger alert-dismissable'>
<h4>Data dengan No TTSM=  <b>".$kode_brg_servis."</b> Tidak Ditemukan!!</h4>
</div>";
}
}
?>


<?php
}
?>