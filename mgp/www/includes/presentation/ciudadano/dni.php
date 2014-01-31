<?php 
include_once "common/cdatatypes.php";

// PAIS TIPO NUMERO

class CDH_DNI extends CDataHandler {
	function __construct($parent) {
		parent::__construct($parent);
		$fld = $this->m_parent;
		$fld->m_allow_blank=true;
		$fld->m_js_validate = "valDNI";
		$fld->m_js_totext = "toTextDNI";
		$fld->m_js_tovalue = "toTextDNI";
		$fld->m_js_edit = "editDNI";
                $fld->m_js_initial = "initDNI";
		$this->m_js_main_search="chg_dni";
	}
	
        /** Generar HTML para formulario
         * 
         * @param type $cn
         * @param type $name
         * @param type $id
         * @param type $pre
         * @return string
         */
	public function RenderFilterForm($cn,$name="",$id="",$pre="")
	{
		if($name=="")
                    $name=$this->getName();
		
		if($id=="")
                    $id=$name;
		
		$fld = $this->m_parent;
	
		$val = $this->getValue();
		if(!$fld->m_IsVisible)
		{
                    $html.="<input type=\"hidden\" name=\"$name\" id=\"$id\" value=\"$val\"/>";
		}
		else
		{
                    //val = campo compuesto
                    //val1 = tipo de documento
                    //val2 = numero de documento
                    $lista = explode(' ', $val);
                    $val1 = (isset($lista[0]) ? $lista[0] : "");
                    $val2 = (isset($lista[1]) ? $lista[1] : "");
                    $val3 = (isset($lista[2]) ? $lista[2] : "");

                    $html ="<div id=\"$fld->m_Name\" class=\"itm\">
                    <div class=\"desc\">$fld->m_Label</div>
                    <div class=\"fld\">
                            <input type=\"hidden\" name=\"$name\" id=\"$id\" value=\"$val\"/>";
	
                    if($fld->m_IsReadOnly)
                    {
                            $html.=" $val";
                    }
                    else
                    {
                            //Pais
                            $html.="<select name=\"p{$name}\" id=\"p{$id}\" data-selected=\"{$val1}\">";	
                            $html.=$this->getOptions();
                            $html.="</select> ";

                            //Tipo de documento
                            $html.="<select name=\"t{$name}\" id=\"t{$id}\" data-selected=\"{$val2}\">
                                <option value=\"DNI\">DNI
                                <option value=\"LE\" >LE
                                <option value=\"LC\" >LC
                                <option value=\"PAS\">PAS
                                <option value=\"CI\" >CI
                                <option value=\"PRE\">PRE
                            </select> ";

                            //Nro de documento
                            $html.=" <input type=\"text\" name=\"n{$name}\" id=\"n{$id}\" value=\"{$val3}\" maxlength=\"15\" size=\"12\" />";

                            if($fld->m_ClassParams!="no_search")
                            {
                                $html.=" <img id=\"b{$id}\" src=\"".WEB_PATH."/images/default/bt_go.gif\" onclick=\"chg_docid(this)\" border=\"0\"> ";
                            }
                    }
                    $html.="</div></div>"."\n";
		}
		return $html;
	}
	
	
	function loadForm()
	{
		$fld = $this->m_parent;
		$val1 = "";
		$val2 = "";
		if($fld->m_no_form==false)
		{
			$val  = (isset($_REQUEST["m_".$fld->m_Name])  ? $_REQUEST["m_".$fld->m_Name]  : "");
			$val1 = (isset($_REQUEST["pm_".$fld->m_Name]) ? $_REQUEST["pm_".$fld->m_Name] : "");
			$val2 = (isset($_REQUEST["tm_".$fld->m_Name]) ? $_REQUEST["tm_".$fld->m_Name] : "");
			$val3 = (isset($_REQUEST["nm_".$fld->m_Name]) ? $_REQUEST["nm_".$fld->m_Name] : "");
			
			//Combino los dos campos, el tipo y el nro de documento
			if($val1!="" && $val2!="" && $val3!="")
			{
				$fld->setValue($val1." ".$val2." ".$val3);
			}
			elseif($val!="")
			{
				$fld->setValue($val);
			}
			else
			{
				$fld->setValue("");
			}
		}
	}
	
	function getJsIncludes()
	{
            return '<script type="text/javascript" src="'.WEB_PATH.'/includes/presentation/ciudadano/dni.js"></script>';
	}
        
        function buscarPadron($p) {
            global $padron_db;
            list($pais,$tipo,$nro) = explode(' ',$p);
            $nro = intval($nro);
            $ret = array('resultado'=>'no encontrado');
            if($pais==='ARG') {
                $row = $padron_db->QueryArray("SELECT matricula,apelnom,direcc,clase,ocup,sexo,tipo,localidad,provincia,depto FROM padron_2007 where matricula={$nro}");
                if($row) {
                    list($apellido, $nombre) = explode(' ',$row['apelnom'],2);
                    $genero = $row['sexo']==='F' ? 'FEMENINO' : 'MASCULINO';
                    $ret = array(
                        'resultado'     => 'encontrado',
                        'nro'           => $row['matricula'],
                        'nombre'        => $nombre,
                        'apellido'      => $apellido,
                        'direccion'     => $row['direcc'],
                        'ocupacion'     => $row['ocup'],
                        'genero'        => $genero,
                        'localidad'     => $row['localidad'],
                        'provincia'     => $row['provincia'],
                        'barrio'        => $row['depto']
                    );
                }
            }
            return json_encode($ret,JSON_UNESCAPED_UNICODE);
        }
        
        private function getOptions() {
            global $primary_db;
           
            if(function_exists('apc_fetch')) {
                $opt = apc_fetch('CDH_DNI: lista_paises');
                if($opt!==false)
                    return $opt;
            }
            
            $html='';
            $rs = $primary_db->do_execute("SELECT cpa_code, cpa_descripcion FROM ciu_paises ORDER BY 2");
            while($row=$primary_db->_fetch_row($rs)) {
                $html.="<option value=\"{$row['cpa_code']}\">".$row['cpa_descripcion'];
            }	
            
            if(function_exists('apc_store')) {
                apc_store('CDH_DNI: lista_paises',$html);
            }
            return $html;
        }
}
?>