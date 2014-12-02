<?php if (isset($fichesactivites)): ?>
<div id="paginated-results-list">
<?php if (!empty($fichesactivites)): ?>
	<?php $this->Paginator->options(array('sort'=>null,'url' => array('q'=>$q))); ?>
	<div id="paginated-results-list-header" >
		<h4 class="pull-left"><?php echo $this->Paginator->counter(array('format' => 'Résultats %start% à %end% sur %count%'));?></h4>
		<div class="tools">
			<?php echo $this->Html->link('Version Pdf', array(
										'action' => 'viewPdfList',
										'ext' => 'pdf',
                                                                                'q'=>$q,
										'encoded'=>true,
										'idList'=>$idList,
										
										),
										array('escape'=>false,'target'=>'pdf'))
			?>
		</div>
	</div>

	<?php foreach($fichesactivites as $ficheactivite): ?>
		<div class="list-item">
			<div class="row">
				<div class="col-md-2">
                                    
					<?php if (!empty($ficheactivite['Image'][0])): ?>
						<div class="thumbnail">
                                                    <?php echo $this->RicImage->image($ficheactivite['Image'][0],'medium');?>
							<?php //echo $this->element('thumbnail',array('imgThumb'=>$ficheactivite['Ficheactivite']['thumbnail'],'imgWidth'=>140,'imgHeight'=>140)) ;?>
						</div>
					<?php endif;?>
				</div>
				<div class="col-md-10">
					<ul class="list-btns pull-right">
						<li>
							<?php 
							$viewlinkParams=array(
								'plugin'=>'annuaire',
								'controller' => 'ficheactivites',
								'action' => 'view',
								'id'=>$ficheactivite['Ficheactivite']['id'],
								'slug'=>Inflector::slug($ficheactivite['Ficheactivite']['nom_complet']),
								'num' =>$ficheactivite['Ficheactivite']['num'],
								'page'=>$this->request->params['named']['page'],
								'q'=>$q,
								'r'=>$ficheactivite['Ficheactivite']['relevance'],
								
								);
							echo $this->Html->link(' <i class="fa fa-info-circle"></i> Voir',$viewlinkParams ,array('escape'=>false,'class'=>'btn btn-primary'))
							?>
						</li>
						<li>
							<?php 
							$viewlinkurl=$this->Html->url($viewlinkParams,true);
							//echo $viewlinkurl;
							echo $this->Html->link('<i class="fa fa-plus-circle"></i>  Ajouter à ma selection', 'javascript:void(0);',
								array(
								'escape'=>false,
								'data-content-shortlist'=>htmlspecialchars($this->RicImage->image($ficheactivite['Image'][0],'icon')).
								'<div><a href='.$viewlinkurl.'>'.$ficheactivite['Ficheactivite']['nom_complet'].'</a></div>',
								'data-id-shortlist'=>$ficheactivite['Ficheactivite']['id'],
								'class'=>'add-to-list-js btn btn-default')
								)
							?>
						</li>
					</ul>
					<h4 class="ficheactivite_title" >
						<?php echo $this->Html->link($ficheactivite['Ficheactivite']['nom_complet'], array(
							'plugin'=>'annuaire',
							'controller' => 'ficheactivites',
							'action' => 'view',
							'id'=>$ficheactivite['Ficheactivite']['id'],
							'slug'=>Inflector::slug($ficheactivite['Ficheactivite']['nom_complet']),
							'num' =>$ficheactivite['Ficheactivite']['num'],
							'page'=>$this->request->params['named']['page'],
							'q'=>$q,
							'r'=>$ficheactivite['Ficheactivite']['relevance'],	
						))?>
						
					</h4>
					<adress>
						<?php if (!empty($ficheactivite['Ficheactivite']['adresse'])): ?>
							<?php echo $ficheactivite['Ficheactivite']['adresse']; ?><br />
							<?php echo $ficheactivite['Ficheactivite']['code_postal']; ?> <?php echo $ficheactivite['Ficheactivite']['ville']; ?>
						<?php endif; ?>	
					</adress>
					<ul class="list-unstyled">
						<?php if (!empty($ficheactivite['Ficheactivite']['telephone'])): ?>
							<li><i class="fa fa-phone"></i> <?php echo $ficheactivite['Ficheactivite']['telephone']; ?></li>
						<?php endif; ?>
						<?php if (!empty($ficheactivite['Ficheactivite']['url_site_web'])): ?>
							<li><i class="fa fa-link"></i> <a href="http://<?php echo $ficheactivite['Ficheactivite']['url_site_web']; ?>" target="_blank"><?php echo $ficheactivite['Ficheactivite']['url_site_web']; ?></a></li>
						<?php endif; ?>
						<?php if (!empty($ficheactivite['Ficheactivite']['email'])): ?>
							<li><i class="fa fa-envelope"></i>  <a href="mailto:<?php echo $ficheactivite['Ficheactivite']['email']; ?>" ><?php echo $ficheactivite['Ficheactivite']['email']; ?></a></li>
						<?php endif; ?>	
						<?php if (!empty($ficheactivite['Ficheactivite']['activites'])): ?>
							<li><?php echo $ficheactivite['Ficheactivite']['activites']; ?></li>
						<?php endif; ?>	
					</ul>
				</div>
			</div>
		</div>
	<?php endforeach; ?>

				


				<ul class="pagination">
				<?php echo ($this->Paginator->hasPrev())?'<li>'.$this->Paginator->prev('«',array('rel'=>'prev','tag'=>'span'),null,array('tag'=>'span')).'</li>':''; ?>
				<?php echo $this->Paginator->numbers(array('separator'=>null,'tag'=>'li','currentTag'=>'span','currentClass'=>'active')); ?>
				<?php echo ($this->Paginator->hasNext())?'<li>'.$this->Paginator->next('»',array('rel'=>'next','tag'=>'span'),null,array('tag'=>'span')).'</li>':''; ?>
				</ul>

<?php else:?>
	<h4>Pas de résultat</h4>
	<p>Essayez de modifier vos critères de recherche</p>
<?php endif;?>
</div>
<?php endif;?>