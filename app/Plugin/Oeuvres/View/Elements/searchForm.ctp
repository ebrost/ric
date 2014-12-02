<?php echo $this->Html->script('searchActions', array('block' => 'script')); ?>
<?php echo $this->Form->create('Ficheoeuvre', array('action' => 'search', 'class' => 'searchForm well')); ?>
<h4>
    <i class="fa fa-search"></i> 
    Rechercher une œuvre</h4>
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
                    <?php echo $this->Form->input('Search.name', array('div' => false, 'label' => false, 'class' => 'form-control changeListener', 'placeholder' => 'Nom')); ?>
                    <?php echo $this->Form->input('Search.auteur', array('div' => false, 'label' => false, 'class' => 'form-control changeListener', 'placeholder' => 'Auteur')); ?>
                    <?php echo $this->Form->input('Search.editeur', array('div' => false, 'label' => false, 'class' => 'form-control changeListener', 'placeholder' => 'Editeur')); ?>
                    <?php echo $this->Form->input('Search.traducteur', array('div' => false, 'label' => false, 'class' => 'form-control changeListener', 'placeholder' => 'Traducteur')); ?>
                    <?php echo $this->Form->input('Search.illustrateur', array('div' => false, 'label' => false, 'class' => 'form-control changeListener', 'placeholder' => 'Illustrateur')); ?>
                    <?php echo $this->Form->input('Search.isbn', array('div' => false, 'label' => false, 'class' => 'form-control changeListener', 'placeholder' => 'isbn')); ?>
                    <?php echo $this->Form->input('Search.anneeedition', array('div' => false, 'label' => false, 'class' => 'form-control changeListener', 'placeholder' => 'Année')); ?>
                    <?php echo $this->Form->input('Search.nomcollection', array('div' => false, 'label' => false, 'class' => 'form-control changeListener', 'placeholder' => 'Collection')); ?>



                </div>
                <div class="col-md-4">

                    <div id="activites" >
                        <?php echo $this->Form->input('Search.activite', array('div' => false, 'label' => false, 'class' => 'form-control changeListener', 'escape' => false, 'options' => $searchFormOptions['activite'], 'empty' => 'Activité')); ?>

                    </div>

                    <div id="prix" >
                        <?php echo $this->Form->input('Search.prix', array('div' => false, 'label' => false, 'class' => 'form-control changeListener', 'escape' => false, 'options' => $searchFormOptions['prix'], 'empty' => 'Prix')); ?>

                    </div>
                    <div id="jauge" >
                        <?php echo $this->Form->input('Search.jauge', array('div' => false, 'label' => false, 'class' => 'form-control changeListener', 'escape' => false, 'options' => $searchFormOptions['jauge'], 'empty' => 'Jauge')); ?>

                    </div>
                    <div id="duree" >
                        <?php echo $this->Form->input('Search.duree', array('div' => false, 'label' => false, 'class' => 'form-control changeListener', 'escape' => false, 'options' => $searchFormOptions['duree'], 'empty' => 'Duree')); ?>

                    </div>
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

                    <?php echo $this->Form->input('Search.implantation', array('div' => false, 'label' => false, 'options' => $searchFormOptions['implantations'], 'empty' => 'Région / Département', 'class' => 'form-control changeListener')); ?>

                </div>
            </div>
            <div id="genres" >
                <div class="row">
                <div class="col-md-12">
                        <fieldset><legend>Genres</legend><?php echo $this->Form->input('Search.genre', array('div' => false, 'label' => false, 'options' => $searchFormOptions['genre'], 'multiple' => 'checkbox', 'class' => 'checkbox changeListener col-md-3')); ?></fieldset>
                    </div>
                </div>
            </div>
             <div id="disciplines" >
                <div class="row">
                <div class="col-md-12">
                        <fieldset><legend>Disciplines</legend><?php echo $this->Form->input('Search.discipline', array('div' => false, 'label' => false, 'options' => $searchFormOptions['discipline'], 'multiple' => 'checkbox', 'class' => 'checkbox changeListener col-md-3')); ?></fieldset>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <fieldset><legend>Publics</legend><?php echo $this->Form->input('Search.typepublic', array('div' => false, 'label' => false, 'options' => $searchFormOptions['typepublics'], 'multiple' => 'checkbox', 'class' => 'checkbox changeListener')); ?></fieldset>
                </div>
                <div class="col-md-6">
                    <fieldset><legend>Types d'oeuvre</legend><?php echo $this->Form->input('Search.typeoeuvre', array('div' => false, 'label' => false, 'options' => $searchFormOptions['typeoeuvre'], 'multiple' => 'checkbox', 'class' => 'checkbox changeListener')); ?></fieldset>
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
                <div class="col-md-8">
                    <div id="count" class="label  label-primary"></div>
                </div>
                <div class="col-md-4">

                    <?php echo $this->Form->button('<i class="fa fa-search"></i>', array('type' => 'submit', 'class' => 'search btn btn-primary pull-right', 'id' => 'searchFormSubmit', 'escape' => false)); ?> 

                </div>
            </div>
        </div>
    </div>
</div>




<?php echo $this->Form->end(); ?>