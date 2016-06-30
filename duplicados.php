<?php 	include('configuracion.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mensaje</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="jumbotron">
			<h1>Hay usuarios duplicados,revise y vuelva a cargar</h1>

			<a href="/<?php echo PATH; ?>/" class="btn btn-primary">Cargar de Nuevo</a>
			</div>
		</div>
	</div>
</div>
</body>
</html>