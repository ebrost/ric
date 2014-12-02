<?php

class AnnuaireAppModel extends AppModel {

    public $tablePrefix = 'ric_annuaire_';

    protected $activityRoot = '';
    protected $activityLevelsDisplay = -1;
    protected $searchFormType = null;
    protected $fulltextSearchFields='nom_complet,commentaires,commentaires_arts_visuels,commentaires_audio_visuel,commentaires_livre,commentaires_patrimoine,commentaires_spectacle';
    protected $excludedActivities=null;


    public function getConfig() {
        if (empty($this->config)) {
            $this->config = Configure::read('Annuaire');
        }

        return $this->config;
    }
    

    public function getActivityRoot() {
        if (array_key_exists('activityRoot', $this->config)) {
            $this->activityRoot = $this->config['activityRoot'];
        }
        return $this->activityRoot;
    }
    
     public function getActivityLevelsDisplay() {
        if (array_key_exists('activityLevelsDisplay', $this->config)) {
            $this->activityLevelsDisplay = $this->config['activityLevelsDisplay'];
        }
        return (int) $this->activityLevelsDisplay;
    }

    public function getSearchFormtype() {
        if (array_key_exists('searchFormType', $this->config)) {
            $this->searchFormType = $this->config['searchFormType'];
        }
        return $this->searchFormType;
    }
     public function getFulltextSearchFields() {
        if (array_key_exists('fulltextSearchFields', $this->config)) {
            $this->fulltextSearchFields = $this->config['fulltextSearchFields'];
        }
       
        return $this->fulltextSearchFields;
    }
    
    public function getExcludedActivities() {
        if (array_key_exists('excludedActivities', $this->config)) {
            $this->excludedActivities = $this->config['excludedActivities'];
        }
        return $this->excludedActivities;
    }
    
   

}
