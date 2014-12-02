<?php

class OeuvreDiscipline extends OeuvresAppModel {

    public $name = 'OeuvreDiscipline';
    public $useTable='disciplines';
    public function getList() {
        $results = $this->find('list');

        return $results;
    }

    public function getListforForm($hierarchicalSpacer = '') {
        $listGenres = $this->find('list');
        foreach ($listGenres as $key => $value) {
            $level = ceil(strlen($key) / 2);
            $optionsGenres[] = array('value' => $key, 'name' => str_repeat($hierarchicalSpacer, $level) . $value, 'class' => " changeListener level_" . strval($level));
        }
        return $optionsGenres;
    }

}

?>