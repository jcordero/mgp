<?php

include_once "common/cdatatypes.php";
include_once "beans/functions.php";
include_once "beans/georeferencias.php";
include_once "beans/prestacion.php";

class CDH_TICKETS extends CDataHandler {

    function __construct($parent) {
        parent::__construct($parent);
    }

    /**
     * Crea la pagina de trabajo del operador que se usa para pasar de estado los tickets
     * 
     * @global cdbdata $primary_db
     * @param string $par
     * @return string
     */
    function crearPagina($par) {
        global $primary_db;
        $ret = array();
        $pars = json_decode($par);

        //Paginacion
        if (intval($pars->pagina, 10) == 0) {
            $pars->pagina = 1;
        }
        $p = ($pars->pagina - 1) * 25;

        error_log("TICKET::crearPagina($par) offset=$p");

        //Organismo del usuario (en lista separada por comas)
        list($organismos, $siglas) = $this->getOrganismos();

        //Lista de tickets afectados, filtrados por tipo de estado
        $sql = "select tic_nro,tic_identificador,tic_tstamp_in,tpr_code,tpr_detalle,tic_lugar,tic_nota_in,tic_estado,ttp_estado,tic_coordx,tic_coordy,tic_canal,tto_figura,datediff(NOW(),tic_tstamp_plazo) as vencido,tic_tstamp_plazo " .
                "from v_tickets where tor_code in ({$organismos}) ";

        //Filtros
        $sql2 = '';
        switch ($pars->filtro) {
            case "ABIERTOS":
                $sql2.= "AND ttp_estado not in ('cerrado','resuelto','rechazado','rechazado indebido','finalizado') ";
                break;
            case "CERRADOS":
                $sql2.= "AND ttp_estado in ('cerrado','resuelto','rechazado','rechazado indebido','finalizado') ";
                break;
            case "VENCIDOS":
                $sql2.= "AND tic_tstamp_plazo<now() AND ttp_estado not in ('cerrado','resuelto','rechazado','rechazado indebido','finalizado') ";
        }
        
        //Campo buscar
        if($pars->buscar != ""){
            $busc = filter_var($pars->buscar, FILTER_SANITIZE_MAGIC_QUOTES);
            $sql2.= "AND tic_identificador like '%{$busc}%' ";
        }
        
        //Ordenados por fecha, los mas nuevos primero, paginado en la base
        $sql3 = " order by tic_tstamp_in desc limit {$p},25";

        $rs = $primary_db->do_execute($sql . $sql2 . $sql3);
        while ($row = $primary_db->_fetch_row($rs)) {
            $direccion = json_decode($row['tic_lugar']);

            $geo = new georeferencias();
            $geo->load($row['tic_lugar']);
            $lugar = $geo->generarTextoDireccion();

            //Vencido
            if ($row['tic_estado'] === 'ABIERTO') {
                $vencido = $row['vencido'];
            } else {
                $vencido = 0;
            }

            $ret[] = array(
                'fecha' => DatetoLocale($row['tic_tstamp_in']),
                'prestacion' => prestacion::getFullDescription($row['tpr_code']),
                'direccion' => $direccion,
                'nota' => $row['tic_nota_in'],
                'estado' => $row['tic_estado'],
                'estado_prest' => $row['ttp_estado'],
                'ticket' => $row['tic_nro'],
                'identificador' => $row['tic_identificador'],
                'rol' => $row['tto_figura'],
                'canal' => $row['tic_canal'],
                'texto_dir' => $lugar,
                'vencido' => $vencido,
                'plazo' => DatetoLocale($row['tic_tstamp_plazo'])
            );
        }

        //Cantidad total
        $cantidad = $primary_db->QueryString("select count(*) from v_tickets where tor_code in ({$organismos}) " . $sql2);

        //titulo
        $tit = 'Tickets de ' . $siglas;

        return json_encode(array(
            "tickets" => $ret,
            "titulo" => $tit,
            "paginas" => ceil($cantidad / 25)), JSON_UNESCAPED_UNICODE);
    }

    /** armar una lista de los organismos a los que pertence este usuario
     * 
     * @global cdbdata $primary_db
     * @return [string,string] texto con organismos y siglas separados por comas
     */
    private function getOrganismos() {
        global $primary_db;
        $organismos = '';
        $siglas = '';

        if (isset($_SESSION['groups'])) {
            $partes = explode(",", $_SESSION['groups']);
            foreach ($partes as $grupo) {
                $grp = strtoupper(trim($grupo));
                if (substr($grp, 0, 10) == "ORGANISMO_") {
                    $id = substr($grp, 10);

                    //Busco el codigo en la base
                    $tor_code = $primary_db->QueryString("SELECT tor_code FROM tic_organismos WHERE tor_sigla='$id'");
                    $organismos .= ($organismos == '' ? '' : ',') . $tor_code;
                    $siglas .= ($siglas == '' ? '' : ',') . $id;
                }
            }
        }

        return array($organismos, $siglas);
    }

    /** Link para cambiar el ticket
     * 
     * @global csession $sess
     * @param int $ticket
     * @return string
     */
    function updateTicket($ticket) {
        global $sess;
        return $sess->encodeURL(WEB_PATH . "/lmodules/tickets/ticket_maint_chg.php?OP=M&tic_nro=" . $ticket . "&next=/index.php");
    }

}
