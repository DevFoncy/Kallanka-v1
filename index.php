<?php include 'view/modals/modal.php';?>
<?php //include 'view/carousel/carousel.php' ?>
<?php 
      $latitud=array();
      $longitud=array();
      foreach ($ListPois as $pois) {
                array_push($latitud,$pois["latitud"]);
                array_push($longitud,$pois["longitud"]);
      }
      //var_dump($latitud);
      $acu="";
      $acu2="";
      for($i=0;$i<count($latitud);$i++){
        if($i<count($latitud)-1){
            $acu.=$latitud[$i].",";
            $acu2.=$longitud[$i].",";
          }
        else{
         $acu.=$latitud[$i];
         $acu2.=$longitud[$i];
        }
      }
 ?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>KALLANKA</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <!--        <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css">-->

        <!--For Plugins external css-->
        <link rel="stylesheet" href="assets/css/animate/animate.css" />
        <link rel="stylesheet" href="assets/css/plugins.css" />

        <!--Theme custom css -->
        <link rel="stylesheet" href="assets/css/style.css">

        <!--Theme Responsive css-->
        <link rel="stylesheet" href="assets/css/responsive.css" />
        <link rel="stylesheet" type="text/css" href="assets/libraries/sweet_alert/sweetalert.css">
        
        <!--AdminLTE-->       
        <link rel="stylesheet" type="text/css" href="assets/css/AdminLTE.css">
        
        <!--Jquery-->
        <script src="assets/js/vendor/jquery-1.11.2.min.js"></script>
        <!--Modrnize-->
        <script src="assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>

        <!--Google Maps-->
        <script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-26cz6dtWwDt_uG0NRrI1FKNFMJuPFag">
        </script>

        <script src="distancia.js"></script>
                <!--Libreria de Calendario/hora-->

        <link rel="stylesheet" href="assets/libraries/pickadate/lib/themes/default.css">
        <link rel="stylesheet" href="assets/libraries/pickadate/lib/themes/default.date.css">
        <link rel="stylesheet" href="assets/libraries/pickadate/lib/themes/default.time.css">

         <script src="assets/libraries/pickadate/lib/picker.js"></script>
         <script src="assets/libraries/pickadate/lib/picker.date.js"></script>
         <script src="assets/libraries/pickadate/lib/picker.time.js"></script>

         <!--Reniec-->
