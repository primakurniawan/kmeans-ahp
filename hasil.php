<?php
include('config.php');
include('fungsi.php');
require './vendor/jacobemerick/kmeans/src/KMeans.php';
require './vendor/AHPDss/src/AHP.php';

use Bardiz12\AHPDss\AHP;

// print_r(get_declared_classes());
$ahp = new AHP();
$criterias = [
	'jarak',
	'harga',
	'menu',
	'fasilitas',
];
foreach ($criterias as $key => $value) {
	$ahp->addQuantitativeCriteria($value);
}

$ar = $_POST['bobot'];
$candidates = json_decode(base64_decode($_POST['candidates']));
$pairWise = json_decode(base64_decode($_POST['pairWise']), true);


$ahp->setRelativeInterestMatrix($ar);

$ahp->setCandidates($candidates);

$ahp->setBatchCriteriaPairWise($pairWise);
$ahp->finalize();

$results = $ahp->getResult();

$n = sizeof($results);
for ($i = 1; $i < $n; $i++) {
	for ($j = $n - 1; $j >= $i; $j--) {
		if ($results[$j - 1]['value'] < $results[$j]['value']) {
			$tmp = $results[$j - 1]['value'];
			$results[$j - 1]['value'] = $results[$j]['value'];
			$results[$j]['value'] = $tmp;
		}
	}
}
include('header.php');
?>

<section class="content">
	<h2 class="ui header">Hasil Perhitungan</h2>
	<table class="ui celled table">
		<thead>
			<tr>
				<th>Rank</th>
				<th>Name</th>
				<th>Value</th>
			</tr>
		</thead>
		<tbody>

			<?php
			$i = 1;
			foreach ($results as $result) { ?>
				<tr>
					<td><?php echo $i ?></td>
					<td><?php echo $result['name'] ?></td>
					<td><?php echo $result['value'] ?></td>
				</tr>
			<?php $i++;
			} ?>
		</tbody>



	</table>

</section>

<?php include('footer.php'); ?>