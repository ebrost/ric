
        <?php foreach ($evenements as $evenement): ?>

            <div class="list-item">
                <div class="row">
                    <div class="col-md-2">
                        <?php if (!empty($evenement['Image'][0])): ?>
						<div class="thumbnail">
                                                    <?php echo $this->RicImage->image($evenement['Image'][0],'medium');?>
							
						</div>
			<?php endif;?>
                    </div>
                    <div class="col-md-10">
                        
                        <div class="text_content<?php echo($evenement['Evenement']['annule']==1)?" annule":"";?> ">
                        <h4 class="evenement_title" >
                            <?php
                            echo $this->Html->link($evenement['Evenement']['nom_complet'], array(
                                'plugin' => 'agenda',
                                'controller' => 'evenements',
                                'action' => 'view',
                                'id' => $evenement['Evenement']['id'],
                                'slug' => Inflector::slug($evenement['Evenement']['nom_complet']),
                                'num' => $evenement['Evenement']['num'],
                                'page' => $this->request->params['named']['page'],
                                'q' => $q,
                                'r' => $evenement['Evenement']['relevance'],
                            ))
                            ?>
                            <small><?php echo $evenement['Evenement']['genres'] ?></small>
                            
                         
                                
                        <ul class="tags">
                                <?php foreach ($evenement['Tag'] as $tag): ?>
                                <li class="tag_<?php echo($tag['id']); ?>"><span><?php echo($tag['name']); ?></span></li>
                                <?php endforeach;?>
                            </ul>
                        
                        </h4>
                            
                            <strong><small><?php echo $evenement['Type']['name']; ?></small></strong>
                         <?php // debug($evenement);?>
                            <?php if (!empty($evenement['Parent']['nom_complet'])): ?>
                                dans le cadre de : <?php echo $this->Html->link($evenement['Parent']['nom_complet'], array(
                                            'plugin' => 'agenda',
                                            'controller' => 'evenements',
                                            'action' => 'view',
                                            'id' => $evenement['Parent']['id'],
                                            'slug' => Inflector::slug($evenement['Parent']['nom_complet'])
                                        )); ?>
                            
                            <?php endif; ?>
                            <div class="resume_sessions">
                            <?php echo $this->element('sessionResume', array('evenement' => $evenement,'displayLink'=>true)); ?>
                             </div>
                                <?php if (!empty($evenement['Evenement']['url_site_web'])): ?>
                                <p><a href="http://<?php echo $evenement['Evenement']['url_site_web']; ?>" target="_blank"><i class="fa fa-link"></i> <?php echo $evenement['Evenement']['url_site_web']; ?></a></p>
                            <?php endif; ?>
                        </div>
                        <ul class="list-btns pull-right">
                            <li>
                                <?php
                                $viewlinkParams = array(
                                    'plugin' => 'agenda',
                                    'controller' => 'evenements',
                                    'action' => 'view',
                                    'id' => $evenement['Evenement']['id'],
                                    'slug' => Inflector::slug($evenement['Evenement']['nom_complet']),
                                    'num' => $evenement['Evenement']['num'],
                                    'page' => $this->request->params['named']['page'],
                                    'q' => $q,
                                    'r' => $evenement['Evenement']['relevance'],
                                );
                                echo $this->Html->link(' <i class="fa fa-info-circle"></i> Voir', $viewlinkParams, array('escape' => false, 'class' => 'btn btn-primary'))
                                ?>
                            </li>
                            <li>
                                <?php
                                $viewlinkurl = $this->Html->url($viewlinkParams, true);
                                //echo $viewlinkurl;
                                echo $this->Html->link('<i class="fa fa-plus-circle"></i>  Ajouter à ma selection', 'javascript:void(0);', array(
                                    'escape' => false,
                                    'data-content-shortlist' => htmlspecialchars($this->RicImage->image($evenement['Image'][0],'icon')).
                                    '<div><a href=' . $viewlinkurl . '>' . htmlspecialchars($evenement['Evenement']['nom_complet']) . '</a></div>',
                                    'data-id-shortlist' => $evenement['Evenement']['id'],
                                    'class' => 'add-to-list-js btn btn-default')
                                )
                                ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>



        
            <ul class="pagination">
                <?php echo ($this->Paginator->hasPrev()) ? '<li>' . $this->Paginator->prev('«', array('rel' => 'prev', 'tag' => 'span'), null, array('tag' => 'span')) . '</li>' : ''; ?>
                <?php echo $this->Paginator->numbers(array('separator' => null, 'tag' => 'li', 'currentTag' => 'span', 'currentClass' => 'active')); ?>
                <?php echo ($this->Paginator->hasNext()) ? '<li>' . $this->Paginator->next('»', array('rel' => 'next', 'tag' => 'span'), null, array('tag' => 'span')) . '</li>' : ''; ?>
            </ul>