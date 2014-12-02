<script>
    $(function() {
        $('#copyFrom a').click(
                
                function(event) {var item=$(this);
                       event.preventDefault();
                      
                      $("#nom_ficheactivite").html('<div class="bg-primary" ><h4 >Fiche activité support : '+item.attr('data-nom_complet')+'</h4></div>  ');
                      console.log(item.attr('data-model_id'));
                      $('input[name=data\\[BufferedEvenement\\]\\[ficheactivite_model_id\\]]').val(item.attr('data-model_id'));
                     $('input[name=data\\[BufferedEvenement\\]\\[ficheactivite_model\\]]').val(item.attr('data-model'));
                     $('input[name=data\\[BufferedEvenement\\]\\[ficheactivite_nom_complet\\]]').val(item.attr('data-nom_complet'));

                });
                return false;
    })


</script>
<div class="well">

    <?php if (count($user['AvailablesFicheactivite']) ==1) : ?>
     <h4 style="margin:0"><span class="label label-info" >Fiche activité support :<?php echo $user['AvailablesFicheactivite'][0]['nom_complet']; ?></span></h4>
     <div class='input'><?php echo $this->Form->input('ficheactivite_model_id', array('type' => 'hidden','value'=>$user['AvailablesFicheactivite'][0]['id'])); ?></div>
     <div class='input'><?php echo $this->Form->input('ficheactivite_model', array('type' => 'hidden','value'=>Inflector::singularize($user['AvailablesFicheactivite'][0]['controller']))); ?></div>
      <div class='input'><?php echo $this->Form->input('ficheactivite_nom_complet', array('type' => 'hidden','value'=>Inflector::singularize($user['AvailablesFicheactivite'][0]['ficheactivite_nom_complet']))); ?></div>
    <?php elseif (count($user['AvailablesFicheactivite']) > 1) : ?>
     
    <div class="row">
        
        <div class="col-md-6">
            <div class="btn-group">
                <button type="button" class="btn btn-primary">Sélectionnez la fiche activité support</button>
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Afficher/masquer</span>
                </button>
                <ul class="dropdown-menu" role="menu" id="copyFrom">
                    

                        <?php foreach ($user['AvailablesFicheactivite'] as $availableFicheactivite): ?>
                            <li><?php echo $this->Html->link($availableFicheactivite['nom_complet'], '', array('data-nom_complet'=>$availableFicheactivite['nom_complet'],'data-model'=>$availableFicheactivite['controller'],'data-model_id'=>$availableFicheactivite['id'])); ?></li>

                        <?php endforeach;?>
                   
                </ul>
            </div>

            <button type="button" class="btn btn-info btn-mini" data-toggle="popover" title="Fiche activité support" data-content="votre événement affichera les coordonnées de cette fiche activité"><i class="fa fa-info" ></i></button>
        </div>
            
        <div class="col-md-6">
            <div id="nom_ficheactivite">
               
                
                <?php if (!empty($bufferedFicheactivite) ): ?>
                    <div class="bg-primary" >
                <h4>
                    <?php echo 'Fiche activité support : '.$bufferedFicheactivite['nom_complet'];?>
                        
                    </h4></div>
                 <?php endif; ?>
              
            </div>
             <div class="input"><?php echo $this->Form->input('BufferedEvenement.ficheactivite_model_id', array('type' => 'hidden','default'=>$bufferedFicheactivite['id'])); ?></div>
             <div class="input"><?php echo $this->Form->input('BufferedEvenement.ficheactivite_model', array('type' => 'hidden','default'=>'BufferedFicheactivites')); ?></div>
             <div class="input"><?php echo $this->Form->input('BufferedEvenement.ficheactivite_nom_complet', array('type' => 'hidden','default'=>$bufferedFicheactivite['nom_complet'])); ?> </div>
        </div>                       
        
    </div>

    <?php endif; ?> 
</div>
