<?php $this->extend('/Common/viewWithMenu'); ?>

<script>

    $(function() {
        Ric.viewTabs("#tabs");
        $.ajax({
            type: 'GET',
            url: jsBase + '/Ficheactivites/viewNav/<?php echo $ficheactivite['Ficheactivite']['id']; ?>/<?php echo addslashes($ficheactivite['Ficheactivite']['nom_complet']); ?><?php echo (isset($this->params['named']['num'])) ? '/num:' . $this->params['named']['num'] : ''; ?><?php echo (isset($this->params['named']['page'])) ? '/page:' . $this->params['named']['page'] : ''; ?><?php echo (isset($this->params['named']['q'])) ? '/q:' . $this->params['named']['q'] : ''; ?><?php echo (isset($this->params['named']['r'])) ? '/r:' . $this->params['named']['r'] : ''; ?>',
            dataType: 'html',
            success: function(Response) {
                $('#prevNextdetailBrowser').html(Response).fadeIn();
            }
        });
    });
</script>
<?php
if (!empty($ficheactivite)) {
    $this->start('map');
    ?>


    <?php echo $this->element('googleMap', array('items' => $ficheactivite, 'height' => 200)); ?>

    <?php
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
                <h3 class="pull-left title"><?php echo $ficheactivite['Ficheactivite']['nom_complet']; ?></h3>
                <div class="tools">

                    <?php
                    echo $this->Html->link(' <i class="fa fa-file-text"></i> Version Pdf', array(
                        'action' => 'view',
                        'ext' => 'pdf',
                        'id' => $ficheactivite['Ficheactivite']['id'],
                        'slug' => Inflector::slug($ficheactivite['Ficheactivite']['nom_complet']),
                            ), array('escape' => false, 'target' => 'pdf'))
                    ?>
                    <?php
                    echo $this->Html->link('<i class="fa fa-plus-circle"></i>  Ajouter à ma selection', 'javascript:void(0);', array(
                        'escape' => false,
                        'data-content-shortlist' => htmlspecialchars($this->RicImage->image($ficheactivite['Image'][0], 'icon')) .
                        '<div><a href=' . Router::url(null, true) . '>' . $ficheactivite['Ficheactivite']['nom_complet'] . '</a></div>',
                        'data-id-shortlist' => $ficheactivite['Ficheactivite']['id'],
                        'class' => 'add-to-list-js')
                    )
                    ?>

                 <?php echo $this->element('sendToFriend', array('modalID' => 'single', 'idList' => $ficheactivite['Ficheactivite']['id'], 'icon_large' => true)); ?>				

                </div>
            </div>
            <div class="row">
                <?php if (!empty($ficheactivite['Image'])) : ?>
                    <div class="col-md-3">

                        <?php echo $this->element('carousel', array('images' => $ficheactivite['Image'])); ?>
                    </div>	
                    <div class="col-md-9">
                    <?php else: ?>
                        <div class="col-md-12">
                        <?php endif; ?>

                        <adress>
                            <?php if (!empty($ficheactivite['Ficheactivite']['adresse'])): ?>
                                <?php echo $ficheactivite['Ficheactivite']['adresse']; ?><br />
                                <?php echo $ficheactivite['Ficheactivite']['code_postal']; ?> <?php echo $ficheactivite['Ficheactivite']['ville']; ?>
                            <?php endif; ?>	
                        </adress>
                        <ul class="list-unstyled">
                            <?php if (!empty($ficheactivite['Ficheactivite']['telephone'])): ?>
                                <li><i class="fa fa-phone"></i> <?php echo $ficheactivite['Ficheactivite']['telephone']; ?>
                                    <?php if (!empty($ficheactivite['Ficheactivite']['telephone2'])): ?>
                                        - <?php echo $ficheactivite['Ficheactivite']['telephone2']; ?>
                                    <?php endif; ?>

                                </li>
                            <?php endif; ?>
                            <?php if (!empty($ficheactivite['Ficheactivite']['mobile'])): ?>
                                <li><i class="fa fa-mobile-phone"></i> <?php echo $ficheactivite['Ficheactivite']['mobile']; ?></li>
                            <?php endif; ?>
                            <?php if (!empty($ficheactivite['Ficheactivite']['telecopie'])): ?>
                                <li><i class="fa fa-fax"></i> <?php echo $ficheactivite['Ficheactivite']['telecopie']; ?></li>
                            <?php endif; ?>
                            <?php if (!empty($ficheactivite['Ficheactivite']['url_site_web'])): ?>
                                <li><i class="fa fa-link"></i> <a href="http://<?php echo $ficheactivite['Ficheactivite']['url_site_web']; ?>" target="_blank"><?php echo $ficheactivite['Ficheactivite']['url_site_web']; ?></a></li>
                            <?php endif; ?>
                            <?php if (!empty($ficheactivite['Ficheactivite']['email'])): ?>
                                <li><i class="fa fa-envelope"></i>  <a href="mailto:<?php echo $ficheactivite['Ficheactivite']['email']; ?>"><?php echo $ficheactivite['Ficheactivite']['email']; ?></a></li>
                            <?php endif; ?>
                        </ul>
                        <div class="well well-small">
                            <?php if (!empty($ficheactivite['Ficheactivite']['activites'])): ?>
                                <p class="activites">
                                    <span class="label">Activité(s)</span><br><?php echo $ficheactivite['Ficheactivite']['activites']; ?>
                                    <?php if (!empty($ficheactivite['Ficheactivite']['precision_activites'])): ?>
                                         - <?php echo $ficheactivite['Ficheactivite']['precision_activites']; ?>
                                    <?php endif; ?>
                                </p>
                            <?php endif; ?>

                            <?php if (!empty($ficheactivite['Ficheactivite']['genres'])): ?>
                                <p class="genre">
                                    <span class="label">Domaine(s)</span><br><?php echo $ficheactivite['Ficheactivite']['genres']; ?>
                                </p>
                            <?php endif; ?>

                            <?php if (!empty($ficheactivite['Ficheactivite']['disciplines'])): ?>
                                <p class="discipline">
                                    <span class="label">Discipline(s)</span><br><?php echo $ficheactivite['Ficheactivite']['disciplines']; ?>
                                </p>
                            <?php endif; ?>		
                        </div>

                        <ul class="nav nav-tabs" id="tabs">
                            <li id="informations_generales_tab"><a href="#informations_generales">Informations générales</a></li>
                            <li id="informations_complementaires_tab"><a href="#informations_complementaires">Informations complémentaires</a></li>
                            <li id="medias_tab"><a href="#medias">Médias</a></li>
                            <li id="documents_tab"><a href="#documents">Documents</a></li>
                            <li id="social_tab"><a href="#social">Liens et réseaux sociaux</a></li>
                            <?php if (CakePlugin::loaded('Agenda') && !empty($ficheactivite['Evenement'])) : ?>
                                <script>
                                    $(function() {
                                        $(".tab-content").append($('<div id="evenements" class="tab-pane fade"/>'));
                                        $("#tabs").append($('<li id="evenements_tab"><a href="#evenements">Evénements</a></li>'));

                                        $("#evenements_tab a").click(function(e) {
                                            e.preventDefault();
                                            $(this).tab('show')
                                        }).on('shown.bs.tab', function(e) {
                                            var content = ($(e.target).attr("href"))

                                            $(content).load("<?php echo $this->Html->url('/agenda/evenements/embededListView/' . $ficheactivite['Ficheactivite']['id'], array('return')); ?>")
                                        })

                                    })
                                </script>
                            <?php endif; ?>
                        </ul>
                        <div class="tab-content">
                            <div id="informations_generales" class="tab-pane fade">
                                <?php if (!empty($ficheactivite['Ficheactivite']['commentaires'])): ?>
                                    <p class="commentaires">
                                        <?php echo nl2br($ficheactivite['Ficheactivite']['commentaires']); ?>
                                    </p>
                                <?php endif; ?> 
                                <?php if (!empty($ficheactivite['Ficheactivite']['commentaires_arts_visuels'])): ?>
                                    <p class="commentaires_arts_visuels">
                                        <?php echo nl2br($ficheactivite['Ficheactivite']['commentaires_arts_visuels']); ?>
                                    </p>
                                <?php endif; ?>
                                <?php if (!empty($ficheactivite['Ficheactivite']['commentaires_arts_visuels'])): ?>
                                    <p class="commentaires_audio_visuels">
                                        <?php echo nl2br($ficheactivite['Ficheactivite']['commentaires_audio_visuel']); ?>
                                    </p>
                                <?php endif; ?> 
                                <?php if (!empty($ficheactivite['Ficheactivite']['commentaires_livre'])): ?>
                                    <p class="commentaires_livre">
                                        <?php echo nl2br($ficheactivite['Ficheactivite']['commentaires_livre']); ?>
                                    </p>
                                <?php endif; ?>
                                <?php if (!empty($ficheactivite['Ficheactivite']['commentaires_patrimoine'])): ?>
                                    <p class="commentaires_patrimoine">
                                        <?php echo nl2br($ficheactivite['Ficheactivite']['commentaires_patrimoine']); ?>
                                    </p>
                                <?php endif; ?> 
                                <?php if (!empty($ficheactivite['Ficheactivite']['commentaires_spectacle'])): ?>
                                    <p class="commentaires_spectacle">
                                        <?php echo nl2br($ficheactivite['Ficheactivite']['commentaires_spectacle']); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                            <div id="informations_complementaires" class="tab-pane fade">

                                <?php if (!empty($ficheactivite['Ficheactivite']['siret'])): ?>
                                    <dl class="dl_list">
                                        <dt>Siret : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['siret']; ?></dd>
                                    </dl>
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['apenaf'])): ?>
                                    <dl class="dl_list">
                                        <dt>APE / NAF : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['apenaf']; ?></dd>
                                    </dl>
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['annee_creation'])): ?>
                                    <dl class="dl_list">
                                        <dt>Année de création : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['annee_creation']; ?></dd>
                                    </dl>
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['annee_construction'])): ?>
                                    <dl class="dl_list">
                                        <dt>Année de construction : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['annee_construction']; ?></dd>
                                    </dl>
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['forme_juridique'])): ?>
                                    <dl class="dl_list">
                                        <dt>Forme juridique : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['forme_juridique']; ?></dd>
                                    </dl>
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['jauge'])): ?>
                                    <dl class="dl_list">
                                        <dt>Jauge : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['jauge']; ?></dd>
                                    </dl>
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['capacite'])): ?>
                                    <dl class="dl_list">
                                        <dt>Capacité : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['capacite']; ?></dd>
                                    </dl>
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['scene'])): ?>
                                    <dl class="dl_list">
                                        <dt>Scène : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['scene']; ?></dd>
                                    </dl>
                                <?php endif; ?>


                                <?php if (!empty($ficheactivite['Ficheactivite']['revetement'])): ?><
                                    <dl class="dl_list">
                                        <dt>Revetement : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['revetement']; ?></dd>
                                    </dl>	
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['fosse_orchestre'])): ?>
                                    <dl class="dl_list">
                                        <dt>Fosse d'orchestre : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['fosse_orchestre']; ?></dd>
                                    </dl>
                                <?php endif; ?>


                                <?php if (!empty($ficheactivite['Ficheactivite']['capacite_assise'])): ?>
                                    <dl class="dl_list">
                                        <dt>Capacité assise : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['capacite_assise']; ?></dd>
                                    </dl>
                                <?php endif; ?>


                                <?php if (!empty($ficheactivite['Ficheactivite']['capacite_debout'])): ?>
                                    <dl class="dl_list">
                                        <dt>Capacité debout : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['capacite_debout']; ?></dd>
                                    </dl>
                                <?php endif; ?>


                                <?php if (!empty($ficheactivite['Ficheactivite']['scene_superficie'])): ?>
                                    <dl class="dl_list">
                                        <dt>Superficie de la scène : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['scene_superficie']; ?></dd>
                                    </dl>
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['salle_superficie'])): ?>
                                    <dl class="dl_list">
                                        <dt>Superficie de la salle : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['salle_superficie']; ?></dd>
                                    </dl>
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['effectif_artistique'])): ?>
                                    <dl class="dl_list">
                                        <dt>Effectif artistique : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['effectif_artistique']; ?></dd>
                                    </dl>
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['composition'])): ?>
                                    <dl class="dl_list">
                                        <dt>Composition : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['composition']; ?></dd>
                                    </dl>
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['periodicite'])): ?>
                                    <dl class="dl_list">
                                        <dt>Périodicité : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['periodicite']; ?></dd>
                                    </dl>
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['periode_realisation'])): ?>
                                    <dl class="dl_list">
                                        <dt>Période de réalisation : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['periode_realisation']; ?></dd>
                                    </dl>
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['periode_preparation'])): ?>
                                    <dl class="dl_list">
                                        <dt>Période de préparation : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['periode_preparation']; ?></dd>
                                    </dl>
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['numero_agrement'])): ?>
                                    <dl class="dl_list">
                                        <dt>Numéro d'agrément : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['numero_agrement']; ?></dd>
                                    </dl>
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['effectif_audience'])): ?>
                                    <dl class="dl_list">
                                        <dt>Effectif audience : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['effectif_audience']; ?></dd>
                                    </dl>
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['capacite_accueil'])): ?>
                                    <dl class="dl_list">
                                        <dt>Capacité d'accueil : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['capacite_accueil']; ?></dd>
                                    </dl>
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['rcr'])): ?>
                                    <dl class="dl_list">
                                        <dt>RCR : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['rcr']; ?></dd>
                                    </dl>
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['mode_gestion'])): ?>
                                    <dl class="dl_list">
                                        <dt>Mode de gestion : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['mode_gestion']; ?></dd>
                                    </dl>
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['surface_m2'])): ?>
                                    <dl class="dl_list">
                                        <dt>Surface en m2 : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['surface_m2']; ?></dd>
                                    </dl>
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['acces_internet']) && $ficheactivite['Ficheactivite']['acces_internet'] != "Non"): ?>
                                    <dl class="dl_list">
                                        <dt>Accès internet : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['acces_internet']; ?></dd>
                                    </dl>
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['bibliobus']) && $ficheactivite['Ficheactivite']['bibliobus'] != "Non"): ?>
                                    <dl class="dl_list">
                                        <dt>Bibliobus : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['bibliobus']; ?></dd>
                                    </dl>	
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['liseuse']) && $ficheactivite['Ficheactivite']['liseuse'] != "Non"): ?>
                                    <dl class="dl_list">
                                        <dt>Liseuse : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['liseuse']; ?></dd>
                                    </dl>	
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['equipement_public_hand']) && $ficheactivite['Ficheactivite']['equipement_public_hand'] != "Non"): ?>
                                    <dl class="dl_list">
                                        <dt>Equipement public handicapé : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['equipement_public_hand']; ?></dd>
                                    </dl>	
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['intervention_aupres_pub']) && $ficheactivite['Ficheactivite']['intervention_aupres_pub'] != "Non"): ?>
                                    <dl class="dl_list">
                                        <dt>Intervention auprès du public : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['intervention_aupres_pub']; ?></dd>
                                    </dl>
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['surface_totale'])): ?>
                                    <dl class="dl_list">
                                        <dt>Surface totale : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['surface_totale']; ?></dd>
                                    </dl>	
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['surface_livre'])): ?>
                                    <dl class="dl_list">
                                        <dt>Surface livre : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['surface_livre']; ?></dd>
                                    </dl>	
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['nbr_reference'])): ?>
                                    <dl class="dl_list">
                                        <dt>Nombre de références : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['nbr_reference']; ?></dd>
                                    </dl>	
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['informatisation']) && $ficheactivite['Ficheactivite']['informatisation'] != "Non"): ?>
                                    <dl class="dl_list">
                                        <dt>informatisation : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['informatisation']; ?></dd>
                                    </dl>	
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['vente_en_ligne']) && $ficheactivite['Ficheactivite']['vente_en_ligne'] != "Non"): ?>
                                    <dl class="dl_list">
                                        <dt>Vente en ligne : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['vente_en_ligne']; ?></dd>
                                    </dl>	
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['gencod'])): ?>
                                    <dl class="dl_list">
                                        <dt>GENCOD : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['gencod']; ?></dd>
                                    </dl>	
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['nbr_titre_catalogue'])): ?>
                                    <dl class="dl_list">
                                        <dt>Nombre de titres au catalogue : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['nbr_titre_catalogue']; ?></dd>
                                    </dl>	
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['nbr_publication'])): ?>
                                    <dl class="dl_list">
                                        <dt>Nombre de publications : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['nbr_publication']; ?></dd>
                                    </dl>	
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['auto_diffusion']) && $ficheactivite['Ficheactivite']['auto_diffusion'] != "Non"): ?>
                                    <dl class="dl_list">
                                        <dt>Auto-diffusion : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['auto_diffusion']; ?></dd>
                                    </dl>	
                                <?php endif; ?> 

                                <?php if (!empty($ficheactivite['Ficheactivite']['auto_distribution']) && $ficheactivite['Ficheactivite']['auto_distribution'] != "Non"): ?>
                                    <dl class="dl_list">
                                        <dt>Auto-distribution : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['auto_distribution']; ?></dd>
                                    </dl>	
                                <?php endif; ?> 

                                <?php if (!empty($ficheactivite['Ficheactivite']['date_actualisation']) && $ficheactivite['Ficheactivite']['date_actualisation'] != "0000-00-00"): ?>
                                    <dl class="dl_list">
                                        <dt>Date d'actualisation : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['date_actualisation']; ?></dd>
                                    </dl>	
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['nom_prenom_destinataire'])): ?>
                                    <dl class="dl_list">
                                        <dt>Destinataire : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['nom_prenom_destinataire']; ?></dd>
                                    </dl>	
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['fonction_titre'])): ?>
                                    <dl class="dl_list">
                                        <dt>Fonction titre : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['fonction_titre']; ?></dd>
                                    </dl>	
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['e_mail_destinataire'])): ?>
                                    <p class="e_mail_destinataire">
                                        <span>Email du destinataire : </span><a href="mailto:<?php echo $ficheactivite['Ficheactivite']['e_mail_destinataire']; ?>"><?php echo $ficheactivite['Ficheactivite']['e_mail_destinataire']; ?></a>
                                    <?php endif; ?>


                                    <?php if (!empty($ficheactivite['Ficheactivite']['liste_des_contacts'])): ?>
                                    <dl class="dl_list">
                                        <dt>Liste des contacts : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['liste_des_contacts']; ?></dd>
                                    </dl>	
                                <?php endif; ?> 

                                <?php if (!empty($ficheactivite['Ficheactivite']['type_public'])): ?>
                                    <dl class="dl_list">
                                        <dt>Type de public : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['type_public']; ?></dd>
                                    </dl>	
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['support'])): ?>
                                    <dl class="dl_list">
                                        <dt>Support : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['support']; ?></dd>
                                    </dl>	
                                <?php endif; ?> 

                                <?php if (!empty($ficheactivite['Ficheactivite']['rayonnement'])): ?>
                                    <dl class="dl_list">
                                        <dt>Rayonnement : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['rayonnement']; ?></dd>
                                    </dl>	
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['distinction'])): ?>
                                    <dl class="dl_list">
                                        <dt>Distinction : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['distinction']; ?></dd>
                                    </dl>	
                                <?php endif; ?>

                                <?php if (!empty($ficheactivite['Ficheactivite']['index_complementaire'])): ?>
                                    <dl class="dl_list">
                                        <dt>Index complémentaire : </dt>
                                        <dd><?php echo $ficheactivite['Ficheactivite']['index_complementaire']; ?></dd>
                                    </dl>	
                                <?php endif; ?>

                            </div>
                            <div id="medias" class="tab-pane fade">
                                <?php echo $this->element('externalMedias', array('medias' => $ficheactivite['ExternalMedia'])); ?>
                            </div>
                            <div id="documents" class="tab-pane fade">
                                <?php echo $this->element('documents', array('documents' => $ficheactivite['Document'])); ?>


                            </div>
                            <div id ="social" class="tab-pane fade">
                                <?php if (!empty($ficheactivite['AnnuaireLien'])): ?>
                                    <ul class="list-unstyled">
                                        <?php foreach ($ficheactivite['AnnuaireLien'] as $lien): ?>
                                            <li> <span class="link <?php echo $lien['title']; ?>"> <?php echo $this->Html->link($lien['url']); ?></span></li>
                                            <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>     
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

