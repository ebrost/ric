<?php
class AgendaGenre extends AgendaAppModel
{
   public $name='AgendaGenre'; 
   public $useTable='genres';
   public function getListforForm($hierarchicalSpacer=''){
      $listGenres= $this->find('list');
		foreach ($listGenres as $key=>$value){
                    $level= ceil(strlen($key)/2);
			$optionsGenres[]=array('value'=>$key,'name'=>str_repeat($hierarchicalSpacer,$level).$value,'class'=>" changeListener level_".strval($level));
		}
     return $optionsGenres;
   } 
  

}
