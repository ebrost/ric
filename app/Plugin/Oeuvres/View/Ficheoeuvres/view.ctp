<?php $this->extend('/Common/viewWithMenu'); ?>

<?php //$this->Html->css('Annuaire.annuaire', null, array('inline' => false));?>
<script>

    $(function() {
        Ric.viewTabs("#tabs");
        $.ajax({
            type: 'GET',
            url: jsBase + '/Ficheoeuvres/viewNav/<?php echo $ficheoeuvre['Ficheoeuvre']['id']; ?>/<?php echo addslashes($ficheoeuvre['Ficheoeuvre']['nom_complet']); ?><?php echo (isset($this->params['named']['num'])) ? '/num:' . $this->params['named']['num'] : ''; ?><?php echo (isset($this->params['named']['page'])) ? '/page:' . $this->params['named']['page'] : ''; ?><?php echo (isset($this->params['named']['q'])) ? '/q:' . $this->params['named']['q'] : ''; ?><?php echo (isset($this->params['named']['r'])) ? '/r:' . $this->params['named']['r'] : ''; ?>',
            dataType: 'html',
            success: function(Response) {
                $('#prevNextdetailBrowser').html(Response).fadeIn();
            }
        });
    });
</script>
<?php
if (!empty($ficheoeuvre)) {
    $this->start('map');
    ?>


    <?php echo $this->element('googleMap', array('items' => $ficheoeuvre, 'height' => 200)); ?>

    <?php
    $this->end();
}
?>
<?php $this->start('content-top'); ?>
<div id="prevNextdetailBrowser"></div>
<?php $this->end(); ?>

