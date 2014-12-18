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


$i=0;
foreach($evenements as $keyEvenement=>$evenement){
    
    
        foreach($evenement['Session'] as $keySession=> $session){
           
            $sessions[$i]['Evenement']= $session;
            $sessions[$i]['Evenement']['nom_complet']=$evenement['Evenement']['nom_complet'];
            $sessions[$i]['Evenement']['id']=$evenement['Evenement']['id'];
            $sessions[$i]['Evenement']['num']=$evenement['Evenement']['num'];
            $sessions[$i]['Evenement']['r']=$evenement['Evenement']['relevance'];
            $sessions[$i]['Evenement']['adresse']= $session['lieu'];
            $sessions[$i]['Image'][0]= $evenement['Image'][0];
            $sessions[$i]['Evenement']['additional_content']=$session['resume_session'];
            unset($sessions[$i]['Image'][0]['MediasLy']);
            $i++;
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


