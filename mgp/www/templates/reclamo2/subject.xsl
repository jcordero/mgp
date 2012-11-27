<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output indent="yes" method="text"/>

    <xsl:template match="/*">
        Su reclamo <xsl:value-of select="tic_nro"/>/<xsl:value-of select="tic_anio"/> ha sido recibido.
    </xsl:template>
 </xsl:stylesheet>
