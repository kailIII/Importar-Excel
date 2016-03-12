<?php 
include('includes/bd/conexion.php');

$db = new Conexion();

$query = "SELECT nombre, count(*)
FROM datos 
GROUP BY nombre
HAVING count(*) > 1;";
$result = $db->query($query);
$numfilas = $result->num_rows;
//echo "El n&uacute;mero de elementos es ".$numfilas;
if ($numfilas>0) 
{
echo "<script>
      alert('Existen Registros Duplicados');
      window.location='consulta.php';
     </script>";
}
else
{
 
echo "<script>
      alert('No Tiene registros duplicados');
      window.location='consulta.php';
     </script>";

}


 ?>



