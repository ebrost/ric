<?php

App::uses('Sanitize', 'Utility');

class FicheoeuvresController extends OeuvresAppController {

    // public $uses = array();
    public $uses = array('Oeuvres.Ficheoeuvre', 'Oeuvres.OeuvreActivite','Oeuvres.OeuvreDiscipline', 'Oeuvres.OeuvreGenre', 'Oeuvres.Typepublic','Oeuvres.Typeoeuvre', 'Implantation');
    public $cacheAction = array('view' => 36000);

    public function beforeFilter() {
        $this->response->header('Access-Control-Allow-Origin', '*');
        parent::beforeFilter();
    }

    protected function _displayPaginatedResults($searchConditions) {
        $searchConditions['orderBy'] = (!empty($searchConditions['orderBy'])) ? array_merge($searchConditions['orderBy'], array('Ficheoeuvre.nom_complet' => 'asc', 'Ficheoeuvre.id' => 'asc')) : array('Ficheoeuvre.nom_complet' => 'asc', 'Ficheoeuvre.id' => 'asc');

        // $fo_fields=('Evenement.nom_complet,Evenement.genres,Evenement.parent_id,Evenement.type_id,Evenement.master,Evenement.annule,Type.*');

        $fo_fields = 'Ficheoeuvre.*';
        $fields = (!empty($searchConditions['additionalsFields'])) ? array_merge(array($fo_fields), $searchConditions['additionalsFields']) : $fo_fields;
        $this->paginate = array(
            'fields' => $fields,
            'findType' => 'byCriteria',
            'limit' => $this->Ficheoeuvre->getResultsPerPage(),
            'order' => $searchConditions['orderBy'],
            'conditions' => $searchConditions['conditions'],
            'group' => 'Ficheoeuvre.id',
            'contain' => array('FicheoeuvresActivite','OeuvreActivite','FicheoeuvresGenre','OeuvreGenre','FicheoeuvresTypepublic','Typepublic', 'Image')
        );
        $ficheoeuvres = $this->paginate();
        return $ficheoeuvres;
    }

    private function setFormOptions() {

        $searchFormOptions['prix'] = $this->Ficheoeuvre->Prix->find('list');
        $searchFormOptions['jauge'] = $this->Ficheoeuvre->Jauge->find('list');
        $searchFormOptions['duree'] = $this->Ficheoeuvre->Duree->find('list');
        $searchFormOptions['typepublics'] = $this->Typepublic->find('list');
        $searchFormOptions['typeoeuvre'] = $this->Typeoeuvre->find('list');
        $searchFormOptions['activite'] = $this->OeuvreActivite->find('list');
        $searchFormOptions['genre'] = $this->OeuvreGenre->getListForForm();
        $searchFormOptions['discipline'] = $this->OeuvreDiscipline->find('list');
        $searchFormOptions['implantations'] = $this->Implantation->find('list');
        //rendu des listes d'options
        //utiliser array_map...
        $searchFormOptions['prix'] = $this->Ficheoeuvre->formatList($searchFormOptions['prix'], false);
        $searchFormOptions['jauge'] = $this->Ficheoeuvre->formatList($searchFormOptions['jauge'], false);
        $searchFormOptions['duree'] = $this->Ficheoeuvre->formatList($searchFormOptions['duree'], false);
        $searchFormOptions['typepublics'] = $this->Ficheoeuvre->formatList($searchFormOptions['typepublics'], false);
        $searchFormOptions['typeoeuvre'] = $this->Ficheoeuvre->formatList($searchFormOptions['typeoeuvre'], false);
        $searchFormOptions['activite'] = $this->Ficheoeuvre->formatList($searchFormOptions['activite'], false);
        $searchFormOptions['discipline'] = $this->Ficheoeuvre->formatList($searchFormOptions['discipline'], false);
        $searchFormOptions['implantations'] = $this->Ficheoeuvre->formatList($searchFormOptions['implantations'], false);
        return $searchFormOptions;
    }

    public function getIdList($fichesoeuvres) {

        foreach ($fichesoeuvres as $fichesoeuvre) {
            $idList[] = $fichesoeuvre['Ficheoeuvre']['id'];
        }
        $idList = base64_encode(serialize(implode(',', $idList)));

        return $idList;
    }

    public function index() {
        $this->redirect('search');
    }

    public function display() {
        $this->redirect('search');
    }

    public function embededView($id) {
        /*
          if (empty($this->request->params['requested'])) {
          throw new ForbiddenException();
          } */
        $ficheoeuvre = $this->Ficheoeuvre->findById($id);
        $this->set(compact('ficheoeuvre'));
    }

