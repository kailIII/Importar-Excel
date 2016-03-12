<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Consulta</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.6/flatly/bootstrap.min.css">

</head>
<body>
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<a href="importar.php">inicio</a>
<a href="validar.php" class="btn btn-success">Consutar Registros Duplicados</a>
<div class="table-responsive">
<table class="table table-bordered table-condesed">
<?php
include('includes/bd/conexion.php');
$db = new Conexion();
$query = "SELECT * FROM datos";
$result = $db->query($query);
$numfilas = $result->num_rows;
//echo "El n&uacute;mero de elementos es ".$numfilas;
?>

<thead>
<tr class="info">
<th>ID</th>
<th>Nombre</th>
<th>Dirección</th>
</tr>
</thead>
<tbody>
<?php

for ($x=0;$x<$numfilas;$x++) {
$fila = $result->fetch_object();

?>
<tr class="active">
<td><?php echo $fila->id; ?></td>
<td><?php echo $fila->nombre; ?></td>
<td><?php echo $fila->direccion; ?></td>
</tr>
<?php
}
?>

</tbody>
</table>
</div>



</div>
</div>
</div>
</body>
</html>