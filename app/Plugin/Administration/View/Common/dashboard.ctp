<?php echo $this->Html->script('Administration.jquery.bootstrap.wizard'); ?>

    <?php if(isset($fragment)): ?>
<?php debug ($fragment); ?>
       <script> window.location.hash= '<?php echo $fragment; ?>'</script>
       <?php endif;?>

<div class="row">
	<div class="col-md-9">
		<?php echo $this->fetch('content-top'); ?>
            <div  id="content">
                
		<?php echo $this->fetch('content'); ?>
            </div>
	</div>
	<div class="col-md-3">
		<?php echo $this->element('admin_menu'); ?>
		
	</div>
</div>
