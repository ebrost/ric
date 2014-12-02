<?php
//Router::connect ('/', array('plugin' => 'annuaire','controller'=>'ficheactivites', 'action'=>'index'));

Router::connect(
    '/annuaire/Ficheactivites/:id-:slug/*',
    array(
	
	'controller'=>'ficheactivites',
	'action' => 'view'
	),
    array(
		'pass'=>array('id','slug'),
       

    )
);
Router::connect(
    '/annuaire/ficheactivites/:id-:slug/*',
    array(
	'plugin' => 'annuaire',
	'controller'=>'ficheactivites',
	'action' => 'view'
	),
    array(
		'pass'=>array('id','slug'),
       

    )
);

Router::connect(
    '/Annuaire/ficheactivites/:id-:slug/*',
    array(
	'plugin' => 'annuaire',
	'controller'=>'ficheactivites',
	'action' => 'view'
	),
    array(
		'pass'=>array('id','slug'),
       

    )
);


Router::connect('/annuaire', array('plugin' => 'annuaire', 'controller' => 'ficheactivites', 'action' => 'index'));
Router::connect('/Annuaire', array('plugin' => 'annuaire', 'controller' => 'ficheactivites', 'action' => 'index'));

Router::connect('/annuaire/:controller/:action/*', array('plugin' => 'annuaire'));
Router::connect('/Annuaire/:controller/:action/*', array('plugin' => 'annuaire'));
/*
'pass'=>array('id','num','q','slug'),
        'id' => '[0-9]+',
        'num' => '[0-9]+',
		

*/