<?php
include_once "common/cdatatypes.php";
include_once "beans/ticket.php";
include_once "beans/functions.php";

class CDH_REPORTES extends CDataHandler {
    function __construct($parent) 
    {
        parent::__construct($parent);
    }
    
    function getTickets($p) {
        global $primary_db;
        $conjunto = array();
        
        $rs = $primary_db->do_execute("select * from tic_ticket");
        while( $row=$primary_db->_fetch_row($rs) ) {
            $conjunto[] = array(
                'lat'=>$row['tic_coordx'],
                'lng'=>$row['tic_coordy'],
                'id'=>$row['tic_identificador']
            ); 
        }
        
        return json_encode($conjunto);
    }
    
    function getTicketInfo($p) {
        
        $tic = new ticket();
        $tic->setIdent($p);
        if( $tic->load('archivos') ) {
            $pres = $tic->prestaciones[0];
            $h = '<h4>'.$tic->tic_identificador.'</h4>';
            $h.= $pres->tpr_code.' '.$pres->tpr_description.'<br>Estado: '.$tic->tic_estado.' Ingreso: '.ISO8601toDate($tic->tic_tstamp_in).'<br>';
            $h.= 'Nota: '.$tic->tic_nota_in.'<br>';
            
            //Fotos
            foreach($tic->archivos as $f) {
                $h .= '<img class="iwimg" src="'.WEB_PATH.'/webservices/foto/'.$f->doc_storage.'"><br>';
            }
            return $h;
        }
        
        return '';    
    }
    
    function getIndicadores($p) {
        $r = array(
            'chart' => array(
                'type'          => 'line',
                'marginRight'   =>  130,
                'marginBottom'  =>  25
            ),
            'title' => array(
                'text'  => 'Reporte de indicadores',
                'x'     => -20
            ),
            'subtitle' => array(
                'text'  =>  'Periodo ',
                'x'     =>  -20
            ),
            'xAxis' => array(
                'categories'    => array('A','B','C')
            ),
            'yAxis' => array(
                'title'     => array(
                    'text'  =>  'Cantidad'
                ),
                'plotlines' => array(
                    array(
                        'value' =>  0,
                        'width' =>  1,
                        'color' =>  '#808080'
                    )
                )
                
            ),
            'tooltip' =>array(
                'valueSuffix'   =>  'x'
            ),
            'legend'    => array(
                'layout'        =>  'vertical',
                'align'         =>  'right',
                'verticalAlign' =>  'top',
                'x'             =>  -10,
                'y'             =>  100,
                'borderWidth'   =>  0
            ),
            'series'    => array(
                array(
                    'name'  => 'tickets',
                    'data'  => array(7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6)
                )
            )
        );
        /* {
            chart: {
                type: 'line',
                marginRight: 130,
                marginBottom: 25
            },
            title: {
                text: 'Monthly Average Temperature',
                x: -20 //center
            },
            subtitle: {
                text: 'Source: WorldClimate.com',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Temperature (°C)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: '°C'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
            },
            series: [{
                name: 'Tokyo',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            }, {
                name: 'New York',
                data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
            }, {
                name: 'Berlin',
                data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
            }, {
                name: 'London',
                data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
            }]
        });
    });
         * 
         */
        return json_encode($r);
    } 
    
}