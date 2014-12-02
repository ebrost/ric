
<script>$(function(){
            Ric.uploader('Image','plupload_images','browse_images','droparea_images',<?php echo empty($filelist)?"'filelist_images'":"'".$filelist."'"; ?>,'<?php echo implode(',', $valid_images_extensions); ?>')
            });
            </script>
        <div id="plupload_images">
            
           
            <div id="droparea_images" class="droparea" href="#">
                <p><?php echo __d('media', "Déplacer les fichiers ici"); ?></p>
<?php echo __d('media', "ou"); ?><br/>

                <a id="browse_images" href="#" class="btn btn-primary"><?php echo __d('media', "Parcourir"); ?></a>
                <p class="small">(Extensions autorisées : <?php echo implode(',', $valid_images_extensions); ?>)</p>
            </div>
            <div id="filelist_images" class="filelist panel-group">

                <?php if(isset($images)): ?>
                <?php foreach ($images as $image):; ?>
               
    <?php echo $this->element('media', array('media' => $image,'category'=>'Image', 'displayActions'=>true)); ?>
<?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>