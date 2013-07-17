<?php

$config = \Config::load('ounziw_rss::controller/front', true);
$modelconfig = \Config::load('ounziw_rss::model/front', true);
$rssurl = filter_var(\Arr::get($enhancer_args, 'rssurl', null), FILTER_VALIDATE_URL);
$option = array(
    'options' => array(
        'default' => $modelconfig['item_default'],
        'min_range' => $modelconfig['item_min'],
        'max_range' => $modelconfig['item_max'],
    )
);
$num_of_posts = filter_var(\Arr::get($enhancer_args, 'num_of_posts', $modelconfig['item_default']), FILTER_VALIDATE_INT,$option);
$content = filter_var(\Arr::get($enhancer_args, 'content', null), FILTER_VALIDATE_BOOLEAN);
$date = filter_var(\Arr::get($enhancer_args, 'date', null), FILTER_VALIDATE_BOOLEAN);
?>
<div>
    <?= __('RSS url') ?>: <?= \Fuel\Core\Form::input('rssurl', $rssurl, array('size'=>30));?><br />
    <?= __('Number of Posts') ?>: <?= \Fuel\Core\Form::input('num_of_posts', $num_of_posts, array('type'=>'number','min'=>$modelconfig['item_min'],'max'=>$modelconfig['item_max'],'step'=>1));?><br />
    <?= \Fuel\Core\Form::label(__('Display item content?'), 'content');?><?= \Fuel\Core\Form::checkbox('content', true, $content);?><br />
    <?= \Fuel\Core\Form::label(__('Display item date?'), 'date');?><?= \Fuel\Core\Form::checkbox('date', true, $date);?><br />
</div>

