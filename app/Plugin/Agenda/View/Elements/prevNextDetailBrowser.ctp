<ul class="pager">
<li class="previous">
<?php if (isset($prev['Evenement']['id'])) :?> 
<?php echo $this->Html->link('« '.$prev['Evenement']['nom_complet'], array(
'controller' => 'evenements',
 'action' => 'view',
 'id'=>$prev['Evenement']['id'],
 'slug'=>Inflector::slug($prev['Evenement']['nom_complet']),
 'num'=>$prev['Evenement']['num'],
 'q' => $this->request->params['named']['q'],
 'r' => $prev['Evenement']['relevance'])); ?>
<?php else: ?>
&nbsp;
<?php endif; ?>
</div> 



<li class="back">

<?php  echo $this->Html->link('retour à la liste',array(
'controller' => 'Evenements',
 'action' => 'search',
 //$next['Evenement']['id'],
 'page'=>$page,
 'q' => $this->request->params['named']['q'],
 'r' => $next['Evenement']['relevance'])) ;?>
</li> 


<li class="next">
<?php if (isset($next['Evenement']['id'])) :?> 
<?php echo $this->Html->link($next['Evenement']['nom_complet'].' »', array(
'controller' => 'evenements',
'action' => 'view',
'id'=>$next['Evenement']['id'],
'slug'=>Inflector::slug($next['Evenement']['nom_complet']),
'num'=>$next['Evenement']['num'],
'q' => $this->request->params['named']['q'],
 'r' => $next['Evenement']['relevance'])); ?>
<?php endif; ?>
</div> 
</ul>
