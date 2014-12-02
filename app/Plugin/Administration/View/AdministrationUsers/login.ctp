
    <div class="container">   <div class="col-md-12">
<?php echo $this->Session->flash('auth');?>



 <?php echo $this->Form->create('AdministrationUser', array('url' => '/administration/administrationUsers/login','type'=>'post', 'id' => 'UserLoginForm')); ?>
            <div class="input-group col-md-3">
                <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                <?php echo $this->Form->input('AdministrationUser.email', array('div' => false, 'label' => false, 'class' => 'form-control', 'placeholder' => 'identifiant')); ?>
            </div>
            <div class="input-group col-md-3">
                <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                <?php echo $this->Form->input('AdministrationUser.password', array('div' => false, 'label' => false, 'class' => 'form-control', 'placeholder' => 'mot de passe')); ?>
            </div>
            <label class="checkbox" style="display:none">
                <?php echo $this->Form->input('AdministrationUser.remember_me', array('type'=>'checkbox','div' => false, 'label' => false  )); ?>
                rester connecté
            </label>
            <?php echo $this->Form->hidden('AdministrationUser.return_to', array('value' => Router::url(null, true)));?>
            <div class="control-group ">
                <div class="controls">
                    <?php echo $this->Form->button('valider',array('type' => 'submit','class'=>'btn btn-default')); ?>
                </div>
            </div>
            <div ><?php  echo $this->Html->link('S\'inscrire', '/administration/register') ?></div>
            <div ><a href="#">mot de passe oublié ?</a></div> 
            <?php echo $this->Form->end(); ?>
        </div>     </div>  