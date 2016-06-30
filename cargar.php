<?php
include('configuracion.php');
include('bd/conexion.php');
include('librerias/PHPEXCEL/PHPExcel.php');
include('librerias/PHPEXCEL/PHPExcel/Reader/Excel2007.php');

extract($_POST);
if ($action == "upload") {
//cargamos el archivo al servidor con el mismo nombre
//solo le agregue el sufijo bak_ 
$archivo   = $_FILES['excel']['name'];
$tipo      = $_FILES['excel']['type'];
$destino   = "bak_" . $archivo;
if (copy($_FILES['excel']['tmp_name'], $destino))
{
#echo "Archivo Cargado Con Éxito";
}
else
{
echo "Error Al Cargar el Archivo";
}

if (file_exists("bak_" . $archivo)) 
{

// Cargando la hoja de cálculo
$objReader = new PHPExcel_Reader_Excel2007();
$objPHPExcel = $objReader->load("bak_" . $archivo);
$objFecha = new PHPExcel_Shared_Date();
// Asignar hoja de excel activa
$objPHPExcel->setActiveSheetIndex(0);


// Llenamos el arreglo con los datos  del archivo xlsx
for ($i = 2; $i <= 3; $i++)
{
$_DATOS_EXCEL[$i]['nombres']    = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
$_DATOS_EXCEL[$i]['apellidos'] = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
$_DATOS_EXCEL[$i]['edad'] = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
$_DATOS_EXCEL[$i]['usuario'] = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
$_DATOS_EXCEL[$i]['contrasena'] = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();
}

}

//si por algo no cargo el archivo bak_ 
else 
{
echo "Necesitas primero importar el archivo";
}

$errores = 0;
//recorremos el arreglo multidimensional 
//para ir recuperando los datos obtenidos
//del excel e ir insertandolos en la BD


foreach ($_DATOS_EXCEL as $key => $value)
 {
 $db       = new Conexion();
 $query    = "SELECT * FROM alumno WHERE usuario='$value[usuario]'";
 $result   = $db->query($query);
 $numfilas = $result->num_rows;
if ($numfilas >0) 
{
  header('Location: duplicados.php');
}
else
{
  $query  =  "INSERT INTO alumno(nombres,apellidos,edad,usuario,contrasena)VALUES('$value[nombres]','$value[apellidos]','$value[edad]','$value[usuario]','$value[contrasena]') ";
 $result = $db->query($query);
 if (!$result) 
 echo "error";
 else
 unlink($destino);//Una vez terminado el proceso borramos el archivo que esta en el servidor el bak_
 header('Location: mensaje.php');
}


}





}
?>