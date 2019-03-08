<?php
if(empty($_SESSION['id_user'])){
$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login
terlebih dahulu.';
header('Location: ./');
die();
}
else{
	$data=0;
if(isset($_REQUEST['submit'])){
$submit = $_REQUEST['submit'];
$tgl1 = $_REQUEST['tgl1'];
$tgl2 = $_REQUEST['tgl2'];
$teknisi= $_REQUEST['cobTeknisi'];
if ($teknisi=="semua"){
$sql = mysqli_query($koneksi, "select a.kode_pengerjaan, b.kode_brg_servis, b.type_brg, c.tgl_pengerjaan, d.nama_teknisi
									from pengerjaan a, barang_servis b, statusbrg_update c, teknisi d 
									where a.kode_brg_servis=b.kode_brg_servis and a.kode_brg_servis=c.kode_brg_servis and a.id_teknisi=d.id_teknisi and c.tgl_pengerjaan BETWEEN '$tgl1' AND '$tgl2' order by c.tgl_pengerjaan ");
}
else {
$sql = mysqli_query($koneksi, "select a.kode_pengerjaan, b.kode_brg_servis, b.type_brg, c.tgl_pengerjaan, d.nama_teknisi
									from pengerjaan a, barang_servis b, statusbrg_update c, teknisi d 
									where a.kode_brg_servis=b.kode_brg_servis and a.kode_brg_servis=c.kode_brg_servis and a.id_teknisi=d.id_teknisi and a.id_teknisi='$teknisi' and c.tgl_pengerjaan BETWEEN '$tgl1' AND '$tgl2' order by c.tgl_pengerjaan");
}							
	if(mysqli_num_rows($sql) > 0){
		$data=1;
	$no = 0;
	echo '<h2>Rekap Laporan pengerjaan Barang Servis Teknisi = '.$teknisi.' <small>'.$tgl1.' sampai '.$tgl2.'</small></h2><hr>
	<div class="col-sm-1">
	<a href="?hlm=laporanPengerjaan" id="tombol" class="btn btn-info pullleft"><span class="glyphicon glyphicon-chevron-left" ariahidden="true"></span> Kembali</a><br/><br/><br/>
	<button id="tombol" onclick="window.print()" class="btn btn-warning"><span class="glyphicon glyphicon-print" ariahidden="true"></span> Cetak</button>
	</div>
	<div class="col-sm-11">
	<table class="table table-bordered" style="font-size:18px">
	<thead>
	<tr class="info">
	<th width="5%">No</th>
	<th width="10%">No. Pengerjaan</th>
	<th width="10%">No. TTSM</th>
	<th width="20%">Type Barang</th>
	<th width="15%">Nama Teknisi</th>
	<th width="10%">Tgl Pengerjaan</th>
	</tr>
	</thead>
	<tbody>';
	while($row = mysqli_fetch_array($sql)){
	$no++;
	echo '
	<tr>
	<td>'.$no.'</td>
	<td>'.$row['kode_pengerjaan'].'</td>
	<td>'.$row['kode_brg_servis'].'</td>
	<td>'.$row['type_brg'].'</td>
	<td>'.$row['nama_teknisi'].'</td>
	<td>'.date("d M Y", strtotime($row['tgl_pengerjaan'])).'</td> ' ;
	}
	echo ' 
		</tbody>
	</table>

	<div class="col-sm-12"><table class="table table-bordered" style="font-size:18px"> ';

		echo '<tr class="info"><th>Jumlah Data Pengerjaan</th></tr>';
	$tanggal = date('Y-m-d');

	if ($teknisi=="semua"){
	$sql = mysqli_query($koneksi, "SELECT count(a.tgl_pengerjaan) FROM statusbrg_update a, pengerjaan b WHERE a.kode_brg_servis=b.kode_brg_servis and a.tgl_pengerjaan BETWEEN '$tgl1' AND '$tgl2' ");
	list($tgl_pengerjaan) = mysqli_fetch_array($sql);
	}
	else{
	$sql = mysqli_query($koneksi, "SELECT count(a.tgl_pengerjaan) FROM statusbrg_update a, pengerjaan b WHERE a.kode_brg_servis=b.kode_brg_servis and b.id_teknisi='$teknisi' and a.tgl_pengerjaan BETWEEN '$tgl1' AND '$tgl2' ");
	list($tgl_pengerjaan) = mysqli_fetch_array($sql);	
	}
	{

		echo '<tr>
				<td><span class="pull-right">'.$tgl_pengerjaan. ' data</span></td>
		</tr>';
	}
		echo '
	</table>
	</div>
	</div>
	</div>
	</div>';
	}

					else {
					echo " 
					<div class='alert alert-danger alert-dismissable'>
					<h4>Data Tidak Ditemukan!!</h4>
					</div>
					";}		
	}
if ($data<1){
echo '<h2>Laporan Pengerjaan Barang Servis</h2><hr>';
?>
<div class="well well-sm noprint">
	<form class="form-inline" role="form" method="post" action="">
		<div class="form-group">
			<label class="col-sm-2 control-label" for="tgl1">Mulai</label>
			<div class="col-sm-2">
				<input type="date" class="form-control" id="tgl1" name="tgl1" required>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="tgl2">Hingga</label>
			<div class="col-sm-2">
				<input type="date" class="form-control" id="tgl2" name="tgl2" required>
			</div>
		</div>
		
		<div class="form-group">
		
			<div class="col-sm-2">
				<select name="cobTeknisi" size="" class="form-control" required>
				<option value='+'>-- Pilih Teknisi --</option>";
				<option value='semua'>Semua Teknisi</option>";
				<?php
					$sql = mysqli_query($koneksi, "select * from teknisi  ");
					while($data = mysqli_fetch_array($sql)){
					echo "<option value='$data[id_teknisi]'>$data[nama_teknisi]</option>";
					}
				?>
				</select>
			</div>
		</div>

			<button type="submit" name="submit" class="btn btn-success pull-right">Proses</button>
	</form>
</div>
<?php
echo '<div class="col-sm-6"><table class="table table-bordered">';
echo '<hr><h2>Rekap Laporan pengerjaan Barang Servis Hari Ini (<small>'.date('d-m-Y').'</small>)</h2><hr>';
echo '<tr class="info"><th><h4>Jumlah Data Pengerjaan</h4></th></tr>';
$tanggal = date('Y-m-d');

$sql = mysqli_query($koneksi, "SELECT count(tgl_pengerjaan) FROM statusbrg_update WHERE tgl_pengerjaan='$tanggal' ");
list($tgl_pengerjaan) = mysqli_fetch_array($sql);

{
echo '<tr>
			<td><span class="pull-right"><h4><b>'.$tgl_pengerjaan. ' data</b></h4></span></td>
			
	</tr>';
}
echo '
</table>
<div class="col-sm-13">
<button id="tombol" onclick="window.print()" class="btn btn-warning pull-right"><span class="glyphicon glyphicon-print" ariahidden="true"></span> Cetak</button>
</div>
</div>
</div>
</div>';
}
}
?>