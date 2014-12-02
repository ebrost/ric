
<?php foreach($medias as $media):	?>
	<div class="well">
		<div class="media">
			<div class="pull-left">
			<?php echo $media['content']->html; ?>	
                        </div>
			<div class="media-body">
				<?php if(!empty($media['content']->title)): ?>
					<h5 >
                                            <span class="label label-default"><?php echo $media['content']->title; ?></span>
						
				
					</h5>
				<?php endif; ?>
                                <?php if(!empty($media['content']->authorName)): ?>
					<h6 >
						<?php echo $media['content']->authorName; ?>
						
				
					</h6>
				<?php endif; ?>
                            <?php if(!empty($media['content']->description)): ?>
					<p >
						<?php echo $media['content']->description; ?>
						
				
					</p>
				<?php endif; ?>
				
			</div>	
		</div>
	</div>
<?php endforeach; ?>

