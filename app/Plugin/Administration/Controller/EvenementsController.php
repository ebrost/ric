<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EvenementController
 *
 * @author manu
 */
class EvenementsController extends AdministrationAppController {

    public $uses = array('Agenda.Evenement', 'Administration.BufferedEvenement');
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

    public function isAuthorized($user) {

        //    if(in_array($this->action,array('edit','delete'))){
        $modelId = $this->request->params['pass'][0];

        if ($user && $this->BufferedEvenement->isOwnedBy($modelId, $user['id'])) {
            return true;
        }
        //}
        return parent::isAuthorized($user);
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Pas d\'événement correspondante'));
        }

       
        //check si une fiche événement tampon existe deja !
        $bufferedEvenement = $this->BufferedEvenement->find('first', array('conditions' => array('BufferedEvenement.evenement_id' => $id)));
        
        
        if (!empty($bufferedEvenement)) {
            $this->Session->setFlash(
                    "Une version modifiée de cette fiche existe déjà et est en attente de validation<br/>Toutes les modifications précédemment apportées seront écrasées<br/> ", "default", array('class' => 'alert alert-info')
            );
              return $this->redirect(array('controller' => 'BufferedEvenements', 'action' => 'edit', $bufferedEvenement['BufferedEvenement']['id'], 'ref' => $evenement['Evenement']['id']));
        }
        else{
            $evenement = $this->Evenement->find('first', array('fields' => array('Evenement.id'), 'conditions' => array('Evenement.id' => $id)));

            if (!$evenement) {
                throw new NotFoundException(__('Pas d\'événement correspondant'));
            }
            
                    $this->BufferedEvenement->_cloneEvenement($id);
            
            $bufferedEvenementFromCopyId= $this->BufferedEvenement->field('id', array('BufferedEvenement.evenement_id' => $id));
       
            debug($bufferedEvenementFromCopyId);
            if (!$bufferedEvenementFromCopyId) {
                $this->Session->setFlash(__('Création de l\'evenement tampon impossible.'), 'default', array('class' => 'alert alert-danger'));
            } else {
                return $this->redirect(array('controller' => 'BufferedEvenements', 'action' => 'edit', $bufferedEvenementFromCopyId, 'ref' => $id));
            }
        }
     
        
    }

    public function delete($id = null) {

        $this->request->onlyAllow('ajax'); // No direct access via browser URL
        if ($this->request->is(array('post', 'delete'))) {

            if (!$id) {
                $response['error'] = 'Pas d\'événement associé!';
            } else {
                try {
                    $evenement = $this->Evenement->find('first', array('fields'=>'Evenement.id','conditions' => array('id' => $id)));
                } catch (Exception $exc) {
                    $response['error'] = 'Pas d\'evenement associé!';
                }
            }
            $BufferedEvenement = $this->BufferedEvenement->find('first', array('fields'=>'BufferedEvenement.id','conditions' => array('evenement_id' => $id)));

            if (!empty($BufferedEvenement)) {
               // $this->request->data['BufferedEvenement']['id'] = $BufferedEvenement['BufferedEvenement']['id'];
               $this->requestAction(array('controller' => 'BufferedEvenements', 'action' => 'delete', $this->BufferedEvenement->id, 'ref' => $id));
            } else {
                 $bufferedEvenementId= $this->BufferedEvenement->_cloneEvenement($id);
                 $this->requestAction(array('controller' => 'BufferedEvenements', 'action' => 'delete', $bufferedEvenementId, 'ref' => $id));
            }
            $this->set('response', $response);
            $this->set('_serialize', 'response');
        }
    }
   

}
