<?php

    $search = $_GET["search"] ? $_GET["search"] : NULL;

    $storedata0 = $mainsql->get_store(0, 0, 0, $search, 0);
    $storedata1 = $mainsql->get_store();

    $storedata = $storedata0 ? $storedata0 : $storedata1;

    header("Content-type: text/xml");

    echo "<?xml version='1.0' ?>";
    echo '<markers>';
    $ind = 0;
    foreach ($storedata as $key => $value) : 
        echo '<marker ';
        echo 'id="'.$value['store_id'].'" ';
        echo 'name="Imperial '.$mainsql->parseToXML($value['store_name']).'" ';
        echo 'address="'.$mainsql->parseToXML($value['store_address'].', '.$value['store_city'].', '.$value['store_province']).'" ';
        echo 'tel="'.$mainsql->parseToXML($value['store_tel']).'" ';
        echo 'hour="'.$mainsql->parseToXML($value['store_hour']).'" ';
        echo 'lat="'.$value['store_x'] . '" ';
        echo 'lng="'.$value['store_y'].'" ';
        echo 'type="'.$value['store_type'].'" ';
        echo '/>';
        $ind = $ind + 1;
    endforeach;

    echo '</markers>';


?>