<?php 
include_once "common/cdatatypes.php";

class CDH_TICKETS extends CDataHandler 
{
	function __construct($parent) 
	{
		parent::__construct($parent);
	}
		
        function crearPagina($par) {
            global $primary_db;
            $ret = array();
            list($pagina, $filtro) = explode('|', $par);
            
            //Organismo del usuario
            list($organismos,$siglas) = $this->getOrganismos();
            
            $sql = "select tic_nro,tic_identificador,tic_tstamp_in,tpr_detalle,tic_lugar,tic_nota_in,tic_estado,ttp_estado,tic_coordx,tic_coordy,tic_canal,tto_figura from v_tickets where tor_code in ({$organismos}) ";
            if($filtro=="ABIERTOS")
                $sql.= "AND tic_estado='ABIERTO' ";
            if($filtro=="CERRADOS")
                $sql.= "AND tic_estado in ('CERRADO','CANCELADO') ";
            if($filtro=="VENCIDOS")
                $sql.= "AND tic_tstamp_plazo>now() ";
            $sql.= "order by tic_tstamp_in desc";

            $rs = $primary_db->do_execute($sql);
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
                    'canal'         => $row['tic_canal']    
                );
            }
            
            //titulo
            $tit = 'Tickets de '.$siglas;
            return json_encode( array("tickets" => $ret, "titulo" => $tit) );
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