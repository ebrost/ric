<?php

class Ficheoeuvre extends OeuvresAppModel {

    public $name = 'Ficheoeuvre';
    public $displayField = 'nom_complet';
    public $findMethods = array(
        'all' => true, 'first' => true, 'count' => true,
        'neighbors' => true, 'list' => true, 'threaded' => true, 'byCriteria' => true);
    public $hasAndBelongsToMany = array(
        
       'Typepublic' => array(
          'className' => 'Oeuvres.Typepublic',
          'joinTable' => 'oeuvres_ficheoeuvres_typepublics',
          'foreignKey' => 'ficheoeuvre_id',
          'associationForeignKey' => 'typepublic_id'
          ), 
        
        'OeuvreActivite' => array(
          'className' => 'Oeuvres.OeuvreActivite',
          'joinTable' => 'oeuvres_ficheoeuvres_activites',
          'foreignKey' => 'ficheoeuvre_id',
          'associationForeignKey' => 'activite_id'
          ), 
        
        'OeuvreDiscipline' => array(
          'className' => 'Oeuvres.OeuvreDiscipline',
          'joinTable' => 'oeuvres_ficheoeuvres_disciplines',
          'foreignKey' => 'ficheoeuvre_id',
          'associationForeignKey' => 'discipline_id'
          ), 
        
        'OeuvreGenre' => array(
            'className' => 'Oeuvres.OeuvreGenre',
            'joinTable' => 'oeuvres_ficheoeuvres_genres',
            'foreignKey' => 'ficheoeuvre_id',
            'associationForeignKey' => 'genre_id'
        ),
        'Image' => array(
            'className' => 'Image',
            'joinTable' => 'medias_lies',
            'foreignKey' => 'foreign_key',
            'associationForeignKey' => 'media_id',
            'conditions' => array('Image.category' => 'Image', 'MediasLy.model' => 'Ficheoeuvre'),
            'order' => 'MediasLy.order ASC'
        ),
        'Document' => array(
            'className' => 'Document',
            'joinTable' => 'medias_lies',
            'foreignKey' => 'foreign_key',
            'associationForeignKey' => 'media_id',
            'conditions' => array('Document.category' => 'Document', 'MediasLy.model' => 'Ficheoeuvre'),
        ),
        'ExternalMedia' => array(
            'className' => 'ExternalMedia',
            'joinTable' => 'medias_lies',
            'foreignKey' => 'foreign_key',
            'associationForeignKey' => 'media_id',
            'conditions' => array('MediasLy.model' => 'Ficheoeuvre'),
        ),
           
    );
    
    public $hasMany=array(
        'OeuvresLien' => array(
            'className' => 'Oeuvres.OeuvresLien',
            'foreignKey' => 'ficheoeuvre_id',
            
            ),
    );
    public $belongsTo = array(
        'Prix' => array(
            'className' => 'Oeuvres.Prix',
            'foreignKey' => 'prix',
        ),
        'Duree' => array(
            'className' => 'Oeuvres.Duree',
            'foreignKey' => 'duree',
        ),
        'Jauge' => array(
            'className' => 'Oeuvres.Jauge',
            'foreignKey' => 'jauge',
        ),
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
            $fulltextSearchFields = $this->getFulltextSearchFields();
            debug($fulltextSearchFields);
            $searchConditions['additionalsFields'] = array();
            $searchConditions['orderBy'] = array();
            $keywords = explode(" ", trim($dataArray['Search']['keywords']));
            $pluralKeywords = $keywords;
            $pluralKeywords = array_map(create_function('$val', ' return $val.="s";'), $pluralKeywords);
            $keywords = implode(",", array_merge($keywords, $pluralKeywords));
            $this->virtualFields['relevance'] = "MATCH(" . $fulltextSearchFields . ") AGAINST('" . $keywords . "')";

            $searchConditions['additionalsFields'] = array("MATCH(" . $fulltextSearchFields . ") AGAINST('" . $keywords . "') as Ficheoeuvre__relevance",
                    )
            ;
            $searchConditions['conditions'][] = $searchConditions['keywordsConditions'] = "MATCH(" . $fulltextSearchFields . ") AGAINST ('" . $keywords . "')";
            $searchConditions['orderBy'] = array('Ficheoeuvre.relevance' => 'desc');
        }
        
          // recherche sur auteur
          if (!empty($dataArray['Search']['auteur'])) {
          $searchConditions['conditions']['Ficheoeuvre.auteur LIKE'] = '%' . $dataArray['Search']['auteur'] . '%';
          }
          
