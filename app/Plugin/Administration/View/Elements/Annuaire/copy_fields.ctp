<script>
console.log($('#copyFrom'));
$('.dropdown-menu>li>a').css('color','red')
$(function() {
    
                $('#copyFrom').find('a').click(
                        function(event){
                            event.preventDefault();
                            var url=$(this).attr('href');
                            $.get(url,null,function(data) {
                                for (var property in data){
                                    $('[name=data\\[BufferedFicheactivite\\]\\['+property+'\\]]').val(data[property]).trigger('change');
                                    
                                }
                            
                                
                           });
                           
                    
                });
               
         })


        </script>
 <div class="well">       
<div class="btn-group">
  <button type="button" class="btn btn-primary">Voulez vous copier le contenu d'une fiche existante ?</button>
  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
    <span class="caret"></span>
    <span class="sr-only">Afficher/masquer</span>
  </button>
  <ul class="dropdown-menu" role="menu" id="copyFrom">
        <li><a><strong>Profil</strong></a></li>
        
            <li> <?php echo $this->Html->link($user['AdministrationUser']['username'], array('plugin' => 'administration','controller' => 'administrationUsers','action'=>'getById',$user['AdministrationUser']['id'])); ?></li>

           <?php if (count($user['AvailablesFicheactivite']) > 0) : ?>
            <li class="divider"></li>
            <li><a><strong>Activité(s)</strong></a></li>
             <?php foreach ($user['AvailablesFicheactivite'] as $ficheactivite): ?>
                <li><?php echo $this->Html->link($ficheactivite['nom_complet'], array('controller' =>$ficheactivite['controller'],'action'=>'getById',$ficheactivite['id'])); ?></li>
           
             <?php endforeach;endif; ?>
    
    
  </ul>
</div></div>
     