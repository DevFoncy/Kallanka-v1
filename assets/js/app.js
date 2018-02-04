
function validar_correo(valor)
{
    var valor;var flag=0;
    var lista_correos = valor.split(",");
    var reg=/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i;
    
    for(var i=0;i<lista_correos.length;i++){
    //  console.log(lista_correos[i]);
      if(!reg.test(lista_correos[i])) 
        flag=1; //email incorrecto
    }
   // console.log(flag);
    if(flag==1)
        return false;
    else 
        return true;
}



function chat(){
	$('#mCalificar').modal('show');
				
}

function calificar(){
	swal({
                title: "Productor Calificado",
                type: "success",
                confirmButtonText: "Listo"
                    });

}

function abrir(id){
	switch(id){
		case 1: $('#mRegistrar').modal('show');
				break;
		case 2: 
				$('#mCrearCuenta').modal('show'); 
				$('#mRegistrar').modal('toggle');
				break;
		case 3://Comprador
				$('#mComprador').modal('show');
				break;
		case 4://Vendedor
				$('#mProductor').modal('show');
				break;
		
	}
}


function crear_cuenta_huesped(){
	var consuNombre=$("#consuNombre").val();
	var consuApellido=$("#consuApellido").val();
	var consuMail=$("#consuMail").val();
	var consuContra=$("#consuContra").val();
	var consuRepetirContra=$("#consuRepetirContra").val();
//	var dni='71395320';
	/*var tecactusApi = new TecactusApi("Hz9AiINd0lU48sWnvYsMIdVXLFHxfjugPLVJKILF")
    tecactusApi.Reniec.getDni(dni)
        .then(function (response) {
            console.log("consulta correcta!")
            console.log(response.data)
        })
        .catch(function (response) {
            console.log("algo ocurrió")
            console.log("código de error: " + response.code)
            console.log("mensaje de respuesta: " + response.status)
            console.log(response.data)
        })
*/

	if(consuNombre==''|| consuApellido==''||consuMail==''||consuContra==''|| consuRepetirContra==''){
         
         swal({
                title: "Faltan datos!",
                text: "No has completado todos los campos !",
                type: "warning",
                confirmButtonText: "Completar los campos"
                    });
	}
	else{
		if(consuContra!=consuRepetirContra){
			swal({
                title: "Campos no iguales!",
                text: "El campo de contraseña debe ser igual a repetir contraseña",
                type: "info",
                confirmButtonText: "Volver a intentarlo"
                    });

		}	
		else{
			if(validar_correo(consuMail)){
			  swal({
			  title: 'Los siguientes datos son los correctos ?',
			  text: "Informacion Ingresada:",
			  type: 'info',
			  html: '<h6><b >Nombres y Apellidos:</b> ' + consuNombre+' '+consuApellido+'</h6>'+
			   '<h6><b>Correo: </b> ' +consuMail+ '</h6>'+
			   '<h6><b>Contraseña: </b> ' + consuContra+'</h6>',
  			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Si, crear cuenta!',
			  cancelButtonText: 'Necesito corregir'
				}).then(function () {
				  
				  var sss="CMD=REGISTRAR_HUESPED&user="+consuMail+"&contra="+consuContra+"&nombre="+consuNombre+"&apellido="+consuApellido;
				  console.log(sss);
				  $.ajax({
					   type: "POST",
					   url: "controller/k_users_c/fn_users2.php",
					   data: sss,
					   dataType: "json",
					   complete: function(data){
						console.log(data);
					   },
					   error: function(xhr, status){	
					   	console.log(status);
					   }
				   });
				  swal({
				  title: 'Estamos creando tu cuenta Sr. Huesped',
				  html: ' <div class="progress"><div class="progress progress-striped active"><div id="1" class="progress-bar" style="width: 100%;background-color: #46b8da" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"><label style="text-align: center;color: black;font-weight: 100;font-size: 15px;"><strong>Paso 3</strong> Ingresa a la plataforma con tus datos</label></div></div></div>',
				  timer: 5000,
				  onOpen: function () {
				    swal.showLoading()
				  }
				}).then(
				  function () {

				  },
				  // handling the promise rejection
				  function (dismiss) {
				    if (dismiss === 'timer') {
				      	 $('#mComprador').modal('toggle');
				    	 $('#mCrearCuenta').modal('toggle');
				    	 $('#mRegistrar').modal('show');
				         //$('#myModal').modal('toggle');
				         //$('#myModal3').modal('show');
				    }
				  }
				)
			});
			}/*Final de if de validar correo*/
			else{
				swal({
                title: "Correo no valido!",
                text: "El correo debe ser gmail, outlook, etc",
                type: "warning",
                confirmButtonText: "Volver a intentarlo"
                });

			}/*Final del mensaje de si el correo no es valido*/
			
		}/*Final del else si las contras no son iguales*/
	}/*final del else si los datos son correctos*/
}


