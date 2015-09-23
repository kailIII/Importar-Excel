
<!DOCTYPE html>
<html lang="es">
<head>
<?php// include('../../header.php');  ?>
<script>
function validar(f){
f.enviar.value="Por favor, espere";
f.enviar.disabled=true;
f.usuario.value=(f.usuario.value=="")?"Anónimo":f. usuario.value;

return true}
</script>
</head>
<body>
<div class="container">	

<div class="row clearfix">
<div class="col-md-6 column">	


<!-- FORMULARIO PARA SOICITAR LA CARGA DEL EXCEL -->
<label class="text-success">Selecciona el archivo a importar:</label>
<form name="importa" method="post" action="<?php echo $PHP_SELF; ?>"
enctype="multipart/form-data"  onsubmit="return validar(this)">
<input type="file" name="excel" class="form-control" required />
<input type='submit' name='enviar' class="btn btn-success"  value="Importar"  />
<input type="hidden" value="upload" name="action" />
</form>
<!-- CARGA LA MISMA PAGINA MANDANDO LA VARIABLE upload -->
<?php
set_time_limit(2000);
extract($_POST);
if ($action == "upload") {
//cargamos el archivo al servidor con el mismo nombre
//solo le agregue el sufijo bak_ 
$archivo = $_FILES['excel']['name'];
$tipo = $_FILES['excel']['type'];
$destino = "bak_" . $archivo;
if (copy($_FILES['excel']['tmp_name'], $destino)){
?>
<!--  
<label for="	">Archivo Cargado Con Éxito</label>-->

<?php
}
else{
echo "Error Al Cargar el Archivo";
}
if (file_exists("bak_" . $archivo)) {
/** Clases necesarias */
require_once('Classes/PHPExcel.php');
require_once('Classes/PHPExcel/Reader/Excel2007.php');
// Cargando la hoja de cálculo
$objReader = new PHPExcel_Reader_Excel2007();
$objPHPExcel = $objReader->load("bak_" . $archivo);
$objFecha = new PHPExcel_Shared_Date();
// Asignar hoja de excel activa
$objPHPExcel->setActiveSheetIndex(0);
//conectamos con la base de datos 
$cn = mssql_connect("192.168.1.4", "APLICACIONES", "APLICACIONES") or die("ERROR EN LA CONEXION");
$db = mssql_select_db("[021BDCOMUN]", $cn) or die("ERROR AL CONECTAR A LA BD");
// Llenamos el arreglo con los datos  del archivo xlsx
for ($i = 1; $i <=5000; $i++) {
$_DATOS_EXCEL[$i]['codigo'] = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
$_DATOS_EXCEL[$i]['descripcion'] = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
//$_DATOS_EXCEL[$i]['USUARIO']= $_SESSION['id_usuario']; 
//$_DATOS_EXCEL[$i]['TIPO']= "OT-CC"; 
}
}
//si por algo no cargo el archivo bak_ 
else {
echo "Necesitas primero importar el archivo";
}
$errores = 0;
//recorremos el arreglo multidimensional 
//para ir recuperando los datos obtenidos
//del excel e ir insertandolos en la BD
//$usuariosesion=$_SESSION['id_usuario'];

foreach ($_DATOS_EXCEL as $campo => $valor) {
/*$sql = "INSERT INTO DATOS_RSV VALUES (NULL,'";
foreach ($valor as $campo2 => $valor2) {
$campo2 == "USUARIO" ? $sql.= $valor2 . "');" : $sql.= $valor2 . "','";*/


$sql = "INSERT INTO carga_excel VALUES ('";
foreach ($valor as $campo2 => $valor2) {
$campo2 == "descripcion" ? $sql.= $valor2 . "');" : $sql.= $valor2 . "','";

//$sql2="DELETE FROM [020BDCOMUN].DBO.DATOS_RSV WHERE USUARIO='$usuariosesion'";

}

//$result2 = mssql_query($sql2);
echo$result = mssql_query($sql);
//echo $sql;
if (!$result) {
//echo "Error al insertar registro " . $campo;

$errores+=1;
}
}
echo "<h4 class='text-success'><center>ARCHIVO IMPORTADO ,
EN TOTAL"; echo" ";echo $campo-$errores; echo " REGISTROS";
?>
<br>	
<a href="consulta" class="btn btn-primary">CONSULTAR DATA CARGADA</a>

<?php  
//una vez terminado el proceso borramos el archivo que esta en el servidor el bak_
unlink($destino);
}
?>


</div>

<div class="col-md-6 column">
<br>

</div>
</div>

</div>

</body>
</html>