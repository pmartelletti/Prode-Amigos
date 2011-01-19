<?php
/**
 * Table Definition for partidos
 */
require_once 'DB/DataObject.php';

class DataObjects_Partidos extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'partidos';            // table name
    public $par_id;                          // int(4)  primary_key not_null
    public $par_local_eq_id;                 // int(4)   not_null
    public $par_visitante_eq_id;             // int(4)   not_null
    public $par_local_goles;                 // int(4)   not_null
    public $par_visitante_goles;             // int(4)   not_null
    public $par_fe_id;                       // int(4)   not_null
    public $par_jugado;                      // tinyint(1)   not_null

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Partidos',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
