<?php


$config['Oeuvres'] = array(
	'hiearchicalSpacer'=>'', // pas de separateur avec les checkboxes
        'activityRoot'=>null, // identifiant de l'activit� � faire apparaitre comme racine dans le menu
	'activityLevelsDisplay'=> -1, // nombre de niveaux a afficher dans la nomemclature (-1, pas de restrictions)
	'appName'=>'Oeuvres', //nom de l'application 
	'displayListOnLoad'=>true, // afficher la liste des resultas au lancement
	'resultsPerPage' => 15, // pagination,
        'excludedActivities' =>null, //array('2002','22')  // activites à exclure. Eclut aussi les enfants de ces branches. valeurs entre apostrophes et séparées par des virgules ex :array('21','22') 
        'unlimitedPdfList'=>false,// ne pas limiter le nombre de résultats dans la liste en mode pdf. Attention ,peut être TRES groumand en ressources !
        'fulltextSearchFields'=>'nom_complet,commentaires,auteur,co_auteur,realisateur,compositeur,choregraphe,metteurenscene,scenariste,illustrateur',
	'emailSubject'=>'Oeuvre web: un ami vous recommande des oeuvres',
       
);
