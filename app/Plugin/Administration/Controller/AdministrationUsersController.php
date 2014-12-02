<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('UsersController', 'Users.Controller');

class AdministrationUsersController extends UsersController {

    protected $appName = 'Administration';
    public $name = 'AdministrationUsers';
    

    public $components = array(
        //'Auth',
        'Session',
        'Cookie',
        'Paginator',
        //'Security',
        //'PersistentValidation',
        'Users.RememberMe',
         'Essence.Essence' 
    );

    public function __construct($request = NULL, $response = NULL) {
        $administrationAppName = (array) Configure::read('Administration.appName');

        if (!empty($administrationAppName)) {
            $this->appName = $administrationAppName[0];
        }

        $this->set('title_for_layout', $this->appName);
        parent::__construct($request, $response);
    }

    public function beforeRender() {

        parent::beforeRender();
    }

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->deny();
       
        $this->Auth->allow('add', 'reset', 'verify', 'logout', 'view', 'reset_password', 'login', 'resend_verification');
        
      //  $this->user = ClassRegistry::init('AdministrationUser');
        
        $this->set('model', 'AdministrationUser');
        /* a modifier pour admin_menu.ctp
         * //utiliser requestAction
         */
        $user =  $this->AdministrationUser->getUser($this->Auth->user('id'));
       /* if(!$user){
            $this->redirect(array('controller'=>'administration_users','action'=>'login'));
        }*/
        $this->set('user',$user);
        $this->RememberMe->restoreLoginFromCookie();
        if ($this->RequestHandler->isAjax()) {
            $this->Security->csrfCheck = false;
            $this->Security->validatePost = false;
        }
       
    }
    
    
    
    protected function _setupAuth() {
        
    }
   
     public function getById($id){
         
      // if ($this->request->is('ajax')) {
      $this->RequestHandler->renderAs($this,'json');
      $reponse='Hum,...je pense pas';
    
         if($id==$this->Auth->user('id')){
           
            $reponse=Hash::extract($this->{$this->modelClass}->getUser($id),$this->modelClass);
         }
         
          $this->set('reponse',$reponse);
          $this->set('_serialize','reponse');
         
     //  }
   }

    public function login() {

        if ($this->request->is('ajax') && $this->request->is('post')) {

            $this->layout = 'ajax';
            // $this->render(false);


            if ($this->Auth->login()) {
                //return $this->redirect($this->Auth->redirectUrl());
                $this->{$this->modelClass}->id = $this->Auth->user('id');
                $this->{$this->modelClass}->saveField('last_login', date('Y-m-d H:i:s'));
                if (!empty($this->request->data)) {
                    $data = $this->request->data[$this->modelClass];
                    // debug($data);
                    if (empty($this->request->data[$this->modelClass]['remember_me'])) {
                        $this->RememberMe->destroyCookie();
                    } else {
                        $this->_setCookie();
                    }
                }

                if (empty($data['return_to'])) {
                    $data['return_to'] = null;
                } else {
                    $this->Session->delete('RicLogin.redirectTo');
                    $this->Session->write('RicLogin.redirectTo', $data['return_to']);
                }

                // $this->Session->setFlash(__('ok'), 'default', array(), 'auth');
                $this->set('redirectUrl', $data['return_to']);
                $this->set('_serialize', array('redirectUrl'));
            } else {
                $this->Session->setFlash(__('Identifiant ou mot de passe incorrect'), 'default', array(), 'auth');
                $errors = 'Identifiant ou mot de passe incorrect';
                $this->set('errors', $errors);
                $this->set('_serialize', array('errors'));
            };
        } else {
           
            $Event = new CakeEvent(
                    'Users.Controller.Users.beforeLogin', $this, array(
                'data' => $this->request->data,
                    )
            );

            $this->getEventManager()->dispatch($Event);

            if ($Event->isStopped()) {
                return;
            }



            if ($this->Auth->login()) {
                $Event = new CakeEvent(
                        'Users.Controller.Users.afterLogin', $this, array(
                    'data' => $this->request->data,
                    'isFirstLogin' => !$this->Auth->user('last_login')
                        )
                );

                $this->getEventManager()->dispatch($Event);

                $this->{$this->modelClass}->id = $this->Auth->user('id');
                $this->{$this->modelClass}->saveField('last_login', date('Y-m-d H:i:s'));

                if ($this->here == $this->Auth->loginRedirect) {
                    $this->Auth->loginRedirect = '/';
                }
                $this->Session->setFlash(sprintf(__d('users', '%s you have successfully logged in'), $this->Auth->user('username')), 'default', array('class' => 'alert alert-success'));
                if (!empty($this->request->data)) {
                    $data = $this->request->data[$this->modelClass];
                    if (empty($this->request->data[$this->modelClass]['remember_me'])) {
                        $this->RememberMe->destroyCookie();
                    } else {
                        $this->_setCookie();
                    }
                }

                if (empty($data[$this->modelClass]['return_to'])) {
                    $data[$this->modelClass]['return_to'] = null;
                }

                // Checking for 2.3 but keeping a fallback for older versions
                if (method_exists($this->Auth, 'redirectUrl')) {
                    $this->redirect($this->Auth->redirectUrl($data[$this->modelClass]['return_to']));
                } else {
                    $this->redirect($this->Auth->redirect($data[$this->modelClass]['return_to']));
                }
            } else {
                if($this->request->is('post')){
                $this->Auth->flash(__d('users', 'Invalid e-mail / password combination.  Please try again'));
                    
                }
            }
        }
        if (isset($this->request->params['named']['return_to'])) {
            $this->set('return_to', urldecode($this->request->params['named']['return_to']));
        } else {
            $this->set('return_to', false);
        }
        $allowRegistration = Configure::read('Users.allowRegistration');
        $this->set('allowRegistration', (is_null($allowRegistration) ? true : $allowRegistration));
    }

    public function logout() {
        $user = $this->Auth->user();
        $redirecturl = $this->Session->read('RicLogin.redirectTo');
        $this->Session->destroy();
        if (isset($_COOKIE[$this->Cookie->name])) {
            $this->Cookie->destroy();
        }
      
        $this->RememberMe->destroyCookie();
        //$this->Session->setFlash(sprintf(__d('users', '%s you have successfully logged out'), $user[$this->{$this->modelClass}->displayField]));
        if ($redirecturl) {
            $this->redirect($redirecturl);
        } else {
            $this->redirect($this->Auth->logout());
        }
    }

    public function index() {

    }

    
    /* les methodes edit et change password sont utilisées conjointement dans la meme page et 
     * sont donc liées....
     */
    
    public function edit() {
        $user = $this->AdministrationUser->getUser($this->Auth->user('id'));

        if (!$user) {
            throw new NotFoundException('Utilisateur non valide');
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            if (isset($this->request->data['AdministrationUserEdit'])) {
                $this->request->data['AdministrationUser'] = $this->request->data['AdministrationUserEdit'];
               $this->request->data['AdministrationUser']['id'] = $this->Auth->user('id');
                unset($this->request->data['AdministrationUserEdit']);
                $this->set('formName', 'AdministrationUserEdit');
                if ($this->AdministrationUser->save($this->request->data)) {
                    $this->Session->setFlash(__('Mise à jour effectuée'), 'default', array('class' => 'alert alert-success'));
                    //  return $this->redirect(array('action'=>'index'));
                } else {
                    $this->Session->setFlash(__('Impossible de sauvegarder les données'), 'default', array('class' => 'alert alert-warning'));
                }
            }
        } 
        $this->request->data['AdministrationUserEdit'] = $user['AdministrationUser'];
        //images
        $text_valid_images_extensions=$this->AdministrationUser->Image->getValidExtText();
        $valid_images_extensions=$this->AdministrationUser->Image->getValidExt();
         $images=$this->AdministrationUser->Image->find("all",array('order'=>array('Image.ID DESC')));
         
         //documents
          $text_valid_documents_extensions=$this->AdministrationUser->Document->getValidExtText();
        $valid_documents_extensions=$this->AdministrationUser->Document->getValidExt();
         $documents=$this->AdministrationUser->Document->find("all",array('order'=>array('Document.ID DESC')));
     
         //medias externes
          $ext_medias=$this->AdministrationUser->ExternalMedia->find("all",array('order'=>array('ExternalMedia.ID DESC')));
       
         
          
        $this->set(compact('fragment','images','documents','ext_medias','valid_images_extensions','text_valid_images_extensions','valid_documents_extensions','text_valid_documents_extensions'));
    }

    public function change_password() {
        $user = $this->AdministrationUser->getUser($this->Auth->user('id'));
        if ($this->request->is('post')) {
            if (isset($this->request->data['AdministrationUserChangePassword'])) {
                $this->request->data['AdministrationUser'] = $this->request->data['AdministrationUserChangePassword'];
                $this->request->data['AdministrationUser']['id'] = $this->Auth->user('id');
                unset($this->request->data['AdministrationUserChangePassword']);
                $this->set('formName', 'AdministrationUserChangePassword');
                if ($this->AdministrationUser->changePassword($this->request->data)) {
                    $this->Session->setFlash(__d('users', 'Mot de passe changé.'), 'default', array('class' => 'alert alert-success'));
                    // we don't want to keep the cookie with the old password around
                    $this->RememberMe->destroyCookie();
                }
            }
        }
        $this->request->data['AdministrationUserEdit'] = $user['AdministrationUser'];  
        $this->set('fragment', 'change_password');
        $this->render('edit');
    }
    
    public function ajaxUploadMedia(){
        $error=false;
        if(!empty ($this->request)){
            $model=$this->request->data['model'];
            
            $this->request->data['AdministrationUser'][$model][0]['file'] = $this->request->form['file'];
            $this->request->data['AdministrationUser']['id'] = $this->Auth->user('id');
            $data=$this->AdministrationUser->formatMediaData($model,$this->request->data['AdministrationUser']);
            
            if (!$error) $error=$this->AdministrationUser->{$model}->checkSize($this->request->form['file']['size']);
            if (!$error) $error=$this->AdministrationUser->{$model}->checkMimeType($this->request->form['file']['type']);
             if (!$error){
                 try{
                
                      $media=$this->AdministrationUser->addMedia($model,$this->request->data['AdministrationUser']);
                  
                   
                  } catch (Exception $ex) {
                      $error=$ex->getMessage();
                      
                  }
                }
            }
     //$reponse=$this->request->data['AdministrationUser'];
            if ($error){
            $this->RequestHandler->renderAs($this, 'json');
            $response['error']=$error;
            $this->set('error',$response);
            $this->set('_serialize','error');
            }
            else{
                $category=$model;
                $displayActions=true;
               $this->set(compact('media','category','displayActions')) ;
               $this->render('Elements/media', 'json');
            }
      
        
    }
    
    public function ajaxDeleteMedia(){
        $this->autoRender = false;
         if ($this->request->is('post') || $this->request->is('delete')) {
           // $this->loadModel('Attachment');
           $model=$this->request->params['named']['media_model'];
           $id=$this->request->params['named']['id']; 
            $media = $this->AdministrationUser->{$model}->find('first', array('conditions'=>array(
                                                      $model.'.id'=>$id,
                                                     $model.'.foreign_key'=>$this->Auth->user('id'),   
                                                     $model.'.Model'=>'User'
                            )));
        if(empty($media)){
            throw new NotFoundException();
        }
        
        $this->AdministrationUser->{$model}->delete($id);
         
             
         }
         
        return true;
    }
    
    public function ajaxEditMedia(){
        $this->layout = 'ajax';
         if ($this->request->is('ajax') && $this->request->is('post')) {
             
             $model=$this->request->data['AdministrationUserEditMedia']['media_model'];
             unset($this->request->data['AdministrationUserEditMedia']['model']);
             
            $data[$model]=$this->request->data['AdministrationUserEditMedia'];   
            $data[$model]['model']='User';
             
             //unset($this->request->data['AdministrationUserEditMedia']['id']);
             $media = $this->AdministrationUser->{$model}->find('first', array('conditions'=>array(
                                                     'id'=>$data[$model]['id'],
                                                     'foreign_key'=>$this->Auth->user('id'),   
                                                     'model'=>'User'
                                                      )));
           
            if(empty($media)){
               $response['error']='Pas de media associé!';
            }
                 
            else{
               // $response=media;
               
                try{
                    $this->AdministrationUser->{$model}->save($data);
                    $response=$this->request->data['AdministrationUserEditMedia'];
                    
                } 
                catch (Exception $ex) {
                       $response['error']=$ex->getMessage();
                }
                
           
                
             }
            $this->set('response',$response);
            $this->set('_serialize','response');
         }
    }
    public function ajaxGetExtMedia(){
   
    
         if (
                 $this->request->is('ajax') && $this->request->is('post')
                
                 ) {
            
             if (
                     !filter_var($this->request->data['AdministrationUserAjaxGetExtMedia']['url'], FILTER_VALIDATE_URL)
                    
                     ) { 
                  $response['error']='Cette url n\'est pas valide';
             }else{
                 $data['ExternalMedia']=$this->request->data['AdministrationUserAjaxGetExtMedia'];
                 $data['ExternalMedia']['foreign_key'] = $this->Auth->user('id');
                 $data['ExternalMedia']['model'] = 'User';
                       
                  try{
                     
                    $ext_media_content=$this->Essence->embed($data['ExternalMedia']['url']);
                        // $this->AdministrationUser->ExternalMedia->save($data);
                   
                    if (!$ext_media_content ) {
                          throw new NotFoundException('Pas de média correspondant à l\'url fourni ');
                    }
                    else{
                            //save data
                        $data['ExternalMedia']['category']=$ext_media_content->type;
                       try{ 
                           $this->AdministrationUser->ExternalMedia->create();
                           $this->AdministrationUser->ExternalMedia->save($data);
                           $ext_media['ExternalMedia']['id']=$this->AdministrationUser->ExternalMedia->id;
                           $ext_media['ExternalMedia']['content']=$ext_media_content;
 
                       } catch (Exception $ex) {
                            $error=$ex->getMessage();
                      
                        }
                    }
                  } catch (Exception $ex) {
                     $error=$ex->getMessage();
                      
                  }
                 if (!empty($error)){
                        $this->RequestHandler->renderAs($this, 'json');
                        $response['error']=$error;
                        $this->set('error',$response);
                        $this->set('_serialize','error');
                        }
                 else{
                        $displayActions=true;
                         $this->set(compact('ext_media','displayActions')) ;
                           $this->render('Elements/ext_media', 'json');
                }
            }
             
         }
    }
     public function ajaxDeleteExtMedia(){
        $this->autoRender = false;
         if ($this->request->is('post') || $this->request->is('delete')) {
           // $this->loadModel('Attachment');
           
           $id=$this->request->params['named']['id']; 
            $extmedia = $this->AdministrationUser->ExternalMedia->find('first', array('conditions'=>array(
                                                     'ExternalMedia.id'=>$id,
                                                     'ExternalMedia.foreign_key'=>$this->Auth->user('id'),   
                                                     'ExternalMedia.Model'=>'User'
                            )));
        if(empty($extmedia)){
            throw new NotFoundException();
        }
        
        $this->AdministrationUser->ExternalMedia->delete($id);
         
             
         }
         
        return true;
    }
    
}
