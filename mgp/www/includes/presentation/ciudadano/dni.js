//DNI

function valDNI(fldID,fldLabel) 
{
    $("#"+fldID).val( $("#p"+fldID).val() + ' ' + $("#t"+fldID).val() + ' ' + $("#n"+fldID).val() );
    var fld = $("#n"+fldID);
    if(fld.length===1) 
    {
        var valor = fld.val();
        if(valor==="")
            return "";
       
        var re = new RegExp("^[0-9]{6,8}$");
        if( re.test(valor)===true ) 
            return "";
        else
            return "El campo " + fldLabel + " debe contener de 6 a 8 digitos sin espacios";   
    } 
    else 
        return "campo " + fldID + " no se encuentra";
}

function toTextDNI(campo,nom) {
    return $('#p'+campo).val()+' '+$('#t'+campo).val()+' '+$('#n'+campo).val();
}

function editDNI(id, valor, jsFld) {
    var p = valor.split(' ');
    if(p.length!==3)
        return;
    $('#p'+id).val(p[0]);
    $('#t'+id).val(p[1]);
    $('#n'+id).val(p[2]);
}

function initDNI(fld, opt) {
    $('#pm_'+fld).val( $('#pm_'+fld).attr('data-selected') );
    $('#tm_'+fld).val( $('#tm_'+fld).attr('data-selected') );
}

function chg_docid(obj) {
    //Documento
    var id = obj.id.substr(1);
    
    var validacion = valDNI(id, 'Documento');
    if(validacion!=='') {
        alert_box(validacion,"Corregir y reintentar");
        return;
    }
    
    //Valor del DNI compuesto
    var doc = $('#'+id).val();
    
    //Consulto el padron
    esperar('Consultado el padrón electoral...');
    new rem_request(this,function(obj,json){
        /*  'resultado'     => 'encontrado',
           
            'nro','nombre','apellido','direccion','ocupacion','genero','localidad','provincia','barrio'
        */
        listo();
        var jdata = JSON.parse(json);
        
        if(jdata.resultado!=='encontrado') {
            alert_box('No se encuentra a la persona en el padrón');
        } else {
            var opt = extractParams(id);
            if(opt) {
                //Completo los campos
                if(opt.nombre)
                    $('#m_'+opt.nombre).val(jdata.nombre);

                if(opt.apellido)
                    $('#m_'+opt.apellido).val(jdata.apellido);

                if(opt.direccion)
                    $('#m_'+opt.direccion).val(jdata.direccion);

                if(opt.genero)
                    $('#m_'+opt.genero).val(jdata.genero);

                if(opt.localidad)
                    $('#m_'+opt.localidad).val(jdata.localidad);

                if(opt.provincia)
                    $('#m_'+opt.provincia).val(jdata.provincia);

                if(opt.barrio)
                    $('#m_'+opt.barrio).val(jdata.barrio);

                if(opt.ocupacion)
                    $('#m_'+opt.ocupacion).val(jdata.ocupacion);
            }
        }
    },'CIUDADANO::DNI','buscarPadron',doc);
}
