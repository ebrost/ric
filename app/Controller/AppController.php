<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $uses = array('AppModel');
    public $helpers =array('Session','Cache', 'Html', 'Form', 'Tools.GoogleMapV3','RicImage');
    public $components = array('DebugKit.Toolbar', 'RequestHandler', 'Session',
         
    'Auth'=>array('authenticate' => array(
			'Form' => array(
				'fields' => array(
					'username' => 'email',
					'password' => 'password'),
                                
				'userModel' => 'Administration.AdministrationUser',
                                
                            
				)),
   // 'authError' =>'Vous n\'êtes pas autorisé à accéder à cette page',
     'authError'=>false,
    'loginRedirect' => array('plugin' => 'administration', 'controller' => 'administration_users', 'action' => 'index'),
    'logoutRedirect' => array('plugin' => 'administration', 'controller' => 'administration_users', 'action' => 'login'),
    'loginAction' => array('plugin' => 'administration', 'controller' => 'administration_users', 'action' => 'login'),
    'authorize'=>array('Controller')
            ));

    public function beforeRender() {
        $this->response->disableCache();
    }

   public function beforeFilter() { 
       $this->Auth->allow();
    $this->Auth->flash['params']['class'] = 'alert alert-danger'; //Add this line to control output auth flash class
    }

   public function getById($id){
      // if ($this->request->is('ajax')) {
           $this->RequestHandler->renderAs($this,'json');
        $reponse=$this->{$this->modelClass}->findById($id);
          $this->set('reponse',Hash::extract($reponse,$this->modelClass));
          $this->set('_serialize','reponse');
     //  }
   }
   
    public function getNomComplet() {
     if($this->RequestHandler->isAjax())
     {
    
        $items=$this->{$this->modelClass}->find('all', array(
            'conditions' => array('nom_complet LIKE' =>'%'.$this->params['url']['term'].'%','CHAR_LENGTH(id) >'=>3),
            'order' => 'nom_complet',
            'fields' => array('nom_complet'),
           'recursive'=>-1
        //  'fields'=>array('DISTINCT nom')
        ));
		
        
        
       $jsItems=Hash::extract($items, '{n}.'.$this->modelClass.'.nom_complet');
      
       $this->set('jsItems',$jsItems);
       $this->set('_serialize','jsItems');

  }
   }
    public function isAuthorized($user){
        return true;
    }


}
