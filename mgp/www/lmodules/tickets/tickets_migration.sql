INSERT INTO [call].[dbo].[TIC_ORGANISMOS]
           ([TOR_CODE]
           ,[TOR_PADRE]
           ,[TOR_SIGLA]
           ,[TOR_NOMBRE]
           ,[TOR_ESTADO]
           ,[TOR_TSTAMP]
           ,[USE_CODE]
           ,[TOR_CONTACTO]
           ,TOR_TIPO
     )
     
SELECT [Codigo]
      ,[Padre]
      ,[Sigla]
      ,[Nombre]
      ,CASE [Estado] WHEN 0 THEN 'ACTIVO' ELSE 'INACTIVO' END as Estado
      ,GETDATE() as tstamp
      ,'1'
      ,[Direccion] + ' (' + [CodPostal] + ') Tel:' +[TelFax] + ' ' + [eMail] + ' ' + [Horario] as contacto
      ,CASE [Tipo] WHEN 'C' THEN 'COMISARIA'
		WHEN 'E' THEN 'EMPRESA'
		WHEN 'G' THEN 'CGPC'
		WHEN 'H' THEN 'HOSPITAL'
		WHEN 'O' THEN 'GOBIERNO'
		END as Tipo
  FROM [gcba2].[dbo].[Organismos]