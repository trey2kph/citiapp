<?php
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1 ;
    $start = PROD_NUM_ROWS * ($page - 1);

    if ($logged && ($profile_level == 3 || $profile_level >= 8)) :

        $id = $_REQUEST['id'] ? $_REQUEST['id'] : 0;
        $add = $_REQUEST['add'] ? $_REQUEST['add'] : 0;

        $page_title = "Store Management";

        if($_POST['btnstore'] || $_POST['btnstore_x']) :

            $store_id = $_POST['store_id'] ? $_POST['store_id'] : 0;		
                        
            $storedata['store_name'] = $_POST['store_name'];	    
            $storedata['store_address'] = addslashes($_POST['store_address']);
            $storedata['store_city'] = $_POST['store_city'];
            $storedata['store_province'] = $_POST['store_province'];
            $storedata['store_tel'] = $_POST['store_tel'];
            $storedata['store_x'] = floatval($_POST['store_x']);
            $storedata['store_y'] = floatval($_POST['store_y']);
            $storedata['store_hour'] = $_POST['store_hour1'].' '.$_POST['store_hour2'];
            $storedata['store_user'] = $_POST['store_user'];		        

            if ($store_id) :
                $store_info = $main->store_action($storedata, 'update', $store_id);	
            else :
                $store_info = $main->store_action($storedata, 'add');	
            endif;
            
            if ($store_info) :
                echo '{"success": true}';
                exit();            
            else :
                echo '{"success": false, "error": "System or program error"}';
                exit();
            endif;

        endif;

        $sstore_sess = $_SESSION['sstore'];
        if ($_POST['sstore']) {        
            $sstore = $_POST['sstore'] ? $_POST['sstore'] : NULL;            
            $_SESSION['sstore'] = $sstore;
        }
        elseif ($sstore_sess) {
            $sstore = $sstore_sess ? $sstore_sess : NULL;
            $_POST['sstore'] = $sstore != 0 ? $sstore : NULL;
        }
        else {
            $sstore = NULL;
            $_POST['sstore'] = NULL;
        }   

        if ($id) :
            $store = $main->get_store($id);	
            $store_count = $main->get_store(0, 0, 0, NULL, 1);	
        elseif ($add) : 
            $store_count = $main->get_store(0, 0, 0, NULL, 1);	
        else :
            $store = $main->get_store(0, $start, PROD_NUM_ROWS, $sstore, 0);	
            $storecount = $main->get_store(0, 0, 0, $sstore, 1);
            $pages = $main->pagination("stores", $storecount, PROD_NUM_ROWS, 9);
        endif;
        

    else :
		echo "<script language='javascript' type='text/javascript'>window.location.href='".WEB."/login'</script>";
    endif;
?>