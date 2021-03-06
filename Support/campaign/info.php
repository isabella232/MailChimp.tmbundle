<?php
/**
 * Get info on current campaign
 *
 **/
$retval = $api->campaigns(array('campaign_id'=>$config->campaign_id));

if(false == $retval) {
    $err_msg = "";
    $oopsy->go(999, __('error_get_info'));
}

$ignoreFields = array('tracking', 'segment_opts', 'segment_text', 'type_opts' );
$outputT = '<b>%1$s</b>: %2$s <br>';
$linkT = '<a href="javascript:TextMate.system(\'open %1$s\', null)">%1$s</a>';
$collector = array();
foreach ($retval['data'][0] as $key => $value) {
    if(in_array($key, $ignoreFields)) { continue; }
    
    //Some transform
    if('archive_url' == $key) {
        $value = sprintf($linkT, $value);
    }
    
    $collector[] = sprintf($outputT, $key, $value);
}

echo '<h2>'.__('header_get_info').'</h2>';
echo implode('', $collector);