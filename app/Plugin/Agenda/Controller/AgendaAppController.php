<?php

App::uses('AppController', 'Controller');

class AgendaAppController extends AppController {

    protected $appName = 'Agenda';

    public function __construct($request = NULL, $response = NULL) {
        $agendaAppName = (array) Configure::read('Agenda.appName');

        if (!empty($agendaAppName)) {
            $this->appName = $agendaAppName[0];
        }

        $this->set('title_for_layout', $this->appName);
        parent::__construct($request, $response);
    }
     public function beforeFilter() {
        parent::beforeFilter();
    }

    public function beforeRender() {
        parent::beforeRender();
    }

}
