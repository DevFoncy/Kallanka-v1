<?php
require_once('../../config.php');
include('../../model/gpn_users_m/gpn_users_m.php');
require_once('../../smarty.php');
    //Instancia de objeto
	$obj = new User_model();
	
	//Capturando Parametros
	$IdUsu=getParameter("IdUsu","");
	//capturando parametro filtro de listado de usuarios
	$user=getParameter("user","");
	$name=getParameter("name","");	
	//Listado de usuarios
    $ls_user_permit= $obj->list_PermisoUser_m($IdUsu);	
	/*::::::::::::::::::::::::::::::::::::::::::::::::::::::
	::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
	//Asignacion de plantilla	
	$smarty->assign("rs_user_permit", $ls_user_permit);
	//$smarty->assign("NameUser", $NameUser);
	$smarty->assign("IdUsu", $IdUsu);
	$smarty->assign("fl_user", $user);
	$smarty->assign("fl_name", $name);

	//Visor
	$smarty->display('gpn_users_v/gpn_users_permit.html');
//}
?>
