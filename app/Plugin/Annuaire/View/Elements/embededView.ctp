<?php $this->extend('/Common/contentView'); ?>
 <?php  if ($displayLink!==false) echo $this->Html->link('Voir la fiche complète', array(
                                'plugin' => 'annuaire',
                                'controller' => 'ficheactivites',
                                'action' => 'view',
                                'id' => $ficheactivite['id'],
                                'slug' => Inflector::slug($ficheactivite['nom_complet'])),
                                array('target'=>'_blank','class'=>'btn btn-primary pull-right')
                            );
                            ?>
<h4><?php echo $ficheactivite['nom_complet']; ?></h4>
<?php if (!empty($ficheactivite['adresse'])): ?>
			<?php echo $ficheactivite['adresse']; ?><br />
			<?php echo $ficheactivite['code_postal']; ?> <?php echo $ficheactivite['ville']; ?>
		<?php endif; ?>	
	</adress>
	<ul class="list-unstyled">
		<?php if (!empty($ficheactivite['telephone'])): ?>
			<li><i class="fa fa-phone"></i> <?php echo $ficheactivite['telephone']; ?>
				<?php if (!empty($ficheactivite['telephone2'])): ?>
					 - <?php echo $ficheactivite['telephone2']; ?>
				<?php endif; ?>
			
			</li>
		<?php endif; ?>
		<?php if (!empty($ficheactivite['mobile'])): ?>
			<li><i class="fa fa-mobile-phone"></i> <?php echo $ficheactivite['mobile']; ?></li>
		<?php endif; ?>
		<?php if (!empty($ficheactivite['telecopie'])): ?>
			<li><?php echo $ficheactivite['telecopie']; ?></li>
		<?php endif; ?>
		<?php if (!empty($ficheactivite['url_site_web'])): ?>
			<li><i class="fa fa-link"></i> <a href="http://<?php echo $ficheactivite['url_site_web']; ?>" target="_blank"> <?php echo $ficheactivite['url_site_web']; ?></a></li>
		<?php endif; ?>
		<?php if (!empty($ficheactivite['email'])): ?>
			<li><i class="fa fa-envelope"></i> <a href="mailto:<?php echo $ficheactivite['email']; ?>" ><?php echo $ficheactivite['email']; ?></a></li>
		<?php endif; ?>
	</ul>
       