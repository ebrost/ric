<?php debug($ficheoeuvre); ?>
<h2><?php echo $ficheoeuvre['Ficheoeuvre']['nom_complet']; ?></h2>
	<adress>
		<?php if (!empty($ficheoeuvre['Ficheoeuvre']['adresse'])): ?>
			<?php echo $ficheoeuvre['Ficheoeuvre']['adresse']; ?><br />
			<?php echo $ficheoeuvre['Ficheoeuvre']['code_postal']; ?> <?php echo $ficheoeuvre['Ficheoeuvre']['ville']; ?>
		<?php endif; ?>	
	</adress>

		<?php if (!empty($ficheoeuvre['Ficheoeuvre']['telephone'])): ?>
			Téléphone : <?php echo $ficheoeuvre['Ficheoeuvre']['telephone']; ?>
                            <?php if (!empty($ficheoeuvre['Ficheoeuvre']['telephone2'])): ?>
				- <?php echo $ficheoeuvre['Ficheoeuvre']['telephone2']; ?>
                            <?php endif; ?>
			<br />
		<?php endif; ?>
                        <?php if (!empty($ficheoeuvre['Ficheoeuvre']['mobile'])): ?>
			Mobile : <?php echo $ficheoeuvre['Ficheoeuvre']['mobile']; ?><br />
		<?php endif; ?>
		<?php if (!empty($ficheoeuvre['Ficheoeuvre']['telecopie'])): ?>
			Fax : <?php echo $ficheoeuvre['Ficheoeuvre']['telecopie']; ?><br />
		<?php endif; ?>
		<?php if (!empty($ficheoeuvre['Ficheoeuvre']['url_site_web'])): ?>
			<a href="http://<?php echo $ficheoeuvre['Ficheoeuvre']['url_site_web']; ?>" target="_blank"><?php echo $ficheoeuvre['Ficheoeuvre']['url_site_web']; ?></a>
			<br />
		<?php endif; ?>
		<?php if (!empty($ficheoeuvre['Ficheoeuvre']['email'])): ?>
			<a href="mailto:<?php echo $ficheoeuvre['Ficheoeuvre']['email']; ?>"><?php echo $ficheoeuvre['Ficheoeuvre']['email']; ?></a>
			<br />
		<?php endif; ?>	
		<?php if (!empty($ficheoeuvre['Ficheoeuvre']['activites'])): ?>
			<p><strong>Activité(s) :</strong><?php echo $ficheoeuvre['Ficheoeuvre']['activites']; ?>
                        <?php if (!empty($ficheoeuvre['Ficheoeuvre']['precision_activites'])): ?>
				 - <?php echo $ficheoeuvre['Ficheoeuvre']['precision_activites']; ?>
                        <?php endif; ?>
                        </p>
		<?php endif; ?>	
               <?php if (!empty($ficheoeuvre['Ficheoeuvre']['genres'])): ?>
			<p><strong>Domaine(s) :</strong><?php echo $ficheoeuvre['Ficheoeuvre']['genres']; ?>
                        </p>
		<?php endif; ?>	
                <?php if (!empty($ficheoeuvre['Ficheoeuvre']['disciplines'])): ?>
			<p><strong>Discipline(s) :</strong><?php echo $ficheoeuvre['Ficheoeuvre']['disciplines']; ?>
                        </p>
		<?php endif; ?>	
                        <?php if (!empty($ficheoeuvre['Ficheoeuvre']['commentaires'])): ?>
				<p class="commentaires">
					<?php echo nl2br($ficheoeuvre['Ficheoeuvre']['commentaires']); ?>
				</p>
			<?php endif; ?> 
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['commentaires_arts_visuels'])): ?>
				<p class="commentaires_arts_visuels">
					<?php echo nl2br($ficheoeuvre['Ficheoeuvre']['commentaires_arts_visuels']); ?>
				</p>
			<?php endif; ?>
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['commentaires_arts_visuels'])): ?>
				<p class="commentaires_audio_visuels">
					<?php echo nl2br($ficheoeuvre['Ficheoeuvre']['commentaires_audio_visuel']); ?>
				</p>
			<?php endif; ?> 
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['commentaires_livre'])): ?>
				<p class="commentaires_livre">
					<?php echo nl2br($ficheoeuvre['Ficheoeuvre']['commentaires_livre']); ?>
				</p>
			<?php endif; ?>
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['commentaires_patrimoine'])): ?>
				<p class="commentaires_patrimoine">
					<?php echo nl2br($ficheoeuvre['Ficheoeuvre']['commentaires_patrimoine']); ?>
				</p>
			<?php endif; ?> 
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['commentaires_spectacle'])): ?>
				<p class="commentaires_spectacle">
					<?php echo nl2br($ficheoeuvre['Ficheoeuvre']['commentaires_spectacle']); ?>
				</p>
			<?php endif; ?>
                        <?php if (!empty($ficheoeuvre['Ficheoeuvre']['siret'])): ?>
				<p class="siret">
					<span>Siret : </span><?php echo $ficheoeuvre['Ficheoeuvre']['siret']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['apenaf'])): ?>
				<p class="apenaf">
					<span>APE / NAF : </span><?php echo $ficheoeuvre['Ficheoeuvre']['apenaf']; ?>
				</p>
			<?php endif; ?>
	
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['annee_creation'])): ?>
				<p class="annee_creation">
					<span>Année de création : </span><?php echo $ficheoeuvre['Ficheoeuvre']['annee_creation']; ?>
				</p>
			<?php endif; ?>

			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['annee_construction'])): ?>
					<p class="annee_construction">
						<span>Année de construction : </span><?php echo $ficheoeuvre['Ficheoeuvre']['annee_construction']; ?>
					</p>
			<?php endif; ?>
		 
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['forme_juridique'])): ?>
				<p class="forme_juridique">
					<span>Forme juridique : </span><?php echo $ficheoeuvre['Ficheoeuvre']['forme_juridique']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['jauge'])): ?>
				<p class="jauge">
					<span>Jauge : </span><?php echo $ficheoeuvre['Ficheoeuvre']['jauge']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['capacite'])): ?>
				<p class="capacite">
					<span>Capacité : </span><?php echo $ficheoeuvre['Ficheoeuvre']['capacite']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['scene'])): ?>
				<p class="scene">
					<span>Scène : </span><?php echo $ficheoeuvre['Ficheoeuvre']['scene']; ?>
				</p>
			<?php endif; ?>
			
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['revetement'])): ?><
				<p class="revetement">
					<span>Revetement : </span><?php echo $ficheoeuvre['Ficheoeuvre']['revetement']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['fosse_orchestre'])): ?>
				<p class="fosse_orchestre">
					<span>Fosse d'orchestre : </span><?php echo $ficheoeuvre['Ficheoeuvre']['fosse_orchestre']; ?>
				</p>
			<?php endif; ?>
			
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['capacite_assise'])): ?>
				<p class="capacite_assise">
					<span>Capacité assise : </span><?php echo $ficheoeuvre['Ficheoeuvre']['capacite_assise']; ?>
				</p>
			<?php endif; ?>
			
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['capacite_debout'])): ?>
				<p class="capacite_debout">
					<span>Capacité debout : </span><?php echo $ficheoeuvre['Ficheoeuvre']['capacite_debout']; ?>
				</p>
			<?php endif; ?>
			
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['scene_superficie'])): ?>
				<p class="scene_superficie">
					<span>Superficie de la scène : </span><?php echo $ficheoeuvre['Ficheoeuvre']['scene_superficie']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['salle_superficie'])): ?>
				<p class="salle_superficie">
					<span>Superficie de la salle : </span><?php echo $ficheoeuvre['Ficheoeuvre']['salle_superficie']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['effectif_artistique'])): ?>
				<p class="effectif_artistique">
					<span>Effectif artistique : </span><?php echo $ficheoeuvre['Ficheoeuvre']['effectif_artistique']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['composition'])): ?>
				<p class="composition">
					<span>Composition : </span><?php echo $ficheoeuvre['Ficheoeuvre']['composition']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['periodicite'])): ?>
				<p class="periodicite">
					<span>Périodicité : </span><?php echo $ficheoeuvre['Ficheoeuvre']['periodicite']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['periode_realisation'])): ?>
				<p class="periode_realisation">
					<span>Période de réalisation : </span><?php echo $ficheoeuvre['Ficheoeuvre']['periode_realisation']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['periode_preparation'])): ?>
				<p class="periode_preparation">
					<span>Période de préparation : </span><?php echo $ficheoeuvre['Ficheoeuvre']['periode_preparation']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['numero_agrement'])): ?>
				<p class="numero_agrement">
					<span>Numéro d'agrément : </span><?php echo $ficheoeuvre['Ficheoeuvre']['numero_agrement']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['effectif_audience'])): ?>
				<p class="effectif_audience">
					<span>Effectif audience : </span><?php echo $ficheoeuvre['Ficheoeuvre']['effectif_audience']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['capacite_accueil'])): ?>
				<p class="capacite_accueil">
					<span>Capacité d'accueil : </span><?php echo $ficheoeuvre['Ficheoeuvre']['capacite_accueil']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['rcr'])): ?>
				<p class="rcr">
					<span>RCR : </span><?php echo $ficheoeuvre['Ficheoeuvre']['rcr']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['mode_gestion'])): ?>
				<p class="mode_gestion">
					<span>Mode de gestion : </span><?php echo $ficheoeuvre['Ficheoeuvre']['mode_gestion']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['surface_m2'])): ?>
				<p class="surface_m2">
					<span>Surface en m2 : </span><?php echo $ficheoeuvre['Ficheoeuvre']['surface_m2']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['acces_internet']) && $ficheoeuvre['Ficheoeuvre']['acces_internet']!="Non"): ?>
				<p class="acces_internet">
					<span>Accès internet : </span><?php echo $ficheoeuvre['Ficheoeuvre']['acces_internet']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['bibliobus']) && $ficheoeuvre['Ficheoeuvre']['bibliobus']!="Non"): ?>
				<p class="bibliobus">
					<span>Bibliobus : </span><?php echo $ficheoeuvre['Ficheoeuvre']['bibliobus']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['liseuse']) && $ficheoeuvre['Ficheoeuvre']['liseuse']!="Non"): ?>
				<p class="liseuse">
					<span>Liseuse : </span><?php echo $ficheoeuvre['Ficheoeuvre']['liseuse']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['equipement_public_hand']) && $ficheoeuvre['Ficheoeuvre']['equipement_public_hand']!="Non"): ?>
				<p class="equipement_public_hand">
					<span>Equipement public handicapé : </span><?php echo $ficheoeuvre['Ficheoeuvre']['equipement_public_hand']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['intervention_aupres_pub']) && $ficheoeuvre['Ficheoeuvre']['intervention_aupres_pub']!="Non"): ?>
				<p class="intervention_aupres_pub">
					<span>Intervention auprès du public : </span><?php echo $ficheoeuvre['Ficheoeuvre']['intervention_aupres_pub']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['surface_totale'])): ?>
				<p class="surface_totale">
					<span>Surface totale : </span><?php echo $ficheoeuvre['Ficheoeuvre']['surface_totale']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['surface_livre'])): ?>
				<p class="surface_livre">
					<span>Surface livre : </span><?php echo $ficheoeuvre['Ficheoeuvre']['surface_livre']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['nbr_reference'])): ?>
				<p class="nbr_reference">
					<span>Nombre de références : </span><?php echo $ficheoeuvre['Ficheoeuvre']['nbr_reference']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['informatisation']) && $ficheoeuvre['Ficheoeuvre']['informatisation']!="Non"): ?>
				<p class="informatisation">
					<span>informatisation : </span><?php echo $ficheoeuvre['Ficheoeuvre']['informatisation']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['vente_en_ligne']) && $ficheoeuvre['Ficheoeuvre']['vente_en_ligne']!="Non"): ?>
				<p class="vente_en_ligne">
					<span>Vente en ligne : </span><?php echo $ficheoeuvre['Ficheoeuvre']['vente_en_ligne']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['gencod'])): ?>
				<p class="GENCOD">
					<span>GENCOD : </span><?php echo $ficheoeuvre['Ficheoeuvre']['gencod']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['nbr_titre_catalogue'])): ?>
				<p class="nbr_titre_catalogue">
					<span>Nombre de titres au catalogue : </span><?php echo $ficheoeuvre['Ficheoeuvre']['nbr_titre_catalogue']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['nbr_publication'])): ?>
				<p class="nbr_publication">
					<span>Nombre de publications : </span><?php echo $ficheoeuvre['Ficheoeuvre']['nbr_publication']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['auto_diffusion']) && $ficheoeuvre['Ficheoeuvre']['auto_diffusion']!="Non"): ?>
				<p class="auto_diffusion">
					<span>Auto-diffusion : </span><?php echo $ficheoeuvre['Ficheoeuvre']['auto_diffusion']; ?>
				</p>	
			<?php endif; ?> 
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['auto_distribution']) && $ficheoeuvre['Ficheoeuvre']['auto_distribution']!="Non"): ?>
				<p class="auto_distribution">
					<span>Auto-distribution : </span><?php echo $ficheoeuvre['Ficheoeuvre']['auto_distribution']; ?>
				</p>	
			<?php endif; ?> 

			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['date_actualisation']) && $ficheoeuvre['Ficheoeuvre']['date_actualisation']!="0000-00-00"): ?>
				<p class="date_actualisation">
					<span>Date d'actualisation : </span><?php echo $ficheoeuvre['Ficheoeuvre']['date_actualisation']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['nom_prenom_destinataire'])): ?>
				<p class="nom_prenom_destinataire">
					<span>Destinataire : </span><?php echo $ficheoeuvre['Ficheoeuvre']['nom_prenom_destinataire']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['fonction_titre'])): ?>
				<p class="fonction_titre">
					<span>Fonction titre : </span><?php echo $ficheoeuvre['Ficheoeuvre']['fonction_titre']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['e_mail_destinataire'])): ?>
				<p class="e_mail_destinataire">
					<span>Email du destinataire : </span><a href="mailto:<?php echo $ficheoeuvre['Ficheoeuvre']['e_mail_destinataire']; ?>"><?php echo $ficheoeuvre['Ficheoeuvre']['e_mail_destinataire']; ?></a>
			<?php endif; ?>
				
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['liste_des_contacts'])): ?>
				<p class="liste_des_contacts">
					<span>Liste des contacts : </span><?php echo $ficheoeuvre['Ficheoeuvre']['liste_des_contacts']; ?>
				</p>	
			<?php endif; ?> 
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['type_public'])): ?>
				<p class="type_public">
					<span>Type de public : </span><?php echo $ficheoeuvre['Ficheoeuvre']['type_public']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['support'])): ?>
				<p class="support">
					<span>Support : </span><?php echo $ficheoeuvre['Ficheoeuvre']['support']; ?>
				</p>	
			<?php endif; ?> 
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['rayonnement'])): ?>
				<p class="rayonnement">
					<span>Rayonnement : </span><?php echo $ficheoeuvre['Ficheoeuvre']['rayonnement']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['distinction'])): ?>
				<p class="distinction">
					<span>Distinction : </span><?php echo $ficheoeuvre['Ficheoeuvre']['distinction']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheoeuvre['Ficheoeuvre']['index_complementaire'])): ?>
				<p class="index_complementaire">
					<span>Index complémentaire : </span><?php echo $ficheoeuvre['Ficheoeuvre']['index_complementaire']; ?>
				</p>	
			<?php endif; ?>  
                                <?php if (!empty($ficheoeuvre['OeuvreLien'])): ?>
    <hr/>
    <ul class="list-unstyled">
        <?php foreach ($ficheoeuvre['OeuvreLien'] as $lien): ?>
            <li> <span class="link <?php echo $lien['title']; ?>"> <?php echo $this->Html->link($lien['url']); ?></span></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?> 
                                 <?php if (CakePlugin::loaded('Annuaire')) : ?>
                           <hr/>
                                <?php echo $this->element('Annuaire.embededView',array('ficheactivite'=>$ficheoeuvre['Ficheactivite'],'displayLink'=>false)); ?>
                       
                                <?php endif; ?>
