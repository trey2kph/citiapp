<?php
    
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
    $start = NUM_ROWS * ($page - 1);
    $status = isset($_GET["status"]) ? $_GET["status"] : 0;
    if ($status == 3) :
        $status = 4;
        $type = 2;
    elseif ($status == 4) :
        $status = 4;
        $type = 1;
    else :
        $type = 0;
    endif;

    if ($logged && ($profile_level == 6 || $profile_level >= 8)) :

        $id = $_REQUEST['id'] ? $_REQUEST['id'] : 0;
        $add = $_REQUEST['add'] ? $_REQUEST['add'] : 0;

        $page_title = "Order Management";

        $sprod_sess = $_SESSION['sorder'];
        if ($_POST['sorder']) {        
            $sorder = $_POST['sorder'] ? $_POST['sorder'] : NULL;            
            $_SESSION['sorder'] = $sorder;
        }
        elseif ($sorder_sess) {
            $sorder = $sorder_sess ? $sorder_sess : NULL;
            $_POST['sorder'] = $sorder != 0 ? $sorder : NULL;
        }
        else {
            $sorder = NULL;
            $_POST['sorder'] = NULL;
        }   

        $process_count = $main->get_trans(0, 0, 0, NULL, 1, 2, 0);
        $ship_count = $main->get_trans(0, 0, 0, NULL, 1, 4, 2);
        $pickup_count = $main->get_trans(0, 0, 0, NULL, 1, 4, 1);
        $done_count = $main->get_trans(0, 0, 0, NULL, 1, 9, 0);
        
        $order = $main->get_trans(0, $start, NUM_ROWS, $sorder, 0, $status, $type);	
        $ordercount = $main->get_trans(0, 0, 0, $sorder, 1, $status, $type);
        $pages = $main->pagination("order", $ordercount, NUM_ROWS, 9);

    else :
		echo "<script language='javascript' type='text/javascript'>window.location.href='".WEB."/login'</script>";
    endif;
?>