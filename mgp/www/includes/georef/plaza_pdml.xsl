<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output indent="no" method="html"/>

    <xsl:template match="/*">
        Plaza: <xsl:value-of select="plaza/nombre"/><br/>
    </xsl:template>
 </xsl:stylesheet>
