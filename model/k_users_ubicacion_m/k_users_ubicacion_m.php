<?php
class Ubicacion{
 /*Parametros*/
  var $con;
  var $user_id;
  var $user_name;
  var $user_password;
  var $user_email;

  public function __construct()
  {
  $this->con = pg_pconnect("host=".DATA_SOURCE." port=5432 dbname=".DATABASE." user=".USER_NAME." password=".USER_PASSWORD );
  }
  
  function getPois($lat,$long){
  	$sqlPois="select * from public.calcular_pois_cercanos('$lat','$long') order by distance asc limit 5";
  	$res = pg_exec( $this->con,$sqlPois);
  	while($line = pg_fetch_assoc($res)){
	   $rs_pois[] = $line;
	 }
	return $rs_pois;

  }
}
?>