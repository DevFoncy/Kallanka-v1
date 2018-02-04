<?php
require_once('../../config.php');
include('../../model/gpn_users_m/gpn_users_m.php');
require_once('../../smarty.php');
session_start(); 
//Verificando si la session usuario existe
if (isset($_SESSION['user_id']))	{
	$user_id= $_SESSION["user_id"];
	session_write_close();

	$obj = new User_model();	
	


	$rs="";

	$CMD=getParameter("CMD","");
	//Para consultar si es Insert o Update
	$IdUsu=getParameter("IdUsu","");
	$ls_Excontrato= $obj->list_busqcontrato_m($IdUsu);
		
	$NROCONTRATO=getParameter("NroContrato","0");
	$Doc=getParameter("Doc","");
	$RazonSocial=getParameter("RazonSocial","");
	$Direc=getParameter("Direc","");
	$NomRespon=getParameter("NomRespon","");
	$DocRespon=getParameter("DocRespon","");
	$Tipo=getParameter("Tipo","");
	$Estado=getParameter("Estado","");
	$RepCargo=getParameter("RepCargo","");
	$TipoDoc=getParameter("TipoDoc","");

	
	if( $CMD=="SAVE"){
		if(count($ls_Excontrato) ==0) {
			$rs= $obj->reg_contrato_m($NROCONTRATO,$Doc,$RazonSocial,$Direc,$NomRespon,$DocRespon,$Tipo,$Estado,$IdUsu,$RepCargo,$TipoDoc);
			$rs2=$obj->Update_UserContrato_m($IdUsu,$NROCONTRATO);
		}else{
			$rs= $obj->Update_contrato_m($NROCONTRATO,$Doc,$RazonSocial,$Direc,$NomRespon,$DocRespon,$Tipo,$Estado,$IdUsu,$RepCargo,$TipoDoc);
			$rs2=$obj->Update_UserContrato_m($IdUsu,$NROCONTRATO);
		}	
	}
	
	
	
	
	/*if( $CMD=="UPDATE"){
			$rs= $obj->Update_contrato_m($NROCONTRATO,$Doc,$RazonSocial,$Direc,$NomRespon,$DocRespon,$Tipo,$Estado,$IdUsu);
	}*/

 echo json_encode($rs);	
}else{
//Regresa al Login	
header ("location: ".VIRTUAL_ROOT."/login.php");
}

?>