function crear_cuenta_anfitrion(){
	var consuNombre=$("#produNombre").val();
	var consuApellido=$("#produApellido").val();
	var consuMail=$("#produMail").val();
	var consuContra=$("#produContra").val();
	var consuRepetirContra=$("#produRepetirContra").val();
	
	if(consuNombre==''|| consuApellido==''||consuMail==''||consuContra==''|| consuRepetirContra==''){
         
         swal({
                title: "Faltan datos!",
                text: "No has completado todos los campos !",
                type: "warning",
                confirmButtonText: "Completar los campos"
                    });
	}
	else{
		if(consuContra!=consuRepetirContra){
			swal({
                title: "Campos no iguales!",
                text: "El campo de contraseña debe ser igual a repetir contraseña",
                type: "info",
                confirmButtonText: "Volver a intentarlo"
                    });

		}	
		else{
			if(validar_correo(consuMail)){
				swal({
			  title: 'Los siguientes datos son los correctos ?',
			  text: "Informacion Ingresada:",
			  type: 'info',
			  html: '<h6><b >Nombres y Apellidos:</b> ' + consuNombre+' '+consuApellido+'</h6>'+
			   '<h6><b>Correo: </b> ' +consuMail+ '</h6>'+
			   '<h6><b>Contraseña: </b> ' + consuContra+'</h6>',
  			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Si, crear cuenta!',
			  cancelButtonText: 'Necesito corregir'
				}).then(function () {
  				  var sss="CMD=REGISTRAR_ANFITRION&user="+consuMail+"&contra="+consuContra+"&nombre="+consuNombre+"&apellido="+consuApellido;
				  console.log(sss);
				  $.ajax({
					   type: "POST",
					   url: "controller/k_users_c/fn_users2.php",
					   data: sss,
					   dataType: "json",
					   success: function(data){
						console.log(data);
					   },
					   error: function(xhr, status){	
					   	console.log(status);
					   }
				   });

				  swal({
				  title: 'Estamos creando tu cuenta Sr Anfitrion...',
				  html: ' <div class="progress"><div class="progress progress-striped active"><div id="1" class="progress-bar" style="width: 100%;background-color: #46b8da" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"><label style="text-align: center;color: black;font-weight: 100;font-size: 15px;"><strong>Paso 3</strong> Ingresa a la plataforma con tus datos</label></div></div></div>',
				  timer: 5000,
				  onOpen: function () {
				    swal.showLoading()
				  }
				}).then(
				  function () {},
				  // handling the promise rejection
				  function (dismiss) {
				    if (dismiss === 'timer') {
				      	console.log('I was closed by the timer')
				    	 $('#mProductor').modal('toggle');
				    	 $('#mCrearCuenta').modal('toggle');
				    	 $('#mRegistrar').modal('show');
				         //$('#myModal').modal('toggle');
				         //$('#myModal3').modal('show');
				    }
				  }
				)
			});
			}
			else{
				swal({
                title: "Correo no valido!",
                text: "El correo debe ser gmail, outlook, etc",
                type: "warning",
                confirmButtonText: "Volver a intentarlo"
                });
			}
			
		}
	}
	//alert(consuNombre+consuApellido+consuMail+consuContra);

}

function validar_datos(){
	var consuNombre=$("#consuNombre").val();
	if(consuNombre!=''){
		document.getElementById("consuNombre2").style.backgroundColor='#00c0ef';			
	}
	else{
		document.getElementById("consuNombre2").style.backgroundColor='red';			
		
	}
}

