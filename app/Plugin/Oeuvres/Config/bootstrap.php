<?php
Configure::load('Oeuvres.config');
Cache::config('oeuvres', array(
 		'engine' => 'File', //[required]
 		'duration'=> 3600, //[optional]
 		'probability'=> 100, //[optional]
  		'path' => CACHE.'views'.DS.'oeuvres', //[optional] use system tmp directory - remember to use absolute path
  		'prefix' => 'oeuvres_', //[optional]  prefix every cache file with this string
  		'lock' => false, //[optional]  use file locking
  		'serialize' => true, // [optional]
  		'mask' => 0666, // [optional] permission mask to use when creating cache files
 	));
?>