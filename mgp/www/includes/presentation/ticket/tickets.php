<?php 
include_once "common/cdatatypes.php";
include_once "beans/functions.php";

class CDH_TICKETS extends CDataHandler 
{
	function __construct($parent) 
	{
		parent::__construct($parent);
	}
		
        /**
         * Crea la pagina de trabajo del operador que se usa para pasar de estado los tickets
         * 
         * @global type $primary_db
         * @param type $par
         * @return type
         */
        function crearPagina($par) {
            global $primary_db;
            $ret = array();
            list($pagina, $filtro) = explode('|', $par);
                
            //Paginacion
            if(intval($pagina,10)==0)
                    $pagina = 1;
            $p = ($pagina-1)*25;
            
            error_log("TICKET::crearPagina($par) offset=$p");
            
            //Organismo del usuario (en lista separada por comas)
            list($organismos,$siglas) = $this->getOrganismos();
            
            //Lista de tickets afectados, filtrados por tipo de estado
            $sql = "select tic_nro,tic_identificador,tic_tstamp_in,tpr_detalle,tic_lugar,tic_nota_in,tic_estado,ttp_estado,tic_coordx,tic_coordy,tic_canal,tto_figura from v_tickets where tor_code in ({$organismos}) ";
 
            //Filtros
            $sql2 = '';
            if($filtro=="ABIERTOS")
                $sql2.= "AND ttp_estado not in ('cerrado','resuelto','rechazado','rechazado indebido','finalizado') ";
            if($filtro=="CERRADOS")
                $sql2.= "AND ttp_estado in ('cerrado','resuelto','rechazado','rechazado indebido','finalizado') ";
            if($filtro=="VENCIDOS")
                $sql2.= "AND tic_tstamp_plazo<now() AND ttp_estado not in ('cerrado','resuelto','rechazado','rechazado indebido','finalizado')";
            
            //Ordenados por fecha, los mas nuevos primero, paginado en la base
            $sql3 = "order by tic_tstamp_in desc limit {$p},25";

            $rs = $primary_db->do_execute($sql.$sql2.$sql3);
            while( $row = $primary_db->_fetch_row($rs) ) {
                $direccion = json_decode($row['tic_lugar']);
                $ret[] = array(
                    'fecha'         => $row['tic_tstamp_in'],
                    'prestacion'    => $row['tpr_detalle'],
                    'direccion'     => $direccion,
                    'nota'          => $row['tic_nota_in'],
                    'estado'        => $row['tic_estado'],
                    'estado_prest'  => $row['ttp_estado'],
                    'ticket'        => $row['tic_nro'],
                    'identificador' => $row['tic_identificador'],
                    'rol'           => $row['tto_figura'],
                    'canal'         => $row['tic_canal'],
                    'texto_dir'     => generarTextoDireccion($direccion)
                );
            }

            //Cantidad total
            $cantidad = $primary_db->QueryString("select count(*) from v_tickets where tor_code in ({$organismos}) ".$sql2);
            
            //titulo
            $tit = 'Tickets de '.$siglas;
            
            return json_encode( array("tickets" => $ret, "titulo" => $tit, "paginas"=>  ceil($cantidad/25) ));
        }
        
        
        private function getOrganismos()
	{
            global $primary_db;
            $organismos = '';
            $siglas = '';
            
            if( isset($_SESSION['groups']) )
            {
        	$partes = explode(",",$_SESSION['groups']);
            	foreach($partes as $grupo)
            	{
                    $grp = strtoupper(trim($grupo));
                    if( substr($grp,0,10)=="ORGANISMO_" )
                    {
                        $id = substr($grp,10);
                    	
                    	//Busco el codigo en la base
         		$tor_code = $primary_db->QueryString("SELECT tor_code FROM tic_organismos WHERE tor_sigla='$id'");         				
         		$organismos .= ($organismos=='' ?  '' : ',').$tor_code;
                        $siglas .= ($siglas=='' ?  '' : ',').$id;
                    }
            	}	
            }
     		
            return array($organismos, $siglas);
	}
        
        
        function updateTicket($ticket) {
            global $sess;
            return $sess->encodeURL(WEB_PATH."/lmodules/tickets/ticket_maint_chg.php?OP=M&tic_nro=".$ticket."&next=/index.php");
        }


}
?>