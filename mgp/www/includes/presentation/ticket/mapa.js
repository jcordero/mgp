
var luminariaOnIcon = null;

var luminariaIcon = null;

var luminariaIlegalIcon = null;

var luminariaIlegalOnIcon = null;


function MostrarMapa(id,param_str)
{
    //Recupero los parametros
    //El campo esta en el formulario principal o sobre una tabla?
    var clase = "";
    var params = "";
    if(param_str!=='')
    {
        params = param_str.split('|');
    }
    else
    {
        if(id.substring(0,3)==="hm_" || id.substring(0,2)==="m_")
        {
            // ES UN CAMPO DE UN FORM
            params = eval( id.substring( id.indexOf("_")+1 ) + ".m_params.split('|')" );
        }
        else
        {
            //ES UN CAMPO DENTRO DE UNA TABLA
            //del ID deriva la clase y el orden del campo
            clase = id.substring(4, id.indexOf("_f"));
            var orden = id.substring( id.indexOf("_f")+2);
            params = eval( clase + "_" + orden + ".m_params.split('|')" );
        }
    }

    if(params.length!==2)
    {
        alert_box("No estan declarados los campo asociados al mapa.","Error");
        return;
    }

    //Coordenas
    var objx = document.getElementById("m_"+params[0]);
    var objy = document.getElementById("m_"+params[1]);
	
    if(objx && objy)
    {
        var divmapa = document.getElementById(id);
        var x = objx.value;
        var y = objy.value;
        if(x!=="" && y!=="" && mapa)
        {
            url = sess_web_path + "/common/mapa.php?x=" + x + "&y=" + y + "&w=350&h=250&r=250";
            divmapa.innerHTML = '<img src="' + url + '">';
        }
    }
}

function IniciarMapa(campo,params)
{
    MostrarMapa("m_"+campo,params);
}


function crearMapa3(id) {
    var p = $('#'+id).parent();
    $('#'+id).remove();
    p.append('<div id="' + id + '"></div>');

    var mapOptions = {
        zoom: 20,
        center: new google.maps.LatLng(-38.01696,-57.53720),
        //mapTypeId: google.maps.MapTypeId.ROADMAP
	mapTypeId: 'satellite'
    };
  
    var mapa = new google.maps.Map(document.getElementById(id),mapOptions);
    mapa.setTilt(0);


    //Define custom WMS tiled layer
    var SLPLayer = new google.maps.ImageMapType({
        getTileUrl: function (coord, zoom) {
            var proj = mapa.getProjection();
            var zfactor = Math.pow(2, zoom);
            
            // get Long Lat coordinates
            var top = proj.fromPointToLatLng(new google.maps.Point(coord.x * 256 / zfactor, coord.y * 256 / zfactor));
            var bot = proj.fromPointToLatLng(new google.maps.Point((coord.x + 1) * 256 / zfactor, (coord.y + 1) * 256 / zfactor));

            //corrections for the slight shift of the SLP (mapserver)
            var deltaX =   0.00003;
            var deltaY =  0.00000;

            //create the Bounding box string
            var bbox =     (top.lng() + deltaX) + "," +
                           (bot.lat() + deltaY) + "," +
                           (bot.lng() + deltaX) + "," +
                           (top.lat() + deltaY);
						

            //base WMS URL
            var url = "http://gis.mardelplata.gob.ar/cgi-bin/mapserv?map=/var/www/webservice/wms/servicios.map&";
            url += "&REQUEST=GetMap"; //WMS operation
            url += "&SERVICE=WMS";    //WMS service
            url += "&VERSION=1.1.1";  //WMS version  
            url += "&LAYERS=" + "callesi_4326"; //WMS layers
            url += "&FORMAT=image/png" ; //WMS format
            url += "&BGCOLOR=0xFFFFFF";  
            url += "&TRANSPARENT=TRUE";
            url += "&SRS=EPSG:4326";     //set WGS84 
            url += "&BBOX=" + bbox;      // set bounding box
            url += "&WIDTH=256";         //tile size in google
            url += "&HEIGHT=256";
            return url;                 // return URL for the tile

        },
        tileSize: new google.maps.Size(256, 256),
        isPng: true
    });
  
    mapa.overlayMapTypes.push(SLPLayer);
    
    //Inicializar iconos
    
    return mapa;
}


