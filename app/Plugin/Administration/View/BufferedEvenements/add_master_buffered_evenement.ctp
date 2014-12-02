<?php $this->extend('Common/dashboard'); ?>
<?php echo $this->Html->script('Administration.ric.tabwizard'); ?>


<?php if (count($user['AvailablesFicheactivite']) == 0): ?>
    <div class="bs-callout bs-callout-info">
        <h4>Vous n'avez pas de fiche activité définie</h4>
        <p>Cette étape est nécessaire pour créer des événements
        </p>
        <?php
        echo $this->Html->link(' <i class="fa fa-plus-circle fa-fw"></i> Ajouter une activité', array(
            'plugin' => 'administration',
            'controller' => 'BufferedFicheactivites',
            'action' => 'add'), array('class' => 'btn btn-primary btn-sm', 'escape' => false))
        ?>
    </div> 
<?php else: ?>
 <script>
        $(function() {
          
            Ric.tabWizard('#rootwizard', "<?php echo $this->Html->url(array('controller' => 'BufferedEvenements', 'action' => 'checkValidation'), true); ?>", false);
         
        });
    </script>  
     <div id="rootwizard">
        <ul class="nav nav-tabs" id ="tabs">
            <li class="active"><a href="#coordonnees" data-toggle="tab">Informations générales</a></li>
            <li><a href="#description" data-toggle="tab">Description</a></li>

        </ul>
         <?php echo $this->Form->create('BufferedEvenement', array('class' => 'form-horizontal', 'role' => 'form')); ?>  
        <?php echo $this->Form->input('BufferedEvenement.master', array('type'=>'hidden','value'=>1)); ?>
<div class="tab-content">
    
    <div class="tab-pane active" id="coordonnees">
     
        <?php echo $this->element('Agenda/link_to_ficheactivite'); ?>   

                <div class="form-group">
                    <?php echo $this->Form->label('BufferedEvenement.nom_complet', 'Nom', 'col-md-2 control-label'); ?>

                    <div class="col-md-4 ">

                        <?php echo $this->Form->input('BufferedEvenement.nom_complet', array('label' => false, 'placeholder' => 'Nom', 'class' => 'form-control')); ?>
                    </div> 
                </div>
        
    </div>
    <div class="tab-pane" id="description">
        <div class="form-group clearfix">
                    <?php echo $this->Form->label('BufferedEvenement.commentaires', 'Description', 'col-md-1 col-md-offset-1 control-label'); ?>


                    <div class="col-md-10 ">
                        <?php echo $this->Form->input('BufferedEvenement.commentaires', array('label' => false, 'data-element' => 'commentaires', 'placeholder' => 'Description de l\'événémént', 'class' => 'form-control')); ?>
                    </div> 

       </div>
       <div class="row">
                    <div class="col-md-6">
                        <?php echo $this->Form->button('Enregistrer', array('type' => 'submit', 'class' => 'search btn btn-primary pull-right', 'id' => 'submit')); ?> 
                    </div>

                </div>  
    </div>
     
   
</div>
        <?php echo $this->Form->end(); ?>
<div class="row">
            <div class=" col-md-6">

                <ul class=" wizard  pager prev-next ">
                    <li class="previous"><a href="#" name='previous' >Précédent</a></li> 
                    <li class="next"><a href="#"  name='next' >Suivant</a></li>             


                </ul>
            </div>
        </div>
    </div>    


<?php endif; ?>