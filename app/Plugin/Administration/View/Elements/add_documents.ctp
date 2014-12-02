<script>$(function () {
        Ric.uploader('Document', 'plupload_documents', 'browse_documents', 'droparea_documents',<?php echo empty($filelist)?"'filelist_documents'":"'".$filelist."'"; ?>, '<?php echo implode(',', $valid_documents_extensions); ?>')
    });
</script>
<div id="plupload_documents">


    <div id="droparea_documents" class="droparea" href="#">
        <p><?php echo __d('media', "Déplacer les fichiers ici"); ?></p>
        <?php echo __d('media', "ou"); ?><br/>

        <a id="browse_documents" href="#" class="btn btn-primary"><?php echo __d('media', "Parcourir"); ?></a>
        <p class="small">(<?php echo $text_valid_documents_extensions; ?>)</p>
    </div>
    <div id="filelist_documents" class="filelist panel-group">
        <?php if(isset($documents)): ?>
        <?php foreach ($documents as $document):; ?>          
        <?php echo $this->element('media', array('media' => $document, 'category' => 'Document', 'displayActions' => true)); ?>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
