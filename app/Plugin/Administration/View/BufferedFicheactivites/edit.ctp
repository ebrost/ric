<?php $this->extend('Common/dashboard'); ?>
<?php echo $this->Html->script('Administration.ric.addresspicker'); ?>
<?php echo $this->Html->script('Administration.ric.tabwizard'); ?>
<?php echo $this->Html->script('Administration.plupload/plupload.full.min'); ?>
<?php echo $this->Html->script('Administration.ric.medias'); ?>
<?php echo $this->Html->script('Administration.ric.fetchExternalMedia'); ?>

<script type="text/javascript">
    
    $(function() {
        Ric.tabWizard('#rootwizard',"<?php echo $this->Html->url(array( 'controller' => 'BufferedFicheactivites','action'=>'checkValidation',$bufferedFicheactivite['BufferedFicheactivite']['id']), true ); ?>",false);
        Ric.addressPicker('#map_container','#address_fields');
        Ric.selectMedias('ImageAdd');
        Ric.selectMedias('DocAdd');
        Ric.selectMedias('ExternalMediaAdd');
    });
   </script>
<?php echo $this->Form->create('BufferedFicheactivite', array('action' => 'edit', 'class' => 'form-horizontal', 'role' => 'form')); ?>

<div id="rootwizard">
    <ul class="nav nav-tabs" id ="tabs">
        <li class="active" ><a href="#coordonnees" data-toggle="tab">Coordonnées</a></li>
        <li ><a href="#description" data-toggle="tab">Activité(s)</a></li>
        <li><a href="#info_complementaires" data-toggle="tab">Informations complémentaires</a></li>
        <li><a href="#images" data-toggle="tab">Images</a></li>
        <li><a href="#documents" data-toggle="tab">Documents</a></li>
        <li><a href="#ext_medias" data-toggle="tab">Médias externes</a></li>
    </ul>

    <div class="tab-content">
        <?php //echo $this->Form->create('BufferedFicheactivite', array('url' => 'edit', 'class' => 'form-horizontal', 'role' => 'form')); ?>
        <?php echo $this->Form->hidden('BufferedFicheactivite.id'); ?>
        <div class="tab-pane active" id="coordonnees">
               
            <div class="form-group">
                <?php echo $this->Form->label('BufferedFicheactivite.nom_complet', 'Nom', 'col-md-2 control-label'); ?>
                <div class="col-md-4 ">

                    <?php echo $this->Form->input('BufferedFicheactivite.nom_complet', array('label' => false, 'placeholder' => 'Nom', 'class' => 'form-control')); ?>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-6 ">
                   <div id="address_fields">
                    <div class="form-group">
                        <?php echo $this->Form->label('BufferedFicheactivite.adresse', 'Adresse complete', 'col-md-4  control-label'); ?>
                        <div class="col-md-8 ">
                            <?php echo $this->Form->input('BufferedFicheactivite.adresse', array('type' => 'textarea', 'label' => false, 'data-element' => 'street_address', 'placeholder' => 'Adresse', 'class' => 'form-control')); ?>
                        </div> 
                    </div>

                    <div class="form-group">
                        <?php echo $this->Form->label('BufferedFicheactivite.code_postal', 'Code postal', 'col-md-4 control-label'); ?>
                        <div class="col-md-8 ">

                            <?php echo $this->Form->input('BufferedFicheactivite.code_postal', array('label' => false, 'data-element' => 'code_postal', 'placeholder' => 'Code postal', 'class' => 'form-control')); ?>
                        </div> 
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->label('BufferedFicheactivite.ville', 'Ville', 'col-md-4 control-label'); ?>
                        <div class="col-md-8 ">

                            <?php echo $this->Form->input('BufferedFicheactivite.ville', array('label' => false, 'data-element' => 'ville', 'placeholder' => 'Ville', 'class' => 'form-control')); ?>
                        </div> 
                    </div>
                       <div class="form-group">
                        <?php echo $this->Form->label('BufferedFicheactivite.cedex_pays', 'Cedex', 'col-md-4 control-label'); ?>
                    <div class="col-md-8 ">

                            <?php echo $this->Form->input('BufferedFicheactivite.cedex_pays', array('label' => false,  'placeholder' => 'Cedex', 'class' => 'form-control')); ?>
                    </div> 
                </div>
                   
                   </div>
                <div class="form-group">
                    <?php echo $this->Form->label('BufferedFicheactivite.email', 'Email', 'col-md-4 control-label'); ?>
                    <div class="col-md-8 ">
                <?php echo $this->Form->input('BufferedFicheactivite.email', array('label' => false, 'placeholder' => 'Email', 'class' => 'form-control')); ?>
                    </div> 
           </div>
            <div class="form-group">
                    <?php echo $this->Form->label('BufferedFicheactivite.url_site_web', 'Internet', 'col-md-4 control-label'); ?>
                    <div class="col-md-8 ">
                <?php echo $this->Form->input('BufferedFicheactivite.url_site_web', array('label' => false, 'placeholder' => 'Internet', 'class' => 'form-control')); ?>
                    </div> 
           </div>
           <div class="form-group">
                    <?php echo $this->Form->label('BufferedFicheactivite.telephone', 'Téléphone', 'col-md-4 control-label'); ?>
                    <div class="col-md-8 ">
                <?php echo $this->Form->input('BufferedFicheactivite.telephone', array('label' => false, 'placeholder' => 'Téléphone', 'class' => 'form-control')); ?>
                    </div> 
           </div>
           <div class="form-group">
                    <?php echo $this->Form->label('BufferedFicheactivite.telephone_2', 'Téléphone 2', 'col-md-4 control-label'); ?>
                    <div class="col-md-8 ">
                <?php echo $this->Form->input('BufferedFicheactivite.telephone_2', array('label' => false, 'placeholder' => 'Téléphone 2', 'class' => 'form-control')); ?>
                    </div> 
           </div>
            <div class="form-group">
                    <?php echo $this->Form->label('BufferedFicheactivite.telecopie', 'Télécopie', 'col-md-4 control-label'); ?>
                    <div class="col-md-8 ">
                <?php echo $this->Form->input('BufferedFicheactivite.telecopie', array('label' => false, 'placeholder' => 'Télécopie', 'class' => 'form-control')); ?>
                    </div> 
           </div>
            <div class="row">
                    <div class="col-md-12">
                         <?php echo $this->Form->button('Enregistrer' ,array('type'=>'submit','class'=>'search btn btn-primary pull-right','id'=>'submit')); ?> 
                    </div>
                    
                </div> 
                 
                </div>

                <div class=" col-md-6">
                    <div id ="map_container">
                    <div class="well">
                         <div  class="form-group   ">
                        <?php echo $this->Form->label('addresspicker', 'Adresse à géolocaliser', 'col-md-4  control-label'); ?>
                        <div class="col-md-8 ">
                            <?php echo $this->Form->input('addresspicker', array('label' => false, 'placeholder' => 'Adresse à géolocaliser', 'data-element' => 'addresspicker', 'class' => 'form-control')); ?>
                        </div> 
                    </div>
                        <div class="map" ></div>
                        <div class="row"> 
                            <?php echo $this->Form->label('BufferedFicheactivite.latitude', 'Latitude', 'col-md-2 control-label'); ?>
                            <div class="col-xs-2 ">

                                <?php echo $this->Form->input('BufferedFicheactivite.latitude', array('label' => false, 'type' => 'text', 'data-element' => 'latitude', 'readonly' => 'readonly', 'class' => 'form-control')); ?>
                            </div> 

                            <?php echo $this->Form->label('BufferedFicheactivite.longitude', 'Longitude', 'col-md-2 control-label'); ?>
                            <div class="col-xs-2 ">

                                <?php echo $this->Form->input('BufferedFicheactivite.longitude', array('label' => false, 'type' => 'text', 'data-element' => 'longitude', 'readonly' => 'readonly', 'class' => 'form-control')); ?>
                            </div> 
                        </div>
                        <span id="legend" class="alert alert-info">Vous pouvez modifier votre position en déplaçant le marqueur</span>
                    </div></div>

                </div>
               
            </div>
        </div>
        <div class="tab-pane" id="description">
                 <div class="form-group">
                <?php echo $this->Form->label('BufferedFicheactivite.commentaires', 'Présentation générale', 'col-md-2 control-label'); ?>
                <div class="col-md-4 ">

                    <?php echo $this->Form->input('BufferedFicheactivite.commentaires', array('label' => false,  'placeholder' => 'commentaires', 'class' => 'form-control')); ?>
                </div> 
            </div>
            <div class="form-group">
                <?php echo $this->Form->label('BufferedFicheactivite.activites', 'Activites', 'col-md-2 control-label'); ?>
                <div class="col-md-4 ">

                    <?php echo $this->Form->input('BufferedFicheactivite.activites', array('label' => false, 'data-element' => 'activites', 'placeholder' => 'Activites', 'class' => 'form-control')); ?>
                </div> 
            </div>
              <div class="form-group">
                <?php echo $this->Form->label('BufferedFicheactivite.precision_activites', 'Précision(s)', 'col-md-2 control-label'); ?>
                <div class="col-md-4 ">

                    <?php echo $this->Form->input('BufferedFicheactivite.precision_activites', array('label' => false, 'data-element' => 'activites', 'placeholder' => 'Précision(s)', 'class' => 'form-control')); ?>
                </div> 
            </div>
            <div class="row">
                    <div class="col-md-6">
                         <?php echo $this->Form->button('Enregistrer' ,array('type'=>'submit','class'=>'search btn btn-primary pull-right','id'=>'submit')); ?> 
                    </div>
                    
                </div> 
        
        </div>
        
    <div class="tab-pane" id="info_complementaires">
        
