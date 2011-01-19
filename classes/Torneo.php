<?php
/**
 * Table Definition for torneo
 */
require_once 'DB/DataObject.php';

class DataObjects_Torneo extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'torneo';              // table name
    public $to_id;                           // int(4)  primary_key not_null
    public $to_nombre;                       // varchar(45)   not_null
    public $to_fecha_inicio;                 // date   not_null
    public $to_cantidad_fechas;              // int(4)   not_null
    public $to_estado;                       // varchar(11)   default_PROXIMO

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Torneo',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
