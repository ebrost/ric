<?php $this->extend('/Common/contentView'); ?>

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
                 </div>
            </div>
            <div class="row">
               <?php if(!empty($evenement['Image'])) :?>
	
                   <div class="col-md-9">
					<?php else: ?>
						<div class="col-md-12">
					<?php endif; ?>
                        <adress>
                            <?php if (!empty($evenement['Evenement']['adresse'])): ?>
                                <?php echo $evenement['Evenement']['adresse']; ?><br />
                                <?php echo $evenement['Evenement']['code_postal']; ?> <?php echo $evenement['Evenement']['ville']; ?>
<?php endif; ?>	
                        </adress>
                        <ul class="list-unstyled">
                                <?php if (!empty($evenement['Evenement']['telephone'])): ?>
                                <li><i class="fa fa-phone"></i> <?php echo $evenement['Evenement']['telephone']; ?>
                                    <?php if (!empty($evenement['Evenement']['telephone2'])): ?>
                                        - <?php echo $evenement['Evenement']['telephone2']; ?>
    <?php endif; ?>

                                </li>
                            <?php endif; ?>
                            <?php if (!empty($evenement['Evenement']['mobile'])): ?>
                                <li><i class="fa fa-mobile-phone"></i> <?php echo $evenement['Evenement']['mobile']; ?></li>
                            <?php endif; ?>
                            <?php if (!empty($evenement['Evenement']['telecopie'])): ?>
                                <li><?php echo $evenement['Evenement']['telecopie']; ?></li>
                            <?php endif; ?>
                            <?php if (!empty($evenement['Evenement']['url_site_web'])): ?>
                                <li><a href="http://<?php echo $evenement['Evenement']['url_site_web']; ?>" target="_blank"><i class="fa fa-link"></i> <?php echo $evenement['Evenement']['url_site_web']; ?></a></li>
                            <?php endif; ?>
                            <?php if (!empty($evenement['Evenement']['email'])): ?>
                                <li><a href="mailto:<?php echo $evenement['Evenement']['email']; ?>"><i class="fa fa-envelope"></i>  <?php echo $evenement['Evenement']['email']; ?></a></li>
<?php endif; ?>
                        </ul>
                        <div class="well well-small">
<?php if (!empty($evenement['Evenement']['activites'])): ?>
                                <p class="activites">
                                    <span class="label label-default">Activité(s)</span><br><?php echo $evenement['Evenement']['activites']; ?>
                                    <?php if (!empty($evenement['Evenement']['precision_activites'])): ?>
                                         - <?php echo $evenement['Evenement']['precision_activites']; ?>
                                <?php endif; ?>
                                </p>
                            <?php endif; ?>

<?php if (!empty($evenement['Evenement']['genres'])): ?>
                                <p class="genre">
                                    <span class="label label-default">Domaine(s)</span><br><?php echo $evenement['Evenement']['genres']; ?>
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



                        <ul class="nav nav-tabs" id="tabs">
                            <li id="informations_generales_tab"><a href="#informations_generales">Informations générales</a></li>
                            <li id="informations_complementaires_tab"><a href="#informations_complementaires">Informations complémentaires</a></li>
                            <li id="medias_tab"><a href="#medias">Médias</a></li>
                          <li id="documents_tab"><a href="#documents">Documents</a></li>
                             <?php  if (CakePlugin::loaded('Annuaire')) : ?>
                            <script>
                            $(function() {
                              $(".tab-content").append($('<div id="annuaire" class="tab-pane fade"/>' ))
                              $("#tabs").append($( '<li id="annuaire_tab"><a href="#annuaire">Coordonnées</a></li>' ))
                              
                              $("#annuaire_tab a").click(function(e){
                                    e.preventDefault();
                                     $(this).tab('show')
                              }).on('shown.bs.tab', function (e) {
                                  var content=($(e.target).attr("href"))
                              
                                $(content).load("<?php echo $this->Html->url('/annuaire/ficheactivites/embededView/' . $evenement['Evenement']['ficheactivite_id'], array('return')); ?>")  
                            })
                            
                            })
                            </script>
                            
                           <?php
                            
                           
                            //debug($ficheactivite);
                            
                            ?>
                        <?php endif;?>
                        </ul>
                        <div class="tab-content">
                            <div id="informations_generales" class="tab-pane fade">
                                    <?php if (!empty($evenement['Evenement']['commentaires'])): ?>
                                    <p class="commentaires">
                                    <?php echo nl2br(str_replace('*','<br />',$evenement['Evenement']['commentaires'])); ?>
                                    </p>
                                <?php endif; ?> 
