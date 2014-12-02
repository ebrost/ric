<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
Router::connect('/administration', array('plugin' => 'administration', 'controller' => 'administrationUsers'));
Router::connect('/administration/index/*', array('plugin' => 'administration', 'controller' => 'administrationUsers'));


Router::connect('/administration/login', array('plugin' => 'administration', 'controller' => 'administrationUsers', 'action' => 'login'));
Router::connect('/logout', array('plugin' => 'administration', 'controller' => 'administrationUsers', 'action' => 'logout'));
Router::connect('/administration/logout', array('plugin' => 'administration', 'controller' => 'administrationUsers', 'action' => 'logout'));
Router::connect('/register', array('plugin' => 'administration', 'controller' => 'administrationUsers', 'action' => 'add'));
//Router::connect('/administration/users/:action/*', array('plugin' => 'administration', 'controller' => 'administrationUsers'));
Router::connect('/administration/:action/*', array('plugin' => 'administration', 'controller' => 'administrationUsers'));
*/
Router::connect('/login', array('plugin' => 'administration', 'controller' => 'administrationUsers', 'action' => 'login'));
Router::connect('/logout', array('plugin' => 'administration', 'controller' => 'users', 'action' => 'logout'));
Router::connect('/admin', array('plugin' => 'administration', 'controller' => 'administrationUsers', 'action' => 'index'));
Router::connect('/administration', array('plugin' => 'administration', 'controller' => 'administrationUsers', 'action' => 'index'));
Router::connect('/Administration/administration_users', array('plugin' => 'administration', 'controller' => 'administrationUsers', 'action' => 'index'));
//Router::connect('/users/login', array('plugin' => 'administration', 'controller' => 'administrationUsers', 'action' => 'login'));
Router::connect('/administration/pages/*', array('plugin' => 'administration','controller' => 'pages', 'action' => 'display'));
Router::connect('/administration/register', array('plugin' => 'administration', 'controller' => 'administrationUsers', 'action' => 'add'));
Router::connect('/administration/:controller/:action/*', array('plugin' => 'administration'));
Router::connect('/Administration/:controller/:action/*', array('plugin' => 'administration'));
Router::connect('/Administration/*', array('plugin' => 'administration','controller' => 'administrationUsers', 'action' => 'index'));
Router::connect('/users/users/:action/*', array('plugin' => 'administration', 'controller' => 'administrationUsers'));


Router::connect('/users', array('plugin' => 'administration', 'controller' => 'administrationUsers'));
Router::connect('/users/index/*', array('plugin' => 'administration', 'controller' => 'administrationUsers'));
Router::connect('/users/:action/*', array('plugin' => 'administration', 'controller' => 'administrationUsers'));



Router::connect('/register', array('plugin' => 'administration', 'controller' => 'administrationUsers', 'action' => 'add'));

