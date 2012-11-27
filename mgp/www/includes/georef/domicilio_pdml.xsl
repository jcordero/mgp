<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output indent="yes" method="html"/>
	
    <xsl:template match="/*" xml:space="preserve">
    	<table><tr><td><b>Ubicacion del ticket</b></td></tr></table>
    	<table border="1mm">
    	    <tr><td width="2cm" fillcolor="#B0B0B0">Calle:</td><td width="10cm"><xsl:value-of select="domicilio/calle"/> <xsl:value-of select="domicilio/nro"/></td></tr>
        	<tr><td width="2cm" fillcolor="#B0B0B0">Piso:</td><td width="10cm"><xsl:value-of select="domicilio/piso"/></td></tr>
        	<tr><td width="2cm" fillcolor="#B0B0B0">Dpto:</td><td width="10cm"><xsl:value-of select="domicilio/dpto"/></td></tr>
        	<tr><td width="2cm" fillcolor="#B0B0B0">Lugar:</td><td width="10cm"><xsl:value-of select="domicilio/nombre_fantasia"/></td></tr>
    	</table>
    	<br/>
    </xsl:template>
 </xsl:stylesheet>
