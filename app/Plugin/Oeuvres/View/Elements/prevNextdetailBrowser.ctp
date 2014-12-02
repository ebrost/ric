<ul class="pager">
<li class="previous">
<?php if (isset($prev['Ficheoeuvre']['id'])) :?> 
<?php echo $this->Html->link('« '.$prev['Ficheoeuvre']['nom_complet'], array(
'controller' => 'ficheoeuvres',
 'action' => 'view',
 'id'=>$prev['Ficheoeuvre']['id'],
 'slug'=>Inflector::slug($prev['Ficheoeuvre']['nom_complet']),
 'num'=>$prev['Ficheoeuvre']['num'],
 'q' => $this->request->params['named']['q'],
 'r' => $prev['Ficheoeuvre']['relevance'])); ?>
<?php else: ?>
&nbsp;
<?php endif; ?>
</div> 



<li class="back">

<?php  echo $this->Html->link('retour à la liste',array(
'controller' => 'Ficheoeuvres',
 'action' => 'search',
 //$next['Ficheoeuvre']['id'],
 'page'=>$page,
 'q' => $this->request->params['named']['q'],
 'r' => $next['Ficheoeuvre']['relevance'])) ;?>
</li> 


<li class="next">
<?php if (isset($next['Ficheoeuvre']['id'])) :?> 
<?php echo $this->Html->link($next['Ficheoeuvre']['nom_complet'].' »', array(
'controller' => 'ficheoeuvres',
'action' => 'view',
'id'=>$next['Ficheoeuvre']['id'],
'slug'=>Inflector::slug($next['Ficheoeuvre']['nom_complet']),
'num'=>$next['Ficheoeuvre']['num'],
'q' => $this->request->params['named']['q'],
 'r' => $next['Ficheoeuvre']['relevance'])); ?>
<?php endif; ?>
</div> 
</ul>
