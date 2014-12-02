<?php $this->extend('Common/dashboard'); ?>
<?php echo $this->Html->script('Administration.ric.tabwizard'); ?>
<?php echo $this->Html->script('Administration.ric.medias'); ?>
<?php echo $this->Html->script('Administration.plupload/plupload.full.min'); ?>
<?php echo $this->Html->script('Administration.ric.fetchExternalMedia'); ?>


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
            Ric.selectMedias('ImageAdd');
            Ric.selectMedias('DocAdd');
            Ric.selectMedias('ExternalMediaAdd');
     
        });
    </script>  
<?php $bufferedEvenement=$this->request->data; ?>

    <div id="rootwizard">
        <ul class="nav nav-tabs" id ="tabs">
            <li class="active"><a href="#coordonnees" data-toggle="tab">Informations générales</a></li>
            <li><a href="#description" data-toggle="tab">Description</a></li>
            <li><a href="#images" data-toggle="tab">Images</a></li>
            <li><a href="#documents" data-toggle="tab">Documents</a></li>
            <li><a href="#ext_medias" data-toggle="tab">Médias externes</a></li>
        </ul>
        <?php echo $this->Form->create('BufferedEvenement', array('class' => 'form-horizontal', 'role' => 'form')); ?>   
        <div class="tab-content">
            <?php debug($this->data['BufferedEvenement']); ?>
            <div class="tab-pane active" id="coordonnees">
                <div class="input"><?php echo $this->Form->hidden('BufferedEvenement.id'); ?></div>
                <div class="input"><?php echo $this->Form->hidden('BufferedEvenement.evenement_id'); ?></div>
                 <?php debug($this->request->data); ?>
                <?php echo $this->element('Agenda/link_to_ficheactivite',array('bufferedFicheactivite'=>$this->request->data['BufferedFicheactivite'])); ?>   

                <div class="form-group">
                    <?php echo $this->Form->label('BufferedEvenement.nom_complet', 'Nom', 'col-md-2 control-label'); ?>

                    <div class="col-md-4 ">

                        <?php echo $this->Form->input('BufferedEvenement.nom_complet', array('label' => false, 'placeholder' => 'Nom', 'class' => 'form-control')); ?>
                    </div> 
                </div>
                
                    
               
<div class="row">
                    <div class="col-md-6">
                         <div class="input"><?php echo $this->Form->hidden('BufferedEvenement.master'); ?></div>
                        <?php echo $this->Form->button('Enregistrer', array('type' => 'submit', 'class' => 'search btn btn-primary pull-right', 'id' => 'submit')); ?> 
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
                         <div class="input"><?php echo $this->Form->hidden('BufferedEvenement.master'); ?></div>
                        <?php echo $this->Form->button('Enregistrer', array('type' => 'submit', 'class' => 'search btn btn-primary pull-right', 'id' => 'submit')); ?> 
                    </div>

                </div>  
              



            </div>
            <?php echo $this->Form->end(); ?>
             <div class="tab-pane" id="images">
                 <div class="bs-callout bs-callout-info">
                <?php if ($allImages['total'] === 0): ?>
                    <h4>Vous n'avez pas d'images associées à votre profil !</h4>
                    
                <?php else: ?>
                    <h4>Sélectionnez les images</h4>
                    <p>La première image sera affichée comme vignette<br/>
                    <small>les éléments sont sauvegardés automatiquement</small></p>
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
                            <?php echo $this->Form->create('BufferedEvenementImage', array('url' => array('controller' => 'BufferedEvenements', 'action' => 'updateMedia'),'data-role'=>'updateMedia')); ?>
                            <div class="panel-body selected connectedSortable">
                                  
                                <?php foreach ($bufferedEvenement['BufferedEvenementImage'] as $bufferedEvenementImage): ?>

                                    <?php echo $this->element('media', array('foreign_key' => $bufferedEvenement['BufferedEvenement']['id'], 'media' => $bufferedEvenementImage, 'model' => 'BufferedEvenement', 'category' => 'Image')); ?>
                                <?php endforeach; ?>
                                <?php echo $this->Form->input('BufferedEvenement.foreign_key', array('type'=>'hidden','value'=>$bufferedEvenement['BufferedEvenement']['id']));?>
                                 <?php echo $this->Form->input('BufferedEvenement.category', array('type'=>'hidden','value'=>'Image'));?>
                            </div>
                            <?php echo $this->Form->end(); ?>
                        </div>  
                    </div>
                    <div class="col-md-6 ">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Images disponibles</h3>
                            </div>
                            <div class="panel-body unselected connectedSortable"  id="available_images">
                                
                                <?php foreach ($allImages['available'] as $image): ?>

                                    <?php echo $this->element('media', array('foreign_key' => $bufferedEvenement['BufferedEvenement']['id'], 'media' => $image, 'model' => 'BufferedEvenement', 'category' => 'Image' ,'displayActions'=>true)); ?>
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
                            <?php echo $this->Form->create('BufferedEvenement', array('url' => array('controller' => 'BufferedEvenements', 'action' => 'updateMedia'))); ?>
                            <div class="panel-body selected connectedSortable">
                                   
                              
                                <?php echo $this->Form->input('BufferedEvenement.foreign_key', array('type'=>'hidden','value'=>$bufferedEvenement['BufferedEvenement']['id']));?>
                            
                                <?php echo $this->Form->input('BufferedEvenement.category', array('type'=>'hidden','value'=>'Document'));?>
                                <?php foreach ($bufferedEvenement['BufferedEvenementDocument'] as $bufferedEvenementDocument): ?>

                                     <?php echo $this->element('media', array('foreign_key' => $bufferedEvenement['BufferedEvenement']['id'], 'media' => $bufferedEvenementDocument, 'model' => 'BufferedEvenement', 'category' => 'Document','displayActions'=>true)); ?>
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
                                    <?php echo $this->element('media', array('foreign_key' => $bufferedEvenement['BufferedEvenement']['id'], 'media' => $document, 'model' => 'BufferedEvenement', 'category' => 'Document','displayActions'=>true)); ?>
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
                                <h3 class="panel-title">Medias externes selectionnés</h3>
                            </div>
                            <?php echo $this->Form->create('BufferedEvenement', array('url' => array('controller' => 'BufferedEvenements', 'action' => 'updateMedia'))); ?>
                            <div class="panel-body selected connectedSortable">
                                   
                              
                               
                                <?php foreach ($bufferedEvenement['BufferedEvenementExternalMedia'] as $bufferedEvenementExternalMedia): ?>
                                    <?php echo $this->element('ext_media', array('foreign_key' =>$bufferedEvenement['BufferedEvenement']['id'], 'ext_media' => $bufferedEvenementExternalMedia, 'model' => 'BufferedEvenement', 'category' => 'ExternalMedia','displayActions'=>true)); ?>
                            
                                         <?php endforeach; ?>
                                    <?php echo $this->Form->input('BufferedEvenement.foreign_key', array('type'=>'hidden','value'=>$bufferedEvenement['BufferedEvenement']['id']));?>
                                    <?php echo $this->Form->input('BufferedEvenement.category', array('type'=>'hidden','value'=>'ExternalMedia'));?>
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
                               <?php //debug($allDocuments); ?>
                                <?php foreach ($allExternalMedias['available'] as $externalMedia): ?>
                                    <?php echo $this->element('ext_media', array('foreign_key' => $bufferedEvenement['BufferedEvenement']['id'], 'ext_media' => $externalMedia, 'model' => 'BufferedEvenement', 'category' => 'ExternalMedia','displayActions'=>true)); ?>
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

    
<?php endif; ?>