function cambiar_estado(id){
	switch(id){
		case 1: document.getElementById("consuNombre").style.backgroundColor='rgb(240, 227, 113)';	break;
		case 2:	document.getElementById("consuApellido").style.backgroundColor='rgb(240, 227, 113)';	break;
		case 3:	document.getElementById("consuMail").style.backgroundColor='rgb(240, 227, 113)';	break;
		case 4:	
		  document.getElementById("consuContra").style.backgroundColor='rgb(240, 227, 113)';
		  var contra=document.getElementById("consuContra").value;
		  if(contra.length<8){
		  		$('#iconBad2').show();
				$('#btnRegistrar').attr("opacity", 0.2); 
				document.getElementById("btnRegistrar").disabled=true;
				document.getElementById("consuContra").style.backgroundColor='white';
				$('#lblrptContra2').show();
				document.getElementById("consuRepetirContra").disabled=true;
			
		  }
		  	else{
		  		$('#lblrptContra2').hide();
				$('#iconBad2').hide();
				document.getElementById("btnRegistrar").disabled=false;
				document.getElementById("consuRepetirContra").disabled=false;	
				document.getElementById("consuContra").style.backgroundColor='rgb(240, 227, 113)';	
		  	}
		  	break;

		case 5://Validacion de la contraseña
		  var contra=document.getElementById("consuContra").value;
		  var contra_ver=document.getElementById("consuRepetirContra").value;
		  if(contra!=contra_ver){
				$('#iconBad').show();
				$('#btnRegistrar').attr("opacity", 0.2); 
				document.getElementById("btnRegistrar").disabled=true;
				document.getElementById("consuRepetirContra").style.backgroundColor='white';
				$('#lblrptContra').show();
			} 	
		  else{
		  		$('#lblrptContra').hide();
				$('#iconBad').hide();
				document.getElementById("btnRegistrar").disabled=false;
				document.getElementById("consuRepetirContra").style.backgroundColor='rgb(240, 227, 113)';
			}
		break;
	}
}


function cambiar_estado_p(id){
	switch(id){
		case 1: document.getElementById("produNombre").style.backgroundColor='rgb(240, 227, 113)';	break;
		case 2:	document.getElementById("produApellido").style.backgroundColor='rgb(240, 227, 113)';	break;
		case 3:	document.getElementById("produMail").style.backgroundColor='rgb(240, 227, 113)';	break;
		case 4:	
		  document.getElementById("produContra").style.backgroundColor='rgb(240, 227, 113)';
		  var contra=document.getElementById("produContra").value;
		  if(contra.length<8){
		  		$('#iconBad2').show();
				$('#btnRegistrar_p').attr("opacity", 0.2); 
				document.getElementById("btnRegistrar_p").disabled=true;
				document.getElementById("produContra").style.backgroundColor='white';
				$('#lblrptContra2_p').show();
				document.getElementById("produRepetirContra").disabled=true;
			
		  }
		  	else{
		  		$('#lblrptContra2_p').hide();
				$('#iconBad2_p').hide();
				document.getElementById("btnRegistrar_p").disabled=false;
				document.getElementById("produRepetirContra").disabled=false;	
				document.getElementById("produContra").style.backgroundColor='rgb(240, 227, 113)';	
		  	}
		  	break;

		case 5://Validacion de la contraseña
		  var contra=document.getElementById("produContra").value;
		  var contra_ver=document.getElementById("produRepetirContra").value;
		  if(contra!=contra_ver){
				$('#iconBad_p').show();
				$('#btnRegistrar_p').attr("opacity", 0.2); 
				document.getElementById("btnRegistrar_p").disabled=true;
				document.getElementById("produRepetirContra").style.backgroundColor='white';
				$('#lblrptContra_p').show();
			} 	
		  else{
		  		$('#lblrptContra_p').hide();
				$('#iconBad_p').hide();
				document.getElementById("btnRegistrar_p").disabled=false;
				document.getElementById("produRepetirContra").style.backgroundColor='rgb(240, 227, 113)';
			}
		break;
	}
}





function prueba(s) {
  return document.querySelector(s)
}

function mostrar_contra(){

// The main instance which most tooltips are created by
var instance = 
  tippy('.tippy', {
      position: 'top',
      animation: 'fade',
      arrow: true,
      popperOptions: {
        modifiers: {
          flip: {
            behavior: ['right', 'bottom']
          }
        }
      }
    })

// Show the animated tippy on load
instance.show(instance.getPopperElement(prueba('#animated-tippy')))

}

