<?php
\backend\widgets\popup\assets\PopupAsset::register($this);

$first = 0;

?>
<div id="carousel<?= $model->id ?>" class="slick-slider image-popup">
    <a href="<?= $model->url ?>" class="img-popup" data-pjax="0">
        <img class="d-block img-fluid" src="<?= $model->sizes['preview']['url'] ?>"/>
    </a>
</div>