<script>$(function () {
        Ric.fetchExtMedia(<?php echo empty($filelist) ? "'filelist_extmedias'" : "'" . $filelist . "'"; ?>);
    });
</script>


<div class="panel" >
    <div class="panel-body">
        <?php echo $this->Form->create('AdministrationUserAjaxGetExtMedia', array('url' => array('controller' => 'administration_users', 'action' => 'AjaxGetExtMedia'), 'class' => 'form-inline', 'role' => 'form')); ?>
        <div class="form-group col-md-8">
            <?php //echo $this->Form->label('url', 'Url', 'col-md-1  control-label'); ?>
            <div class="col-md-11 ">
                <?php echo $this->Form->input('url', array('placeholder' => 'url', 'type' => 'url', 'label' => false, 'class' => 'form-control')); ?>
            </div>
        </div>
        <div class="col-md-4" style="padding:0">   
            <?php echo $this->Form->button('Ajouter', array('type' => 'submit', 'class' => 'search btn btn-primary pull-right', 'id' => 'submit')); ?> 
        </div>  
        <?php echo $this->Form->end(); ?>

    </div>
</div>  
<div id="filelist_extmedias" class="filelist panel-group">
    <?php if (isset($ext_medias)): ?>
        <?php foreach ($ext_medias as $ext_media): ?>
            <?php //var_dump($ext_media); ?>
            <?php echo $this->element('ext_media', array('ext_media' => $ext_media, 'displayActions' => true)); ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>