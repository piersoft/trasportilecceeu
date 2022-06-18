<?php

$lat=$_GET["lat"];
$lon=$_GET["lon"];
$r=$_GET["r"];

?>

<!DOCTYPE html>
<html lang="it">
  <head>
  <title>Trasporti Lecce</title>
  <link rel="apple-touch-icon" sizes="57x57" href="https://www.piersoft.it/covid19/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="https://www.piersoft.it/covid19/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="https://www.piersoft.it/covid19/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="https://www.piersoft.it/covid19/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="https://www.piersoft.it/covid19/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="https://www.piersoft.it/covid19/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="https://www.piersoft.it/covid19/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="https://www.piersoft.it/covid19/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="https://www.piersoft.it/covid19/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="https://www.piersoft.it/covid19/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="https://www.piersoft.it/covid19/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="https://www.piersoft.it/covid19/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="https://www.piersoft.it/covid19/favicon-16x16.png">
  <link rel="stylesheet" href="http://necolas.github.io/normalize.css/2.1.3/normalize.css" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.5/leaflet.css" />
   <link rel="stylesheet" href="http://turbo87.github.io/leaflet-sidebar/src/L.Control.Sidebar.css" />
   <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="MarkerCluster.css" />
        <link rel="stylesheet" href="MarkerCluster.Default.css" />
        <meta property="og:image" content="http://www.piersoft.it/trasportilecceeu/bus_.png"/>
  <script src="http://cdn.leafletjs.com/leaflet-0.7.5/leaflet.js"></script>
<script src="http://turbo87.github.io/leaflet-sidebar/src/L.Control.Sidebar.js"></script>
   <script src="leaflet.markercluster.js"></script>
   <script src="http://joker-x.github.io/Leaflet.geoCSV/lib/jquery.js"></script>
   <meta property="og:image" content="http://www.piersoft.it/trasportilecceeu/bus_.png"/>

<script type="text/javascript">

function microAjax(B,A){this.bindFunction=function(E,D){return function(){return E.apply(D,[D])}};this.stateChange=function(D){if(this.request.readyState==4 ){this.callbackFunction(this.request.responseText)}};this.getRequest=function(){if(window.ActiveXObject){return new ActiveXObject("Microsoft.XMLHTTP")}else { if(window.XMLHttpRequest){return new XMLHttpRequest()}}return false};this.postBody=(arguments[2]||"");this.callbackFunction=A;this.url=B;this.request=this.getRequest();if(this.request){var C=this.request;C.onreadystatechange=this.bindFunction(this.stateChange,this);if(this.postBody!==""){C.open("POST",B,true);C.setRequestHeader("X-Requested-With","XMLHttpRequest");C.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");C.setRequestHeader("Connection","close")}else{C.open("GET",B,true)}C.send(this.postBody)}};
function microAjax2(B,A){this.bindFunction=function(E,D){return function(){return E.apply(D,[D])}};this.stateChange=function(D){if(this.request.readyState==4 ){this.callbackFunction(this.request.responseText)}};this.getRequest=function(){if(window.ActiveXObject){return new ActiveXObject("Microsoft.XMLHTTP")}else { if(window.XMLHttpRequest){return new XMLHttpRequest()}}return false};this.postBody=(arguments[2]||"");this.callbackFunction=A;this.url=B;this.request=this.getRequest();if(this.request){var C=this.request;C.onreadystatechange=this.bindFunction(this.stateChange,this);if(this.postBody!==""){C.open("POST",B,true);C.setRequestHeader("X-Requested-With","XMLHttpRequest");C.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");C.setRequestHeader("Connection","close")}else{C.open("GET",B,true)}C.send(this.postBody)}};

</script>
  <style>

  #mapdiv{
        position:fixed;
        top:0;
        right:0;
        left:0;
        bottom:0;
        font-family: Titillium Web, Arial, Sans-Serif;
        z-index: -1;
}
#logo{
position:fixed;
top:10px;
left:50px;
z-index: 0;
// border-radius: 5px;
//      -moz-border-radius: 5px;
//    -webkit-border-radius: 5px;
//    border: 2px solid #808080;
//    background-color:#fff;
//    padding:2px;
//    box-shadow: 0 3px 14px rgba(0,0,0,0.4)

}
div.circlered {
	/* IE10 */
background-image: -ms-linear-gradient(top right, red 0%, black 100%);

/* Mozilla Firefox */
background-image: -moz-linear-gradient(top right, red 0%, black 100%);

/* Opera */
background-image: -o-linear-gradient(top right, red 0%, black 100%);

/* Webkit (Safari/Chrome 10) */
background-image: -webkit-gradient(linear, right top, left bottom, color-stop(0, red), color-stop(1,black));

/* Webkit (Chrome 11+) */
background-image: -webkit-linear-gradient(top right, red 0%, black 100%);

/* Regola standard */
background-image: linear-gradient(top right, red 0%, black 100%);
    background-color: red;
    border-color: black;
    border-radius: 50px;
    border-style: solid;
    border-width: 1px;
	font-color: white;
    width:5px;
    height:5px;
}
#infodiv{
background-color: rgba(255, 255, 255, 0.6);

font-family: Titillium Web, Arial, Sans-Serif;
padding: 0px;

z-index: 0;
font-size: 10px;
bottom: 12px;
left:0px;


max-height: 60px;

position: fixed;

overflow-y: hidden;
overflow-x: hidden;
}
#loader {
    position:absolute; top:0; bottom:0; width:100%;
    background:rgba(255, 255, 255, 0.9);
    transition:background 1s ease-out;
    -webkit-transition:background 1s ease-out;

}
#loader.done {
    background:rgba(255, 255, 255, 0);
}
#loader.hide {
    display:none;
}
#loader .message {
    position:absolute;
    left:50%;
    top:50%;
}
p.pic {
    width: 48px;
    margin-right: auto;
    margin-left: 18px;
}

        .lorem {
            font-style: Titillium Web;
            color: #AAA;
        }
