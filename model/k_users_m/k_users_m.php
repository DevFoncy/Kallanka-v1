<?php
class User_model{
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
  
  function validar_usuario($user_email,$user_password){
  	$sqlUsu="select count(*) as cantidad from usuario where correo_uo='$user_email' and pass_uo='$user_password'";
	$rsp = pg_exec( $this->con,$sqlUsu);
	while($line = pg_fetch_assoc($rsp)){
		$cantidad=$line['cantidad'];
	}	
	if($cantidad==1) {
		$rp=1; /*1 Coincidencia de login*/
	}else{
		$rp=0; /*No hay coincidencia de login*/
	}
	return $rp;
   
  }
	    
  function registrar_huesped($user_email,$user_password,$user_name,$user_apellido){
     $sql="INSERT INTO usuario(correo_uo,pass_uo, nombre_uo, apepat_uo,rol_id_uo)
    	VALUES ('$user_email','$user_password','$user_name','$user_apellido',1)";
	 $res = pg_exec( $this->con,$sql);
	 $rp=count($res);
	 return $rp;
   }      


  function registrar_anfitrion($user_email,$user_password,$user_name,$user_apellido){
     $sql="INSERT INTO usuario(correo_uo,pass_uo, nombre_uo, apepat_uo,rol_id_uo)
    	VALUES ('$user_email','$user_password','$user_name','$user_apellido',2)";
	 $res = pg_exec( $this->con,$sql);
	 $rp=count($res);
	 return $rp;
   }      

   function getUser($user_email,$user_password){
   		$sqlUsu="select rol_id_uo as rol from usuario where correo_uo='$user_email' and pass_uo='$user_password'";
	    $res = pg_exec( $this->con,$sqlUsu);
		while($line = pg_fetch_assoc($res)){
			$rol=$line['rol'] ;
		}	
	    return $rol;
	}
  /*Lista de usuarios
  ::::::::::::::::::::::::::::::::::::::::::::::::*/
  function list_user_m($user_id,$opc) {
	$op=$opc;
	if($user_id==1 or $user_id==110){
	 $sql="SELECT  * FROM gpn_user  order by user_id desc ";
	}else{
 	$sql="SELECT  * FROM gpn_user where user_id_parent=$user_id";
  	}
	if($opc == '1'){
	 $sql= "SELECT  * FROM gpn_user where user_id =$user_id";
	}
	$ls_users=array(); 
    $res = pg_exec( $this->con,$sql);
	while($line = pg_fetch_assoc($res)){
		$ls_users[]=$line ;
	}	
			
      return $ls_users;
   }
  /*Filtro de usuario
  ::::::::::::::::::::::::::::::::::::::::::::::::*/
  function listFiltro_user_m($user_id,$user_name,$user_fulname,$opc) {
	 $user_name1=$user_name;
	 //$sql="SELECT  * FROM gpn_user where user_id_parent=$user_id  "; 
		 
     $sql="SELECT  * FROM gpn_user   "; 
	 $sqlAdd="";
	 if($opc==1){
	 	//$sqlAdd= "and user_name Ilike '%$user_name%' and  user_fulname like '%$user_fulname%'";
		$sqlAdd= "where user_name Ilike '%$user_name%' and  user_fulname like '%$user_fulname%'";
	 }elseif($opc==2){
	 	//$sqlAdd= "and user_name Ilike '%$user_name%'"; 
		$sqlAdd= "where user_name Ilike '%$user_name%'"; 
	 }elseif($opc==3){
		$sqlAdd= "where user_fulname Ilike '%$user_fulname%'";
		//$sqlAdd= "and user_fulname Ilike '%$user_fulname%'";
	 }elseif($opc==0){
		$sqlAdd= "where 1=0";
	}
	  $ls_users=array();
     $res = pg_exec( $this->con,$sql.$sqlAdd);
	 while($line = pg_fetch_assoc($res)){
		$ls_users[]=$line ;
	 }			
      return $ls_users;
   }
  /*Lista de tipos de ususarios
  ::::::::::::::::::::::::::::::::::::::::::::::::*/
  function list_userType_m() {
   $res = pg_exec( $this->con,"SELECT  * FROM gpn_typedevices;");
   while($line = pg_fetch_assoc($res)){
		$ls_typeU[]=$line ;
   }			
    return $ls_typeU;
   }
  /*Registrar usuarios
  ::::::::::::::::::::::::::::::::::::::::::::::::*/
  