    public function viewNav($id = null, $nom = null) {
     //   if ($this->request->is('ajax')) {
            //Configure::write('debug', 0);
            //	if(!empty($this->request->params['named']['q'])){

            $prevAndNext = $this->Ficheoeuvre->prevAndNext($id, $nom, $this->request->params['named']['q'], $this->request->params['named']['r']);
            $prev = $prevAndNext['prev'];
            $next = $prevAndNext['next'];

            $page = isset($this->request->params['named']['page']) ? $this->request->params['named']['page'] : 1;
            if (isset($this->request->params['named']['num'])) {
                $ficheoeuvre['Ficheoeuvre']['num'] = $this->request->params['named']['num'];
                $next['Ficheoeuvre']['num'] = $this->request->params['named']['num'] + 1;
                $prev['Ficheoeuvre']['num'] = $this->request->params['named']['num'] - 1;
                $page = floor($ficheoeuvre['Ficheoeuvre']['num'] / $this->Ficheoeuvre->getResultsPerPage()) + $page;
            }
            
            $this->set(compact('nom', 'prev', 'next', 'page'));
           
            $this->render('Elements/prevNextDetailBrowser', 'ajax');
            //	}
       // }
    }

    public function search() {
        $displaySearchResults = $this->Ficheoeuvre->getdisplayListOnLoad();
        $searchFormOptions = $this->setFormOptions();
        $this->set(compact('searchFormOptions'));
        if (!empty($this->request->params['named']['q'])) {
            $q = $this->request->params['named']['q'];
            $searchConditions = $this->Ficheoeuvre->_getConditions($q);
            $this->request->data = unserialize(base64_decode($q));
            $displaySearchResults = TRUE;
        }

        //si les donn�es viennent du formulaire,
        // on les serialize pour les passer aux liens (pagination, detail...)
        elseif (!empty($this->request['data']['Search']) && empty($this->request['params']['named']['q'])) {
            $searchConditions = $this->Ficheoeuvre->_getConditions($this->request['data'], false);
            debug($searchConditions);
            $q = base64_encode(serialize($this->request['data']));
            $displaySearchResults = TRUE;
            $submitted = true;
        }
        if ($displaySearchResults) {

            $fichesoeuvres = $this->_displayPaginatedResults($searchConditions);

            $idList = $this->getIdList($fichesoeuvres);


            $this->set(compact('fichesoeuvres', 'submitted', 'q', 'idList'));
        }
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
            $searchConditions = $this->Ficheoeuvre->_getConditions($cleanData, false);
            $count = $this->Ficheoeuvre->find('count', array(
                'conditions' => $searchConditions['conditions'],
                'fields' => 'COUNT(DISTINCT Ficheoeuvre.id) as count'
            ));

            $this->set(compact('count'));
            $this->set('_serialize', array('count'));
        } else {
            throw new BadRequestException('operation non autorisée');
        }
    }
    
     public function view($id = null, $slug = null) {
        //$this->cacheAction = true;      
        if ($id) {
            //$ficheoeuvre=$this->Ficheoeuvre->find('first',array('conditions'=>array('Ficheoeuvre.id'=>$id)));
            $ficheoeuvre = $this->Ficheoeuvre->_findById($id);

            if (!empty($ficheoeuvre)) {
                $sluggedNomComplet = Inflector::slug($ficheoeuvre['Ficheoeuvre']['nom_complet']);
                if (strcmp($sluggedNomComplet, $slug) != 0) {
                    throw new NotFoundException('Pas de fiche oeuvre correspondante');
                }

                $this->set(compact('ficheoeuvre'));
                $this->set('_serialize', array('ficheoeuvre'));
            } else {
                throw new NotFoundException('Pas de fiche oeuvre correspondante');
            }
        }

        //debug($this->request);
    }
    
     public function viewPdfList() {
        $this->RequestHandler->renderAs($this, 'pdf');
       
        if ($this->Ficheoeuvre->isUnlimitedPdfList()) {
            $q = $this->request->params['named']['q'];
            $searchConditions = $this->Ficheoeuvre->_getConditions($q);
          
             $searchConditions['orderBy'] = (!empty($searchConditions['orderBy'])) ? $searchConditions['orderBy'] : array();
            
            $fields = (!empty($searchConditions['additionalsFields'])) ? array_merge(array('DISTINCT *'), $searchConditions['additionalsFields']) : 'DISTINCT *';
            
           $fichesoeuvres = $this->Ficheoeuvre->find('all',array(
                 'fields' => $fields,
                 'conditions' => $searchConditions['conditions'],
                'group' => 'Ficheoeuvre.id',
                'order' => array_merge($searchConditions['orderBy'], array('nom_complet' => 'asc', 'id' => 'asc')),
                 'contain' => array('FicheoeuvresActivite','OeuvreActivite','FicheoeuvresGenre','OeuvreGenre','FicheoeuvresTypepublic','Typepublic', 'Image')

            ));
        }
        else  if (isset($this->request->params['named']['idList'])) {
            $idList = $this->request->params['named']['idList'];
            if ($this->request->params['named']['encoded']) {
                $idList = explode(',', unserialize(base64_decode($idList)));
            } else {
                $idList = explode(',', $idList);
            }
            $fichesoeuvres = $this->Ficheoeuvre->_getList($idList);
           
        }
         $this->set(compact('fichesoeuvres'));
    }

}
