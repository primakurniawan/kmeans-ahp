<?php
include('config.php');
include('fungsi.php');

// mendapatkan data edit
if (isset($_GET['tabel'])) {
	$tabel	= $_GET['tabel'];
}

if (isset($_POST['tambah'])) {
	$tabel	= $_POST['tabel'];
	$data 	= $_POST;

	tambahData($tabel, $data);

	header('Location: ' . $tabel . '.php');
}

include('header.php');
?>

<section class="content">
	<h2>Tambah <?php echo $tabel ?></h2>

	<form class="ui form" method="post" action="tambah.php">
		<div class="inline field">
			<label>Nama Cafe</label>
			<input type="text" name="nama" placeholder="<?php echo $tabel ?> baru">
			<input type="hidden" name="tabel" value="<?php echo $tabel ?>">
		</div>

		<?php if ($tabel == "alternatif") { ?>

			<div class="inline field">
				<label>Jarak</label>
				<input type="number" min="1" max="3" name="jarak" placeholder="Jarak Cafe">
			</div>
			<div class="inline field">
				<label>Harga</label>
				<input type="number" min="1" max="3" name="harga" placeholder="Harga Cafe">
			</div>
			<div class="inline field">
				<label>Menu</label>
				<input type="number" min="1" max="3" name="menu" placeholder="Menu Cafe">
			</div>
			<div class="inline field">
				<label>Fasilistas</label>
				<input type="number" min="1" max="3" name="fasilitas" placeholder="Fasilistas Cafe">
			</div>

		<?php } else { ?>

			<div class="socialnews2">
				<!-- start div social-->
				... rest of content here

			<?php } ?>
			<input class="ui green button" type="submit" name="tambah" value="SIMPAN">
	</form>
</section>

<?php include('footer.php'); ?>