<?php if (!empty($evenement['Evenement']['commentaires_arts_visuels'])): ?>
                                    <dl class="dl_list">
<dt>Commentaires arts visuels : </dt>
<dd><?php echo nl2br($evenement['Evenement']['commentaires_arts_visuels']); ?></dd>
</dl>
                                <?php endif; ?>
<?php if (!empty($evenement['Evenement']['commentaires_arts_visuels'])): ?>
                                    <dl class="dl_list">
<dt>Commentaires audiovisuels : </dt>
<dd><?php echo nl2br($evenement['Evenement']['commentaires_audio_visuel']); ?></dd>
</dl>
                                <?php endif; ?> 
<?php if (!empty($evenement['Evenement']['commentaires_livre'])): ?>
                                    <dl class="dl_list">
<dt>Commentaires livre : </dt>
<dd><?php echo nl2br($evenement['Evenement']['commentaires_livre']); ?></dd>
</dl>
                                <?php endif; ?>
<?php if (!empty($evenement['Evenement']['commentaires_patrimoine'])): ?>
                                    <dl class="dl_list">
<dt>Commentaires patrimoine : </dt>
<dd><?php echo nl2br($evenement['Evenement']['commentaires_patrimoine']); ?></dd>
</dl>
                                <?php endif; ?> 
<?php if (!empty($evenement['Evenement']['commentaires_spectacle'])): ?>
                                    <dl class="dl_list">
<dt>Commentaires spectacle : </dt>
<dd><?php echo nl2br($evenement['Evenement']['commentaires_spectacle']); ?></dd>
</dl>
<?php endif; ?>
                            </div>
                            <div id="informations_complementaires" class="tab-pane fade">

<?php if (!empty($evenement['Evenement']['siret'])): ?>
                                    <dl class="dl_list">
<dt>Siret : </dt>
<dd><?php echo $evenement['Evenement']['siret']; ?></dd>
</dl>
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['apenaf'])): ?>
                                    <dl class="dl_list">
<dt>APE / NAF : </dt>
<dd><?php echo $evenement['Evenement']['apenaf']; ?></dd>
</dl>
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['annee_creation'])): ?>
                                    <dl class="dl_list">
<dt>Année de création : </dt>
<dd><?php echo $evenement['Evenement']['annee_creation']; ?></dd>
</dl>
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['annee_construction'])): ?>
                                    <dl class="dl_list">
<dt>Année de construction : </dt>
<dd><?php echo $evenement['Evenement']['annee_construction']; ?></dd>
</dl>
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['forme_juridique'])): ?>
                                    <dl class="dl_list">
<dt>Forme juridique : </dt>
<dd><?php echo $evenement['Evenement']['forme_juridique']; ?></dd>
</dl>
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['jauge'])): ?>
                                    <dl class="dl_list">
<dt>Jauge : </dt>
<dd><?php echo $evenement['Evenement']['jauge']; ?></dd>
</dl>
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['capacite'])): ?>
                                    <dl class="dl_list">
<dt>Capacité : </dt>
<dd><?php echo $evenement['Evenement']['capacite']; ?></dd>
</dl>
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['scene'])): ?>
                                    <dl class="dl_list">
<dt>Scène : </dt>
<dd><?php echo $evenement['Evenement']['scene']; ?></dd>
</dl>
<?php endif; ?>


<?php if (!empty($evenement['Evenement']['revetement'])): ?><
                                    <dl class="dl_list">
<dt>Revetement : </dt>
<dd><?php echo $evenement['Evenement']['revetement']; ?></dd>
</dl>	
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['fosse_orchestre'])): ?>
                                    <dl class="dl_list">
<dt>Fosse d'orchestre : </dt>
<dd><?php echo $evenement['Evenement']['fosse_orchestre']; ?></dd>
</dl>
<?php endif; ?>


<?php if (!empty($evenement['Evenement']['capacite_assise'])): ?>
                                    <dl class="dl_list">
<dt>Capacité assise : </dt>
<dd><?php echo $evenement['Evenement']['capacite_assise']; ?></dd>
</dl>
<?php endif; ?>


<?php if (!empty($evenement['Evenement']['capacite_debout'])): ?>
                                    <dl class="dl_list">
<dt>Capacité debout : </dt>
<dd><?php echo $evenement['Evenement']['capacite_debout']; ?></dd>
</dl>
<?php endif; ?>


<?php if (!empty($evenement['Evenement']['scene_superficie'])): ?>
                                    <dl class="dl_list">
<dt>Superficie de la scène : </dt>
<dd><?php echo $evenement['Evenement']['scene_superficie']; ?></dd>
</dl>
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['salle_superficie'])): ?>
                                    <dl class="dl_list">