<!--         <script src="https://tecactus-4b42.kxcdn.com/reniec-sunat-js.min.js"></script>-->

        <script>
        /*validacion.......................................*/
          $(document).ready(function(){

          
          $("#fecha1,#fecha2").pickadate({
              //Configurar nombre de dias
              weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mier', 'Jue', 'Vier', 'Sab'],
                showMonthsShort: true,
                  format: 'dd-mm-yyyy',
                  formatSubmit: 'yyyy-mm-dd',
                  hiddenName: true,

                  //Etiqueta de botones
                   today: '',
                   clear: '',
                   close: 'Cerrar',

               //Selecionar mes y año
                 //Limitar fecha
                 //max: new Date()

                 // Strings and translations
          monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Setiembre', 'Octubre', 'Noviembre', 'Diciembre'],
          monthsShort: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Setiembre', 'Octubre', 'Noviembre', 'Diciembre'],
              });
        });
      </script>
        <script>

          var map=null;
          var marker2=[]; 
          var flag_maps=0;//Oculto
          var sss='';
          var directionDisplay;
          var directionsService = new google.maps.DirectionsService();
          var directionsVisible = false;

          function initialize(latitud,longitud) {
          //  directionsDisplay = new google.maps.DirectionsRenderer();
            var lat_1=latitud;
            var lon_1=longitud;
          $("#origen").on('change keyup paste',function(){ 
            if($("#origen").val()!='' && $("#destino").val()!=''){

              $("#calcruta").css("background-color", "#C5FE80");
              $("#calcruta").prop('disabled',false);

            }else{
              $("#calcruta").prop('disabled',true);    
            }
          });
          $("#destino").on('change keyup paste',function(){ 
            if($("#origen").val() && $("#destino").val()){

              $("#calcruta").css("background-color", "#C5FE80");
              $("#calcruta").prop('disabled',false);


            }else{
              $("#calcruta").prop('disabled',true);   
            }
          });

             directionsDisplay = new google.maps.DirectionsRenderer({
              draggable: true
          //    map: map
          //    panel: document.getElementById('directionsPanel')
            });   


            var myLatlng = new google.maps.LatLng(-12.053265,-77.085504); /*Por Defecto San Marquitos*/
            var myOptions = {
              scrollwheel: false,
              zoom: 15,
              center: myLatlng,
              mapTypeId: google.maps.MapTypeId.ROADMAP,
              zoomControl: true,
              zoomControlOptions: {
                        position: google.maps.ControlPosition.LEFT_TOP
                }
            }


            map = new google.maps.Map(document.getElementById("div_mapas"), myOptions);
            directionsDisplay.setMap(map);
            directionsDisplay.setPanel(document.getElementById("directionsPanel"));
            directionsDisplay.addListener('directions_changed', function() {
                  computeTotalDistance(directionsDisplay.getDirections());
            });  
            var DistaControlDiv = document.getElementById('divDistancia');
            DistaControlDiv.index = 1;
            map.controls[google.maps.ControlPosition.TOP_RIGHT].push(DistaControlDiv);
            
            var imagen_user = {
                    url: 'assets/images/google_maps/user.png',
                   
                  };
            var imagen_romantico = {
                    url: 'assets/images/google_maps/precios/romantico1.png',
                   
                  };
            var imagen_costumbre = {
                    url: 'assets/images/google_maps/precios/costumbrista1.png',
                   
                  };
            var imagen_deportiva = {
                    url: 'assets/images/google_maps/precios/deportiva1.png',
                   
                  };

            var imagen_aventura = {
                    url: 'assets/images/google_maps/precios/aventura1.png',
                   
                  };

              marker2[0] = new google.maps.Marker({ //Posicion actual
              map: map,
              icon:imagen_user,
              draggable: true,
              animation: google.maps.Animation.DROP,
              position: {lat: -12.053265 , lng: -77.085504}           
                });
              /*Hacerle un zoom al marcador principal*/
              marker2[0].addListener('click', function() {
                if(flag_maps==0){
                  map.setZoom(17);
                  map.setCenter(marker2[0].getPosition());
                  flag_maps=1;
                  }
                else{
                 if(flag_maps==1){
                  map.setZoom(15);
                          map.setCenter(marker2[0].getPosition());
                      flag_maps=0;    
                    }
                  }
                });
              marker2[1] = new google.maps.Marker({
                icon: imagen_romantico,
                map: map,
                draggable: false,/*Permite mover el icono*/
                    animation: google.maps.Animation.DROP,
                position: {lat: lat_1[2], lng: lon_1[2]}            
              });
              //marker[1].addListener('click', toggleBounce);

              /*google.maps.event.addListener(marker[1],'mouseout', function() {
                infowindow.close(map,marker[1]);
              });*/

              /*Marcado del productor mas cercano , Residencia*/
              marker2[2] = new google.maps.Marker({
                icon:imagen_costumbre,
                map: map,
                draggable: false,/*Permite mover el icono*/
                    animation: google.maps.Animation.DROP,
                position: {lat: lat_1[3], lng: lon_1[3]}           
              });
              
              
              marker2[3] = new google.maps.Marker({
                icon: imagen_deportiva,
                map: map,
                draggable: false,/*Permite mover el icono*/
                    animation: google.maps.Animation.DROP,
                position: {lat: lat_1[4], lng: lon_1[4]}           
              });
              marker2[4] = new google.maps.Marker({
                icon: imagen_aventura,
                map: map,
                draggable: false,/*Permite mover el icono*/
                    animation: google.maps.Animation.DROP,
                position: {lat: lat_1[5], lng: lon_1[5]}            
              });
              marker2[5] = new google.maps.Marker({
                icon: imagen_aventura,
                map: map,
                draggable: false,/*Permite mover el icono*/
                    animation: google.maps.Animation.DROP,
                position: {lat: lat_1[6], lng: lon_1[6]}            
              });
              marker2[6] = new google.maps.Marker({
                icon: imagen_romantico,
                map: map,
                draggable: false,/*Permite mover el icono*/
                    animation: google.maps.Animation.DROP,
                position: {lat: lat_1[7], lng: lon_1[7]}           
              });

              var contentString = '';
              var infowindow = new google.maps.InfoWindow({
                content: $('#cExperiencia_2').html()
              });

              google.maps.event.addListener(marker2[1],'click', function() {
                infowindow.open(map,marker2[1]);
              });
          }

          function showLsOpt4(){
          document.getElementById('LsOpt4').style.display='block';
          }
          function hideLsOpt4(){
          document.getElementById('LsOpt4').style.display='none';
          }

          $(document).ready(function() {
            /*Cuando el boton de crear rutas fue presionado*/
            $("#Puntos").on("click",function(){
              $("#Coordenadas").css("background-color", "white");
                $("#Puntos").css("background-color", "yellow");
                $("#Mensaje1").prop('hidden',false);
                $("#Mensaje2").prop('hidden',true);
                $("#calcruta2").prop('hidden',true);
                $("#calcruta").prop('hidden',false);
              });

            $("#Coordenadas").on("click",function(){
                $("#Coordenadas").css("background-color", "yellow");
                $("#Puntos").css("background-color", "white");
                $("#Mensaje1").prop('hidden',true);
                $("#Mensaje2").prop('hidden',false);
                $("#calcruta2").prop('hidden',false);
                $("#calcruta").prop('hidden',true);

              });


          });
          </script>
    </head>
    <body onLoad="initialize([<?php echo $acu; ?>],[<?php echo $acu2; ?>])">
      <!--[-12.053265,-12.055007,-12.056644,-12.0540731,-12.058081,-12.05210055,-12.05386326],[-77.085504,-77.086346,-77.08103,-77.09502339,-77.089316,-77.08697677,-77.078543]-->
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
		<div class='preloader'><div class='loaded'>&nbsp;</div></div>
        <header id="home" class="navbar-fixed-top">
            <div class="header_top_menu clearfix">	
                <div class="container">
                    <div class="row">	
                        <div class="col-md-5 col-md-offset-3 col-sm-12 text-right">
                            <div class="call_us_text">
								<a href=""><i class="fa fa-clock-o"></i> Estadia Vivencial 24/7</a>
								<a href=""><i class="fa fa-phone"></i>947826902</a>
							</div>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <div class="head_top_social text-right">
                                <a href=""><i class="fa fa-facebook"></i></a>
                                <a href=""><i class="fa fa-google-plus"></i></a>
                                <a href=""><i class="fa fa-twitter"></i></a>
                                <a href=""><i class="fa fa-youtube"></i></a>
                                <a href=""><i class="fa fa-camera"></i></a>
                            </div>	
                        </div>

                    </div>			
                </div>
            </div>

            <!-- End navbar-collapse-->

            <div class="main_menu_bg">
                <div class="container"> 
                    <div class="row">
                        <nav class="navbar navbar-default">
                            <div class="container-fluid">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                    <a class="navbar-brand our_logo" href="#"><img src="assets/images/logo/logo.png"/></a>
                                    <div style="margin-top: 10px">
                                    <a class="header_a" style="color:white;font-size: 17px;margin-left: 145px;margin-top: 30px"  href="#slider">Inicio</a>
                                    <a class="header_a" style="color:white;font-size: 17px;margin-left: 25px;margin-top: 30px"  href="#slider">Experiencias</a>
                                    <a class="header_a" style="color:white;font-size: 17px;margin-left: 25px;margin-top: 30px"  href="#features">Actividades</a>
                                    <a class="header_a" style="color:white;font-size: 17px;margin-left: 25px;margin-top: 30px"  href="#foro">Foro</a>
                                    </div>
                                
                                </div>

                                <!-- Collect the nav links, forms, and other content for toggling -->
                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                                    <ul class="nav navbar-nav navbar-right">
                                        <li><a href="#portfolio""> <i style="font-size: 24px"  class="fa fa-street-view fa-2x" ></i><span class="label  mensaje1">10</span>
                                    </a></li>
                                        <!--<li><a href="#ourPakeg">News</a></li>-->
                                        <!--<li><a href="#mobaileapps" > <i style="font-size: 24px" class="fa fa-shopping-cart" aria-hidden="true" style="font-size: 22px"></i><span id="spanCarrito" class="label  mensaje2">0</span></a></li> -->
                                        
                                        <li class="dropdown messages-menu">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                              <i style="font-size: 24px;color:white" class="fa fa-bell-o" ></i>
                                              <span class="label mensaje3">4</span>
                                            </a>
                                            <ul class="dropdown-menu">
                                              <li class="header" style="background-color: #75b6ea;font-weight: bold;text-align: center">Tienes 4 mensajes sin leer</li>
                                              <li>
                                                <!-- inner menu: contains the actual data -->
                                                <ul class="menu">
                                                  <li><!-- start message -->
                                                    <a href="#" id="chat1" onclick="chat()">
                                                      <div class="pull-left">
                                                        <img src="assets/images/login/productor.png" width="160px" height="160px" class="img-circle" alt="User Image">
                                                      </div>
                                                      <h4>
                                                        Juan Perez-Calificación
                                                        <small><i class="fa fa-clock-o"></i> 5 minutos</small>
                                                      </h4>
                                                      <p style="margin-top: -6px">¿Cómo te fue en tu ultima compra?</p>
                                                    </a>
                                                  </li>
                                                  <!-- end message -->
                                                  <li>
                                                    <a href="#">
                                                      <div class="pull-left">
                                                        <img src="assets/images/login/user3-128x128.jpg" class="img-circle" alt="User Image">
                                                      </div>
                                                      <h4>
                                                        Ventas-Ofertas
                                                        <small><i class="fa fa-clock-o"></i> 2 horas</small>
                                                      </h4>
                                                      <p style="margin-top: -6px">Encuentre frutas a mitad de precio</p>
                                                    </a>
                                                  </li>
                                                  <li>
                                                    <a href="#">
                                                      <div class="pull-left">
                                                        <img src="assets/images/login/user4-128x128.jpg" class="img-circle" alt="User Image">
                                                      </div>
                                                      <h4>
                                                        Familia Kallanka
                                                        <small><i class="fa fa-clock-o"></i> Ayer</small>
                                                      </h4>
                                                      <p style="margin-top: -6px">Te damos la bienvenida </p>
                                                    </a>
                                                  </li>
                                                  <li>
                                                    <a href="#">
                                                      <div class="pull-left">
                                                        <img src="assets/images/login/user3-128x128.jpg" class="img-circle" alt="User Image">
                                                      </div>
                                                      <h4>
                                                        Credenciales
                                                        <small><i class="fa fa-clock-o"></i> </small>
                                                      </h4>
                                                      <p style="margin-top: -6px">Tu cuenta fue creada con exito</p>
                                                    </a>
                                                  </li>
                                                  <li>
                                                  </li>
                                                </ul>
                                              </li>
                                              <li class="footer" style="background-color: blue"><a href="#">Ver todos los mensajes</a></li>
                                            </ul>
                                          </li>
                                 
                                        <li><a href="#" onclick="abrir(1)"> Ingresar</a></li>
                                        <li><a><img src="assets/images/banderas/peru.png" width="25px" height="20px"> PERU</a></li>
                                    </ul>
                                </div><!-- /.navbar-collapse -->
                            </div><!-- /.container-fluid -->
                        </nav>
                    </div>
                </div>
            </div>	
        </header> <!-- End Header Section -->

        <section id="slider" class="slider">
            <div class="slider_overlay">
                <div class="container">
                    <div class="row">
                        <div class="main_slider text-center">
                            <div class="col-md-12">
                                <div class="main_slider_content wow zoomIn" data-wow-duration="2s">
                                    <h1 style="font-size: 30px; margin-top: -15%; margin-bottom: -2%
                                    ">Bienvenido , que deseas hacer?</h1>
                                    <div class="row">
                                           <div class="col-sm-6 col-md-5 col-md-offset-1">

                                               <h1 style="font-size: 25px; margin-bottom: -5px">Vivir una aventura</h1>
                                                <img src="assets/images/inicio/vivir_aventura.jpg"  width="250px" height="200px" class="img-circle" id="imgAventura">
                                                
                                                <ul style="margin-top: 5px;" hidden="true" id="optAventura">
                                                <li><a href="#experiencia" type="button" id="exp1" class="btn btn-default" style="">EXPERIENCIA</a></li>
                                                <li><a href="#portfolio" style="margin-top: 4px;" id="exp2" type="button" class="btn btn-default" style="">EXPERIENCIA+ESTADIA</a></li>
                                                </ul>
                                           </div>
                                           <div class="col-sm-6 col-md-5 col-md-offset-1">
                                               <h1 style="font-size: 25px; margin-bottom: -2px">Ser anfitrion</h1>
                                                <img id="imgAnfitrion" src="assets/images/inicio/anfitrion.jpeg"  width="250px" height="200px" class="img-circle">
                                           </div>
                                    </div>
                                </div>
                            </div>	
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <section id="portfolio" style="height: 100%" class="portfolio">
            <div class="container">             
           <h5 style="margin-top: 5px"><i class="fa fa-home" aria-hidden="true"></i><b> Inicio > Busqueda Rapida : EXPERIENCIA+ESTADIA</b> <label style="margin-left: 20px; font-weight: 100; font-size:15px"> <i class="fa fa-map-marker" aria-hidden="true"></i> Lima, Cercado de Lima, Universidad Nacional Mayor de San Marcos lat: -12.053265 , lon: -77.085504 </label></h5>
             
             <div class="row">
              <div class="process">
               <div class="process-row nav nav-tabs">
                <div class="process-step">
                 <button type="button" style="border-color: black" class="btn btn-info btn-circle" data-toggle="tab" href="#menu_1"><i style="color:black" class="fa fa-hand-pointer-o fa-2x" aria-hidden="true"></i></button>
                 <p><small>Selecciona un experiencia</small></p>
                </div>
                <div class="process-step">
                 <button type="button" style="border-color: black" class="btn btn-default btn-circle" data-toggle="tab" href="#menu_2"><i style="color:black" class="fa fa-phone fa-2x" aria-hidden="true"></i></button>
                 <p><small>Informate sobre tu anfitrion</small></p>
                </div>
                <div class="process-step">
                 <button type="button" style="border-color: black" class="btn btn-default btn-circle" data-toggle="tab" href="#menu_3"><img src="assets/images/walk.png" width="30px" height="30px"></button>
                 <p><small>Acercate </small></p>
                </div>
               </div>
              </div>
              <div class="tab-content">
               <div id="menu_1" class="tab-pane fade active in">
                  <div style="background-color:#A3C6CD;height:70%; width:100%;" id="div_mapas"></div>

          <div id="divDistancia" style="padding-top:5px; cursor:pointer; cursor:hand;" onClick="showLsOpt4();" onDblClick="hideLsOpt4();">
              <div style=" position:relative;top:1px;border-radius:3px;width:120px; background-color:#999999; height:24px; opacity:0.3;filter:alpha(opacity=30)">
              </div>
              <div style=" position:relative; top:-24px; left:2px; clear:both;border:1px solid gray; width:100px; background-color:#FFFFFF; height:19px; text-align:center;">
                  <div style=" position:static; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:normal; padding-left:4px; padding-right:4px; padding-top:2px;"><b>Ruta</b></div>
              </div>

              <div id="LsOpt4" style="width:380px;height:580px;  background-color:rgba(223, 71, 71, 0.62);display:none">
                  <table>
                <tr><td><h6 style="color: yellow" align="center"><b>Total Distancia:<b> <span id="total"></span></h6></td></tr>
                 <tr><td>
                  <h6 style="margin-top: -5px;color:white"> 1) Escoge una opcion de trazo de ruta</h6>
                  <button style="margin-left: 35px;" type="button" id="Puntos" onclick="addMaker();"> <i class="fa fa-map-marker" aria-hidden="true"></i> Crear Puntos </button>
                  <button style="margin-left: 15px;" type="button" id="Coordenadas" onclick=""><i class="fa fa-globe" aria-hidden="true"></i> Por Coordenadas(x,y) </button>
                  

                  <h6 align="center" id="Mensaje1" hidden="true" style="color:yellow;font-weight: normal; margin-top: 5px; margin-bottom: -20px;"> Seleccione 2 o más puntos (max 10) en el Mapa  </h6>

                  <div class="column width1 first" hidden="true" id="Mensaje2" style="margin-top:10px;">
                   
                    <h6  align="center" style="margin-top: -5px; margin-bottom: -20px; color: white">PUNTO DE ORIGEN (Latitud/Longitud)</h6 >
                   <h6 align="center"> X:  <input type="number" id="origen1" placeholder="Latitud" style="width:135px; text-align: center"/> <label style="margin-left: 8px; margin-right: 5px;"> Y: </label>
                   <input type="number" id="origen2" placeholder="Longitud" style="width:135px; text-align: center"/> </h6>

                   <h6  align="center" style="margin-top: -15px; margin-bottom: -20px; color: white">PUNTO DE DESTINO (Latitud/Longitud) </h6 >
                   <h6 align="center" style="margin-bottom: -15px;"> X:  <input type="number" id="destino1" placeholder="Latitud" style="width:135px; text-align: center"/> <label style="margin-left: 8px; margin-right: 5px;"> Y: </label>  <input type="number" id="destino2" placeholder="Longitud" style="width:135px; text-align: center"/> </h6>
                     
                   </div>

                  <input type="text" id="origen"  hidden="true" />
                  <input type="text" id="destino" hidden="true" />
                  <br>
                  <h6  style="margin-bottom: 5px;color:white"> 2) Escoge una operación a realizar </h6>
                 
                  <button style="margin-left: 50px;" type="button" id="calcruta"  onClick="calcRoute();" title="Calcular Ruta" disabled /> <i class="fa fa-refresh" aria-hidden="true"></i> Calcular Ruta </button>

                  <button  type="button" id="calcruta2"  onClick="calcRoute2();" title="Calcular Ruta" hidden="true" /> <i class="fa fa-street-view" aria-hidden="true"></i> Calcular Ruta </button>

                  <button type="button" onclick="reset()"> <i class="fa fa-eraser" aria-hidden="true"></i> Limpiar </button>
                  </td>
                </tr>
          <tr><td>

          </td></tr>
                   <tr><td><div id="directionsPanel"  style="position:absolute; width:370px; height:400px; overflow: auto" ></div></td></tr>
                 </table>
                   
              </div>
          </div>
                </div>                    
               <div id="menu_2" class="tab-pane fade">
                <div class="row">
                  <div  class="col-sm-12">
                    
                    <div class="col-sm-8">
                      <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                              <img src="assets/images/experiencia_estadia/user_01/semana_santa01.jpg" width="220px" height="185px" style="display: inline-block;margin-left: 40px">
                              <img src="assets/images/experiencia_estadia/user_01/fondo2.jpg" width="220px" height="185px" style="display: inline-block;">
                              <img src="assets/images/experiencia_estadia/user_01/semana_santa02.jpg" width="220px" height="185px" style="display: inline-block;">
                              <h4 align="center" style="color:green"><b>Semana Santa en Ayacucho-5km pie  (S/. 75 x noche)</b></h4>
                              <h6 align="center"><i  class="fa fa-clock-o" aria-hidden="true"></i> 3 dias y 2 noches <i  style="margin-left: 8px" class="fa fa-users" aria-hidden="true"></i> 10 personas <i style="margin-left: 8px" class="fa fa-bed" aria-hidden="true"></i>   5 habitaciones <i style="margin-left: 8px"  class="fa fa-cutlery" aria-hidden="true"></i>   Almuerzo S/.20</h6>
                            </div>
                            <div class="col-sm-6">
                              <h5 align="center">Anfitrión: Hugo Cortez</h5>
                              <div align="center">
                              <tr>
                                <td> <button class="btn btn-default" style="border-radius: 50%;"><i  class="fa fa-facebook" aria-hidden="true"></i></button></td>
                                <td> <button class="btn btn-default" style="border-radius: 50%;"><i class="fa fa-twitter" aria-hidden="true"></i></button></td>
                              </tr>
                              </div>

                              <h6 align="center"><i style="margin-right: 5px" class="fa fa-envelope" aria-hidden=true></i> hugo.cardenas@unmsm.edu.pe <i style="font-size: 20px;margin-left: 10px;margin-right: 5px" class="fa fa-mobile" aria-hidden=true></i>947826902 </h6>
                            </div>

                            <div class="col-sm-6">
                              <h5 align="center" style="color:blue" ><?php echo "Incluye" ?></h5>
                              <ul>
                                <li>.Colchonetas o Matras y Carpas.</li>
                                <li>.Alimentación: 3 desayunos + 3 almuerzos + 3 cenas</li>
                                <li>.Entrada al Camino Inca y Machupicchu.</li>
                                <li>.Guía profesional</li>
                              </ul>
                            </div>
                        </div>
                    </div>
                  </div>
                    <div class="col-sm-4">
                      <div class="panel panel-default" style="background-color: #ffe081">
                        <div class="panel-body">
                            <h5> <b>Tipo de Experiencia :</b> <b> COSTUMBRISTA </b></h5>
                            <td>
                              <tr><label style="margin-left: 45px">Llegada</label></tr>
                              <tr><label style="margin-left: 105px">Hasta</label></tr>
                            </td>
                            <br>
                            <td>
                              <tr><i class="fa fa-calendar" aria-hidden="true"></i></tr>
                              <tr><input type="text" id="fecha1"  placeholder="Clic aqui" readonly style="text-align:center; width: 120px; font-size:15px;margin-left: 5px"></tr>
                              <tr><i style="margin-left: 10px" class="fa fa-calendar" aria-hidden="true"></i></tr>
                              <tr><input type="text" id="fecha2"  placeholder="Clic aqui" readonly style="text-align:center; width: 120px; font-size:15px;margin-left: 5px"></tr>
                            </td>
                            <br><br>
                            <td>
                              <tr><label style="margin-left: 9px">1 persona</label></tr>
                              <tr><label style="margin-left: 20px">2 personas</label></tr>
                              <tr><label style="margin-left: 30px">Grupo de 3</label></tr>

                            </td>
                            <div class="funkyradio" style="margin-top: -30px;margin-left: 10px">
                                <div class="funkyradio-default" style="display: inline-block;">
                                    <input  type="radio" name="radio" id="radio1" />
                                    <label for="radio1"><i style="margin-left: -45px;margin-top: 10px ;margin-right: 10px" class="fa fa-user" aria-hidden="true"></i></label>
                                </div>
                                <div class="funkyradio-primary" style="display: inline-block;">
                                    <input  type="radio" name="radio" id="radio2" checked/>
                                    <label for="radio2"><i style="margin-left: -45px;margin-top: 10px ;margin-right: 2px" class="fa fa-user" aria-hidden="true"></i><i style="margin-left: -40px;margin-right: 10px" class="fa fa-user" aria-hidden="true"></i></label>
                                </div>
                                <div class="funkyradio-success" style="display: inline-block;">
                                    <input  type="radio" name="radio" id="radio3" />
                                    <label for="radio3"><i style="margin-left: -45px;margin-top: 7px ;margin-right: 10px;font-size: 20px" class="fa fa-users" aria-hidden="true"></i></label>
                                </div>
                            </div>
                            <button id="btnAgregarCarrito" style="margin-top: 10px;margin-left: 30%" class="btn btn-warning next-step">Reservar</button>
                            </div>
                        </div>
                    </div>
                    </div>
                
                  </div>
                </div>
       
        <div id="menu_3" class="tab-pane fade">
                <br><br>
                <h5 align="center"><b>Paso 3 de 3 </b></h5>
                  <div align="center" class="col-sm-6 col-sm-offset-3">
                  <p align="center">Para completar tu pedido dirigite al botón del carrito de compras para preparar tu pedido o puedes seguir ordenando productos</p>
                  </div>
                </div>
              </div>
             </div>
            </div><!--Fin classs container-->
        </section>

      
        <section id="foro" style="height: 100%" class="portfolio">
            <br><br>  <br><br><br>
            <div class="container">
              <h5 style="margin-top: 15px"><i class="fa fa-home" aria-hidden="true"></i><b> Inicio > Foro Kallanka</b></h5>
              <div class="container">
                  <div class="row">
                      <div class="col-md-4">
                        <button id="btnCrearForo" style="margin-top: 30px;margin-left: 15px" type="button" class="btn btn-info">Create un nuevo</button>
                      </div>
                      <div class="col-md-8">
                          <div class="panel panel-primary">
                              <div class="panel-heading">
                                  <span class="glyphicon glyphicon-comment"></span>&nbsp Temas Recientes
                               
                              <div class="panel-body">
                                  <ul class="chat">
                                      <li class="left clearfix"><span class="chat-img pull-left">
                                          <img id="chat_1" src="http://placehold.it/50/55C1E7/fff&text=J" alt="User Avatar" class="img-circle" />
                                      </span>
                                          <div class="chat-body clearfix">
                                              <div class="header">
                                                  <strong class="primary-font">&nbsp&nbspJuan</strong> <small class="pull-right">
                                                      <span class="glyphicon glyphicon-time" style="margin-right: 10px"></span>5 mins ago</small>
                                              </div>
                                              <p>&nbsp&nbspCúales son los anfitriones son los mas recomendados?</p>
                                          </div>
                                      </li>
                                      <br><br>

                                      <li class="left clearfix"><span class="chat-img pull-left">
                                          <img src="http://placehold.it/50/FA6F57/fff&text=L" alt="User Avatar" class="img-circle" />
                                      </span>
                                          <div class="chat-body clearfix">
                                              <div class="header">
                                                  <strong class="primary-font">&nbsp&nbspLuis</strong> <small class="pull-right ">
                                                      <span class="glyphicon glyphicon-time" style="margin-right: 10px"></span>12 mins ago</small>
                                              </div>
                                              <p>&nbsp&nbspQue proveedor llega puntual que conozcan</p>
                                          </div>
                                      </li>
                                     
                                      
                                  </ul>
                              </div>
                          
                          </div>
                      </div>
                  </div>
              </div>

            </div><!--Fin classs container-->
          </div>

        </section>
     <div class="scrollup3" hidden="true">
        <iframe width="320" height="340" src="https://console.dialogflow.com/api-client/demo/embedded/862c97a5-e62a-4fb4-99e9-14b5f288c165"></iframe>
      </div>
        
      <div class="scrollup2">
            <a id="btnChat"><i id="iChat" class="fa fa-phone fa-2x" aria-hidden="true"></i></a>
        <
		<div class="scrollup">
			<a href="#"><i class="fa fa-chevron-up"></i></a>
		</div>		

  
        <div class="modal fade" id="registrarAnfitrion" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
                  <div class="modal-header modalf">
                      <button type="button" class="close close_foncy" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4  align="center">Registrando como: <strong>ANFITRIÓN</strong> <i class="fa fa-users" aria-hidden="true"></i></h4>
                      
                  </div>
         
                  <div class="modal-body">
                    
                    <!--Nombres-->
                    <div class="input-group input-group-lg" style="margin-left: 2%; margin-bottom: 1%">
                      <span  id="produNombre2" class="input-group-addon" id="sizing-addon1" ><i class="fa fa-user" aria-hidden="true"></i></span>
                      <input style="width:100%;" type="text" id="anfiNombre" class="form-control" placeholder=" Nombres" aria-describedby="sizing-addon1" onchange="cambiar_estado(1)">
                    </div>
                    
                    <!--Apellidos-->
                    <div class="input-group input-group-lg" style="margin-left: 2%; margin-bottom: 1%">
                      <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                      <input style="width:100%" type="text" id="anfiApellido" class="form-control" placeholder="Apellidos" aria-describedby="sizing-addon1" onchange="cambiar_estado(2)">
                    </div>


                    <!--Email-->
                    <div class="input-group input-group-lg" style="margin-left: 2%; margin-bottom: 1%">
                      <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                      <input style="width:100%" type="text" id="anfiMail" class="form-control" placeholder="Correo electrónico" aria-describedby="sizing-addon1" onchange="cambiar_estado(3)">
                    </div>
                    
                    <!--Contraseña-->
                    <div class="input-group input-group-lg" style="margin-left: 2%; margin-bottom: 1%">
                        <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-key" aria-hidden="true"></i></span>
                        <input style="width:100%" type="password" id="anfiContra" class="form-control" placeholder="Contraseña(Debe contener mínimo 8 caracteres)" aria-describedby="sizing-addon1" onchange="cambiar_estado(4)">
                           
                    </div>

                    <!--Repite Contraseña-->
                    <div class="input-group input-group-lg" style="margin-left: 2%;">
                        <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-key" aria-hidden="true"></i></span>
                        <input style="width:100%" type="password" id="anfiRepetirContra" class="form-control" placeholder="Repite Contraseña" aria-describedby="sizing-addon1" onchange="cambiar_estado(5)">
                           
                    </div>
                
                  <div class="modal-footer">     
                         <button  class="btn btn-info pull-right" onclick="crear_cuenta()">Crear Cuenta</button>
                 
                  </div>
  
          </div>
        </div>
  </div>
