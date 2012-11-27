function valCODPOSTAL(fldID,fldLabel) 
{
	fld = document.getElementById(fldID);
	if(fld) 
	{
		valor = fld.value;
		if(valor=="")
		{
			return "";
		}
		re = new RegExp("^[A-Z]{0,1}[0-9]{4,4}([A-Z]{3,3}){0,1}$");
		if( re.test(valor)==true ) 
		{
			return "";
		} 
		else
		{
			return "El campo " + fldLabel + " debe contener un codigo como este ejemplo C1037AAB o solo el numero, 1037";
		}
	} 
	else 
	{
		return "campo " + fldID + " no se encuentra";
	}
}
