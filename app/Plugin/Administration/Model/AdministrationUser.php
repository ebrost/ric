<?php

App::uses('User', 'Users.Model');
//App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class AdministrationUser extends User {

    public $name = 'administrationUser';
    public $displayField = 'username';
    public $useTable = 'users';
   //   public $recursive =1;
    public $actsAs = array(
        'Containable',
     
        );
    public $hasMany = array(
       
        'Image' => array(
            'className' => 'Image',
            'foreignKey' => 'foreign_key',
            
        ),
        'Document' => array(
            'className' => 'Document',
            'foreignKey' => 'foreign_key',
            
        ),
        'ExternalMedia' => array(
            'className' => 'ExternalMedia',
            'foreignKey' => 'foreign_key',
            
        ),
    );
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'message' => 'Veuillez renseigner votre identifiant.'),
            'alpha' => array(
                'rule' => array('alphaNumeric'),
                'message' => 'Votre identifiant doit être alphanumérique.'),
            'unique_username' => array(
                'rule' => array('isUnique', 'username'),
                'message' => 'Cet identifiant est déjà utilisé.'),
            'username_min' => array(
                'rule' => array('minLength', '3'),
                'message' => 'Votre identifiant doît avoir au moins 3 caractères.')),
        'email' => array(
            'isValid' => array(
                'rule' => 'email',
                'message' => 'Votre email n\'est pas valide.'),
            'isUnique' => array(
                'rule' => array('isUnique', 'email'),
                'message' => 'Cet Email est déjà utilisé.')),
        'password' => array(
            'too_short' => array(
                'rule' => array('minLength', '6'),
                'message' => 'Votre mot de passe doit faire au moins 6 caractères.'),
            'required' => array(
                'rule' => 'notEmpty',
                'message' => 'Veuillez renseigner votre mot de passe.')),
        'confirm_password' => array(
            'rule' => array('confirmPasswords'),
            'message' => 'Vos mots de passe ne correspondent pas.'),
        'tos' => array(
            'rule' => array('comparison', '!=', 0),
            'message' => 'Vous devez acceptez les conditions d\'utilisation.'));
