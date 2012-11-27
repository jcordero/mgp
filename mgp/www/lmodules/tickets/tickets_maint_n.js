function downloadOnLoad()
{
    var divrubro = $("#rubro");
    if(divrubro.length==1)
    {
        divrubro.hide();
        rubro.m_mandatory = false;
    }
    
    //Inhabilito las direcciones
    $("#bloque_domicilio").hide();
    $("#bloque_villa").hide();
    $("#bloque_plaza").hide();
    $("#bloque_cementerio").hide();
    $("#bloque_orgpublico").hide();
}
