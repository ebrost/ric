<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BuffredFicheactivite_Image
 *
 * @author manu
 */
App::uses('BufferedEvenementMedia', 'Administration.Model');
class BufferedEvenementImage extends BufferedEvenementMedia{
    //put your code here
    public $name='BufferedEvenementImage';
    public $belongsTo=array(
        'BufferedEvenement'=>array('foreignKey'=>'foreign_key'),
        'Image'=>array('foreignKey'=>'media_id',
         'exclusive'=>true
                )
            );

  
   
}
