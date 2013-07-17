<?php

$config = \Config::load('ounziw_rss::controller/front', true);

$outdata = $config['before_list'] . PHP_EOL;
foreach ($rssdata as $rssitem){
    $linkid = array();
    if ($config['link_target'] == '_blank') {
        $linkid['target'] = '_blank';
    }
    if ($config['link_class']) {
        $linkid['class'] = $config['link_class'];
    }

    $outdata .= $config['before_item'];
    
    if (isset($date)) {
        $escaped_date = \Fuel\Core\Security::htmlentities($rssitem['date']);
        $outdata .= $config['before_date'] . $escaped_date . $config['after_date'];
    }
    
    $escaped_title = \Fuel\Core\Security::htmlentities($rssitem['title']);
    $outdata .= \Fuel\Core\Html::anchor($rssitem['link'], $escaped_title, $linkid);
    
    if (isset($content)) {
        $escaped_excerpt = \Fuel\Core\Security::htmlentities($rssitem['excerpt']);
        $outdata .= $config['before_excerpt'] . $escaped_excerpt . $config['after_excerpt'];
    }
    $outdata .= $config['after_item'];
    $outdata .= PHP_EOL;
}
$outdata .= $config['after_list'] . PHP_EOL;
echo $outdata;
