<?php $this->extend('/Common/viewWithMenu'); ?>


<script>

    $(function() {
        Ric.viewTabs("#tabs");
        $.ajax({
            type: 'GET',
            url: jsBase + '/Evenements/viewNav/<?php echo $evenement['Evenement']['id']; ?>/<?php echo $evenement['Evenement']['premieredatesession']; ?>/<?php echo (isset($this->params['named']['num'])) ? '/num:' . $this->params['named']['num'] : ''; ?><?php echo (isset($this->params['named']['page'])) ? '/page:' . $this->params['named']['page'] : ''; ?><?php echo (isset($this->params['named']['q'])) ? '/q:' . $this->params['named']['q'] : ''; ?><?php echo (isset($this->params['named']['r'])) ? '/r:' . $this->params['named']['r'] : ''; ?>',
            dataType: 'html',
            success: function(Response) {
                $('#prevNextdetailBrowser').html(Response).fadeIn();
            }
        });
    });
</script>
<?php
if (!empty($evenement)) {
   

foreach($evenement['Session'] as $keySession=> $session){

            $sessions[$keySession]['Evenement']= $session;
            $sessions[$keySession]['Evenement']['nom_complet']=$evenement['Evenement']['nom_complet'];
            $sessions[$keySession]['Evenement']['id']=$evenement['Evenement']['id'];
            $sessions[$keySession]['Evenement']['num']=$evenement['Evenement']['num'];
            $sessions[$keySession]['Evenement']['r']=$evenement['Evenement']['relevance'];
            $sessions[$keySession]['Evenement']['adresse']= $session['lieu'];
            $sessions[$keySession]['Image'][0]= $evenement['Image'][0];
            $sessions[$keySession]['Evenement']['additional_content']=$session['resume_session'];
            
        }
 $this->start('map');
    echo $this->element('googleMap', array('items' => $sessions, 'height' => 200));
    $this->end();
}
?>
<?php $this->start('content-top'); ?>
<div id="prevNextdetailBrowser"></div>
<?php $this->end(); ?>