#sidebar {

position:fixed;
z-index:0;

}
.overlay {
  position: fixed;
  width: 100%;
  height: 100%;
  z-index: 999; /* sidebar must have z-index > 999 */
  background: white;
  opacity: 0; /* or background set to rgba(255, 255, 255, 0); */
}

</style>
  </head>

<body>

  <div data-tap-disabled="true">

 <div id="mapdiv"></div>

<div id="infodiv" style="leaflet-popup-content-wrapper">
  <p><b>Trasporti SGM Comune di Lecce<br></b>
  Mappa con fermate, linee e orari dei Bus dei TPL della <a href="https://www.sgmlecce.it/">SGM spa</a>.</br><a href="https://github.com/piersoft/trasportilecceeu"> GitHub by @piersoft.</a>. GTFS Lic. CC-BY <a href="http://dati.comune.lecce.it/dataset/trasporto-pubblico-locale">OpenData Comune di Lecce</a></p>
</div>
<div id="logo" style="leaflet-popup-content-wrapper">
<a href="https://www.piersoft.it/trasportilecceeu/" target="_blank"><img src="logo.png" width="40px" title="localizzami" alt="localizzami"></a>
</div>
<div id="sidebar">

</div>
<div id='loader'><span class='message'><p class="pic"><img src="http://www.piersoft.it/trasportilecceeu/ajax-loader3.gif"></p></span></div>
</div>
<script type="text/javascript">
</script>
<script language="javascript" type="text/javascript">
<!--

