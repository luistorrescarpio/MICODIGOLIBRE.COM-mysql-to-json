<?php 
//Script para conexión con base de datos en Mysql
include("db_controller/mysql_script.php");

// Obtenemos parametros
$obj = (object)$_REQUEST;

switch ($obj->action) {
  case 'exportToJSON':
	// Obtenemos los 100 primeros registros desde la siguiente consulta
	$r = query("SELECT * FROM personal ORDER BY nombres ASC LIMIT 100 ");
	// Nombre del archivo a generar
	$fileName = "exportJSON.json";
	// Convertirmos el objeto obtenido desde MYSQL a JSON
	$textJson = json_encode($r);   
	// Procedemos a crear el archivo e ingresar los datos en el
	$handle = fopen($fileName, "w");
    fwrite($handle, $textJson);
    fclose($handle);
    // Establecemos el tipo de archivo a generar
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.$fileName);
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    readfile($fileName);

	break;
}
?>