  //$user_id,$User,$Passw,$ExtraPassw,$NameApe,$Email,$Dir,$Phone1,$Phone2,$Level,$Observacion,1,1,$vende_name,$user_doc,$user_contac,$user_contac_email,$user_contac_phone1,$user_contac_phone2,$user_namefactura,$CboVendedor
  function reg_usuario_m( 
  			$user_id_parent,
			$user_name,
			$user_password,
			$user_extrapass, 
			$user_fulname,
			$user_email,
			$user_address,
			$user_phone1,
			$user_phone2, 
			$user_level,
			$user_obs,
			$user_visit_count,
			$user_active,
			$vende_name,
			$user_doc,
			$user_contac,
			$user_contac_email,
			$user_contac_phone1,
			$user_contac_phone2,
			$user_namefactura,
			$CboVendedor,
			$user_email_fac
			,$user_cobranza_contac
			,$user_cobranza_email
			,$user_cobranza_phone1
			,$user_cobranza_phone2
			,$formapago)
			 
    {
    $ls_user_permit="";   
//$user_id,$User,$Passw,$ExtraPassw,$NameApe,$Email,$Dir,$Phone1,$Phone2,$Level,$Observacion,1,1,$vende_name,$user_doc,$user_contac,$user_contac_email,$user_contac_phone1,$user_contac_phone2,$user_namefactura,$CboVendedor
    $sql="
    INSERT INTO gpn_user(
            user_id_parent,
            user_name,
            user_password, 
			user_extrapass, 
            user_fulname, 
			user_email,  
			user_address,
			user_phone1, 
			user_phone2, 
            user_level,
			user_obs,
			user_visit_count, 
            user_active,
			user_sysdate,
			vende_name,
			user_doc,
			vendedor_id,
			user_email_fac,
			forma_pago)
    VALUES (
			 $user_id_parent,
            '$user_name',
            '$user_password', 
			'$user_extrapass', 
            '$user_fulname', 
			'$user_email', 
			'$user_address',
			'$user_phone1', 
			'$user_phone2', 
            $user_level,
			'$user_obs',
			$user_visit_count, 
            '$user_active',
			'".date("d/m/Y")."',
			'$vende_name',
			'$user_doc',
			'$CboVendedor',
			'$user_email_fac',
			'$formapago')";

    $Ls=array(); 
	$rp=0;
    $sqlUsu="select user_name from gpn_user where user_name='$user_name' ";
	$rsp = pg_exec( $this->con,$sqlUsu);
	while($line = pg_fetch_assoc($rsp)){
		$Ls[]=$line;
	}	
	if(count($Ls) ==0) {
	  	$res = pg_exec( $this->con,$sql);
		$rp=count($res);
	}else{
		$rp=2;
	}
	return $rp;
   }   
  


