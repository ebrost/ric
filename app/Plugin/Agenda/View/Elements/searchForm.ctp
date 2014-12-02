<?php echo $this->Html->script('bootstrap-datepicker', array('block' => 'script')); ?>
<?php echo $this->Html->css('datepicker3', array('block' => 'css')); ?>
<?php echo $this->Html->script('searchActions', array('block' => 'script')); ?>
<?php echo $this->Form->create('Evenement', array('action' => 'search', 'class' => 'searchForm well')); ?>
<h4>
    <i class="fa fa-search"></i> 
    Rechercher un evenement </h4>
<hr/>
<div class="tabbable"> <!-- Only required for left/right tabs -->
    <ul class="nav nav-tabs" id="tab_recherche">
        <li class="active"><a href="#recherche-simple" id="recherche-simple-tab" data-toggle="tab">Recherche simple</a></li>
        <li><a href="#recherche-avancee" id="recherche-avancee-tab" data-toggle="tab">Recherche avancée</a></li>
    </ul>
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-4">
                    <?php echo $this->Form->input('Search.keywords', array('div' => false, 'label' => false, 'class' => 'form-control changeListener', 'placeholder' => 'Mots clés')); ?>
                    <?php //echo $this->Form->input('Search.name', array('div'=>false,'label'=>false,'class'=>'form-control changeListener','placeholder'=>'Nom'));?>
                     <div id="SearchStartAndEndDate">  
                        <?php echo $this->Form->label('Search.startDate','Du :', array('class'=>'label')); ?>
                        <div class="input-group date"  id="SearchStartDateComponent">
                            <?php echo $this->Form->input('Search.startDate', array('default'=>$searchFormOptions['startDate'],'div' => false, 'label'=>false, 'class' => 'form-control input-date datefield changeListener')); ?><span class="input-group-addon"><i class=" fa fa-th"></i></span>
                        </div>
                        <?php echo $this->Form->label('Search.endDate','au :', array('class'=>'label')); ?>
                        <div class="input-group date" id="SearchEndDateComponent">
                            <?php echo $this->Form->input('Search.endDate', array('default'=>$searchFormOptions['endDate'],'div' => false, 'label'=>false, 'class' => 'form-control input-date datefield changeListener')); ?><span class="input-group-addon"><i class="fa fa-th"></i></span>
                        </div>
                     </div>
                </div>
                <div class="col-md-4">
                    <?php if (!empty($searchFormOptions['Genres'])) : ?>
                    <div id="genres" >	
                            <?php echo $this->Form->input('Search.genre', array('div' => false, 'label' => false, 'options' => $searchFormOptions['Genres'], 'empty' => 'Genre', 'escape' => false, 'class' => 'form-control changeListener')); ?>
                       </div> 
                     <?php endif; ?>

                    <?php if (!empty($searchFormOptions['Types'])) : ?>
                        <div id="types">		
                            <?php echo $this->Form->input('Search.type', array('div' => false, 'label' => false,'options' => $searchFormOptions['Types'], 'empty' => 'Type d\'événement', 'escape' => false, 'class' => 'form-control changeListener')); ?>
                        </div>	
                    <?php endif; ?>

                  
                       
                    


                </div>
                <div class="col-md-3">
                    <?php echo $this->Form->input('Search.commune', array('div' => false, 'label' => false, 'class' => 'form-control changeListener', 'autocomplete' => 'off', 'placeholder' => 'Ville')); ?>
                    <?php echo $this->Form->hidden('Search.commune_id'); ?>
                    <div id="communes-radius-container">
                        <div id="commune-radius-amount" style="margin:0 0 0.5em 0.6em;width:200px">
                            <label for="amount">dans un rayon de </label><?php echo $this->Form->input('Search.radius', array('div' => false, 'label' => false, 'class' => 'form-control changeListener', 'readonly' => true)); ?> km
                            <div id="communes-radius" style="width:200px" ></div>
                        </div>
                    </div>

                    <?php echo $this->Form->input('Search.implantation', array('div' => false, 'label' => false, 'options' => $searchFormOptions['Implantations'], 'empty' => 'Région / Département', 'class' => 'form-control  changeListener')); ?>

                </div>
            </div>
            
             
            <div class="tab-content" >
                <div class="tab-pane active" id="recherche-simple">
                </div>
                <div class="tab-pane fade" id="recherche-avancee">
                <div class="row">
                    <div class="col-md-6">
                        <fieldset><legend>Publics</legend><?php echo $this->Form->input('Search.typepublic', array('div' => false, 'label' => false,'options' => $searchFormOptions['Typepublics'], 'multiple' => 'checkbox', 'class' => 'checkbox changeListener')); ?></fieldset>
                     </div>
                    <div class="col-md-6">
                       <fieldset><legend>Autres critères</legend><?php echo $this->Form->input('Search.tag', array('div' => false, 'label' => false, 'options' => $searchFormOptions['Tags'], 'multiple' => 'checkbox', 'class' => 'checkbox changeListener')); ?></fieldset>
                   
                    </div>
               </div>
                </div>
            </div>


        </div>
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-8">
                    <div id="count" class="label  label-primary"></div>
                </div>
                <div class="col-md-4 ">

                    <?php echo $this->Form->button('<i class="fa fa-search"></i>', array('type' => 'submit', 'class' => 'search btn btn-primary pull-right', 'id' => 'searchFormSubmit', 'escape' => false)); ?> 

                </div>
            </div>
        </div>
    </div>
</div>




<?php echo $this->Form->end(); ?>