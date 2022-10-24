<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Sistem Pendukung Keputusan metode AHP</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">
</head>

<body>
	<header>
		<h1>Sistem Pendukung Keputusan dengan metode AHP</h1>
	</header>

	<div class="wrapper">
		<nav id="navigation" role="navigation">
			<ul>
				<li><a class="item" href="index.php">Home</a></li>
				<li>
					<a class="item" href="alternatif.php">Alternatif
						<div class="ui blue tiny label" style="float: right;"><?php echo getJumlahAlternatif(); ?></div>
					</a>
				</li>
				<li>
					<a class="item" href="clustering.php">Clustering </a>
				</li>
				<li><a class="item" href="#" disable>Perbandingan Kriteria</a></li>

				<li><a class="item" href="#">Hasil</a></li>
			</ul>
		</nav>