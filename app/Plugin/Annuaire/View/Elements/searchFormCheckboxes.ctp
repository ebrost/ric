<?php echo $this->Html->script('searchActions', array('block' => 'script')); ?>
<?php echo $this->Form->create('Ficheactivite', array('action' => 'search', 'class' => 'searchForm well')); ?>
<h4>
    <i class="fa fa-search"></i> 
    Rechercher un acteur culturel </h4>
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
                    <?php echo $this->Form->input('Search.nom_complet', array('div'=>false,'label'=>false,'class'=>'form-control changeListener','placeholder'=>'Nom'));?>
                    <?php echo $this->Form->input('Search.contact', array('div' => false, 'label' => false, 'class' => 'form-control changeListener', 'placeholder' => 'Nom du contact')); ?>

                </div>

                <div class="col-md-4">
                    <?php echo $this->Form->input('Search.commune', array('div' => false, 'label' => false, 'class' => 'form-control changeListener', 'autocomplete' => 'off', 'placeholder' => 'Ville')); ?>
                    <?php echo $this->Form->hidden('Search.commune_id'); ?>
                    <div id="communes-radius-container">
                        <div id="commune-radius-amount" style="margin:0 0 0.5em 0.6em;width:200px">
                            <label for="amount">dans un rayon de </label><?php echo $this->Form->input('Search.radius', array('div' => false, 'label' => false, 'class' => 'changeListener', 'readonly' => true)); ?> km
                            <div id="communes-radius" style="width:200px" ></div>
                        </div>
                    </div>

                    <?php echo $this->Form->input('Search.bassin_populations', array('div' => false, 'label' => false, 'options' => $searchFormOptions['bassinsPopulation'], 'empty' => 'Bassin de population', 'class' => 'form-control changeListener')); ?>
                    <?php echo $this->Form->input('Search.communaute_communes', array('div' => false, 'label' => false, 'options' => $searchFormOptions['communautesCommunes'], 'empty' => 'Communauté de communes', 'class' => 'form-control changeListener')); ?>
                    <?php echo $this->Form->input('Search.pays', array('div' => false, 'label' => false, 'options' => $searchFormOptions['pays'], 'empty' => 'Pays', 'class' => 'form-control changeListener')); ?>

                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div id="count" class="label  label-primary"></div>
        </div>
        <div class="col-md-1">
            <?php echo $this->Form->button('<i class="fa fa-search"></i>', array('type' => 'submit', 'class' => 'search btn btn-primary pull-right', 'id' => 'searchFormSubmit', 'escape' => false)); ?> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                
                <div class="panel panel-primary clearfix">
                    <div class="panel-heading"><?php echo $this->Form->label('Search.implantation', 'Implantation(s)'); ?></div>
                    <div id="implantations"class="panel-body" >
                        <div class="form-group">

                            <?php echo $this->Form->input('Search.implantation', array('div' => false, 'label' => false, 'options' => $searchFormOptions['implantations'],  'class' => 'checkbox changeListener col-md-3' , 'multiple' => 'checkbox')); ?>
                        </div>
                    </div>
                </div>
                 <div class="panel panel-primary clearfix">
                    <div class="panel-heading"><?php echo $this->Form->label('Search.activite', 'Activite(s)'); ?></div>
                    <div id="activites"class="panel-body" >
                        <div class="form-group">
                            <?php echo $this->Form->input('Search.activite', array('div' => false, 'label' => false, 'class' => 'checkbox changeListener col-md-3', 'escape' => false, 'options' => $searchFormOptions['activites'], 'multiple' => 'checkbox')); ?>
                        </div>
                    </div>
                </div>
                <div class="panel panel-primary clearfix">
                    <div class="panel-heading"><?php echo $this->Form->label('Search.genre', 'Genre(s)'); ?></div>
                    <div id="genres"class="panel-body" >
                        <div class="form-group">
                            <?php echo $this->Form->input('Search.genre', array('div' => false, 'label' => false, 'class' => 'checkbox changeListener col-md-3', 'escape' => false, 'options' => $searchFormOptions['genres'], 'multiple' => 'checkbox')); ?>
                        </div>
                    </div>
                </div>
                 <div class="panel panel-primary clearfix" >
                    <div class="panel-heading"><?php echo $this->Form->label('Search.discipline', 'Discipline(s)'); ?></div>
                    <div id="disciplines" class="panel-body" >
                        <div class="form-group">
                            <?php echo $this->Form->input('Search.discipline', array('div' => false, 'label' => false, 'class' => 'checkbox changeListener col-md-3', 'escape' => false, 'options' => $searchFormOptions['disciplines'], 'multiple' => 'checkbox')); ?>
                        </div>
                    </div>
                </div>
               

                <div id="disciplines" >
                    <?php if (!empty($optionsDisciplines)) : ?>		
                        <?php echo $this->Form->input('Search.discipline', array('div' => false, 'label' => false, 'class' => 'form-control changeListener', 'options' => $optionsDisciplines, 'empty' => 'Discipline', 'class' => 'changeListener')); ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="tab-content" >
                <div class="tab-pane active" id="recherche-simple">
                </div>
                <div class="tab-pane fade" id="recherche-avancee">

                </div>
            </div>


        </div>
        <div class="col-md-3">
            <div class="row">

            </div>
        </div>
    </div>
</div>




<?php echo $this->Form->end(); ?>