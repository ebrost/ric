<?php
class OeuvreActivite extends OeuvresAppModel
{
	public $name='OeuvreActivite';
        public $useTable='activites';
        
	public $hasAndBelongsToMany=array(
	    'Ficheoeuvre'=>array(
	          'className'=>'Oeuvre.Ficheoeuvre'
	     )
	);
        
        public function getList() {
        
        
       
        $activityRestriction = null;
        
        $activityRoot = $this->getActivityRoot();
        if (!empty($activityRoot)) {
            $activityRestriction['OeuvreActivite.id LIKE'] = $activityRoot . '%';
        }
        
        $excludedActivities= $this->getExcludedActivities();
         if (!empty($excludedActivities)) {
             foreach($excludedActivities as $excludedActivity){
            $activityRestriction[] = 'OeuvreActivite.id NOT LIKE "' .$excludedActivity .'%"';
             }
        }
        
        $activityLevelsDisplay = intval(2 * $this->getActivityLevelsDisplay());
        if ($activityLevelsDisplay > 0) {
            $activityRestriction['LENGTH(OeuvreActivite.id) <='] = $activityLevelsDisplay;
        }
        $results = $this->find('list', array('conditions' => $activityRestriction));
       
        return $results;
    }
}
?>