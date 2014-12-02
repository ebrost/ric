<?php foreach($documents as $document):	?>
	<div class="well">
		<div class="media">
                   
                    
			<div class="media-body">
				<?php if(!empty($document['name'])): ?>
					<h5 class="media-heading">
						<?php echo $this->Html->link('<i class="fa fa-download"></i> '.$document['name'],'/medias/document/'.$document['dir'].'/'.$document['file'],array('_target'=>'_blank','escape'=>false)); ?>
						
						<?php if(!empty($document['filetype'])): ?>
														<small>(<?php echo $document['filetype']; ?>)</small>
						<?php endif; ?>
						
						<?php if(!empty($document['copyright'])): ?>
						<p><small>
								<?php echo $document['copyright']; ?>
							</small></p>
						<?php endif; ?>
						
					</h5>
				<?php endif; ?>
	
				
			</div>	
		</div>
	</div>
<?php endforeach; ?>