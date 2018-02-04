
  //var directionDisplay;
  //var directionsService = new google.maps.DirectionsService();
  var map;
  var origin = null;
  var destination = null;
  var waypoints = [];
  var markers = [];
  var listenerHandle;
  //var directionsVisible = false;

function addMaker() {

  //document.getElementById('Puntos').style.background-color = '#C5FE80';
	
	//if (remove == "1" ) {
if(listenerHandle)google.maps.event.removeListener(listenerHandle);
listenerHandle =  google.maps.event.addListener(map, 'click', function(event) {
      if (origin == null) {
        origin = event.latLng;
       // console.log(origin);
        addMarker(origin);
      } else if (destination == null) {
        destination = event.latLng;
        addMarker(destination);
      } else {
        if (waypoints.length < 9) {
          waypoints.push({ location: destination, stopover: true });
          destination = event.latLng;
          addMarker(destination);
        } else {
          alert("Numero Maximo de Puntos");
        }
      }
    });
		
	//}
}

//FUNCION ADD MARKERS
function addMarker(latlng) {


    var marker = new google.maps.Marker({
      position: latlng, 
      draggable:true,
      map: map,
      orden: markers.length+1,
      icon: "http://maps.google.com/mapfiles/marker" + String.fromCharCode(markers.length + 65) + ".png"
    });

    google.maps.event.addListener(marker, 'dragend', function() {
      if(marker.orden==1){
        $("#origen").val(markers[0].getPosition().lat().toFixed(5)+','+markers[0].getPosition().lng().toFixed(5)).trigger("change");
      }else if(markers.length == marker.orden){
        $("#destino").val(markers[markers.length-1].getPosition().lat().toFixed(5)+','+markers[markers.length-1].getPosition().lng().toFixed(5)).trigger("change");
      }
    });

    markers.push(marker);

//    console.log(markers[0].getPosition().lat());    
    if(markers.length==1){
      $("#origen").val(markers[0].getPosition().lat().toFixed(5)+','+markers[0].getPosition().lng().toFixed(5)).trigger("change");
    }else{
      $("#destino").val(markers[markers.length-1].getPosition().lat().toFixed(5)+','+markers[markers.length-1].getPosition().lng().toFixed(5)).trigger("change");
    }


  }

//FUNCION VALIDA
function calcRoute() {
    if ($("#origen").val() == "") {
      alert("Haga Click en el Mapa para Crear un Punto de Inicio");
      return;
    }
    
    if ($("#destino") == "") {
      alert("Haga Click en el Mapa para Crear un Punto de Fin");
      return;
    }
    var mode;
    mode = google.maps.DirectionsTravelMode.DRIVING;
     
    var request = {
        origin: $("#origen").val(),
        destination: $("#destino").val(),
        waypoints: waypoints,
        travelMode: mode,
        optimizeWaypoints: true
        //avoidHighways: document.getElementById('highways').checked,
        //avoidTolls: document.getElementById('tolls').checked
    };
    
    directionsService.route(request, function(response, status) {
      if (status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(response);
		    console.log('directionsService.route');
        computeTotalDistance(directionsDisplay.directions);
      }
    });
    
    clearMarkers();
    directionsVisible = true;
  }



