<?php

App::uses('Sanitize', 'Utility');

class FicheactivitesController extends AnnuaireAppController {

    public $uses = array('Annuaire.Ficheactivite','Annuaire.Activite','Annuaire.Genre','Annuaire.Discipline', 'Implantation', 'Pays', 'CommunauteCommune', 'BassinPopulation');
    public $actsAs = array('Containable');
   // public $helpers = array('Cache', 'Html', 'Form', 'Tools.GoogleMapV3','RicImage');
   // public $components = array('RequestHandler');
    public $cacheAction = array('view' => 3600);
   
    public function beforeFilter() {
        $this->response->header('Access-Control-Allow-Origin', '*');
        parent::beforeFilter();
    }
   
    public function index() {
        $this->redirect('search');
    }

    public function display() {
        $this->redirect('search');
    }
   
    public function getIdList($fichesactivites){
       
             foreach($fichesactivites as $fichesactivite){
                $idList[]= $fichesactivite['Ficheactivite']['id'];
            }
            $idList = base64_encode(serialize(implode(',', $idList)));
            
            return $idList;
        
    }
    
    public function search() {
        
        $searchConditions = array();
        //type de formulaire a afficher
        $searchFormType= $this->Ficheactivite->getSearchFormType();
        $this->set(compact('searchFormType'));  
        // on regarde la constante pour voir s'il faut afficher au chargement
        $displaySearchResults = $this->Ficheactivite->getdisplayListOnLoad();

        //si les donn�es proviennent d'un lien  
        if (!empty($this->request->params['named']['q'])) {
            $q = $this->request->params['named']['q'];
            $searchConditions = $this->Ficheactivite->_getConditions($q);
            $this->request->data = unserialize(base64_decode($q));
            $displaySearchResults = TRUE;
        }

        //si les donn�es viennent du formulaire,
        // on les serialize pour les passer aux liens (pagination, detail...)
        elseif (!empty($this->request['data']['Search']) && empty($this->request['params']['named']['q'])) {
            $searchConditions = $this->Ficheactivite->_getConditions($this->request['data'], false);
            $q = base64_encode(serialize($this->request['data']));
            $displaySearchResults = TRUE;
        }


        if ($displaySearchResults) {
            //$searchConditions
            $searchConditions['orderBy'] = (!empty($searchConditions['orderBy'])) ? $searchConditions['orderBy'] : array();
            
            $fields = (!empty($searchConditions['additionalsFields'])) ? array_merge(array('DISTINCT *'), $searchConditions['additionalsFields']) : 'DISTINCT *';
            $this->paginate = array(
                'fields' => $fields,
                'findType' => 'byCriteria',
                'limit' => $this->Ficheactivite->getResultsPerPage(),
                'order' => array_merge($searchConditions['orderBy'], array('nom_complet' => 'asc', 'id' => 'asc')),
                'conditions' => $searchConditions['conditions'],
                'group' => 'Ficheactivite.id'                 
            );
            $fichesactivites = $this->paginate();
            $idList=$this->getIdList($fichesactivites);
            $this->set(compact('fichesactivites', 'submited', 'q', 'idList'));
        }

        

        //recuperation des listes pour les nomenclatures du requeteur.
        $searchFormOptions=$this->setFormOptions();

        $this->set(compact('searchFormOptions'));
        $this->render('index');
    }
    
    private function setFormOptions(){

        $searchFormOptions['activites'] = $this->Activite->getList();
        $searchFormOptions['genres'] = $this->Genre->find('list');
        $searchFormOptions['implantations'] = $this->Implantation->find('list');
        $searchFormOptions['bassinsPopulation'] = $this->BassinPopulation->find('list');
        $searchFormOptions['pays'] = $this->Pays->find('list');
        $searchFormOptions['disciplines'] = $this->Discipline->find('list');
        $searchFormOptions['communautesCommunes'] = $this->CommunauteCommune->find('list');
        //rendu des listes d'options
        //utiliser array_map...
        
        $searchFormOptions['activites'] = $this->Ficheactivite->formatList($searchFormOptions['activites'], true);
        $searchFormOptions['genres'] = $this->Ficheactivite->formatList($searchFormOptions['genres'], true);
         $searchFormOptions['disciplines'] = $this->Ficheactivite->formatList($searchFormOptions['disciplines'], true);
        $searchFormOptions['bassinsPopulation'] = $this->Ficheactivite->formatList($searchFormOptions['bassinsPopulation'], false);
        $searchFormOptions['implantations'] = $this->Ficheactivite->formatList($searchFormOptions['implantations'], true);
        $searchFormOptions['pays'] = $this->Ficheactivite->formatList($searchFormOptions['pays'], false);
        $searchFormOptions['communautesCommunes'] = $this->Ficheactivite->formatList($searchFormOptions['communautesCommunes'], false);
       
       return $searchFormOptions;  
    }