<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.annee_creation', 'année de création', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.annee_creation', array('label' => false,  'placeholder' => 'année de création', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.forme_juridique', 'forme juridique', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.forme_juridique', array('label' => false,  'placeholder' => 'forme juridique', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.jauge', 'jauge', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.jauge', array('label' => false,  'placeholder' => 'jauge', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.capacite', 'capacité', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.capacite', array('label' => false,  'placeholder' => 'capacité', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.scene', 'scène', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.scene', array('label' => false,  'placeholder' => 'scène', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.revetement', 'revêtement', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.revetement', array('label' => false,  'placeholder' => 'revêtement', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.annee_construction', 'année de construction', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.annee_construction', array('label' => false,  'placeholder' => 'année de construction', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.fosse_orchestre', 'fosse d\'orchestre', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.fosse_orchestre', array('label' => false,  'placeholder' => 'fosse d\'orchestre', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.capacite_assise', 'capacité assise', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.capacite_assise', array('label' => false,  'placeholder' => 'capacité assise', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.capacite_debout', 'capacité debout', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.capacite_debout', array('label' => false,  'placeholder' => 'capacité debout', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.scene_superficie', 'superficie de la scène', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.scene_superficie', array('label' => false,  'placeholder' => 'superficie de la scène', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.salle_superficie', 'superficie de la salle', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.salle_superficie', array('label' => false,  'placeholder' => 'superficie de la salle', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.effectif_artistique', 'effectif artistique', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.effectif_artistique', array('label' => false,  'placeholder' => 'effectif artistique', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.composition', 'composition', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.composition', array('label' => false,  'placeholder' => 'composition', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.periodicite', 'periodicité', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.periodicite', array('label' => false,  'placeholder' => 'periodicité', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.periode_realisation', 'periode de réalisation', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.periode_realisation', array('label' => false,  'placeholder' => 'periode de réalisation', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.periode_preparation', 'période de préparation', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.periode_preparation', array('label' => false,  'placeholder' => 'période de préparation', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.numero_agrement', 'numéro d\'agrément', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.numero_agrement', array('label' => false,  'placeholder' => 'numéro d\'agrément', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.effectif_audience', 'effectif audience', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.effectif_audience', array('label' => false,  'placeholder' => 'effectif audience', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.capacite_accueil', 'capacité d\'accueil', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.capacite_accueil', array('label' => false,  'placeholder' => 'capacité d\'accueil', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.rcr', 'rcr', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.rcr', array('label' => false,  'placeholder' => 'rcr', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.mode_gestion', 'mode de gestion', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.mode_gestion', array('label' => false,  'placeholder' => 'mode de gestion', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.surface_m2', 'surface(m2)', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.surface_m2', array('label' => false,  'placeholder' => 'surface(m2)', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.acces_internet', 'accès internet', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.acces_internet', array('label' => false,  'placeholder' => 'accès internet', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.bibliobus', 'bibliobus', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.bibliobus', array('label' => false,  'placeholder' => 'bibliobus', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.liseuse', 'liseuse', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.liseuse', array('label' => false,  'placeholder' => 'liseuse', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.equipement_public_hand', 'équipement public handicapé', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.equipement_public_hand', array('label' => false,  'placeholder' => 'équipement public handicapé', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.intervention_aupres_pub', 'intervention auprès des publics', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.intervention_aupres_pub', array('label' => false,  'placeholder' => 'intervention auprès des publics', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.surface_totale', 'surface totale', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.surface_totale', array('label' => false,  'placeholder' => 'surface totale', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.surface_livre', 'surface livre', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.surface_livre', array('label' => false,  'placeholder' => 'surface livre', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.nbr_reference', 'nombre de références', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.nbr_reference', array('label' => false,  'placeholder' => 'nombre de références', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.informatisation', 'informatisation', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.informatisation', array('label' => false,  'placeholder' => 'informatisation', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.vente_en_ligne', 'vente en ligne', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.vente_en_ligne', array('label' => false,  'placeholder' => 'vente en ligne', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.gencod', 'gencod', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.gencod', array('label' => false,  'placeholder' => 'gencod', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.nbr_titre_catalogue', 'nombre de titres au catalogue', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.nbr_titre_catalogue', array('label' => false,  'placeholder' => 'nombre de titres au catalogue', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.nbr_publication', 'nombre de publications', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.nbr_publication', array('label' => false,  'placeholder' => 'nombre de publications', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.auto_diffusion', 'auto diffusion', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.auto_diffusion', array('label' => false,  'placeholder' => 'auto diffusion', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.auto_distribution', 'auto distribution', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.auto_distribution', array('label' => false,  'placeholder' => 'auto distribution', 'class' => 'form-control')); ?>
</div>
</div>


<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.siret', 'siret', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.siret', array('label' => false,  'placeholder' => 'siret', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.apenaf', 'apenaf', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.apenaf', array('label' => false,  'placeholder' => 'apenaf', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.telephone_billeterie', 'téléphone billeterie', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.telephone_billeterie', array('label' => false,  'placeholder' => 'téléphone billeterie', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.genres', 'genres', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.genres', array('label' => false,  'placeholder' => 'genres', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.disciplines', 'disciplines', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.disciplines', array('label' => false,  'placeholder' => 'disciplines', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.localisations', 'localisations', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.localisations', array('label' => false,  'placeholder' => 'localisations', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.precision_activites', 'precision_activites', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.precision_activites', array('label' => false,  'placeholder' => 'precision_activites', 'class' => 'form-control')); ?>
</div>
</div>

<div class="form-group">
<?php echo $this->Form->label('BufferedFicheactivite.type_public', 'type_public', 'col-md-2 control-label'); ?>
<div class="col-md-4 ">
<?php echo $this->Form->input('BufferedFicheactivite.type_public', array('label' => false,  'placeholder' => 'type_public', 'class' => 'form-control')); ?>
</div>
</div>

 <div class="row">
                    <div class="col-md-6">
                         <?php echo $this->Form->button('Enregistrer' ,array('type'=>'submit','class'=>'search btn btn-primary pull-right','id'=>'submit')); ?> 
                    </div>
                    
                </div> 
        
    </div>
   
        <?php echo $this->Form->input('BufferedFicheactivite.ficheactivite_id', array('type' => 'hidden')); ?>
        <?php echo $this->Form->end(); ?>
        <div class="tab-pane" id="images">




            <div class="bs-callout bs-callout-info">
                <?php if ($allImages['total'] === 0): ?>
                    <h4>Vous n'avez pas d'images associées à votre profil !</h4>
                <?php else: ?>
                    <h4>Sélectionnez les images</h4>
                    <p>La première image sera affichée comme vignette<br/>
                    <small>les éléments sont sauvegardés automatiquement</small>
                    </p>
                    <?php endif; ?>
                    <?php echo $this->element('upload_modal',array('button_text'=>'ajouter des images à ma bibliohèque','element'=>'add_images','filelist'=>"available_images")); ?>
                

            </div>


            <div class="row">
                <div id="ImageAdd" class="selectMedias">
                    <div class=" col-md-6  ">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Images selectionnées<span class="loading"> <i class="fa fa-refresh fa-spin"></i></span></h3>
                            </div>
                            <?php echo $this->Form->create('BufferedFicheactiviteImage', array('url' => array('controller' => 'BufferedFicheactivites', 'action' => 'updateMedia'),'data-role'=>'updateMedia')); ?>
                            <div class="panel-body selected connectedSortable">
                                  
                                <?php foreach ($bufferedFicheactivite['BufferedFicheactiviteImage'] as $bufferedFicheactiviteImage): ?>

                                    <?php echo $this->element('media', array('foreign_key' => $bufferedFicheactivite['BufferedFicheactivite']['id'], 'media' => $bufferedFicheactiviteImage, 'model' => 'BufferedFicheactivite', 'category' => 'Image','displayActions'=>true)); ?>
                                <?php endforeach; ?>
                                <?php echo $this->Form->input('BufferedFicheactivite.foreign_key', array('type'=>'hidden','value'=>$bufferedFicheactivite['BufferedFicheactivite']['id']));?>
                                 <?php echo $this->Form->input('BufferedFicheactivite.category', array('type'=>'hidden','value'=>'Image'));?>
                            </div>
                            <?php echo $this->Form->end(); ?>
                        </div>  
                    </div>
                    <div class="col-md-6 ">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Images disponibles</h3>
                       </div>
                            <div class="panel-body unselected connectedSortable" id="available_images">
                                
                                <?php foreach ($allImages['available'] as $image): ?>

                                    <?php echo $this->element('media', array('foreign_key' => $bufferedFicheactivite['BufferedFicheactivite']['id'], 'media' => $image, 'model' => 'BufferedFicheactivite', 'category' => 'Image' ,'displayActions'=>true)); ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="documents">
            

           


            <div class="bs-callout bs-callout-info">
                <?php if ($allDocuments['total'] === 0): ?>
                    <h4>Vous n'avez pas de documents associées à votre profil !</h4>
                  
                <?php else: ?>
                    <h4>Sélectionnez les documents</h4>
                    <p><small>les éléments sont sauvegardés automatiquement</small></p>
                <?php endif; ?>
                  
                <?php echo $this->element('upload_modal',array('button_text'=>'ajouter des documents à ma bibliohèque','element'=>'add_documents','filelist'=>"available_documents")); ?>
          
            </div>


            <div class="row">
                <div id="DocAdd" class="selectMedias">
                    <div class=" col-md-6  ">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Documents selectionnés<span class="loading"> <i class="fa fa-refresh fa-spin"></i></span></h3>
                            </div>
                            <?php echo $this->Form->create('BufferedFicheactivite', array('url' => array('controller' => 'BufferedFicheactivites', 'action' => 'updateMedia'))); ?>
                            <div class="panel-body selected connectedSortable">
                                   
                              
                                <?php echo $this->Form->input('BufferedFicheactivite.foreign_key', array('type'=>'hidden','value'=>$bufferedFicheactivite['BufferedFicheactivite']['id']));?>
                            
                                <?php echo $this->Form->input('BufferedFicheactivite.category', array('type'=>'hidden','value'=>'Document'));?>
                                <?php foreach ($bufferedFicheactivite['BufferedFicheactiviteDocument'] as $bufferedFicheactiviteDocument): ?>
                      
                                    <?php echo $this->element('media', array('foreign_key' => $bufferedFicheactivite['BufferedFicheactivite']['id'], 'media' => $bufferedFicheactiviteDocument, 'model' => 'BufferedFicheactivite', 'category' => 'Document','displayActions'=>true)); ?>
                                <?php endforeach; ?>
                            </div>
                            <?php echo $this->Form->end(); ?>
                        </div>  
                    </div>
                    <div class="col-md-6 ">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Documents disponibles</h3>
                            </div>
                            <div class="panel-body unselected connectedSortable" id="available_documents">
                               <?php //debug($allDocuments); ?>
                                <?php foreach ($allDocuments['available'] as $document): ?>

                                    <?php echo $this->element('media', array('foreign_key' => $bufferedFicheactivite['BufferedFicheactivite']['id'], 'media' => $document, 'model' => 'BufferedFicheactivite', 'category' => 'Document','displayActions'=>true)); ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="ext_medias">
            
            
             <div class="bs-callout bs-callout-info">
                <?php if ($allExternalMedias['total'] === 0): ?>
                    <h4>Vous n'avez pas de medias externes associées à votre profil !</h4>
                    
                <?php else: ?>
                    <h4>Sélectionnez les médias externes</h4>
                    <p><small>les éléments sont sauvegardés automatiquement</small></p>
                <?php endif; ?>
            <?php echo $this->element('upload_modal',array('button_text'=>'ajouter des médias externes à ma bibliohèque','element'=>'add_externals_medias','filelist'=>"available_ext_medias")); ?>
          
            </div>


            <div class="row">
                <div id="ExternalMediaAdd" class="selectMedias">
                    <div class=" col-md-6  ">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Medias externes selectionnés<span class="loading"> <i class="fa fa-refresh fa-spin"></i></span></h3>
                            </div>
                            <?php echo $this->Form->create('BufferedFicheactivite', array('url' => array('controller' => 'BufferedFicheactivites', 'action' => 'updateMedia'))); ?>
                            <div class="panel-body selected connectedSortable">
                                   
                              
                               
                                <?php foreach ($bufferedFicheactivite['BufferedFicheactiviteExternalMedia'] as $bufferedFicheactiviteExternalMedia): ?>
                               
                                    <?php echo $this->element('ext_media', array('foreign_key' => $bufferedFicheactivite['BufferedFicheactivite']['id'], 'ext_media' => $bufferedFicheactiviteExternalMedia, 'model' => 'BufferedFicheactivite', 'category' => 'ExternalMedia','displayActions'=>true)); ?>
                                <?php endforeach; ?>
                                    <?php echo $this->Form->input('BufferedFicheactivite.foreign_key', array('type'=>'hidden','value'=>$bufferedFicheactivite['BufferedFicheactivite']['id']));?>
                                    <?php echo $this->Form->input('BufferedFicheactivite.category', array('type'=>'hidden','value'=>'ExternalMedia'));?>
                            </div>
                            <?php echo $this->Form->end(); ?>
                        </div>  
                    </div>
                    <div class="col-md-6 ">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Médias externes disponibles</h3>
                            </div>
                            <div class="panel-body unselected connectedSortable" id="available_ext_medias">

                                <?php foreach ($allExternalMedias['available'] as $externalMedia): ?>

                                    <?php echo $this->element('ext_media', array('foreign_key' => $bufferedFicheactivite['BufferedFicheactivite']['id'], 'ext_media' => $externalMedia, 'model' => 'BufferedFicheactivite', 'category' => 'ExternalMedia','displayActions'=>true)); ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class=" col-md-6">

            <ul class=" wizard  pager prev-next ">
                 <li class="previous"><a href="#" name='previous' >Précédent</a></li> 
                <li class="next"><a href="#"  name='next' >Suivant</a></li>             
                    
               
           </ul>
        </div>
    </div>
</div>           