</div>


        <script src="assets/js/vendor/bootstrap.min.js"></script>
        <script type="text/javascript">
            $(function(){
             $('.btn-circle').on('click',function(){
               $('.btn-circle.btn-info').removeClass('btn-info').addClass('btn-default');
               $(this).addClass('btn-info').removeClass('btn-default').blur();
             });

             $('.next-step, .prev-step').on('click', function (e){
               var $activeTab = $('.tab-pane.active');

               $('.btn-circle.btn-info').removeClass('btn-info').addClass('btn-default');

               if ( $(e.target).hasClass('next-step') )
               {
                  var nextTab = $activeTab.next('.tab-pane').attr('id');
                  $('[href="#'+ nextTab +'"]').addClass('btn-info').removeClass('btn-default');
                  $('[href="#'+ nextTab +'"]').tab('show');
               }
               else
               {
                  var prevTab = $activeTab.prev('.tab-pane').attr('id');
                  $('[href="#'+ prevTab +'"]').addClass('btn-info').removeClass('btn-default');
                  $('[href="#'+ prevTab +'"]').tab('show');
               }
             });
            });
        </script>
        <script src="assets/js/jquery-easing/jquery.easing.1.3.js"></script>
        <script src="assets/js/wow/wow.min.js"></script>
        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/main.js"></script>
        <script type="text/javascript" src="assets/libraries/sweet_alert/sweetalert.js"></script>
        <script src="assets/js/app.js"></script>
    </body>
</html>
