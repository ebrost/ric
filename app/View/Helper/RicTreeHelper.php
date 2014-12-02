<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RicImage
 *
 * @author manu
 */
App::uses('AppHelper', 'View/Helper');

class RicTreeHelper extends AppHelper {

    public $helpers = array('Html');

    public function createTree(array $array, $parent_id = null, $primary_key = 'id', $foreign_key = array('buffered_parent_id','parent_id')) {
    $first_element = current($array);

    if (!is_array($first_element)) {
        trigger_error('array_to_tree expects parameter 1 to be a multi-dimensional array, ' . gettype($first_element) . ' given', E_USER_WARNING);
        return null;
    }
     
    if (!array_key_exists($primary_key, $first_element)) {
        trigger_error('array_to_tree expects child array to have a ' . $primary_key . ' key', E_USER_WARNING);
        return null;
    }
 /*
    if (!array_key_exists($foreign_key, $first_element)) {
        trigger_error('array_to_tree expects child array to have a ' . $foreign_key . ' key', E_USER_WARNING);
        return null;
    }
 */
    $keys = array_map(function($e) use ($primary_key) {
        return $e[$primary_key]; 
    }, $array);
    $values = array_values($array);
    $array = array_combine($keys, $values);
   // debug($array);
 foreach ($foreign_key as $fk => $fv){
    foreach ($array as $k => &$v) {
        
           
             if (isset($array[$v[$fv]])) {
            $array[$v[$fv]]['children'][$k] = &$v;
        }
       
        unset($v);
        }
       
    }

    return array_filter($array, function($v) use ($parent_id, $foreign_key) {
        foreach ($foreign_key as $fk => $fv){
         
            if (array_key_exists($fv, $v)){
           
              return $v[$fv] === $parent_id;  
            }
        }
        
    });
     
}



public function displayTree($array){
    $tree=$this->createTree($array);

     foreach ($tree as $evenement){
         echo '<li>';
         $this->displayTreeItem($evenement);
         if (count($evenement['children'])>0){
             echo '<ul classs="trest">';
             foreach ($evenement['children'] as $children){
              echo '<li>';
             $this->displayTreeItem($children);
              echo '</li>';
         }
             echo '</ul>';
         }
          echo '</li>';
     }                       
                        
}
protected function displayTreeItem($evenement){

         if ($evenement['controller']=='BufferedEvenements') echo '<i class="fa fa-fw fa-clock-o"></i> ' ;
         echo $this->Html->link($evenement['nom_complet'], array(
                                    'controller' =>$evenement['controller'],
                                    'action' => 'edit',
                                    $evenement['id']
                                    
         ));
                                
    
     echo '<button class="remove" data-name="'.$evenement['nom_complet'].'" data-type="'.$evenement['controller'].'" data-action="'.$this->Html->url( array(
                                    'controller' => $evenement['controller'],
                                    'action' => 'delete',
                                    $evenement['id']
                                    
                                )).'" style="display: none;"><i class="fa fa-trash-o"></i></button>';

}
}


