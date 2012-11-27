<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output indent="no" method="html"/>

    <xsl:template match="/*">
    	<table><tr><td><b>Ubicacion del ticket</b></td></tr></table>
    	<table border="1mm">
        <tr><td width="2cm" fillcolor="#B0B0B0">Villa:</td><td width="10cm"><xsl:value-of select="villa/nombre"/></td></tr>
        <tr><td width="2cm" fillcolor="#B0B0B0">Manzana:</td><td width="10cm"><xsl:value-of select="villa/manzana"/></td></tr>
        <tr><td width="2cm" fillcolor="#B0B0B0">Casa:</td><td width="10cm"><xsl:value-of select="villa/casa"/></td></tr>
        </table>
        <br/>
    </xsl:template>
 </xsl:stylesheet>
