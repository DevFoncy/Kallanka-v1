<?php
require_once('../../config.php');
include('../../model/k_users_m/k_users_m.php');
//require_once('../../assets/mailer/PHPMailer/PHPMailerAutoload.php');

require_once(SMARTY_DIR.'PHPMailer/'.'PHPMailerAutoload.php');

	$obj = new User_model();	
	$CMD=getParameter("CMD","");
	$user_email=getParameter("user","");
	$user_password=getParameter("contra","");
	$user_name=getParameter("nombre","");
	$user_apellido=getParameter("apellido","");
	$flag=0;
	
	if($CMD=="REGISTRAR_HUESPED"){
		$rs=$obj->registrar_huesped($user_email,$user_password,$user_name,$user_apellido);
		mandar_correo($user_name,$user_email,$user_password);
	}

	if($CMD=="REGISTRAR_ANFITRION"){
		$rs=$obj->registrar_anfitrion($user_email,$user_password,$user_name,$user_apellido);
		mandar_correo($user_name,$user_email,$user_password);
	}		
	if($CMD=="VALIDAR_USUARIO"){
		$rs=$obj->validar_usuario($user_email,$user_password);
		$flag=1;
		if($rs==1){/*Validado*/
			$rs=$obj->getUser($user_email,$user_password);
			echo $rs;/*Me trae que tipo de usuario es*/
		}
		else{		
			echo $rs;
		}
	}
    if($flag==0){
	 echo json_encode($rs);	
  }

  function mandar_correo($user_name,$user_email,$user_password){
	/*Configuraciones de correo*/
	$mail = new PHPMailer;
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'sistemas@gepesat.com';                 // SMTP username
$mail->Password = 'foncy12345';                             // SMTP password
$mail->Port= 587;
$mail->SMTPSecure = 'tls';  	



	$mail->setFrom('sistemas@gepesat.com', 'FAMILIA KALLANKA');
	$mail->addAddress($user_email,'Foncy');
	//ob_start();
	//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	//$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
	//$objWriter->save("php://output");
	//$data = ob_get_contents();
	//ob_end_clean();

	$mail->isHTML(true);                                  // Set email format to HTML
	$mail->Subject = 'Bienvenido a la familia KALLANKA';
	$mail->Body    = "Sus crendeciales son correo:".$user_email."Su contraseña es:".$user_password;

	if(!$mail->send()) {
	    echo 'Ocurrio un problema , intente de nuevo';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	    //var_dump($correo); 
	} else {
	    echo 'Reportes enviado con exito';
	}

  }
?>