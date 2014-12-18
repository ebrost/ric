<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('Sanitize', 'Utility','CakeTime');
App::uses('Sanitize', 'Utility');


class EvenementsController extends AgendaAppController {

    public $uses = array('Agenda.Evenement', 'Agenda.AgendaGenre','Implantation');
    public $helpers = array('Text');
    public $cacheAction = array('view' => 36000);

    public function index() {
        $this->redirect('search');
    }

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('*');
    }

    private function setFormOptions() {

        $listImplantations = $this->Implantation->find('list');
        $searchFormOptions['Implantations'] = $this->Evenement->formatList($listImplantations, false);

        $today = new DateTime();
        $searchFormOptions['startDate'] = $today->format('d-m-Y');
        debug((int)$this->Evenement->getDateOffset());
        if ($this->Evenement->getDateOffset() > 0) {
            debug((int)$this->Evenement->getDateOffset());
            $searchFormOptions['endDate'] = $today->add(new DateInterval('P' . $this->Evenement->getDateOffset() . 'D'))->format('d-m-Y');
            //$searchFormOptions['endDate']->add(new DateInterval('P'.$this->Evenement->getDateOffset().'D'));
        }

        $searchFormOptions['Types'] = $this->Evenement->Type->find('list');

        $listGenres = $this->AgendaGenre->find('list');
        $searchFormOptions['Genres'] = $this->Evenement->formatList($listGenres, true);

        $searchFormOptions['Typepublics'] = $this->Evenement->Typepublic->find('list');
        $searchFormOptions['Tags'] = $this->Evenement->Tag->find('list');

        return $searchFormOptions;
    }
    
    public function displayPrioritaire(){
        $data['Search']['prioritaire']=true;
      
        $searchConditions = $this->Evenement->_getConditions($data, false);
        $evenements= $this->_displayPaginatedResults($searchConditions);
        $q = base64_encode(serialize($data));
        $this->set(compact('evenements', 'submited', 'q', 'idList'));
    }
    public function getIdList($evenements){
      
            foreach($evenements as $evenement){
                $idList[]= $evenement['Evenement']['id'];
            }
            $idList = base64_encode(serialize(implode(',', $idList)));
            
            return $idList;
        
    }
     protected function _displayPaginatedResults($searchConditions,$limit=null){
            $searchConditions['order'] = (!empty($searchConditions['order'])) ? array_merge($searchConditions['order'],array('Evenement.premieredatesession'=>'asc','Evenement.id' => 'asc')): array('Evenement.premieredatesession'=>'asc','Evenement.id' => 'asc');
            $evt_fields=('Evenement.nom_complet,Evenement.url_site_web,Evenement.genres,Evenement.parent_id,Evenement.type_id,Evenement.master,Evenement.annule,Type.*');
                  
            $fields = (!empty($searchConditions['additionalsFields'])) ? array_merge(array($evt_fields), $searchConditions['additionalsFields']) : $evt_fields;
            $limit=!empty($limit) ? $limit:$this->Evenement->getResultsPerPage();
            $this->paginate = array(
                 'fields' => $fields,
                //  'findType' => 'byCriteria',
                 'limit' => $limit,
               'order' => $searchConditions['order'] ,
                'conditions' => $searchConditions['conditions'],
                'group' => 'Evenement.id',
                'contain'=>array('Session','EvenementsCommune','EvenementsTypepublic','Typepublic','Type','EvenementsTag','Tag','EvenementsGenre','AgendaGenre','Image')
               
            );
            $evenements= $this->paginate();
        return $evenements;
    } 
    public function search() {

        $searchConditions = array();

        $displaySearchResults = $this->Evenement->getdisplayListOnLoad();


        if (!empty($this->request->params['named']['q'])) {
            $q = $this->request->params['named']['q'];
            $searchConditions = $this->Evenement->_getConditions($q);
            $this->request->data = unserialize(base64_decode($q));
            $displaySearchResults = TRUE;
        }

        //si les donn�es viennent du formulaire,
        // on les serialize pour les passer aux liens (pagination, detail...)
        elseif (!empty($this->request['data']['Search']) && empty($this->request['params']['named']['q'])) {
            $searchConditions = $this->Evenement->_getConditions($this->request['data'], false);
            $q = base64_encode(serialize($this->request['data']));
            $displaySearchResults = TRUE;
            $submitted=true;
        }
         else{
            $searchConditions = $this->Evenement->_getConditions();
        }
       
        if ($displaySearchResults) {
            
           
           // debug($this->paginate); 
            
            $evenements =$this->_displayPaginatedResults($searchConditions);
            //debug($evenements);
             $idList=$this->getIdList($evenements);
            //  $idList = base64_encode(serialize(implode(',', $idList)));
            
            $this->set(compact('evenements', 'submitted', 'q', 'idList'));
        }

        $maxSessionsByEventOnList = $this->Evenement->getmaxSessionsByEventOnList();
        $searchFormOptions = $this->setFormOptions();
        $this->set(compact('searchFormOptions', 'maxSessionsByEventOnList'));

        $this->render('index');
    }
    public function getCount() {
        if ($this->request->is('ajax')) {
            //clean data
            $cleanData = Sanitize::clean($this->request['data']);

            if (!empty($cleanData['Search']['commune_id'])) {
                $cleanData['Search']['commune_id'] = str_replace("&quot;", "'", $cleanData['Search']['commune_id']);
            }
            //debug($cleanData,false);
            $searchConditions = $this->Evenement->_getConditions($cleanData, false);

            $count = $this->Evenement->find('count', array(
                'conditions' => $searchConditions['conditions'],
                'fields' => 'COUNT(DISTINCT Evenement.id) as count'
            ));

            $this->set(compact('count'));
            $this->set('_serialize', array('count'));
        } else {
            throw new BadRequestException('operation non autorisée');
        }
    }
    
    public function feed(){
           if ($this->RequestHandler->isRss() ) {
            
               if (!empty($this->request->params['named']['q'])) {
                    $q = $this->request->params['named']['q'];
                    debug( unserialize(base64_decode($q)));
                    $searchData=unserialize(base64_decode($q));
                    $today = new DateTime();
                    $searchData['Search']['startDate'] = $today->add(new DateInterval('P' . $this->Evenement->getRssStartDate() . 'D'))->format('d-m-Y');
                    $searchData['Search']['endDate'] = $today->add(new DateInterval('P' . $this->Evenement->getRssDateOffset() . 'D'))->format('d-m-Y');
                    $searchConditions = $this->Evenement->_getConditions($searchData, false);
                    $searchConditions['order'] = (!empty($searchConditions['order'])) ? array_merge($searchConditions['order'],array('Evenement.premieredatesession'=>'asc','Evenement.id' => 'asc')): array('Evenement.premieredatesession'=>'asc','Evenement.id' => 'asc');
                    $evt_fields=('Evenement.nom_complet,Evenement.commentaires,Evenement.url_site_web,Evenement.genres,Evenement.parent_id,Evenement.type_id,Evenement.master,Evenement.annule,Type.*');
              $fields = (!empty($searchConditions['additionalsFields'])) ? array_merge(array($evt_fields), $searchConditions['additionalsFields']) : $evt_fields;
                    $evenements=$this->Evenement->find('all',array(
                            'fields' => $fields,
                
                            'limit' => $this->Evenement->getRssMaxEvents(),
                            'order' => $searchConditions['order'] ,
                            'conditions' => $searchConditions['conditions'],
                            'group' => 'Evenement.id',
                             'contain'=>array('Session','EvenementsCommune','EvenementsTypepublic','Typepublic','Type','EvenementsTag','Tag','EvenementsGenre','AgendaGenre','Image')
               
                ));
           
        $this->set(compact('evenements'));
        ////$this->RequestHandler->respondAs('rss');
        // pour Chrome, un peu buggé de ce coté la à l'époque de l'ecriture
        $this->RequestHandler->respondAs('application/xml');
               }

           }
    }
    public function view($id = null, $slug = null) {
        //$this->cacheAction = true;
        //debug($this->request);
        //debug(unserialize(base64_decode($this->request->params['named']['q'])));

        if ($id) {

            $evenement = $this->Evenement->_findById($id);
            // debug($evenement);
            if (!empty($evenement)) {
                $sluggedNomComplet = Inflector::slug($evenement['Evenement']['nom_complet']);
                if (strcmp($sluggedNomComplet, $slug) != 0) {
                    throw new NotFoundException('Pas d\'événement correspondant');
                }

                $maxSessionsByEventOnList = $this->Evenement->getmaxSessionsByEventOnList();
                $this->set(compact('evenement', 'maxSessionsByEventOnList'));
                $this->set('_serialize', array('evenement'));
            } else {
                throw new NotFoundException('Pas d\'événement correspondant');
            }
        }

        //debug($this->request);
    }

    public function viewNav($id = null, $premiereDateSession=null) {
        if ($this->request->is('ajax')) {
            //Configure::write('debug', 0);
            //	if(!empty($this->request->params['named']['q'])){

            $prevAndNext = $this->Evenement->prevAndNext($id, $premiereDateSession, $this->request->params['named']['q'], $this->request->params['named']['r']);
            debug($prevAndNext);
            $prev = $prevAndNext['prev'];
            $next = $prevAndNext['next'];
            $page = isset($this->request->params['named']['page']) ? $this->request->params['named']['page'] : 1;
            if (isset($this->request->params['named']['num'])) {
                $ficheactivite['Evenement']['num'] = $this->request->params['named']['num'];
                $next['Evenement']['num'] = $this->request->params['named']['num'] + 1;
                $prev['Evenement']['num'] = $this->request->params['named']['num'] - 1;
                $page = floor($ficheactivite['Evenement']['num'] / $this->Evenement->getResultsPerPage()) + $page;
            }
            //	debug($next);
            
            $this->set(compact('nom', 'prev', 'next', 'page'));
            $this->render('Elements/prevNextDetailBrowser','ajax');
            //	}
        }
    }
    
    public function viewPdfList() {
        $this->RequestHandler->renderAs($this, 'pdf');
         if ($this->Evenement->isUnlimitedPdfList()) {
            $q = $this->request->params['named']['q'];
            $searchConditions = $this->Evenement->_getConditions($q);
          
             $searchConditions['orderBy'] = (!empty($searchConditions['orderBy'])) ? $searchConditions['orderBy'] : array();
            
            $fields = (!empty($searchConditions['additionalsFields'])) ? array_merge(array('DISTINCT *'), $searchConditions['additionalsFields']) : 'DISTINCT *';
            
            $fichesactivites = $this->Ficheactivite->find('all',array(
                 'fields' => $fields,
                 'conditions' => $searchConditions['conditions'],
                'group' => 'Ficheactivite.id',
                'order' => array_merge($searchConditions['orderBy'], array('nom_complet' => 'asc', 'id' => 'asc'))
            ));
        }
        else  if (isset($this->request->params['named']['idList'])) {
            $idList = $this->request->params['named']['idList'];
            if ($this->request->params['named']['encoded']) {
                $idList = explode(',', unserialize(base64_decode($idList)));
            } else {
                $idList = explode(',', $idList);
            }
            $evenements = $this->Evenement->_getList($idList);
            
            $this->set(compact('evenements'));
        }
    }

    public function embededListView($id) {
        /*
          if (empty($this->request->params['requested'])) {
          throw new ForbiddenException();
          } */
        $evenements = $this->Evenement->find('all',array(
            'contain'=>array('Parent','Type','Image','Session'),
            'fields'=>array('Evenement.id','Evenement.master','Evenement.nom_complet','Evenement.recap_session','Evenement.genres','Evenement.annule','Type.name',
            'Parent.nom_complet'),
            'conditions'=>array('Evenement.ficheactivite_id'=>$id)
            
            ));
        $maxSessionsByEventOnList = $this->Evenement->getmaxSessionsByEventOnList();
        $this->set(compact('evenements', 'maxSessionsByEventOnList'));

        $this->render('/Elements/embeded_list_view');
    }
     public function embededView($id) {
        if ($id) {

            $evenement = $this->Evenement->_findById($id);
            // debug($evenement);
            if (!empty($evenement)) {
                

                $this->set(compact('evenement'));
                $this->set('_serialize', array('evenement'));
               
            } else {
                throw new NotFoundException('Pas d\'événement correspondant');
            }
        }
    }

}