  /*Actualizar datos del Usuarios
  ::::::::::::::::::::::::::::::::::::::::::::::::*/
  function Update_usuario_m( 
   			$user_id,
			$user_name,
			$user_password,
			$user_extrapass, 
			$user_fulname,
			$user_address,
			$user_email,
			$user_phone1,
			$user_phone2, 
			$user_level,
			$user_obs,
			$user_visit_count,
			$user_active,
			$vende_name,
			$user_doc,
			$user_contac,
			$user_contac_email,
			$user_contac_phone1,
			$user_contac_phone2,
			$user_namefactura,
			$CboVendedor,
			$txtComercial,
			$txtContacMante,
			$txtContacManteEmail,
			$txtContacMantePhone1,
			$txtContacMantePhone2,
			$user_email_fac
			,$user_cobranza_contac
			,$user_cobranza_email
			,$user_cobranza_phone1
			,$user_cobranza_phone2
			,$formapago
			) 
    { 
	  $sql="UPDATE gpn_user
		SET 
			user_name='$user_name',
			user_password='$user_password',
			user_extrapass='$user_extrapass', 
	        user_fulname='$user_fulname',
			user_email='$user_email',
			user_address='$user_address', 
			user_phone1='$user_phone1', 
		    user_phone2='$user_phone2',
			user_level=$user_level, 
			user_obs='$user_obs',
		    user_visit_count=$user_visit_count, 
			user_active='$user_active',
			vende_name='$vende_name',
			user_doc='$user_doc',
			user_contac='$user_contac',
			user_contac_email='$user_contac_email',
			user_contac_phone1='$user_contac_phone1',
			user_contac_phone2='$user_contac_phone2',
			user_namefactura='$user_namefactura',
			vendedor_id='$CboVendedor',
			user_comer_contac='$txtComercial',
			user_mante_contac='$txtContacMante',
			user_mante_email='$txtContacManteEmail',
			user_mante_phone1='$txtContacMantePhone1',
			user_mante_phone2='$txtContacMantePhone2',
			user_email_fac='$user_email_fac'
			,user_cobranza_contac='$user_cobranza_contac'
			,user_cobranza_email='$user_cobranza_email'
			,user_cobranza_phone1='$user_cobranza_phone1'
			,user_cobranza_phone2='$user_cobranza_phone2'
			,forma_pago='$formapago'
			WHERE 
			user_id=$user_id;";
			//echo $sql;
		   $res = pg_exec( $this->con,$sql);
	 return count($res);
	}
  /*Activacion de usuario
  ::::::::::::::::::::::::::::::::::::::::::::::::*/
  function Activacion_usuario_m($user_id){
		$sql="UPDATE gpn_user
		SET  
			user_active='0'
		WHERE 
			user_id=$user_id;";
	   $res = pg_exec( $this->con,$sql);
	   return "grabo";	
	}
  /*Lista de dispositivo por usuario
  ::::::::::::::::::::::::::::::::::::::::::::::::*/
  function list_DevUser_m($user_id ,$device_name, $IDsFilter,$opt=0) {
	$sqladd="";
	if($device_name!="") {
		$sqladd=" and  b.device_name Ilike '%$device_name%'";
	}
	$sqladdFilter="";$sqladdFilter2=($opt?"":" AND device_id=''");
	if($IDsFilter!="") {
		$sqladdFilter=" OR d.device_id in ($IDsFilter)";
		$sqladdFilter2=" AND device_id in ($IDsFilter)";
	}
    $ls_UserDev =array();
 	$sql="
		select 
			  b.device_id,
			  b.device_name,
			  u.user_fulname,
			  c.typedevice_name,
			  (select count(1)
			  from 
					gpn_devices d
			  where 
					(
					d.device_id in (select device_id from gpn_user_devices where user_id=$user_id $sqladdFilter2)
					$sqladdFilter
					)
					and d.device_id=b.device_id limit 1) 
			  as checkdisp
		from 
			gpn_devices b inner join gpn_typedevices c 
			on b.device_type=c.typedevice_id
			left join gpn_user u 
			on b.user_id=u.user_id
		where 
			device_active='1'".$sqladd . " order by device_name asc  ";
	$res = pg_exec( $this->con,$sql);
	while($line = pg_fetch_assoc($res)){
		$ls_UserDev[]=$line ;
	}			
      return $ls_UserDev;
   }
  /*Lista de permiso de usuario
  ::::::::::::::::::::::::::::::::::::::::::::::::*/
  function list_PermisoUser_m($user_id) {
	$user_id=$user_id;
 	$sql="
		select 
			permits_id,
			permits_name,
			permits_type,
			(select count(1)
			from 
					gpn_user_permits up 
			 where 
					up.user_id=$user_id 
					and up.permits_id=gpn_permits.permits_id ) 
			as user_permits 
		from 
			gpn_permits 
			where  permits_active='1'
		order by permits_type desc, permits_name asc";
	$ls_Perm= array();
    $res = pg_exec( $this->con,$sql);
	while($line = pg_fetch_assoc($res)){
		$ls_Perm[]=$line ;
	}			
      return $ls_Perm;
   }
  /*Agregar o quitar Permiso de usuario
  ::::::::::::::::::::::::::::::::::::::::::::::::*/
    function AddDElUser_m($user_id,$permisos) {
	$sqlDEL="
		DELETE 
		FROM 
			gpn_user_permits
		WHERE
			 user_id=$user_id;";
	$sqlPERMISO="
		insert  into 
			gpn_user_permits 
			(user_id, permits_id) 
			select $user_id, 
			permits_id 
		from 
			gpn_permits 
		where 
			permits_id in($permisos)";
    $res = pg_exec( $this->con,$sqlDEL);
    $res1 = pg_exec( $this->con,$sqlPERMISO);
	return count($res1);
   }
  /*Agregar o quitar Dispositivo de usuario
  ::::::::::::::::::::::::::::::::::::::::::::::::*/
function AddDElDevicesUser_m($user_id,$devicesIDS ,$opc) {
$devicesIDS=explode(',',$devicesIDS);
$devicesIDS=implode("','",$devicesIDS);
if(strlen($devicesIDS)>0 && substr($devicesIDS,0,1)!="'") $devicesIDS="'".$devicesIDS."'";
$res;
$res1;
		$sqlDEL="
			DELETE 
			FROM 
				gpn_user_devices
			WHERE
				 user_id=$user_id";
	 $res = pg_exec( $this->con,$sqlDEL);
		$sqlDEVICES="
			insert  into 
				gpn_user_devices 
				(user_id, device_id) 
				select $user_id, 
				device_id 
			from 
				gpn_devices 
			where 
				device_id in($devicesIDS)";
		 if($devicesIDS !=""){
			 $res1 = pg_exec( $this->con,$sqlDEVICES);
		 }
	 return 1;
   }
   
