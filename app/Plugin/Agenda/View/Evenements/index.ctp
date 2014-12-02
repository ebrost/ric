<?php $this->extend('/Common/viewWithMenu');?>
<?php $this->Html->css('Agenda.styles', null, array('inline' => false));?>

<?php $this->start('content-top');?>
	<?php echo $this->element('searchForm') ;?>
<?php $this->end();?>

<?php 
if (!empty($evenements)){
	$this->start('map');
?>
<?php //$sessions=Hash::extract($evenements, '{n}.Session.{n}');



foreach($evenements as $keyEvenement=>$evenement){
    
    
        foreach($evenement['Session'] as $keySession=> $session){
            $sessions[$keySession]['Evenement']= $session;
            $sessions[$keySession]['Evenement']['nom_complet']=$evenement['Evenement']['nom_complet'];
            $sessions[$keySession]['Evenement']['id']=$evenement['Evenement']['id'];
            $sessions[$keySession]['Evenement']['num']=$evenement['Evenement']['num'];
            $sessions[$keySession]['Evenement']['r']=$evenement['Evenement']['relevance'];
            $sessions[$keySession]['Evenement']['adresse']= $session['lieu'];
            $sessions[$keySession]['Image'][0]= $evenement['Image'][0];
            $sessions[$keySession]['Evenement']['additional_content']=$session['resume_session'];
            
        }

}
        
        ; ?>
<?php echo $this->element('googleMap',array('items'=>$sessions)) ;?>
<?php
$this->end();
}
?>
<!--content: pas besoin de fetch -->
<?php echo $this->element('paginatedResults') ;?>


