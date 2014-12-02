<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Media
 *
 * @author manu
 */
App::uses('Attachment', 'Model');
class Document extends Attachment{

 
     public $validate=array(
         'file'=>array(
             'mimetype'=>array(
                'allowEmpty' => true,
                'required' => false,
                'rule'=>array('isValidMimeType',array('application/pdf'),false),
                'message'=>'Formats autorisés: pdf'
             ),
             'extension'=>array(
                'allowEmpty' => true,
                'required' => false,
                'rule'=>array('isValidExtension',array('pdf'),false),
                'message'=>'Extension autorisée: pdf'
             ),
             'maxSize'=>array(
                'allowEmpty' => true,
                'required' => false,
                'rule'=>array('isBelowMaxSize',1048576,false),
                'message'=>'Fichier trop volumineux :1 Mo maximum'
             ),
         )
     );
      public function beforeFind($queryData) {
        
        parent::beforeFind($queryData);
        $defaultConditions = array('Document.category' => 'document');
        $queryData['conditions'] = array_merge((array)$queryData['conditions'], $defaultConditions);
     
        return $queryData;
    }
    
   
     public function beforeSave($options=array()){
         $this->data['Document']['category']='document';
     }
    
    
        
       
     
    
}
