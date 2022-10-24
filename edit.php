<?php
include('config.php');
include('fungsi.php');

// mendapatkan data edit
if (isset($_GET['tabel']) && isset($_GET['id'])) {
	$id 	= $_GET['id'];
	$tabel	= $_GET['tabel'];

	if ($_GET['tabel'] == 'alternatif') {
		// hapus record
		$query 	= "SELECT nama, jarak, harga, menu, fasilitas FROM alternatif WHERE id=$id";
		$result	= mysqli_query($koneksi, $query);

		while ($row = mysqli_fetch_array($result)) {
			$nama = $row['nama'];
			$jarak = $row['jarak'];
			$harga = $row['harga'];
			$menu = $row['menu'];
			$fasilitas = $row['fasilitas'];
		}
	}
}

if (isset($_POST['update'])) {
	$id 	= $_POST['id'];
	$tabel	= $_POST['tabel'];
	$nama 	= $_POST['nama'];
	$jarak 	= $_POST['jarak'];
	$harga 	= $_POST['harga'];
	$menu 	= $_POST['menu'];
	$fasilitas = $_POST['fasilitas'];

	$query 	= "UPDATE $tabel SET nama='$nama', jarak=$jarak, menu=$menu, harga=$harga, fasilitas=$fasilitas WHERE id=$id";
	$result	= mysqli_query($koneksi, $query);

	if (!$result) {
		echo mysqli_error($koneksi);
		echo "Update gagal";
		exit();
	} else {
		header('Location: ' . $tabel . '.php');
		exit();
	}
}

include('header.php');
?>

<section class="content">
	<h2>Edit <?php echo $tabel ?></h2>

	<form class="ui form" method="post" action="edit.php">

		<input type="hidden" name="id" value="<?php echo $id ?>">
		<input type="hidden" name="tabel" value="<?php echo $tabel ?>">

		<div class="inline field">
			<label>Nama Cafe</label>
			<input type="text" name="nama" placeholder="<?php echo $tabel ?> baru" value="<?php echo $nama ?>">
		</div>

		<?php if ($tabel == "alternatif") { ?>

			<div class="inline field">
				<label>Jarak</label>
				<input type="number" min="1" max="3" name="jarak" placeholder="Jarak Cafe" value="<?php echo $jarak ?>">
			</div>
			<div class="inline field">
				<label>Harga</label>
				<input type="number" min="1" max="3" name="harga" placeholder="Harga Cafe" value="<?php echo $harga ?>">
			</div>
			<div class="inline field">
				<label>Menu</label>
				<input type="number" min="1" max="3" name="menu" placeholder="Menu Cafe" value="<?php echo $menu ?>">
			</div>
			<div class="inline field">
				<label>Fasilitas</label>
				<input type="number" min="1" max="3" name="fasilitas" placeholder="Fasilitas Cafe" value="<?php echo $fasilitas ?>">
			</div>

		<?php } else { ?>

			<div class="socialnews2">
				<!-- start div social-->
				... rest of content here

			<?php } ?>

			<input class="ui green button" type="submit" name="update" value="UPDATE">
	</form>
</section>

<?php include('footer.php'); ?>