<?php  
/* 
 * Created on Oct 7, 2009 
 * Created by Cosmin Cimpoi <cosmin@binarycrafts.com> 
 * http://bakery.cakephp.org/articles/binarycrafts/2010/01/20/persistentvalidation-keeping-your-validation-data-after-redirects-2
 */ 

class PersistentValidationComponent extends Component  { 
    public $components = array('Session'); 

    //called before Controller::beforeFilter() 
    public function initialize(&$controller, $settings = array()) { 
        $this->controller = $controller; 
    } 

    //called after Controller::beforeRender() 
    public function beforeRender(&$controller) { 
        $validations = $this->Session->read('PersistentValidation'); 
        if (empty($validations)) return; 
        foreach ($validations as $k=>$v) { 
            if (in_array($k, $controller->modelNames)) { 
                if (empty($controller->data))  $controller->data = array(); 
                if (array_key_exists($k, $controller->data) && array_key_exists('0', $controller->data[$k])) { 
                    //    there's data for this model from an associaton query 
                        $controller->data[$k. 'Records'] = $controller->data[$k]; 
                } 
                $controller->data[$k] = $v['data']; 
                $controller->$k->validationErrors = $v['errors']; 
                $this->Session->delete('PersistentValidation.'. $k); 
            } 
        } 
    } 

    //called before Controller::redirect() 
    public function beforeRedirect(&$controller, $url, $status=null, $exit=true) { 
        foreach ($this->controller->modelNames as $mn) { 
            if (count($controller->$mn->validationErrors)) { 
                $this->Session->write('PersistentValidation.'. $mn. '.data', $controller->$mn->data[$mn]); 
                $this->Session->write('PersistentValidation.'. $mn. '.errors', $controller->$mn->validationErrors); 
            } 
        } 
    } 
} 

?>