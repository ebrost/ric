<?php $this->extend('Common/dashboard'); ?>


<?php //debug($user); ?>
<div class="bs-callout bs-callout-info">
        <h4>Si votre événement s'inscrit dans le cadre d'un autre événement, commencez par créér l'événement "maître"</h4>
        <p>Ex: si votre concert s'inscrit dans un festival que vous gérez, commenez par créer le festival sans lui ajouter de sessions</p>
        <h4>Si votre événement comporte plusieurs sessions, créez l'événement puis ajoutez lui des sessions</h4>
        <p>Ex: une piece de théâtre ayant plusieurs représentations</p>


</div>
    <?php echo $this->Form->create('BufferedEvenement', array('class' => 'form-horizontal', 'role' => 'form')); ?> 
<div class="form-group">
    <div id="selectTypeEvenement">
        <label for="EvenementMaitre" class="col-md-3 control-label">Cet événement est "maître" </label>
        <div class="col-md-9 ">
            <div class="radio">
                <label>
                    <input type="radio" name="data[master]" id="optionsRadios1" value="1" >
                    Oui
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="data[master]" id="optionsRadios2" value="0" checked>
                    Non
                </label>
            </div>
        </div> 
    </div>
</div>                    
  <div class="row">
                <div class="col-md-9 col-md-offset-3">
                    <?php echo $this->Form->button('Valider', array('type' => 'submit', 'class' => 'search btn btn-primary', 'id' => 'submit')); ?> 

                </div>

            </div>
<?php echo $this->Form->end(); ?>