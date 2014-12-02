<?php

class Evenement extends AgendaAppModel {

    public $name = 'Evenement';
    public $displayField = 'nom_complet';
    public $findMethods = array(
        'all' => true, 'first' => true, 'count' => true,
        'neighbors' => true, 'list' => true, 'threaded' => true, 'byCriteria' => true);
 
    public $belongsTo = array(
        'Type' => array(
            'className' => 'Agenda.Type',
            'foreignKey' => 'type_id',
        ),
        'Parent' => array(
            'className' => 'Agenda.Evenement',
            'foreignKey' => 'parent_id'
        ),
        
    );
    public $hasAndBelongsToMany = array(
       
        'Tag' => array(
            'className' => 'Agenda.Tag',
            'joinTable' => 'agenda_evenements_tags'
        ),
        'Typepublic' => array(
            'className' => 'Agenda.Typepublic',
            'joinTable' => 'agenda_evenements_typepublics',
            'foreignKey' => 'evenement_id',
            'associationForeignKey' => 'typepublic_id'
        ),
        'AgendaGenre' => array(
            'className' => 'Agenda.AgendaGenre',
            'joinTable' => 'agenda_evenements_genres',
            'foreignKey' => 'evenement_id',
            'associationForeignKey' => 'genre_id'
        ),
        'Image' => array(
            'className' => 'Image',
            'joinTable' => 'medias_lies',
            'foreignKey' => 'foreign_key',
            'associationForeignKey' => 'media_id',
            'conditions' => array('Image.category' => 'Image','MediasLy.model'=>'Evenement'),
            'order' => 'MediasLy.order ASC'
        ),
        'Document' => array(
            'className' => 'Document',
            'joinTable' => 'medias_lies',
            'foreignKey' => 'foreign_key',
            'associationForeignKey' => 'media_id',
            'conditions' => array('Document.category' => 'Document','MediasLy.model'=>'Evenement'),
        ),
        'ExternalMedia' => array(
            'className' => 'ExternalMedia',
            'joinTable' => 'medias_lies',
            'foreignKey' => 'foreign_key',
            'associationForeignKey' => 'media_id',
          'conditions' => array('MediasLy.model' => 'Evenement'),
        )
    );
    public $hasMany = array(
        
        'AgendaLien' => array(
            'className' => 'Agenda.AgendaLien',
            'foreignKey' => 'evenement_id',
            
            ),
         
         
        'Session' => array('className' => 'Agenda.Session'),
        'Children' => array(
            'className' => 'Evenement',
            'foreignKey' => 'parent_id',
           // 'conditions' => array( "Children.deleted" => "0" ),
        )
    );
    
    public function __construct($id = false, $table = null, $ds = null) {
        
        if (Cakeplugin::loaded('Annuaire')) {
            $this->belongsTo['Ficheactivite'] = array('className' => 'Annuaire.Ficheactivite', 'foreignKey' => 'ficheactivite_id');
           
        }
        parent::__construct($id, $table, $ds);
    }
    
