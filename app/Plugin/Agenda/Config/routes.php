<?php

Router::parseExtensions(array('rss','json','pdf'));
Router::setExtensions(array('rss','json','pdf'));

Router::connect(
    '/agenda/evenements/:id-:slug/*',
    array(
	'plugin' => 'agenda',
	'controller'=>'evenements',
	'action' => 'view'
	),
    array(
		'pass'=>array('id','slug'),
        

    )
);

Router::connect(
    '/Agenda/evenements/:id-:slug/*',
    array(
	'plugin' => 'agenda',
	'controller'=>'evenements',
	'action' => 'view'
	),
    array(
		'pass'=>array('id','slug'),
       

    )
);
Router::connect('/agenda', array('plugin' => 'agenda', 'controller' => 'evenements', 'action' => 'index'));
Router::connect('/Agenda', array('plugin' => 'Agenda', 'controller' => 'evenements', 'action' => 'index'));
Router::connect('/agenda/feed', array('plugin' => 'agenda', 'controller' => 'evenements', 'action' => 'feed','ext'=>'rss'));
Router::connect('/Agenda/selection', array('plugin' => 'agenda', 'controller' => 'evenements', 'action' => 'displayPrioritaire'));
Router::connect('/agenda/selection', array('plugin' => 'agenda', 'controller' => 'evenements', 'action' => 'displayPrioritaire'));
Router::connect('/agenda/:controller/:action/*', array('plugin' => 'agenda'));
Router::connect('/Agenda/:controller/:action/*', array('plugin' => 'agenda'));


