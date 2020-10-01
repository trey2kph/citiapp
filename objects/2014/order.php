<?php

    $id = (int)$_GET["id"];
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1 ;
    $start = NUM_ROWS * ($page - 1);

    if ($logged) :

        $page_title = "MY ORDER";

        $order_data = $mainsql->get_trans(0, $start, NUM_ROWS, NULL, 0, $profile_id, 0);
        $order_count = $mainsql->get_trans(0, 0, 0, NULL, 1, $profile_id, 0);
        $pages = $mainsql->ajax_pagination("order", $order_count, NUM_ROWS, 9);

        if ($order_data) :
            $cart_id = $order_data[0]['trans_id'];
            $cart_data = unserialize($order_data[0]['trans_order']);
        else :
            $cart_id = 0;
            $cart_data = NULL;
        endif;

    else :
		echo "<script language='javascript' type='text/javascript'>window.location.href='".WEB."'</script>";
    endif;
	
?>