// -->
</script>
  <script type="text/javascript">
  var fermatadipinta="";
  var dataLayer = new L.geoJson();
    var lat='<?php printf($_GET['lat']); ?>',
        lon='<?php printf($_GET['lon']); ?>',
        zoom=18;

        var Esri_WorldImagery = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
              	attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
              });
        var osm = new L.TileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {maxZoom: 18, attribution: 'Map Data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors.'});

        var map = new L.Map('mapdiv', {
            editInOSMControl: true,
            editInOSMControlOptions: {
                position: "topright"
            },
            center: new L.LatLng(lat, lon),
            zoom: zoom,
            layers: [osm]
        });

        var baseMaps = {
    "OpenStreetMap": osm,
    "Esri": Esri_WorldImagery
        };

    var sidebar = L.control.sidebar('sidebar', {
          closeButton: true,
          position: 'right'
      });
      map.addControl(sidebar);
      map.addLayer(dataLayer);
        L.control.layers(baseMaps).addTo(map);
        var markeryou = L.marker([parseFloat('<?php printf($_GET['lat']); ?>'), parseFloat('<?php printf($_GET['lon']); ?>')]).addTo(map);
        markeryou.bindPopup("<b>Sei qui</b>");
       var ico=L.icon({iconUrl:'circle.png', iconSize:[25,25],iconAnchor:[12,12]});
       var markers = L.markerClusterGroup({disableClusteringAtZoom:18, spiderfyOnMaxZoom: true, showCoverageOnHover: true,zoomToBoundsOnClick: true});

       var marker = new L.marker([lat,lon],{
           draggable: true
       }).addTo(map);


       marker.on("drag", function(e) {
           var marker = e.target;
           var position = marker.getLatLng();
           window.open("locator.php?lat="+position.lat+"&lon="+position.lng,"_self");
          // map.panTo(new L.LatLng(position.lat, position.lng));
       });

        function loadLayer(url)
        {
                var myLayer = L.geoJson(url,{
                        onEachFeature:function onEachFeature(feature, layer) {
                                if (feature.properties && feature.properties.id) {

                                }

                        },
                        pointToLayer: function (feature, latlng) {
                          var classs='circlered';

                        var marker = new L.Marker(latlng, { icon: L.divIcon({
                          className : classs,
                                          iconSize : [25,25],
                      html: '<div style="display: table; height:'+25+'px; overflow: hidden; "><div align="center" style="display: table-cell; vertical-align: middle;"><div style="width:'+25+'px;"><font color="white">'+feature.properties.stop_code+'</font></div></div></div>'}),
                                          title: 'ID Fermata: '+feature.properties.stop_code
                                        });


                                        //console.log(feature.properties.stop_id);

                      markers[feature.properties.id] = marker;

                        marker.bindPopup('',{maxWidth:50, autoPan:true});

                        return marker;
                      //  }
              //  });
            },
            firstLineTitles: true
          });
                //map.addLayer(myLayer);
                markers.addLayer(myLayer);
                map.addLayer(markers);

                  markers.fire('click');

                markers.on('popupopen', function(e){

                  map.closePopup();
                  sidebar.getCloseButton();
                //  sidebar.hide();
                  var idfermata;
                //  var stop_ids;
                  if ('<?php printf($_GET['idfermata']); ?>' !='') {
                    idfermata='<?php printf($_GET['idfermata']); ?>';

                }
                fermatadipinta="";
                var stop_ids=e.popup._source.feature.properties.stop_ids;

                var marker = e.popup._source.feature.properties.stop_id;


                  var name = e.popup._source.feature.properties.stop_name;
                  //console.log("name: "+name);
                  var stop_arrives=e.popup._source.feature.properties.stop_arrives;
                  var trip_ids=e.popup._source.feature.properties.trip_ids;
                  var route_short_namer=e.popup._source.feature.properties.route_short_namer;
                  var route_long_namer=e.popup._source.feature.properties.route_long_namer;
                  var route_idr=e.popup._source.feature.properties.route_idr;
                  var service_idc=e.popup._source.feature.properties.service_idc;
                  var trip_idt=e.popup._source.feature.properties.trip_idt;
                  var service_idt=e.popup._source.feature.properties.service_idt;
                  var route_idt=e.popup._source.feature.properties.route_idt;
                  var calendar_monday=e.popup._source.feature.properties.calendar_monday;
                  var start_date=e.popup._source.feature.properties.start_date;
                  var end_date=e.popup._source.feature.properties.end_date;

                  fermatadipinta=e.popup._source.feature.properties.stop_code;
                  console.log(fermatadipinta+" "+name);

                //  console.log(marker+" "+name+" calendar monday"+calendar_monday+"startdate"+start_date+" enddate "+ end_date+" stopid:"+stop_ids);


                var contenedor=document.getElementById('sidebar');
                contenedor.innerHTML = '';
                if(fermatadipinta == '')
                {
                  contenedor.innerHTML = '';
                } else{


                  document.getElementById('infodiv').style.visibility = "hidden";
                  document.getElementById('logo').style.visibility = "hidden";
                  map.closePopup();
                  sidebar.getCloseButton();
                  console.log(fermatadipinta+" dentro la sidebar "+name);

                  // sidebar.getCloseButton();
                //  document.getElementById('map').style.visibility = "hidden";
              //    contenedor.innerHTML = '<b>  Fermata: '+name+'</b>, <b>Palina numero: '+fermatadipinta+'</b> </BR>arrivi pianificati nella prossima ora:</br>';
                 contenedor.innerHTML += '<iframe width="180%" height="600" src="tmpf.php?id='+fermatadipinta+'&sname='+name+'" frameborder="0" allowfullscreen></iframe>';
                //  contenedor.innerHTML += '<iframe width="180%" height="550" src="tmp.php?id='+fermatadipinta+'&sname='+name+'&stop_ids='+stop_ids+'&stop_arrives='+stop_arrives+'&trip_ids='+trip_ids+'&route_short_namer='+route_short_namer+'&route_long_namer='+route_long_namer+'&route_idr='+route_idr+'&service_idc='+service_idc+'&trip_idt='+trip_idt+'&service_idt='+service_idt+'&route_idt='+route_idt+'&calendar_monday='+calendar_monday+'&start_date='+start_date+'&end_date='+end_date+'" frameborder="0" allowfullscreen></iframe>';
                  contenedor.innerHTML += '<b>  <a width="100%" href="fermata.php?id='+fermatadipinta+'&name='+name+'">Link permanente alla Palina: '+fermatadipinta+'</a></b>';

                  sidebar.show();
                }
                //finishedLoadinglong(corse);
              });




              //  markers.addLayer(myLayer);
              //  map.addLayer(markers);
              //  markers.on('click',MostrarVideo(feature.properties.stop_code));
        }


        microAjax('json/mappaf.json',function (res) {
        var feat=JSON.parse(res);
        loadLayer(feat);
        //route();
          finishedLoading();
        } );



  function startLoading() {
    loader.className = '';
  }

  function finishedLoading() {
    // first, toggle the class 'done', which makes the loading screen
    // fade out
    loader.className = 'done';
    setTimeout(function() {
        // then, after a half-second, add the class 'hide', which hides
        // it completely and ensures that the user can interact with the
        // map again.
        loader.className = 'hide';
    }, 500);
  }
      sidebar.on('show', function () {
        //  console.log('Sidebar will be visible.');
      });

      sidebar.on('shown', function () {
        fermatadipinta="";

      //    console.log('Sidebar is visible.');
      });

      sidebar.on('hide', function () {
      //    console.log('Sidebar will be hidden.');
      fermatadipinta="";
      document.getElementById('infodiv').style.visibility = "visible";
      document.getElementById('logo').style.visibility = "visible";
        document.getElementById('map').style.visibility = "visible";
      });

      sidebar.on('hidden', function () {
      //    console.log('Sidebar is hidden.');
      });

      L.DomEvent.on(sidebar.getCloseButton(), 'click', function () {
      //    console.log('Close button clicked.');
        //  location.reload();
      });

      function addDataToMapUCL(data, map) {
        var dataLayer1 = L.geoJson(data,{

              onEachFeature: function(feature, layer) {
                var popupString = '<div class="popup">';
                var direzione="ANDATA";
                if (feature.properties.direction_id ==1) direzione="RITORNO";
                  popupString += '<b>Numero: </b>' + feature.properties.name + '<br />';
                  popupString += '<b>Linea: </b>' + feature.properties.route_long_name + '<br />';
                  popupString += '<b>Direzione: </b> ' + direzione + '<br />';

                                  //  for (var k in feature.properties) {
                                  //      var v = feature.properties[k];
                                  //      popupString += '<b>'+k + '</b>: ' + v + '<br />';
                                  //  }
                  popupString += '</div>';
                  layer.bindPopup(popupString);
              layer.setStyle({
               weight: 5,
               opacity: 0.7,
               color: '#'+feature.properties.route_color,
               dashArray: '3',
               fillOpacity: 0.3,
               fillColor: '#000000'
              })
              //console.log(feature.properties.routes_route_color);
              }

              });
          dataLayer1.addTo(map);

      }

      $.getJSON("json/routes.geojson", function(data) { addDataToMapUCL(data, map); });

  </script>

  </body>
  </html>
