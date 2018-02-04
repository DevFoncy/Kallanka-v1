<?php
/* Configurationes*/
define("DATA_SOURCE","localhost");
define("USER_NAME","postgres");
define("USER_PASSWORD","123");
define("DATABASE","postgres");

/*
define("DATA_SOURCE_STREET","localhost");
define("USER_NAME_STREET","postgres");
define("USER_PASSWORD_STREET","");
define("DATABASE_STREET","gps");*/

define("VIRTUAL_ROOT","/gpnextnew2/");//Directorio Raiz de la Aplicacion

define("LOCAL_ROOT",'C:/xampp/htdocs/gpnextnew2');//Directorio Raiz de la Aplicacion
define("SMARTY_DIR",'C:/xampp/htdocs/libs/');//Ruta a las libreria de Smarty
define("TEMPLATES_PATH",'C:/xampp/htdocs/gpnextnew2/view/');//Ruta al directorio de los Templates 

define("SMARTY_COMPILE_CHECK",true);//true:si esta en fase de desarrollo, false: servidor de produccion
define("SMARTY_CACHING",false);//false:si esta en fase de desarrollo, true: servidor de produccion

date_default_timezone_set('America/Lima'); 
//setlocale(LC_TIME, 'es_ES.UTF-8');

//Util Functions
function getParameter($paramName,$defaultValue){
	$LPOST = array_change_key_case($_POST);
	$LGET = array_change_key_case($_GET);
	$paramName= strtolower($paramName);
	if(isset($LGET[$paramName])) {
		if($LGET[$paramName]!="") return pg_escape_string(utf8_encode($LGET[$paramName]));
		else return $defaultValue;
	}else if(isset($LPOST[$paramName])) {
		if($LPOST[$paramName]!="") return pg_escape_string(utf8_encode($LPOST[$paramName]));
		else return ($defaultValue);
	}else{
		return $defaultValue;
} 
}
function _p() { 
  return call_user_func_array("getParameter", func_get_args());
}
?>
