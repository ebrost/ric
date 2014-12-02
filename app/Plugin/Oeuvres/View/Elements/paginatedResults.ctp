<?php if (isset($fichesoeuvres)): ?>
    <div id="paginated-results-list">
        <?php if (!empty($fichesoeuvres)): ?>
            <?php $this->Paginator->options(array('sort' => null, 'url' => array('q' => $q))); ?>
            <div id="paginated-results-list-header" >
                <h4 class="pull-left"><?php echo $this->Paginator->counter(array('format' => 'Résultats %start% à %end% sur %count%')); ?></h4>
                <div class="tools">
                    <?php
                    echo $this->Html->link('Version Pdf', array(
                        'action' => 'viewPdfList',
                        'ext' => 'pdf',
                        'q' => $q,
                        'encoded' => true,
                        'idList' => $idList,
                            ), array('escape' => false, 'target' => 'pdf'))
                    ?>
                </div>
            </div>

            <?php foreach ($fichesoeuvres as $ficheoeuvre): ?>
                <?php debug($ficheoeuvre); ?>
                <div class="list-item">
                    <div class="row">
                        <div class="col-md-2">

                            <?php if (!empty($ficheoeuvre['Image'][0])): ?>
                                <div class="thumbnail">
                                    <?php echo $this->RicImage->image($ficheoeuvre['Image'][0], 'medium'); ?>
                                    <?php //echo $this->element('thumbnail',array('imgThumb'=>$ficheoeuvre['Ficheoeuvre']['thumbnail'],'imgWidth'=>140,'imgHeight'=>140)) ;?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-10">
                            <ul class="list-btns pull-right">
                                <li>
                                    <?php
                                    $viewlinkParams = array(
                                        'plugin' => 'oeuvres',
                                        'controller' => 'ficheoeuvres',
                                        'action' => 'view',
                                        'id' => $ficheoeuvre['Ficheoeuvre']['id'],
                                        'slug' => Inflector::slug($ficheoeuvre['Ficheoeuvre']['nom_complet']),
                                        'num' => $ficheoeuvre['Ficheoeuvre']['num'],
                                        'page' => $this->request->params['named']['page'],
                                        'q' => $q,
                                        'r' => $ficheoeuvre['Ficheoeuvre']['relevance'],
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
                'data-content-shortlist' => htmlspecialchars($this->RicImage->image($ficheoeuvre['Image'][0], 'icon')) .
                '<div><a href=' . $viewlinkurl . '>' . $ficheoeuvre['Ficheoeuvre']['nom_complet'] . '</a></div>',
                'data-id-shortlist' => $ficheoeuvre['Ficheoeuvre']['id'],
                'class' => 'add-to-list-js btn btn-default')
            )
            ?>
                                </li>
                            </ul>
                            <h4 class="ficheactivite_title" >
            <?php
            echo $this->Html->link($ficheoeuvre['Ficheoeuvre']['nom_complet'], array(
                'plugin' => 'oeuvres',
                'controller' => 'ficheoeuvres',
                'action' => 'view',
                'id' => $ficheoeuvre['Ficheoeuvre']['id'],
                'slug' => Inflector::slug($ficheoeuvre['Ficheoeuvre']['nom_complet']),
                'num' => $ficheoeuvre['Ficheoeuvre']['num'],
                'page' => $this->request->params['named']['page'],
                'q' => $q,
                'r' => $ficheoeuvre['Ficheoeuvre']['relevance'],
            ))
            ?>

                            </h4>
                            <?php if (!empty($ficheoeuvre['Ficheoeuvre']['auteur'])): ?>
                                <dl class="liste_typepublics dl_list">
                                    <dt>Auteur(s) :</dt>

                                    <dd><?php echo $ficheoeuvre['Ficheoeuvre']['auteur']; ?></dd>

                                </dl>
                            <?php endif; ?>

                            <?php if (!empty($ficheoeuvre['OeuvreGenre'])): ?>
                                <dl class="liste_typepublics dl_list">
                                    <dt>Genre(s) :</dt>
                                    <?php foreach ($ficheoeuvre['OeuvreGenre'] as $genre): ?>
                                        <dd><?php echo($genre['title']); ?></dd>
                                    <?php endforeach; ?>
                                </dl>
                            <?php endif; ?>
                            
                              <?php if (!empty($ficheoeuvre['OeuvreDiscipline'])): ?>
                                <dl class="liste_typepublics dl_list">
                                    <dt>Genre(s) :</dt>
                                    <?php foreach ($ficheoeuvre['OeuvreDiscipline'] as $discipline): ?>
                                        <dd><?php echo($discipline['title']); ?></dd>
                                    <?php endforeach; ?>
                                </dl>
                            <?php endif; ?>

                            <?php if (!empty($ficheoeuvre['OeuvreActivite'])): ?>
                                <dl class="liste_typepublics dl_list">
                                    <dt>Activité(s) :</dt>
                                    <?php foreach ($ficheoeuvre['OeuvreActivite'] as $activite): ?>
                                        <dd><?php echo($activite['title']); ?></dd>
                                    <?php endforeach; ?>
                                </dl>
                            <?php endif; ?>

                            <?php if (!empty($ficheoeuvre['Typepublic'])): ?>
                                <dl class="liste_typepublics dl_list">
                                    <dt>Public(s) :</dt>
                                    <?php foreach ($ficheoeuvre['Typepublic'] as $typepublic): ?>
                                        <dd><?php echo($typepublic['title']); ?></dd>
                                    <?php endforeach; ?>
                                </dl>
                            <?php endif; ?>



                        </div>
                    </div>
                </div>
            <?php endforeach; ?>




            <ul class="pagination">
                <?php echo ($this->Paginator->hasPrev()) ? '<li>' . $this->Paginator->prev('«', array('rel' => 'prev', 'tag' => 'span'), null, array('tag' => 'span')) . '</li>' : ''; ?>
                <?php echo $this->Paginator->numbers(array('separator' => null, 'tag' => 'li', 'currentTag' => 'span', 'currentClass' => 'active')); ?>
                <?php echo ($this->Paginator->hasNext()) ? '<li>' . $this->Paginator->next('»', array('rel' => 'next', 'tag' => 'span'), null, array('tag' => 'span')) . '</li>' : ''; ?>
            </ul>

        <?php else: ?>
            <h4>Pas de résultat</h4>
            <p>Essayez de modifier vos critères de recherche</p>
        <?php endif; ?>
    </div>
<?php endif; ?>