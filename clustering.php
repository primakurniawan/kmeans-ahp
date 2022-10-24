<?php
include('config.php');
include('fungsi.php');
require './vendor/jacobemerick/kmeans/src/KMeans.php';

// menjalankan perintah edit
if (isset($_POST['edit'])) {
	$id = $_POST['id'];

	header('Location: edit.php?tabel=alternatif&id=' . $id);
	exit();
}

// menjalankan perintah delete
if (isset($_POST['delete'])) {
	$id = $_POST['id'];
	deleteAlternatif($id);
}

// menjalankan perintah tambah
if (isset($_POST['tambah'])) {
	$nama = $_POST['nama'];
	tambahData('alternatif', $nama);
}

include('header.php');

?>


<section class="content">

	<h2 class="ui header">Alternatif</h2>



	<?php
	// Menampilkan list alternatif
	$query = "SELECT id,nama, jarak, harga, menu, fasilitas FROM alternatif ORDER BY id";
	$result	= mysqli_query($koneksi, $query);

	$i = 0;
	$array2d = [];

	while ($row = mysqli_fetch_array($result)) {
		$i++;
		array_push($array2d, [$row['jarak'], $row['harga'], $row['menu'], $row['fasilitas']]);
	}

	$kmeans = new Jacobemerick\KMeans\Kmeans($array2d);
	$kmeans->cluster(3); // cluster into three sets

	$clustered_data = $kmeans->getClusteredData();




	$centroids = $kmeans->getCentroids();


	// Menampilkan list alternatif
	$query = "SELECT id,nama, jarak, harga, menu, fasilitas FROM alternatif ORDER BY id";
	$result	= mysqli_query($koneksi, $query);

	$i = 0;
	$clusteredArray = [
		0 => [],
		1 => [],
		2 => []
	];

	while ($row = mysqli_fetch_array($result)) {
		$i++;
		foreach ($clustered_data as $key => $array) {
			foreach ($array as $item) {

				if ([$row['jarak'], $row['harga'], $row['menu'], $row['fasilitas']] == $item && !in_array(array(
					'nama' => $row['nama'],
					'jarak' => $row['jarak'],
					'harga' => $row['harga'],
					'menu' => $row['menu'],
					'fasilitas' => $row['fasilitas'],
				), $clusteredArray[$key])) {
					$clusteredArray[$key][] = array(
						'nama' => $row['nama'],
						'jarak' => $row['jarak'],
						'harga' => $row['harga'],
						'menu' => $row['menu'],
						'fasilitas' => $row['fasilitas']
					);
				}
			}
		}
	} ?>

	<?php

	foreach ($clusteredArray as $key => $clustered) {
		$i = 1;
	?>
		<h3>Cluster <?php echo $key ?></h3>
		<table class="ui celled table">
			<thead>
				<tr>
					<th class="collapsing">No</th>
					<th>Nama Cafe</th>
					<th>Jarak</th>
					<th>Harga</th>
					<th>Menu</th>
					<th>Fasilitas</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($clustered as $item) { ?>

					<tr>
						<td><?php echo $i ?></td>
						<td><?php echo $item['nama'] ?></td>
						<td><?php echo $item['jarak'] ?></td>
						<td><?php echo $item['harga'] ?></td>
						<td><?php echo $item['menu'] ?></td>
						<td><?php echo $item['fasilitas'] ?></td>
					</tr>

				<?php $i++;
				} ?>
			</tbody>
		</table>
		<form action="bobot_kriteria.php" method="POST">
			<input type="hidden" name="ar" value="<?php echo base64_encode(json_encode($clustered)) ?>">
			<button class="ui right labeled icon button" style="float: right;">
				<i class="right arrow icon"></i>
				Lanjut
			</button>
		</form>
	<?php
	} ?>






</section>

<?php include('footer.php'); ?>