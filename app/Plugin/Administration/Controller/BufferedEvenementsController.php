<?php

class BufferedEvenementsController extends AdministrationAppController {

//  public $uses = array('Administration.BufferedEvenement','Administration.BufferedEvenementMedia', 'Annuaire.Evenement');
    public $uses = array('Administration.BufferedEvenement', 'Administration.BufferedEvenementMedia');
    public $name = 'BufferedEvenements';
    public $plugin = 'Administration';
    public $helpers = array(
        'Html',
        'Form',
        'Session',
            //'Time',
//'Text'
    );

    public function beforeFilter() {

        parent::beforeFilter();
// $this->Auth->deny();
    }

    public function edit($id = null) {
        
         if (!$id) {
        throw new NotFoundException(__('Pas d\'évenement'));
        }
        
//la fiche tampon existe, on edite
            $bufferedEvenement = $this->BufferedEvenement->find('first', array(
                'contain' => array('AdministrationUser.id', 'BufferedEvenementImage',
                    'BufferedFicheactivite'=>array(
                        'fields'=>array('id','nom_complet') 
                    ),
                    'Parent'=>array(
                        'fields'=>array('id','nom_complet') 
                        ),
                    'Session', //evenement standard
                    //'Children', //evenement parent
                    'AgendaGenre',
                    'Typepublic',
                    'BufferedEvenementImage.Image', 'BufferedEvenementDocument', 'BufferedEvenementDocument.Document', 'BufferedEvenementExternalMedia', 'BufferedEvenementExternalMedia.ExternalMedia'),
                'conditions' => array('BufferedEvenement.id' => $id),
            ));
        
           if (!$bufferedEvenement) {
            throw new NotFoundException(__('Pas d\'évenement'));
           }
           
            


            if ($this->request->is(array('post', 'put'))) {
                $this->BufferedEvenement->id = $id;
                if($this->request->data['BufferedEvenement']['ficheactivite_model']=="BufferedFicheactivites" && !empty($this->request->data['BufferedEvenement']['ficheactivite_model_id'])){
                    $this->request->data['BufferedEvenement']['buffered_ficheactivite_id']=$this->request->data['BufferedEvenement']['ficheactivite_model_id'];
                }
                else if($this->request->data['BufferedEvenement']['ficheactivite_model']=="Ficheactivites" && !empty($this->request->data['BufferedEvenement']['ficheactivite_model_id'])){
                    $this->request->data['BufferedEvenement']['buffered_ficheactivite_id']=$this->BufferedEvenement->BufferedFicheactivite->_cloneFicheactivite($this->request->data['BufferedEvenement']['ficheactivite_model_id']);
                }
                if(!empty($this->request->data['BufferedEvenement']['buffered_ficheactivite_id'])){
                    $this->request->data['BufferedFicheactivite']=array('id'=>$this->request->data['BufferedEvenement']['buffered_ficheactivite_id'],'nom_complet'=>$this->request->data['BufferedEvenement']['ficheactivite_nom_complet']);
                }
            else{
                 $this->Session->setFlash(__d('administration', 'Création de la fiche support impossible'), 'default', array('class' => 'alert alert-danger'));
            }
                $master=$this->request->data['BufferedEvenement']['master'];
                if ($this->BufferedEvenement->saveAll($this->request->data)) {
                    $this->Session->setFlash(__d('administration', 'Vos modifications ont été enregistrées. Elles seront prochainement validées.'), 'default', array('class' => 'alert alert-success'));
                } else {
                    $this->Session->setFlash(__('impossible de sauvegarder vos modifications'), 'default', array('class' => 'alert alert-danger'));
                }

            }
                    
            
       
       if (!$this->request->data) {
          
           $this->request->data = $bufferedEvenement; 
            
       }
       
            $master=$bufferedEvenement['BufferedEvenement']['master'];
            $allImages = $this->BufferedEvenement->getAvailableMedia($bufferedEvenement, 'BufferedEvenementImage', 'Image');
            $allDocuments = $this->BufferedEvenement->getAvailableMedia($bufferedEvenement, 'BufferedEvenementDocument', 'Document');
            $allExternalMedias = $this->BufferedEvenement->getAvailableMedia($bufferedEvenement, 'BufferedEvenementExternalMedia', 'ExternalMedia');
     $this->set(compact('optionsGenres','optionsTypepublics','allImages', 'allDocuments', 'allExternalMedias'));    
            
        if ($master==0){
                    $optionsGenres=$this->BufferedEvenement->AgendaGenre->getListforForm();
                    $optionsTypepublics=$this->BufferedEvenement->Typepublic->find('list');
                    $optionsParentEvenements=$this->_getAvailableMasterEvenements('list');
                    $this->set(compact('optionsGenres','optionsTypepublics','optionsParentEvenements'));
                }
        $viewFile=$this->_getStandardOrMasterView($master);
        
        $this->render($viewFile );
           
            
        
    }