/*
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new SimplePasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                    $this->data[$this->alias]['password']
            );
        }
        return true;
    }
*/
    
    
    public function __construct($id = false, $table = null, $ds = null) {
        
        if (Cakeplugin::loaded('Agenda')) {

            $this->hasMany['Evenement'] = array('className' => 'Agenda.Evenement', 'foreignKey' => 'user_id');
            $this->hasMany['BufferedEvenement'] = array('className' => 'Administration.BufferedEvenement', 'foreignKey' => 'user_id');
       
        }

        if (Cakeplugin::loaded('Annuaire')) {
            $this->hasMany['Ficheactivite'] = array('className' => 'Annuaire.Ficheactivite', 'foreignKey' => 'user_id');
            $this->hasMany['BufferedFicheactivite'] = array('className' => 'Administration.BufferedFicheactivite', 'foreignKey' => 'user_id');
        }
        parent::__construct($id, $table, $ds);
    }

    public function getUser($id) {
          
        $containableItems=[];
        if (Cakeplugin::loaded('Agenda')) {
            $containableItems=array_merge($containableItems,array('Evenement.id', 'Evenement.nom_complet','Evenement.master','Evenement.parent_id' ,'BufferedEvenement.id','BufferedEvenement.deleted', 'BufferedEvenement.nom_complet','BufferedEvenement.evenement_id','BufferedEvenement.master','BufferedEvenement.buffered_parent_id'));
        }

        if (Cakeplugin::loaded('Annuaire')) {
            $containableItems=array_merge($containableItems,array('Ficheactivite.id', 'Ficheactivite.nom_complet', 'BufferedFicheactivite.id','BufferedFicheactivite.deleted', 'BufferedFicheactivite.nom_complet','BufferedFicheactivite.ficheactivite_id'));
            
        }
        $this->contain($containableItems);
        $user = $this->findById($id);
         if (Cakeplugin::loaded('Annuaire')) {
            $this->_mergeUserFicheactivite($user);
            unset($user['BufferedFicheactivite']);
            unset($user['Ficheactivite']);
        }
        if (Cakeplugin::loaded('Agenda')) {
            $this->_mergeUserEvenement($user);
            unset($user['BufferedEvenement']);
            unset($user['Evenement']);
        }

        unset($user['AdministrationUser']['password']);
          
       
        //debug($user);
        return $user;
    }
    protected function _mergeUserFicheactivite(&$user){
       
       if (!empty($user['BufferedFicheactivite']) || !empty($user['Ficheactivite'])){
       $notDeletedBufferedFicheactivite = array_filter($user['BufferedFicheactivite'],function ($a){if ( $a['deleted']==0){return 1;}}); 
       array_walk($notDeletedBufferedFicheactivite, function (&$v) { $v['controller']='BufferedFicheactivites'; });
      
       $indexBufferedFicheactivite= Hash::extract($user['BufferedFicheactivite'], '{n}.ficheactivite_id');
     
       $notBufferedFichesActivites= array_filter($user['Ficheactivite'],function ($a) use($indexBufferedFicheactivite) {if (!in_array($a['id'],$indexBufferedFicheactivite)){return 1;}});
      array_walk($notBufferedFichesActivites, function (&$v) { $v['controller']='Ficheactivites'; });
       $user['AvailablesFicheactivite'] = array_merge($notDeletedBufferedFicheactivite,$notBufferedFichesActivites); 
       }
     
    }
    
     protected function _mergeUserEvenement(&$user){
      //debug($user);
       if (!empty($user['BufferedEvenement']) || !empty($user['Evenement'])){
       $notDeletedBufferedEvenement = array_filter($user['BufferedEvenement'],function ($a){if ( $a['deleted']==0){return 1;}}); 
       array_walk($notDeletedBufferedEvenement, function (&$v) { $v['controller']='BufferedEvenements'; });
      
       $indexBufferedEvenement= Hash::extract($user['BufferedEvenement'], '{n}.evenement_id');
     
       $notBufferedEvenements= array_filter($user['Evenement'],function ($a) use($indexBufferedEvenement) {if (!in_array($a['id'],$indexBufferedEvenement)){return 1;}});
      array_walk($notBufferedEvenements, function (&$v) { $v['controller']='Evenements'; });
       $user['AvailablesEvenement'] = array_merge($notDeletedBufferedEvenement,$notBufferedEvenements); 
       }
      
    }
   
    public function formatMediaData($model,$data){
       $medias = array();
        if (!empty($data[$model][0])) {
            foreach ($data[$model] as $i => $media) {
                if (is_array($data[$model][$i])) {
                    // Force setting the `model` field to this model
                    $media['model'] = 'User';

                    // Unset the foreign_key if the user tries to specify it
                    if (isset($media['foreign_key'])) {
                        unset($media['foreign_key']);
                    }

                    $medias[] = $media;
                }
            }
        }
        $data[$model] = $medias;
        return $data;
    }
    public function addMedia($model,$data,$isFormattedData=false) {
        if(!$isFormattedData){
            $data=$this->formatMediaData($model,$data);
                    
        }
       
        $this->create();
        if ($this->saveAll($data)) {
            $media=$this->{$model}->find('first',array(
                                        'conditions'=>array(
                                            $model.'.model'=>'User',
                                            $model.'.id'=>$this->{$model}->getLastInsertId(),
                                            $model.'.foreign_key'=>$data['id']
                                            )
                                        )
                                    );
            return $media;
            
        }
        
        
        // Throw an exception for the controller
      
        throw new CakeException('impossible de sauvegarder les medias');
    }
    
    public function addMedias($model='Image',$data,$isFormattedData=false) {
        // Sanitize your images before adding them
        if(!$isFormattedData){
            $data=$this->formatMediaData($model,$data);
                    
        }
       
        // Try to save the data using Model::saveAll()
        $this->create();
        if ($media=$this->saveAll($data)) {
            return $media;
        }
        
        
        // Throw an exception for the controller
      
        throw new CakeException('impossible de sauvegarder les medias');
    }
    
    public function checkValidMedias($file){
        
         $this->create();
        if (! $this->saveAll($data)) {
         //   debug($this->validationErrors);
            return $this->validationErrors;
        }
    }

}

?>