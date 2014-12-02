
<?php $ext_mediaId= $ext_media[$category]['id']; ?>
<div class="file panel panel-default <?php echo $category; ?>" id="<?php echo $category.'-'. $ext_mediaId;?>">
     <input type="hidden"  value="<?php echo (isset($ext_media['id']))?$ext_media['id']:'' ?>" name="data[media][<?php echo $ext_mediaId ?>][id]">
     <input type="hidden"  value="<?php echo $ext_mediaId ?>" name="data[media][<?php echo $ext_mediaId ?>][media_id]">
     <input type="hidden"  data-attr="order" value="<?php echo (isset($ext_media['order']))?$ext_media['order']:'' ?>" name="data[media][<?php echo $ext_mediaId ?>][order]">
   
    <div class="panel-heading clearfix">
 <?php //debug($ext_media); ?>
        <div class="actions">
        
        <a data-target="#viewExtMedia-<?php echo $ext_media[$category]['id'];?>" data-toggle="collapse" class="btn btn-default btn-sm editMedia"><i class="fa fa-eye "></i> Afficher</a>
         
    </div>
<?php $img_url=(!empty($ext_media[$category]['content']->thumbnail))?  $ext_media[$category]['content']->thumbnail :$ext_media[$category]['content']->thumbnail_url;?>
<img src="<?php echo $img_url;?>" class="thumb" />
 <?php if (!empty($ext_media[$category]['content']->title)): ?>
        <div class="name"><?php echo $ext_media[$category]['content']->title;?></div>
    <?php endif;?>
        <div class="type">Type de contenu: <?php echo $ext_media[$category]['content']->type;?></div>
    <?php if (!empty($ext_media[$category]['content']->authorName)): ?>
    <div class="auteur">Auteur: <?php echo $ext_media[$category]['content']->authorName;?></div>
    <?php endif;?>
    
    </div>
   <div id="viewExtMedia-<?php echo $ext_media[$category]['id'];?>" class=" panel-body collapse" style="clear:both">

       <div class=" " >
          <div class="ext-content">
          <?php echo $ext_media[$category]['content']->html; ?>
          </div>
      </div>
    </div>
    
</div>