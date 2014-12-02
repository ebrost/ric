<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FicheactiviteController
 *
 * @author manu
 */
class FicheactivitesController extends AdministrationAppController {

    public $uses = array('Annuaire.Ficheactivite', 'Administration.BufferedFicheactivite');
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

        if ($user && $this->BufferedFicheactivite->isOwnedBy($modelId, $user['id'])) {
            return true;
        }
        //}
        return parent::isAuthorized($user);
    }

    public function edit($id = null) {
        
            if (!$id) {
                throw new NotFoundException(__('Pas d\'activité correspondante'));
            }

            $ficheactivite = $this->Ficheactivite->find('first', array('conditions' => array('id' => $id)));
            if (!$ficheactivite) {
                throw new NotFoundException(__('Pas d\'activité correspondante'));
            }
            //check si une fiche tampon existe deja !
            $BufferedFicheactivite = $this->BufferedFicheactivite->find('first', array('conditions' => array('ficheactivite_id' => $id)));
            //  debug($BufferedFicheactivite);
            if (!empty($BufferedFicheactivite)) {
                $this->request->data['BufferedFicheactivite']['id'] = $BufferedFicheactivite['BufferedFicheactivite']['id'];
                $this->Session->setFlash(
                        "Une version modifiée de cette fiche existe déjà et est en attente de validation<br/>Toutes les modifications précédemment apportées seront écrasées<br/> ", "default", array('class' => 'alert alert-info')
                );
                // $this->redirect('/BufferedFicheactivites/edit',$this->BufferedFicheactivite->id);
                return $this->redirect(array('controller' => 'BufferedFicheactivites', 'action' => 'edit', $BufferedFicheactivite['BufferedFicheactivite']['id'], 'ref' => $ficheactivite['Ficheactivite']['id']));
            } else {
                //on cree une fiche tampon et on la remplit avec les données de la fiche existante.
                debug('not exists');
                $bufferedFicheactiviteId=$this->BufferedFicheactivite->_cloneFicheactivite($id);
              /*
                $this->BufferedFicheactivite->create();
                $this->request->data['BufferedFicheactivite'] = $ficheactivite['Ficheactivite'];
                $this->request->data['BufferedFicheactivite']['ficheactivite_id'] = $id;
                unset($this->request->data['BufferedFicheactivite']['id']);
               * 
               */
              //  if (!$this->BufferedFicheactivite->saveAll($this->request->data['BufferedFicheactivite'])) {
                if (!$bufferedFicheactiviteId) {
                    $this->Session->setFlash(__('Création de la fiche impossible.'), 'default', array('class' => 'alert alert-danger'));
                } else {
                    return $this->redirect(array('controller' => 'BufferedFicheactivites', 'action' => 'edit', $this->BufferedFicheactivite->id, 'ref' => $ficheactivite['Ficheactivite']['id'],));
                }
            }

            // $this->redirect(array('controller'=>'BufferedFicheactivites', 'action'=>'edit','ref'=>$id));
            //$this->render('BufferedFicheactivites/edit');
        
    }

    public function delete($id = null) {

        $this->request->onlyAllow('ajax'); // No direct access via browser URL
        if ($this->request->is(array('post', 'delete'))) {

            if (!$id) {
                $response['error'] = 'Pas de fiche associé!';
            } else {
                try {
                    $ficheactivite = $this->Ficheactivite->find('first', array('fields'=>'Ficheactivite.id','conditions' => array('id' => $id)));
                } catch (Exception $exc) {
                    $response['error'] = 'Pas de fiche associé!';
                }
            }
            $BufferedFicheactivite = $this->BufferedFicheactivite->find('first', array('fields'=>'BufferedFicheactivite.id','conditions' => array('ficheactivite_id' => $id)));
            //  debug($BufferedFicheactivite);
            if (!empty($BufferedFicheactivite)) {
               $this->requestAction(array('controller' => 'BufferedFicheactivites', 'action' => 'delete', $this->BufferedFicheactivite->id, 'ref' => $id));
            } else {
               $bufferedFicheactiviteId= $this->BufferedFicheactivite->_cloneFicheactivite($id);
               return;
                 $this->requestAction(array('controller' => 'BufferedFicheactivites', 'action' => 'delete', $bufferedFicheactiviteId, 'ref' => $id));
            }
            $this->set('response', $response);
            $this->set('_serialize', 'response');
        }
    }

}