    public function _getConditions($data, $encoded = true) {
        //debug($data);
        if (!empty($data)) {
            $dataArray = $data;
            if ($encoded) {
                $dataArray = unserialize(base64_decode($data));
            }
        } else {
            //return null;
        }
        //debug($dataArray);
        //new array
        $searchConditions = array();
        //recherche sur mots cl�s


        if (!empty($dataArray['Search']['keywords'])) {
            $searchConditions['additionalsFields'] = array();
           
            $keywords = explode(" ", trim($dataArray['Search']['keywords']));
            $pluralKeywords = $keywords;
            $pluralKeywords = array_map(create_function('$val', ' return $val.="s";'), $pluralKeywords);
            $keywords = implode(",", array_merge($keywords, $pluralKeywords));
            //$this->virtualFields['relnomcomplet']="MATCH(Evenement.nom_complet) AGAINST('".$dataArray['Search']['keywords']."')";
            //$this->virtualFields['relcommentaires']="MATCH(Evenement.commentaires,Evenement.commentaires_arts_visuels,Evenement.commentaires_audio_visuel,Evenement.commentaires_livre,Evenement.commentaires_patrimoine,Evenement.commentaires_spectacle) AGAINST('".$dataArray['Search']['keywords']."')";
            $this->virtualFields['relevance'] = "MATCH(Evenement.nom_complet,Evenement.commentaires,Evenement.commentaires_arts_visuels,Evenement.commentaires_audio_visuel,Evenement.commentaires_livre,Evenement.commentaires_patrimoine,Evenement.commentaires_spectacle) AGAINST('" . $keywords . "')";

            $searchConditions['additionalsFields'] = array("MATCH(Evenement.nom_complet,Evenement.commentaires,Evenement.commentaires_arts_visuels,Evenement.commentaires_audio_visuel,Evenement.commentaires_livre,Evenement.commentaires_patrimoine,Evenement.commentaires_spectacle) AGAINST('" . $keywords . "') as Evenement__relevance",
                    )
            ;
            $searchConditions['conditions'][] = $searchConditions['keywordsConditions'] = "MATCH(Evenement.nom_complet,Evenement.commentaires,Evenement.commentaires_arts_visuels,Evenement.commentaires_audio_visuel,Evenement.commentaires_livre,Evenement.commentaires_patrimoine,Evenement.commentaires_spectacle) AGAINST ('" . $keywords . "')";
            $searchConditions['order'] = array('Evenement.relevance' => 'desc');
        }

        // recherche sur nom
        if (!empty($dataArray['Search']['name'])) {
            $searchConditions['conditions']['Evenement.nom_complet LIKE'] = '%' . $dataArray['Search']['name'] . '%';
        }

        //prioritaire
        if ( !empty($dataArray['Search']['prioritaire']) && $dataArray['Search']['prioritaire']===true) {
            $searchConditions['conditions']['Evenement.prioritaire'] = 1;
        }

        //recherche sur genre
        if (!empty($dataArray['Search']['genre'])) {
            $this->bindModel(array(
                'hasOne' => array(
                    'EvenementsGenre' => array(
                        'className' => 'Agenda.EvenementsGenres',
                        'foreign_key' => 'genre_id',
                    ),
                ),
                    ), false);

            $condition = "EvenementsGenre.genre_id LIKE ";
            $connect = "";

            if (is_array($dataArray['Search']['genre'])) {
                foreach ($dataArray['Search']['genre'] as $key => $value) {
                    if (!empty($value)) {
                        $condition.=$connect . "'" . $value . '%' . "'";
                        $connect = " OR EvenementsGenre.genre_id LIKE ";
                    }
                }
            } else {
                $condition.="'" . $dataArray['Search']['genre'] . '%' . "'";
            }
            $searchConditions['conditions'][] = "(" . $condition . ")";
        }
        
        
        //typepublic
        if (!empty($dataArray['Search']['typepublic'])) {
            $this->bindModel(array(
                'hasOne' => array(
                    'EvenementsTypepublic' => array(
                        'className' => 'Agenda.EvenementsTypepublics',
                        'foreign_key' => 'typepublic_id',
                    ),
                ),
                    ), false);

           

           
               
                       $searchConditions['conditions'][]="EvenementsTypepublic.typepublic_id IN (" . implode(',', $dataArray['Search']['typepublic']) . ")";
                      
                    
                
            
           // $searchConditions['conditions'][] = "(" . $condition . ")";
        }
       //tag 
         if (!empty($dataArray['Search']['tag'])) {
            $this->bindModel(array(
                'hasOne' => array(
                    'EvenementsTag' => array(
                        'className' => 'Agenda.EvenementsTags',
                        'foreign_key' => 'tag_id',
                    ),
                ),
                    ), false);

           

           
              
                        $searchConditions['conditions'][]="EvenementsTag.tag_id IN (" . implode(',', $dataArray['Search']['tag']) . ")";
                      
                    
             
            
         //   $searchConditions['conditions'][] = "(" . $condition . ")";
        }


        if (!empty($dataArray['Search']['commune']) && !empty($dataArray['Search']['commune_id'])) {
            $this->bindModel(array(
                'hasOne' => array(
                    'EvenementsCommune' => array(
                        'className' => 'Agenda.EvenementsCommunes',
                        'foreign_key' => 'commune_id',
                    ),
                ),
                    ), false);
            $communes_list = $dataArray['Search']['commune_id'];
            $communes_list = explode(',', $communes_list);
            if ((int) $dataArray['Search']['radius']) {
                $addtionalCommunes = $this->query('CALL communes_near2("' . $dataArray['Search']['commune'] . '",' . $dataArray['Search']['radius'] . ')');

                if (!empty($addtionalCommunes[0][0]['communes_list'])) {
                    $addtionalCommunes = '"' . str_replace(',', '","', $addtionalCommunes[0][0]['communes_list']) . '"';

                    $addtionalCommunes = explode(',', $addtionalCommunes);
                    debug(count($addtionalCommunes));
                    //$communes_list=rtrim($addtionalCommunes[0][0]['communes_list'],'"').$communes_list;
                    $communes_list = array_merge($communes_list, $addtionalCommunes);
                }


                debug(count($communes_list));
            }

            $condition = "EvenementsCommune.commune_id IN (" . implode(',', $communes_list) . ")";
            //	$condition.="'".$dataArray['Search']['commune'].'%'."'";

            $searchConditions['conditions'][] = "(" . $condition . ")";

        }



        //recherche sur implantation
        if (!empty($dataArray['Search']['implantation'])) {
            $this->bindModel(array(
                'hasOne' => array(
                    'EvenementsCommune' => array(
                        'className' => 'Agenda.EvenementsCommune',
                        'foreign_key' => 'commune_id',
                    ),
                ),
                    ), false);
            $condition = "EvenementsCommune.commune_id LIKE ";
            $connect = "";
            if (is_array($dataArray['Search']['implantation'])) {
                foreach ($dataArray['Search']['implantation'] as $key => $value) {
                    if (!empty($value)) {
                        $condition.=$connect . "'" . $value . '%' . "'";
                        $connect = " OR EvenementsCommune.commune_id LIKE ";
                    }
                }
            } else {
                $condition.="'" . $dataArray['Search']['implantation'] . '%' . "'";
            }
            $searchConditions['conditions'][] = "(" . $condition . ")";
        }


        //recherche sur date
        
        $this->bindModel(array(
                'hasOne' => array(
                    'Session' => array(
                        'className' => 'Agenda.Session',
                        'foreign_key' => 'evenement_id',
                    ),
                ),
                    ), false);
        $searchConditions['conditions'][]['Session.date_fin >=']=date('Y-m-d');
        if (!empty($dataArray['Search']['startDate']) ||!empty($dataArray['Search']['startDate'])) {
            if (!empty($dataArray['Search']['startDate'])) {
            $searchConditions['conditions'][]['Session.date_fin >='] = DateTime::createFromFormat('d-m-Y', $dataArray['Search']['startDate'])->format('Y-m-d');
            }
            // $searchConditions['conditions'][]['Session.date_fin >='] =date_format() DateTime::createFromFormat('d-m-Y', $dataArray['Search']['startDate'])->format('Y-m-d');
            if (!empty($dataArray['Search']['endDate'])) {
                $searchConditions['conditions'][]['Session.date_debut <='] = DateTime::createFromFormat('d-m-Y', $dataArray['Search']['endDate'])->format('Y-m-d');

            }
        
        }
        //type
        if(!empty($dataArray['Search']['type'])) {
		$searchConditions['Evenement.type_id ='] = $dataArray['Search']['type'];
	}
        return $searchConditions;
    }

