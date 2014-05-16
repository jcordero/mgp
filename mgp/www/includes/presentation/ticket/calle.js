
function calle_class() {
    
    this.g_calles = {};
    this.loading_calle = false;

    this.init = function(id, params) {
        var ac_callback_busy = false;

        //Esto es para limpiar el input toda vez que se utilice.
        if ($('#'+id).length) {
           $('#'+id).val('');
           $('#h'+id).val('');
        }

        var ac = $("#hm_"+id);
        if(ac.length===0){
            ac = $("#h"+id);
        }
        var obj = this;
        ac.autocomplete({
            'source':function ac_callback(req,callback) {
                //El termino por lo menos tiene 3 letras?
                //Hay una consulta en curso... no solapo consultas    
                if(ac_callback_busy || req.term.length<3) {
                    callback([]);
                    return;
                } else {            
                    ac_callback_busy = true;
                }
                //console.log("calle source. inicio busqueda de: "+req.term);

                //Tengo el callejero listo?
                if(typeof obj.g_calles.calles!=="undefined") {
                    //Busco los registros que coincidan
                    var ret = [];
                    var calle = req.term.toUpperCase();
                    for(var j=0;j<obj.g_calles.calles.length;j++) {
                        if( obj.g_calles.calles[j].indexOf(calle)!==-1 ) {
                            ret.push({
                                "value":obj.g_calles.codigos[j],
                                "label":obj.g_calles.calles[j]}
                            );
                        }
                    }
                    callback(ret);	
                    ac_callback_busy = false;
                } else {
                    //No existe el callejero local
                    var id = $(this.element[0]).attr("id");
                    $(".ui-autocomplete").css("position", "absolute"); // fix IE para que no aparezca en cualquier lado
                    $('#'+id.substr(1)).val("");
                    $('#'+id.substr(1)).change(); 
                    new p4.rem_request(this,function(obj,txt){
                            //Retorna array [{value:10,label:"SAN MARTIN"},{..},...]
                            var ret = JSON.parse(txt);
                            callback(ret);	
                            ac_callback_busy = false;
                    },"TICKET::CALLE","AutocompleterDataSource",req.term+"|"+id);
                }
            },
            'open':function() {
                //console.log("calle open");
                ac.autocomplete("widget").width( ac.width() );
            },
            'select': function(event, ui) {
                //console.log("calle select: value="+ui.item.value+" label="+ui.item.label);
                event.preventDefault();
                ac.val(ui.item.label);
                var id = ac.attr("id");
                $('#'+id.substr(1)).val(ui.item.value+"|"+ui.item.label);
                $('#'+id.substr(1)).change();
            },
            'change':function(){
                //console.log("calle change:"+ac.val());
                if( ac.val().length===0 ) {
                    var id = ac.attr("id"); 
                    $('#'+id.substr(1)).val(""); 
                    $('#'+id.substr(1)).change();
                }
            }
        });

        ac.bind("keyup.autocomplete", function(event, ui) { 
            if (ac.val().length === 0) { 
                var id = ac.attr("id"); 
                $('#'+id.substr(1)).val(""); 
                $('#'+id.substr(1)).change(); 
            }         
        });

        //Si soporta HTML5 Storage, hago un load del callejero desde la base de datos del navegador
        if(typeof Storage !=="undefined") {
            if(this.loading_calle) {
                return;
            }

            this.loading_calle = true;
            var key = "";

            //Existe una version del callejero en este navegador?
            if(typeof localStorage.mgp_callejero == "string") {
                //Cargo el callejero
                try {
                    this.g_calles = JSON.parse(localStorage.mgp_callejero);
                    //Recupero el hash de la version del callejero local
                    if(typeof this.g_calles.key == "string") {
                        key = this.g_calles.key;
                    }
                } catch (e) {
                    console.error("No se puede recuperar el callejero desde el local storage! * "+e);
                }
            }

            //Consulto al backend si necesito actualizar la base de datos del callejero
            new p4.rem_request(this,function(obj,txt) {
                //Si el backend contesta OK, la base esta actualizada. Caso contrario envia la version nueva
                if(txt!="OK") {
                    localStorage.mgp_callejero = txt;
                    obj.g_calles = JSON.parse(localStorage.mgp_callejero);
                }
            },"TICKET::CALLE","getCallejero",key);    
        }
    };

    this.calle_totext = function(objId) {
        var inp2 = $("#h"+objId);
        return inp2.val();
    };

    this.calle_edit = function(id, valor, jsFld) {
        var ac = $("#hm_"+id);
        if(ac.length===0)
                ac = $("#h"+id);
        ac.val(valor);
    };

    this.buscar_calles = function() {

    };
}

//TODO hay que crear el componente dentro del objeto que representa al campo dentro del form
var calle_obj = null;
function calle_init(id, params) {
    calle_obj = new calle_class();
    calle_obj.init(id,params);
}