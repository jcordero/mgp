<?php 
include_once "common/cdatatypes.php";

//El cuestionario es armado dinamicamente por el objeto de prestaciones al seleccionar una prestacion

class CDH_CUESTIONARIO extends CDataHandler
{
    function __construct($parent)
    {
        parent::__construct($parent);
    }
	
    /** 
     * Dibujo el cuestionario
     * 
     * @param type $cn
     * @param type $name
     * @param type $id
     * @param type $prefix
     * @return string
     */ 
    function RenderFilterForm($cn,$name="",$id="",$prefix="") 
    {
        $html = "";
        $fld = $this->m_parent;
        $json = trim($fld->getValue());
        if($name=="") 
            $name=$this->getName();

        if($id=="")	
            $id=$name;

        if($fld->m_IsVisible==false)
        {
            //El campo esta invisible...
            $html.="<input type=\"hidden\" name=\"$name\" id=\"$id\" value=\"$json\"/>"."\n";

            //DIV para insertar el Cuestionario (que viene bajo demanda por AYAX)
            $html.='<div id="'.$id.'_placeholder"></div>'."\n"; 
        } 

        return $html;
    }
    
    
    /**
     * Creo el cuestionario a partir del formulario recibido
     * 
     * @global type $primary_db
     * @return type
     */
    function loadForm()
    {
        global $primary_db;
        $fld = $this->m_parent;

        if($fld->m_ClassParams=='') {
            error_log("CDH_PRESTACION::loadForm() Falta definir campo prestacion en el classparams.");
            $fld->setValue('');
            return;
        }

        if(!isset($_POST["m_".$fld->m_ClassParams]))
        {
            //Al cargar el formulario por primera vez, este campo esta en blanco
            $fld->setValue('');
            return;
        }

        $prestacion = $_POST["m_".$fld->m_ClassParams];
        if($prestacion=='')
        {
            $fld->setValue('');
            error_log("CDH_PRESTACION::loadForm() No hay una prestacion seleccionada.");
            return;
        }

        //Proceso cuestionario
        $sql = "SELECT tpr_code, tcu_code, tpr_orden, tpr_preg, tpr_tipo_preg, tpr_opciones, tpr_miciudad FROM tic_prestaciones_cuest WHERE tpr_code='{$prestacion}'";
        $re = $primary_db->do_execute($sql);
        while( $myrow=$primary_db->_fetch_row($re) )
        {
            $q = $myrow['tcu_code']; //codigo unico de la pregunta
            $tipo = $myrow['tpr_tipo_preg'];

            //Proceso la(s) respuesta(s) a la pregunta
            $res = '';
            if( isset($_POST['cuest_'.$q]) )
            {
                $recibido = $_POST['cuest_'.$q];
                if( is_array($recibido) )
                {
                    //Si es un multiple, el valor elegido es un array
                    foreach($recibido as $rsp)
                        $res.= $rsp.'|';
                }
                else
                {
                    //Si es un checkbox
                    if($tipo=='CHECKBOX')
                        $res = $recibido;
                    else        
                        $res = $recibido;
                }
            }

            //Salvo la respuesta
            $result[] = array(
                'tpr_code'      =>  $prestacion,
                'tcu_code'      =>  $q, 
                'tpr_preg'      =>  $myrow['tpr_preg'], 
                'tpr_tipo_preg' =>  $tipo, 
                'tpr_respuesta' =>  $res, 
                'tpr_miciudad'  =>  $myrow['tpr_miciudad']
            );
        }

        //Persisto la respuesta como un objeto JSON
        $fld->setValue(json_encode($result));
    }

    
    /**
     * Caso que el cuestionario este en una vista solo lectura
     * 
     * @param type $cn
     * @param type $showlabel
     * @return string
     */
    function RenderReadOnly($cn,$showlabel=false)
    {
            $fld = $this->m_parent;
            $obj_tabla = $fld->m_parent; //modelo (tabla)
            //$obj = $obj_tabla->m_parent; //modelo
            
            //Busco la prestación en el modelo (estoy en una tabla) tpr_code
            $tpr_code = $obj_tabla->getField('tpr_code')->getValue();
            
            //Busco el codigo de ticket
            //$tic_nro = $obj->
            error_log("CDH_CUESTIONARIO::RenderReadOnly() obj_tabla = instancia de ".  get_class($obj_tabla));
            $html='';
            $name = "m_".$fld->m_Name;

            if($fld->m_IsVisible)
            {
                $cuest = self::htmlVerCuestionario($tic_nro, $tpr_code);
                if($showlabel)
                    $html.="<div class=\"itm\"><div class=\"desc\">{$fld->m_Label}</div><div class=\"fldro\">{$cuest}</div></div>"."\n";
                else
                    $html.=$cuest;
            }
            else
            {
                //Campo oculto
                $id = $name;
                $html.="<input type=\"hidden\" name=\"{$name}\" id=\"{$id}\" value=\"{$val}\"/>"."\n";
            }

            return $html;
    }