    public function _findById($id) {
        $result = Cache::read('evenement_' . $id, 'agenda');
       
        if (!$result) {
            $contain=array('Session','Image','Type','AgendaLien','Typepublic','Tag','Document','ExternalMedia','Evenement.id','Children','Children.Image','Children.Type','Children.Session');
            
            if (CakePlugin::loaded('Annuaire')){
                $contain=array_merge($contain, array(
                    'Ficheactivite.id',
                    'Ficheactivite.nom_complet',
                    'Ficheactivite.adresse',
                    'Ficheactivite.code_postal',
                    'Ficheactivite.ville',
                    'Ficheactivite.cedex_pays',
                    'Ficheactivite.telephone',
                    'Ficheactivite.telephone_2',
                    'Ficheactivite.telecopie',
                    'Ficheactivite.telecopie_2',
                    'Ficheactivite.email',
                    'Ficheactivite.url_site_web',
                   )); 

            } 
          debug($contain);
            $result = $this->find('first', array(
                'contain'=>$contain,
               'conditions' => array('Evenement.id' => $id)
                ));
            Cache::write('evenement_' . $id, $result, 'agenda');
        }

        return $result;
    }

    public function _getList($idList = null) {
        if (isset($idList)) {
            $this->unbindModel(
                    array(
                        'hasAndBelongsToMany' => array( 'AgendaGenre'),
                        'hasMany' => array('Media'),
                    )
            );
            $results = $this->find('all', array('conditions' => array('Evenement.id' => $idList), 'order' => array('FIND_IN_SET(Evenement.id,\'' . implode(',', $idList) . '\')')));
            return $results;
        }
    }

