<?php


$config['Agenda'] = array(
	'hiearchicalSpacer'=>'&nbsp;&nbsp;', // symbole apparaissant dans les diffrenetes nomemclature. Attention ,il faut forcer les espaces : &nbsp;
	'appName'=>'Agenda des manifestations', //nom de l'application 
	'displayListOnLoad'=>true, // afficher la liste des resultas au lancement
	'resultsPerPage' => 15, // pagination
	'emailSubject'=>'Ric web: un ami vous recommande des événements',
        'unlimitedPdfList'=>false, // ne pas limiter le nombre de résultats dans la liste en mode pdf. Attention ,peut être TRES groumand en ressources !
        'dateOffset'=>-1, // pour formulaire de recherche, par défaut: debut; aujourd'hui, fin:aujourd'hui + dateOffset,
        'maxSessionsByEventOnList'=>'2', //nombre de sessions à afficher en mode liste ( -1 =>toutes les sessions)
	
        //rss
        'rssStartDate'=>0, //nombre de jours à partir d'aujourdui pour le debut du fil
        'rssDateOffset'=>15, // nombre de jours à afficher à partir de la date de départ
        'rssMaxEvents'=>50 //nombre d'evenements à afficher
);
