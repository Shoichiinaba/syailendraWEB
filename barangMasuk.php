<?php
if(empty($_SESSION['id_user'])){
$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login
terlebih dahulu.';
header('Location: ./');
die();
}
else{
if(isset($_REQUEST['submit'])){
$aksi = $_REQUEST['submit'];
switch($aksi){
case 'barangmasukprint':
include 'baraMasukprint.php';
break;
}
$kode_produk = $_REQUEST['cobKodeproduk'];
$id_perusahaan=$_REQUEST['cobidperusahaan'];
//membuat kode barang
$sqlkd=mysqli_query($koneksi, "SELECT kode_brg_servis FROM barang_servis where kode_produk='$kode_produk' and id_perusahaan='$id_perusahaan' "); 
if (mysqli_num_rows($sqlkd)==0){
$angkabrg='1';
}
else{
$angkabrg=mysqli_num_rows($sqlkd)+1; 
}			
$kode_statusgaransi=$_REQUEST['cobStatusgaransi'];
$type_brg=$_REQUEST['txtTypebarang'];
$no_seri_brg=$_REQUEST['txtNoseribarang'];
$keluhan_brg=$_REQUEST['txtKeluhanbarang'];
$kelengkapan_brg=$_REQUEST['txtKelengkapanbarang'];

//Status Barang Update
$statusbrg_update="Masuk";
$id_user=$_SESSION['id_user'];

//Konsumen
$sqli=mysqli_query($koneksi, "SELECT id_konsumen FROM konsumen"); 
if (mysqli_num_rows($sqli)==0){
$kode_angka='1';
}
else{
$kode_angka=mysqli_num_rows($sqli)+1; 
}
$id_konsumen="K";
$nama_konsumen=$_REQUEST['txtNamakonsumen'];
$alamat_konsumen=$_REQUEST['txtAlamatkonsumen'];
$no_telp_konsumen=$_REQUEST['numTelponkonsumen'];

										 
$sql = mysqli_query($koneksi, "INSERT INTO barang_servis(kode_brg_servis, kode_produk, id_perusahaan, type_brg, no_seri_brg, kode_statusgaransi,keluhan_brg, kelengkapan_brg, id_konsumen)
				value('$id_perusahaan$kode_produk$angkabrg', '$kode_produk', '$id_perusahaan', '$type_brg', '$no_seri_brg', '$kode_statusgaransi', '$keluhan_brg','$kelengkapan_brg', '$id_konsumen$kode_angka')");				
															
if($sql == true){		
$sqlstat = mysqli_query($koneksi,"INSERT INTO statusbrg_update (kode_brg_servis, statusbrg_update, tgl_masuk, id_user)
							Value('$id_perusahaan$kode_produk$angkabrg', '$statusbrg_update', now(), '$id_user')");	

if($sqlstat == true){									
$sqlkon = mysqli_query($koneksi,"INSERT INTO konsumen (id_konsumen, nama_konsumen, alamat_konsumen, no_telp_konsumen)
								value ('$id_konsumen$kode_angka', '$nama_konsumen', '$alamat_konsumen', '$no_telp_konsumen') ");			
								
if($sqlkon == true){			

}					
}
$sql = mysqli_query($koneksi, "SELECT kode_brg_servis from barang_servis where kode_brg_servis='$id_perusahaan$kode_produk$angkabrg' ");						
list($kode_brg_servis)= mysqli_fetch_array($sql);

header('Location: ./admin.php?hlm=barangmasukprint&kode_brg_servis='.$kode_brg_servis.'');
die();
}
else{
echo 'ERROR! Periksa penulisan querynya.';
}

}
else{
?>
<h2>Tambah Barang Servis Baru</h2>
<hr>
<form method="post" action="" class="form-horizontal" role="form">

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
	<label for="jenis" class="col-sm-2 control-label">Merek Barang</label>
		<div class="col-sm-5">
			<select name="cobidperusahaan" size="1" class="form-control" required>
			<option value='+'>-- Pilih Merek atau Rekanan Perusahaan --</option>";
			<?php
			$sql = mysqli_query($koneksi, "select*from rekanan_perusahaan");
			while($data = mysqli_fetch_array($sql)){
			echo "<option value='$data[id_perusahaan]'>$data[merek]----LAMA GARANSI : $data[lama_garansi] Tahun----PERSYARATAN : $data[syarat_garansi]</option>";
			}
			?>
			</select>
		</div>
</div>

<div class="form-group">
	<label for="Typebarang" class="col-sm-2 control-label">Type/Seri Barang</label>
		<div class="col-sm-3">
		<input type="text" class="form-control" id="Typebarang" name="txtTypebarang" placeholder="Type Barang" required>
		</div>
</div>

<div class="form-group">
	<label for="Noseribarang" class="col-sm-2 control-label">Nomer Seri Barang</label>
		<div class="col-sm-3">
		<input type="text" class="form-control" id="Noseribarang" name="txtNoseribarang" placeholder="Nomer Seri Barang" required>
		</div>
</div>

<div class="form-group">
	<label for="jenis" class="col-sm-2 control-label">Status Garansi</label>
		<div class="col-sm-3">
			<select name="cobStatusgaransi" class="form-control" required>
				<option value='+'>-- Pilih Status Garansi --</option>";
				<?php
				$sql = mysqli_query($koneksi, "select * from status_garansi");
				while($data = mysqli_fetch_array($sql)){
				echo "<option value='$data[kode_statusgaransi]'>$data[keterangan]</option>";
				}
			    ?>
			</select>
		</div>
</div>

<div class="form-group">
	<label for="Keluhanbarang" class="col-sm-2 control-label">Keluhan Barang</label>
		<div class="col-sm-5">
		<input type="text" class="form-control" id="Keluhanbarang" name="txtKeluhanbarang" placeholder="Keluhan/Kerusakan Produk/Barang" required>
		</div>
</div>
<div class="form-group">
	<label for="Kelengkapanbarang" class="col-sm-2 control-label">Kelengkapan Barang</label>
		<div class="col-sm-5">
		<input type="text" class="form-control" id="Kelengkapanbarang" name="txtKelengkapanbarang" placeholder="Kelengkapan Produk/Barang" required>
		</div>
</div>

<div class="form-group">
	<label for="Namakonsumen" class="col-sm-2 control-label">Nama Konsumen</label>
		<div class="col-sm-3">
		<input type="text" class="form-control" id="Namakonsumen" name="txtNamakonsumen" placeholder="Nama Konsumen" required>
		</div>
</div>

<div class="form-group">
	<label for="Alamatkonsumen" class="col-sm-2 control-label">Alamat Konsumen</label>
		<div class="col-sm-5">
		<input type="text" class="form-control" id="Alamatkonsumen" name="txtAlamatkonsumen" placeholder="Alamat Konsumen" required>
		</div>
</div>

<div class="form-group">
	<label for="Telponkonsumen" class="col-sm-2 control-label">Nomer Telpon Konsumen</label>
		<div class="col-sm-3">
		<input type="number" class="form-control" id="Telponkonsumen" name="numTelponkonsumen" placeholder="Isi Dengan Angka" required>
		</div>
</div>

<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
	<button type="submit" name="submit" class="btn btn-success">Simpan</button>
	<a href="./admin.php?hlm=barangmasukcari" class="btn btn-danger">Batal</a>
	</div>
</div>

</form>
<?php
}
}
?>