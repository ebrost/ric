<script>
$(document).ready(function(){
   $('.editable-items').on("mouseover mouseout","li",function(e){
                        var item =$(this);
			var removeBtn=item.find("button.remove");
			if (e.type==="mouseover"){
                            removeBtn.fadeIn();
                           removeBtn.on("click",(function(){
                               var bootstrapMsg= 'Voulez vous vraiment supprimer '+ removeBtn.attr('data-name')+ ' ?';
                               if (removeBtn.attr('data-type') && removeBtn.attr('data-type').indexOf("Evenements") >= 0 && removeBtn.next('ul').length>0){
                                  
                                   bootstrapMsg= 'Voulez vous vraiment supprimer '+ removeBtn.attr('data-name')+ ' ?' +
                                   '<br/><strong>Tous ses descendants seront aussi supprimés !</strong>';
                               }
                               
                             BootstrapDialog.confirm(bootstrapMsg,function(confirmation){
                                 if (confirmation){
                                   //  console.log('confirmation');
                                    $.ajax({
                                        type: "POST",
                                        url: removeBtn.attr('data-action'),
                                        dataType: 'json',
                                success: function(response){
                                    
                                    if (response !=null && response.error){
                                        var msg= response.error.replace(/(?:\r\n|\r|\n)/g, '<br />');
                                        BootstrapDialog.show({title:'Erreur',type:'type-danger',message:msg});
                                    }
                                    else{
                                      removeBtn. parent('li').slideUp("fast", function(){this.remove()});
                                    }
                                },
                                error:function(response){
                                    console.log(response);
                                    BootstrapDialog.show({title:'Erreur',type:'type-danger',message:'une erreur est survenue'});
                                }
                              });
                                 }
                                 
                             }); 
                            

                            
                            
                           return false;
                            }));
                        }
                        else{
                            removeBtn.stop(true,true).fadeOut().off();
                        }
                        
                        e.preventDefault();
			e.stopPropagation();
			})
                        
               
})

</script>
<ul class="nav-sidebar well  nav-list panel-group" id="admin_menu">
    <?php if ($user): ?>
        <li><strong><?php echo ($user['AdministrationUser']['username']); ?></strong></li>
        <li>
            <?php
            echo $this->Html->link(' <i class="fa fa-sign-out"></i> Déconnexion', array(
                'plugin' => 'administration',
                'controller' => 'AdministrationUsers',
                'action' => 'logout'
                    ), array('escape' => false))
            ?>
        </li>
        <li><?php
            echo $this->Html->link(' <i class="fa fa-pencil"></i> Modifier mon profil / Ajouter des médias', array(
                'plugin' => 'administration',
                'controller' => 'AdministrationUsers',
                'action' => 'edit'), array('escape' => false))
            ?></li>
    <?php if (CakePlugin::loaded('Annuaire')): ?>
            <li class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#admin_menu" href="#listeActivites" class="collapsed">
                            Activités
                        </a>
                    </h4>
                </div>
                <div id="listeActivites" class="panel-collapse collapse" style="height: 0px;">
                        <div class="panel-body">
                    <ul class=" list-unstyled editable-items">
                      
                         <?php foreach ($user['AvailablesFicheactivite'] as $activite): ?>
                            <li >
                                <?php
                               if ($activite['controller']=='BufferedFicheactivite') echo '<i class="fa fa-fw fa-clock-o"></i> ' ;
                                echo $this->Html->link($activite['nom_complet'], array(
                                    'controller' =>$activite['controller'],
                                    'action' => 'edit',
                                    $activite['id']
                                    
                                ));
                                
                                ?>
                                <button class="remove" data-name="<?php echo $activite['nom_complet']; ?>" data-action="<?php echo $this->Html->url( array(
                                    'controller' => $activite['controller'],
                                    'action' => 'delete',
                                    $activite['id']
                                    
                                )); ?>" style="display: none;"><i class="fa fa-trash-o"></i></button>
                            </li>
                        <?php endforeach; ?>
                       
                        </ul>    
                       <?php
                                echo $this->Html->link(' <i class="fa fa-plus-circle fa-fw"></i> Ajouter une activité', array(
                                    'plugin' => 'administration',
                                    'controller' => 'BufferedFicheactivites',
                                    'action' => 'add'), array('class'=>'btn btn-primary btn-sm','escape' => false))
                                ?>
                        </div>                 
                </div>
            </li>
        <?php endif; ?>
        <?php if (CakePlugin::loaded('Agenda')): ?>
            <li class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#admin_menu" href="#listeEvenements" class="collapsed">
                            Evenements
                        </a>
                    </h4>
                </div>
                <div id="listeEvenements" class="panel-collapse collapse" style="height: 0px;">
                    <div class="panel-body">
                        <?php $treeAvailablesEvenement= $this->RicTree->createTree($user['AvailablesEvenement']); ?>
                    <ul class=" list-unstyled editable-items">
                      <?php echo ($this->RicTree->displayTree($user['AvailablesEvenement']));?>
                        
                        </ul>    
                       <?php
                                echo $this->Html->link(' <i class="fa fa-plus-circle fa-fw"></i> Ajouter un événement', array(
                                    'plugin' => 'administration',
                                    'controller' => 'BufferedEvenements',
                                    'action' => 'add'), array('class'=>'btn btn-primary btn-sm','escape' => false))
                                ?>                    </div>
                </div>
            </li>
        <?php endif; ?>
    <?php endif; ?>



</ul>