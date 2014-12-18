<?php $nbSessions = count($evenement['Session']); ?>

    <?php $counter = 0; ?>
    <?php foreach ($evenement['Session'] as $sess) : ?>
        <?php if ($sess['date_fin'] >= date('Y-m-d')) : ?>
            <?php if ($counter < $maxSessionsByEventOnList || $maxSessionsByEventOnList == -1) : ?>
            <?php if (!empty($displayDescriptif) && $displayDescriptif===true): ?>
             <?php if (!empty($sess['descriptif'])): ?>
                            <p><?php echo nl2br($sess['descriptif']); ?> </p>
                        <?php endif; ?>
                
            <?php endif; ?> 
                <p>
                    <i class="fa fa-calendar"></i>  <?php echo $sess['resume_session']; ?> <br />
                    <?php if (!empty($displayAdresse) && $displayAdresse===true): ?>
                        <?php echo $sess['lieu']; ?>
                 
                        <?php if (!empty($sess['adresse'])): ?>
                         - <?php echo $sess['adresse']; ?> <br/>
                        <?php endif; ?>
                    <?php endif; ?>
                   
                       <?php echo $sess['code_postal']; ?>
                            <?php echo ucwords(strtolower($sess['ville'])); ?> (<?php echo substr($sess['code_postal'], 0, 2); ?>)
                </p>
                <?php $counter++; ?>
            <?php else : ?>

                <?php if (!empty($displayLink) && $displayLink===true){
                echo $this->Html->link(">> Voir le détail pour les autres sessions de cet événement", array(
                    'plugin' => 'agenda',
                    'controller' => 'evenements',
                    'action' => 'view',
                    'id' => $evenement['Evenement']['id'],
                    'slug' => Inflector::slug($evenement['Evenement']['nom_complet']),
                    'num' => $evenement['Evenement']['num'],
                    'page' => $this->request->params['named']['page'],
                    'q' => $q,
                    'r' => $evenement['Evenement']['relevance'],
                ));
                        
                }
                ?>


                <?php break; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>