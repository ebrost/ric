
<?php
App::uses('Critere', 'Oeuvres.Model');
class Jauge extends Critere
{	
	public $name='Jauge';
	
	public function beforeFind($queryData) {
        
        parent::beforeFind($queryData);
        $defaultConditions = array('Jauge.critere' => 'jauge');
        $queryData['conditions'] = array_merge((array)$queryData['conditions'], $defaultConditions);
        $queryData['order'] = 'order';
        return $queryData;
    }
	
}	
