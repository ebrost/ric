<?php

class BufferedFicheactivitesController extends AdministrationAppController {

  //  public $uses = array('Administration.BufferedFicheactivite','Administration.BufferedFicheactiviteMedia', 'Annuaire.Ficheactivite');
    public $uses = array('Administration.BufferedFicheactivite','Administration.BufferedFicheactiviteMedia');
    public $name = 'BufferedFicheactivites';
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
    
        if($id){
            //la fiche tampon existe, on edite
             $bufferedFicheactivite = $this->BufferedFicheactivite->find('first',array(
                
                 'contain'=>array('AdministrationUser.id','Session','BufferedFicheactiviteImage','BufferedFicheactiviteImage.Image','BufferedFicheactiviteDocument','BufferedFicheactiviteDocument.Document','BufferedFicheactiviteExternalMedia','BufferedFicheactiviteExternalMedia.ExternalMedia'),
                 'conditions'=>array('BufferedFicheactivite.id'=>$id),
                 ));
           
            $allImages=$this->BufferedFicheactivite->getAvailableMedia($bufferedFicheactivite,'BufferedFicheactiviteImage','Image');
            $allDocuments=$this->BufferedFicheactivite->getAvailableMedia($bufferedFicheactivite,'BufferedFicheactiviteDocument','Document');
            $allExternalMedias=$this->BufferedFicheactivite->getAvailableMedia($bufferedFicheactivite,'BufferedFicheactiviteExternalMedia','ExternalMedia');
         
            if ($this->request->is(array('post', 'put'))) {
                    $this->BufferedFicheactivite->id = $id;
                if ($this->BufferedFicheactivite->save($this->request->data)) {
                    $this->Session->setFlash(__d('administration', 'Vos modifications ont été enregistrées. Elles seront prochainement validées.'), 'default', array('class' => 'alert alert-success'));
                } else {
                    $this->Session->setFlash(__('impossible de sauvegarder vos modifications'), 'default', array('class' => 'alert alert-danger'));
                }
               // $this->redirect(array('controller' => 'BufferedFicheactivites', 'action' => 'edit', $id));
            }
        }
        else if(!empty($this->request->data['BufferedFicheactivite']['ficheactivite_id'])){
            if ($this->request->is(array('post', 'put'))) {
                  
                    $this->BufferedFicheactivite->id = $id;
                if ($this->BufferedFicheactivite->save($this->request->data)) {
                    $this->Session->setFlash(__d('administration', 'Vos modifications ont été enregistrées. Elles seront prochainement validées.'), 'default', array('class' => 'alert alert-success'));
                } else {
                    $this->Session->setFlash(__('impossible de sauvegarder vos modifications'), 'default', array('class' => 'alert alert-danger'));
                }
                $this->redirect(array('controller' => 'BufferedFicheactivites', 'action' => 'edit', $this->BufferedFicheactivite->getLastInsertId()));
        }
        }
        
         if (!$this->request->data) {
                $this->request->data = $bufferedFicheactivite;
            }
           $this->set(compact('bufferedFicheactivite','allImages','allDocuments','allExternalMedias')); 
        
    }

    public function add() {
        if ($this->request->is(array('post', 'put'))) {
            $this->request->data['BufferedFicheactivite']['user_id'] = $this->Auth->user('id');
            // $this->BufferedFicheactivite->create();
            if ($this->BufferedFicheactivite->save($this->request->data)) {
                $this->Session->setFlash(__d('administration', 'Votre activité est enregistrée. Elle sera prochainement validée.<br/>Vous pouvez maintenant y associer des médias'), 'default', array('class' => 'alert alert-success'));
               
                return $this->redirect(array('action' => 'edit',$this->BufferedFicheactivite->id,'#'=>'images'));
            } else {
                $this->Session->setFlash(__('impossible de sauvegarder votre activité'), 'default', array('class' => 'alert alert-danger'));
            }
        }
    }
    
     public function delete($id = null) {

       
       // $this->request->onlyAllow('ajax'); // No direct access via browser URL
        if ($this->request->is(array('post', 'delete')) || $this->request['requested']) {
        
            if (!$id) {
                $response['error'] = 'Pas de fiche associé!';
            } else {
                try {
                      $this->BufferedFicheactivite->id=$id;
                      if (Cakeplugin::loaded('Agenda')) {
                          $this->loadModel('Administration.BufferedEvenement');
                        $BufferedFicheactiviteCount = $this->BufferedEvenement->find('count', array('conditions' => array('buffered_ficheactivite_id' => $id))) ;
                        if($BufferedFicheactiviteCount>0) throw new Exception('Des événements sont liés à cette activité.');
                    }
                      
                      $this->BufferedFicheactivite->saveField('deleted',1);
                } catch (Exception $exc) {
                 // debug($exc->getMessage());
                    $response['error'] = $exc->getMessage();
                }
            }
          
            $this->set('response', $response);
            $this->set('_serialize', 'response');
        }
    }



    public function updateMedia(){
      // debug($this->request->data);
        $response=array();
      try{
          $this->BufferedFicheactiviteMedia->saveMedia($this->request->data);
          
      }
      catch (Exception $exc) {
           
                $response['error'] = $exc->getMessage();
            }
       $this->set('response', $response);
      $this->set('_serialize', 'response');
      $this->render(false);
      }
     
}
