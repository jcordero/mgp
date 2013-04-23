<?php

class solicitante {
    public $ciu_documento;
    public $ciu_nombres;
    public $ciu_apellido;
    public $ciu_email;
    public $ciu_telefono_fijo;
    public $ciu_telefono_movil;
    public $ttc_tstamp;
    public $ttc_nota;
    private $ciu_code;
    
    static function factory($tic_nro) {
        global $primary_db;
        $ret = array();
        $sql = "select * from tic_ticket_ciudadano tci 
                    JOIN ciu_ciudadanos cci ON tci.ciu_code=cci.ciu_code
                WHERE tci.tic_nro='{$tic_nro}'";
        $rs = $primary_db->do_execute($sql);
        while( $row=$primary_db->_fetch_row($rs) ) {
            $ciudadano = new solicitante();                
            
            $ciudadano->ciu_documento         = $primary_db->QueryString("select ciu_nro_doc from ciu_identificacion where ciu_code='{$row['ciu_code']}' limit 1");
            $ciudadano->ciu_nombres           = $row['ciu_nombres'];
            $ciudadano->ciu_apellido          = $row['ciu_apellido'];
            $ciudadano->ciu_email             = $row['ciu_email'];
            $ciudadano->ciu_telefono_fijo     = $row['ciu_tel_fijo'];
            $ciudadano->ciu_telefono_movil    = $row['ciu_tel_movil'];        
            $ciudadano->ttc_tstamp            = DatetoISO8601($row['ttc_tstamp']); 
            $ciudadano->ttc_nota              = $row['ttc_nota'];
            
            $ret[] = $ciudadano;
        }
        return $ret;
    }

    function save($parent) {
        global $primary_db, $sess;
        $errores = array();
        
        //Existe el ciudadano?
        $this->ciu_code = $primary_db->QueryString("select ciu_code from ciu_identificacion where ciu_nro_doc='{$this->ciu_documento}'");
        
        //Caso que no exista el ciudadano
        if($this->ciu_code==='') {
            $this->ciu_code = $primary_db->Sequence('ciu_ciudadanos');
            $nac = substr($this->ciu_documento,0,3);
            
            $sql1 = "insert into ciu_ciudadanos (ciu_code  , ciu_nombres   , ciu_apellido   , ciu_email   , ciu_tel_fijo   , ciu_tel_movil   , ciu_ultimo_acceso, ciu_canal_ingreso   , ciu_estado, ciu_tstamp, ciu_tipo_persona, ciu_nacionalidad) 
                                         values (:ciu_code:,':ciu_nombres:',':ciu_apellido:',':ciu_email:',':ciu_tel_fijo:',':ciu_tel_movil:',NOW()             ,':ciu_canal_ingreso:','ACTIVO'   , NOW()     , 'FISICA'        , ':ciu_nacionalidad:')";
            $params1 = array(
                  'ciu_code'            => $this->ciu_code, 
                  'ciu_nombres'         => $this->ciu_nombres, 
                  'ciu_apellido'        => $this->ciu_apellido,
                  'ciu_email'           => $this->ciu_email,
                  'ciu_tel_fijo'        => $this->ciu_telefono_fijo,
                  'ciu_tel_movil'       => $this->ciu_telefono_movil,
                  'ciu_canal_ingreso'   => $parent->tic_canal,
                  'ciu_nacionalidad'    => $nac,
            );
            $primary_db->do_execute($sql1,$errores,$params1);
            
            $sql2 = "insert into ciu_identificacion (ciu_code  , ciu_nro_doc   ) 
                                             values (:ciu_code:,':ciu_nro_doc:')";
            $params2 = array(
                  'ciu_code'            => $this->ciu_code, 
                  'ciu_nro_doc'         => $this->ciu_documento, 
            );
            $primary_db->do_execute($sql2,$errores,$params2);
            
        }
        
        //El ciudadano esta identificado o creado...
        
        //Lo asocio al ciudadano que lo reporta (tic_ticket_ciudadano)
        $sql5 = "insert into tic_ticket_ciudadano (tic_nro, ciu_code, ttc_tstamp, ttc_nota) 
                    values (:tic_nro:, :ciu_code:, NOW(), ':ttc_nota:')";
        $params5 = array(
              'tic_nro'     => $parent->getNro(), 
              'ciu_code'    => $this->ciu_code, 
              'ttc_nota'    => $parent->tic_nota_in
        );
        $primary_db->do_execute($sql5,$errores,$params5);
         
         //Creo un evento en el historial del ciudadano (ciu_historial_contactos)
         $sql6 = "insert into ciu_historial_contactos (chi_code, ciu_code, cse_code, chi_fecha, chi_motivo, use_code, chi_canal, chi_nota) 
                    values (:chi_code:, :ciu_code:, null, NOW(), 'Ingreso de ticket', ':use_code:', 'movil', ':chi_nota:')";
         $params6 = array(
              'chi_code'    => $primary_db->Sequence('ciu_historial_contactos'), 
              'ciu_code'    => $this->ciu_code, 
              'use_code'    => $sess->getUserId(), 
              'chi_nota'    => $parent->tic_nota_in
         );
         $primary_db->do_execute($sql6,$errores,$params6);
        
    }
}
?>
