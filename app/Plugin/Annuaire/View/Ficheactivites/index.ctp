<?php $this->extend('/Common/viewWithMenu');?>
<?php $this->Html->css('Annuaire.styles', null, array('inline' => false));?>
<?php $this->start('content-top');?>
<?php if(!empty($searchFormType)){
    echo $this->element($searchFormType);
    }
    else{
        echo $this->element('searchForm') ;
    };?>
<?php $this->end();?>

<?php 
if (!empty($fichesactivites)){
	$this->start('map');
?>
<?php echo $this->element('googleMap',array('items'=>$fichesactivites)) ;?>
<?php
$this->end();
}
?>
<!--content: pas besoin de fetch -->
<?php echo $this->element('paginatedResults') ;?>


