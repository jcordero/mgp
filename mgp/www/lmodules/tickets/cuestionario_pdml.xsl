<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output indent="no" method="html"/>
    
    <xsl:template match="/*">
	    <table><tr><td><b>Cuestionario de la prestación</b></td></tr></table>
    	<table border="1mm">
        <xsl:for-each select="cuestion">
        	<tr><td width="9cm" fillcolor="#B0B0B0"><b><xsl:value-of select="pregunta"/></b></td>
        	<td width="10cm"><xsl:value-of select="respuesta"/></td></tr>
        </xsl:for-each>
        </table>
        <br/>
    </xsl:template>
 </xsl:stylesheet>

