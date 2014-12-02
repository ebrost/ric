<?php


$config['ImagesResizing']=array(
    'xvga' => '1024x768',
    'vga' => '640x480',
    'thumb' => '[70x70]',
    'icon'=>'[30x30]',
    'medium'=>'[200x200]',
);
// ne modifiez pas les différents noms utilisés !(thumb,vga...)
 /***** exemples de configuration ****
  *       
100x80 - redimensionne à ces dimensions, les côtés sont recoupés si le ratio initial ne correspond pas 
[100x80] - redimensionne à ces dimensions, les côtés sont complétés par des bandes blanches si le ratio initial ne correspond pas 
100w - conserve le ratio initial, redimensionne à 100px de longueur
80h - conserve le ratio initial, redimensionne à 80px de hauteur
80l - conserve le ratio initial, redimensionne de telle façon que le la taille la plus grande soit de 80px
600mw - conserve le ratio initial, redimensionne à 600px de longueur max ou copie l'image originale si elle fait moins de 600 px de long  
800mh - conserve le ratio initial, redimensionne à 800px de hauteur max ou copie l'image originale si elle fait moins de 800 px de haut   
960ml - conserve le ratio initial, redimensionne de telle façon que la taille la plus grande soit de 960 px ou copie l'image originale si l'image générée est plus grande     
  */
        
        
$config['Email']=array(
		'transport' => 'Smtp',
		//'from' => array('site@localhost' => 'My Site'),
		'host' => 'smtp.gmail.com',
		'port' => 465,
		'tls'=>true,
		'timeout' => 30,
		'username' => 'username@domain.com',
                'defaultEmail'=>'noreply@domain.com',
		'password' => 'Co012fz',
		//'client' => null,
		'log' => false,
		'header' =>'x-RicWeb',
		'emailFormat' => 'html', // valeurs possbiels: text,html,both
		'emailSubject'=>'global subject' // sujet du mail à surcharger dans les différentes config des plugins (ou pas si vous voulez utiliser un seul sujet)
		//'charset' => 'utf-8',
		//'headerCharset' => 'utf-8',
	);
$config['Email']=array(
		'transport' => 'Smtp',
		//'from' => array('site@localhost' => 'My Site'),
		'host' => 'ssl://smtp.googlemail.com',
		'port' => 465,
		'timeout' => 30,
		'username' => 'emmanuel.brost@gmail.com',
		'password' => 'test',
		'log' => true,
		'header' =>'x-RicWeb',
		'emailFormat' => 'html',
		'emailSubject'=>'global subject' // sujet du mail à surcharger dans les différentes config des plugins (ou pas si vous voulez utiliser un seul sujet)
		//'charset' => 'utf-8',
		//'headerCharset' => 'utf-8',
	);

//les configurations possibles sont définies dans le fichier email.php.default dans ce meme dossier.
//http://book.cakephp.org/2.0/fr/core-utility-libraries/email.html#configuration

$config['CakePdf']=array(
	'engine'=>'CakePdf.RicTcpdf', //Engine maison, les options ne fonctionneront qu'avec celui-ci
	'margin' => array(
            'bottom' => 0,
            'left' => 0,
            'right' => 0,
            'top' => 0
    ),
	'options' => array(
		'logo'=>'logo.png',
		'footerText' =>'Copyright © %d XXXXXXXXXXX. Tous droits réservés.',
		'bgColor' => array(240,240,240), // composantes RVB couleur du fond 1 item sur 2
		'linkColor' => array(150,150,150) // default : array(0,0,255), ce si beau bleu HTML
	)
);


$config['Google'] = array(
    'zoom' => 9,
    'lat' => 47, //position initiale: qq part en region paca...
    'lng' => 12,
    'type' => 'H', // Roadmap, Satellite, Hybrid, Terrain
    'size' => array('width'=>'100%', 'height'=>400),
    //'staticSize' => '500x450',
);

//misc do not edit
$config['App']=array('defaultEmail'=>$config['Email']['defaultEmail']);