           // recherche sur editeur
           if (!empty($dataArray['Search']['editeur'])) {
          $searchConditions['conditions']['Ficheoeuvre.editeur LIKE'] = '%' . $dataArray['Search']['editeur'] . '%';
          }
          
           // recherche sur traducteur
          if (!empty($dataArray['Search']['traducteur'])) {
          $searchConditions['conditions']['Ficheoeuvre.traducteur LIKE'] = '%' . $dataArray['Search']['traducteur'] . '%';
          }
            // recherche sur illustrateur
          if (!empty($dataArray['Search']['illustrateur'])) {
          $searchConditions['conditions']['Ficheoeuvre.illustrateur LIKE'] = '%' . $dataArray['Search']['illustrateur'] . '%';
          }
          
             // recherche sur anneeedition
          if (!empty($dataArray['Search']['anneeedition'])) {
          $searchConditions['conditions']['Ficheoeuvre.anneeedition LIKE'] = '%' . $dataArray['Search']['annee'] . '%';
          }
          
            // recherche sur nomcollection
          if (!empty($dataArray['Search']['nomcollection'])) {
          $searchConditions['conditions']['Ficheoeuvre.nomcollection LIKE'] = '%' . $dataArray['Search']['nomcollection'] . '%';
          }
          
            // recherche sur isbn
          if (!empty($dataArray['Search']['isbn'])) {
          $searchConditions['conditions']['Ficheoeuvre.isbn LIKE'] = '%' . $dataArray['Search']['isbn'] . '%';
          }
          
           //type
        if(!empty($dataArray['Search']['typeoeuvre'])) {
            $searchConditions['conditions']['Ficheoeuvre.type_id'] = $dataArray['Search']['typeoeuvre'];
	}
         
        //recherche sur activite
        if (!empty($dataArray['Search']['activite'])) {
            $this->bindModel(array(
                'hasOne' => array(
                    'FicheoeuvresActivite' => array(
                        'className' => 'Oeuvres.FicheoeuvresActivites',
                        'foreign_key' => 'activite_id',
                    ),
                ),
                    ), false);
            $condition = "FicheoeuvresActivite.activite_id LIKE ";
            $connect = "";

            if (is_array($dataArray['Search']['activite'])) {
                foreach ($dataArray['Search']['activite'] as $key => $value) {
                    if (!empty($value)) {
                        $condition.=$connect . "'" . $value . '%' . "'";
                        $connect = " OR FicheoeuvresActivite.activite_id LIKE ";
                        //$this->data['Search']['activite'] = $dataArray['Search']['activite'];
                    }
                }
            } else {
                $condition.="'" . $dataArray['Search']['activite'] . '%' . "'";
            }
            $searchConditions['conditions'][] = "(" . $condition . ")";


            //contrainte sur activite
            $activityRoot = $this->getActivityRoot();
            if (!empty($activityRoot)) {
                $this->bindModel(array(
                    'hasOne' => array(
                        'FicheoeuvresActivite' => array(
                            'className' => 'Oeuvres.FicheoeuvresActivites',
                            'foreign_key' => 'activite_id',
                        ),
                    ),
                        ), false);

                $searchConditions['conditions'][] = "FicheoeuvresActivite.activite_id LIKE " . "'" . $activityRoot . '%' . "'";
            }
        }

        //recherche sur prix
        if (!empty($dataArray['Search']['prix'])) {
            $searchConditions['conditions']['Ficheoeuvre.prix'] = $dataArray['Search']['prix'];
        }
        
        

        //recherche sur prix
        if (!empty($dataArray['Search']['duree'])) {
            $searchConditions['conditions']['Ficheoeuvre.duree'] = $dataArray['Search']['duree'];
        }

