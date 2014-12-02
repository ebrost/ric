<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class EmailConfig {
    
    public $default;
    
    function __construct(){
       
        $this->default=Configure::read('Email');
    }
    
}

