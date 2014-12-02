<!-- Button to trigger modal -->
<script>
$(function(){
Ric.sendToFriendManager('#modal-sendToFriend-<?php echo $modalID;?>')
})
</script>
<?php $icon_large=(!empty($icon_large))? 'icon-large':'';?>
<?php $linkID=(!empty($linkID))? $linkID:'';?>
<?php echo $this->Html->link('<i class="fa fa-envelope '.$icon_large.'"></i>  Envoyer par email', '#modal-sendToFriend-'.$modalID,
						array(
							'id'=>$linkID,
							'escape'=>false,
							'data-toggle'=>"modal"
							)
						)
					?>
<!-- Modal -->
<div id="modal-sendToFriend-<?php echo $modalID?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Envoyer par email" aria-hidden="true">
    <div class="modal-dialog"><div class="modal-content">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Envoyer par email</h3>
  </div>
  <div class="modal-bodyandfooter">
	<?php echo $this->Form->create('Email',array('plugin'=>false,'url'=>'/Email/sendToFriend','class'=>'form-horizontal','inputDefaults' => array(
    
    'error' => array('attributes' => array('wrap' => 'div', 'class' => 'alert alert-error'))
) )); ?>
	  <div class="modal-body">
                <div class="form-group">
                    <?php echo $this->Form->label('Email.emailFrom','Votre Email',array('class'=>'control-label required col-sm-4'));?>
                    <div class="col-sm-8">
                       <?php echo $this->Form->input('Email.emailFrom', array('label'=>false,'placeholder'=>'Votre email','class' => 'form-control'));?>
                    </div>
                </div>
              <div class="form-group">
                    <?php echo $this->Form->label('Email.emailTo','Email de votre ami',array('class'=>'control-label required col-sm-4'));?>
                    <div class="col-sm-8">
                       <?php echo $this->Form->input('Email.emailTo', array('label'=>false,'placeholder'=>'Email de votre ami','class' => 'form-control'));?>
                    </div>
                </div>
              <div class="form-group">
                    <?php echo $this->Form->label('Email.message','Votre message',array('class'=>'control-label  col-sm-4'));?>
                    <div class="col-sm-8">
                       <?php echo $this->Form->input('Email.message', array('label'=>false,'placeholder'=>'Votre message','class' => 'form-control','type'=>'textarea'));?>
                    </div>
                </div>
		<?php //echo $this->Form->hidden('Email.url', array('value'=>Router::url(null, true)));?>	
		<?php echo $this->Form->hidden('Email.idList', array('value'=>$idList));?>	
		<?php echo $this->Form->hidden('Email.plugin', array('value'=>$this->request->params['plugin']));?>
		<?php echo $this->Form->hidden('Email.controller', array('value'=>$this->request->params['controller']));?>			
	  </div>
	  <div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Annuler</button>
		<?php echo $this->Form->button('envoyer' ,array('type'=>'submit','class'=>'btn btn-primary')); ?> 		
	  </div>
	<?php echo $this->Form->end() ;?>
	</div>
        </div></div>
</div>
<!-- fin modal-->