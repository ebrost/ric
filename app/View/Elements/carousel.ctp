<?php echo $this->Html->css('carousel', null, array('inline' => false)); ?>
<?php echo $this->Html->script('jquery.carouFredSel-6.2.1-packed', array('block' => 'script')); ?>
<?php //echo $this->Html->script('carousel',array('block'=>'script')); ?>

<script>
    $(function() {
        Ric.carousel({carouselID: '#carousel', thumbsID: '#thumbs'})
    })

</script>
<!--debut carousel -->

<?php
$imagesThumb = "";
$imagesMedium = "";

$selected = ' class="selected"';

foreach ($images as $image){
/*
  $imagesLarges.='<span id="image'.$image[0].'">'.$this->element('thumbnail',array('imgThumb'=>$image[2],'imgWidth'=>200,'imgHeight'=>200));
  $imagesLarges.=(!empty($image[3]) || !empty($image[4]) ) ? '<div class="carousel-caption">'.$image[3]:'';
  $imagesLarges.=(!empty($image[4]) ) ? ' <small>&copy; '.$image[4].'</small>':'';

  $imagesLarges.=(!empty($image[3]) || !empty($image[4]) ) ? '</div>':'';
  $imagesLarges.='</span>';
  $imagesThumbs.='<a href="#image'.$image[0].'"'.$selected.'>'.$this->element('thumbnail',array('imgThumb'=>$image[2],'imgWidth'=>35,'imgHeight'=>35)).'</a>';

 */
//   if (isset($media[$image['category']]) && file_exists(WWW_ROOT.'/medias/'.$image['category'].'/'.$media[$image['category']]['dir'].'/'.'thumb_'.$media[$image['category']]['file'])) echo $this->Html->image('../medias/'.$image['category'].'/'.$media[$image['category']]['dir'].'/'.'thumb_'.$media[$image['category']]['file'],array('class'=>'thumb'));



//$imageMedium= $this->RicImage->image('../medias/'.$image['category'].'/'.$image['dir'].'/medium_'.$image['file'],array('class'=>'medium'));
$imagesMedium.='<span id="image'.$image['id'].'">'.$this->RicImage->image($image,'medium');
$imagesMedium.=(!empty($image['name']) || !empty($image['copyright']) ) ? '<div class="carousel-caption">'.$image['name']:'';
  $imagesMedium.=(!empty($image['copyright']) ) ? ' <small>&copy; '.$image['copyright'].'</small>':'';

  $imagesMedium.=(!empty($image['name']) || !empty($image['copyright']) ) ? '</div>':'';
  $imagesMedium.='</span>';

  if(count($images)<=1){
      $imagesThumb='';
  }
  else{
    //  $imagesThumb= $this->Html->image('../medias/'.$image['category'].'/'.$image['dir'].'/'.'thumb_'.$image['file'],array('class'=>'thummb'));
    

     $imagesThumb.='<a href="#image'.$image['id'].'"'.$selected.'>'.$this->RicImage->image($image,'thumb').'</a>';
  
  }

$selected='';


}
 $imagesThumb='<div id="thumbs-wrapper"><div id="thumbs">'.$imagesThumb.'</div><a id="prev" href="#"><i class="fa fa-arrow-left"></i></a><a id="next" href="#"><i class="fa fa-arrow-right"></i></a></div>';

$imagesMedium='<div id="carousel-wrapper"><div id="carousel">'.$imagesMedium.'</div></div>';
echo $imagesMedium.$imagesThumb;


?>