<?php $this->extend('Common/dashboard'); ?>
<?php echo $this->Html->script('Administration.ric.addresspicker'); ?>
<?php echo $this->Html->script('Administration.ric.tabwizard'); ?>
<?php echo $this->Html->script('Administration.ric.medias'); ?>
<?php echo $this->Html->script('Administration.plupload/plupload.full.min'); ?>
<?php echo $this->Html->script('Administration.ric.fetchExternalMedia'); ?>
<?php echo $this->Html->script('bootstrap-datepicker', array('block' => 'script')); ?>
<?php echo $this->Html->css('datepicker3', array('block' => 'css')); ?>

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
        $(function () {
            Ric.tabWizard('#rootwizard', "<?php echo $this->Html->url(array('controller' => 'BufferedEvenements', 'action' => 'checkValidation'), true); ?>", false);
            Ric.addressPicker(".EventdatePickerContainer", "#EventAddressFields");
            Ric.selectMedias('ImageAdd');
            Ric.selectMedias('DocAdd');
            Ric.selectMedias('ExternalMediaAdd');
     

        });
    </script>  
    <?php $bufferedEvenement = $this->request->data; ?>

    <div id="rootwizard">
        <ul class="nav nav-tabs" id ="tabs">
            <li class="active"><a href="#coordonnees" data-toggle="tab">Informations générales</a></li>
            <li><a href="#description" data-toggle="tab">Description</a></li>
            <li><a href="#sessions" data-toggle="tab">Sessions /représentations</a></li>
            <li><a href="#images" data-toggle="tab">Images</a></li>
            <li><a href="#documents" data-toggle="tab">Documents</a></li>
            <li><a href="#ext_medias" data-toggle="tab">Médias externes</a></li>
        </ul>
        <?php echo $this->Form->create('BufferedEvenement', array('class' => 'form-horizontal', 'role' => 'form')); ?>   
        <div class="tab-content">

            <div class="tab-pane active" id="coordonnees">
                <div class="input"><?php echo $this->Form->hidden('BufferedEvenement.id'); ?></div>
                <div class="input"><?php echo $this->Form->hidden('BufferedEvenement.evenement_id'); ?></div>
                <?php echo $this->element('Agenda/link_to_ficheactivite', array('bufferedFicheactivite' => $this->request->data['BufferedFicheactivite'])); ?>   

                <div class="form-group">
                    <?php echo $this->Form->label('BufferedEvenement.nom_complet', 'Nom', 'col-md-2 control-label'); ?>

                    <div class="col-md-4 ">

                        <?php echo $this->Form->input('BufferedEvenement.nom_complet', array('label' => false, 'placeholder' => 'Nom', 'class' => 'form-control')); ?>
                    </div> 
                </div>


                <?php if (!empty($optionsParentEvenements)) : ?>
                    <div class="form-group">
                        <?php echo $this->Form->label('BufferedEvenement.buffered_parent_id', 'Rattaché à ', 'col-md-2 control-label'); ?>

                        <div class="col-md-4 ">	
                            <?php echo $this->Form->input('buffered_parent_id', array('div' => false, 'label' => false, 'options' => $optionsParentEvenements, 'empty' => '', 'escape' => false, 'class' => 'form-control ')); ?>
                        </div> 
                    </div>
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-6 ">
                        <div id="EventAddressFields">
                            <div class="form-group">
                                <?php echo $this->Form->label('BufferedEvenement.adresse', 'Adresse complete', 'col-md-4  control-label'); ?>
                                <div class="col-md-8 ">
                                    <?php echo $this->Form->input('BufferedEvenement.adresse', array('type' => 'textarea', 'label' => false, 'data-element' => 'street_address', 'placeholder' => 'Adresse', 'class' => 'form-control')); ?>
                                </div> 
                            </div>

                            <div class="form-group">
                                <?php echo $this->Form->label('BufferedEvenement.code_postal', 'Code postal', 'col-md-4 control-label'); ?>
                                <div class="col-md-8 ">

                                    <?php echo $this->Form->input('BufferedEvenement.code_postal', array('label' => false, 'data-element' => 'code_postal', 'placeholder' => 'Code postal', 'class' => 'form-control')); ?>
                                </div> 
                            </div>
                            <div class="form-group">
                                <?php echo $this->Form->label('BufferedEvenement.ville', 'Ville', 'col-md-4 control-label'); ?>
                                <div class="col-md-8 ">

                                    <?php echo $this->Form->input('BufferedEvenement.ville', array('label' => false, 'data-element' => 'ville', 'placeholder' => 'Ville', 'class' => 'form-control')); ?>
                                </div> 
                            </div>
                            <div class="form-group">
                                <?php echo $this->Form->label('BufferedEvenement.pays', 'Pays', 'col-md-4 control-label'); ?>
                                <div class="col-md-8 ">

                                    <?php echo $this->Form->input('BufferedEvenement.pays', array('label' => false, 'data-element' => 'pays', 'placeholder' => 'Pays', 'class' => 'form-control')); ?>
                                </div> 
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->label('BufferedEvenement.telephone', 'Télephone', 'col-md-4 control-label'); ?>
                            <div class="col-md-8 ">

                                <?php echo $this->Form->input('BufferedEvenement.telephone', array('label' => false, 'data-element' => 'telephone', 'placeholder' => 'Télephone', 'class' => 'form-control')); ?>
                            </div> 
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->label('BufferedEvenement.telephone_billeterie', 'Télephone Billeterie', 'col-md-4 control-label'); ?>
                            <div class="col-md-8 ">

                                <?php echo $this->Form->input('BufferedEvenement.telephone_billeterie', array('label' => false, 'data-element' => 'telephone_billeterie', 'placeholder' => 'Billeterie', 'class' => 'form-control')); ?>
                            </div> 
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->label('BufferedEvenement.site_web', 'Internet', 'col-md-4 control-label'); ?>
                            <div class="col-md-8 ">

                                <?php echo $this->Form->input('BufferedEvenement.site_web', array('label' => false, 'data-element' => 'site_web', 'placeholder' => 'Internet', 'class' => 'form-control')); ?>
                            </div> 
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->label('BufferedEvenement.courriel', 'E-mail', 'col-md-4 control-label'); ?>
                            <div class="col-md-8 ">

                                <?php echo $this->Form->input('BufferedEvenement.courriel', array('label' => false, 'data-element' => 'courriel', 'placeholder' => 'E-mail', 'class' => 'form-control')); ?>
                            </div> 
                        </div>
                        <div class="row">

                            <div class="col-md-12">
                                <div class="input"><?php echo $this->Form->hidden('BufferedEvenement.master'); ?></div>
                                <?php echo $this->Form->button('Enregistrer', array('type' => 'submit', 'class' => 'search btn btn-primary pull-right', 'id' => 'submit')); ?> 
                            </div>

                        </div> 

                    </div>

                    <div class=" col-md-6">
                        <div class="well EventdatePickerContainer map_container">
                            <div class="form-group">
                                <?php echo $this->Form->label('addresspicker', 'Adresse à géolocaliser', 'col-md-4  control-label'); ?>
                                <div class="col-md-8 ">
                                    <?php echo $this->Form->input('addresspicker', array('label' => false, 'placeholder' => 'Adresse à géolocaliser', 'data-element' => 'addresspicker', 'class' => 'form-control')); ?>
                                </div> 
                            </div>
                            <div class="map"></div>
                            <div class="row"> 
                                <?php echo $this->Form->label('BufferedEvenement.latitude', 'Latitude', 'col-md-2 control-label'); ?>
                                <div class="col-xs-2 ">

                                    <?php echo $this->Form->input('BufferedEvenement.latitude', array('label' => false, 'type' => 'text', 'data-element' => 'latitude', 'readonly' => 'readonly', 'class' => 'form-control')); ?>
                                </div> 

                                <?php echo $this->Form->label('BufferedEvenement.longitude', 'Longitude', 'col-md-2 control-label'); ?>
                                <div class="col-xs-2 ">

                                    <?php echo $this->Form->input('BufferedEvenement.longitude', array('label' => false, 'type' => 'text', 'data-element' => 'longitude', 'readonly' => 'readonly', 'class' => 'form-control')); ?>
                                </div> 
                            </div>
                            <span id="legend" class="alert alert-info">Vous pouvez modifier votre position en déplaçant le marqueur</span>
                        </div>

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


                <div class="form-group clearfix" >

                    <?php echo $this->Form->label('Typepublic', 'Publics', 'col-md-1 col-md-offset-1 control-label'); ?>
                    <div class="col-md-10">
                        <div class="well clearfix" style="max-height:250px;overflow:auto">

                            <?php echo $this->Form->input('Typepublic', array('label' => false, 'multiple' => 'checkbox', 'options' => $optionsTypepublics, 'data-element' => 'genre', 'class' => ' input checkbox-inline')); ?>
                        </div>
                    </div>
                </div>




                <div class="form-group clearfix">
                    <?php echo $this->Form->label('AgendaGenre', 'Genres', 'col-md-1 col-md-offset-1 control-label'); ?>

                    <div class="col-md-10">
                        <div class="well clearfix" style="max-height:250px;overflow:auto">

                            <?php echo $this->Form->input('AgendaGenre', array('label' => false, 'multiple' => 'checkbox', 'options' => $optionsGenres, 'data-element' => 'genre', 'class' => 'checkbox col-md-4')); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="input"><?php echo $this->Form->hidden('BufferedEvenement.master'); ?></div>
                        <?php echo $this->Form->button('Enregistrer', array('type' => 'submit', 'class' => 'search btn btn-primary pull-right', 'id' => 'submit')); ?> 
                    </div>

                </div> 


            </div>
            <div class="tab-pane" id="sessions">

                <script>
                    $(function () {

                        attachDateComponent = function (startDateItem, endDateItem) {


                            var startDate = startDateItem.datepicker({
                                language: "fr",
                                autoclose: true,
                                todayBtn: 'linked',
                                todayHighlight: true,
                                format: 'dd-mm-yyyy',
                                startDate: new Date()
                            });
                            var endDate = endDateItem.datepicker({
                                language: "fr",
                                autoclose: true,
                                todayBtn: 'linked',
                                todayHighlight: true,
                                format: 'dd-mm-yyyy',
                                startDate: new Date()
                            });
                            //startDate.on('click',function(){console.log('startdate')})    
                            startDate.on('changeDate', function (ev) {

                                if (ev.date > endDateItem.datepicker('getDate') || endDateItem.find('input').val() === "") {
                                    var newDate = new Date(ev.date);
                                    newDate.setDate(newDate.getDate());
                                    endDateItem.datepicker('setDate', newDate);
                                }
                            });

                            endDate.on('changeDate', function (ev) {

                                if (ev.date < startDateItem.datepicker('getDate') || startDateItem.find('input').val() === "") {
                                    var newDate = new Date(ev.date);
                                    newDate.setDate(newDate.getDate());
                                    startDateItem.datepicker('setDate', newDate);
                                }
                            });


                        };

                        checkDisablesRemoveBtn = function () {
                            if ($('.session').length === 1) {
                                $('.session .removeSession').attr('disabled', 'disabled');
                            }
                        }
                        setInitialFormValues = function () {

                            $('#coordonnees').on('change', '[data-element]', function () {
                                var dataelement = $(this).attr('data-element');
                                var value = $(this).val();
                                $('#session0').find("[data-element='" + dataelement + "']").val(value);

                            });

                        };
                        init = function () {
                            console.log('init');
                            // setInitialFormValues();
                            checkDisablesRemoveBtn();
                            attachDateComponent($(".searchStartDateComponent"), $(".searchEndDateComponent"));
                            $('.session').each(function (index) {
                                Ric.addressPicker('#session' + index + ' .map_container', 'session' + index + ' .addressFields');
                            });
                        };
                        init();
                        deleteSession = function (removeBtn, ajaxDelete) {
                            var session = removeBtn.parents('.session');
                            ajaxDelete = typeof ajaxDelete !== 'undefined' ? ajaxDelete : false;
                            BootstrapDialog.confirm('Voulez vous vraiment supprimer cette session ?', function (confirmation) {
                                if (confirmation) {
                                    if (ajaxDelete) {
                                        $.ajax({
                                            type: "POST",
                                            url: removeBtn.attr('data-action'),
                                            dataType: 'json',
                                            success: function (response) {
                                                if (response !== null && response.error) {
                                                    // alert(response.error);
                                                    BootstrapDialog.show({title: 'Erreur', type: 'type-danger', message: response.error});
                                                }
                                                else {
                                                    session.slideUp('400', function () {
                                                        session.remove();
                                                    });
                                                }
                                            },
                                            error: function (response) {
                                                alert('une erreur est survenue: ' + response.name);
                                            }
                                        });
                                    }
                                    else {
                                        session.slideUp('400', function () {
                                            session.remove();


                                        });
                                    }

                                }

                            });
                        };

                        $("#sessionsList").on("click", "button.removeSession", function () {
                            checkDisablesRemoveBtn();
                            if ($('.session').length > 1) {
                                var removeBtn = $(this);

                                deleteSession(removeBtn, true);
                            }

                            return false;
                        });
                        $("#sessionsList").on("click", "button.addSession", function () {
                            console.log('addsession');
                            var cloneIndex = $(".session").length;
                            var newSession = $(this).parents(".session").clone();

                            newSession.attr('id', 'session' + cloneIndex);
                            newSession.appendTo("#sessionsList").find("input, textarea").each(function (i) {
                                //name     

                                var name = this.name || "";
                                if (name !== "") {

                                    var match_name = name.match(/^(.*)(\d)(.*)$/i) || [];

                                    if (match_name.length === 4) {
                                        this.name = match_name[1] + (cloneIndex) + match_name[3];
                                    }
                                }
                                //id 
                                var id = this.id || "";
                                if (id !== "") {
                                    var match_id = id.match(/^(.*)(\d*)(.*)$/i) || [];

                                    if (match_id.length === 4) {
                                        this.id = match_id[1] + (cloneIndex) + match_id[3];
                                    }
                                }

                            });

                            attachDateComponent(newSession.find('.searchStartDateComponent'), newSession.find('.searchEndDateComponent'));
                            newSession.find("input[type=text]").first().focus();
                            Ric.addressPicker('#session' + cloneIndex + ' .map_container', '#session' + cloneIndex + ' .addressFields');

                            cloneIndex++;
                            return false;
                        });
                        /*
                         $("#sessionsList").on("click" ,".sessionsBtns button",function(){
                         console.log($('.session').length);
                         
                         })
                         */

                    });

                </script>

                <div id="sessionsList" >
                    <?php debug($this->request->data); ?>


                    <?php foreach ($bufferedEvenement['Session'] as $key => $sess): ?>
                        <?php echo $this->Form->input('Session.' . $key . '.id', array('type' => 'hidden', 'div' => false, 'label' => false)); ?>
                        <div class="row session" id="session<?php echo $key; ?>" >

                            <div class="col-md-12 well form-horizontal row" >

                                <div class="col-md-6 ">
                                    <div class="form-group">
                                        <?php echo $this->Form->label('Session.' . $key . 'annule', 'Annulé', array('class' => 'control-label col-md-3')); ?>

                                        <div class="col-md-8  checkbox" style="margin-left:15px">
                                            <?php echo $this->Form->input('Session.' . $key . '.annule', array('div' => false, 'label' => false)); ?>
                                            <small> Apparaîtra dans les résultats de recherche avec la mention "annulé"</small>
                                        </div>
                                    </div>
                                    <div class="form-group"><?php echo $this->Form->label('Session.' . $key . '.date_debut', 'du', array('class' => 'control-label  col-md-3')); ?> 
                                        <div class="col-md-6">
                                            <div class="input input-group date searchStartDateComponent ">
                                                <?php echo $this->Form->input('Session.' . $key . '.date_debut', array('div' => false, 'label' => false, 'type' => 'text', 'class' => 'form-control input-date datefield ')); ?>
                                                <span class="input-group-addon"><i class=" fa fa-th"></i></span>
                                            </div>     
                                        </div>
                                    </div><div class="form-group">
                                        <?php echo $this->Form->label('Session.' . $key . '.date_fin', 'au', array('class' => 'control-label col-md-3 pull-left')); ?> 
                                        <div class="col-md-6 ">
                                            <div class="input input-group date searchEndDateComponent">
                                                <?php echo $this->Form->input('Session.' . $key . '.date_fin', array('div' => false, 'label' => false, 'type' => 'text', 'class' => 'form-control input-date datefield ')); ?>
                                                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo $this->Form->label('Session.' . $key . '.heure', 'Horaire(s)', array('class' => 'control-label col-md-3')); ?> 
                                        <div class="col-md-9 input">
                                            <?php echo $this->Form->input('Session.' . $key . '.heure', array('div' => false, 'label' => false, 'class' => 'form-control')); ?>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo $this->Form->label('Session.' . $key . '.tarif', 'Tarif(s)', array('class' => 'control-label col-md-3')); ?> 
                                        <div class="col-md-9 input">
                                            <?php echo $this->Form->input('Session.' . $key . '.tarif', array('div' => false, 'label' => false, 'class' => 'form-control')); ?>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo $this->Form->label('Session.' . $key . '.lieu', 'Lieu', array('class' => 'control-label col-md-3')); ?> 
                                        <div class="col-md-9 input">
                                            <?php echo $this->Form->input('Session.' . $key . '.lieu', array('div' => false, 'label' => false, 'class' => 'form-control')); ?>

                                        </div>
                                    </div>
                                    <div class="addressFields">
                                        <div class="form-group">
                                            <?php echo $this->Form->label('Session.' . $key . '.adresse', 'Adresse', array('class' => 'control-label col-md-3')); ?> 
                                            <div class="col-md-9 input">
                                                <?php echo $this->Form->input('Session.' . $key . '.adresse', array('data-element' => 'street_address', 'div' => false, 'label' => false, 'class' => 'form-control')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group"><?php echo $this->Form->label('Session.' . $key . '.code_postal', 'code postal', array('class' => 'control-label  col-md-3')); ?> 
                                            <div class="col-md-5 input">

                                                <?php echo $this->Form->input('Session.' . $key . '.code_postal', array('data-element' => 'code_postal', 'div' => false, 'label' => false, 'type' => 'text', 'class' => 'form-control')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo $this->Form->label('Session.' . $key . '.ville', 'ville', array('class' => 'control-label col-md-3')); ?> 
                                            <div class="col-md-9 input">

                                                <?php echo $this->Form->input('Session.' . $key . '.ville', array('data-element' => 'ville', 'div' => false, 'label' => false, 'type' => 'text', 'class' => 'form-control')); ?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo $this->Form->label('Session.' . $key . '.descriptif', 'Descriptif', array('class' => 'control-label col-md-3')); ?> 
                                        <div class="col-md-9 input">
                                            <?php echo $this->Form->input('Session.' . $key . '.descriptif', array('div' => false, 'label' => false, 'class' => 'form-control')); ?>

                                        </div>
                                    </div>


                                </div>

                                <div class="col-md-6 ">
                                    <div class="sessionBtns clearfix"><p class="pull-left"> <button class="btn btn-default removeSession" value="supprimer"  data-action="<?php
                                            echo $this->Html->url(array(
                                                'controller' => 'bufferedSessions',
                                                'action' => 'delete',
                                                $sess['id']
                                            ));
                                            ?>" > <i class="fa fa-trash-o "></i> supprimer cette session</button>
                                        </p>
                                        <p class="pull-left"><button class="btn btn-primary addSession" value="dupliquer" > <i class="fa fa-plus-square-o "></i> dupliquer cette session</button>
                                        </p></div>


                                    <div class="well map_container ">

                                        <div  class="form-group ">
                                            <?php echo $this->Form->label('addresspicker', 'Adresse à géolocaliser', 'col-md-4  control-label'); ?>
                                            <div class="col-md-8 ">
                                                <?php echo $this->Form->input('addresspicker', array('label' => false, 'placeholder' => 'Adresse à géolocaliser', 'data-element' => 'addresspicker', 'class' => 'form-control')); ?>
                                            </div> 
                                        </div>
                                        <div  class="map" ></div>
                                        <div class="row latlong"> 
                                            <?php echo $this->Form->label('Session.' . $key . '.latitude', 'Latitude', 'col-md-3 control-label'); ?>
                                            <div class="col-md-3 ">

                                                <?php echo $this->Form->input('Session.' . $key . '.latitude', array('label' => false, 'type' => 'text', 'data-element' => 'latitude', 'readonly' => 'readonly', 'class' => 'form-control')); ?>
                                            </div> 

                                            <?php echo $this->Form->label('Session.' . $key . '.longitude', 'Longitude', 'col-md-3 control-label'); ?>
                                            <div class="col-md-3 ">

                                                <?php echo $this->Form->input('Session.' . $key . '.longitude', array('label' => false, 'type' => 'text', 'data-element' => 'longitude', 'readonly' => 'readonly', 'class' => 'form-control')); ?>
                                            </div> 
                                        </div>
                                        <span id="legend" class="alert alert-info">Vous pouvez modifier votre position en déplaçant le marqueur</span>
                                    </div>    

                                </div>





                            </div>

                        </div>

                    <?php endforeach; ?>
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
                    <?php echo $this->element('upload_modal', array('button_text' => 'ajouter des images à ma bibliohèque', 'element' => 'add_images', 'filelist' => "available_images")); ?>

                </div>


                <div class="row">
                    <div id="ImageAdd" class="selectMedias">
                        <div class=" col-md-6  ">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Images selectionnées<span class="loading"> <i class="fa fa-refresh fa-spin"></i></span></h3>
                                </div>
                                <?php echo $this->Form->create('BufferedEvenementImage', array('url' => array('controller' => 'BufferedEvenements', 'action' => 'updateMedia'), 'data-role' => 'updateMedia')); ?>
                                <div class="panel-body selected connectedSortable">

                                    <?php foreach ($bufferedEvenement['BufferedEvenementImage'] as $bufferedEvenementImage): ?>

                                        <?php echo $this->element('media', array('foreign_key' => $bufferedEvenement['BufferedEvenement']['id'], 'media' => $bufferedEvenementImage, 'model' => 'BufferedEvenement', 'category' => 'Image')); ?>
                                    <?php endforeach; ?>
                                    <?php echo $this->Form->input('BufferedEvenement.foreign_key', array('type' => 'hidden', 'value' => $bufferedEvenement['BufferedEvenement']['id'])); ?>
                                    <?php echo $this->Form->input('BufferedEvenement.category', array('type' => 'hidden', 'value' => 'Image')); ?>
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

                                        <?php echo $this->element('media', array('foreign_key' => $bufferedEvenement['BufferedEvenement']['id'], 'media' => $image, 'model' => 'BufferedEvenement', 'category' => 'Image', 'displayActions' => true)); ?>
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
                    <?php echo $this->element('upload_modal', array('button_text' => 'ajouter des documents à ma bibliohèque', 'element' => 'add_documents', 'filelist' => "available_documents")); ?>
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


                                    <?php echo $this->Form->input('BufferedEvenement.foreign_key', array('type' => 'hidden', 'value' => $bufferedEvenement['BufferedEvenement']['id'])); ?>

                                    <?php echo $this->Form->input('BufferedEvenement.category', array('type' => 'hidden', 'value' => 'Document')); ?>
                                    <?php foreach ($bufferedEvenement['BufferedEvenementDocument'] as $bufferedEvenementDocument): ?>

                                        <?php echo $this->element('media', array('foreign_key' => $bufferedEvenement['BufferedEvenement']['id'], 'media' => $bufferedEvenementDocument, 'model' => 'BufferedEvenement', 'category' => 'Document', 'displayActions' => true)); ?>
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
                                        <?php echo $this->element('media', array('foreign_key' => $bufferedEvenement['BufferedEvenement']['id'], 'media' => $document, 'model' => 'BufferedEvenement', 'category' => 'Document', 'displayActions' => true)); ?>
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
                    <?php echo $this->element('upload_modal', array('button_text' => 'ajouter des médias externes à ma bibliohèque', 'element' => 'add_externals_medias', 'filelist' => "available_ext_medias")); ?>

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
                                        <?php echo $this->element('ext_media', array('foreign_key' => $bufferedEvenement['BufferedEvenement']['id'], 'ext_media' => $bufferedEvenementExternalMedia, 'model' => 'BufferedEvenement', 'category' => 'ExternalMedia', 'displayActions' => true)); ?>

                                    <?php endforeach; ?>
                                    <?php echo $this->Form->input('BufferedEvenement.foreign_key', array('type' => 'hidden', 'value' => $bufferedEvenement['BufferedEvenement']['id'])); ?>
                                    <?php echo $this->Form->input('BufferedEvenement.category', array('type' => 'hidden', 'value' => 'ExternalMedia')); ?>
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
                                        <?php echo $this->element('ext_media', array('foreign_key' => $bufferedEvenement['BufferedEvenement']['id'], 'ext_media' => $externalMedia, 'model' => 'BufferedEvenement', 'category' => 'ExternalMedia', 'displayActions' => true)); ?>
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