$(document).ready(function() {
	var flag=0; //Oculto 
	var flag2=0;
/*		$('#next').click(function(){
			console.log(listener1);
			google.maps.event.removeListener(listener1);
			console.log(listener1);
			var listener2=google.maps.event.addDomListener(window, 'load', initialize_map(2));
		});*/
		$('#btnChat').click(function(){
							if(flag==0){ //Muestro 
								$('.scrollup3').slideDown();
								$('#iChat').attr('class','fa fa-times');
								$('.scrollup2').css("background-color",'#ea6464');
								flag=1;		
							}
							else{
								$('.scrollup3').slideUp();
								$('#iChat').attr('class','fa fa-phone');
								$('.scrollup2').css("background-color",'#2f93c0');
								flag=0;
							}

		});
		$('.btn-agregar').click(function(){
		//	console.log("prueba");
			var cantidad=parseInt($('#cantAcumulada').val())+parseInt('1');
			var cantidadTotal=parseInt($('#cantTotal').val())+parseFloat('1.56');
			//console.log(cantidadTotal);
			$('#cantAcumulada').val(cantidad);
			$('#cantTotal').val(cantidadTotal);
		});

		$('#btnCrearForo').click(function(){
			console.log('estamos dentro');
			$('#mForo').modal('toggle');
		});
		$('.btn-eliminar').click(function(){
		//	console.log("prueba");
			var cantidad=parseInt($('#cantAcumulada').val())-parseInt('1');
			var cantidadTotal=parseInt($('#cantTotal').val())-parseFloat('1.56');
			$('#cantAcumulada').val(cantidad);
			$('#cantTotal').val(cantidadTotal);
		});
		$('#btnSearch').click(function(){
		});

		$('#chat_1').click(function(){
			console.log("Estamos dentro");
			$('#mForoChat').modal('toggle');
			
		});

		$('#imgAnfitrion').click(function(){
			$('#mProductor').modal('show');

		});

		$('#btnIngresar').click(function(){
			var flag_user=0;
			var flag_pass=0;
			var user=$("#usuario_user").val();
			var contra=$("#pass_user").val();
			
			if(user=='' || contra==''){
				$('#lblLoginUser').show();	
				$('#lblLoginPass').show();
			
			}
			else{
				$('#lblLoginUser').hide();
				$('#lblLoginPass').hide();
     			var sss="CMD=VALIDAR_USUARIO&user="+user+"&contra="+contra;
				  $.ajax({
					   type: "POST",
					   url: "controller/k_users_c/fn_users2.php",
					   data: sss,
					   dataType: "json",
					   success: function(php_script_response){
						var flag_login=php_script_response;
						
						if(flag_login==0){
							swal({
			                title: "Datos no validos!",
			                text: "Su usuario o contraseña no son los correctos",
			                type: "warning",
			                confirmButtonText: "Volver a intentarlo"
			                 });	
						}
						else{
							if(flag_login==1){
								console.log("soy huesped");
							}
							else{
								if(flag_login==2){
									$(location).attr('href','http://190.102.155.166/view/KALLANKA/ANFI/index2.html');
					
								}
							}
						}
					   },
					   error: function(xhr, status){	
					   	console.log(status);
					   }
				   });


				/*if(user=='prueba@gmail.com' && contra=='12345678'){
						console.log("Ingreso");
						$(location).attr('href','http://localhost/Dely-Qatu_v2/index2.html');
					}
					else{
						swal({
		                title: "Datos no validos!",
		                text: "Su usuario o contraseña no son los correctos",
		                type: "warning",
		                confirmButtonText: "Volver a intentarlo"
		                 });
					
					}*/
				
			}

		});

		$('#btnAgregarCarrito').click(function(){
			var cantidad=parseInt($('#lblCarrito').val())+parseInt('1');
			$('#lblCarrito').val(cantidad);
			$('#spanCarrito').css("background-color",'yellow');
			$('#lblCarrito').css("background-color",'yellow');
								
			swal({
                title: "Tu reserva te esta esperando",
                type: "success",
                confirmButtonText: "Aceptar"
                 }).then(function (result) {
					  if (result.value) {
					    console.log("exito");
					  } 
					});
		});
		$('#imgAventura').mouseover(function(){	
			$('#optAventura').slideDown();						
		});
				 			/*$("#exp1").click(function(){
			 				console.log("clic");
					        $("#exp1").attr("href", "#experiencia");
					    });*/
});
//Google Map
//	var marker=[];
//	var flag_maps=0;//Oculto
//	var flag_zoom=0;
	//var latitud_1=parseFloat(geoplugin_latitude());
  	//var longitud_1=parseFloat(geoplugin_longitude());
  	    
