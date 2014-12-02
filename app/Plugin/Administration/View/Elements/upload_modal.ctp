<!-- Button trigger modal -->

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $element; ?>">
  <?php echo $button_text; ?>
</button>

<!-- Modal -->
<div class="modal fade" id="<?php echo $element; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $button_text; ?></h4>
      </div>
      <div class="modal-body">
       <?php echo $this->element($element,array('filelist'=>$filelist,'displayActions'=>true)); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        
      </div>
    </div>
  </div>
</div>