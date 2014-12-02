<?php

class AgendaAppModel extends AppModel{
  public $tablePrefix='ric_agenda_';
  
  
	protected $hiearchicalSpacer='';
	protected $activityRoot='';
	protected $activityLevelsDisplay=-1;
	protected $displayListOnLoad=true;
	protected $resultsPerPage = 10;
	protected $config;
        protected $dateOffset=15;
        protected $maxSessionsByEventOnList=-1;
        protected $rssStartDate=0;
        protected $rssDateOffset=15;
        protected $rssMaxEvents=50;
       

	public function getConfig(){
           
            
		if (empty($this->config)) {
		$this->config= Configure::read('Agenda');
		}
		
	return $this->config;
	}
        
         public function getmaxSessionsByEventOnList() {
            if (array_key_exists('maxSessionsByEventOnList', $this->config)) {
                $this->maxSessionsByEventOnList = $this->config['maxSessionsByEventOnList'];
            }
            return $this->maxSessionsByEventOnList;
        }
        
         public function getRssStartDate() {
            if (array_key_exists('rssStartDate', $this->config)) {
                $this->rssStartDate = $this->config['rssStartDate'];
            }
            return $this->rssStartDate;
        }
        
        public function getRssDateOffset() {
            if (array_key_exists('rssDateOffset', $this->config)) {
                $this->rssDateOffset = $this->config['rssDateOffset'];
            }
            return $this->rssDateOffset;
        }
        
        public function getRssMaxEvents() {
            if (array_key_exists('rssMaxEvents', $this->config)) {
                $this->rssMaxEvents = $this->config['rssMaxEvents'];
            }
            return $this->rssMaxEvents;
        }
	

	
 
}

