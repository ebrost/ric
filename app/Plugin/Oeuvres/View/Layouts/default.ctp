<?php $this->extend('/Layouts/base');?>

<?php $this->append('script');?>
<?php echo $this->Html->script('Oeuvres.global'); ?>
<script>
//jsBase= "<?php echo $this->Html->url('/oeuvres',true); ?>";
</script>

<?php $this->end();?>

<?php echo $this->fetch('content');?>
<?php echo $this->Html->css('Oeuvres.styles');?>