        //recherche sur prix
        if (!empty($dataArray['Search']['jauge'])) {
            $searchConditions['conditions']['Ficheoeuvre.jauge'] = $dataArray['Search']['jauge'];
        }
        //recherche sur genre
        if (!empty($dataArray['Search']['genre'])) {
            $this->bindModel(array(
                'hasOne' => array(
                    'FicheoeuvresGenre' => array(
                        'className' => 'Oeuvres.FicheoeuvresGenres',
                        'foreign_key' => 'genre_id',
                    ),
                ),
                    ), false);

            $condition = "FicheoeuvresGenre.genre_id LIKE ";
            $connect = "";

            if (is_array($dataArray['Search']['genre'])) {
                foreach ($dataArray['Search']['genre'] as $key => $value) {
                    if (!empty($value)) {
                        $condition.=$connect . "'" . $value . '%' . "'";
                        $connect = " OR FicheoeuvresGenre.genre_id LIKE ";
                    }
                }
            } else {
                $condition.="'" . $dataArray['Search']['genre'] . '%' . "'";
            }
            $searchConditions['conditions'][] = "(" . $condition . ")";
        }
        //recherche sur discipline
        if (!empty($dataArray['Search']['discipline'])) {
            $this->bindModel(array(
                'hasOne' => array(
                    'FicheoeuvresDiscipline' => array(
                        'className' => 'Oeuvres.FicheoeuvresDisciplines',
                        'foreign_key' => 'discipline_id',
                    ),
                ),
                    ), false);

            $condition = "FicheoeuvresDiscipline.discipline_id LIKE ";
            $connect = "";

            if (is_array($dataArray['Search']['discipline'])) {
                foreach ($dataArray['Search']['discipline'] as $key => $value) {
                    if (!empty($value)) {
                        $condition.=$connect . "'" . $value . '%' . "'";
                        $connect = " OR FicheoeuvresDiscipline.discipline_id LIKE ";
                    }
                }
            } else {
                $condition.="'" . $dataArray['Search']['discipline'] . '%' . "'";
            }
            $searchConditions['conditions'][] = "(" . $condition . ")";
        }
        //typepublic
        if (!empty($dataArray['Search']['typepublic'])) {
            $this->bindModel(array(
                'hasOne' => array(
                    'FicheoeuvresTypepublic' => array(
                        'className' => 'Oeuvres.FicheoeuvresTypepublics',
                        'foreign_key' => 'typepublic_id',
                    ),
                ),
                    ), false);
            $searchConditions['conditions'][] = "FicheoeuvresTypepublic.typepublic_id IN (" . implode(',', $dataArray['Search']['typepublic']) . ")";
        }
        //recherche sur commune
        // debug($dataArray);

