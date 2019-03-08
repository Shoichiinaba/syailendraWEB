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
$newkode_produk = $_REQUEST['cobKodeproduk'];
$newid_perusahaan=$_REQUEST['cobidperusahaan'];

if ($newid_perusahaan==$row['id_perusahaan'] and $newkode_produk==$row['kode_produk']){
	$newkode_brg_servis=$kode_brg_servis;
}
else {
//membuat kode barang
$sqlkd=mysqli_query($koneksi, "SELECT kode_brg_servis FROM barang_servis where kode_produk='$kode_produk' and id_perusahaan='$id_perusahaan' "); 
if (mysqli_num_rows($sqlkd)==0){
$angkabrg='1';
}
else{
$angkabrg=mysqli_num_rows($sqlkd)+1; 
}
$newkode_brg_servis=$newid_perusahaan.$newkode_produk.$angkabrg;	
}
		
$kode_statusgaransi=$_REQUEST['cobStatusgaransi'];
$type_brg=$_REQUEST['txtTypebarang'];
$no_seri_brg=$_REQUEST['txtNoseribarang'];
$keluhan_brg=$_REQUEST['txtKeluhanbarang'];
$kelengkapan_brg=$_REQUEST['txtKelengkapanbarang'];

//Status Barang Update
$id_user=$_SESSION['id_user'];

//Update Barang Servis
$kode_brg_servis=$_REQUEST['kode_brg_servis'];

$sql = mysqli_query($koneksi, "UPDATE barang_servis SET kode_brg_servis='$newkode_brg_servis', kode_produk='$newkode_produk', id_perusahaan='$newid_perusahaan',
														type_brg='$type_brg', no_seri_brg='$no_seri_brg', kode_statusgaransi='$kode_statusgaransi',
														keluhan_brg='$keluhan_brg', kelengkapan_brg='$kelengkapan_brg' 
												 where kode_brg_servis='$kode_brg_servis'");


if($sql == true){

$sql = mysqli_query($koneksi, "UPDATE konsumen SET	nama_konsumen='$nama_konsumen', alamat_konsumen='$alamat_konsumen', no_telp_konsumen='$no_telp_konsumen'
												where id_konsumen='$id_konsumen'");		
$sql = mysqli_query($koneksi, "UPDATE statusbrg_update SET kode_brg_servis='$newkode_brg_servis'
												where kode_brg_servis='$kode_brg_servis'");		
												
$sql = mysqli_query($koneksi, "SELECT kode_brg_servis from barang_servis where kode_brg_servis='$newkode_brg_servis' ");						
list($kode_brg_servis)= mysqli_fetch_array($sql);

header('Location: ./admin.php?hlm=barangmasukprint&kode_brg_servis='.$kode_brg_servis.'');
die();
}
else{
echo 'ERROR! Periksa penulisan querynya.';
}

}
else{
$kode_brg_servis=$_REQUEST['kode_brg_servis'];
$sql = mysqli_query($koneksi, "SELECT a.kode_produk, a.id_perusahaan, a.id_konsumen , a.type_brg, a.no_seri_brg, a.kode_statusgaransi, a.keluhan_brg,a.kelengkapan_brg,
									  b.nama_konsumen, b.alamat_konsumen, b.no_telp_konsumen,
									  c.merek,
									  d.nama_produk,
									  e.keterangan
								FROM barang_servis a, konsumen b, rekanan_perusahaan c, jenis_produk d, status_garansi e
								where a.id_konsumen = b.id_konsumen and a.kode_statusgaransi=e.kode_statusgaransi and a.id_perusahaan=c.id_perusahaan and a.kode_produk=d.kode_produk and a.kode_brg_servis='$kode_brg_servis'");	
while($row = mysqli_fetch_array($sql)){
?>
<h2>Tambah Barang Servis Baru</h2>
<hr>
<form method="post" action="" class="form-horizontal" role="form">
<div class="form-group">
	<label for="jenis" class="col-sm-2 control-label">Type Produk</label>
		<div class="col-sm-3">
			<select name="cobKodeproduk" size="1" class="form-control" required>
			<option value='<?php echo $row['kode_produk']; ?>'><?php echo $row['nama_produk']; ?></option>";
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
			<option value='<?php echo $row['id_perusahaan']; ?>'><?php echo $row['merek']; ?></option>";
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
		<input type="text" value="<?php echo $row['type_brg'];?>" class="form-control" id="Typebarang" name="txtTypebarang" placeholder="Type Barang" required>
		</div>
</div>

<div class="form-group">
	<label for="Noseribarang" class="col-sm-2 control-label">Nomer Seri Barang</label>
		<div class="col-sm-3">
		<input type="text" value="<?php echo $row['no_seri_brg'];?>" class="form-control" id="Noseribarang" name="txtNoseribarang" placeholder="Nomer Seri Barang" required>
		</div>
</div>

<div class="form-group">
	<label for="jenis" class="col-sm-2 control-label">Status Garansi</label>
		<div class="col-sm-3">
			<select name="cobStatusgaransi" class="form-control" required>
			<option value='<?php echo $row['kode_statusgaransi']; ?>'><?php echo $row['keterangan']; ?></option>";
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
		<input type="text" value="<?php echo $row['keluhan_brg'];?>" class="form-control" id="Keluhanbarang" name="txtKeluhanbarang" placeholder="Keluhan/Kerusakan Produk/Barang" required>
		</div>
</div>
<div class="form-group">
	<label for="Kelengkapanbarang" class="col-sm-2 control-label">Kelengkapan Barang</label>
		<div class="col-sm-5">
		<input type="text" value="<?php echo $row['kelengkapan_brg'];?>" class="form-control" id="Kelengkapanbarang" name="txtKelengkapanbarang" placeholder="Kelengkapan Produk/Barang" required>
		</div>
</div>

<div class="form-group">
	<label for="Namakonsumen" class="col-sm-2 control-label">Nama Konsumen</label>
		<div class="col-sm-3">
		<input type="text" value="<?php echo $row['nama_konsumen'];?>" class="form-control" id="Namakonsumen" name="txtNamakonsumen" placeholder="Nama Konsumen" required>
		</div>
</div>

<div class="form-group">
	<label for="Alamatkonsumen" class="col-sm-2 control-label">Alamat Konsumen</label>
		<div class="col-sm-5">
		<input type="text" value="<?php echo $row['alamat_konsumen'];?>" class="form-control" id="Alamatkonsumen" name="txtAlamatkonsumen" placeholder="Alamat Konsumen" required>
		</div>
</div>

<div class="form-group">
	<label for="Telponkonsumen" class="col-sm-2 control-label">Nomer Telpon Konsumen</label>
		<div class="col-sm-3">
		<input type="number" value="<?php echo $row['no_telp_konsumen'];?>" class="form-control" id="Telponkonsumen" name="numTelponkonsumen" placeholder="Isi Dengan Angka" required>
		</div>
</div>

<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
	<a href="./admin.php?hlm=barangmasukcari" class="btn btn-danger">Batal</a>
	<button type="submit" name="submit" class="btn btn-success">Update</button>
	</div>
</div>
</br>
<hr>
</br>

</form>
<?php
}
}
}
?>