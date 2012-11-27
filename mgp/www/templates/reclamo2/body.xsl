<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output indent="yes" method="xml"/>
	
    <xsl:template match="/*">
    <html xmlns:com="www.commsys.com.ar">
		<head>
		    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		    <meta http-equiv="content-language" content="es" />
		</head>
		<body >
		    <div id="payload">
		        <div id="head">
		            <div id="banner"><img src="header_ssatciu.jpg"/></div>
		        </div>
		       
		 	Se ha recibido el reclamo <xsl:value-of select="tic_nro"/>/<xsl:value-of select="tic_anio"/>
		 	<br/>
		 	<b>Acciones realizadas:</b><br/>
			<table border="1" width="700px">
				<tr>
					<td><b>Fecha</b></td>
					<td><b>Estado</b></td>
					<td><b>Nota</b></td>
				</tr>
				<xsl:for-each select="/class_tic_ticket_upd/class_tic_avance">
					<tr>
						<td><xsl:value-of select="/class_tic_ticket_upd/class_tic_avance/tav_tstamp"/></td>
						<td><xsl:value-of select="/class_tic_ticket_upd/class_tic_avance/tic_estado_out"/></td>
						<td><xsl:value-of select="/class_tic_ticket_upd/class_tic_avance/tav_nota"/></td>
					</tr>
				</xsl:for-each>
			</table>           
  	 	
		    </div>    
		</body>
		</html>
        </xsl:template>
</xsl:stylesheet>