<?php debug($ficheoeuvre); ?>
<div class="row">
    <div class="col-md-12">
        <div class="main_content">
            <div id="item-header">
                <h3 class="pull-left title"><?php echo $ficheoeuvre['Ficheoeuvre']['nom_complet']; ?></h3>
                <div class="tools">

                    <?php
                    echo $this->Html->link(' <i class="fa fa-file-text"></i> Version Pdf', array(
                        'action' => 'view',
                        'ext' => 'pdf',
                        'id' => $ficheoeuvre['Ficheoeuvre']['id'],
                        'slug' => Inflector::slug($ficheoeuvre['Ficheoeuvre']['nom_complet']),
                            ), array('escape' => false, 'target' => 'pdf'))
                    ?>
                    <?php
                    echo $this->Html->link('<i class="fa fa-plus-circle"></i>  Ajouter à ma selection', 'javascript:void(0);', array(
                        'escape' => false,
                        'data-content-shortlist' => htmlspecialchars($this->RicImage->image($ficheoeuvre['Image'][0], 'icon')) .
                        '<div><a href=' . Router::url(null, true) . '>' . $ficheoeuvre['Ficheoeuvre']['nom_complet'] . '</a></div>',
                        'data-id-shortlist' => $ficheoeuvre['Ficheoeuvre']['id'],
                        'class' => 'add-to-list-js')
                    )
                    ?>


                    <?php echo $this->element('sendToFriend', array('modalID' => 'single', 'idList' => $ficheoeuvre['Ficheoeuvre']['id'], 'icon_large' => true)); ?>				

                </div>
            </div>
            <div class="row">
                <?php if (!empty($ficheoeuvre['Image'])) : ?>
                    <div class="col-md-3">

                        <?php echo $this->element('carousel', array('images' => $ficheoeuvre['Image'])); ?>
                    </div>	
                    <div class="col-md-9">
                    <?php else: ?>
                        <div class="col-md-12">
                        <?php endif; ?>

                      
                        <div class="well well-small">
                            <?php if (!empty($ficheoeuvre['Ficheoeuvre']['commentaires'])): ?>
                                    <p class="commentaires">
                                        <?php echo nl2br($ficheoeuvre['Ficheoeuvre']['commentaires']); ?>
                                    </p>
                                <?php endif; ?> 
                           
                        </div>



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
                                <?php if (!empty($ficheoeuvre['OeuvreGenre'])): ?>
                                <dl class=" dl_list">
                                    <dt>Genre(s) :</dt>
                                    <?php foreach ($ficheoeuvre['OeuvreGenre'] as $genre): ?>
                                        <dd><?php echo($genre['title']); ?></dd>
                                    <?php endforeach; ?>
                                </dl>
                            <?php endif; ?>
                                
                                <?php if (!empty($ficheoeuvre['OeuvreDiscipline'])): ?>
                                <dl class=" dl_list">
                                    <dt>Discipline(s) :</dt>
                                    <?php foreach ($ficheoeuvre['OeuvreDiscipline'] as $discipline): ?>
                                        <dd><?php echo($discipline['title']); ?></dd>
                                    <?php endforeach; ?>
                                </dl>
                            <?php endif; ?>

                            <?php if (!empty($ficheoeuvre['OeuvreActivite'])): ?>
                                <dl class=" dl_list">
                                    <dt>Activité(s) :</dt>
                                    <?php foreach ($ficheoeuvre['OeuvreActivite'] as $activite): ?>
                                        <dd><?php echo($activite['title']); ?></dd>
                                    <?php endforeach; ?>
                                </dl>
                            <?php endif; ?>

                            <?php if (!empty($ficheoeuvre['Typepublic'])): ?>
                                <dl class=" dl_list">
                                    <dt>Public(s) :</dt>
                                    <?php foreach ($ficheoeuvre['Typepublic'] as $typepublic): ?>
                                        <dd><?php echo($typepublic['title']); ?></dd>
                                    <?php endforeach; ?>
                                </dl>
                            <?php endif; ?>
                                <?php if (!empty($ficheoeuvre['Prix']['title'])): ?>
                                <dl class=" dl_list">
                                    <dt>Prix :</dt>
                                 
                                        <dd><?php echo($ficheoeuvre['Prix']['title']); ?></dd>
                                   
                                </dl>
                            <?php endif; ?>
                                <?php if (!empty($ficheoeuvre['Duree']['title'])): ?>
                                <dl class=" dl_list">
                                    <dt>Durée :</dt>
                                 
                                        <dd><?php echo($ficheoeuvre['Duree']['title']); ?></dd>
                                   
                                </dl>
                            <?php endif; ?>
                                <?php if (!empty($ficheoeuvre['Jauge']['title'])): ?>
                                <dl class=" dl_list">
                                    <dt>Jauge :</dt>
                                 
                                        <dd><?php echo($ficheoeuvre['Jauge']['title']); ?></dd>
                                   
                                </dl>
                            <?php endif; ?>
                                
                                <hr>
                                 <?php if (!empty($ficheoeuvre['Ficheoeuvre']['auteur'])): ?>
                                <dl class=" dl_list">
                                    <dt>Auteur(s) :</dt>

                                    <dd><?php echo $ficheoeuvre['Ficheoeuvre']['auteur']; ?></dd>

                                </dl>
                            <?php endif; ?>
                                 <?php if (!empty($ficheoeuvre['Ficheoeuvre']['co-auteur'])): ?>
                                <dl class=" dl_list">
                                    <dt>Co-auteur(s) :</dt>

                                    <dd><?php echo $ficheoeuvre['Ficheoeuvre']['co-auteur']; ?></dd>

                                </dl>
                            <?php endif; ?>
                              <?php if (!empty($ficheoeuvre['Ficheoeuvre']['compositeur'])): ?>
                                <dl class=" dl_list">
                                    <dt>Compositeur(s) :</dt>

                                    <dd><?php echo $ficheoeuvre['Ficheoeuvre']['compositeur']; ?></dd>

                                </dl>
                            <?php endif; ?>
                                 <?php if (!empty($ficheoeuvre['Ficheoeuvre']['choregraphe'])): ?>
                                <dl class=" dl_list">
                                    <dt>Chorégraphe(s) :</dt>

                                    <dd><?php echo $ficheoeuvre['Ficheoeuvre']['choregraphe']; ?></dd>

                                </dl>
                            <?php endif; ?>
                                 <?php if (!empty($ficheoeuvre['Ficheoeuvre']['metteurenscene'])): ?>
                                <dl class=" dl_list">
                                    <dt>Metteur(s)-en-scène :</dt>

                                    <dd><?php echo $ficheoeuvre['Ficheoeuvre']['metteurenscene']; ?></dd>

                                </dl>
                            <?php endif; ?>
                            <?php if (!empty($ficheoeuvre['Ficheoeuvre']['producteur'])): ?>
                                <dl class=" dl_list">
                                    <dt>Producteur(s) :</dt>

                                    <dd><?php echo $ficheoeuvre['Ficheoeuvre']['producteur']; ?></dd>

                                </dl>
                            <?php endif; ?>
                               
                            </div>
                            <div id="informations_complementaires" class="tab-pane fade">
                                    <?php if (!empty($ficheoeuvre['Ficheoeuvre']['anneecreation'])): ?>
                                        <dl class=" dl_list">
                                            <dt>Année de création :</dt>
                                            <dd><?php echo $ficheoeuvre['Ficheoeuvre']['anneecreation']; ?></dd>
                                        </dl>
                                    <?php endif; ?>
                                    <?php if (!empty($ficheoeuvre['Ficheoeuvre']['profondeurminimale'])): ?>
                                        <dl class=" dl_list">
                                            <dt>Profondeur minimale :</dt>
                                            <dd><?php echo $ficheoeuvre['Ficheoeuvre']['profondeurminimale']; ?></dd>
                                        </dl>
                                    <?php endif; ?>
                                    <?php if (!empty($ficheoeuvre['Ficheoeuvre']['ouvertureminimale'])): ?>
                                        <dl class=" dl_list">
                                            <dt>Ouverture minimale :</dt>
                                            <dd><?php echo $ficheoeuvre['Ficheoeuvre']['ouvertureminimale']; ?></dd>
                                        </dl>
                                    <?php endif; ?>
                                    <?php if (!empty($ficheoeuvre['Ficheoeuvre']['disponibilitespectacle'])): ?>
                                        <dl class=" dl_list">
                                            <dt>Disponibilité :</dt>
                                            <dd><?php echo $ficheoeuvre['Ficheoeuvre']['disponibilitespectacle']; ?></dd>
                                        </dl>
                                    <?php endif; ?>
                                    <?php if (!empty($ficheoeuvre['Ficheoeuvre']['projetencours'])): ?>
                                        <dl class=" dl_list">
                                            <dt>Projet en cours :</dt>
                                            <dd><?php echo $ficheoeuvre['Ficheoeuvre']['projetencours']; ?></dd>
                                        </dl>
                                    <?php endif; ?>
                                <?php if (!empty($ficheoeuvre['Ficheoeuvre']['interprete'])): ?>
                                        <dl class=" dl_list">
                                            <dt>Interprète(s) :</dt>
                                            <dd><?php echo $ficheoeuvre['Ficheoeuvre']['interprete']; ?></dd>
                                        </dl>
                                    <?php endif; ?>
                                <?php if (!empty($ficheoeuvre['Ficheoeuvre']['distributeur'])): ?>
                                        <dl class=" dl_list">
                                            <dt>Distributeur :</dt>
                                            <dd><?php echo $ficheoeuvre['Ficheoeuvre']['distributeur']; ?></dd>
                                        </dl>
                                    <?php endif; ?>
                                <?php if (!empty($ficheoeuvre['Ficheoeuvre']['scenariste'])): ?>
                                        <dl class=" dl_list">
                                            <dt>Scénariste :</dt>
                                            <dd><?php echo $ficheoeuvre['Ficheoeuvre']['scenariste']; ?></dd>
                                        </dl>
                                    <?php endif; ?>
                                <?php if (!empty($ficheoeuvre['Ficheoeuvre']['realisateur'])): ?>
                                        <dl class=" dl_list">
                                            <dt>Réalisateur :</dt>
                                            <dd><?php echo $ficheoeuvre['Ficheoeuvre']['realisateur']; ?></dd>
                                        </dl>
                                    <?php endif; ?>
                                <?php if (!empty($ficheoeuvre['Ficheoeuvre']['labels'])): ?>
                                        <dl class=" dl_list">
                                            <dt>Label(s) :</dt>
                                            <dd><?php echo $ficheoeuvre['Ficheoeuvre']['labels']; ?></dd>
                                        </dl>
                                    <?php endif; ?>
                                <?php if (!empty($ficheoeuvre['Ficheoeuvre']['traducteur'])): ?>
                                        <dl class=" dl_list">
                                            <dt>Traducteur :</dt>
                                            <dd><?php echo $ficheoeuvre['Ficheoeuvre']['traducteur']; ?></dd>
                                        </dl>
                                    <?php endif; ?>
                                 <?php if (!empty($ficheoeuvre['Ficheoeuvre']['illustrateur'])): ?>
                                        <dl class=" dl_list">
                                            <dt>Illustrateur :</dt>
                                            <dd><?php echo $ficheoeuvre['Ficheoeuvre']['illustrateur']; ?></dd>
                                        </dl>
                                    <?php endif; ?>
                                 <?php if (!empty($ficheoeuvre['Ficheoeuvre']['isbn'])): ?>
                                        <dl class=" dl_list">
                                            <dt>Isbn :</dt>
                                            <dd><?php echo $ficheoeuvre['Ficheoeuvre']['isbn']; ?></dd>
                                        </dl>
                                    <?php endif; ?>
                                 <?php if (!empty($ficheoeuvre['Ficheoeuvre']['gencod'])): ?>
                                        <dl class=" dl_list">
                                            <dt>Gencod :</dt>
                                            <dd><?php echo $ficheoeuvre['Ficheoeuvre']['gencod']; ?></dd>
                                        </dl>
                                    <?php endif; ?>
                                 <?php if (!empty($ficheoeuvre['Ficheoeuvre']['nomcollection'])): ?>
                                        <dl class=" dl_list">
                                            <dt>Nom de collection :</dt>
                                            <dd><?php echo $ficheoeuvre['Ficheoeuvre']['nomcollection']; ?></dd>
                                        </dl>
                                    <?php endif; ?>
                                 <?php if (!empty($ficheoeuvre['Ficheoeuvre']['lieuedition'])): ?>
                                        <dl class=" dl_list">
                                            <dt>Lieu d'édition :</dt>
                                            <dd><?php echo $ficheoeuvre['Ficheoeuvre']['lieuedition']; ?></dd>
                                        </dl>
                                    <?php endif; ?>
                                 <?php if (!empty($ficheoeuvre['Ficheoeuvre']['reedition'])): ?>
                                        <dl class=" dl_list">
                                            <dt>Réedition :</dt>
                                            <dd><?php echo $ficheoeuvre['Ficheoeuvre']['reedition']; ?></dd>
                                        </dl>
                                    <?php endif; ?>
                                 <?php if (!empty($ficheoeuvre['Ficheoeuvre']['leformat'])): ?>
                                        <dl class=" dl_list">
                                            <dt>Format :</dt>
                                            <dd><?php echo $ficheoeuvre['Ficheoeuvre']['leformat']; ?></dd>
                                        </dl>
                                    <?php endif; ?>
                                 <?php if (!empty($ficheoeuvre['Ficheoeuvre']['nombrepage'])): ?>
                                        <dl class=" dl_list">
                                            <dt>Nombre de pages :</dt>
                                            <dd><?php echo $ficheoeuvre['Ficheoeuvre']['nombrepage']; ?></dd>
                                        </dl>
                                    <?php endif; ?>
                                 <?php if (!empty($ficheoeuvre['Ficheoeuvre']['numdewey'])): ?>
                                        <dl class=" dl_list">
                                            <dt>Dewey :</dt>
                                            <dd><?php echo $ficheoeuvre['Ficheoeuvre']['numdewey']; ?></dd>
                                        </dl>
                                    <?php endif; ?>
                                 <?php if (!empty($ficheoeuvre['Ficheoeuvre']['anneeedition'])): ?>
                                        <dl class=" dl_list">
                                            <dt>Année d'édition :</dt>
                                            <dd><?php echo $ficheoeuvre['Ficheoeuvre']['anneeedition']; ?></dd>
                                        </dl>
                                    <?php endif; ?>
                               
                                <?php if (!empty($ficheoeuvre['Ficheoeuvre']['anneeedition'])): ?>
                                        <dl class=" dl_list">
                                            <dt>Année d'édition :</dt>
                                            <dd><?php echo $ficheoeuvre['Ficheoeuvre']['anneeedition']; ?></dd>
                                        </dl>
                                    <?php endif; ?>
                                <?php if (!empty($ficheoeuvre['Ficheoeuvre']['auteur_origine'])): ?>
                                        <dl class=" dl_list">
                                            <dt>Auteur d'origine :</dt>
                                            <dd><?php echo $ficheoeuvre['Ficheoeuvre']['auteur_origine']; ?></dd>
                                        </dl>
                                    <?php endif; ?>
                                <?php if (!empty($ficheoeuvre['Ficheoeuvre']['co_auteur_origine'])): ?>
                                        <dl class=" dl_list">
                                            <dt>Co-auteur d'origine :</dt>
                                            <dd><?php echo $ficheoeuvre['Ficheoeuvre']['co_auteur_origine']; ?></dd>
                                        </dl>
                                    <?php endif; ?>
                                <?php if (!empty($ficheoeuvre['Ficheoeuvre']['editeur_origine'])): ?>
                                        <dl class=" dl_list">
                                            <dt>Editeur d'origine :</dt>
                                            <dd><?php echo $ficheoeuvre['Ficheoeuvre']['editeur_origine']; ?></dd>
                                        </dl>
                                    <?php endif; ?>
                                <?php if (!empty($ficheoeuvre['Ficheoeuvre']['langueorigine'])): ?>
                                        <dl class=" dl_list">
                                            <dt>Langue d'origine :</dt>
                                            <dd><?php echo $ficheoeuvre['Ficheoeuvre']['langueorigine']; ?></dd>
                                        </dl>
                                    <?php endif; ?>
                                <?php if (!empty($ficheoeuvre['Ficheoeuvre']['languetraduite'])): ?>
                                        <dl class=" dl_list">
                                            <dt>Langue Traduite :</dt>
                                            <dd><?php echo $ficheoeuvre['Ficheoeuvre']['languetraduite']; ?></dd>
                                        </dl>
                                    <?php endif; ?>
                                <?php if (!empty($ficheoeuvre['Ficheoeuvre']['annee1erpublication'])): ?>
                                        <dl class=" dl_list">
                                            <dt>Année de la 1ère publication :</dt>
                                            <dd><?php echo $ficheoeuvre['Ficheoeuvre']['annee1erpublication']; ?></dd>
                                        </dl>
                                    <?php endif; ?>
                            </div>
                            <div id="medias" class="tab-pane fade">

                                <?php echo $this->element('externalMedias', array('medias' => $ficheoeuvre['ExternalMedia'])); ?>


                            </div>
                            <div id="documents" class="tab-pane fade">
                                <?php echo $this->element('documents', array('documents' => $ficheoeuvre['Document'])); ?>


                            </div>
                            <div id ="social" class="tab-pane fade">
                                <?php if (!empty($ficheoeuvre['OeuvreLien'])): ?>
                                <ul class="list-unstyled">
                                   <?php foreach ($ficheoeuvre['OeuvreLien'] as $lien): ?>
                                    <li> <span class="link <?php echo $lien['title']; ?>"> <?php echo $this->Html->link($lien['url']); ?></span></li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php endif; ?>     
                            </div>
                             <?php if (CakePlugin::loaded('Annuaire')) : ?>
                            <div id="annuaire" class="tab-pane fade">
                                <?php echo $this->element('Annuaire.embededView',array('ficheactivite'=>$ficheoeuvre['Ficheactivite'],'displayLink'=>true)); ?>
                                
                            </div>
                                <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

