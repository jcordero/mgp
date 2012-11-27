
var usig_busy = false;
function usig(obj,callback,metodo,p1,p2,p3)
{
	this.getAjaxContent = function(cmd_url)
	{
		if (this.ajaxobj)
		{
            ShowWaitImage(true,this.source_obj);
			var instanceOfMe = this;
			this.ajaxobj.onreadystatechange = function(){instanceOfMe.initialize();};
            this.ajaxobj.open('GET', cmd_url, true);
			this.ajaxobj.send(null);
		}
		else
        {
			alert("Su navegador no acepta AJAX");
        }
    };

	this.initialize = function()
	{
		if (this.ajaxobj.readyState == 4) //4 = DONE
		{ 
			if(this.ajaxobj.status==200) // 200 = OK
			{ 
				var json_data = this.ajaxobj.responseText;
                ShowWaitImage(false,this.source_obj);
                usig_busy = false;
                
				if(this.target!="")
				{
                    var cl = eval("new " + this.target + ";");
                    if( json_data!="" )
                    {
                        var json = eval("(" + json_data + ")");
                        cl.parse(json,this.source_obj);
                    }
                    else
                    {
                        cl.parse(null,this.source_obj);
                    }
				}
                else
                {
                    alert("AJAX: Debe definir una funcion que procese la respuesta del server!!");
                }
			}
            else
            {
                ShowWaitImage(false,this.source_obj);
                usig_busy = false;
                alert("Error: AJAX status = " + this.ajaxobj.status);
            }
		}
	};

    //Evito el usuario loco del click
    if(usig_busy)
    {
        return;
    }
    usig_busy = true;

    var parameters = "&method=" + encodeURIComponent(metodo);
	parameters += "&p2="+encodeURIComponent(p2);
	parameters += "&p3="+encodeURIComponent(p3);
	parameters += "&p1="+encodeURIComponent(p1);
	this.url = sess_web_path + "/direcciones/proxyjson.php?bustcache="+new Date().getTime()+ parameters;
   
    this.source_obj = obj;
    this.target = callback; //Nombre del objeto que procesa el pedido
	this.ajaxobj = createAjaxObj(); //Creo el objeto para hacer el pedido
	this.getAjaxContent(this.url); //hago el pedido concreto
	return;
}


function getObjAltura(params,objID)
{
	//La forma de generar el ID tambien depende si esta en el form o en una tabla
	var objAltura = null;
    if(objID.substring(0,3)=="hm_" || objID.substring(0,2)=="m_")
	{
		// ES UN CAMPO DE UN FORM
		objAltura = document.getElementById("m_"+params[0]);
	}
	else
	{
		//ES UN CAMPO DE UNA TABLA
        var clase = objID.substring(4,objID.indexOf("_f"));
		objAltura = getField(clase,params[0]);
	}

	if(!objAltura)
	{
		alert("No se halla el objeto Altura asociado. ID=m_"+altura_id);
		return null;
	}

    return objAltura;
}

//-------------------------------CALLE-----------------------------------------------------------------
// Se debe normalizar la direccion ingresada, por calle y altura. Una vez conocida, se solicita la geolocalizacion de la misma.

//Cambio de descripcion => completo el codigo
function chg_calle_h(objID) 
{
	//El parametro pasado debe corresponder al helper de la calle
    //hm_calle
	var objHCalle = document.getElementById(objID);
	var calleNombre = objHCalle.value;
	if(calleNombre=="")
	{
		alert("Complete un nombre de calle primero");
		return; //No completo nada
	}
	
	//El campo esta en el formulario principal o sobre una tabla?
	var params = extractParams(objID);
	
	//La forma de generar el ID tambien depende si esta en el form o en una tabla
	var objAltura = getObjAltura(params,objID);
	var altura = objAltura.value;
	
	if(altura!="")
	{
		var delimitaciones = "barrios,limites_de_comunas,zonas_de_recoleccion,zonas_de_mantenimiento_de_alumbrado_publico";
		usig(objHCalle,"chg_calle_h1","consultarDelimitacionesPorDireccion",calleNombre,altura,delimitaciones);
	}
	else
	{
		//alert("Primero debe completar la altura de la calle");
	}
}

