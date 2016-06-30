<?php 
include('configuracion.php');
include('bd/conexion.php');
$db     = new Conexion();
$query  = "SELECT * FROM alumno";
$result = $db->query($query);
 ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Consultar</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h1>Lista de Alumnos</h1>
			<hr>
				<div class="table-responsive">
					<table class="table table-hover table-bordered">
						<thead>
							<tr class="info">
								<th>Código</th>
								<th>Nombres</th>
								<th>Apellidos</th>
								<th>Edad</th>
								<th>Usuario</th>
								<th>Contraseña</th>
							</tr>
						</thead>
						<tbody>
							<?php 

                             while ($fila = mysqli_fetch_object($result))
                              {

                              	?>
                            <tr>
								<td><?php echo $fila->codigo; ?></td>
								<td><?php echo $fila->nombres; ?></td>
								<td><?php echo $fila->apellidos; ?></td>
								<td><?php echo $fila->edad; ?></td>
								<td><?php echo $fila->usuario; ?></td>
							    <td><?php echo $fila->contrasena; ?></td>	
							</tr>
                              
                              <?php	
                              }
							 ?>
						</tbody>
					</table>
				</div>
				<a href="/<?php echo PATH; ?>/" class="btn btn-primary">Volver a Cargar</a>
			</div>
		</div>
	</div>	
</body>
</html>