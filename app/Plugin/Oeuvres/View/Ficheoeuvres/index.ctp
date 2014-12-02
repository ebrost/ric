<?php
$this->extend('/Common/viewWithMenu');
$this->Html->css('Oeuvres.styles', null, array('inline' => false));
$this->start('content-top');
echo $this->element('searchForm');
$this->end();

if (!empty($fichesactivites)){
$this->start('map');

echo $this->element('googleMap',array('items'=>$fichesoeuvres)) ;

$this->end();
}

//content: pas besoin de fetch
echo $this->element('paginatedResults') ;


