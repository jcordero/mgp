//DNI

function valDNI(fldID,fldLabel) 
{
	fld = document.getElementById("n"+fldID);
	if(fld) 
	{
		valor = fld.value;
		if(valor=="")
		{
			return "";
		}
		re = new RegExp("^[0-9]{6,8}$");
		if( re.test(valor)==true ) 
		{
			return "";
		} 
		else
		{
			return "El campo " + fldLabel + " debe contener de 6 a 8 digitos sin espacios";
		}
	} 
	else 
	{
		return "campo " + fldID + " no se encuentra";
	}
}

function toTextDNI(campo,nom) {
	return $('#p'+campo).val()+' '+$('#t'+campo).val()+' '+$('#n'+campo).val();
}

function editDNI(id, valor, jsFld) {
	var p = valor.split(' ');
	if(p.length!=3)
		return;
	$('#p'+id).val(p[0]);
	$('#t'+id).val(p[1]);
	$('#n'+id).val(p[2]);
}