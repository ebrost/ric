<?php

App::uses('AdministrationAppModel', 'Administration.Model');

class BufferedEvenement extends AdministrationAppModel {

//  public $useTable= 'bufferedficheactivites';   
    public $name = 'BufferedEvenement';
//  public $belongsTo='Administration.Evenement';
    public $validate = array(
        'nom_complet' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Champ Obligatoire'
            )
        ),
        'ficheactivite_model_id' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Vous devez specifier l\'activité support'
            )
        ),
        'commentaires' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Champ Obligatoire'
            )
        ),
        'telephone' => array(
            'phone' => array(
                'rule' => array('phone', null, 'fr'),
                'message' => 'Téléphone non valide',
                'allowEmpty' => true
            )
        ),
        'site_web' => array(
            'web' => array(
                'rule' => 'url',
                'message' => 'Url non valide',
                'allowEmpty' => true
            )
        ),
        'AgendaGenre' => array(
            'multiple' => array(
                'rule' => 'checkGenres',
                'message' => 'Vous devez sélectionner au moins un genre !'
            )
        ),
    );
    public $belongsTo = array(
        'AdministrationUser' => array(
            'classNane' => 'AdministrationUser',
            'foreignKey' => 'user_id'),
        'BufferedFicheactivite' => array(
            'className' => 'BufferedFicheactivite',
            'foreignKey' => 'buffered_ficheactivite_id',
        ),
       
          'Evenement' => array(
            'className' => 'agenda.Evenement',
            'foreignKey' => 'evenement_id',
          ),
         
        'Type' => array(
            'className' => 'Agenda.Type',
            'foreignKey' => 'type_id',
        ),
        'Parent' => array(
            'className' => 'Administration.BufferedEvenement',
            // 'className' => 'Agenda.BufferedEvenement',
            'foreignKey' => 'buffered_parent_id'
        )
    );
    public $hasMany = array(
        'AgendaLien' => array('className' => 'Administration.AgendaLien',
            'foreignKey' => 'buffered_evenement_id',
        ),
        'BufferedEvenementImage' => array(
            'className' => 'Administration.BufferedEvenementImage',
            'foreignKey' => 'foreign_key',
            'associationForeignKey' => 'media_id',
            'conditions' => array('BufferedEvenementImage.category' => 'Image', 'BufferedEvenementImage.model' => 'BufferedEvenement'),
            'order' => 'BufferedEvenementImage.order ASC',
        ),
        'BufferedEvenementDocument' => array(
            'className' => 'Administration.BufferedEvenementDocument',
            'foreignKey' => 'foreign_key',
            'associationForeignKey' => 'media_id',
            'conditions' => array('BufferedEvenementDocument.category' => 'Document', 'BufferedEvenementDocument.model' => 'BufferedEvenement'),
            'order' => 'BufferedEvenementDocument.order ASC',
        ),
        'BufferedEvenementExternalMedia' => array(
            'className' => 'Administration.BufferedEvenementExternalMedia',
            'foreignKey' => 'foreign_key',
            'associationForeignKey' => 'media_id',
            'conditions' => array('BufferedEvenementExternalMedia.category' => 'ExternalMedia', 'BufferedEvenementExternalMedia.model' => 'BufferedEvenement'),
            'order' => 'BufferedEvenementExternalMedia.order ASC',
        ),
        'Session' => array('className' => 'Administration.BufferedSession'),
        'Children' => array(
            'className' => 'Administration.BufferedEvenement',
            'foreignKey' => 'buffered_parent_id'
        )
    );
    public $hasAndBelongsToMany = array(
        'Typepublic' => array(
            'className' => 'Agenda.Typepublic',
            'joinTable' => 'administration_buffered_evenements_typepublics',
            'foreignKey' => 'buffered_evenement_id',
            'associationForeignKey' => 'typepublic_id'
        ),
        'AgendaGenre' => array(
            'className' => 'Agenda.AgendaGenre',
            'joinTable' => 'administration_buffered_evenements_genres',
            'foreignKey' => 'buffered_evenement_id',
            'associationForeignKey' => 'genre_id'
        )
    );

    public function checkGenres() {

        if (!empty($this->data["BufferedEvenement"]["Genre"])) {
            return true;
        }

        return false;
    }

    public function _cloneEvenement($id, $isChild = false, $parent_id = null) {

        $evenementModel = ClassRegistry::init('Agenda.Evenement');
        $evenement = $evenementModel->find('first', array('contain' => array(
                // $evenement = $this->Evenement->find('first', array('contain' => array(
                // 'Ficheactivite',
                'Typepublic',
                'Tag',
                'Image',
                'Document',
                'ExternalMedia',
                // 'Type',
                'AgendaLien',
                //'Parent',
                'AgendaGenre',
                'Typepublic',
                'Session', //evenement standard
                'Children'
            ), 'conditions' => array('Evenement.id' => $id)));
        debug($evenement);
        $bufferedEvenement['BufferedEvenement'] = $evenement['Evenement'];
        $bufferedEvenement['BufferedEvenement']['evenement_id'] = $evenement['Evenement']['id'];
        // unset($bufferedEvenement['Evenement']);
        //s'il y a un parent, on le prend et on travaille avec plutot 

        if (!empty($evenement['Evenement']['parent_id']) && !$isChild) {
            debug('parent');
            $this->_cloneEvenement($evenement['Evenement']['parent_id'], false);
            return;
        } else {

            unset($bufferedEvenement['BufferedEvenement']['id']);
            // unset($bufferedEvenement['BufferedEvenement']['parent_id']);
            //ficheactivite
            $ficheactiviteId = $bufferedEvenement['BufferedEvenement']['ficheactivite_id'];
            unset($bufferedEvenement['BufferedEvenement']['ficheactivite_id']);
            $BufferedFicheactivite = $this->BufferedFicheactivite->find('first', array('fields' => 'BufferedFicheactivite.id', 'conditions' => array('ficheactivite_id' => $ficheactiviteId)));
            if (!empty($BufferedFicheactivite)) {
                $BufferedFicheactiviteId = $BufferedFicheactivite['BufferedFicheactivite']['id'];
                $bufferedEvenement['BufferedEvenement']['buffered_ficheactivite_id'] = $BufferedFicheactiviteId;
            } else {
                $bufferedEvenement['BufferedEvenement']['buffered_ficheactivite_id'] = $this->BufferedFicheactivite->_cloneFicheactivite($ficheactiviteId);
            }

            //Publics
            foreach ($evenement['Typepublic']as $key => $value) {
                //  unset($bufferedEvenement['Genre'][$key]['id']);
                $bufferedEvenement['Typepublic'][] = $value['id'];
            }
            //Publics
            foreach ($evenement['Typepublic']as $key => $value) {
                //  unset($bufferedEvenement['Genre'][$key]['id']);
                $bufferedEvenement['Typepublic'][] = $value['id'];
            }


            foreach ($evenement['AgendaGenre']as $key => $value) {
                // unset($bufferedEvenement['Genre'][$key]['id']);
                $bufferedEvenement['AgendaGenre'][] = $value['id'];
            }

            //Lien

            foreach ($evenement['AgendaLien']as $key => $value) {
                $bufferedEvenement['AgendaLien'][] = $value['id'];
            }

            // Image,Document et ExternalMedia

            foreach ($evenement['Image']as $key => $value) {
                $bufferedEvenement['BufferedEvenementImage'][$key] = $value['MediasLy'];
                unset($bufferedEvenement['BufferedEvenementImage'][$key]['model']);
                $bufferedEvenement['BufferedEvenementImage'][$key]['model'] = 'BufferedEvenement';
                unset($bufferedEvenement['BufferedEvenementImage'][$key]['id']);
            }

            foreach ($evenement['Document']as $key => $value) {
                $bufferedEvenement['BufferedEvenementDocument'][$key] = $value['MediasLy'];
                unset($bufferedEvenement['BufferedEvenementDocument'][$key]['model']);
                $bufferedEvenement['BufferedEvenementDocument'][$key]['model'] = 'BufferedEvenement';
                unset($bufferedEvenement['BufferedEvenementDocument'][$key]['id']);
            }

            foreach ($evenement['ExternalMedia']as $key => $value) {
                $bufferedEvenement['BufferedEvenementExternalMedia'][$key] = $value['MediasLy'];
                unset($bufferedEvenement['BufferedEvenementExternalMedia'][$key]['model']);
                $bufferedEvenement['BufferedEvenementExternalMedia'][$key]['model'] = 'BufferedEvenement';
                unset($bufferedEvenement['BufferedEvenementExternalMedia'][$key]['id']);
            }

            //Session
            $bufferedEvenement['Session'] = $evenement['Session'];
            foreach ($bufferedEvenement['Session'] as $key => $value) {
                unset($bufferedEvenement['Session'][$key]['id']);
                unset($bufferedEvenement['Session'][$key]['evenement_id']);
            }

            //$this->create();
            if (!empty($parent_id)) {
                $bufferedEvenement['BufferedEvenement']['buffered_parent_id'] = $parent_id;
            }

            debug($bufferedEvenement);
            if ($this->saveAll($bufferedEvenement, array('validate' => false, 'deep' => true))) {
                if ($bufferedEvenement['BufferedEvenement']['master'] == true) {
                    $parent_id = $this->id;
                }
                if (count($evenement['Children']) > 0) {
                    $bufferedEvenement['Children'] = $evenement['Children'];
                    foreach ($bufferedEvenement['Children'] as $childrenKey => $childrenValue) {
                        $this->_cloneEvenement($bufferedEvenement['Children'][$childrenKey]['id'], true, $parent_id);
                    }
                }
            }
        }
        
    }
    
    public function beforeSave($options = array()) {
       
       debug($this->data);
       if(!empty($this->data['BufferedEvenement']['evenement_id'])){
           $evenement=$this->Evenement->find('first',array('conditions'=>array('Evenement.id'=>$this->data['BufferedEvenement']['evenement_id']),'recursive'=>-1));
      
       $diff= array_diff_assoc($this->data['BufferedEvenement'], $evenement['Evenement']);
       $keys=implode(',',array_keys(array_diff_key($diff,$this->excludedKeysFromlistOfEditedFields)));
        debug($keys);      
        $this->data['BufferedEvenement']['edited_fields']=$keys;
       }    
       parent::beforeSave($options);
        return true;
   }

}
