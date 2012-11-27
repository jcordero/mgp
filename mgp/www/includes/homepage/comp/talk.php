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

if(!class_exists('talk'))
{
    include_once "common/cfield.php";
	include_once "homepage/callsession.php";
    
	class talk
	{
  		private $m_session;
  		
		 function __construct()
	    {
		    $this->m_session = new callsession(); //Crea el objeto y carga los valores desde la sesion
		}
		
		public function Render($context)
		{
			global $sess,$primary_db;

			if( strstr(strtolower($_SESSION["groups"]),"home_operator")===false )
			{
				$content["talk"] = "";
				return array( $content, array() );
			}
			
            $html = '
<div id="talk">
	<div id="indicadores">';

            //Al iniciar una sesion se crea un nuevo objeto sesion. El mismo se inicia con la
            //persona identificada. Si no hay una persona identificada, se busca el ANI en la base
            //para identificar a la persona de ser posible antes de iniciar la sesion.
            //Una sesion anonima, se puede hacer nominal con solo identificar a la persona con la sesion abierta.
            
            $html.= '<div id="talk_status">'.$this->m_session->talk_status.'</div>'; //EN ESPERA
            $html.= '<div id="person_status">'.$this->m_session->person_status.'</div>'; //ANONIMO
        
            $html.= '
	</div>
	
	<div id="talk_search">
      	<input type="hidden" name="m_talk_ani" id="m_talk_ani" value="'.$this->m_session->talk_ani.'"/>
		<input type="hidden" name="m_talk_status" id="m_talk_status" value="'.$this->m_session->talk_status.'"/>
		<input type="hidden" name="m_person_status" id="m_person_status" value="'.$this->m_session->person_status.'"/>
		<input type="hidden" name="m_user_session" id="m_user_session" value="'.session_id().'"/>
		<input type="hidden" name="m_person_id" id="m_person_id" value="'.$this->m_session->person_id.'"/>
		<input type="hidden" name="m_entrypoint" id="m_entrypoint" value="'.$this->m_session->talk_entry_point.'"/>
		<input type="hidden" name="m_skill" id="m_skill" value="'.$this->m_session->talk_skill.'"/>
		<input type="hidden" name="m_person_apellido" id="m_person_apellido" value="'.$this->m_session->person_apellido.'"/>
		<input type="hidden" name="m_person_nombres" id="m_person_nombres" value="'.$this->m_session->person_nombres.'"/>
		<input type="hidden" name="m_sexo" id="m_sexo" value="'.$this->m_session->person_sexo.'"/>
        <input type="hidden" name="m_edad" id="m_edad" value="'.$this->m_session->person_edad.'"/>
        <input type="hidden" name="m_cops_id" id="m_cops_id" value="'.$this->m_session->person_cops_id.'"/>';
            
       		$nac = new CField(array("presentation"=>"NACIONALIDAD","name"=>"person_pais","label"=>"Nac.","isvisible"=>true,"value"=>$this->m_session->person_pais,"initialvalue"=>"Argentina"));
            $html.=$nac->RenderFilterForm($primary_db);  
     
            $doc = new CField(array("presentation"=>"DOCID","name"=>"person_doc","label"=>"Doc.","isvisible"=>true,"classparams"=>"no_search","value"=>$this->m_session->person_doc));
            $html.=$doc->RenderFilterForm($primary_db);  
            
            
            $html.= '<button onclick="boton_buscar()">Buscar</button>
	</div>
	
 	<div id="identificado">
    	Identificado como: <div id="talk_nominal"></div>
        <div id="cops"></div>            
	</div>
	
	<div id="talk_actions">
    	<button id="talk_btn_anonimo" onclick="boton_anonimo()">Anónimo</button>
        <button id="talk_btn_modificar" onclick="boton_modificar()">Modificar</button>
       	<button id="talk_btn_terminar" onclick="boton_terminar()">Terminar</button>        
   	</div>            
</div>';

            
            $style = '<style>
            #indicadores {width: 200px;border: solid 1px;border-radius: 5px;padding: 10px;text-align: center;float: right;background:#eee;}
            #indicadores div {padding:3px;margin:3px;}
            #talk {height: 190px;}
            #talk_search {width: 500px;float: left;height: 100px;}
            #talk_search button {margin-left:308px;margin-top:10px;}
            #talk_btn_anonimo, #talk_btn_modificar, #talk_btn_terminar {display:none}
            #botones_turnos {float: right;margin-top: 3px;}
            .buscar {background:none;border:none;text-align:left;}
            table {border-spacing: 0px;}
            th {background:#eee;padding: 5px;}
            td {border-bottom:solid 1px #ddd;padding:3px;min-heigth:38px;}
            table table {width:300px;border:solid 1px #ddd;}
            table table td {border:none;}
            #turnos_tbl tr {height: 38px;}
            </style>
            <script type="text/javascript" src="'.WEB_PATH.'/includes/home_call.js"></script>
            ';
            
            
			$content["talk"] = $style.$html;
			return array( $content, array() );
		}
	}
}

?>	
