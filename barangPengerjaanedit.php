<?php
if($_SESSION['level']!=='1'){
echo 'Anda Tidak Memiliki Hak Akses !!!';
}
else{
if(isset($_REQUEST['submit'])){
$kode_brg_servis = $_REQUEST['txtTTSM'];
$kode_pengerjaan = "P$kode_brg_servis";
$id_teknisi = $_REQUEST['cobIdteknisi'];
$kode_jasa = $_REQUEST['cobKodejasa'];
//update data tabel pengerjaan
if($id_teknisi !=='0' OR $kode_jasa !=='0') {
	$sql = mysqli_query($koneksi, "UPDATE pengerjaan SET  kode_jasa='$kode_jasa' , id_teknisi= '$id_teknisi'
											where kode_brg_servis='$kode_brg_servis' ");										 
//Update Status Barang
	$sql = mysqli_query($koneksi, "UPDATE statusbrg_update SET statusbrg_update='Dikerjakan', tgl_pengerjaan=now()
												 where kode_brg_servis='$kode_brg_servis'");


		if($sql == true){
			header('Location: ./admin.php?hlm=pengerjaanPrint&kode_brg_servis='.$kode_brg_servis.'');
				die();
		}
		else{
			echo 'ERROR! Periksa penulisan querynya.';
		}
	}
else {
	echo '<a href="?hlm=barangpengerjaanEdit&kode_brg_servis='.$kode_brg_servis.'" id="tombol" class="btn btn-info pullleft"><span class="glyphicon glyphicon-chevron-left" ariahidden="true"></span> Kembali</a><br/><br/><br/> Lengkapi Data Jenis Jasa / Teknisi Terlebih Dahulu';
}	
}
else {
$kode_brg_servis = $_REQUEST['kode_brg_servis'];
$sql = mysqli_query($koneksi, "SELECT a.kode_brg_servis, a.type_brg, a.kode_produk,
									b.nama_konsumen							
								FROM barang_servis a, konsumen b 
								where a.id_konsumen = b.id_konsumen and  a.kode_brg_servis='$kode_brg_servis'");
//Variabel Data Barang Dan Konsumen
list($ttsm, $type_brg, $kode_produk, $nama_konsumen) = mysqli_fetch_array($sql);

{
?>
<h2>Transaksi Pengerjaan Barang Servis</h2>
<hr>
<form method="post" action="" class="form-horizontal" role="form">
<div class="form-group">
<label for="no_TTSM" class="col-sm-2 control-label">No TTSM</label>
<div class="col-sm-2">
<input type="text" class="form-control" name="txtTTSM" value="<?php echo $ttsm ;?>" readonly>
</div>
</div>
<div class="form-group">
<label for="type_brg" class="col-sm-2 control-label">Type Barang</label>
<div class="col-sm-3">
<input type="text" class="form-control" id="Type_barang" value="<?php echo $type_brg ; ?>" name="txtTypebarang" placeholder="Type Barang" readonly>
</div>
</div>

<div class="form-group">
<label for="nama_konsumen" class="col-sm-2 control-label">Nama Konsumen</label>
<div class="col-sm-3">
<input type="text" class="form-control" id="nama_konsumen" value="<?php echo $nama_konsumen ; ?>" name="txtNamakonsumen"  required readonly>
</div>
</div>

<div class="form-group">
<label for="biayajasa" class="col-sm-7 control-label"><b><u><h3>---------------------------Detail Pekerjaan----------------------------</h3></u></b></label>
</div>
</br>
<div class="form-group">
	<label for="jenis" class="col-sm-2 control-label">Sparepart</label>
		<div class="col-sm-3">
			<select name="cobKodepart" size="1" class="form-control" required>
			<option value='+'>-- Pilih Sparepart --</option>";
			<?php
			$sql = mysqli_query($koneksi, "select * from sparepart where kode_produk ='$kode_produk' order by nama_part  ");
			while($data = mysqli_fetch_array($sql)){
			echo "<option value='$data[kode_part]'>$data[nama_part]--$data[kode_part]--RP. $data[harga_part]</option>";
			}
			?>
			</select>
		</div>		
		<div class="col-sm-1">		
			<label for="jml_pakai" class="col-sm-1 control-label">Jumlah</label>
		</div>
		<div class="col-sm-1">
			<input type="number" value='0' class="form-control" id="jml_pakai" name="jml_pakai" placeholder="Jumlah Pakai" required>
		</div>
		<div class="col-sm-1">
			<button type="post" name="post" class="btn btnsuccess">Post</button>
		</div>
</div>

<div class="form-group">
<label for="biayajasa" class="col-sm-7 control-label"><b><u><h3>---------------------Sparepart Yang Digunakan--------------------</h3></u></b></label>
</div>

<?php
//Simpan Part Ke tabel detail_pengerjaan
if(isset($_REQUEST['post'])){
$kode_brg_servis=$_REQUEST['kode_brg_servis'];
$kode_part=$_REQUEST['cobKodepart'];
$jml_pakai=$_REQUEST['jml_pakai'];
//cek sparepart
$sql = mysqli_query($koneksi, "SELECT nama_part, jml_stok
								FROM sparepart WHERE kode_part= '$kode_part'");
list($nama_part, $jml_stok) = mysqli_fetch_array($sql);
if ($jml_stok>0 and $jml_stok>$jml_pakai){
$sql = mysqli_query($koneksi, "INSERT INTO detail_pengerjaan(kode_pengerjaan, kode_brg_servis, kode_part,  jml_pakai)
											 VALUES('P$kode_brg_servis','$kode_brg_servis','$kode_part', '$jml_pakai')");
//Kurangi Stok Sparepart sesuai Jml Pakai
$sisastok=$jml_stok-$jml_pakai;
$sql = mysqli_query($koneksi, "UPDATE sparepart SET jml_stok='$sisastok'
												 where kode_part='$kode_part'");


}
else {
	echo 'Sparepart Tidak mencukupi';
}
}
?>


<?php

echo '
<div class="container">
	<div class="col-md-8">
<hr/>
<table class="table table-bordered">
	<thead>
		<tr class="info">
			<th width="3%">No</th>
			<th width="13%">Kode Sparepart</th>
			<th width="22%">Nama Sparepart</th>
			<th width="10%">Jumlah Pakai</th>
			<th width="5%">Aksi</th>
		</tr>
	</thead>
<tbody>';
$sql = mysqli_query($koneksi, "SELECT a.kode_dtl_pengerjaan, a.kode_part, a.jml_pakai,
									b.nama_part	,b.harga_part
									FROM detail_pengerjaan a, sparepart b
									where a.kode_part=b.kode_part and a.kode_brg_servis='$kode_brg_servis'");


if(mysqli_num_rows($sql) > 0){
$no = 0;
while($row = mysqli_fetch_array($sql)){
$no++;
echo '
		<tr>
			<td>'.$no.'</td>
			<td>'.$row['kode_part'].'</td>
			<td>'.$row['nama_part'].'</td>
			<td>'.$row['jml_pakai'].' PCS</td>
			<td>
				<script type="text/javascript" language="JavaScript">
					function konfirmasi(){
					tanya = confirm("Anda yakin akan menghapus data ini?");
						if (tanya == true)
							return true;
						else
							return false;
					}
				</script>
					<a href="?hlm=penggunaanpartDeleted&submit=yes&kode_brg_servis='.$kode_brg_servis.'&kode_dtl_pengerjaan='.$row['kode_dtl_pengerjaan'].'&kode_part='.$row['kode_part'].'"onclick="return konfirmasi()" class="btn btn-danger btn-s">Hapus</a>
			</td>
	';
}
}
else{
echo '<td colspan="8"><center><p class="add"><b>Penggunaan Sparepart Belum Di Input.</b></p></center></td></tr>';
}
echo '
</tbody>
</table>
</div>
</div>';
?>



<div class="form-group">
<label for="biayajasa" class="col-sm-7 control-label"><b><u><h3>-----------------------Detail Jasa Dan Teknisi-----------------------</h3></u></b></label>
</div>
<?php
//cari data kategori jasa dan nama teknisi
			$sqlcari = mysqli_query($koneksi, "select a.kode_jasa, a.kategori_jasa, a.biaya_jasa,
													b.nama_teknisi, b.id_teknisi
													from biaya_jasa a, teknisi b, pengerjaan c
													where c.kode_brg_servis='$kode_brg_servis' and c.kode_jasa=a.kode_jasa and c.id_teknisi=b.id_teknisi ");
			
			$hasil=mysqli_fetch_array($sqlcari);

?>


<div class="form-group">
	<label for="jenis" class="col-sm-2 control-label">Jenis Jasa</label>
		<div class="col-sm-3">
			<select name="cobKodejasa" size="1" class="form-control" required>
			<?php
			echo "<option value='$hasil[kode_jasa]'>$hasil[kategori_jasa]---RP.$hasil[biaya_jasa]</option>";			
			$sql = mysqli_query($koneksi, "select * from biaya_jasa where kode_produk ='$kode_produk' order by kategori_jasa ");
			while($data = mysqli_fetch_array($sql)){
			echo "<option value='$data[kode_jasa]'>$data[kategori_jasa]---RP. $data[biaya_jasa]</option>";
			}
			?>
			</select>
		</div>
</div>


<div class="form-group">
	<label for="jenis" class="col-sm-2 control-label">Teknisi</label>
		<div class="col-sm-3">
			<select name="cobIdteknisi" size="1" class="form-control" required>
			<?php
			echo "<option value='$hasil[id_teknisi]'>$hasil[nama_teknisi]---$hasil[id_teknisi]</option>";
			$sql = mysqli_query($koneksi, "select * from teknisi order by nama_teknisi");
			while($data = mysqli_fetch_array($sql)){
			echo "<option value='$data[id_teknisi]'>$data[nama_teknisi]---$data[id_teknisi]</option>";
			}
			?>
			</select>
		</div>
</div>

</div>

<div class="form-group">
<div class="col-sm-offset-3 col-sm-10">
<a href="./admin.php?hlm=barangpengerjaancari" class="btn btn-danger">Batal</a>
<button type="submit" name="submit" class="btn btn-success">Simpan</button>
</div>
</div>
</form>
<?php
}
}
}
?>

