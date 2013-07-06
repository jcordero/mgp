
var g_calles = {};
var loading_calle = false;

function calle_init(id, params)
{
    var ac_callback_busy = false;
	
    //Esto es para limpiar el input toda vez que se utilice.
    if ($('#'+id).length) {
       $('#'+id).val('');
       $('#h'+id).val('');
    }
	
    var ac = $("#hm_"+id);
    if(ac.length===0)
        ac = $("#h"+id);
	
    ac.autocomplete({
		'source':function ac_callback(req,callback) {
                        //Hay una consulta en curso... no solapo consultas    
			if(ac_callback_busy) {
                            callback([]);
                            return;
                        } else {            
                            ac_callback_busy = true;
                        }
                        console.log("calle source. inicio busqueda de: "+req.term);
                            
                        //Tengo el callejero listo?
                        if(typeof g_calles.calles!=="undefined") {
                            //Busco los registros que coincidan
                            var ret = [];
                            var calle = req.term.toUpperCase();
                            for(var j=0;j<g_calles.calles.length;j++) {
                                if( g_calles.calles[j].indexOf(calle)!==-1 ) {
                                    ret.push({"value":g_calles.codigos[j],"label":g_calles.calles[j]});
                                }
                            }
                            callback(ret);	
                            ac_callback_busy = false;
                        }
                        else
                        {
                            var id = $(this.element[0]).attr("id");
                            $(".ui-autocomplete").css("position", "absolute"); // fix IE para que no aparezca en cualquier lado
                            $('#'+id.substr(1)).val("");
                            $('#'+id.substr(1)).change(); 
                            new rem_request(this,function(obj,txt){
                                    //Retorna array [{value:10,label:"SAN MARTIN"},{..},...]
                                    var ret = JSON.parse(txt);
                                    callback(ret);	
                                    ac_callback_busy = false;
                            },"TICKET::CALLE","AutocompleterDataSource",req.term+"|"+id);
                        }
		},
		'open':function() {
                        console.log("calle open");
			ac.autocomplete("widget").width( ac.width() );
		},
		'select': function(event, ui) {
                        console.log("calle select: value="+ui.item.value+" label="+ui.item.label);
			event.preventDefault();
			ac.val(ui.item.label);
			var id = ac.attr("id");
			$('#'+id.substr(1)).val(ui.item.value);
			$('#'+id.substr(1)).change();
		},
		'change':function(){
                        console.log("calle change:"+ac.val());
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
        
        //Si soporta HTML5 hago un load local del callejero
        if(typeof Storage !=="undefined")
        {
            if(loading_calle)
                return;
            
            loading_calle = true;
            var key = "";
            
            //Pido la lista de calles si el key no es valido. Determino la key
            if(typeof localStorage.mgp_callejero == "string") {
                g_calles = JSON.parse(localStorage.mgp_callejero);
                if(typeof g_calles.key == "string")
                    key = g_calles.key;
            }
            
            new rem_request(this,function(obj,txt) {
                if(txt!="OK") {
                    localStorage.mgp_callejero = txt;
                    g_calles = JSON.parse(localStorage.mgp_callejero);
                }
            },"TICKET::CALLE","getCallejero",key);    
                            
        }
}

function calle_totext(objId)
{
    var inp2 = $("#h"+objId);
    return inp2.val();
}

function calle_edit(id, valor, jsFld) {
    var ac = $("#hm_"+id);
    if(ac.length===0)
            ac = $("#h"+id);
    ac.val(valor);
}

function buscar_calles() {
    
}
