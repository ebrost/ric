<?php


$config['Annuaire'] = array(
	//'hiearchicalSpacer'=>'&nbsp;&nbsp;', // symbole apparaissant dans les diffrenetes nomemclature. Attention ,il faut forcer les espaces : &nbsp;
	'hiearchicalSpacer'=>'', // pas de separateur avec les checkboxes
        'activityRoot'=>'', // identifiant de l'activit� � faire apparaitre comme racine dans le menu
	'activityLevelsDisplay'=> -1, // nombre de niveaux a afficher dans la nomemclature (-1, pas de restrictions)
	'appName'=>'Annuaire Culturel', //nom de l'application 
	'displayListOnLoad'=>true, // afficher la liste des resultas au lancement
	'resultsPerPage' => 15, // pagination,
        'excludedActivities' =>array('2002','22'),  // activites à exclure. Eclut aussi les enfants de ces branches. valeurs entre apostrophes et séparées par des virgules ex :array('21','22') 
        'unlimitedPdfList'=>false, // ne pas limiter le nombre de résultats dans la liste en mode pdf. Attention ,peut être TRES groumand en ressources !
        'fulltextSearchFields'=>'nom_complet,commentaires,commentaires_arts_visuels,commentaires_audio_visuel,commentaires_livre,commentaires_patrimoine,commentaires_spectacle', //l'index fulltext correspondant doit exister dans la base
	'emailSubject'=>'Ric web: un ami vous recommande des acteurs culturels',
       // 'searchFormType'=>'searchFormCheckboxes' //null //ou 'searchFormCheckboxes'
	
);
