<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BufferedSessionsController
 *
 * @author manu
 */
class BufferedSessionsController extends AdministrationAppController {
    
    public $name = 'BufferedSessions';
    public $plugin = 'Administration';
     public $uses = array('Administration.BufferedSession');
    
    public function delete($id = null) {

        $this->request->onlyAllow('ajax'); // No direct access via browser URL
        if ($this->request->is(array('post', 'delete'))) {

            if (!$id) {
                $response['error'] = 'Pas de session associée !';
            } else {
                try {
                      $this->BufferedSession->delete($id);
                 
                } catch (Exception $exc) {
                    $response['error'] = 'Pas de session associée !';
                }
            }
          
            $this->set('response', $response);
            $this->set('_serialize', 'response');
        }
    }
}
