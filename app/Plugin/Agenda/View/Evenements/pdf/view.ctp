<h2><?php echo $evenement['Evenement']['nom_complet']; ?>   
    <?php if (!empty($evenement['Evenement']['genres'])): ?>
        <small> - <?php echo $evenement['Evenement']['genres']; ?></small>
    <?php endif; ?> </h2>
<strong><small><?php echo $evenement['Type']['name']; ?></small></strong><br/>




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
            <li><?php echo($typepublic['name']); ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<?php if (!empty($evenement['Parent']['nom_complet'])): ?>
    dans le cadre de :<?php echo $evenement['Parent']['nom_complet']; ?>
<?php endif; ?>

<?php if (!empty($evenement['Children'])): ?>

    <?php foreach ($evenement['Children'] as $evenementChild): ?>

        <div class="list-item">

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

                <?php echo $this->element('sessionResume', array('evenement' => $evenementChild, 'displayLink' => false, 'displayAdresse' => true)); ?>

            </div>
        </div>


    <?php endforeach; ?>


<?php endif; ?>
<?php if (!empty($evenement['Session'])): ?>


    <div class="well">
        <?php echo $this->element('sessionResume', array('evenement' => $evenement, 'displayLink' => false, 'maxSessionsByEventOnList' => -1)); ?>
    </div>
<?php endif; ?>
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
<?php if (!empty($evenement['AgendaLien'])): ?>
    <hr/>
    <ul class="list-unstyled">
        <?php foreach ($evenement['AgendaLien'] as $lien): ?>
            <li> <span class="link <?php echo $lien['title']; ?>"> <?php echo $this->Html->link($lien['url']); ?></span></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>   

<?php if (CakePlugin::loaded('Annuaire')) : ?>
    <hr/>
    <?php echo $this->element('Annuaire.embededView', array('ficheactivite' => $evenement['Ficheactivite'], 'displayLink' => false)); ?>

<?php endif; ?>
    <?php if (!empty($evenement['Evenement']['date_actualisation']) && $evenement['Evenement']['date_actualisation'] != "0000-00-00"): ?>
    <hr/>
    <p class="date_actualisation">
        <span>Date d'actualisation : </span><?php echo $evenement['Evenement']['date_actualisation']; ?>
    </p>	
<?php endif; ?>