/*	function initialize_map(id) {
		//console.log(latitud_1,longitud_1);
		var myLatlng = new google.maps.LatLng(-12.053265,-77.085504);
		var mapOptions = {
			zoom: 15,
			scrollwheel: false,
			center: myLatlng, 
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			zoomControl: true,
          	zoomControlOptions: {
              position: google.maps.ControlPosition.LEFT_TOP
          }
		};
		var imagen_verdura = {
          url: 'assets/images_DIU/google_maps/verduras.png',
	    };
	    var imagen_fruta={
	     url: 'assets/images_DIU/google_maps/banana2.png',	
	    } 
		var imagen_user = {
          url: 'assets/images_DIU/google_maps/icon2.png',
          // This marker is 20 pixels wide by 32 pixels high.
          size: new google.maps.Size(35, 45),
          //anchor: new google.maps.Point(0, 32)
        };

/*        var imagen_tuberculos={
        	url:'assets/images_DIU/google_maps/tuberculo.png',
        };

        var imagen_artesanales={
        	url:'assets/images_DIU/google_maps/artesanales.png',
        };

        var imagen_verduras={
        	url:'assets/images_DIU/google_maps/verduras_2.png',
        };


        var imagen_frutas={
        	url:'assets/images_DIU/google_maps/frutas.png',
        };

		var map = new google.maps.Map(document.getElementById('google-map'), mapOptions);
			marker[0] = new google.maps.Marker({ //Posicion actual
				map: map,
				icon:imagen_user,
				draggable: true,
		        animation: google.maps.Animation.DROP,
				position: {lat: -12.053265 , lng: -77.085504}		        
			});
			marker[0].addListener('click', function() {
	          if(flag_maps==0){
				 map.setZoom(17);
	        	 map.setCenter(marker[0].getPosition());
				 flag_maps=1;
			}
			else{
				if(flag_maps==1){
					map.setZoom(15);
	        	 	map.setCenter(marker[0].getPosition());
					flag_maps=0;		
				}
			}
	        });
		
			marker[1] = new google.maps.Marker({
			icon: imagen_fruta,
			map: map,
			draggable: false,
	        animation: google.maps.Animation.DROP,
			position: {lat: -12.055007, lng: -77.086346}		        
		});
		//marker[1].addListener('click', toggleBounce);

		/*google.maps.event.addListener(marker[1],'mouseout', function() {
			infowindow.close(map,marker[1]);
		});

		marker[2] = new google.maps.Marker({
			icon:imagen_verdura,
			map: map,
			draggable: false,
	        animation: google.maps.Animation.DROP,
			position: {lat: -12.056644, lng: -77.08103}		        
		});
		
		
		marker[3] = new google.maps.Marker({
			icon: imagen_artesanales,
			map: map,
			draggable: false,
	        animation: google.maps.Animation.DROP,
			position: {lat: -12.0540731, lng: -77.09502339}		        
		});
		marker[4] = new google.maps.Marker({
			icon: imagen_frutas,
			map: map,
			draggable: false,
	        animation: google.maps.Animation.DROP,
			position: {lat: -12.058081, lng: -77.089316}		        
		});
		marker[5] = new google.maps.Marker({
			icon: imagen_verduras,
			map: map,
			draggable: false,
	        animation: google.maps.Animation.DROP,
			position: {lat: -12.05210055, lng: -77.08697677}		        
		});
		marker[6] = new google.maps.Marker({
			icon: imagen_tuberculos,
			map: map,
			draggable: false,
	        animation: google.maps.Animation.DROP,
			position: {lat: -12.05386326, lng: -77.0785439}		        
		});

		//marker[2].addListener('mouseout', toggleBounce);
/*
		google.maps.event.addListener(marker[2],'click', function() {
			infowindow.open(map,marker[2]);
		});
		
		
	
		var contentString = '';
		var infowindow = new google.maps.InfoWindow({
			content: $('#cFruta').html()
		});

		google.maps.event.addListener(marker[4],'click', function() {
			if(flag_maps==0){
				infowindow.open(map,marker[4]);
				flag_maps=1;
			}
			else{
				if(flag_maps==1){
					infowindow.close(map,marker[4]);
					flag_maps=0;		
				}
			}
		});

}
/*function toggleBounce() {
	//console.log(numero);
	        if (marker[1].getAnimation() !== null) {
	          marker[1].setAnimation(null);
	        } else {
	          marker[1].setAnimation(google.maps.Animation.BOUNCE);
	        }
		
}*/

//var listener1=google.maps.event.addDomListener(window, 'load', initialize_map(1));/*Inicializar el mapa*/

