<?php 
/* Control para el operador de CALL CENTER
 *
 * person_status NOMINAL/ANONIMO
 *
 */

if(!class_exists('talk_view'))
{
    include_once "common/cfield.php";
	include_once "beans/person_status.php";
	
	class talk_view
	{
  		private $m_person;
  		
		 function __construct()
	    {
		    $this->m_person = new person_status();
		}
		
		public function Render($context)
		{
			
            $html = '
<script type="text/javascript">
	var person = '.$this->m_person->toJSON().';
</script>

<div class="container">
	<div class="row" id="identificado">
		<div class="span4">
                    Ciudadano:<br>
                    <h4>'.$this->m_person->person_nombres.' '.$this->m_person->person_apellido.'</h4>
		</div>
		<div class="span4">
			<b>Doc.:</b> '.$this->m_person->person_doc.'<br/>';
            if($this->m_person->person_edad>0 && $this->m_person->person_edad<200)
                $html.='<b>Edad:</b> '.$this->m_person->person_edad.'<br/>';
            
            if($this->m_person->person_sexo!=='')
                $html.='<b>Género:</b> '.$this->m_person->person_sexo;
            
            $html.='
		</div>
	</div>
</div>';
	                    
            $style = '
<style>
    #identificado {border:solid 1px #ccc;border-radius:5px;background:#efefef;margin-top:10px;margin-bottom:10px;padding-bottom:5px;text-align:left;padding-top:5px;}
</style>
            ';
            
			$content["talk_view"] = $style.$html;
			$includes = array();
			$err = array();
			return array( $content, $err, $includes );
		}
	}
}

?>	
