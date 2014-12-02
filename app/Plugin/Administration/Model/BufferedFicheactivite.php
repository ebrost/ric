<?php

App::uses('AdministrationAppModel', 'Administration.Model');
App::uses('FrValidation', 'Localized.Validation');
class BufferedFicheactivite extends AdministrationAppModel
{
//  public $useTable= 'bufferedficheactivites';   
  public $name='BufferedFicheactivite';
  
//  public $belongsTo='Administration.Ficheactivite';
   public $validate=array(
        'nom_complet'=>array(
            'notEmpty'=>array(
			'rule'=>'notEmpty',
			'message'=>'Champ Obligatoire',
                       // 'required'=>true
			)
            ),
       'adresse'=>array(
            'notEmpty'=>array(
			'rule'=>'notEmpty',
			'message'=>'Champ Obligatoire',
                       // 'required'=>true
			)
            ),
        'telephone'=>array(
           'notEmpty'=>array(
			'rule'=>'notEmpty',
			'message'=>'Champ Obligatoire',
                        
			)
            ,
            'phone'=>array(
			'rule'=>array('phone', null, 'fr'),
			'message'=>'Téléphone non valide',
                         //'allowEmpty'=>true
			)
            ),
       'telephone_2'=>array(
            'phone'=>array(
			'rule'=>array('phone', null, 'fr'),
			'message'=>'Téléphone non valide',
                        'allowEmpty'=>true
			)
            ),
       'telecopie'=>array(
            'phone'=>array(
			'rule'=>array('phone', null, 'fr'),
			'message'=>'Télécopie non valide',
                         'allowEmpty'=>true
			)
            ),
       'telecopie_2'=>array(
            'phone'=>array(
			'rule'=>array('phone', null, 'fr'),
			'message'=>'Télécopie non valide',
                         'allowEmpty'=>true
			)
            ),
       'code_postal'=>array(
            'notEmpty'=>array(
			'rule'=>'notEmpty',
			'message'=>'Champ Obligatoire',
               // 'required'=>true
			),
           'postal'=>array(
                    'rule'=>array('postal', null, 'fr'),
                    'message'=>'Code postal non valide'
           )
            ),
       'ville'=>array(
            'notEmpty'=>array(
			'rule'=>'notEmpty',
			'message'=>'Champ Obligatoire',
                        
			)
            ),
       
       'url_site_web'=>array(
            'web'=>array(
			'rule'=>'url',
			'message'=>'Url non valide',
                         'allowEmpty'=>true
			)
            ),
       'email'=>array(
           'notEmpty'=>array(
			'rule'=>'notEmpty',
			'message'=>'Champ Obligatoire',
                        
			)
            ,
            'email'=>array(
			'rule'=>'email',
			'message'=>'Email non valide',
                         
			)
            ),
      
       'activites'=>array(
            'notEmpty'=>array(
			'rule'=>'notEmpty',
			'message'=>'Champ Obligatoire',
                //'required'=>true
			)
            ),
    );
   
   public $belongsTo=array(
       'AdministrationUser'=>array(
            'classNane'=>'AdministrationUser',
           'foreignKey'=>'user_id'),
        'Ficheactivite'=>array(
            'classNane'=>'annuaire.Ficheactivite',
           'foreignKey'=>'ficheactivite_id')
       );
  