//FUNCION VALIDA
function calcRoute2() {

  var origen1=document.getElementById("origen1").value;
  var origen2=document.getElementById("origen2").value;

  var destino1=document.getElementById("destino1").value;
  var destino2=document.getElementById("destino2").value;
  
    if(origen1=='' || origen2=='' || destino1=='' || destino2==''){
      alert("Debe llenar todos los campos");
    } 
    else{

  if( origen1<-90 || origen1>90 || destino1<-90 ||destino1>90){
    alert("La Latitud(X) debe estar en -90 y 90, vuelva a ingresar");
  } 
  else{
    if(origen2<-180 || origen2>180 ||  destino2<-180 || destino2>180){
      alert("La Longitud(Y) debe estar entre -180 y 180, vuelva a ingresar");
    }
    else{
      console.log("exito");
      var origen=(origen1.concat(",")).concat(origen2);
  var destino=(destino1.concat(",")).concat(destino2);

  /*
    if ($("#origen1").val() == "" || $("#origen2").val() == ""  ) {
      alert("Ingresa una coordenada de inicio correcta");
      return;
    }
    
    if ($("#destino1").val() == "" || $("#destino2").val() == "") {
      alert("Ingresa una coordenada de fin correcta");
      return;
    }*/
    var mode;
    mode = google.maps.DirectionsTravelMode.DRIVING;
     
    
    var request = {
        origin: origen,  //Agregado por Steve
        destination: destino, //Agregado por Steve
        waypoints: waypoints,
        travelMode: mode,
        optimizeWaypoints: true
        //avoidHighways: document.getElementById('highways').checked,
        //avoidTolls: document.getElementById('tolls').checked
    };
    
    directionsService.route(request, function(response, status) {
      if (status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(response);
        // console.log(directionsDisplay.directions);
        console.log('directionsService.route');
        computeTotalDistance(directionsDisplay.directions); //distancia
      }
    });
    
    clearMarkers();
    directionsVisible = true;
    }
  }
  
    }
  }
  
  function updateMode() {
    if (directionsVisible) {
      calcRoute();
    }
  }
  
  function clearMarkers() {
    for (var i = 0; i < markers.length; i++) {
      markers[i].setMap(null);
    }
  }
  
  function clearWaypoints() {
    markers = [];
    origin = null;
    destination = null;
    waypoints = [];
    directionsVisible = false;
  }
  function reset() {
    $("#genGeocerca").prop('disabled',true);
    $("#calcruta").css("background-color", "buttonface");
    $("#Puntos").css("background-color", "buttonface");
    $("#Coordenadas").css("background-color", "buttonface");
    $("#Mensaje2").prop('hidden',true);
    $("#Mensaje1").prop('hidden',true);
    $("#origen").val("");
    $("#destino").val("");
    $("#origen1").val("");
    $("#destino1").val("");
    $("#origen2").val("");
    $("#destino2").val("");
    
    sss='';
    clearMarkers();
    clearWaypoints();
//    console.log(markers);
    directionsDisplay.setMap(null);
    directionsDisplay.setPanel(null);
    directionsDisplay = new google.maps.DirectionsRenderer({draggable: true});
    directionsDisplay.setMap(map);
    directionsDisplay.setPanel(document.getElementById("directionsPanel"));
	   document.getElementById("total").innerHTML = "0" + " km";
      

 }
  
  function computeTotalDistance(result) {
    ///console.log(result);
  var lineCoordinates=[];
  var sep='';
  sss='';
  var total = 0;
  var myroute = result.routes[0];

      for (k = 0; k < myroute.overview_path.length; k++) {
        sss = sss+sep+myroute.overview_path[k].lng().toFixed(5)+' '+myroute.overview_path[k].lat().toFixed(5);
        sep = ',';
//        lineCoordinates.push(new google.maps.LatLng(myroute.overview_path[k].lat().toFixed(5), myroute.overview_path[k].lng().toFixed(5)));
      }
  for (i = 0; i < myroute.legs.length; i++) {
//     console.log(myroute.legs);
    total += myroute.legs[i].distance.value;
  }

  total = total / 1000;
  if(total>0){
    $("#genGeocerca").prop('disabled',false)
  }else{
    $("#genGeocerca").prop('disabled',true)
  }
//	document.getElementById("total").innerHTML = "0" + " km";
	document.getElementById("total").innerHTML = total + " km";

  //console.log(sss);
  //alert('<p>Total Distance: <span id="total"></span></p>');
//console.log(sss);
/*
var flightPath = new google.maps.Polyline({
    path: lineCoordinates,
    strokeColor: '#FF0000',
    strokeOpacity: 1.0,
    strokeWeight: 3
  });  
flightPath.setMap(map);
*/
}
