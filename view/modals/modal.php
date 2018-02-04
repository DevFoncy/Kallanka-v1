<style type="text/css">
  
#btnComprador:hover{
    background-color: #F1F955;
    border:1px solid;
    transform:  scale(1.3);
   }
#btnVendedor:hover{
    background-color: #F1F955;
    border:1px solid;
    transform:  scale(1.3);
   }
.img-circle{
    border-radius: 50%;
    cursor: pointer;
}


</style>
 <div class="modal fade" id="mForoChat" role="dialog">

          <div class="modal-dialog" role="document" style="w
          idth: 400px">
            <div class="modal-content">
                  <div class="modal-header">
                          <button type="button" class="close close_foncy" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>Foro DeliQatu</h4>
                  </div>

                  <div class="modal-body" style="margin-top: -2%">
                    <li class="left clearfix">
                        <span class="chat-img pull-left">
                                 <img src="http://placehold.it/50/55C1E7/fff&text=J" alt="User Avatar" class="img-circle" />
                          </span>
                       <div class="chat-body clearfix">
                             <div class="header">
                                    <strong class="primary-font">&nbsp&nbspJuan</strong> <small class="pull-right">
                                <span class="glyphicon glyphicon-time"></span>5 mins ago</small>
                        </div>
                        <h4>&nbsp&nbspCuales son los anfitriones más recomendados</h4>
                        <p>Buenas hago esta pregunta ya que quiero ser un anfitrión</p>
                        </div>
                    </li>
                    <br>
                    <div class="panel-footer">
                                  <div class="input-group">
                                      <input id="btn-input" type="text" class="form-control input-sm" placeholder="Escriba su opinion" />
                                      <span class="input-group-btn">
                                          <button class="btn btn-warning btn-sm" id="btn-chat">Enviar</button>
                                      </span>
                                  </div>
                    </div>
                    <br>
                    <h3>Comentarios</h3>
                    <li class="left clearfix">
                      <span class="chat-img pull-left">
                             <img src="http://placehold.it/50/FA6F57/fff&text=G" alt="User Avatar" class="img-circle" />
                       </span>
                         <div class="chat-body clearfix">
                                <div class="header">
                                     <strong class="primary-font">&nbsp&nbspGianella</strong> <small class="pull-right">
                                       <span class="glyphicon glyphicon-time"></span>2 mins ago</small>
                                 </div>
                               <p>&nbsp&nbspYo voy mucho a Ayacucho</p>
                       </div>
                    </li>
                    <li class="left clearfix">
                      <span class="chat-img pull-left">
                             <img src="http://placehold.it/50/FA6F57/fff&text=A" alt="User Avatar" class="img-circle" />
                       </span>
                       <div class="chat-body clearfix">
                              <div class="header">
                                <strong class="primary-font">&nbsp&nbspAlejandra</strong> <small class="pull-right">
                                <span class="glyphicon glyphicon-time"></span>5 mins ago</small>
                                </div>
                                 <p>&nbsp&nbspEn mi caso damos wifi gratis en nuestra casa</p>
                         </div>
                    </li>
                  </div>

                <div class="modal-footer">
                    <div class="pull-left">
                        <button data-dismiss='modal' class="btn btn-info">Regresar</button>
                    </div>
                    <div class="pull-right">
                      <button class="btn btn-info" style="background-color: #e66306e6;">Crear cuenta*</button>
                    </div>
                </div>

            </div>
        </div>
        </div>
        <!-- FIN DE MODAL DE FORO-->


        <!-- CREAR FORO -->
        <div class="modal fade" id="mForo" role="dialog">

          <div class="modal-dialog" role="document" style="width: 400px">
            <div class="modal-content">
               <div class="modal-header">
                          <button type="button" class="close close_foncy" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h3 align="center">Foro DeliQatu</h3>
                          <h5 align="center" style="color:#e66306e6;">Agrega tu tema</h5>
                </div>
                  <div class="modal-body" style="margin-top: -2%">
                    <h6><b>Titulo de Tema</b></h6>
                    <div class="input-group input-group-lg" style="margin-left: 8%;">
                        
                        <input style="width:85%;border:1px solid #ccc;font-size: 26px;" type="text" id="" class="form-control" placeholder="Titulo" aria-describedby="sizing-addon1">
                    </div>
                    <!--Contraseña-->
                    <h6><b>Descripcion del tema</b></h6>
                    <div class="form-group">
                      
                      <textarea class="form-control" rows="5" id="comment" placeholder="Describe tu tema a mas detalle para que recibas mas respuestas"></textarea>
                    </div>
                  </div>

                <div class="modal-footer">
                    <div class="pull-left">
                        <button data-dismiss="modal" class="btn btn-info">Regresar</button>
                    </div>
                    <div class="pull-right">
                      <button id="btnCrearTema"   class="btn btn-info" style="background-color: #e66306e6;">Agregar tema*</button>
                    </div>
                </div>           

            </div>
        </div>
        </div>
        <div class="scrollup">
            <a href="#"><i class="fa fa-chevron-up"></i></a>
        </div>      
        
        
        <div class="modal fade" id="mRegistrar" role="dialog">

          <div class="modal-dialog" role="document" style="width: 400px">
            <div class="modal-content">
                  <div class="modal-header">
                          <button type="button" class="close close_foncy" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4  align="center" style="margin-top: 3%"> Iniciar Sesion</h4> 
                          <h6 style="color:#e66306e6;"> Usted debe estar registrado en la plataforma, en caso no lo este pulse el botón Crear cuenta[*] </h6>
                  </div>
                  <div class="modal-body" style="margin-top: -2%">
                    <h6><b>Usuario</b><label  id="lblLoginUser" style="font-size: 10px;color:red;margin-left: 5px;display: none">Este campo es obligatorio</label></h6>
                    <div class="input-group input-group-lg" style="margin-left: 8%;">
                        <span class="input-group-addon" id="sizing-addon1">@</span>
                        <input style="width:85%;border:1px solid #ccc;font-size: 15px;" type="text" id="usuario_user" class="form-control" placeholder="Su usuario es su correo registrado" aria-describedby="sizing-addon1">
                    </div>
                    <!--Contraseña-->
                    <h6><b>Contrasena</b><label  id="lblLoginPass" style="font-size: 10px;color:red;margin-left: 5px;display: none">Este campo es obligatorio</label></h6>
                    <div class="input-group input-group-lg" style="margin-left: 8%;">
                        <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-key" aria-hidden="true"></i></span>
                        <input style="width:85%;border:1px solid #ccc;font-size: 15px;" type="password" id="pass_user" class="form-control" placeholder="Contiene minimo 6 digitos" aria-describedby="sizing-addon1">
                    </div>
                  </div>

                <div class="modal-footer">
                    <div class="pull-left">
                        <button id="btnIngresar" class="btn btn-info" >Ingresar</button>
                    </div>
                    <div class="pull-right">
                      <button id="btnCrearCuenta"  onclick="abrir(2)"  class="btn btn-info" style="background-color: #e66306e6;">Crear cuenta*</button>
                    </div>                  
                </div>
                
            </div>
        </div>
        </div>
        <!--Modal para crear la cuenta-->

        <div class="modal fade" id="mCrearCuenta" role="dialog">

          <div class="modal-dialog" role="document">
            <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close close_foncy" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        
                        <div class="progress">
                        <div class="progress progress-striped active">
                               <div id="1" class="progress-bar" style="width: 30%;background-color: #FADA29" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                <label style="text-align: center;color: black;font-weight: 100;font-size: 15px;"><strong>Paso 1</strong> de 3</label> 
                               </div>

                           </div>
                        </div>
                        <h5 style="margin-top: -2%;color:#1483b7" align="center">Que deseas hacer: vivir una experiencia o ser un anfitrion?</h5>    
                      
                  </div>
                  <div class="modal-body">
                      <!--Gift del Comprador y Vendedor-->
                      <img class="img-circle" id="imgComprador" src="assets/images/inicio/vivir_aventura.jpg" width="130px" height="125px" style="margin-left: 20%" >
                      <img class="img-circle" id="imgVendedor" src="assets/images/inicio/anfitrion.jpeg" style="margin-left: 10%"  width="130px" height="125px"  >
                    <br> <br>
                    <button   id="btnComprador" onclick="abrir(3)" style="margin-left: 18%" type="button" >Vivir una experiencia </button>
                    <button   id="btnVendedor"  onclick="abrir(4)"  type="button" style="margin-left: 13%"> Ser anfitrión  </button> 
                </div>
          </div>
         </div>
        </div><!--Fin del Modal-->

  
  <div class="modal fade" id="mProductor" role="dialog"><!--Modal de Productor-->

          <div class="modal-dialog" role="document">
            <div class="modal-content">
                  <div class="modal-header" style="margin-bottom: -5px">
                      <button type="button" class="close close_foncy" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" >&times;</span></button>
                      <div class="progress">
                        <div class="progress-bar progress-bar-striped active" role="progressbar"
                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:60%;background-color: #c8de37">
                          <label style="color:black;font-weight: 100;font-size: 15px;"><strong>Paso 2</strong> de 3</label>
                        </div>
                      </div>
                       <h5 style="margin-top: -3%" align="center" class="modal-title">Registrando como <strong>Anfitrion</strong></h5>
                       <h6 style="color:#1483b7; margin-bottom: 0px;">*Informacion obligatoria</h6>
                  </div>
         
                  <div class="modal-body" style="margin-top: -2%">
                    
                    <!--Nombres-->
                    <h6 style="font-size: 12px"><b>*Nombres</b></h6>
                    <div class="input-group input-group-lg" style="margin-left: 4%; margin-bottom: 1%">
                      <span  id="produNombre2" class="input-group-addon" id="sizing-addon1" ><i class="fa fa-user" aria-hidden="true"></i></span>
                      <input style="width:85%;border:1px solid #ccc;font-size: 14px;" type="text" id="produNombre" class="form-control" placeholder="Ingresa tu nombre aqui" aria-describedby="sizing-addon1" onchange="cambiar_estado_p(1)">
                    </div>
                    
                    <!--Apellidos-->
                    <h6 style="font-size: 12px"><b>*Apellidos</b></h6>
                    <div class="input-group input-group-lg" style="margin-left: 4%; margin-bottom: 1%">
                      <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                      <input style="width:85%;border:1px solid #ccc;font-size: 14px;" type="text" id="produApellido" class="form-control" placeholder="Ingresa tu apellido" aria-describedby="sizing-addon1" onchange="cambiar_estado_p(2)">
                    </div>


                    <!--Email-->
                    <h6 style="font-size: 12px"><b>*Correo</b></h6>
                    <div class="input-group input-group-lg" style="margin-left: 4%; margin-bottom: 1%">
                      <span class="input-group-addon" id="sizing-addon1">@</span>
                      <input style="width:85%;border:1px solid #ccc;font-size: 14px;" type="text" id="produMail" class="form-control" placeholder="Por ejemplo: sistemas@gmail.com , prueba@hotmail.com" aria-describedby="sizing-addon1" onchange="cambiar_estado_p(3)">
                    </div>
                    
                    <!--Contraseña-->
                    <h6 style="font-size: 12px"><b>*Contraseña</b> <label  id="lblrptContra2_p" style="font-size: 10px;color:red;margin-left: 5px;display: none">Este campo debe tener mínimo 8 digitos</label></h6>
                    <div class="input-group input-group-lg" style="margin-left: 4%; margin-bottom: 1%">
                        <span class="input-group-addon tippy" id="animated-tippy" title="Sticky tooltip! Click my element to hide me." data-theme="transparent" data-sticky="true" data-hideonclick="false" data-trigger="click" ><i class="fa fa-key" aria-hidden="true"></i></span>
                        <input style="width:85%;border:1px solid #ccc;font-size: 14px;" type="password" id="produContra" class="form-control" placeholder="Contraseña(Debe contener mínimo 8 caracteres)" aria-describedby="sizing-addon1" onchange="cambiar_estado_p(4)">
                        <i id="iconBad2_p" style="display: none" class="fa fa-times bad" aria-hidden="true"></i>
                    </div>

                    <!--Repite Contraseña-->
                    <h6 style="font-size: 12px"><b>*Repetir contrasena</b> <label  id="lblrptContra_p" style="font-size: 10px;color:red;margin-left: 5px;display: none">Este campo debe ser igual al de contrasena</label></h6>
                    <div class="input-group input-group-lg" style="margin-left: 4%;">
                        <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-key" aria-hidden="true"></i></span>
                        <input style="width:85%;border:1px solid #ccc;font-size: 14px;" type="password" id="produRepetirContra" class="form-control" placeholder="Repite Contrasena" aria-describedby="sizing-addon1" onchange="cambiar_estado_p(5)">
                        <i id="iconBad" style="display: none" class="fa fa-times bad" aria-hidden="true"></i>
                    </div>
                
                  <div class="modal-footer">
                         <button  class="btn btnf pull-left" data-dismiss="modal" style="background-color: #FADA29" >Regresar</button>
                         <button  id="btnRegistrar_p" class="btn btn-info pull-right" onclick="crear_cuenta_anfitrion()"> <i class="fa fa-save" aria-hidden="true"></i> Crear Cuenta</button>
                 
                  </div>
                </div>
            </div>
        </div>
    </div><!--Fin del modal del Productor-->
  
  <div class="modal fade" id="mComprador" role="dialog"><!--Modal de Comprador-->

          <div class="modal-dialog" role="document">
            <div class="modal-content">
                  <div class="modal-header" style="margin-bottom: -5px">
                      <button type="button" class="close close_foncy" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" >&times;</span></button>
                      <div class="progress">
                        <div class="progress-bar progress-bar-striped active" role="progressbar"
                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:60%;background-color: #c8de37">
                          <label style="color:black;font-weight: 100;font-size: 15px;"><strong>Paso 2</strong> de 3</label>
                        </div>
                      </div>
                       <h5 style="margin-top: -3%" align="center" class="modal-title">Registrando como <strong>Huesped</strong></h5>
                       <h6 style="color:#1483b7; margin-bottom: 0px;">*Informacion obligatoria</h6>
                  </div>
         
                  <div class="modal-body" style="margin-top: -2%">
                    
                    <!--Nombres-->
                    <h6 style="font-size: 12px"><b>*Nombres</b></h6>
                    <div class="input-group input-group-lg" style="margin-left: 4%; margin-bottom: 1%">
                      <span  id="produNombre2" class="input-group-addon" id="sizing-addon1" ><i class="fa fa-user" aria-hidden="true"></i></span>
                      <input style="width:85%;border:1px solid #ccc;font-size: 14px;" type="text" id="consuNombre" class="form-control" placeholder="Ingresa tu nombre aqui" aria-describedby="sizing-addon1" onchange="cambiar_estado(1)">
                    </div>
                    
                    <!--Apellidos-->
                    <h6 style="font-size: 12px"><b>*Apellidos</b></h6>
                    <div class="input-group input-group-lg" style="margin-left: 4%; margin-bottom: 1%">
                      <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                      <input style="width:85%;border:1px solid #ccc;font-size: 14px;" type="text" id="consuApellido" class="form-control" placeholder="Ingresa tu apellido" aria-describedby="sizing-addon1" onchange="cambiar_estado(2)">
                    </div>


                    <!--Email-->
                    <h6 style="font-size: 12px"><b>*Correo</b></h6>
                    <div class="input-group input-group-lg" style="margin-left: 4%; margin-bottom: 1%">
                      <span class="input-group-addon" id="sizing-addon1">@</span>
                      <input style="width:85%;border:1px solid #ccc;font-size: 14px;" type="text" id="consuMail" class="form-control" placeholder="Por ejemplo: sistemas@gmail.com , prueba@hotmail.com" aria-describedby="sizing-addon1" onchange="cambiar_estado(3)">
                    </div>
                    
                    <!--Contraseña-->
                    <h6 style="font-size: 12px"><b>*Contrasena</b> <label  id="lblrptContra2" style="font-size: 10px;color:red;margin-left: 5px;display: none">Este campo debe tener minimo 8 digitos</label></h6>
                    <div class="input-group input-group-lg" style="margin-left: 4%; margin-bottom: 1%">
                        <span class="input-group-addon tippy" id="animated-tippy" title="Sticky tooltip! Click my element to hide me." data-theme="transparent" data-sticky="true" data-hideonclick="false" data-trigger="click" ><i class="fa fa-key" aria-hidden="true"></i></span>
                        <input style="width:85%;border:1px solid #ccc;font-size: 14px;" type="password" id="consuContra" class="form-control" placeholder="Contraseña(Debe contener mínimo 8 caracteres)" aria-describedby="sizing-addon1" onchange="cambiar_estado(4)">
                        <i id="iconBad2" style="display: none" class="fa fa-times bad" aria-hidden="true"></i>
                    </div>

                    <!--Repite Contraseña-->
                    <h6 style="font-size: 12px"><b>*Repetir contrasena</b> <label  id="lblrptContra" style="font-size: 10px;color:red;margin-left: 5px;display: none">Este campo debe ser igual al de contrasena</label></h6>
                    <div class="input-group input-group-lg" style="margin-left: 4%;">
                        <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-key" aria-hidden="true"></i></span>
                        <input style="width:85%;border:1px solid #ccc;font-size: 14px;" type="password" id="consuRepetirContra" class="form-control" placeholder="Repite Contraseña" aria-describedby="sizing-addon1" onchange="cambiar_estado(5)">
                        <i id="iconBad" style="display: none" class="fa fa-times bad" aria-hidden="true"></i>
                    </div>
                
                  <div class="modal-footer">
                         <button  class="btn btnf pull-left" data-dismiss="modal" style="background-color: #FADA29" >Regresar</button>
                         <button  id="btnRegistrar" class="btn btn-info pull-right" onclick="crear_cuenta_huesped()"> <i class="fa fa-save" aria-hidden="true"></i> Crear Cuenta</button>
                 
                  </div>
                </div>
            </div>
        </div>
    </div><!--Fin del modal del comprador-->


  <div class="modal fade" id="mCalificar" role="dialog"><!--Modal de Comprador-->

          <div class="modal-dialog" role="document">
            <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close close_foncy" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" >&times;</span></button>
                        <h4 align="center">Calificacion de tu ultima experiencia <i class="fa fa-star fa-2x" aria-hidden="true"></i></h4>
                    </div>
         
                  <div class="modal-body" >
                    
                    <div class="panel panel-default">
                    <div class="panel-body">  
                      <h5 align="center"><b>Resumen</b></h5>
                      <h6>Experiencia: <label>Estadia + Experiecia</label> <label style="margin-left: 20px">Tipo :</label> <i class="fa fa-heart" aria-hidden="true"></i></h6>
                      <h6>Precio Total:<label>S/74.50</label></h6>
                      <h6>Anfitrión:<label>Juan Perez</label></h6>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <div align="center">
                    <tr>
                      <td><button  onclick="calificar()" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-frown-o fa-3x" aria-hidden="true"></i></button></td>
                      <td><button  onclick="calificar()"" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-meh-o fa-3x" aria-hidden="true"></i></button></td>
                      <td><button  onclick="calificar()"" class="btn btn-success" data-dismiss="modal"><i class="fa fa-smile-o fa-3x" aria-hidden="true"></i></button></td>
                    
                    </tr>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div><!--Fin del modal del comprador-->


     <!--Carousel para las frutas-->
        <div class="container" hidden="true" id="cExperiencia_2">  
            <div id="myCarousel" class="carousel slide" data-ride="carousel" style=" width: 130px;
            height: 80px;margin-left: 5px" >
            
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
              <div class="item active" style="width: 480px;height: 90px;margin-left: -30px">
                <img src="assets/images/experiencia_estadia/user_01/semana_santa01.jpg" alt="Los Angeles" style="width:30%;margin-left: 5%">
              </div>

              <div class="item" style="width: 480px;height: 90px;margin-left: -30px">
                <img src="assets/images/experiencia_estadia/user_01/semana_santa02.jpg" alt="Chicago" style="width:30%;margin-left: 5%">
              </div>
            
              <div class="item" style="width: 480px;height: 90px;margin-left: -30px">
                <img src="assets/images/experiencia_estadia/user_01/fondo2.jpg" alt="New york" style="width:30%;margin-left: 5%">
              </div>  
            </div>
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev" style="margin-left: -14%">
              <span class="glyphicon glyphicon-chevron-left" style="color:black;font-size: 85%"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next" style="margin-right: -11px">
              <span class="glyphicon glyphicon-chevron-right" style="color:black;font-size: 85%"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
          <h6 align="center" ><b>Semana Santa </b> a 2 Km</h6>
           <h6 style="font-size: 12px"><i class="fa fa-user" aria-hidden="true"></i>Hugo Chavez</h6>
            <h6 style="font-size:13px;margin-top: -5px" align="center"><b>123</b> recomendaciones <i class="fa fa-smile-o" aria-hidden="true"></i></h6>
            <h6 align="center" style="color:blue;font-size: 13px;margin-top: 0px"> Experiencia+Estadia</h6>
      </div>