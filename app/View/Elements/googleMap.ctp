<div id="mapviewer" class="qbox">
<h3 id="mapswitch"><i class="fa fa-expand"></i> Agrandir la carte</h3>
<div id="mapcontainer" >
<style>
#maprefresh{
display:none;z-index:102;text-align:center;width:100%;position:absolute;background:#fff;height:400px;line-height:400px;
}

</style>
<div id="maprefresh"><i class="fa fa-refresh fa-spin fa-4x"></i></div>

<?php 
$model=Inflector::classify( $this->params['controller']);

echo $this->Html->script($this->GoogleMapV3->apiUrl());
echo $this->Html->script('oms.min');
$height=isset($height)? $height:'400px';

echo $this->GoogleMapV3->map(array('div'=>array('height'=>$height, 'width'=>'100%')));
if (isset($items[0])){
    
	foreach ($items as $item){
          
	$thumbnail=(isset($item['Image'][0]))? '<div class="pull-left inline" style="margin-right:5px">'.$this->RicImage->image($item['Image'][0],'icon').'</div>':'';

        
        
		$this->GoogleMapV3->addMarker(
			array(
				'lat' => $item[$model]['latitude'],
				'lng' => $item[$model]['longitude'],
				
				'title' => $item[$model]['nom_complet'], 
				'content' =>'<div id="info" style="width:250px;height:100px">'.$thumbnail
				.'<div class="pull-left inline" style="width:150px;">'
				.'<h6 style="margin:0 0 5px">'.$item[$model]['nom_complet'].'</h6>'
				.'<p style="margin:0;font-size:85%;line-height:100%;font-weight:normal">'
				.$item[$model]['adresse']
				.'<br/>'.$item[$model]['code_postal'].' '.$item[$model]['ville']
				
                                .'</p>'
                                .'<p>'.$item[$model]['additional_content'].'</p>'
                            .'</div>'
				.$this->Html->link('voir', array(
							'plugin'=>strtolower($this->params['plugin']),
							'controller' => strtolower($this->params['controller']),
							'action' => 'view',
							'id'=>$item[$model]['id'],
							'slug'=>Inflector::slug($item[$model]['nom_complet']),
							'num' =>$item[$model]['num'],
							'page'=>$this->request->params['named']['page'],
							'q'=>$q,
							'r'=>$item[$model]['relevance'],
                                                       
							
							),
							array('class'=>'btn btn-primary btn-mini pull-right'))
				.'</div>'
				
				
			)
		);

	}
}
else{
		$thumbnail=(isset($item[$model]['Image'][0]))? '<div class="pull-left inline" style="margin-right:5px">'.$this->RicImage->image($item[$model]['Image'][0],'icon').'</div>':'';	
        $this->GoogleMapV3->addMarker(
			array(
				'lat' => $items[$model]['latitude'],
				'lng' => $items[$model]['longitude'],
				//'icon'=> 'url_to_icon', // optional
				'title' => $items[$model]['nom_complet'], 
				'content' =>'<div id="info" style="width:250px;height:100px">'.$thumbnail
				.'<div class="pull-left inline" style="width:150px;">'
				.'<h6 style="margin:0 0 5px">'.$items[$model]['nom_complet'].'</h6>'
				.'<p style="margin:0;font-size:85%;line-height:100%;font-weight:normal">'
				.$items[$model]['adresse']
				.'<br/>'.$items[$model]['code_postal'].' '.$items[$model]['ville']
				.'</p></div>'
				.'</div>'
				
				
			)
		);


}

 echo $this->Html->scriptBlock($this->GoogleMapV3->script(),array('block'=>'script'));
?>
</div>
</div>

<script>
$(function(){
	var deployed=false;
 var googleMapViewerWidth = $("#mapviewer").width();
 var googleMapViewerHeight = $("#mapviewer").height();
 var googleMapContainerHeight = $("#mapcontainer").height();

 var googleMapViewerLeft = $("#mapviewer").position().left;

 MapResizeCallback=function(){

	google.maps.event.trigger(map0, 'resize');
	map0.panToBounds(bounds);
    map0.fitBounds(bounds);
	if(!deployed){
		
		$('#mapswitch').html('<i class="fa fa-expand"></i> Agrandir la carte').fadeIn();
		$('#mapviewer').css({position:'relative',left:0});
		$('#maprefresh').fadeOut();
	}
	else{
		
		$('#mapswitch').html('<i class="fa fa-compress"></i>  Réduire la carte').fadeIn();
		$('#maprefresh').fadeOut();
	}
	return false;
 }
 
deployMap=function(){
$('<div />').attr('id','overlay').appendTo('body').fadeIn();
//$('#mapcontainer').hide().before('<div id="maprefresh" style="z-index:102;text-align:center;width:100%;position:absolute;background:#fff;height:'+googleMapContainerHeight*1.5+'px;line-height:'+googleMapContainerHeight*1.5+'px;"><i class="icon-refresh icon-spin icon-4x"></i></div>');
	$('#mapcontainer').hide();
	$('#maprefresh').css({'height':googleMapContainerHeight*1.5+'px','line-height':googleMapContainerHeight*1.5+'px'}).fadeIn(100);
	//$('#mapviewer');
        $('#mapviewer').css({"position":"fixed","top":'10%',"left":'-100%',"width":"80%","height":googleMapViewerHeight*1.5 }).animate({"left":"10%"},1000,MapResizeCallback);
	$('#mapcontainer').animate({height:googleMapContainerHeight*1.5});
    
	$('#mapcontainer').show();
	$('#map_canvas').height('100%');
        deployed=true;
};

unDeployMap= function(){
        $('#overlay').fadeOut(1000,function(){$(this).remove()});
	$('#maprefresh').css({'line-height':googleMapContainerHeight+'px'}).fadeIn(100);
	$('#mapcontainer').css({display:"block",height:googleMapContainerHeight});
	 deployed=false;
	
	$('#mapviewer').css({"position":'inherit',top:"auto",left:"auto",width:"auto",height:"auto"});
	MapResizeCallback();
   // $('#mapviewer').animate({left:googleMapViewerLeft, width:googleMapViewerWidth,height:googleMapViewerHeight},1000,MapResizeCallback);
	$('#map_canvas').height(googleMapContainerHeight);
       
	
	
	

};
//jquery toogle deprecated...
$('#mapswitch').click(function(){
    $('#mapswitch').html('&nbsp;');
	if(!deployed){
                deployMap();
		
	}
	else{
		
		unDeployMap();

	}


});
})
</script>