<!-- prototype menu droite -->
<?php echo $this->Html->script('Administration.loginActions', array('block' => 'script')); ?>
<?php echo $this->Html->css('Administration.styles');?>
<!--nocache-->

<ul class="nav-sidebar well  nav-list">
        <?php if ($username=AuthComponent::user('username')): ?>
    <li><strong><?php echo ($username); ?></strong></li>
        <li>
            <?php
            echo $this->Html->link(' <i class="fa fa-sign-out"></i> Déconnexion', array(
                'plugin'=>'administration',
                'controller' => 'AdministrationUsers',
                'action' => 'logout'
                    ), array('escape' => false))
            ?>
        </li>
        <li><?php echo $this->Html->link(' <i class="fa fa-dashboard"></i> Tableau de bord',array(
                'plugin'=>'administration',
                'controller' => 'AdministrationUsers',
                'action' => 'index'
                    ), array('escape' => false))
            ?>
        </li>
      

    <?php else: ?>
        <li><a href="#" id="showlogin" ><i class="fa fa-sign-in"></i> Se connecter</a>
            <?php echo $this->Form->create('AdministrationUser', array('url' => '/administration/administrationUsers/login', 'id' => 'UserLoginForm','class'=>'hide')); ?>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                <?php echo $this->Form->input('email', array('div' => false, 'label' => false, 'class' => 'form-control', 'placeholder' => 'identifiant')); ?>
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                <?php echo $this->Form->input('password', array('div' => false, 'label' => false, 'class' => 'form-control', 'placeholder' => 'mot de passe')); ?>
            </div>
            <label class="checkbox">
                <?php echo $this->Form->input('remember_me', array('type'=>'checkbox','div' => false, 'label' => false  )); ?>
                rester connecté
            </label>
            <?php echo $this->Form->hidden('return_to', array('value' => Router::url(null, true)));?>
            <div class="control-group ">
                <div class="controls">
                    <?php echo $this->Form->button('valider',array('type' => 'submit','class'=>'btn btn-default')); ?>
                </div>
            </div>
            <div ><?php  echo $this->Html->link('S\'inscrire', '/administration/register') ?></div>
            <div ><a href="#">mot de passe oublié ?</a></div> 
            <?php echo $this->Form->end(); ?>

            
            
        </li>
<?php endif; ?>
</ul>
<!--/nocache-->
<!-- fin  prototype menu droite-->	