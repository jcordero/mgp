<?php 
include_once "presentation/text.php";


class CDH_HISTORIA extends CDH_TEXT
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$fld = $this->m_parent;
	}
	
	function getValue() 
	{
		$fld = $this->m_parent;
		$val = trim( $fld->readValue() );

		//Debe terminar en un nodo </table>
		if($val!="") {
			if(substr($val,-8)!="</table>") {
				if(substr($val,-5)!="</tr>") {
					if(substr($val,-5)!="</td>") {
						$val.="</td></tr></table>";
					}
					else {
						$val.="</tr></table>";		
					}
				} else {
					$val.="</table>";
				}
			}
		}
		
		return $val;
	}
	
}
?>