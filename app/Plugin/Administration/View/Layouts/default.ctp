<?php $this->extend('/Layouts/base');?>

<?php $this->append('script');?>
<?php echo $this->Html->script("http://maps.google.com/maps/api/js?sensor=false");?>
<?php echo $this->Html->script('Administration.jquery.ui.addresspicker'); ?>
<?php echo $this->Html->script('Administration.bootstrap-dialog.min'); ?>

<?php echo $this->Html->script('Administration.global'); ?>
<script>
//jsBase= "<?php echo $this->Html->url('/administration',true); ?>";
</script>

<?php $this->end();?>

<?php echo $this->fetch('content');?>
<?php echo $this->Html->css('Administration.styles');
