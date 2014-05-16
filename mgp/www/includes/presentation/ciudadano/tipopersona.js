//TIPO DE PERSONA
// Parametros:
// 1 - Nombres 
// 2 - Apellido
// 3 - Razon Social
// 4 - sexo
// 5 - Nacimiento (No se usa mas)
// 6 - documento (lo paso a CUIT para el tipo PERS.JURIDICA)

function chg_tipopersona(obj) {		
    var objID = obj.id;
    if(typeof obj.selectedIndex=="undefined") {
        return; //Es un campo INPUT read only
    }
    var ix = obj.selectedIndex;
    var persona = "";
    if(ix!=-1){
        persona = obj.options[ix].text;
    }else{
        return; //No hay un valor elegido en el select
    }

    //El campo esta dentro de una TABLA? 
    var en_tabla = (objID.substring(0,2)=="m_" ? false : true);
    var clase = "";
    var params = null;
    var nombres = null;
    var apellido = null;
    var razonsocial = null;
    var sexo = null;
    var nacimiento = null;
    var doc_nro = null;

    var obj_nombres;
    var obj_apellido;
    var obj_razonsocial;
    var obj_sexo;
    var obj_nacimiento;

    //Recupero los parametros de este objeto
    if(!en_tabla){
        params = eval( objID.substring( objID.indexOf("_")+1 ) + ".m_params.split('|')" );
    }else{
        clase = objID.substring(3,objID.indexOf("_f"));
        var orden = objID.substring(objID.indexOf("_f")+2);
        params = eval( clase + "_" + orden + ".m_params.split('|')" );
    }
	
    //Determino los objetos a actualizar
    if(en_tabla){	
        nombres     = p4.getField4(clase,params[0]);
        apellido    = p4.getField4(clase,params[1]);
        razonsocial = p4.getField4(clase,params[2]);
        sexo        = p4.getField4(clase,params[3]);
        nacimiento  = p4.getField4(clase,params[4]);
        doc_nro     = p4.getField4(clase,params[5]);
    }else{
        nombres = document.getElementById(params[0]);
        apellido = document.getElementById(params[1]);
        razonsocial = document.getElementById(params[2]);
        sexo = document.getElementById(params[3]);
        nacimiento = document.getElementById(params[4]);
        doc_nro = document.getElementById(params[5]);

        obj_nombres = eval(params[0]);
        obj_apellido = eval(params[1]);
        obj_razonsocial = eval(params[2]);
        obj_sexo = eval(params[3]);
        obj_nacimiento = eval(params[4]);
    }
	
    //Muestro / oculto los campos
    if(persona=="FISICA"){
        nombres.style.display = "block";
        apellido.style.display = "block";
        razonsocial.style.display = "none";
        sexo.style.display = "block";
        nacimiento.style.display = "block";

        //Valores obligatorios
        obj_nombres.m_mandatory = true;
        obj_apellido.m_mandatory = true;
        obj_razonsocial.m_mandatory = false;
        obj_sexo.m_mandatory = true;
        obj_nacimiento.m_mandatory = false;
    }else{
        nombres.style.display = "none";
        apellido.style.display = "none";
        razonsocial.style.display = "block";
        sexo.style.display = "none";
        nacimiento.style.display = "none";

        //Valores obligatorios
        obj_nombres.m_mandatory = false;
        obj_apellido.m_mandatory = false;
        obj_razonsocial.m_mandatory = true;
        obj_sexo.m_mandatory = false;
        obj_nacimiento.m_mandatory = false;
    }
}

function init_tipopersona(id) {
    var obj = document.getElementById("m_"+id);
    if(obj){
        chg_tipopersona(obj);
    }
}