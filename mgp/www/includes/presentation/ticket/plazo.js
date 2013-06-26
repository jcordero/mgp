
function plazo_totext(objId)
{
    var a = $("#a"+objId).val();
    var b = $("#b"+objId).val();
    var c = $("#c"+objId).val();
    return a + " " + b + " " + c;
}

function plazo_edit(id, valor, jsFld) {
    var p = valor.split(' ');
    
    $("#a"+id).val(p[0]);
    $("#b"+id).val(p[1]);
    $("#c"+id).val(p[2]);
}