	  function Activacion_Mora($user_id,$mora) {
	   $SQL="UPDATE gpn_user SET rep_mora='$mora' WHERE user_id='$user_id';";
		 $res = pg_exec( $this->con,$SQL);
	   	 return count($res);
	}

  /*Lista de DISPOSITIVO
   :::::::::::::::::::::::::::::::::::::::::::::::::::*/
	function list_contrato(){
		$rs_disp=array();
			$SQL="select cnt_numero, cnt_fac_rucdni, cnt_fac_nombre FROM contrato order by cnt_fac_nombre asc";
			$res = pg_exec( $this->con1,$SQL);
			while($line = pg_fetch_assoc($res)){
			   $rs_disp[] = $line;
			 }//gpn_gps_devices
			return $rs_disp;
		   
		}
		
		  /*Lista de VENDEDOR
   :::::::::::::::::::::::::::::::::::::::::::::::::::*/
	function list_vendedor(){
		$rs_vendedor=array();
			$SQL="select * from gpn_vendedor order by 2 desc";
			$res = pg_exec( $this->con,$SQL);
			while($line = pg_fetch_assoc($res)){
			   $rs_vendedor[] = $line;
			 }
			return $rs_vendedor;
		   
		}
		
	  /*Lista de Contrato
  ::::::::::::::::::::::::::::::::::::::::::::::::*/
  function list_contrato_m($user_id) {

	 $sql= "SELECT  * FROM contrato where user_id =$user_id";

	$ls_contrato=array(); 
    $res = pg_exec( $this->con1,$sql);
	while($line = pg_fetch_assoc($res)){
		$ls_contrato[]=$line ;
	}	
			
      return $ls_contrato;
   }	
   
   
   	  /*Lista de Contrato
  ::::::::::::::::::::::::::::::::::::::::::::::::*/
  function list_tipoPersona_m() {

	 $sql= "SELECT tab_tipo, tab_codigo, tab_nombre, tab_abrev FROM tabla where tab_tipo='CNTTIP'";

	$ls_tipocontrato=array(); 
    $res = pg_exec( $this->con1,$sql);
	while($line = pg_fetch_assoc($res)){
		$ls_tipocontrato[]=$line ;
	}	
			
      return $ls_tipocontrato;
   }	
   
