<div class="row">
	<div class="col-md-9">
		<?php echo $this->fetch('content-top'); ?>
            <div  id="content">
		<?php echo $this->fetch('content'); ?>
            </div>
	</div>
	<div class="col-md-3">
		<?php $this->start('menu');?>
		<?php if (CakePlugin::loaded('Administration')) echo $this->element('Administration.login'); ?>
		<?php $this->end();?>
		<?php echo $this->fetch('menu'); ?>
                <?php echo $this->fetch('map'); ?>
		<?php echo $this->element('addToFavorite'); ?>
	</div>
</div>