<dt>Superficie de la salle : </dt>
<dd><?php echo $evenement['Evenement']['salle_superficie']; ?></dd>
</dl>
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['effectif_artistique'])): ?>
                                    <dl class="dl_list">
<dt>Effectif artistique : </dt>
<dd><?php echo $evenement['Evenement']['effectif_artistique']; ?></dd>
</dl>
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['composition'])): ?>
                                    <dl class="dl_list">
<dt>Composition : </dt>
<dd><?php echo $evenement['Evenement']['composition']; ?></dd>
</dl>
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['periodicite'])): ?>
                                    <dl class="dl_list">
<dt>Périodicité : </dt>
<dd><?php echo $evenement['Evenement']['periodicite']; ?></dd>
</dl>
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['periode_realisation'])): ?>
                                    <dl class="dl_list">
<dt>Période de réalisation : </dt>
<dd><?php echo $evenement['Evenement']['periode_realisation']; ?></dd>
</dl>
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['periode_preparation'])): ?>
                                    <dl class="dl_list">
<dt>Période de préparation : </dt>
<dd><?php echo $evenement['Evenement']['periode_preparation']; ?></dd>
</dl>
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['numero_agrement'])): ?>
                                    <dl class="dl_list">
<dt>Numéro d'agrément : </dt>
<dd><?php echo $evenement['Evenement']['numero_agrement']; ?></dd>
</dl>
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['effectif_audience'])): ?>
                                    <dl class="dl_list">
<dt>Effectif audience : </dt>
<dd><?php echo $evenement['Evenement']['effectif_audience']; ?></dd>
</dl>
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['capacite_accueil'])): ?>
                                    <dl class="dl_list">
<dt>Capacité d'accueil : </dt>
<dd><?php echo $evenement['Evenement']['capacite_accueil']; ?></dd>
</dl>
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['rcr'])): ?>
                                    <dl class="dl_list">
<dt>RCR : </dt>
<dd><?php echo $evenement['Evenement']['rcr']; ?></dd>
</dl>
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['mode_gestion'])): ?>
                                    <dl class="dl_list">
<dt>Mode de gestion : </dt>
<dd><?php echo $evenement['Evenement']['mode_gestion']; ?></dd>
</dl>
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['surface_m2'])): ?>
                                    <dl class="dl_list">
<dt>Surface en m2 : </dt>
<dd><?php echo $evenement['Evenement']['surface_m2']; ?></dd>
</dl>
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['acces_internet']) && $evenement['Evenement']['acces_internet'] != "Non"): ?>
                                    <dl class="dl_list">
<dt>Accès internet : </dt>
<dd><?php echo $evenement['Evenement']['acces_internet']; ?></dd>
</dl>
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['bibliobus']) && $evenement['Evenement']['bibliobus'] != "Non"): ?>
                                    <dl class="dl_list">
<dt>Bibliobus : </dt>
<dd><?php echo $evenement['Evenement']['bibliobus']; ?></dd>
</dl>	
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['liseuse']) && $evenement['Evenement']['liseuse'] != "Non"): ?>
                                    <dl class="dl_list">
<dt>Liseuse : </dt>
<dd><?php echo $evenement['Evenement']['liseuse']; ?></dd>
</dl>	
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['equipement_public_hand']) && $evenement['Evenement']['equipement_public_hand'] != "Non"): ?>
                                    <dl class="dl_list">
<dt>Equipement public handicapé : </dt>
<dd><?php echo $evenement['Evenement']['equipement_public_hand']; ?></dd>
</dl>	
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['intervention_aupres_pub']) && $evenement['Evenement']['intervention_aupres_pub'] != "Non"): ?>
                                    <dl class="dl_list">
<dt>Intervention auprès du public : </dt>
<dd><?php echo $evenement['Evenement']['intervention_aupres_pub']; ?></dd>
</dl>
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['surface_totale'])): ?>
                                    <dl class="dl_list">
<dt>Surface totale : </dt>
<dd><?php echo $evenement['Evenement']['surface_totale']; ?></dd>
</dl>	
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['surface_livre'])): ?>
                                    <dl class="dl_list">
<dt>Surface livre : </dt>
<dd><?php echo $evenement['Evenement']['surface_livre']; ?></dd>
</dl>	
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['nbr_reference'])): ?>
                                    <dl class="dl_list">
<dt>Nombre de références : </dt>
<dd><?php echo $evenement['Evenement']['nbr_reference']; ?></dd>
</dl>	
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['informatisation']) && $evenement['Evenement']['informatisation'] != "Non"): ?>
                                    <dl class="dl_list">
