

<?php if (isset($evenements)): ?>
<?php if (!empty($submitted)): ?>
<div class="alert alert-info" role="alert">
    
    <i class="fa fa-rss"></i> <?php echo $this->Html->link('Générer un fil Rss à partir de ma requête',array('action'=>'feed','ext'=>'rss','q' => $q));?>
</div>
        <?php endif; ?>
<div id="paginated-results-list">
    <?php if (!empty($evenements)): ?>
        
        <?php $this->Paginator->options(array('sort' => null, 'url' => array('q' => $q))); ?>
        <div id="paginated-results-list-header" >
            <h4 class="pull-left"><?php echo $this->Paginator->counter(array('format' => 'Résultats %start% à %end% sur %count%')); ?></h4>
            <div class="tools">
                <?php
                
                echo $this->Html->link(' <i class="icon-adobe-pdf icon-large"></i> Version Pdf', array(
                    'action' => 'viewPdfList',
                    'ext' => 'pdf',
                    'q'=>$q,
                    'encoded' => true,
                    'idList' => $idList,
                        ), array('escape' => false,'target'=>'pdf'))
                ?>
            </div>
        </div>
<?php echo $this->element('eventsList') ;?>

    <?php else: ?>
   
        <h4>Pas de résultat</h4>
        <p>Essayez de modifier vos critères de recherche</p>
      
    <?php endif; ?>
</div>
<?php endif; ?>