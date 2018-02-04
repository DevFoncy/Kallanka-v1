<?php 
require_once('config.php');
include('model/k_users_ubicacion_m/k_users_ubicacion_m.php');

/*Por defecto Ubicacion de San Marcos*/
$lat_inicial=-12.053265;
$lon_inicial=-77.085504;

$obj = new Ubicacion();		
$ListPois=$obj->getPois($lat_inicial,$lon_inicial);

      
      //var_dump($longitud);
//Llamada a la vista
		require_once("index.php");
//header('Location: index.php');

?>