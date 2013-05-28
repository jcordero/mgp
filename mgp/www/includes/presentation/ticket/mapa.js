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