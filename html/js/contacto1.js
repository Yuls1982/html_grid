function initMap() {
        //para poder coger las coordenadas tenemos que utilizar este servivio
     navigator.geolocation.getCurrentPosition(function (position) {
           //para que nos devuelva las cordenadas de laitud y long de donde yo m,e encuentro
           let latitud = position.coords.latitude;
           let longitud = position.coords.longitude;
           //inicializamos estos dos objetos uno que calcule la ruta y otro que la dibuja
           let directionsService = new google.maps.DirectionsService;//rev
           //este es el que se encarga de dibujar la ruta
           const mapa = document.getElementById('map');
                  
           let directionsDisplay = new google.maps.DirectionsRenderer({suppressMarkers: true});//rev

           let opciones = google.maps.DirectionsRendererOptions;
          //inicio de la ruta 
           let inicio = new google.maps.LatLng(latitud, longitud);//rev
           //final de la ruta
           let final = new google.maps.LatLng(39.47149101444507, -0.37193591567629447);//rev
           //cogemos la caja   39.4713259, -0.3717824                
           const indicaciones = document.getElementById('indicaciones');
         
            
            //let inicio = {lat:41.6516859,lng:-0.930002}; (otra forma de dar coordenadas)
            //caja donde queremos poner el mapa
            let map = new google.maps.Map(mapa, {
            //ponemos el zoom
             zoom: 6,
             //le decimos donde queremos centrar el mapa que el inicio tiene que estar en el centro
             center: inicio

       });

        directionsDisplay.setMap(map);
        directionsDisplay.setPanel(indicaciones);

        //Funcion de calculo de ruta 
        directionsService.route({//rev
            //le pasamos que va a tener un inicio
            origin: inicio,//rev
            //le pasamos que va a tener un final
            destination: final,//rev
            //le pasamos como vamos a ir, si en coche o en moto o a pie
            travelMode: google.maps.TravelMode.DRIVING//rev
        }, function (response, status) {//rev
            //si va todo bien....
            if (status == google.maps.DirectionsStatus.OK) {//rev
                directionsDisplay.setDirections(response);//rev
                

                //response.route.legs.end_address
            } else {//rev
                alert("Error");//rev
            }
        })
        

            var marker = new google.maps.Marker({
                position: final,
                map: map,
                title: "Valencia"
            });
            var marker2 = new google.maps.Marker({
                position: inicio,
                map: map,
                //title: "Valencia"
            });

                //Creamos la ventana
            const contentString =
            '<h1 class="map">Grupo Versatil SL</h1>'+
            '<img src="assets/images/galeria/logove.png" >'+
            '<p><strong>Dirección:</strong> C. del Pintor Sorolla, 21, 46002 València</p>'+
            '<p><strong>Teléfono:</strong> 966 76 86 80</p>';

                //Creamos la ventana
              //  const contentString2 =
                //'<h1 class="map">Masterd</h1>'+
                //'<img src="assets/images/foto.jpg" >'+
                //'<p><strong>Dirección:</strong> C. Bari, 4, 50197 Zaragoza</p>'+
                //'<p><strong>Teléfono:</strong> 976 76 86 80</p>';

            const infowindow = new google.maps.InfoWindow({
                content: contentString,
            });
           // const infowindow2 = new google.maps.InfoWindow({
                //content: contentString2,
           // });

        

            //Creamos un addListener a la marca
            marker.addListener("click",()=>{
                infowindow.open({
                    anchor:marker,
                    mapa:mapa,
                    shouldFocus:false    
                })
            })
            //Creamos un addListener a la marca
            //marker2.addListener("click",()=>{
               // infowindow.open({
                  //  anchor:marker2,
                   // mapa:mapa,
                    //shouldFocus:false    
                //})
            })
                
          

        
        


    //})


        
}
    
 

