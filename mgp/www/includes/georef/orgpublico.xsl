<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output indent="no" method="html"/>

    <xsl:template match="/*">
        Organismo público: <xsl:value-of select="orgpublico/nombre"/><br/>
        Area o sector: <xsl:value-of select="orgpublico/sector"/><br/>
    </xsl:template>
 </xsl:stylesheet>
