<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Attachment
 *
 * @author manu
 */

class Attachment extends AppModel{
    public $useTable='medias';
     public $actsAs = array(
        'Upload.Upload' => array(
            'file' => array(
               'path'=>'{ROOT}webroot{DS}medias{DS}{model}{DS}',
                
            ),
        )
    );
     public $validate=array(
         'file'=>array(
             
             'maxSize'=>array(
                'allowEmpty' => true,
                'required' => false,
                'rule'=>array('isBelowMaxSize',1048576,false),
                'message'=>'Fichier trop volumineux :1 Mo maximum'
             ),
         )
     );
    
    
        
        public function checkSize($weight){
             if( $weight>$this->validate['file']['maxSize']['rule'][1]){
                 return $this->validate['file']['maxSize']['message'];
             } 
            
        }
        public function checkMimeType($mimetype){
             if(!in_array($mimetype,$this->validate['file']['mimetype']['rule'][1] )){
                 return $this->validate['file']['mimetype']['message'];
             } 
            
        }
     
    public function getValidExt(){
         
          return($this->validate['file']['extension']['rule']['1']);   
         
     }
     public function getValidExtText(){
         
          return($this->validate['file']['extension']['message']);   
         
     }


}
