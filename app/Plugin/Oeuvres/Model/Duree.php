
<?php
App::uses('Critere', 'Oeuvres.Model');
class Duree extends Critere
{	
	public $name='Duree';
	
	public function beforeFind($queryData) {
        
        parent::beforeFind($queryData);
        $defaultConditions = array('Duree.critere' => 'duree');
        $queryData['conditions'] = array_merge((array)$queryData['conditions'], $defaultConditions);
        $queryData['order'] = 'order';
        return $queryData;
    }
	
}	
