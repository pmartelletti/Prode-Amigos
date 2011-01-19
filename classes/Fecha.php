<?php
/**
 * Table Definition for fecha
 */
require_once 'DB/DataObject.php';

class DataObjects_Fecha extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'fecha';               // table name
    public $fe_id;                           // int(4)  primary_key not_null
    public $fe_nombre;                       // varchar(11)   not_null
    public $fe_to_id;                        // int(4)   not_null
    public $fe_fecha_inicio;                 // date   not_null
    public $fe_fecha_fin;                    // date   not_null
    public $fe_estado;                       // varchar(11)   default_PENDIENTE
    public $fe_fecha_fin_apuesta;            // datetime   not_null

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Fecha',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
