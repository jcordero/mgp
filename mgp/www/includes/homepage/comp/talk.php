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
	include_once "beans/call_status.php";
	include_once "beans/person_status.php";
	
	class talk
	{
  		private $m_session;
  		private $m_person;
  		
		 function __construct()
	    {
		    $this->m_session = new call_status(); //Crea el objeto y carga los valores desde la sesion
		    $this->m_person = new person_status();
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
            $html.= '<div id="person_status">'.$this->m_person->person_status.'</div>'; //ANONIMO
        
            $html.= '
	</div>
	
	<div id="talk_search">
		<script type="text/javascript">
			var person = '.$this->m_person->toJSON().';
			var talk = '.$this->m_session->toJSON().';
		</script>';
            
        //Esto genera los campos pm_person_doc (pais) tm_person_doc (tipo doc) y nm_person_doc (nro doc)    
            $doc = new CField(array("presentation"=>"CIUDADANO::DNI","name"=>"person_doc","label"=>"Doc.","isvisible"=>true,"classparams"=>"no_search","value"=>$this->m_person->person_doc,"initialvalue"=>"ARG DNI "));
            $doc->NewInstance($primary_db);
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
