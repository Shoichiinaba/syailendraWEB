<?php
if(empty($_SESSION['id_user'])){
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
}
else{
	$data=0;
	if(isset($_REQUEST['submit'])){
	$submit = $_REQUEST['submit'];
	$tgl1 = $_REQUEST['tgl1'];
	$tgl2 = $_REQUEST['tgl2'];
	$status= $_REQUEST['cobStatusbarang'];
	$perusahaan= $_REQUEST['cobPerusahaan'];
		if ($status=="semua" and $perusahaan=="semua"){
			$sql = mysqli_query($koneksi, "select a.kode_brg_servis, a.id_perusahaan, a.type_brg, b.statusbrg_update, b.tgl_masuk 
									from barang_servis a, statusbrg_update b 
									where a.kode_brg_servis=b.kode_brg_servis and b.tgl_masuk BETWEEN '$tgl1' AND '$tgl2' order by b.tgl_masuk ");
		}
		else if($status=="semua" and $perusahaan !=="semua") {
		$sql = mysqli_query($koneksi, "select a.kode_brg_servis, a.id_perusahaan, a.type_brg, b.statusbrg_update, b.tgl_masuk 
											from barang_servis a, statusbrg_update b 
											where a.kode_brg_servis=b.kode_brg_servis and a.id_perusahaan='$perusahaan' and b.tgl_masuk BETWEEN '$tgl1' AND '$tgl2' order by b.tgl_masuk ");
		}
		else if($status !=="semua" and $perusahaan=="semua"){
		$sql = mysqli_query($koneksi, "select a.kode_brg_servis, a.id_perusahaan, a.type_brg, b.statusbrg_update, b.tgl_masuk 
											from barang_servis a, statusbrg_update b 
											where a.kode_brg_servis=b.kode_brg_servis and b.statusbrg_update='$status' and b.tgl_masuk BETWEEN '$tgl1' AND '$tgl2' order by b.tgl_masuk ");

		}
		else {
		$sql = mysqli_query($koneksi, "select a.kode_brg_servis, a.id_perusahaan, a.type_brg, b.statusbrg_update, b.tgl_masuk 
											from barang_servis a, statusbrg_update b 
											where a.kode_brg_servis=b.kode_brg_servis and b.statusbrg_update='$status' and a.id_perusahaan='$perusahaan' and b.tgl_masuk BETWEEN '$tgl1' AND '$tgl2' order by b.tgl_masuk ");

		}									
									
			if(mysqli_num_rows($sql) > 0){
			$data=1;
			$no = 0;
				echo '<h2>Rekap Laporan Barang Servis <small>'.$tgl1.' sampai '.$tgl2.'</small></h2><hr>
				<div class="col-sm-1">
				<a href="?hlm=laporanBrgmasuk" id="tombol" class="btn btn-info pullleft"><span class="glyphicon glyphicon-chevron-left" ariahidden="true"></span> Kembali</a><br/><br/><br/>
				<button id="tombol" onclick="window.print()" class="btn btn-warning"><span class="glyphicon glyphicon-print" ariahidden="true"></span> Cetak</button>
				</div>
					<div class="col-sm-11">
						<table class="table table-bordered" style="font-size:18px">
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
						<tbody>';
					while($row = mysqli_fetch_array($sql)){
					$no++;
					$id_perusahaan=$row['id_perusahaan'];
					$sqlmerek=mysqli_query($koneksi, "select merek from rekanan_perusahaan where id_perusahaan ='$id_perusahaan' ");
					list($merek)=mysqli_fetch_array($sqlmerek);
					echo '
							<tr>
								<td>'.$no.'</td>
								<td>'.$row['kode_brg_servis'].'</td>
								<td>'.$merek.'</td>
								<td>'.$row['type_brg'].'</td>
								<td>'.$row['statusbrg_update'].'</td>
								<td>'.date("d M Y", strtotime($row['tgl_masuk'])).'</td>
							</tr>' ;
								}
								
							
					echo ' 
							</tbody>
							</table>

						<div class="col-sm-12">
							<table class="table table-bordered" style="font-size:20px">';
					echo '
								<tr class="info">
									<th>Jumlah Data Masuk</th>
									<th>Jumlah Data Pengerjaan</th>
									<th>Jumlah Data Keluar</th>
								</tr>';
						$tanggal = date('Y-m-d');
						$sql = mysqli_query($koneksi, "SELECT count(tgl_masuk) FROM statusbrg_update WHERE tgl_masuk BETWEEN '$tgl1' AND '$tgl2' ");
						list($tgl_masuk) = mysqli_fetch_array($sql);

						$sql = mysqli_query($koneksi, "SELECT count(tgl_pengerjaan) FROM statusbrg_update WHERE tgl_pengerjaan BETWEEN '$tgl1' AND '$tgl2' ");
						list($tgl_pengerjaan) = mysqli_fetch_array($sql);

						$sql = mysqli_query($koneksi, "SELECT count(tgl_keluar) FROM statusbrg_update WHERE tgl_keluar BETWEEN '$tgl1' AND '$tgl2' ");
						list($tgl_keluar) = mysqli_fetch_array($sql);
							
					echo '
								<tr>
									<td><span class="pull-right">'.$tgl_masuk. ' data</span></td>
									<td><span class="pull-right">'.$tgl_pengerjaan. ' data</span></td>
									<td><span class="pull-right">'.$tgl_keluar. ' data</span></td>
								</tr>';
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
	echo '<h2>Laporan Barang Masuk</h2><hr>';
	?>
	<div class="well well-sm noprint">
		<form class="form-horizontal" role="form" method="post" action="">
			<div class="form-group">
				<label class="col-sm-2 control-label" for="tgl1">Mulai</label>
				<div class="col-sm-2">
					<input type="date" class="form-control" id="tgl1" name="tgl1" required>
				</div>
			
				<label class="col-sm-3 control-label" for="tgl2">Hingga</label>
				<div class="col-sm-2">
					<input type="date" class="form-control" id="tgl2" name="tgl2" required>
				</div>
			</div>
			
			<div class="form-group">
				<label for="jenis" class="col-sm-2 control-label">Status Barang</label>
				<div class="col-sm-3">
					<select name="cobStatusbarang" size="" class="form-control" required>
					<option value='+'>-- Pilih Status Barang --</option>";
					<option value='semua'>Semua Status (Masuk, Dikerjakan, Keluar )</option>";
					<option value='masuk'>barang masuk</option>";
					</select>
				</div>
			
				<label for="jenis" class="col-sm-2 control-label">Merek</label>
				<div class="col-sm-3">
					<select name="cobPerusahaan" size="" class="form-control" required>
					<option value='semua'>Semua Data</option>";
					<?php
						$sql = mysqli_query($koneksi, "select * from rekanan_perusahaan  ");
						while($data = mysqli_fetch_array($sql)){
						echo "<option value='$data[id_perusahaan]'>$data[merek]---$data[nama_perusahaan]</option>";
						}
					?>
					</select>
				<button type="submit" name="submit" class="btn btn-success pull-right">Proses</button>
				</div>
			</div>
		</form>
		
	</div>
<?php
echo '
		<div class="col-sm-7">
			<table class="table table-bordered" style="font-size:20px">';
echo '
		<h2>Laporan Barang Masuk Hari Ini (<small>'.date('d-m-Y').'</small>)</h2><hr>';
echo '
				<tr class="info">
					<th>Jumlah Data Masuk</th>
					<th>Jumlah Data Pengerjaan</th> 
					<th>Jumlah Data Keluar</th>
					</tr>';
						$tanggal = date('Y-m-d');
						$sql = mysqli_query($koneksi, "SELECT count(tgl_masuk) FROM statusbrg_update WHERE tgl_masuk='$tanggal' ");
						list($tgl_masuk) = mysqli_fetch_array($sql);

						$sql = mysqli_query($koneksi, "SELECT count(tgl_pengerjaan) FROM statusbrg_update WHERE tgl_pengerjaan='$tanggal' ");
						list($tgl_pengerjaan) = mysqli_fetch_array($sql);

						$sql = mysqli_query($koneksi, "SELECT count(tgl_keluar) FROM statusbrg_update WHERE tgl_keluar='$tanggal' ");
						list($tgl_keluar) = mysqli_fetch_array($sql);

echo '
				<tr style="font-size:20px">
					<td><span class="pull-right">'.$tgl_masuk. ' data</span></td>
					<td><span class="pull-right">'.$tgl_pengerjaan. ' data</span></td>
					<td><span class="pull-right">'.$tgl_keluar. ' data</span></td>
				</tr>';
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