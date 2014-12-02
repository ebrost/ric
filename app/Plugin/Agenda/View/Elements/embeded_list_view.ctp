   <?php foreach ($evenements as $evenement): ?>

            <div class="list-item">
                <div class="row">
                    <div class="col-md-2">
                        <?php if (!empty($evenement['Image'][0])): ?>
						<div class="thumbnail">
                                                    <?php echo $this->RicImage->image($evenement['Image'][0],'thumb');?>
							<?php //echo $this->element('thumbnail',array('imgThumb'=>$ficheactivite['Ficheactivite']['thumbnail'],'imgWidth'=>140,'imgHeight'=>140)) ;?>
						</div>
					<?php endif;?>
                    </div>
                    <div class="col-md-10">
                        
                        <div class="text_content<?php echo($evenement['Evenement']['annule']==1)?" annule":"";?> ">
                        <h4 class="evenement_title well well-small" >
                          
                            <?php
                            echo $this->Html->link($evenement['Evenement']['nom_complet'], array(
                                'plugin' => 'agenda',
                                'controller' => 'evenements',
                                'action' => 'view',
                                'id' => $evenement['Evenement']['id'],
                                'slug' => Inflector::slug($evenement['Evenement']['nom_complet'])),
                                array('target'=>'_blank')
                            )
                            ?>
                            <small><?php echo $evenement['Type']['name']; ?></small>
                       
                       
                        </h4>      
                            <p class="small"><strong><?php echo $evenement['Evenement']['genres']; ?></strong><br/></p>
                            <div class="resume_sessions">
                            <?php echo $this->element('sessionResume', array('evenement' => $evenement,'displayLink'=>false)); ?>
                            
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