    public function add() {
        
         debug($this->request->data);
        if ($this->request->is(array('post', 'put')) && !(empty($this->request->data['BufferedEvenement']))) {
            $this->request->data['BufferedEvenement']['user_id'] = $this->Auth->user('id');
            if($this->request->data['BufferedEvenement']['ficheactivite_model']=="BufferedFicheactivites" && !empty($this->request->data['BufferedEvenement']['ficheactivite_model_id'])){
                $this->request->data['BufferedEvenement']['buffered_ficheactivite_id']=$this->request->data['BufferedEvenement']['ficheactivite_model_id'];
            }
            else if($this->request->data['BufferedEvenement']['ficheactivite_model']=="Ficheactivites" && !empty($this->request->data['BufferedEvenement']['ficheactivite_model_id'])){
                $this->request->data['BufferedEvenement']['buffered_ficheactivite_id']=$this->BufferedEvenement->BufferedFicheactivite->_cloneFicheactivite($this->request->data['BufferedEvenement']['ficheactivite_model_id']);
            }
            else{
                 $this->Session->setFlash(__d('administration', 'Création de la fiche support impossible'), 'default', array('class' => 'alert alert-danger'));
            }
           
            //parent
            
            if($this->request->data['BufferedEvenement']['parent_id']){
                $parentEvt=array_filter(self::$user['AvailablesEvenement'],function ($a){if ( $a['id']==$this->request->data['BufferedEvenement']['parent_id']){return 1;}});
                if($parentEvt['Controller']=='Evenements'){
                    //$this->BufferedEvenement->Evenement->_createDeepCopy
                }
            }
            
           
            if ($this->BufferedEvenement->saveAll($this->request->data)) {
                $this->Session->setFlash(__d('administration', 'Votre événement est enregistré. Il sera prochainement validé.<br/>Vous pouvez maintenant y associer des médias'), 'default', array('class' => 'alert alert-success'));

                return $this->redirect(array('action' => 'edit', $this->BufferedEvenement->id, '#' => 'images'));
            } else {
                $this->Session->setFlash(__('Création de l\'événement impossible'), 'default', array('class' => 'alert alert-danger'));
            }
           
          
        }
        
        elseif (isset($this->request->data['master'])){
            $this->set('optionsParentEvenements',$this->_getAvailableMasterEvenements('list'));
            $viewFile=$this->_getStandardOrMasterView($this->request->data['master']);
            $optionsGenres=$this->BufferedEvenement->AgendaGenre->getListforForm();
            $optionsTypepublics=$this->BufferedEvenement->Typepublic->find('list');
       
             $this->set(compact('optionsGenres','optionsTypepublics'));
             $this->render($viewFile );
        }
    }
    
   
    protected function _getStandardOrMasterView($eventType ){
        
        switch($eventType){
                case 1: $view= 'master_buffered_evenement';
                    break;
                default:$view= 'standard_buffered_evenement';
            }
            
            if ($this->theme) {
                 $viewFile = App::pluginPath($this->plugin) .'View' . DS . 'Themed' . DS . $this->theme .DS. $this->name. DS .$this->request->params['action'].'_'. $view.$this->ext;
            } else {
               $viewFile = App::pluginPath($this->plugin) .'View' .DS. $this->name. DS .$this->request->params['action'].'_'. $view.$this->ext;
            }
            if (!file_exists($viewFile)) {    
               throw(new NotFoundException('impossible de trouver le fichier '));
            }
            return $viewFile;
    }   
        public function getElement($element) {
    
//debug($this->plugin);
        $elementPath = 'Agenda/' . $element;
        $this->request->onlyAllow('ajax'); // No direct access via browser URL
        $this->autoRender = false;
        $this->viewPath = 'elements';
        $view = $this->_getViewObject();
        if ($view->elementExists($elementPath)) {
            $this->redirect(array('controller' => 'BufferedEvenements', 'action' => 'edit', $this->BufferedEvenement->getLastInsertId()));
        
            $this->render($elementPath);
        }
    }
    
    protected function _getAvailableMasterEvenements($mode='list'){
      //  debug(self::$user['AvailablesEvenement']);
        $masterEvts = array_filter(self::$user['AvailablesEvenement'],function ($a){if ( $a['master']==1){return 1;}});
        if( $mode=='list') return Hash::combine($masterEvts,'{n}.id','{n}.nom_complet');
        return $masterEvts;
    }
            

    
      public function delete($id = null) {

     // $this->request->onlyAllow('ajax'); // No direct access via browser URL
      if ($this->request->is(array('post', 'delete')) || $this->request['requested']) {

      if (!$id) {
            $response['error'] = 'Pas de fiche associé!';
      } else {
            try {
                $this->BufferedEvenement->id=$id;
                $this->BufferedEvenement->saveField('deleted',1);
                $BufferedEvenement = $this->BufferedEvenement->find('first', array('fields'=>array('BufferedEvenement.id','BufferedEvenement.master'),'conditions' => array('id' => $id)));
                 
                if ($BufferedEvenement['BufferedEvenement']['master']){
                  
                    $this->BufferedEvenement->updateAll(array('BufferedEvenement.deleted'=>1),array('BufferedEvenement.buffered_parent_id'=>$id));
                    
                }
                
            
            } catch (Exception $exc) {
                $response['error'] = $exc->getMessage();
            }
      
      


      } 

      $this->set('response', $response);
      $this->set('_serialize', 'response');
      }
      }


      public function updateMedia(){
      // debug($this->request->data);
      try{
          $this->BufferedEvenementMedia->saveMedia($this->request->data);
          
      }
      catch (Exception $exc) {
                $response['error'] = $exc->getMessage();
            }
       $this->set('response', $response);
      $this->set('_serialize', 'response');
      $this->render(false);
      }
      
}
