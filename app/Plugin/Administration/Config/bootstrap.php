<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AuthComponent', 'Controller/Component');
CakePlugin::load(array('Users'));
CakePlugin::load(array('Search'));
CakePlugin::load(array('Utils'));
CakePlugin::load('Upload');
CakePlugin::load('Localized');
/*
CakePlugin::load([
    'Essence' => [
        'bootstrap' => true
    ]
]);*/