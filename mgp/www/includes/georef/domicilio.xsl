<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output indent="yes" method="html"/>
	
    <xsl:template match="/*" xml:space="preserve">
    <table>
        <tr><td class="lbl">Calle:</td><td><xsl:value-of select="domicilio/calle"/> <xsl:value-of select="domicilio/nro"/></td></tr>
        <tr><td class="lbl">Piso:</td><td><xsl:value-of select="domicilio/piso"/></td></tr>
        <tr><td class="lbl">Dpto:</td><td><xsl:value-of select="domicilio/dpto"/></td></tr>
        <tr><td class="lbl">Lugar:</td><td><xsl:value-of select="domicilio/nombre_fantasia"/></td></tr>
    </table>
    </xsl:template>
 </xsl:stylesheet>
