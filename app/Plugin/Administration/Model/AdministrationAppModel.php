<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppModel', 'Model');
App::uses('FrValidation', 'Localized.Validation');

App::import('component', 'CakeSession');   

/**
 * Users App Model
 *
 * @package users
 * @subpackage users.models
 */
class AdministrationAppModel extends AppModel {

    protected $hiearchicalSpacer = '';
    protected $config = null;
    public $tablePrefix = 'ric_administration_';
    public $actsAs = array(
        'Containable',
    );
    public $recursive = -1;
    public $excludedKeysFromlistOfEditedFields;
    
    
    public function __construct($id = false, $table = null, $ds = null) {
    parent::__construct($id, $table, $ds);
    $this->excludedKeysFromlistOfEditedFields=array_fill_keys(array('id','addresspicker','ficheactivite_id','evenement_id','ficheactivite_model_id','ficheactivite_model','ficheactivite_nom_complet','buffered_ficheactivite_id','buffered_parent_id'),null);
    }
    
    public function getConfig() {

        if (empty($this->config)) {
            $this->config = Configure::read('Administration');
        }

        return $this->config;
    }

   

    public function getavailableMedia($item, $hasManyModel, $model) {
        $allMedia = array();
        $allMedia['available'] = $this->AdministrationUser->{$model}->find('all',array(
            'conditions'=>array($model.'.model'=>'User',$model.'.foreign_key'=>CakeSession::read('Auth.User.id')),
            'order'=>'id desc'
                ));
        $allMedia['total'] = count($allMedia['available']);
        // debug($availableMedia);

        if (!empty($item[$hasManyModel])) {
            $extractSelectedMedia = Hash::extract($item[$hasManyModel], '{n}.' . $model . '.id');
            // debug($extractSelectedMedia);
            foreach ($allMedia['available'] as $key => $media) {
                if (in_array($media[$model]['id'], $extractSelectedMedia))
                    unset($allMedia['available'][$key]);
            }
        }

        return $allMedia;
    }
    

}
