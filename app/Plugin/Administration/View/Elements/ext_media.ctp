<?php// var_dump($ext_media); ?>

<?php $ext_mediaId = $ext_media['ExternalMedia']['id']; ?>

<div class="file panel panel-default ExternalMedia" id="ExternalMedia-<?php echo $ext_media['ExternalMedia']['id']; ?>">
    <input type="hidden"  value="<?php echo (isset($ext_media['ExternalMedia']['id'])) ? $ext_media['ExternalMedia']['id'] : '' ?>" name="data[media][<?php echo $ext_media['ExternalMedia']['id'] ?>][id]">
    <input type="hidden"  value="<?php echo $ext_media['ExternalMedia']['id'] ?>" name="data[media][<?php echo $ext_media['ExternalMedia']['id'] ?>][media_id]">
    <input type="hidden"  data-attr="order" value="<?php echo (isset($ext_media['ExternalMedia']['order'])) ? $ext_media['ExternalMedia']['order'] : '' ?>" name="data[media][<?php echo $ext_media['ExternalMedia']['id']?>][order]">

    <div class="panel-heading clearfix">
            <?php if (isset($displayActions) && $displayActions==true): ?>
        <div class="actions">
            <a data-target="#viewExtMedia-<?php echo $ext_media['ExternalMedia']['id']; ?>" data-toggle="collapse" class="btn btn-default btn-sm editMedia"><i class="fa fa-eye "></i> Afficher</a>
            <?php echo $this->Html->link('<i class="fa fa-trash-o "></i> Supprimer', array('controller' => 'administration_users','action' => 'ajaxDeleteExtMedia', 'id' => $ext_media['ExternalMedia']['id']), array('escape' => false, 'class' => 'btn btn-danger btn-sm deleteMedia')); ?>

        </div>
        <?php endif; ?>
        <?php $img_url = (!empty($ext_media['ExternalMedia']['content']->thumbnail)) ? $ext_media['ExternalMedia']['content']->thumbnail : $ext_media['ExternalMedia']['content']->thumbnail_url; ?>
        <img src="<?php echo $img_url; ?>" class="thumb" />
        <?php if (!empty($ext_media['ExternalMedia']['content']->title)): ?>
            <div class="name"><?php echo $ext_media['ExternalMedia']['content']->title; ?></div>
        <?php endif; ?>
        <?php if (!empty($ext_media['ExternalMedia']['content']->type)): ?>
            <div class="type">Type de contenu: <?php echo $ext_media['ExternalMedia']['content']->type; ?></div>
        <?php endif; ?>       
        <?php if (!empty($ext_media['ExternalMedia']['content']->authorName)): ?>
            <div class="auteur">Auteur: <?php echo $ext_media['ExternalMedia']['content']->authorName; ?></div>
        <?php endif; ?>


        <div id="viewExtMedia-<?php echo $ext_media['ExternalMedia']['id']; ?>" class=" panel-body collapse" style="clear:both">
            <div class="ext-content">
                    <?php echo $ext_media['ExternalMedia']['content']->html; ?>
            </div>
        </div>

    </div> </div>
