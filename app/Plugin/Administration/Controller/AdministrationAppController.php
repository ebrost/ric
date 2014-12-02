<?php

App::uses('AppController', 'Controller');
 
class AdministrationAppController extends AppController {

    public $uses = array('Administration.AdministrationUser');
    public $helpers =array('Session','Cache', 'Html', 'Form', 'Tools.GoogleMapV3','RicImage','RicTree');
    protected $appName = 'Administration';
    protected static $user=null;

    public function __construct($request = NULL, $response = NULL) {
        $administrationAppName = (array) Configure::read('Administration.appName');

        if (!empty($administrationAppName)) {
            $this->appName = $administrationAppName[0];
        }

        $this->set('title_for_layout', $this->appName);
        parent::__construct($request, $response);
    }

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->deny();
        $this->Auth->allow('checkValidation');
        if (!isset(self::$user)) {
            self::$user = $this->AdministrationUser->getUser($this->Auth->user('id'));
        }
        $text_valid_images_extensions=$this->AdministrationUser->Image->getValidExtText();
        $valid_images_extensions=$this->AdministrationUser->Image->getValidExt();
        $text_valid_documents_extensions=$this->AdministrationUser->Document->getValidExtText();
        $valid_documents_extensions=$this->AdministrationUser->Document->getValidExt();
        $this->set(compact('text_valid_images_extensions','valid_images_extensions','text_valid_documents_extensions','valid_documents_extensions'));
        $this->set('user', self::$user);
    }

    public function beforeRender() {

        parent::beforeRender();
    }

    public function isAuthorized($user) {


        if ($user && $this->action === 'add') {
            return true;
        }
        if (in_array($this->action, array('edit', 'delete'))) {
            $modelId = $this->request->params['pass'][0];
            
            if ($user && $this->{$this->modelClass}->isOwnedBy($modelId, $user['id'])) {

                return true;
            }

            return false;
        }
        return parent::isAuthorized($user);
    }

    public function checkValidation($id = null) {
        
        //$fieldNameArray=array_keys($this->request->data[$this->modelClass]);
        // debug($fieldNameArray);
        $id=(!empty($id))?(int)$id:$this->request->data[$this->modelClass]['id'];
        $this->{$this->modelClass}->set($this->request->data);
        if ($this->{$this->modelClass}->validates()) {
            if (isset($this->request->data['autosave']) && $this->request->data['autosave'] == true && (!empty($id))) {
                try {
                    $this->request->data[$this->modelClass]['id']=$id;
                    $this->{$this->modelClass}->saveAll($this->request->data);
                    // saving without validation
                    //  $this->{$this->modelClass}->save($this->request->data);
                    $this->set('reponse', true);
                    $this->set('_serialize', array('reponse'));
                    }
                catch (Exception $e){
                     $this->set('errors', $e->getMessage());
                       $this->set('_serialize', array('model', 'errors'));
                
                    
                }
            }
            else{
                 $this->set('reponse', true);
                 $this->set('_serialize', array('reponse'));        
            }
        } else {
            $errors = $this->{$this->modelClass}->validationErrors;
            $this->set('model', $this->modelClass);
            $this->set('errors', $errors);
            $this->set('_serialize', array('model', 'errors'));
        }
    }

}
