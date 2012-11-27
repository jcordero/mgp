<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output indent="no" method="html"/>

    <xsl:template match="/*">
    	<table>
        <tr><td>Villa:</td><td><xsl:value-of select="villa/nombre"/></td></tr>
        <tr><td>Manzana:</td><td><xsl:value-of select="villa/manzana"/></td></tr>
        <tr><td>Casa:</td><td><xsl:value-of select="villa/casa"/></td></tr>
        </table>
    </xsl:template>
 </xsl:stylesheet>
