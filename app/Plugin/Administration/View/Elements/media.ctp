
<?php $mediaId= $media[$category]['id']; ?>
<?php $media[$category]['category']= $category; ?>

<div class="file panel panel-default <?php echo $category; ?>" id="<?php echo $category.'-'. $mediaId;?>">
     <input type="hidden"  value="<?php echo (isset($media['id']))?$media['id']:'' ?>" name="data[media][<?php echo $mediaId ?>][id]">
     <input type="hidden"  value="<?php echo $mediaId ?>" name="data[media][<?php echo $mediaId ?>][media_id]">
     <input type="hidden"  data-attr="order" value="<?php echo (isset($media['order']))?$media['order']:'' ?>" name="data[media][<?php echo $mediaId ?>][order]">
   
    <div class="panel-heading clearfix">
<?php 
echo $this->RicImage->image($media[$category],'thumb');?> 
    <?php if (!empty($media[$category]['name'])): ?>
    <div class="name"><?php echo $media[$category]['name'];?></div>
    <?php elseif (!empty($media[$category]['file'])): ?>
    <div class="name"><?php echo $media[$category]['file'];?></div>
    <?php endif;?>
    <?php if (!empty($media[$category]['copyright'])): ?>
    <div class="copyright">© <?php echo $media[$category]['copyright'];?></div>
    <?php endif;?>
    <?php if (isset($displayActions) && $displayActions==true): ?>
        <div class="actions">
       
        <a data-target="#editMediaForm-<?php echo $media[$category]['id'];?>" data-toggle="collapse" class="btn btn-default btn-sm editMedia"><i class="fa fa-pencil-square-o "></i> Editer</a>
        <?php echo $this->Html->link('<i class="fa fa-trash-o "></i> Supprimer',array('controller' => 'administration_users','action'=>'ajaxDeleteMedia','id'=>$media[$category]['id'],'media_model'=>$category),array('escape'=>false,'class'=>'btn btn-danger btn-sm deleteMedia')); ?>
       
    </div>
    
    <div id="editMediaForm-<?php echo $media[$category]['id'];?>" class="collapse" style="clear:both">
      <div class="panel-body col-md-12" >
          <?php echo $this->Form->create('AdministrationUserEditMedia', array('url' => array('controller' => 'administration_users', 'action' => 'ajaxEditMedia'), 'class' => 'AdministrationUserEditMedia form-horizontal', 'role' => 'form')); ?>

        <div class="form-group">
<?php echo $this->Form->label('name', 'Nom', 'col-md-2  control-label'); ?>
                    <div class="col-md-6 ">
                    <?php echo $this->Form->input('name', array( 'label' => false, 'class' => 'form-control')); ?>
                    </div> 
                </div>
                <div class="form-group">
<?php echo $this->Form->label('copyright', 'Copyright', 'col-md-2  control-label'); ?>
                    <div class="col-md-6 ">
                    <?php echo $this->Form->input('copyright', array( 'label' => false, 'class' => 'form-control')); ?>
                    </div> 
                </div>
   <?php echo $this->Form->hidden('model',array('value'=>$model)); ?>
          <?php echo $this->Form->hidden('media_model',array('value'=>$category)); ?>   
   <?php echo $this->Form->hidden('id',array('value'=>$media[$category]['id'])); ?>   
<?php echo $this->Form->button('Enregistrer', array('type' => 'submit', 'class' => 'search btn btn-primary pull-right', 'id' => 'submit')); ?>
<?php echo $this->Form->end(); ?>
          
      </div>
    </div>
        
        <?php endif; ?>
    </div>
   
</div>