    /**
     * Caso de que el campo este en el area de edicion de una tabla
     * Es llamado por el objeto CField / Llamado por ctable_handler
     * 
     * @param type $cn
     * @param type $frmname
     * @param type $table
     * @param type $row
     * @param type $ro
     * @param type $name
     * @param type $suffix
     * @return type
     */
    function RenderTableEdit($cn,$frmname,$table="",$row=0,$ro=false,$name="",$suffix="")
    {
        $fld = $this->m_parent; //Este campo
        $obj_tabla = $fld->m_parent; //Modelo (estoy en una tabla)
        $obj = $obj_tabla->m_parent;
        
        if($name=="")
            $name = $this->getName($table,$row);

        if($frmname=="")
            $id = $name;
        else
            $id = $frmname."_".$name;

        
        $obj_tpr_code = ($obj_tabla ? $obj_tabla->getField('tpr_code') : null);
        $tpr_code = ($obj_tpr_code ? $obj_tpr_code->getValue() : '');

        $obj_tic_nro = ($obj ? $obj->getField('tic_nro') : null);
        $tic_nro = ($obj_tic_nro ? $obj_tic_nro->getValue() : '');

        
//        error_log("CDH_CUESTIONARIO::RenderTableEdit(frmname=$frmname,table=$table,row=$row,name=$name,ro=".($ro ? 'si':'no').") tpr_code=$tpr_code tic_nro=$tic_nro \n"); 
//            this=".get_class($this)." padre:".get_class($this->m_parent)."\n
//            fld=".get_class($fld)." padre:".get_class($fld->m_parent)."\n
//            obj_tabla=".get_class($obj_tabla)." padre:".get_class($obj)." ancestro del padre:".  get_parent_class($obj)."\n
//            lista de campos del padre: ".print_r(array_keys($obj->m_fields),true)."\n
//            valor del campo tic_nro:".$obj->m_fields['tic_nro']->readValue() 
//        );
 
        
        //Compongo el valor del campo
        $mostrar = self::htmlVerCuestionario($tic_nro, $tpr_code);

        //Si es read only, pongo el valor del campo dentro un HIDDEN, si no muestro el campo editable
        if($ro)
        {
            //Si es read-only y visible, muestro un texto (si es invisible no muestro nada)
            if($fld->m_IsVisible)
            {
                $html.="<div id=\"t{$name}\">{$mostrar}</div>\n";
            }
        }
        else
        {
            //El campo es editable, se usa para editar un registro
            //Anulo la funcion de busqueda flexible asi no sale el indicador
            $fld->m_search="fix";
            $html = $this->RenderFilterForm($cn,$name,$id,$id);
        }

        return $html;
    }

    
    /**
     * Crea el cuestionario de una prestacion en HTML
     * 
     * @global type $primary_db
     * @param type $prestacion
     * @return string
     */    
    static function crearCuestionario($prestacion)
    {
        global $primary_db;

        //Armo el Cuestionario
        $html = '
        <div id="sub_prestaciones_cuest" class="tabla">
            <div class="bloque">
                <div id="subtit_prestaciones_cuest" class="titulo">
                    <div class="titulo_texto">Cuestionario</div>
                </div>
                <table class="caja2">
                <thead>
                    <tr>
                        <th>Pregunta</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody id="tbody_prestaciones_cuest">';

        $sql2 = "SELECT tpr_code, tcu_code, tpr_orden, tpr_preg, tpr_tipo_preg, tpr_opciones, tpr_miciudad FROM tic_prestaciones_cuest WHERE tpr_code='{$prestacion}'";
        $re2 = $primary_db->do_execute($sql2);
        
        $cant = 0;
        while( $myrow=$primary_db->_fetch_row($re2) )
        {
            $buff = '';
            $opciones = $myrow['tpr_opciones']; 
            $q = $myrow['tcu_code'];
            $cant++;
            
            switch($myrow['tpr_tipo_preg']) {
                case "TEXTO":
                    $buff.= '<input type="text" id="cuest_'.$q.'" name="cuest_'.$q.'">';
                    break;

                case "LISTA":
                    $buff.= '<select id="cuest_'.$q.'" name="cuest_'.$q.'">';
                    $partes = explode(';',$opciones);
                    foreach($partes as $parte)
                    {
                        $p = trim($parte);
                        $buff.= '<option value="'.$p.'">'.$p;
                    }
                    $buff.= '</select>';
                    break;
                case "MULTIPLE":
                    $partes = explode(';',$opciones);
                    foreach($partes as $parte)
                    {
                        $p = trim($parte);
                        $buff.= '<span class="form-inline"><label for="cb_cuest_'.$cant.'">'.$p.'</label> <input type="checkbox" name="cuest_'.$q.'" id="cb_cuest_'.$cant.'"></span>  ';
                    }
                    break;
                case "CHECKBOX":
                    $buff.= '<input type="checkbox" name="cuest_'.$q.'">';
                    break;
                default:
            }
            
            $html.= '<tr><td>'.$myrow['tpr_preg'].'</td><td>'.$buff.'</td></tr>';
        }
        $html.= '</tbody>
        </table></div>
        </div>';//Seccion

        //Caso que no haya ninguna pregunta para esta prestacion...
        if($cant==0)
            $html = '';
        
        return $html;
    }

    static function htmlVerCuestionario($ticket, $prestacion) {
        global $primary_db;
        
        if($ticket==='' || $prestacion==='')
                return '';
        
        $h = '<div class="cuestionario">';
        $sql2 = "SELECT tic_nro, tpr_code, tcu_code, tpr_preg, tpr_tipo_preg, tpr_respuesta, tpr_miciudad FROM tic_ticket_cuestionario WHERE tpr_code='{$prestacion}' and tic_nro='{$ticket}'";
        $re2 = $primary_db->do_execute($sql2);
        while( $row=$primary_db->_fetch_row($re2) )
        {
            $h.='<div class="cuest form-inline"><span class"preg">'.$row['tpr_preg'].':</span> <span class="resp">'.$row['tpr_respuesta'].'</span></div>';
        }
        $h.='</div>';
        return $h;
    }
}
?>