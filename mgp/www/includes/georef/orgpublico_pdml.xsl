<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output indent="no" method="html"/>

    <xsl:template match="/*">
	    <table><tr><td><b>Ubicación del ticket</b></td></tr></table>
    	<table border="1mm">
        	<tr><td width="2cm" fillcolor="#B0B0B0">Organismo:</td><td width="10cm"><xsl:value-of select="orgpublico/nombre"/></td></tr>
        	<tr><td width="2cm" fillcolor="#B0B0B0">Area o sector:</td><td width="10cm"><xsl:value-of select="orgpublico/sector"/></td></tr>
        </table><br/>
    </xsl:template>
 </xsl:stylesheet>