<dt>informatisation : </dt>
<dd><?php echo $evenement['Evenement']['informatisation']; ?></dd>
</dl>	
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['vente_en_ligne']) && $evenement['Evenement']['vente_en_ligne'] != "Non"): ?>
                                    <dl class="dl_list">
<dt>Vente en ligne : </dt>
<dd><?php echo $evenement['Evenement']['vente_en_ligne']; ?></dd>
</dl>	
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['gencod'])): ?>
                                    <dl class="dl_list">
<dt>GENCOD : </dt>
<dd><?php echo $evenement['Evenement']['gencod']; ?></dd>
</dl>	
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['nbr_titre_catalogue'])): ?>
                                    <dl class="dl_list">
<dt>Nombre de titres au catalogue : </dt>
<dd><?php echo $evenement['Evenement']['nbr_titre_catalogue']; ?></dd>
</dl>	
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['nbr_publication'])): ?>
                                    <dl class="dl_list">
<dt>Nombre de publications : </dt>
<dd><?php echo $evenement['Evenement']['nbr_publication']; ?></dd>
</dl>	
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['auto_diffusion']) && $evenement['Evenement']['auto_diffusion'] != "Non"): ?>
                                    <dl class="dl_list">
<dt>Auto-diffusion : </dt>
<dd><?php echo $evenement['Evenement']['auto_diffusion']; ?></dd>
</dl>	
                                <?php endif; ?> 

<?php if (!empty($evenement['Evenement']['auto_distribution']) && $evenement['Evenement']['auto_distribution'] != "Non"): ?>
                                    <dl class="dl_list">
<dt>Auto-distribution : </dt>
<dd><?php echo $evenement['Evenement']['auto_distribution']; ?></dd>
</dl>	
                                <?php endif; ?> 

<?php if (!empty($evenement['Evenement']['date_actualisation']) && $evenement['Evenement']['date_actualisation'] != "0000-00-00"): ?>
                                    <dl class="dl_list">
<dt>Date d'actualisation : </dt>
<dd><?php echo $evenement['Evenement']['date_actualisation']; ?></dd>
</dl>	
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['nom_prenom_destinataire'])): ?>
                                    <dl class="dl_list">
<dt>Destinataire : </dt>
<dd><?php echo $evenement['Evenement']['nom_prenom_destinataire']; ?></dd>
</dl>	
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['fonction_titre'])): ?>
                                    <dl class="dl_list">
<dt>Fonction titre : </dt>
<dd><?php echo $evenement['Evenement']['fonction_titre']; ?></dd>
</dl>	
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['e_mail_destinataire'])): ?>
                                    <p class="e_mail_destinataire">
                                        <span>Email du destinataire : </span><a href="mailto:<?php echo $evenement['Evenement']['e_mail_destinataire']; ?>" ><?php echo $evenement['Evenement']['e_mail_destinataire']; ?></a>
<?php endif; ?>


<?php if (!empty($evenement['Evenement']['liste_des_contacts'])): ?>
                                    <dl class="dl_list">
<dt>Liste des contacts : </dt>
<dd><?php echo $evenement['Evenement']['liste_des_contacts']; ?></dd>
</dl>	
                                <?php endif; ?> 

<?php if (!empty($evenement['Evenement']['type_public'])): ?>
                                    <dl class="dl_list">
<dt>Type de public : </dt>
<dd><?php echo $evenement['Evenement']['type_public']; ?></dd>
</dl>	
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['support'])): ?>
                                    <dl class="dl_list">
<dt>Support : </dt>
<dd><?php echo $evenement['Evenement']['support']; ?></dd>
</dl>	
                                <?php endif; ?> 

<?php if (!empty($evenement['Evenement']['rayonnement'])): ?>
                                    <dl class="dl_list">
<dt>Rayonnement : </dt>
<dd><?php echo $evenement['Evenement']['rayonnement']; ?></dd>
</dl>	
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['distinction'])): ?>
                                    <dl class="dl_list">
<dt>Distinction : </dt>
<dd><?php echo $evenement['Evenement']['distinction']; ?></dd>
</dl>	
                                <?php endif; ?>

<?php if (!empty($evenement['Evenement']['index_complementaire'])): ?>
                                    <dl class="dl_list">
<dt>Index complémentaire : </dt>
<dd><?php echo $evenement['Evenement']['index_complementaire']; ?></dd>
</dl>	
<?php endif; ?>

                            </div>
                            <div id="medias" class="tab-pane fade">
 <?php echo $this->element('externalMedias',array('medias'=>$evenement['ExternalMedia'])) ;?>


                            </div>
                             <div id="documents" class="tab-pane fade">
 <?php echo $this->element('documents',array('documents'=>$evenement['Document'])) ;?>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
