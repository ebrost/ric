<?php $this->extend('/Layouts/base');?>

<?php $this->append('script');?>
<?php echo $this->Html->script('Agenda.global'); ?>
<script>
//jsBase= "<?php echo $this->Html->url('/agenda',true); ?>";
</script>

<?php $this->end();?>

<?php echo $this->fetch('content');?>
<?php echo $this->Html->css('Agenda.styles', array('block' => 'css')); ?>
