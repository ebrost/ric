<?php $this->extend('Common/dashboard'); ?>
<?php echo $this->Html->script('Administration.ric.addresspicker'); ?>
<?php echo $this->Html->script('Administration.tabs'); ?>
<?php echo $this->Html->script('Administration.plupload/plupload.full.min'); ?>
<?php echo $this->Html->script('Administration.ric.medias'); ?>
<?php echo $this->Html->script('Administration.ric.fetchExternalMedia'); ?>
<script>
    $(function() {
Ric.addressPicker('#map_container','#address_fields');

    });
   </script>
<?php
if (!empty($this->validationErrors['AdministrationUser']) && isset($formName)) {
    $this->validationErrors[$formName] = $this->validationErrors['AdministrationUser'];
}
;
?>
<?php
if (isset($formName) && isset($this->validationErrors[$formName])) {
    debug($this->validationErrors[$formName]);
};
?>
<ul class="nav nav-tabs" id="tabs">
    <li class="active"><a href="#coordonnees" >Coordonnées</a></li>
    <li><a href="#change_password" >Changer mon mot de passe</a></li>
    <li><a href="#images" >Ajouter/supprimer des images</a></li>
     <li><a href="#documents" >Ajouter/supprimer des documents</a></li>
      <li><a href="#ext_medias" >Ajouter/supprimer des medias externes</a></li>

</ul>

<div class="tab-content">

    <div class="tab-pane active" id="coordonnees">

        <div class="form-group">

            <div class="row">
<?php echo $this->Form->create('AdministrationUserEdit', array('url' => array('controller' => 'administration_users', 'action' => 'edit'), 'class' => 'form-horizontal', 'role' => 'form')); ?>
                <div class="col-md-6 ">
                   <div id="address_fields">
                    <div class="form-group">
<?php echo $this->Form->label('adresse', 'Adresse complete', 'col-md-4  control-label'); ?>
                        <div class="col-md-8 ">
                        <?php echo $this->Form->input('adresse', array('type' => 'textarea', 'label' => false, 'data-element' => 'street_address', 'placeholder' => 'Adresse', 'class' => 'form-control')); ?>
                        </div> 
                    </div>

                    <div class="form-group">
<?php echo $this->Form->label('code_postal', 'Code postal', 'col-md-4 control-label'); ?>
                        <div class="col-md-8 ">

                        <?php echo $this->Form->input('code_postal', array('label' => false, 'data-element' => 'code_postal', 'placeholder' => 'Code postal', 'class' => 'form-control')); ?>
                        </div> 
                    </div>
                    <div class="form-group">
<?php echo $this->Form->label('ville', 'Ville', 'col-md-4 control-label'); ?>
                        <div class="col-md-8 ">

<?php echo $this->Form->input('ville', array('label' => false, 'data-element' => 'ville', 'placeholder' => 'Ville', 'class' => 'form-control')); ?>
                        </div> 
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
                            <div class="help-block">Saisissez votre adresse sous la forme :<br/>"11, rue du coq, 13001 Marseille".<br/>Complétez ou modifiez la dans les champs suivants</div> 
                        </div>

                            
                        </div>
                            <div class="map" ></div>
                        <div class="row latlong"> 
<?php echo $this->Form->label('latitude', 'Latitude', 'col-md-2 control-label'); ?>
                            <div class="col-xs-2 ">

<?php echo $this->Form->input('latitude', array('label' => false, 'type' => 'text', 'data-element' => 'latitude', 'readonly' => 'readonly', 'class' => 'form-control')); ?>
                            </div> 

<?php echo $this->Form->label('longitude', 'Longitude', 'col-md-2 control-label'); ?>
                            <div class="col-xs-2 ">

<?php echo $this->Form->input('longitude', array('label' => false, 'type' => 'text', 'data-element' => 'longitude', 'readonly' => 'readonly', 'class' => 'form-control')); ?>
                            </div> 
                        </div>
                        <span id="legend" class="alert alert-info">Vous pouvez modifier votre position en déplaçant le marqueur</span>
                    </div>
                    </div></div>
              
                <div class="row">
                    <div class=" col-md-6">
                <?php echo $this->Form->button('Enregistrer', array('type' => 'submit', 'class' => 'search btn btn-primary pull-right', 'id' => 'submit')); ?> 
                    </div>
                </div>


<?php echo $this->Form->end(); ?> 
            </div>
        </div>
    </div>
    <div class="tab-pane" id="change_password">
        <div class="row">
            <div class="col-md-4">
                        <?php echo $this->Form->create('AdministrationUserChangePassword', array('url' => array('controller' => 'administration_users', 'action' => 'change_password'), 'class' => 'form-horizontal', 'role' => 'form')); ?>

                <div class="form-group">
<?php echo $this->Form->label('old_password', 'Mot de passe actuel', 'col-md-6  control-label'); ?>
                    <div class="col-md-6 ">
                    <?php echo $this->Form->input('old_password', array('type' => 'password', 'label' => false, 'class' => 'form-control')); ?>
                    </div> 
                </div>
                <div class="form-group">
<?php echo $this->Form->label('new_password', 'Nouveau mot de passe', 'col-md-6  control-label'); ?>
                    <div class="col-md-6 ">
                    <?php echo $this->Form->input('new_password', array('type' => 'password', 'label' => false, 'class' => 'form-control')); ?>
                    </div> 
                </div>
                <div class="form-group">
                <?php echo $this->Form->label('confirm_password', 'Confirmez', 'col-md-6  control-label'); ?>
                    <div class="col-md-6 ">
                <?php echo $this->Form->input('confirm_password', array('type' => 'password', 'label' => false, 'class' => 'form-control')); ?>
                    </div> 
                </div>
<?php echo $this->Form->button('Enregistrer', array('type' => 'submit', 'class' => 'search btn btn-primary pull-right', 'id' => 'submit')); ?>
<?php echo $this->Form->end(); ?>
            </div>
            <div class="col-md-8"></div>
        </div>
    </div>
    <div class="tab-pane" id="images">

       <?php echo  $this->element('add_images'); ?>
   </div>
    <div class="tab-pane" id="documents">
         <?php echo  $this->element('add_documents'); ?>
 </div>
    <div class="tab-pane" id="ext_medias">
        <div class="bs-callout bs-callout-info">
            <h4>Utilisation</h4>
            <p>Ajoutez vos vidéos, extraits sonores...<br>
                renseignez simplement l'url du média (http://www.youtube.com/watch?v=Aa123456).</p>
            <p>Fournisseurs actuellement supportés: Youtube, Dailymotion, Vimeo, Canal Plus, Flickr, Instagram, Scribd, Slideshare, SoundCloud.
            </p>
        </div>
        <?php echo  $this->element('add_externals_medias'); ?>
    </div>
</div>