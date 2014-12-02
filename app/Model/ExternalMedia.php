<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExternalMedia
 *
 * @author manu
 */
class ExternalMedia extends AppModel{
    //put your code here
    public $useTable='medias_externes';
    
     public $actsAs = [ 'Essence.Embeddable' ];
     
     public function afterFind($results, $primary = false) {

         parent::afterFind($results, $primary);
         if (!empty($results)){
             if(!empty($results['url']))  $results['content']=$this->embed($results['url'] );
             else{
                 foreach ($results as $key=>$value){
              //   debug($results[$key]['ExternalMedia']['url']);
               if (!empty($results[$key]['ExternalMedia']['url'])) $results[$key]['ExternalMedia']['content']=$this->embed($results[$key]['ExternalMedia']['url'] );
               else if(!empty($results[$key]['url']))  $results[$key]['content']=$this->embed($results[$key]['url'] );
               
                }
             }
         }
        
           
        return $results; 
   
     }
}
