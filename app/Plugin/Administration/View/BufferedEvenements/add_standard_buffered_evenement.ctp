<?php $this->extend('Common/dashboard'); ?>
<?php echo $this->Html->script('Administration.ric.addresspicker'); ?>
<?php echo $this->Html->script('Administration.ric.tabwizard'); ?>
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
        $(function() {
            Ric.tabWizard('#rootwizard', "<?php echo $this->Html->url(array('controller' => 'BufferedEvenements', 'action' => 'checkValidation'), true); ?>", false);
          //  Ric.addressPicker(".EventdatePickerContainer", "#EventAddressFields");

        });
    </script>  
    <div id="rootwizard">
        <ul class="nav nav-tabs" id ="tabs">
            <li class="active"><a href="#coordonnees" data-toggle="tab">Informations générales</a></li>
            <li><a href="#description" data-toggle="tab">Description</a></li>
            <li><a href="#sessions" data-toggle="tab">Sessions /représentations</a></li>
        </ul>
        <?php echo $this->Form->create('BufferedEvenement', array('class' => 'form-horizontal', 'role' => 'form')); ?>   
        <div class="tab-content">

            <div class="tab-pane active" id="coordonnees">

                <?php echo $this->element('Agenda/link_to_ficheactivite'); ?>   

                <div class="form-group">
                    <?php echo $this->Form->label('BufferedEvenement.nom_complet', 'Nom', 'col-md-2 control-label'); ?>

                    <div class="col-md-4 ">

                        <?php echo $this->Form->input('BufferedEvenement.nom_complet', array('label' => false, 'placeholder' => 'Nom', 'class' => 'form-control')); ?>
                    </div> 
                </div>
                <?php if (!empty($bufferedEvenement['Parent']['nom_complet'])): ?>
                    <div class="form-group">
                        <?php echo $this->Form->label('BufferedEvenement.Parent', 'Rattaché à ', 'col-md-2 control-label'); ?>

                        <div class="col-md-4 ">

                            <?php echo $this->Form->input('Parent.nom_complet', array('label' => false, 'placeholder' => 'Nom', 'readonly' => 'readonly', 'class' => 'form-control')); ?>
                        </div> 
                    </div>
                <?php endif; ?>
                    
                     <?php if (!empty($optionsParentEvenements)) : ?>
                         <div class="form-group">
                        <?php echo $this->Form->label('BufferedEvenement.buffered_parent_id', 'Rattaché à ', 'col-md-2 control-label'); ?>

                        <div class="col-md-4 ">	
                            <?php echo $this->Form->input('buffered_parent_id', array('div' => false, 'label' => false,'options' => $optionsParentEvenements, 'empty' => '', 'escape' => false, 'class' => 'form-control ')); ?>
                        </div> 
                    </div>
                    <?php endif; ?>
                
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
                        </div></div>
                </div>




                <div class="form-group clearfix">
                    <?php echo $this->Form->label('AgendaGenre', 'Genres', 'col-md-1 col-md-offset-1 control-label'); ?>

                    <div class="col-md-10">
                        <div class="well clearfix" style="max-height:250px;overflow:auto">

                            <?php echo $this->Form->input('AgendaGenre', array('label' => false, 'multiple' => 'checkbox', 'options' => $optionsGenres, 'data-element' => 'genre', 'class' => 'checkbox col-md-4')); ?>
                        </div></div>
                </div>



            </div>
            <div class="tab-pane" id="sessions">

                <script>
                    $(function() {
                           
                        attachDateComponent=function(startDateItem, endDateItem) {


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
                            startDate.on('changeDate', function(ev) {
                                   
                                if (ev.date > endDateItem.datepicker('getDate') || endDateItem.find('input').val()==="") {
                                    var newDate = new Date(ev.date);
                                    newDate.setDate(newDate.getDate());
                                    endDateItem.datepicker('setDate', newDate);
                                }
                            });

                            endDate.on('changeDate', function(ev) {
                               
                                if (ev.date < startDateItem.datepicker('getDate') || startDateItem.find('input').val()==="" ) {
                                    var newDate = new Date(ev.date);
                                    newDate.setDate(newDate.getDate());
                                    startDateItem.datepicker('setDate', newDate);
                                }
                            });


                        };   
                        
                        
                        setInitialFormValues=function(){
                         
                           $('#coordonnees').on('change', '[data-element]',function(){
                               var dataelement=$(this).attr('data-element');
                               var value=$(this).val();
                               $('#session0').find("[data-element='"+dataelement+"']").val(value);
                              
                           });
                            
                        };
                        init=function(){
                            console.log('init');
                            setInitialFormValues();
                           
                           attachDateComponent($("#session0 .searchStartDateComponent"),$("#session0 .searchEndDateComponent"));
                           Ric.addressPicker('#session0 .map_container','#session0 .addressFields');
                        };
                        init();
                        deleteSession=function(session,ajaxDelete){
                            ajaxDelete = typeof ajaxDelete !== 'undefined' ? ajaxDelete : false;
                            BootstrapDialog.confirm('Voulez vous vraiment supprimer cette session ?', function(confirmation) {
                                    if (confirmation) {
                                        if (ajaxDelete){
                                            $.ajax({
                                            type: "POST",
                                            url: removeBtn.attr('data-action'),
                                            dataType: 'json',
                                            success: function(response) {
                                                if (response !== null && response.error) {
                                                    alert(response.error);

                                                }
                                                else {
                                                   
                                                    session.slideUp('400', function() {
                                                    session.remove();
                                                       
                                                        
                                                    });
 }
                                            },
                                            error: function(response) {
                                                alert('une erreur est survenue: ' + response.name);
                                            }
                                        }); 
                                        }
                                        else{
                                             session.slideUp('400', function() {
                                                    session.remove();
                                                       
                                                        
                                                    });
                                        }
                                       
                                    }

                                });
                        };

                        $("#sessionsList").on("click", "button.removeSession", function() {
                          
                            if ($('.session').length > 1) {
                                var removeBtn = $(this);
                                 var session = removeBtn.parents('.session');
                                    deleteSession(session,false);
                            }
                            return false;
                        });
                          $("#sessionsList").on("click", "button.addSession", function() {
                            var cloneIndex = $(".session").length;
                            var newSession = $(this).parents(".session").clone();
                          
                            newSession.attr('id','session'+cloneIndex);
                            newSession.appendTo("#sessionsList").find("input, textarea").each(function(i) {
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
                            
                            attachDateComponent(newSession.find('.searchStartDateComponent'),newSession.find('.searchEndDateComponent'));
                            newSession.find("input[type=text]").first().focus();
                           
                           Ric.addressPicker('#session'+cloneIndex +' .map_container', '#session'+cloneIndex +' .addressFields');
                           $('#session'+cloneIndex +' .removeSession').attr('disabled', false);
                           cloneIndex++;
                            return false;
                        });
                        
                        
                    });

                </script>

                <div id="sessionsList" >

                    <?php $key = 0; ?>

                    <div class="row session" id="session<?php echo $key; ?>" >


                        <div class="col-md-12 well form-horizontal row" >

                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <?php echo $this->Form->label('Session.annule', 'Annulé', array('class' => 'control-label col-md-3')); ?>

                                    <div class="col-md-8  checkbox" style="margin-left:15px">
                                        <?php echo $this->Form->input('Session.' . $key . '.annule', array('div' => false, 'label' => false)); ?>
                                        <small> Apparaîtra dans les résultats de recherche avec la mention "annulé"</small>
                                    </div>
                                </div>
                                <div class="form-group"><?php echo $this->Form->label('Session.' . $key . '.date_debut', 'du', array('class' => 'control-label  col-md-3')); ?> 
                                    <div class="col-md-6">
                                        <div class="input-group date searchStartDateComponent ">
                                            <?php echo $this->Form->input('Session.' . $key . '.date_debut', array('div' => false, 'label' => false, 'type' => 'text', 'class' => 'form-control input-date datefield ')); ?>
                                            <span class="input-group-addon"><i class=" fa fa-th"></i></span>
                                        </div>     
                                    </div>
                                </div><div class="form-group">
                                    <?php echo $this->Form->label('Session.' . $key . '.date_fin', 'au', array('class' => 'control-label col-md-3 pull-left')); ?> 
                                    <div class="col-md-6 ">
                                        <div class="input-group date searchEndDateComponent">
                                            <?php echo $this->Form->input('Session.' . $key . '.date_fin', array('div' => false, 'label' => false, 'type' => 'text', 'class' => 'form-control input-date datefield ')); ?>
                                            <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php echo $this->Form->label('Session.' . $key . '.heure', 'Horaire(s)', array('class' => 'control-label col-md-3')); ?> 
                                    <div class="col-md-9 ">
                                        <?php echo $this->Form->input('Session.' . $key . '.heure', array('div' => false, 'label' => false, 'class' => 'form-control')); ?>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php echo $this->Form->label('Session.' . $key . '.tarif', 'Tarif(s)', array('class' => 'control-label col-md-3')); ?> 
                                    <div class="col-md-9 ">
                                        <?php echo $this->Form->input('Session.' . $key . '.tarif', array('div' => false, 'label' => false, 'class' => 'form-control')); ?>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php echo $this->Form->label('Session.' . $key . '.lieu', 'Lieu', array('class' => 'control-label col-md-3')); ?> 
                                    <div class="col-md-9 ">
                                        <?php echo $this->Form->input('Session.' . $key . '.lieu', array('div' => false, 'label' => false, 'class' => 'form-control')); ?>

                                    </div>
                                </div>
                                <div class="addressFields">
                                    <div class="form-group">
                                        <?php echo $this->Form->label('Session.' . $key . '.adresse', 'Adresse', array('class' => 'control-label col-md-3')); ?> 
                                        <div class="col-md-9 ">
                                            <?php echo $this->Form->input('Session.' . $key . '.adresse', array('data-element' => 'street_address', 'div' => false, 'label' => false, 'class' => 'form-control')); ?>

                                        </div>
                                    </div>
                                    <div class="form-group"><?php echo $this->Form->label('Session.' . $key . '.code_postal', 'code postal', array('class' => 'control-label  col-md-3')); ?> 
                                        <div class="col-md-5">

                                            <?php echo $this->Form->input('Session.' . $key . '.code_postal', array('data-element' => 'code_postal', 'div' => false, 'label' => false, 'type' => 'text', 'class' => 'form-control')); ?>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo $this->Form->label('Session.' . $key . '.ville', 'ville', array('class' => 'control-label col-md-3')); ?> 
                                        <div class="col-md-9 ">

                                            <?php echo $this->Form->input('Session.' . $key . '.ville', array('data-element' => 'ville', 'div' => false, 'label' => false, 'type' => 'text', 'class' => 'form-control')); ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php echo $this->Form->label('Session.' . $key . '.descriptif', 'Descriptif', array('class' => 'control-label col-md-3')); ?> 
                                    <div class="col-md-9 ">
                                        <?php echo $this->Form->input('Session.' . $key . '.descriptif', array('div' => false, 'label' => false, 'class' => 'form-control')); ?>

                                    </div>
                                </div>


                            </div>

                            <div class="col-md-6 ">
                                <div class="sessionBtns clearfix"><p class="pull-left"> <button class="btn btn-default removeSession" value="supprimer" disabled="disabled" data-action="<?php
                                        echo $this->Html->url(array(
                                            'controller' => 'bufferedSessions',
                                            'action' => 'delete',
                                            $session['id']
                                        ));
                                        ?>" > <i class="fa fa-trash-o "></i> supprimer cette session</button>
                                    </p>
                                    <p class="pull-left"><button class="btn btn-primary addSession" value="supprimer" > <i class="fa fa-plus-square-o "></i> dupliquer cette session</button>
                                    </p></div>

                                <script>
                                    $(function() {
                                        
                                    });

                                </script>
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
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <?php echo $this->Form->button('Enregistrer', array('type' => 'submit', 'class' => 'search btn btn-primary pull-right', 'id' => 'submit')); ?> 
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

    <?php echo $this->Form->end(); ?>
<?php endif; ?>