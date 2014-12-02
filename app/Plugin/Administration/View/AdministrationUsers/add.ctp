<?php $this->extend('/Common/simpleView');?>
<?php debug($this->validationErrors) ; ?>
<div class="users form">
	
	<fieldset>
		<?php
			echo $this->Form->create($model, array(
'class' => 'form-horizontal well',
'inputDefaults' => array(
    'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
    'div' => array('class' => 'control-group'),
    'label' => array('class' => 'control-label'),
    'between' => '<div class="controls">',
    'after' => '</div>',
    'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline'
    )),
)));?>
                        <h4><?php echo __d('users', 'S\'enregister'); ?></h4>
                            <?php	echo $this->Form->input('username', array(
				'label' => array('class' => 'control-label', 'text' => 'Nom d\'utilisateur')));?>
			<?php echo $this->Form->input('email', array(
				'label' => array('class' => 'control-label', 'text' => 'Email (utilisé comme identifiant de connexion)')));?>
			<?php echo $this->Form->input('password', array(
				'label' => array('class' => 'control-label', 'text' => 'Mot de passe'),
				'type' => 'password'));?>
			<?php echo $this->Form->input('temppassword', array(
				'label' => array('class' => 'control-label', 'text' => 'Confirmez votre mot de passe'),
				'type' => 'password'));?>
                        <div class="control-group"><div class="controls">
			  <label class="checkbox">
                           
			<?php echo $this->Form->input('tos', array('div'=>false,'between'=>false,'after'=>false,'label' =>false,'error'=>false));?>
                              J'ai lu et j'accepte <?php echo $this->Html->link(__d('users', 'Conditions d\'utilisation'), array('controller' => 'pages', 'action' => 'tos')); ?>
                             <?php if ($this->Form->isFieldError('tos')) { $errorTos=$this->validationErrors['AdministrationUser']['tos'][0];   echo $this->Form->error('tos',$errorTos,array('wrap' => 'span', 'class' => 'help-inline error'
    ));}; ?> 
                          </label>
                                
                            </div></div>
			<?php echo $this->Form->end(array( 'label' =>'Valider','class' => 'btn', 'div' => array('class' => 'control-group',),'before' => '<div class="controls">',
    'after' => '</div>'
));
		?>
	</fieldset>
</div>

