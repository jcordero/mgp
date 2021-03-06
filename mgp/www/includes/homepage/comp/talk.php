<?php

/* Control para el operador de CALL CENTER
 *
 * talk_status CONECTADO/EN ESPERA
 * person_status NOMINAL/ANONIMO
 *
 * person_doc (documento del ciudadano)
 * person_nombres
 * person_apellido
 *
 * talk_begin (timestamp de comienzo de sesion)
 * talk_end (timestamp de fin de sesion)
 * talk_ani
 * talk_entry_point
 * talk_session
 */


include_once "common/cfield.php";
include_once "beans/call_status.php";
include_once "beans/person_status.php";

class talk {

    private $m_session;
    private $m_person;

    function __construct() {
        $this->m_session = new call_status(); //Crea el objeto y carga los valores desde la sesion
        $this->m_person = new person_status();
    }

    public function Render(ccontext $context) {
        global $primary_db;

        if (strstr(strtolower($_SESSION["groups"]), "home_operator") === false) {
            $content["talk"] = "";
            return array($content, array());
        }

        $html = '
<script type="text/javascript">
	var person = ' . $this->m_person->toJSON() . ';
	var talk = ' . $this->m_session->toJSON() . ';
</script>
	                    
<div id="talk" class="row">
	<div class="col-xs-8">
            <div id="talk_search">
                <div class="row">';    
                //Esto genera los campos pm_person_doc (pais) tm_person_doc (tipo doc) y nm_person_doc (nro doc)    
                $doc = new CField(array("presentation" => "CIUDADANO::DNI", "name" => "person_doc", "label" => "", "isvisible" => true, "classparams" => "no_search", "value" => $this->m_person->person_doc, "initialvalue" => "ARG DNI "));
                $doc->NewInstance($primary_db);
                $html.=$doc->RenderFilterForm($primary_db);

                $html.= '
                </div>
                <div class="row">
                    <div class="col-xs-10">
                        <div class="col-xs-offset-8 col-xs-4">
                            <button onclick="boton_buscar()" class="btn btn-primary col-xs-12"><i class="icon-search"></i>  Buscar</button>
                        </div>
                    </div>
                </div>    
            </div>
		
            <div id="identificado" class="row">
                <div id="talk_nominal" class="col-xs-9"></div>            
                <div id="talk_actions" class="col-xs-3">
                    <button id="talk_btn_anonimo" onclick="boton_anonimo()" class="btn"><i class="icon-off"></i> Terminar</button>
                    <button id="talk_btn_modificar" onclick="boton_modificar()" class="btn"><i class="icon-edit"></i> Modificar</button>
                    <button id="talk_btn_terminar" onclick="boton_terminar()" class="btn">Terminar</button>        
                </div>        
            </div>
	</div>    
	

	<div id="indicadores" class="col-xs-2 col-xs-offset-2">';

        //Al iniciar una sesion se crea un nuevo objeto sesion. El mismo se inicia con la
        //persona identificada. Si no hay una persona identificada, se busca el ANI en la base
        //para identificar a la persona de ser posible antes de iniciar la sesion.
        //Una sesion anonima, se puede hacer nominal con solo identificar a la persona con la sesion abierta.

        $html.= '<button id="talk_status" class="btn">' . $this->m_session->talk_status . '</button>  '; //EN ESPERA
        $html.= '<button id="person_status" class="btn">' . $this->m_person->person_status . '</button>'; //ANONIMO
        $html.= '
	</div>
	
	
</div>';


        $style = '
<style>
    #indicadores{border: solid 1px #ddd;border-radius:5px;padding:10px;text-align:center;margin-top:10px;}
    #indicadores button {margin:3px;width:90%;}
    
    #talk_btn_anonimo, #talk_btn_modificar, #talk_btn_terminar {display:none}
    
    #person_doc label {display:none}
    
    #talk_search, #identificado {background: #fff;padding: 5px;margin-top: 10px;border-radius: 5px;}
    #talk_search div {margin-top:3px;}
    #talk_actions button {margin-top:5px;width:100%;}
    .btn-small {width:90px;}
</style>
            ';

        $includes[] = '<script type="text/javascript" src="' . WEB_PATH . '/includes/home_call.js"></script>';
        $includes[] = '<script type="text/javascript" src="' . WEB_PATH . '/includes/presentation/ciudadano/dni.js"></script>';
        $includes[] = '<script type="text/javascript"> '
                        . '$(document).ready( function() { '
                            . 'initDNI("person_doc", {}); '
                        . '} );'
                    . '</script>';

        
        $context->add_content($context->m_key, $style.$html);
        $context->add_includes($includes);
        return;
    }

}
