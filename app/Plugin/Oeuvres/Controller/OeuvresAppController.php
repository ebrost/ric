<?php
App::uses('AppController', 'Controller');
class OeuvresAppController extends AppController{

	protected $appName='Oeuvres';

  public function __construct( $request = NULL, $response = NULL )	{
	$oeuvresAppName = (array)Configure::read('Oeuvres.appName');
  
		if (!empty($oeuvresAppName)) {
			$this->appName= $oeuvresAppName[0];
		}
		
		$this->set('title_for_layout',$this->appName);
	parent::__construct( $request, $response );
  }
  
  public function beforeRender(){
  
    parent::beforeRender();
  }

}

