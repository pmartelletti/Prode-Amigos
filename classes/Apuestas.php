<?php
/**
 * Table Definition for apuestas
 */
require_once 'DB/DataObject.php';

class DataObjects_Apuestas extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'apuestas';            // table name
    public $ap_id;                           // int(4)  primary_key not_null
    public $ap_par_id;                       // int(4)   not_null
    public $ap_us_id;                        // int(4)   not_null
    public $ap_ganador;                      // varchar(11)   not_null
    public $ap_puntaje;                      // int(4)  
    public $ap_fecha_creacion;               // datetime   not_null
    public $ap_fecha_actualizacion;          // datetime  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Apuestas',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