   public $hasMany=array(
      
      'BufferedAnnuaireLien'=>array('className'=>'Administration.BufferedAnnuaireLien',
          'foreignKey'=>'buffered_ficheactivite_id',
          ),
    
     'BufferedFicheactiviteImage'=>array(
            'className'=>'Administration.BufferedFicheactiviteImage',
            'foreignKey'=>'foreign_key',
            'associationForeignKey'=>'media_id',
         'conditions'=>array('BufferedFicheactiviteImage.category'=>'Image','BufferedFicheactiviteImage.model'=>'BufferedFicheactivite'),
            'order' => 'BufferedFicheactiviteImage.order ASC',
            
        ),
       'BufferedFicheactiviteDocument'=>array(
            'className'=>'Administration.BufferedFicheactiviteDocument',
             'foreignKey'=>'foreign_key',
            'associationForeignKey'=>'media_id',
            'conditions'=>array('BufferedFicheactiviteDocument.category'=>'Document','BufferedFicheactiviteDocument.model'=>'BufferedFicheactivite'),
            'order' => 'BufferedFicheactiviteDocument.order ASC',
            
        ),
       'BufferedFicheactiviteExternalMedia'=>array(
            'className'=>'Administration.BufferedFicheactiviteExternalMedia',
             'foreignKey'=>'foreign_key',
            'associationForeignKey'=>'media_id',
            'conditions'=>array('BufferedFicheactiviteExternalMedia.category'=>'ExternalMedia','BufferedFicheactiviteExternalMedia.model'=>'BufferedFicheactivite'),
            'order' => 'BufferedFicheactiviteExternalMedia.order ASC',
            
        ),
       /*
       'BufferedEvenement' => array(
            'className' => 'Administration.BufferedFicheactivite',
            'foreignKey' => 'buffered_ficheactivite_id',
           
         ),*/
   );
   /*
   public function beforeFind($queryData) {
        parent::beforeFind($queryData);
        $defaultConditions = array('BufferedFicheactivite.deleted' => '0');
        $queryData['conditions'] = array_merge((array)$queryData['conditions'], $defaultConditions);
     
        return $queryData;
    }
 */
   
   
   public function _cloneFicheactivite($id){
       debug('clone fiche activite');
     //  App::import('Annuaire.Model','Ficheactivite');
     $ficheactiviteModel=ClassRegistry::init('Annuaire.Ficheactivite');
     $ficheactivite = $ficheactiviteModel->find('first', array('contain' => array(
     //$ficheactivite = $this->Ficheactivite->find('first', array('contain' => array(
               // 'Ficheactivite',
               
                'AnnuaireLien',
                'Image',
                'Document',
                'ExternalMedia',
               
               
                
               
               
            ),'conditions' => array('id' => $id)));
     debug($ficheactivite);
     unset($ficheactivite['Ficheactivite']['id']);
     $bufferedFicheactivite['BufferedFicheactivite'] = $ficheactivite['Ficheactivite'];   
     $bufferedFicheactivite['BufferedFicheactivite']['ficheactivite_id']=$id;
     
     //Image
     foreach ($ficheactivite['Image']as $key => $value) {
            $bufferedFicheactivite['BufferedFicheactiviteImage'][$key] = $value['MediasLy'];
            unset($bufferedFicheactivite['BufferedFicheactiviteImage'][$key]['model']);
            $bufferedFicheactivite['BufferedFicheactiviteImage'][$key]['model'] = 'BufferedFicheactivite';
            unset($bufferedFicheactivite['BufferedFicheactiviteImage'][$key]['id']);
        }
        
     //Document
     foreach ($ficheactivite['Document']as $key => $value) {
            $bufferedFicheactivite['BufferedFicheactiviteDocument'][$key] = $value['MediasLy'];
            unset($bufferedFicheactivite['BufferedFicheactiviteDocument'][$key]['model']);
            $bufferedFicheactivite['BufferedFicheactiviteDocument'][$key]['model'] = 'BufferedFicheactivite';
            unset($bufferedFicheactivite['BufferedFicheactiviteDocument'][$key]['id']);
        }
        
     foreach ($ficheactivite['ExternalMedia']as $key => $value) {
            $bufferedFicheactivite['BufferedFicheactiviteExternalMedia'][$key] = $value['MediasLy'];
            unset($bufferedFicheactivite['BufferedFicheactiviteExternalMedia'][$key]['model']);
            $bufferedFicheactivite['BufferedFicheactiviteExternalMedia'][$key]['model'] = 'BufferedFicheactivite';
            unset($bufferedFicheactivite['BufferedFicheactiviteExternalMedia'][$key]['id']);
     }
     
     //Lien
     $bufferedFicheactivite['BufferedAnnuaireLien']=$ficheactivite['AnnuaireLien'];
     foreach ($ficheactivite['BufferedAnnuaireLien']as $key => $value) {
          unset($bufferedFicheactivite['BufferedAnnuaireLien'][$key]['id']);
          
     }
     
     $this->create();
     debug('bufferedFicheactivite');
     if ($this->saveAll($bufferedFicheactivite,array('deep'=>true))){
   
     return $this->id;
     }
     return null;
      
      
   }
   
   public function beforeSave($options = array()) {
       parent::beforeSave($options);
       if(!empty($this->data['BufferedFicheactivite']['ficheactivite_id'])){
           $ficheactivite=$this->Ficheactivite->find('first',array('conditions'=>array('Ficheactivite.id'=>$this->data['BufferedFicheactivite']['ficheactivite_id']),'recursive'=>-1));
      
       $diff= array_diff_assoc($this->data['BufferedFicheactivite'], $ficheactivite['Ficheactivite']);
       $keys=implode(',',array_keys(array_diff_key($diff,$this->excludedKeysFromlistOfEditedFields)));
              
        $this->data['BufferedFicheactivite']['edited_fields']=$keys;
       }    
        return true;
   }
   
   
}

