function IniciarMapa(id, params) {
    window[id].obj = new mapa_class();    
    window[id].obj.crearMapa("m_" + id);
//    window[id].obj.MostrarMapa("m_" + id, params);
};

function mapa_class() {
    this.ancho = 457;
    this.alto = 374;
    this.id = "";
    this.clase = "";
    this.params = "";
    
    this.MostrarMapa = function (id, param_str) {
        //Recupero los parametros
        if(typeof id!="undefined") {
            this.id = id;
        }
        if(typeof param_str!="undefined") {
            //El campo esta en el formulario principal o sobre una tabla?
            if (param_str!=='') {
                this.params = param_str.split('|');
            } else {
                if (this.id.substring(0, 3) === "hm_" || this.id.substring(0, 2) === "m_") {
                    // ES UN CAMPO DE UN FORM
                    this.params = eval(this.id.substring(this.id.indexOf("_") + 1) + ".m_params.split('|')");
                } else {
                    //ES UN CAMPO DENTRO DE UNA TABLA
                    //del ID deriva la clase y el orden del campo
                    this.clase = this.id.substring(4, this.id.indexOf("_f"));
                    var orden = this.id.substring(this.id.indexOf("_f") + 2);
                    this.params = eval(this.clase + "_" + orden + ".m_params.split('|')");
                }
            }
        }

        if (this.params.length !== 2) {
            p4.alert_box("No estan declarados los campo asociados al mapa.", "Error");
            return;
        }

        //Coordenas
        var objx = document.getElementById("m_" + this.params[0]);
        var objy = document.getElementById("m_" + this.params[1]);

        if (objx && objy) {
            var divmapa = document.getElementById(this.id);
            var x = (objx.value!="" ? objx.value : -37.995114083904);
            var y = (objy.value!="" ? objy.value : -57.544226218087);
            if (x !== "" && y !== "" && divmapa) {
                url = sess_web_path + "/common/mapa.php?x=" + x + "&y=" + y + "&w="+ this.ancho +"&h=" + this.alto + "&r=250";
                divmapa.innerHTML = '<img src="' + url + '">';
            }
        }
    };

  

    this.crearMapa3 = function (id) {
        //var p = $('#' + id).parent();
        //$('#' + id).remove();
        //p.append('<div id="' + id + '"></div>');
        $('#'+id).css({"width":this.ancho+"px","height":this.alto+"px"});
        var mapOptions = {
            zoom: 16,
            center: new google.maps.LatLng(-38.01696, -57.53720),
            //mapTypeId: google.maps.MapTypeId.ROADMAP
            mapTypeId: 'satellite'
        };

        var mapa = new google.maps.Map(document.getElementById(id), mapOptions);
        mapa.setTilt(0);

        google.maps.event.addListener(mapa, 'dragend', this.drag_event);

        //Define custom WMS tiled layer
        var SLPLayer = new google.maps.ImageMapType({
            getTileUrl: function(coord, zoom) {
                var proj = mapa.getProjection();
                var zfactor = Math.pow(2, zoom);

                // get Long Lat coordinates
                var top = proj.fromPointToLatLng(new google.maps.Point(coord.x * 256 / zfactor, coord.y * 256 / zfactor));
                var bot = proj.fromPointToLatLng(new google.maps.Point((coord.x + 1) * 256 / zfactor, (coord.y + 1) * 256 / zfactor));

                //corrections for the slight shift of the SLP (mapserver)
                var deltaX = 0.00003;
                var deltaY = 0.00000;

                //create the Bounding box string
                var bbox = (top.lng() + deltaX) + "," +
                        (bot.lat() + deltaY) + "," +
                        (bot.lng() + deltaX) + "," +
                        (top.lat() + deltaY);


                //base WMS URL
                var url = "http://gis.mardelplata.gob.ar/cgi-bin/mapserv?map=/var/www/webservice/wms/servicios.map&";
                url += "&REQUEST=GetMap"; //WMS operation
                url += "&SERVICE=WMS";    //WMS service
                url += "&VERSION=1.1.1";  //WMS version  
                url += "&LAYERS=" + "callesi_4326"; //WMS layers
                url += "&FORMAT=image/png"; //WMS format
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
    };


    /** Crea un mapa dinamico
     * 
     * @param {string} id del div donde va el mapa
     * @returns {map}
     */
    this.crearMapa = function (id) {

        return this.crearMapa3(id);
    };

    this.createMarker = function (latlng, label, mapa, icon, click_event, index) {

        if (typeof opts === "undefined") {
            opts = {draggable: false};
        }
        var point = new google.maps.LatLng(latlng[0], latlng[1]);
        var m = new google.maps.Marker({map: mapa, position: point, title: label});

        if (typeof click_event === "function") {
            google.maps.event.addListener(m, 'click', click_event);
        }
        if (typeof icon === "string"){
            m.setIcon(icon);
        }
        if (typeof index !== "undefined"){
            m.lum_index = index;
        }
        return m;
    };

    this.drag_event = function () {
        console.log("evento drag " + (new Date()).getTime());
    };
}