<div class="row">
    <div class="col-md-12">
        <div class="main_content">
            <div id="item-header">
                <h3 class="pull-left title"><?php echo $evenement['Evenement']['nom_complet']; ?><ul class="tags">
                                <?php foreach ($evenement['Tag'] as $tag): ?>
                                <li class="tag_<?php echo($tag['id']); ?>"><span><?php echo($tag['name']); ?></span></li>
                                <?php endforeach;?>
                            </ul></h3>
                 
                <div class="tools">

                    <?php
                    echo $this->Html->link(' <i class="fa fa-file-text"></i> Version Pdf', array(
                        'action' => 'view',
                        'ext' => 'pdf',
                        'id' => $evenement['Evenement']['id'],
                        'slug' => Inflector::slug($evenement['Evenement']['nom_complet']),
                            ), array('escape' => false,'target'=>'pdf'))
                    ?>
                    <?php
                    echo $this->Html->link('<i class="fa fa-plus-circle"></i>  Ajouter à ma selection', 'javascript:void(0);', array(
                        'escape' => false,
                        'data-content-shortlist' => htmlspecialchars($this->RicImage->image($evenement['Image'][0], 'icon')) .
                        '<div><a href=' . Router::url(null, true) . '>' . $evenement['Evenement']['nom_complet'] . '</a></div>',
                        'data-id-shortlist' => $evenement['Evenement']['id'],
                        'class' => 'add-to-list-js')
                    )
                    ?>


                    <?php echo $this->element('sendToFriend', array('modalID' => 'single', 'idList' => $evenement['Evenement']['id'], 'icon_large' => true)); ?>				

                </div>
            </div>
            <div class="row">
                <?php if (!empty($evenement['Image'])) : ?>
                    <div class="col-md-3">

                        <?php echo $this->element('carousel', array('images' => $evenement['Image'])); ?>
                    </div>		
                    <div class="col-md-9">
                    <?php else: ?>
                        <div class="col-md-12">
                        <?php endif; ?>
                       
                        <ul class="list-unstyled">
                            
                            <?php if (!empty($evenement['Evenement']['mobile'])): ?>
                                <li><i class="fa fa-mobile-phone"></i> <?php echo $evenement['Evenement']['mobile']; ?></li>
                            <?php endif; ?>
                            <?php if (!empty($evenement['Evenement']['telecopie'])): ?>
                                <li><i class="fa fa-fax"></i> <?php echo $evenement['Evenement']['telecopie']; ?></li>
                            <?php endif; ?>
                            <?php if (!empty($evenement['Evenement']['url_site_web'])): ?>
                                <li><a href="http://<?php echo $evenement['Evenement']['url_site_web']; ?>" target="_blank"><i class="fa fa-link"></i> <?php echo $evenement['Evenement']['url_site_web']; ?></a></li>
                            <?php endif; ?>
                            <?php if (!empty($evenement['Evenement']['email'])): ?>
                                <li><a href="mailto:<?php echo $evenement['Evenement']['email']; ?>"><i class="fa fa-envelope"></i>  <?php echo $evenement['Evenement']['email']; ?></a></li>
                            <?php endif; ?>
                        </ul>
                        <div class="well well-small">
                          
                            <strong><small><?php echo $evenement['Type']['name']; ?></small></strong>

                            <?php if (!empty($evenement['Evenement']['genres'])): ?>
                                <p class="genre">
                                    <span class="label label-default">Genre(s)</span><br><?php echo $evenement['Evenement']['genres']; ?>
                                </p>
                            <?php endif; ?>
                           

                            <?php if (!empty($evenement['Evenement']['disciplines'])): ?>
                                <p class="discipline">
                                    <span class="label label-default">Discipline(s)</span><br><?php echo $evenement['Evenement']['disciplines']; ?>
                                </p>
                            <?php endif; ?>
                              <?php if (!empty($evenement['Typepublic'])): ?>
                                <p class="typepublics">
                                    <span class="label label-default">Public(s)</span><br>
                                </p>
                                <ul class="typepublics">
                                <?php foreach ($evenement['Typepublic'] as $typepublic): ?>
                                <li><?php echo($typepublic['name']);?></li>
                                <?php endforeach;?>
                            <?php endif; ?>   
                        </div>

                        <?php if (!empty($evenement['Parent']['nom_complet'])): ?>
                            <div class="panel panel-info">
                                <div class="panel-body bg-info ">
                            dans le cadre de : <?php
                            echo $this->Html->link($evenement['Parent']['nom_complet'], array(
                                'plugin' => 'agenda',
                                'controller' => 'evenements',
                                'action' => 'view',
                                'id' => $evenement['Parent']['id'],
                                'slug' => Inflector::slug($evenement['Parent']['nom_complet'])
                            ));
                            ?>
                                </div></div>
                        <?php endif; ?>
                          
                             <?php if (!empty($evenement['Children'])): ?>
                            
                             <?php foreach ($evenement['Children'] as $evenementChild): ?>

            <div class="list-item">
                <div class="row">
                    
                        <?php if (!empty($evenementChild['Image'][0])): ?><div class="col-md-2">
						<div class="thumbnail">
                                                    <?php echo $this->RicImage->image($evenementChild['Image'][0],'thumb');?>
							<?php //echo $this->element('thumbnail',array('imgThumb'=>$ficheactivite['Ficheactivite']['thumbnail'],'imgWidth'=>140,'imgHeight'=>140)) ;?>
						</div>
                        </div>
					<?php endif;?>
                    
                    <div class="col-md-10">
                        
                        <div class="text_content<?php echo($evenementChild['annule']==1)?" annule":"";?> ">
                        <h4 class="evenement_title well well-small" >
                          
                            <?php
                            echo $this->Html->link($evenementChild['nom_complet'], array(
                                'plugin' => 'agenda',
                                'controller' => 'evenements',
                                'action' => 'view',
                                'id' => $evenementChild['id'],
                                'slug' => Inflector::slug($evenementChild['nom_complet'])
                                
                            ));
                            ?>
                            <small><?php echo $evenementChild['Type']['name']; ?></small>
                        
                       
                        </h4>      
                            <p class="small"><strong><?php echo $evenementChild['genres']; ?></strong><br/></p>
                           
                            <div class="resume_sessions">
                               
                            <?php echo $this->element('sessionResume', array('evenement' => $evenementChild,'displayLink'=>false, 'displayAdresse'=>true)); ?>
                            
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        <?php endforeach; ?>


                        <?php endif; ?>
                       
                        <?php if (!empty($evenement['Session'])): ?>


                                                    <div class="well">
                             <?php echo $this->element('sessionResume', array('evenement' => $evenement,'displayLink'=>false,'maxSessionsByEventOnList' => -1,'displayAdresse'=>true)); ?>
                                      </div>
                        <?php endif; ?>
                        <?php debug($evenement);?>
                        <ul class="nav nav-tabs" id="tabs">
                            <li id="informations_generales_tab"><a href="#informations_generales">Informations générales</a></li>
                            <li id="informations_complementaires_tab"><a href="#informations_complementaires">Informations complémentaires</a></li>
                            <li id="medias_tab"><a href="#medias">Médias</a></li>
                            <li id="documents_tab"><a href="#documents">Documents</a></li>
                            <li id="social_tab"><a href="#social">Liens et réseaux sociaux</a></li>
                        <?php if (CakePlugin::loaded('Annuaire')) : ?>
                            <li id="annuaire_tab"><a href="#annuaire">Coordonnées</a></li>
                        <?php endif; ?>
                        </ul>
                        <div class="tab-content">
                            <div id="informations_generales" class="tab-pane fade">
                                <?php if (!empty($evenement['Evenement']['commentaires'])): ?>
                                    <p class="commentaires">
                                        <?php echo nl2br(str_replace('*', '<br />', $evenement['Evenement']['commentaires'])); ?>
                                    </p>
                                <?php endif; ?> 
                                <?php if (!empty($evenement['Evenement']['commentaires_arts_visuels'])): ?>
                                    <p class="commentaires_arts_visuels">
                                        <?php echo nl2br($evenement['Evenement']['commentaires_arts_visuels']); ?>
                                    </p>
                                <?php endif; ?>
                                <?php if (!empty($evenement['Evenement']['commentaires_arts_visuels'])): ?>
                                    <p class="commentaires_audio_visuels">
                                        <?php echo nl2br($evenement['Evenement']['commentaires_audio_visuel']); ?>
                                    </p>
                                <?php endif; ?> 
                                <?php if (!empty($evenement['Evenement']['commentaires_livre'])): ?>
                                    <p class="commentaires_livre">
                                        <?php echo nl2br($evenement['Evenement']['commentaires_livre']); ?>
                                    </p>
                                <?php endif; ?>
                                <?php if (!empty($evenement['Evenement']['commentaires_patrimoine'])): ?>
                                    <p class="commentaires_patrimoine">
                                        <?php echo nl2br($evenement['Evenement']['commentaires_patrimoine']); ?>
                                    </p>
                                <?php endif; ?> 
                                <?php if (!empty($evenement['Evenement']['commentaires_spectacle'])): ?>
                                    <p class="commentaires_spectacle">
                                        <?php echo nl2br($evenement['Evenement']['commentaires_spectacle']); ?>
                                    </p>
                                <?php endif; ?>
                                
                                    
                            </div>
                            <div id="informations_complementaires" class="tab-pane fade">

                               
                                <?php if (!empty($evenement['Evenement']['date_actualisation']) && $evenement['Evenement']['date_actualisation'] != "0000-00-00"): ?>
                                    <dl class="dl_list">
