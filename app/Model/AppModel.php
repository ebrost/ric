<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
     public $actsAs = array('Containable');
     
    protected $hiearchicalSpacer = '';
    protected $displayListOnLoad = true;
    protected $resultsPerPage = 10;
    protected $dateOffset=3;
    protected $unlimitedPdfList= false;
    protected $config = null;
     
      public function __construct($id = false, $table = null, $ds = null) {
        
        $this->config=$this->getConfig();
        parent::__construct($id, $table, $ds);
    }
    
     public function getHierarchicalSpacer() {
       
        if (array_key_exists('hiearchicalSpacer', $this->config)) {
            $this->hiearchicalSpacer = $this->config['hiearchicalSpacer'];
        }
        return $this->hiearchicalSpacer;
    }
   

    public function getDisplayListOnLoad() {
        if (array_key_exists('displayListOnLoad', $this->config)) {
            $this->displayListOnLoad = $this->config['displayListOnLoad'];
        }
        return $this->displayListOnLoad;
    }

    public function getResultsPerPage() {
        if (array_key_exists('resultsPerPage', $this->config)) {
            $this->resultsPerPage = $this->config['resultsPerPage'];
        }
        return $this->resultsPerPage;
    }
    
    public function getDateOffset() {
        if (array_key_exists('dateOffset', $this->config)) {
            $this->dateOffset = $this->config['dateOffset'];
        }
        return $this->dateOffset;
    }

   public function formatList($list, $displayHierarchicalSpacer = true) {
        $hierarchicalSpacer = $this->getHierarchicalSpacer();
        $options = array();
        foreach ($list as $key => $value) {
            if ($displayHierarchicalSpacer) {
                $level = ceil(strlen($key) / 2);
            } else {
                $level = 0;
            }
            $options[] = array('value' => $key, 'name' => str_repeat($hierarchicalSpacer, $level) . $value, 'class' => "level_" . strval($level));
        }
        return $options;
    }
    
     public function isUnlimitedPdfList() {
        if (array_key_exists('unlimitedPdfList', $this->config)) {
            $this->unlimitedPdfList = $this->config['unlimitedPdfList'];
        }
        return $this->unlimitedPdfList;
    }
    
    public function getConfig(){
        return $this->config;
        
    }
     public function isOwnedBy($modelId,$userId){
       
        return $this->field('id',array('id'=>$modelId,'user_id'=>$userId))===$modelId;
    }
	
}
