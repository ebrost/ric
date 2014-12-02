<?php
App::uses('Critere', 'Oeuvres.Model');
class Prix extends Critere
{	
	public $name='Prix';
	
	public function beforeFind($queryData) {
        
        parent::beforeFind($queryData);
        $defaultConditions = array('Prix.critere' => 'prix');
        $queryData['conditions'] = array_merge((array)$queryData['conditions'], $defaultConditions);
        $queryData['order'] = 'order';
        return $queryData;
    }
	
}	
