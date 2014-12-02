<?php
class Activite extends AnnuaireAppModel
{
	public $name='Activite';
	public $hasAndBelongsToMany=array(
	    'Ficheactivite'=>array(
	          'className'=>'Annuaire.Ficheactivite'
	     )
	);
        
        public function getList() {
        
        
       
        $activityRestriction = null;
        $activityRoot = $this->getActivityRoot();
        if (!empty($activityRoot)) {
            $activityRestriction['Activite.id LIKE'] = $activityRoot . '%';
        }
        
        $excludedActivities= $this->getExcludedActivities();
         if (!empty($excludedActivities)) {
             foreach($excludedActivities as $excludedActivity){
            $activityRestriction[] = 'Activite.id NOT LIKE "' .$excludedActivity .'%"';
             }
        }
      
        $activityLevelsDisplay = intval(2 * $this->getActivityLevelsDisplay());
        if ($activityLevelsDisplay > 0) {
            $activityRestriction['LENGTH(Activite.id) <='] = $activityLevelsDisplay;
        }
        $results = $this->find('list', array('conditions' => $activityRestriction));
        return $results;
    }
}
?>