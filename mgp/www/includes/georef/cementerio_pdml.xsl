<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output indent="no" method="html"/>

    <xsl:template match="/*">
        Cementerio: <xsl:value-of select="cementerio/nombre"/><br/>
        Tipo Sepultura: <xsl:value-of select="cementerio/sepultura"/><br/>
        Sector: <xsl:value-of select="cementerio/sector"/><br/>
        Calle: <xsl:value-of select="cementerio/calle"/><br/>
        Número: <xsl:value-of select="cementerio/numero"/><br/>
        Fila: <xsl:value-of select="cementerio/fila"/><br/>
    </xsl:template>
 </xsl:stylesheet>
