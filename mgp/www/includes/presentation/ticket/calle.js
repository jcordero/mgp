

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
		'source':function ac_callback(req,add) {
                        console.log("calle source");

			if(ac_callback_busy)
				return;
			var id = $(this.element[0]).attr("id");
			ac_callback_busy = true;
                        console.log("calle source. inicio busqueda de: "+req.term);

			$(".ui-autocomplete").css("position", "absolute"); // fix IE para que no aparezca en cualquier lado
			$('#'+id.substr(1)).val("");
			$('#'+id.substr(1)).change(); 
			new rem_request(this,function(obj,txt){
				var ret = JSON.parse(txt);
				add(ret);	
				ac_callback_busy = false;
			},"TICKET::CALLE","AutocompleterDataSource",req.term+"|"+id);	
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

