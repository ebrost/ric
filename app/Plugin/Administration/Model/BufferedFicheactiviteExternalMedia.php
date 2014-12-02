<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BufferedFicheactiviteExternalMedia
 *
 * @author manu
 */
App::uses('BufferedFicheactiviteMedia', 'Administration.Model');
class BufferedFicheactiviteExternalMedia extends BufferedFicheactiviteMedia{
    //put your code here
    public $name='BufferedFicheactiviteExternalMedia';
    public $belongsTo=array(
        'BufferedFicheactivite',
        'ExternalMedia'=>array('foreignKey'=>'media_id',
         'exclusive'=>true
                )
            );

 
}



