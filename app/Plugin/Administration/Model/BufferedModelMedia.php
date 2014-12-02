<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BuffredFicheactiviteImage
 *
 * @author manu
 */
App::uses('AdministrationAppModel', 'Administration.Model');

class BufferedModelMedia extends AdministrationAppModel{
    //put your code here
    public $name;
    
    public $tablePrefix='';
    public $useTable='ric_medias_lies';
   // public $actsAs = [ 'Essence.Embeddable' ];
    
    public function saveMedia($data){
      
      
      $mediaData=$data['media'];
      unset($data['media']);
      unset($data['AdministrationUserEditMedia']);
      $model=array_shift(array_keys($data));
      debug($model);
         $this->deleteAll(array($this->name.'.model'=>$model,$this->name.'.foreign_key'=>$data[$model]['foreign_key'],$this->name.'.category'=>$data[$model]['category']),false);
        // debug($mediaData);
         foreach ($mediaData as $key=>$mediaDatum) {
             $mediaData[$key]['model']=$model;
             $mediaData[$key]['category']=$data[$model]['category'];
             $mediaData[$key]['foreign_key']=$data[$model]['foreign_key'];
             unset($mediaData[$key]['id']);
         }
        try {
            $this->saveAll($mediaData) ;
               $log = $this->getDataSource()->getLog(false, false);
            debug($mediaData);      
        }
        //$dataSource->commit();
       catch(Exception $e){
           debug($e->getMessage());
       }
          //  debug("rollback");
      //  $dataSource->rollback();
           
    }
        
         
    
    
    public function afterFind($results, $primary = false) {
     
         parent::afterFind($results, $primary);
         if (!empty($results)){
           
             foreach ($results as $key=>$value){
                 
               if (!empty($results[$key]['ExternalMedia']['url'])) $results[$key]['ExternalMedia']['content']=$this->embed($results[$key]['ExternalMedia']['url'] );
               else if(!empty($results[$key]['url']))  $results[$key]['content']=$this->embed($results[$key]['url'] );
             }
         }
         else{
           
               $results['content']=$this->embed($results['url'] );
         }
           
        return $results; 
   
     }
   
}
