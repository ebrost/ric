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
class Image extends Attachment{


     public $actsAs = array(
        'Upload.Upload' => array(
            'file' => array(
               'path'=>'{ROOT}webroot{DS}medias{DS}{model}{DS}',
                //'mimetypes'=>array('image/gif'),
                'thumbnailMethod'=>'php',
                'thumbnailSizes' => array(
                    'xvga' => '1024x768',
                    'vga' => '640x480',
                    'thumb' => '[70x70]',
                    'icon'=>'[30x30]',
                    'medium'=>'[200x200]',
                ),
            ),
        ),
    );
 
     public $validate=array(
         'file'=>array(
             'mimetype'=>array(
                'allowEmpty' => true,
                'required' => false,
                'rule'=>array('isValidMimeType',array('image/gif','image/jpeg','image/png'),false),
                'message'=>'Formats d\'images autorisés: gif, jpeg et png'
             ),
             'extension'=>array(
                'allowEmpty' => true,
                'required' => false,
                'rule'=>array('isValidExtension',array('gif','jpg','jpeg','png'),false),
                'message'=>'Extensions autorisées: gif,jpg,jpeg et png'
             ),
             'maxSize'=>array(
                'allowEmpty' => true,
                'required' => false,
                'rule'=>array('isBelowMaxSize',1048576,false),
                'message'=>'Fichier trop volumineux :1 Mo maximum'
             ),
         )
     );
     
     
    public function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);
         $imagesResizing = (array) Configure::read('ImagesResizing');
        if (!empty($imagesResizing)) $this->actsAs['Upload.Upload']['file']['thumbnailSizes']=$imagesResizing;
      
      
    } 
   
    public function beforeFind($queryData) {
        parent::beforeFind($queryData);
        $defaultConditions = array('Image.category' => 'image');
        $queryData['conditions'] = array_merge((array)$queryData['conditions'], $defaultConditions);
        return $queryData;
    }
    
    public function beforeSave($options=array()){
         $this->data['Image']['category']='image';
     }
        
       
     
    
}