    public function viewPdfList() {
        $this->RequestHandler->renderAs($this, 'pdf');
       
        if ($this->Ficheactivite->isUnlimitedPdfList()) {
            $q = $this->request->params['named']['q'];
            $searchConditions = $this->Ficheactivite->_getConditions($q);
          
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
            $fichesactivites = $this->Ficheactivite->_getList($idList);
           
        }
         $this->set(compact('fichesactivites'));
    }

    public function view($id = null, $slug = null) {
        //$this->cacheAction = true;      
        if ($id) {
            //$ficheactivite=$this->Ficheactivite->find('first',array('conditions'=>array('Ficheactivite.id'=>$id)));
            $ficheactivite = $this->Ficheactivite->_findById($id);

            if (!empty($ficheactivite)) {
                $sluggedNomComplet = Inflector::slug($ficheactivite['Ficheactivite']['nom_complet']);
                if (strcmp($sluggedNomComplet, $slug) != 0) {
                    throw new NotFoundException('Pas de fiche activité correspondante');
                }

                $this->set(compact('ficheactivite'));
                $this->set('_serialize', array('ficheactivite'));
            } else {
                throw new NotFoundException('Pas de fiche activité correspondante');
            }
        }

        //debug($this->request);
    }
    
    public function embededView($id) {
       /*
        if (empty($this->request->params['requested'])) {
            throw new ForbiddenException();
        }*/
        $ficheactivite=$this->Ficheactivite->findById($id);
        $this->set(compact('ficheactivite'));
    }
    
    

    public function viewNav($id = null, $nom = null) {
        if ($this->request->is('ajax')) {
            //Configure::write('debug', 0);
            //	if(!empty($this->request->params['named']['q'])){

            $prevAndNext = $this->Ficheactivite->prevAndNext($id, $nom, $this->request->params['named']['q'], $this->request->params['named']['r']);
            $prev = $prevAndNext['prev'];
            $next = $prevAndNext['next'];

            $page = isset($this->request->params['named']['page']) ? $this->request->params['named']['page'] : 1;
            if (isset($this->request->params['named']['num'])) {
                $ficheactivite['Ficheactivite']['num'] = $this->request->params['named']['num'];
                $next['Ficheactivite']['num'] = $this->request->params['named']['num'] + 1;
                $prev['Ficheactivite']['num'] = $this->request->params['named']['num'] - 1;
                $page = floor($ficheactivite['Ficheactivite']['num'] / $this->Ficheactivite->getResultsPerPage()) + $page;
            }
            //	debug($next);
            $this->set(compact('nom', 'prev', 'next', 'page'));
            $this->render('Elements/prevNextDetailBrowser', 'ajax');
            //	}
        }
    }

    public function getCount() {
       // if ($this->request->is('ajax')) {
            //clean data
            $cleanData = Sanitize::clean($this->request['data']);

            if (!empty($cleanData['Search']['commune_id'])) {
                $cleanData['Search']['commune_id'] = str_replace("&quot;", "'", $cleanData['Search']['commune_id']);
            }
            //debug($cleanData,false);
            $searchConditions = $this->Ficheactivite->_getConditions($cleanData, false);
            debug($searchConditions);
            $count = $this->Ficheactivite->find('count', array(
                'conditions' => $searchConditions['conditions'],
                'fields' => 'COUNT(DISTINCT Ficheactivite.id) as count'
            ));

            $this->set(compact('count'));
            $this->set('_serialize', array('count'));
       /* } else {
            throw new BadRequestException('operation non autorisée');
        }*/
    }

}

?>