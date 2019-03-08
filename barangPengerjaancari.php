<?php
if(empty($_SESSION['id_user'])){
$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login
terlebih dahulu.';
header('Location: ./');
die();
}
else{

?>
<h2>Transaksi Pengerjaan Barang Servis.</h2><hr>
<div class="well well-sm noprint">
	<form class="form-inline" role="form" method="post" action=""> <div class="form-group">
		<div class="form-group">
			<input type="text" class="form-control" id="no_nota" name="kode_brg_servis" placeholder="Masukkan No TTSM" required>
		</div>
		<div class="form-group">
			<button type="submit" name="submit" class="btn btn-warning btn-s">Cari</button>
		</div>
		<div class="form-group">
			<button type="submit" name="submit" class="btn btn-success btn-s">Tambah Transaksi</button>
		</div>
	</form>
</div>
</br>
<?php
if(isset($_REQUEST['submit'])){
$kode_brg_servis = $_REQUEST['kode_brg_servis'];
$sql= mysqli_query($koneksi, "select statusbrg_update from statusbrg_update where kode_brg_servis='$kode_brg_servis' ");	
list($status) = mysqli_fetch_array($sql);	

if ($status =='Masuk'){
header('Location: ./admin.php?hlm=barangpengerjaanadd&kode_brg_servis='.$kode_brg_servis.'');
}
else if ($status =='Keluar'){
echo "
<div class='alert alert-danger alert-dismissable'>
<h4>Data dengan No TTSM=".$kode_brg_servis." Status sudah keluar!!</h4>
</div>
";
}

else if ($status =='Dikerjakan'){
header('Location: ./admin.php?hlm=pengerjaanData&kode_brg_servis='.$kode_brg_servis.'');
}
else {
echo "
<div class='alert alert-danger alert-dismissable'>
<h4> Data dengan No TTSM=".$kode_brg_servis." Status Tidak Ditemukan!!</h4>
</div>
";
}
}
?>

<?php
$sql = mysqli_query($koneksi, "select a.kode_brg_servis, a.id_perusahaan, a.type_brg, b.statusbrg_update, b.tgl_masuk 
									from barang_servis a, statusbrg_update b 
									where a.kode_brg_servis=b.kode_brg_servis and b.statusbrg_update='Masuk' order by b.tgl_masuk ");
echo '
<div class="col-sm-11">
<h2>Rekap Barang Yang Belum Proses Pengerjaan</h2><hr>
	<table class="table table-bordered">
		<thead>
			<tr class="info">
				<th width="5%">No</th>
				<th width="10%">No. TTSM</th>
				<th width="10%">Merek</th>
				<th width="20%">Type Barang</th>
				<th width="15%">Status Barang</th>
				<th width="10%">Tgl Masuk</th>
			</tr>
		</thead>
		<tbody>
		<tr>';
if (mysqli_num_rows($sql) > 0){
		$no=0;
		$no=0;
			while($row = mysqli_fetch_array($sql)){
			$no++;
			$id_perusahaan=$row['id_perusahaan'];
			$sqlmerek=mysqli_query($koneksi, "select merek from rekanan_perusahaan where id_perusahaan ='$id_perusahaan' ");
			list($merek)=mysqli_fetch_array($sqlmerek);
		echo '
				<td>'.$no.'</td>
				<td>'.$row['kode_brg_servis'].'</td>
				<td>'.$merek.'</td>
				<td>'.$row['type_brg'].'</td>
				<td>'.$row['statusbrg_update'].'</td>
				<td>'.date("d M Y", strtotime($row['tgl_masuk'])).'</td> 
			</tr>' ;
			}
}
else {
echo '<td colspan="15"><center><p class="add"><h4>Tidak ada data untuk ditampilkan.</h4> </p></center></td></tr>';
}			
echo ' 
	</tbody>
</table>
</div>	';

}
?>