     /*Registrar  Contrato
  :::::::::::::::::::::::::::::::::::::::::::::::*/
   function reg_contrato_m(
			$NroContrato,
			$Doc,
			$RazonSocial,
			$Direc,
			$NomRespon,
			$DocRespon,
			$Tipo,
			$Estado,
			$IdUsu,
			$RepCargo,
			$TipoDoc) 
			{
	  $sql="INSERT INTO contrato(
            cnt_numero, cnt_fac_rucdni, cnt_fac_nombre, cnt_fac_direc, cnt_rep_nombre, 
            cnt_rep_doc, cnt_tipo, cnt_estado, user_id, cnt_rep_cargo, cnt_rep_tipodoc)
    		VALUES ('$NroContrato', '$Doc', '$RazonSocial', '$Direc', '$NomRespon', 
            '$DocRespon', '$Tipo', '$Estado', '$IdUsu', '$RepCargo', '$TipoDoc');
			";
	//echo  $sql;
	$res = pg_exec( $this->con1,$sql);
  	$rp=count($res);
   return $rp;
   }
     /*Actualizar datos del Contrato
  ::::::::::::::::::::::::::::::::::::::::::::::::*/
  function Update_contrato_m( 
   			$NroContrato,
			$Doc,
			$RazonSocial,
			$Direc,
			$NomRespon,
			$DocRespon,
			$Tipo,
			$Estado,
			$IdUsu,$RepCargo,$TipoDoc
			) 
    { 
	  $sql="UPDATE contrato
   SET cnt_numero='$NroContrato', cnt_fac_rucdni='$Doc', cnt_fac_nombre='$RazonSocial', cnt_fac_direc='$Direc', 
       cnt_rep_nombre='$NomRespon', cnt_rep_doc='$DocRespon', cnt_tipo='$Tipo', cnt_estado='$Estado', cnt_rep_cargo='$RepCargo', cnt_rep_tipodoc='$TipoDoc'
 WHERE user_id='$IdUsu'; ";
			//echo $sql;
		   $res = pg_exec( $this->con1,$sql);
	 $rp=count($res);
		return $rp;
	}
	
	//UPdate en usuer el nro de contrato
	function Update_UserContrato_m( 
   			$IdUsu,
			$NroContrato
			) 
    { 
	  $sql="update gpn_user set cnt_numero='$NroContrato' where user_id='$IdUsu'; ";
			//echo $sql;
		   $res = pg_exec( $this->con,$sql);
	 $rp=count($res);
   return $rp;
	}
	
 // Busqueda de contacto para insertar o actualizar
 function list_busqcontrato_m($usuerid) {
	 $sql= "SELECT cnt_numero, cnt_fac_rucdni, cnt_fac_nombre, cnt_fac_direc, cnt_rep_nombre, 
       cnt_rep_doc, cnt_tipo, cnt_estado, user_id
 		 FROM contrato where user_id='$usuerid'";

	$ls_Excontrato=array(); 
    $res = pg_exec( $this->con1,$sql);
	while($line = pg_fetch_assoc($res)){
		$ls_Excontrato[]=$line ;
	}	
			
      return $ls_Excontrato;
   }
 
 
}
?>