    public function prevAndNext($id,$premiereDateSession, $q=null, $r = 0) {
        $searchConditions = $this->_getConditions($q);

        $searchConditions['conditions'] = (!empty($searchConditions['conditions'])) ? $searchConditions['conditions'] : array();
         $searchConditions['order'] = (!empty($searchConditions['order'])) ? $searchConditions['order'] : array();
        //filtrage difficile : pas de double..
        //$r= (float)$r;
        //debug($r);
        $prevAndNext = array();
         
        if (isset($r) && $r > 0) {
            $this->virtualFields['relevance'] = $searchConditions['additionalsFields'];

            $prevAndNext['prev'] = $this->find('first', array(
                'order' => array_merge(array('Evenement.premieredatesession'=>'asc','Evenement.id' => 'desc'),$searchConditions['order']),
                'fields' => array_merge(array('DISTINCT Evenement.id', 'Evenement.nom_complet'), $searchConditions['additionalsFields']),
                'conditions' => array_merge($searchConditions['conditions'], array($searchConditions['keywordsConditions'] . '>' . $r)),
                 'contain'=>array('Session','EvenementsCommune','EvenementsTypepublic','Typepublic','Type','EvenementsTag','Tag','EvenementsGenre','AgendaGenre'),
                'group' => 'Evenement.id',
                    )
            );
            $prevAndNext['next'] = $this->find('first', array(
                'order' => array_merge(array('Evenement.premieredatesession'=>'asc','Evenement.id' => 'asc'),$searchConditions['order']),
                'fields' => array_merge(array('DISTINCT Evenement.id', 'Evenement.nom_complet'), $searchConditions['additionalsFields']),
                'conditions' => array_merge($searchConditions['conditions'], array($searchConditions['keywordsConditions'] . '<' . $r)),
                'contain'=>array('Session','EvenementsCommune','EvenementsTypepublic','Typepublic','Type','EvenementsTag','Tag','EvenementsGenre','AgendaGenre'),
                'group' => 'Evenement.id',
                    )
            );
            /*
              $this->virtualFields['relevance']="MATCH(Evenement.nom_complet,Evenement.commentaires,Evenement.commentaires_arts_visuels,Evenement.commentaires_audio_visuel,Evenement.commentaires_livre,Evenement.commentaires_patrimoine,Evenement.commentaires_spectacle) AGAINST('".$dataArray['Search']['keywords']."')";

              $searchConditions['additionalsFields']=array("MATCH(Evenement.nom_complet,Evenement.commentaires,Evenement.commentaires_arts_visuels,Evenement.commentaires_audio_visuel,Evenement.commentaires_livre,Evenement.commentaires_patrimoine,Evenement.commentaires_spectacle) AGAINST('".$dataArray['Search']['keywords']."') as Evenement__relevance",
              )
              ;
              $searchConditions['conditions'][] = "MATCH(Evenement.nom_complet,Evenement.commentaires,Evenement.commentaires_arts_visuels,Evenement.commentaires_audio_visuel,Evenement.commentaires_livre,Evenement.commentaires_patrimoine,Evenement.commentaires_spectacle) AGAINST ('".$dataArray['Search']['keywords']."')";
              $searchConditions['orderBy']=array('Evenement.relevance'=>'desc');
             */
        } else {
            
            $prevAndNext['prev'] = $this->find('first', array(
                'order' =>array_merge(array('Evenement.premieredatesession'=>'desc','Evenement.id' => 'desc'),$searchConditions['order']),
                'fields' => 'DISTINCT Evenement.id,Evenement.nom_complet,Evenement.premieredatesession',
                'conditions' => array_merge($searchConditions['conditions'], array('Evenement.premieredatesession ' => $premiereDateSession, 'Evenement.id <' => $id)),
            //    'contain'=>array('Session','EvenementsCommune','EvenementsTypepublic','Typepublic','Type','EvenementsTag','Tag','EvenementsGenre','AgendaGenre'),
                'recursive' => 0
                    )
            );
            if (empty($prevAndNext['prev'])) {
                $prevAndNext['prev'] = $this->find('first', array(
                    'order' => array_merge(array('Evenement.premieredatesession'=>'desc','Evenement.id' => 'desc'),$searchConditions['order']),
                    'fields' => 'DISTINCT Evenement.id,Evenement.nom_complet,Evenement.premieredatesession',
            //       'contain'=>array('Session','EvenementsCommune','EvenementsTypepublic','Typepublic','Type','EvenementsTag','Tag','EvenementsGenre','AgendaGenre'),
                    'conditions' => array_merge($searchConditions['conditions'], array('Evenement.premieredatesession <' => $premiereDateSession)),
                    
                        )
                );
            }



            $prevAndNext['next'] = $this->find('first', array(
                'order' =>  array_merge($searchConditions['order'],array('Evenement.premieredatesession'=>'asc','Evenement.id' => 'asc')),
                'fields' => 'DISTINCT Evenement.id,Evenement.nom_complet',
                'conditions' => array_merge($searchConditions['conditions'],  array('Evenement.premieredatesession' => $premiereDateSession, 'Evenement.id >' => $id)),
               'contain'=>array('Session','EvenementsCommune','EvenementsTypepublic','Typepublic','Type','EvenementsTag','Tag','EvenementsGenre','AgendaGenre'),
                'recursive' => 0
                    )
            );
            if (empty($prevAndNext['next'])) {
                $prevAndNext['next'] = $this->find('first', array(
                    'order' =>  array_merge($searchConditions['order'],array('Evenement.premieredatesession'=>'asc','Evenement.id' => 'asc')),
                    'fields' => 'DISTINCT Evenement.id,Evenement.nom_complet',
                    'conditions' => array_merge($searchConditions['conditions'],array('Evenement.premieredatesession >' => $premiereDateSession)),
                   'contain'=>array('Session','EvenementsCommune','EvenementsTypepublic','Typepublic','Type','EvenementsTag','Tag','EvenementsGenre','AgendaGenre'),
                    'recursive' => 0
                        )
                );
            }
        }
        //debug(array_merge($this->_getConditions($q),array('Evenement.nom_complet >'=> $name)));
        
        return $prevAndNext;
    }

