<channel>
    <title>Les spectacles a venir ...</title>
    <description>Présentation des spectacles à venir ....</description>
    <link><?php echo $this->Html->url('/', true); ?></link>
    <language>fr-FR</language>
    <atom:link href="<?php echo $this->Html->url('/', true); ?>" rel="self" type="application/rss+xml" />
<?php foreach ($evenements as $evenement): ?>
    <item>
    <title><?php echo $evenement['Evenement']['nom_complet']; ?></title>
    <?php $itemLink=$this->Html->url(array(
                                'plugin' => 'agenda',
                                'controller' => 'evenements',
                                'action' => 'view',
                                'id' => $evenement['Evenement']['id'],
                                'slug' => Inflector::slug($evenement['Evenement']['nom_complet']),
                            ),true);
                            ?>
    <guid isPermaLink="true"><?php echo $itemLink; ?></guid>
    <link><?php echo $itemLink; ?></link>
    <description><?php echo $this->Text->truncate($evenement['Evenement']['commentaires'], 400, array(
        'ending' => '...',
        'exact'  => true,
        'html'   => true,
    )); ?></description>
        
   
    </item>
<?php endforeach;?>
    

</channel>