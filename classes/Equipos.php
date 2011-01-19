<?php
/**
 * Table Definition for equipos
 */
require_once 'DB/DataObject.php';

class DataObjects_Equipos extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'equipos';             // table name
    public $eq_id;                           // int(4)  primary_key not_null
    public $eq_nombre;                       // varchar(45)   not_null

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Equipos',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
