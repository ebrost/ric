<?php
class Tag extends AgendaAppModel
{
    public $name='Tag';
    public $actsAs = array('Containable');
    
  /*  
    public $hasAndBelongsToMany = array(
        'Evenement'=> array('className'=>'Agenda.Evenement'),
    );
*/
}