    public function afterFind($results, $primary = false) {
        
        if ($this->findQueryType == 'all'){
             if (!empty($results)) {
            foreach ($results as $keyResult => $valueResult) {
                $results[$keyResult][$this->alias]['num'] = $keyResult;

            }
        }
        }
        
        if ($this->findQueryType == 'all' || $this->findQueryType == 'first') {
            // debug($results);
              
            foreach ($results as $keyResult => $valueResult) { {
                    if (!empty($valueResult['Session'])){
                        foreach ($valueResult['Session'] as $keySession => $valueSession) {
                            if (is_array($valueSession)){
                            $resume_session = '';


                            if ($valueSession['date_debut'] == $valueSession['date_fin'] || $valueSession['date_fin'] == '0000-00-00') {
                                $resume_session.=utf8_encode(strftime('%A %d %B %Y', strtotime($valueSession['date_debut'])));
                            } else {
                                $resume_session.='du ' . utf8_encode(strftime('%A %d %B %Y', strtotime($valueSession['date_debut']))) . ' au ' . utf8_encode(strftime('%A %d %B %Y', strtotime($valueSession['date_fin'])));
                                ;
                            }
                            if (!empty($valueSession['heure'])) {
                                $resume_session.=' - ' . $valueSession['heure'];
                            }



                            $results[$keyResult]['Session'][$keySession]['resume_session'] = $resume_session;

                            // debug($valueSession);    
                            }
                            else{unset($results[$keyResult]['Session'][$keySession]);}
                        }
                    }
                    if (!empty($valueResult['Children']) ){
                        
                        foreach ($valueResult['Children'] as $keyChild => $valueChild) {
                             foreach ($valueChild['Session'] as $keyChildSession => $valueChildSession) {
                           
                            $resumeChildren_session = '';


                            if ($valueChildSession['date_debut'] == $valueChildSession['date_fin'] || $valueChildSession['date_fin'] == '0000-00-00') {
                                $resumeChildren_session.=utf8_encode(strftime('%A %d %B %Y', strtotime($valueChildSession['date_debut'])));
                            } else {
                                $resumeChildren_session.='du ' . utf8_encode(strftime('%A %d %B %Y', strtotime($valueChildSession['date_debut']))) . ' au ' . utf8_encode(strftime('%A %d %B %Y', strtotime($valueChildSession['date_fin'])));
                                ;
                            }
                            if (!empty($valueChildSession['heure'])) {
                                $resumeChildren_session.=' - ' . $valueChildSession['heure'];
                            }



                            $results[$keyResult]['Children'][$keyChild]['Session'][$keyChildSession]['resume_session'] = $resumeChildren_session;
 
                                 
                            
                            }
                            
                        }
                            
                            
                         
                        
                    }
                    
                        
                }
            }
        }

        return $results;
    }

}
