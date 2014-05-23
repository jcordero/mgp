//DNI

function valDNI(fldID,fldLabel) {
    $("#"+fldID).val( $("#p"+fldID).val() + ' ' + $("#t"+fldID).val() + ' ' + $("#n"+fldID).val() );
    var fld = $("#n"+fldID);
    if(fld.length===1) {
        var valor = fld.val();
        if(valor==="") {
            return "";
        }
        var re = new RegExp("^[0-9]{6,8}$");
        if( re.test(valor)===true ) {
            return "";
        } else {
            return "El campo " + fldLabel + " debe contener de 6 a 8 digitos sin espacios";   
        }
    } else {
        return "campo " + fldID + " no se encuentra";
    }
}

function toTextDNI(campo,nom) {
    return $('#p'+campo).val()+' '+$('#t'+campo).val()+' '+$('#n'+campo).val();
}

function editDNI(id, valor, jsFld) {
    var p = valor.split(' ');
    if(p.length!==3) {
        return;
    }
    $('#p'+id).val(p[0]);
    $('#t'+id).val(p[1]);
    $('#n'+id).val(p[2]);
}

function initDNI(fld, opt) {
    //Pais
    var pais = $('#pm_'+fld).attr('data-selected');
    pais = (typeof pais=="undefined" || pais=='') ? 'ARG' : pais;
    $('#pm_'+fld).val(pais);
    $('#p'+fld).val(pais);
    
    //Tipo doc
    var tipo = $('#tm_'+fld).attr('data-selected');
    tipo = (typeof tipo=="undefined" || tipo=='') ? 'DNI' : tipo;
    $('#tm_'+fld).val( tipo );
    $('#t'+fld).val( tipo );
    
    //Nro de doc
    var nro = $('#nm_'+fld).attr('data-selected');
    nro = (typeof nro=="undefined" || nro=='') ? $('#nm_'+fld).val() : nro;
    $('#nm_'+fld).val(nro);
    $('#n'+fld).val(nro);
    
    console.log("DNI::initDNI() fld="+fld+" doc="+pais+" "+tipo+" "+nro);
}

function chg_docid(obj) {
    //Documento
    var id = obj.id.substr(1);
    
    //Si el nro esta vacio, no sigo
    var nro = $("#n"+id).val();
    if(nro=="") {
        return;
    }
    var validacion = valDNI(id, 'Documento');
    if(validacion!=='') {
        p4.alert_box(validacion,"Corregir y reintentar");
        return;
    }
    
    //Valor del DNI compuesto
    var doc = $('#'+id).val();
    
    //Consulto el padron
    p4.esperar('Consultado el padrón electoral...');
    new p4.rem_request(this,function(obj,json){
        p4.listo();
        var jdata = JSON.parse(json);
        
        if(jdata.resultado!=='encontrado') {
            p4.alert_box('No se encuentra a la persona en el padrón');
        } else {
            var opt = p4.extractParams(id);
            if(opt) {
                //Completo los campos
                if(opt.nombre){
                    $('#m_'+opt.nombre).val(jdata.nombre);
                }
                if(opt.apellido){
                    $('#m_'+opt.apellido).val(jdata.apellido);
                }
                if(opt.direccion){
                    $('#m_'+opt.direccion).val(jdata.direccion);
                }
                if(opt.genero){
                    $('#m_'+opt.genero).val(jdata.genero);
                }
                if(opt.localidad){
                    $('#m_'+opt.localidad).val(jdata.localidad);
                }
                if(opt.provincia){
                    $('#m_'+opt.provincia).val(jdata.provincia);
                }
                if(opt.barrio){
                    $('#m_'+opt.barrio).val(jdata.barrio);
                }
                if(opt.ocupacion){
                    $('#m_'+opt.ocupacion).val(jdata.ocupacion);
                }
            }
        }
    },'CIUDADANO::DNI','buscarPadron',doc);
}
