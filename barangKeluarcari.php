<?php
if(empty($_SESSION['id_user'])){
$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login
terlebih dahulu.';
header('Location: ./');
die();
}
else{
?>
<h2>Transaksi Barang Servis Keluar.</h2><hr>
<div class="well well-sm noprint">
<form class="form-inline" role="form" method="post" action=""> <div class="form-group">
<label class="sr-only" for="tgl1">Mulai</label>
<input type="text" class="form-control" id="no_nota" name="kode_brg_servis" placeholder="Masukkan No TTSM" required>
<button type="submit" name="submit" class="btn btn-success btn-s">Cek Data</button>
</form>

</div>
</br>
<?php
if(isset($_REQUEST['submit'])){
$kode_brg = $_REQUEST['kode_brg_servis'];
$sql= mysqli_query($koneksi, "select statusbrg_update, kode_brg_servis 
							from statusbrg_update 
							where kode_brg_servis='$kode_brg' ");	
list($status, $kode_brg_servis) = mysqli_fetch_array($sql);	

if ($status ==='Masuk'){
	
echo "
<div class='alert alert-danger alert-dismissable'>
<h4>Data dengan No TTSM= <b>".$kode_brg."</b> Status Belum dikerjakan!!</h4>
</div>";

}
else if ($status ==='Keluar'){
header('Location: ./admin.php?hlm=barangKeluardata&kode_brg_servis='.$kode_brg_servis.'');
}

else if ($status ==='Dikerjakan'){
header('Location: ./admin.php?hlm=barangKeluardata&kode_brg_servis='.$kode_brg_servis.'');
}
else{ 
echo " 
<div class='alert alert-danger alert-dismissable'>
<h4>Data dengan No TTSM=  <b>".$kode_brg."</b> Tidak Ditemukan!!</h4>
</div>
";
}
}
?>

<?php
$sql = mysqli_query($koneksi, "select a.kode_brg_servis, a.id_perusahaan, a.type_brg,
									b.tgl_masuk, 
									d.nama_teknisi,
									c.nama_konsumen, c.no_telp_konsumen
									from barang_servis a, statusbrg_update b , konsumen c, teknisi d, pengerjaan e
									where a.kode_brg_servis=b.kode_brg_servis and a.kode_brg_servis=e.kode_brg_servis and e.id_teknisi=d.id_teknisi and a.id_konsumen=c.id_konsumen and b.statusbrg_update='Dikerjakan' order by b.tgl_masuk ");

echo '
<div class="col-sm-11">
<h2>Rekap Barang Yang Siap Diambil</h2><hr>
	<table class="table table-bordered">
		<thead>
			<tr class="info">
				<th width="5%">No</th>
				<th width="10%">No. TTSM</th>
				<th width="10%">Merek</th>
				<th width="15%">Type Barang</th>
				<th width="15%">Teknisi</th>
				<th width="15%">Nama Konsumen</th>
				<th width="15%" align=right>No Telp</th>
				<th width="10%">Tgl Masuk</th>
			</tr>
		</thead>
		<tbody> 
		<tr>';
if (mysqli_num_rows($sql) > 0){
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
				<td>'.$row['nama_teknisi'].'</td>
				<td>'.$row['nama_konsumen'].'</td>
				<td>'.$row['no_telp_konsumen'].'</td>
				<td>'.date("d M Y", strtotime($row['tgl_masuk'])).'</td> 
			</tr>' ;
			}
	}
else{
echo '<td colspan="15"><center><p class="add"><h4>Tidak ada data untuk ditampilkan.</h4> </p></center></td></tr>';
}

echo ' 
	</tbody>
</table>
</div>	';
}
?>