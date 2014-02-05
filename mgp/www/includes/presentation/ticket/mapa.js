


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
    
    return mapa;
}


/** Crea un mapa dinamico
 * 
 * @param {string} id del div donde va el mapa
 * @returns {map}
 */
function crearMapa(id) {
  
    return crearMapa3(id);
}

function createMarker( latlng, label, mapa, icon, click_event, index) {

    if(typeof opts === "undefined")
        opts = { draggable: false };
    
    var point = new google.maps.LatLng(latlng[0],latlng[1]);
    var m = new google.maps.Marker({map:mapa, position:point, title:label}); 
					
    if(typeof click_event === "function")
        google.maps.event.addListener(m, 'click', click_event);
    
    if(typeof icon === "string")
        m.setIcon(icon);
    
    if(typeof index !== "undefined")
        m.lum_index = index;
         
    return m;
}
