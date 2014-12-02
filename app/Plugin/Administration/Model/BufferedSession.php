<?php

class BufferedSession extends AdministrationAppModel {

    public $name = 'Session';
    public $useTable = 'buffered_sessions';
    public $actsAs = array('Containable');
    public $belongsTo = array(
        'BufferedEvenement' => array(
            'className' => 'Administration.BufferedEvenement',
            'foreignKey' => 'Session.evenement_id',
        ),
    );

    public function isOwnedBy($modelId, $userId) {

        $bufferedEvenementId = $this->getBufferedEvenementId($modelId);
        return $this->BufferedEvenement->field('id', array('id' => $bufferedEvenementId, 'user_id' => $userId)) === $bufferedEvenementId;
        // return $this->field('id',array('id'=>$modelId,'user_id'=>$userId))===$modelId;
    }

    public function getBufferedEvenementId($id) {
        $bufferedSession = $this->find('first', array('conditions' => $id));
        $bufferedEvenementId = $this->BufferedEvenement->field('id', array('id' => $bufferedSession['buffered_evenement_id']));
        return $bufferedEvenementId;
    }

    public function beforeSave($options = array()) {
        if (!empty($this->data['Session']['date_debut'])) {

            $this->data['Session']['date_debut'] = $this->dateFormatBeforeSave(
                    $this->data['Session']['date_debut']
            );
        }
        if (!empty($this->data['Session']['date_fin'])) {

            $this->data['Session']['date_fin'] = $this->dateFormatBeforeSave(
                    $this->data['Session']['date_fin']
            );
        }
        return true;
    }

    public function afterFind($results, $primary = false) {
        foreach ($results as $key => $val) {

            if (isset($val['Session']['date_debut'])) {
                $results[$key]['Session']['date_debut'] = $this->dateFormatAfterFind(
                        $val['Session']['date_debut']
                );
            }
            if (isset($val['Session']['date_fin'])) {
                $results[$key]['Session']['date_fin'] = $this->dateFormatAfterFind(
                        $val['Session']['date_fin']
                );
            }
        }

        return $results;
    }

    public function dateFormatAfterFind($dateString) {
        return date('d-m-Y', strtotime($dateString));
    }

    public function dateFormatBeforeSave($dateString) {
        //return  dateTime::createFromFormat('d-m-Y', $dateString)->format('Y-m-d');

        return date('Y-m-d', strtotime($dateString));
    }

}