        if (!empty($dataArray['Search']['commune']) && !empty($dataArray['Search']['commune_id'])) {
            $this->bindModel(array(
                'hasOne' => array(
                    'FicheoeuvresCommune' => array(
                        'className' => 'Oeuvres.FicheoeuvreCommunes',
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

            $condition = "FicheoeuvresCommune.commune_id IN (" . implode(',', $communes_list) . ")";
            //	$condition.="'".$dataArray['Search']['commune'].'%'."'";

            $searchConditions['conditions'][] = "(" . $condition . ")";
        }



        //recherche sur implantation
        if (!empty($dataArray['Search']['implantation'])) {
            $this->bindModel(array(
                'hasOne' => array(
                    'FicheoeuvresCommune' => array(
                        'className' => 'Oeuvres.FicheoeuvresCommune',
                        'foreign_key' => 'commune_id',
                    ),
                ),
                    ), false);
            $condition = "FicheoeuvresCommune.commune_id LIKE ";
            $connect = "";
            if (is_array($dataArray['Search']['implantation'])) {
                foreach ($dataArray['Search']['implantation'] as $key => $value) {
                    if (!empty($value)) {
                        $condition.=$connect . "'" . $value . '%' . "'";
                        $connect = " OR FicheoeuvresCommune.commune_id LIKE ";
                    }
                }
            } else {
                $condition.="'" . $dataArray['Search']['implantation'] . '%' . "'";
            }
            $searchConditions['conditions'][] = "(" . $condition . ")";
        }


debug($searchConditions);


        return $searchConditions;
    }

    public function prevAndNext($id, $name, $q, $r = 0) {
        $searchConditions = $this->_getConditions($q);
        $searchConditions['conditions'] = (!empty($searchConditions['conditions'])) ? $searchConditions['conditions'] : array(null);
        //filtrage difficile : pas de double..
        //$r= (float)$r;
        //debug($r);
        debug($searchConditions);
        $prevAndNext = array();


        if (isset($r) && $r > 0) {
            
            $this->virtualFields['relevance'] = $searchConditions['additionalsFields'];

            $prevAndNext['prev'] = $this->find('first', array(
                'order' => array('Ficheoeuvre__relevance asc', 'Ficheoeuvre.nom_complet asc', 'Ficheoeuvre.id asc'),
                'fields' => array_merge(array('DISTINCT Ficheoeuvre.id', 'Ficheoeuvre.nom_complet'), $searchConditions['additionalsFields']),
                'conditions' => array_merge($searchConditions['conditions'], array($searchConditions['keywordsConditions'] . '>' . $r)),
                'recursive' => 0
                    )
            );
            $prevAndNext['next'] = $this->find('first', array(
                'order' => array('Ficheoeuvre__relevance desc', 'Ficheoeuvre.nom_complet asc', 'Ficheoeuvre.id asc'),
                'fields' => array_merge(array('DISTINCT Ficheoeuvre.id', 'Ficheoeuvre.nom_complet'), $searchConditions['additionalsFields']),
                'conditions' => array_merge($searchConditions['conditions'], array($searchConditions['keywordsConditions'] . '<' . $r)),
                'recursive' => 0
                    )
            );
        } else {
            $prevAndNext['prev'] = $this->find('first', array(
                'order' => array('Ficheoeuvre.nom_complet asc', 'Ficheoeuvre.id asc'),
                'fields' => 'DISTINCT Ficheoeuvre.id,Ficheoeuvre.nom_complet',
                'conditions' => array_merge($searchConditions['conditions'], array('Ficheoeuvre.nom_complet' => $name, 'Ficheoeuvre.id <' => $id)),
                'recursive' => 0
                    )
            );
            if (empty($prevAndNext['prev'])) {
                $prevAndNext['prev'] = $this->find('first', array(
                    'order' => array('Ficheoeuvre.nom_complet desc,Ficheoeuvre.id desc'),
                    'fields' => 'DISTINCT Ficheoeuvre.id,Ficheoeuvre.nom_complet',
                    'conditions' => array_merge($searchConditions['conditions'], array('Ficheoeuvre.nom_complet <' => $name)),
                    'recursive' => 0
                        )
                );
            }



            $prevAndNext['next'] = $this->find('first', array(
                'order' => array('Ficheoeuvre.nom_complet asc,Ficheoeuvre.id asc'),
                'fields' => 'DISTINCT Ficheoeuvre.id,Ficheoeuvre.nom_complet',
                'conditions' => array_merge($searchConditions['conditions'], array('Ficheoeuvre.nom_complet' => $name, 'Ficheoeuvre.id >' => $id)),
                'recursive' => 0
                    )
            );
            if (empty($prevAndNext['next'])) {
                $prevAndNext['next'] = $this->find('first', array(
                    'order' => array('Ficheoeuvre.nom_complet asc,Ficheoeuvre.id asc'),
                    'fields' => 'DISTINCT Ficheoeuvre.id,Ficheoeuvre.nom_complet',
                    'conditions' => array_merge($searchConditions['conditions'], array('Ficheoeuvre.nom_complet >' => $name)),
                    'recursive' => 0
                        )
                );
            }
        }
        debug($prevAndNext);
        //debug(array_merge($this->_getConditions($q),array('Ficheoeuvre.nom_complet >'=> $name)));
        return $prevAndNext;
        
    }

    public function _getList($idList = null) {
        if (isset($idList)) {
            
            $results = $this->find('all', array(
                'conditions' => array('Ficheoeuvre.id' => $idList),
                'contain' => array('Activite','OeuvreGenre','OeuvreDiscipline','Typepublic'),
                'order' => array('FIND_IN_SET(Ficheoeuvre.id,\'' . implode(',', $idList) . '\')')));
            return $results;
        }
    }

    protected function _findByCriteria($state, $query, $results = array()) {
        
        if ($state == 'before') {
            if (!empty($query['operation']) && $query['operation'] == 'count') {
                $query['fields'] = array('COUNT(DISTINCT Ficheoeuvre.id) as count');
            }
            $activityRoot = $this->getActivityRoot();
            if (!empty($activityRoot)) {

                $this->bindModel(array(
                    'hasOne' => array(
                        'FicheoeuvresActivite' => array(
                            'className' => 'Oeuvre.FicheoeuvresActivites',
                            'foreign_key' => 'activite_id',
                        ),
                    ),
                        ), false);

                $query['conditions'][] = " (FicheoeuvresActivite.activite_id LIKE '" . $activityRoot . "%')";
            }
            //debug($query);
            return $query;
        }
        return $results;
    }

    public function _findById($id) {
        $result = Cache::read('ficheoeuvre_' . $id, 'oeuvres');
        if (!$result) {
            $contain=array('FicheoeuvresActivite','Activite','OeuvreLien','FicheoeuvresGenre','OeuvreGenre','FicheoeuvresDiscipline','OeuvreDiscipline','FicheoeuvresTypepublic','Typepublic', 'Image','Document','ExternalMedia','Prix','Jauge','Duree');
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
                'contain' => $contain,
                'conditions' => array('Ficheoeuvre.id' => $id)
            ));
            Cache::write('ficheoeuvre_' . $id, $result, 'oeuvres');
        }


        return $result;
    }

    public function afterFind($results, $primary = false) {

        if (!empty($results)) {
            foreach ($results as $keyResult => $valueResult) {
                $results[$keyResult][$this->alias]['num'] = $keyResult;
            }
        }


        return $results;
    }

}

?>