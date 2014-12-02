<?php
//Router::connect ('/', array('plugin' => 'oeuvres','controller'=>'ficheoeuvres', 'action'=>'index'));

Router::connect(
    '/oeuvres/Ficheactivites/:id-:slug/*',
    array(
	
	'controller'=>'ficheoeuvres',
	'action' => 'view'
	),
    array(
		'pass'=>array('id','slug'),
       

    )
);
Router::connect(
    '/oeuvres/ficheoeuvres/:id-:slug/*',
    array(
	'plugin' => 'oeuvres',
	'controller'=>'ficheoeuvres',
	'action' => 'view'
	),
    array(
		'pass'=>array('id','slug'),
       

    )
);

Router::connect(
    '/Annuaire/ficheoeuvres/:id-:slug/*',
    array(
	'plugin' => 'oeuvres',
	'controller'=>'ficheoeuvres',
	'action' => 'view'
	),
    array(
		'pass'=>array('id','slug'),
       

    )
);


Router::connect('/oeuvres', array('plugin' => 'oeuvres', 'controller' => 'ficheoeuvres', 'action' => 'index'));
Router::connect('/Annuaire', array('plugin' => 'oeuvres', 'controller' => 'ficheoeuvres', 'action' => 'index'));

Router::connect('/oeuvres/:controller/:action/*', array('plugin' => 'oeuvres'));
Router::connect('/Annuaire/:controller/:action/*', array('plugin' => 'oeuvres'));
/*
'pass'=>array('id','num','q','slug'),
        'id' => '[0-9]+',
        'num' => '[0-9]+',
		

*/