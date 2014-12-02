

<?php foreach($evenements as $evenement): ?>

	
	
	<h2><?php echo $evenement['Evenement']['nom_complet']; ?>
        <?php if (!empty($evenement['Evenement']['genres'])): ?>
        <small><?php echo $evenement['Evenement']['genres']; ?></small>
        <?php endif; ?>
        </h2>
       
	<strong><small><?php echo $evenement['Type']['name']; ?></small></strong>
        
         <?php if (!empty($evenement['Parent']['nom_complet'])): ?>
                                dans le cadre de :<?php echo $evenement['Parent']['nom_complet']; ?>
        <?php endif; ?>
         <?php echo $this->element('sessionResume', array('evenement' => $evenement,'displayLink'=>false,'maxSessionsByEventOnList' => -1)); ?>
	<?php if (!empty($evenement['Evenement']['url_site_web'])): ?>
             <br /><a href="http://<?php echo $evenement['Evenement']['url_site_web']; ?>" target="_blank"><?php echo $evenement['Evenement']['url_site_web']; ?></a><br />
        <?php endif; ?>
                                
     <!-- on utilise le code ci-dessous pour verifier le changement de page-->
	<checkForPageBreak>
<?php endforeach; ?>