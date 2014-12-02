<?php $this->extend('/Layouts/base');?>

<?php $this->append('script');?>
<?php echo $this->Html->script('Annuaire.global'); ?>
<script>
//jsBase= "<?php echo $this->Html->url('/annuaire',true); ?>";
</script>

<?php $this->end();?>

<?php echo $this->fetch('content');?>
<?php echo $this->Html->css('Annuaire.styles');