<dt>Date d'actualisation : </dt>
<dd><?php echo $evenement['Evenement']['date_actualisation']; ?></dd>
</dl>	
                                <?php endif; ?>

                               

                            </div>
                            <div id="medias" class="tab-pane fade">
                                <?php echo $this->element('externalMedias', array('medias' => $evenement['ExternalMedia'])); ?>


                            </div>
                            <div id="documents" class="tab-pane fade">
                                <?php echo $this->element('documents', array('documents' => $evenement['Document'])); ?>


                            </div>
                            <div id ="social" class="tab-pane fade">
                                <?php if (!empty($evenement['AgendaLien'])): ?>
                                <ul class="list-unstyled">
                                   <?php foreach ($evenement['AgendaLien'] as $lien): ?>
                                    <li> <span class="link <?php echo $lien['title']; ?>"> <?php echo $this->Html->link($lien['url']); ?></span></li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php endif; ?>     
                            </div>
                             <?php if (CakePlugin::loaded('Annuaire')) : ?>
                            <div id="annuaire" class="tab-pane fade">
                                <?php if (!empty($evenement['Ficheactivite'])): ?>
                                <?php echo $this->element('Annuaire.embededView',array('ficheactivite'=>$evenement['Ficheactivite'],'displayLink'=>'true')); ?>
                                <?php endif; ?>
                            </div>
                                <?php endif; ?>
                           
                                 
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
   