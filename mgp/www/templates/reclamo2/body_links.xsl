<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output indent="yes" method="xml"/>
	
    <xsl:template match="/*">
        <html><body><font face="Verdana" size="3">
            <div style="background:gray;width:100%;clear:right;">
				<img src="http://logistica.servitruck.com/images/default/TopLogo.jpg"/>
				Ingreso a plazoleta Fiscal</div>
			<hr/>
            <b>Datos del ingreso</b>
			<br/>
			<table border="1" width="700px">
                <tr><td><b>Operacion</b></td><td><xsl:value-of select="fmo_type"/></td></tr>
				<tr><td><b>Cliente</b></td><td><xsl:value-of select="codcli_bej/@alt"/></td></tr>
                <tr><td><b>Fecha ingreso</b></td><td><xsl:value-of select="fmo_fecha_in"/></td></tr>
                <tr><td><b>Transportista</b></td><td><xsl:value-of select="codcli_bej_trans/@alt"/></td></tr>
				<tr><td><b>Camion</b></td><td><xsl:value-of select="std_pat_camion"/></td></tr>
                <tr><td><b>Semi</b></td><td><xsl:value-of select="std_pat_semi"/></td></tr>
                <tr><td><b>Semi 2</b></td><td><xsl:value-of select="std_pat_semi2"/></td></tr>
                <tr><td><b>Despachante</b></td><td><xsl:value-of select="codcli_bej_desp/@alt"/></td></tr>
            </table>
            <br/> 
            <b>Documentos</b>
			<table border="1" width="700px">
				<tr>
					<td><b>Tipo</b></td>
					<td><b>Codigo</b></td>
					<td><b>Mercaderia</b></td>
				</tr>
				<xsl:for-each select="cfis_movimientos_documentos">
					<tr>
						<td><xsl:value-of select="cfis_documentos/fdo_tipo_cod"/></td>
						<td><xsl:value-of select="cfis_documentos/fdo_cod_original"/></td>
						<td><xsl:value-of select="cfis_documentos/fdo_mercaderia"/></td>
					</tr>
				</xsl:for-each>
			</table>           
  
			<br/> 
            <b>Adjuntos</b>
			<table border="1" width="700px">
				<tr>
					<td><b>Archivo</b></td>
					<td><b>Descarga</b></td>
				</tr>
				<xsl:for-each select="cfile">
					<tr>
						<td><xsl:value-of select="cfile/doc_name"/></td>
						<td><a href="http://logistica.servitruck.com/common/download.php?doc=">Descargar</a></td>
					</tr>
				</xsl:for-each>
			</table>           
  
            </font></body></html>
    </xsl:template>
</xsl:stylesheet>
