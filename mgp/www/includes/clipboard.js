/* 
 * Funciones usadas en la home page del call center
 */

//INTERFACE CON EL TELEFONO IP
//Mira una vez por segundo buscando cambios en el portapapeles. Los eventos del telefono van por ahi.
function downloadOnLoad()
{
	

    //Activo el timer que mira el clipboard solo si estoy en la homepage
    if(document.getElementById("contactos_result"))
    {
        if( !window.clipboardData )
        {
            //alert("La facilidad de consultar el portapapeles solo esta disponible en Internet Explorer");
        }
        else
        {
        	//Limpio el clipboard de datos viejos
        	window.clipboardData.clearData('Text');

        	//Espero el evento del telefono IP
            setInterval('miraClipboard()',1000);
        }
    }
}

var gClipContent = "";
function miraClipboard()
{
    var ClipContent = window.clipboardData.getData('Text');
    if(  ClipContent!=null && ClipContent.length>3 && ClipContent!=gClipContent)
    {
        gClipContent = ClipContent;
        
        //Cambio el clipboard
        var partes = ClipContent.split("|");
        if( partes.length==4 )
        {
            //Limpio el clipboard
            window.clipboardData.clearData('Text');

            var ani = partes[0];
            var entry_point = partes[1];
            var call_id = partes[2];
            var skill = partes[3];
            
            //Inicio la busqueda del contacto por el ANI
            buscar_ani(ani,entry_point,call_id,skill);
        }
    }
}

