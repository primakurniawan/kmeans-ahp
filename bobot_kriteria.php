<?php
include('config.php');
include('fungsi.php');

include('header.php');

$arrayCafe = json_decode(base64_decode($_POST['ar']));
$candidates = [];
$pairWise = [
	'jarak' => [],
	'harga' => [],
	'menu' => [],
	'fasilitas' => [],
];
foreach ($arrayCafe as $key => $value) {
	array_push($candidates, $value->nama);
	$pairWise['jarak'][] = $value->jarak;
	$pairWise['harga'][] = $value->harga;
	$pairWise['menu'][] = $value->menu;
	$pairWise['fasilitas'][] = $value->fasilitas;
}

?>


<section>
	<form action="hasil.php" method="POST">

		<table class="ui celled table">
			<thead>
				<tr>
					<th class="collapsing"></th>
					<th>Jarak</th>
					<th>Harga</th>
					<th>Menu</th>
					<th>Fasilitas</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th>Jarak</th>
					<td><input type="number" class="bobot" name="bobot[0][0]" disabled value="1"></td><input type="hidden" class="bobot" name="bobot[0][0]" value="1"></td>
					<td><input type="number" step="any" class="bobot" name="bobot[0][1]" min="<?php echo 1 / 9 ?>" max=9></td>
					<td><input type="number" step="any" class="bobot" name="bobot[0][2]" min="<?php echo 1 / 9 ?>" max=9></td>
					<td><input type="number" step="any" class="bobot" name="bobot[0][3]" min="<?php echo 1 / 9 ?>" max=9></td>
				</tr>
				<tr>
					<th>Harga</th>
					<td><input type="number" step="any" class="bobot" name="bobot[1][0]" min="<?php echo 1 / 9 ?>" max=9></td>
					<td><input type="number" class="bobot" name="bobot[1][1]" disabled value="1"><input type="hidden" class="bobot" name="bobot[1][1]" value="1"></td>
					<td><input type="number" step="any" class="bobot" name="bobot[1][2]" min="<?php echo 1 / 9 ?>" max=9></td>
					<td><input type="number" step="any" class="bobot" name="bobot[1][3]" min="<?php echo 1 / 9 ?>" max=9></td>
				</tr>
				<tr>
					<th>Menu</th>
					<td><input type="number" step="any" class="bobot" name="bobot[2][0]" min="<?php echo 1 / 9 ?>" max=9></td>
					<td><input type="number" step="any" class="bobot" name="bobot[2][1]" min="<?php echo 1 / 9 ?>" max=9></td>
					<td><input type="number" class="bobot" name="bobot[2][2]" disabled value="1"><input type="hidden" class="bobot" name="bobot[2][2]" value="1"></td>

					<td><input type="number" step="any" class="bobot" name="bobot[2][3]" min="<?php echo 1 / 9 ?>" max=9></td>
				</tr>
				<tr>
					<th>Fasilitas</th>
					<td><input type="number" step="any" class="bobot" name="bobot[3][0]" min="<?php echo 1 / 9 ?>" max=9></td>
					<td><input type="number" step="any" class="bobot" name="bobot[3][1]" min="<?php echo 1 / 9 ?>" max=9></td>
					<td><input type="number" step="any" class="bobot" name="bobot[3][2]" min="<?php echo 1 / 9 ?>" max=9></td>
					<td><input type="number" class="bobot" name="bobot[3][3]" disabled value="1"><input type="hidden" class="bobot" name="bobot[3][3]" value="1"></td>

				</tr>

			</tbody>

		</table>
		<input type="hidden" name="candidates" value="<?php echo base64_encode(json_encode($candidates)) ?>">
		<input type="hidden" name="pairWise" value="<?php echo base64_encode(json_encode($pairWise)) ?>">
		<button class="ui right labeled icon button" style="float: right;">
			<i class="right arrow icon"></i>
			Lanjut
		</button>
	</form>
</section>

<script>
	const bobotEl = document.querySelectorAll(".bobot")
	for (let i = 0; i < bobotEl.length; i++) {
		bobotEl[i].addEventListener("input", function() {
			document.querySelector('[name="bobot' + Array.from(bobotEl[i].name.matchAll(/\[(.*?)\]/g))[1][0] + Array.from(bobotEl[i].name.matchAll(/\[(.*?)\]/g))[0][0] + '"]').value = 1 / bobotEl[i].value
		});
	}
</script>

<?php include('footer.php'); ?>