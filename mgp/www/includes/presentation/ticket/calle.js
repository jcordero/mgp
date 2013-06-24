

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
			if(ac_callback_busy)
				return;
			var id = $(this.element[0]).attr("id");
			ac_callback_busy = true;
			$(".ui-autocomplete").css("position", "absolute"); // fix IE para que no aparezca en cualquier lado
			$('#'+id.substr(1)).val("");
			$('#'+id.substr(1)).change(); 
			new rem_request(this,function(obj,txt){
				var ret = eval("("+txt+")");
				add(ret);	
				ac_callback_busy = false;
			},"TICKET::CALLE","AutocompleterDataSource",req.term+"|"+id);	
		},
		'open':function() {
			ac.autocomplete("widget").width( ac.width() );
		},
		'select': function(event, ui) {
			event.preventDefault();
			ac.val(ui.item.label);
			var id = ac.attr("id");
			$('#'+id.substr(1)).val(ui.item.value);
			$('#'+id.substr(1)).change();
		},
		'change':function(){
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