//Callback luego de normalizar la direccion
function chg_calle_h1()
{
    this.parse = function(json,objHCalle)
	{
        var campo = objHCalle.id; //.substring(1);
        var resultado = json.Normalizacion.TipoResultado;
        if(resultado == "Ambiguedad")
        {
            //Hay que salvar la ambiguedad con el nombre de la calle
            var nom_calles = new Array();
            var cod_calles = new Array();
            for( var j=0; json.Normalizacion.DireccionesCalleAltura[j]; j++)
            {
            	nom_calles.push(json.Normalizacion.DireccionesCalleAltura[j].Calle);
            	cod_calles.push(json.Normalizacion.DireccionesCalleAltura[j].CodigoCalle);
            }
            listHelperArrays(campo,nom_calles,cod_calles,chg_calle_h2);
        }
        else
        {
            if(resultado == "ErrorCalleInexistente")
            {
                    setValuePair(campo,"","");
                    alert("No existe una calle con este nombre");
            }
            else
            {
                if(resultado == "DireccionNormalizada")
                {
                    //Extraigo la calle y su codigo
                    var nodos = json.Normalizacion.DireccionesCalleAltura;
                    var codigoCalle = nodos[0].CodigoCalle;
                    var nombreCalle = nodos[0].Calle;
                    setValuePair(campo,nombreCalle,nombreCalle);//setValuePair(campo,codigoCalle,nombreCalle);

                    //Coordenadas
                    var params = "";
                    if(campo.substring(0,2)=="m_")
                    {
                        params = eval( campo.substring( campo.indexOf("_")+1 ) + ".m_params.split('|')" );
                    }
                    else
                    {
                        var clase = campo.substring(3,campo.indexOf("_f"));
                        var orden = campo.substring(campo.indexOf("_f")+2);
                        params = eval( clase + "_" + orden + ".m_params.split('|')" );
                    }
                    
                    if(params.length>2 && params[2]!="")
                    {
                        var x = json.GeoCodificacion.x;
                        setValuePair("m_" + params[1],x,x);

                        var y = json.GeoCodificacion.y;
                        setValuePair("m_" + params[2],y,y);
                    }

                    //Barrio
                    if(params.length>3 && params[3]!="")
                    {
                        var barrios = json.ConsultasDelimitaciones[0].Resultado;
                        setValuePair("m_" + params[3],barrios,barrios);
                    }

                    //CGPC
                    if(params.length>4 && params[4]!="")
                    {
                        var cgpc = json.ConsultasDelimitaciones[1].Resultado;
                        setValuePair("m_" + params[4],cgpc,cgpc);
                    }

                    //zona ilum
                    if(params.length>5 && params[5]!="")
                    {
                        var zona_ilum = json.ConsultasDelimitaciones[2].Resultado;
                        setValuePair("m_" + params[5],zona_ilum,zona_ilum);
                    }

                    //zona reco
                    if(params.length>6 && params[6]!="")
                    {
                        var zona_reco = json.ConsultasDelimitaciones[3].Resultado;
                        setValuePair("m_" + params[6],zona_reco,zona_reco);
                    }

                    //Dibujo mapa
                    if(params.length>7 && params[7]!="")
                    {
                        MostrarMapa("m_"+params[7],"");
                    }

                    //Nombre de la calle
                    if(params.length>8 && params[8]!="")
                    {
                        setValuePair("m_" + params[8],nombreCalle,nombreCalle);
                    }
                    
                    //Codigo USIG de la calle
                    if(params.length>9 && params[9]!="")
                    {
                        setValuePair("m_" + params[9],codigoCalle,codigoCalle);
                    }

                }
                else
                {
                    if(resultado == "ErrorCalleInexistenteAEsaAltura")
                    {
                        alert("La calle no existe a la altura pedida.");
                    }
                    else
                    {
                        alert(resultado);
                    }
                }
            }
        }
    };
}

//Funcion llamada al seleccionar una calle del menu presentado en caso de ambiguedad
function chg_calle_h2(objID, cod_calle, nombreCalle)
{
    //Conozco el codigo y la calle y la altura...
    //ahora debo pedir el resto de la informacion
	$('#'+objID).val(nombreCalle);
	
    //El campo esta en el formulario principal o sobre una tabla?
	var params = extractParams(objID);

	//La forma de generar el ID tambien depende si esta en el form o en una tabla
	var objAltura = getObjAltura(params,objID);
    var altura = objAltura.value;

    //Nombre de la calle
    if(params.length>8 && params[8]!="")
    {
        setValuePair("m_" + params[8],nombreCalle,nombreCalle);
    }

    //Ya tengo el codigo de calle y altura, pido el resto de los datos
    var objHCalle = document.getElementById(objID);
    usig(objHCalle,"chg_calle_h3","geoCodificarPorCodigoCalleAltura",cod_calle,altura,"");
}

//Call back que se usa cuando la direccion es ambigua
function chg_calle_h3()
{
    this.parse = function(json,objHCalle)
	{
        var x = json.x;
        var y = json.y;

        //Coordenadas
        var params = extractParams(objHCalle.id);
        if(params.length>2 && params[1]!="" && params[2]!="")
        {
            setValuePair("m_" + params[1],x,x);
            setValuePair("m_" + params[2],y,y);
        }

        //Dibujo mapa
        if(params.length>7 && params[7]!="")
        {
            MostrarMapa("m_"+params[7],"");
        }

        //Ya tengo el codigo de calle y altura, y las coordenadas. Pido las delimitaciones
        //consultarDelimitaciones
        var delimitaciones = "barrios,limites_de_comunas,zonas_de_recoleccion,zonas_de_mantenimiento_de_alumbrado_publico";
        usig(objHCalle,"chg_calle_h4","consultarDelimitaciones",x,y,delimitaciones);
    };
}

//Call back que se usa cuando la direccion es ambigua
function chg_calle_h4()
{
    this.parse = function(json,objHCalle)
	{
        var params = extractParams(objHCalle.id);
        
        //Barrio
        if(params.length>3 && params[3]!="")
        {
            var barrios = json[0].Resultado;
            setValuePair("m_" + params[3],barrios,barrios);
        }

        //CGPC
        if(params.length>4 && params[4]!="")
        {
            var cgpc = json[1].Resultado;
            setValuePair("m_" + params[4],cgpc,cgpc);
        }

        //zona ilum
        if(params.length>5 && params[5]!="")
        {
            var zona_ilum = json[2].Resultado;
            setValuePair("m_" + params[5],zona_ilum,zona_ilum);
        }

        //zona reco
        if(params.length>6 && params[6]!="")
        {
            var zona_reco = json[3].Resultado;
            setValuePair("m_" + params[6],zona_reco,zona_reco);
        }
    };
}

//Cambio de codigo => completo descripcion
function chg_calle(objname) 
{
	var obj = document.getElementById(objname);
	if(obj.value=="")
		return;
	chg_calle_h(objname);
}