/** Crea un mapa dinamico
 * 
 * @param {string} id del div donde va el mapa
 * @returns {map}
 */
function crearMapa(id) {
    var p = $('#'+id).parent();
    $('#'+id).remove();
    p.append('<div id="' + id + '"></div>');

    var mapa = new GMap(document.getElementById(id));
    mapa.addControl(new GSmallZoomControl());
    mapa.addControl(new GMapTypeControl());


    mapa.setView = function(latlng,zoom) {
        var point = new GLatLng(latlng[0],latlng[1]);
	mapa.setCenter(point,zoom);
	mapa.setMapType(G_SATELLITE_MAP);
    }
    
    mapa.setView([-38.0086358938483,-57.5388003290637], 16);
    
    var tile_roadless= new GTileLayer(new GCopyrightCollection(""),1,17);
    tile_roadless.myLayers =  'callesi_4326';
    tile_roadless.myMercZoomLevel=5;
    tile_roadless.myFormat='image/png';
    tile_roadless.myBaseURL= 'http://gis.mardelplata.gob.ar/cgi-bin/mapserv?map=/var/www/webservice/wms/servicios.map';
    tile_roadless.getTileUrl=CustomGetTileUrl;		
    tile_roadless.getOpacity = function() {return 1.0;}

    mapa.addControl(new GLargeMapControl());
    //mapa.addControl(new GMapTypeControl());
    var MapserverLayer = new GTileLayerOverlay(tile_roadless);
    mapa.addOverlay(MapserverLayer);
	
    luminariaIcon = new GIcon();
    luminariaIcon.image = sess_web_path+'/images/mapicons/luminaria.png';
    luminariaIcon.iconSize = new GSize(32, 37);
    luminariaIcon.iconAnchor = new GPoint(16, 38);
    luminariaIcon.infoWindowAnchor = new GPoint(-3, 76);

    luminariaOnIcon = new GIcon();
    luminariaOnIcon.image = sess_web_path+'/images/mapicons/luminaria_on.png';
    luminariaOnIcon.iconSize = new GSize(32, 37);
    luminariaOnIcon.iconAnchor = new GPoint(16, 38);
    luminariaOnIcon.infoWindowAnchor = new GPoint(-3, 76);

    luminariaIlegalIcon = new GIcon();
    luminariaIlegalIcon.image = sess_web_path+'/images/mapicons/luminaria_ilegal.png';
    luminariaIlegalIcon.iconSize = new GSize(32, 37);
    luminariaIlegalIcon.iconAnchor = new GPoint(16, 38);
    luminariaIlegalIcon.infoWindowAnchor = new GPoint(-3, 76);
    
    luminariaIlegalOnIcon = new GIcon();
    luminariaIlegalOnIcon.image = sess_web_path+'/images/mapicons/luminaria_ilegal_on.png';
    luminariaIlegalOnIcon.iconSize = new GSize(32, 37);
    luminariaIlegalOnIcon.iconAnchor = new GPoint(16, 38);
    luminariaIlegalOnIcon.infoWindowAnchor = new GPoint(-3, 76);
    
    return mapa;
}

function createMarker( latlng, label, mapa, opts, click_event) {

    if(typeof opts === "undefined")
        opts = { draggable: false };
    
    var point = new GLatLng(latlng[0],latlng[1]);
    var m = new GMarker(point, opts); 
					
    if(typeof click_event === "function")
        GEvent.addListener(m, "click",click_event);
    
    mapa.addOverlay(m);

    return m;
}