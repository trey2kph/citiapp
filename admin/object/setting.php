<?php
    
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1 ;
    $start = NUM_ROWS * ($page - 1);

    if ($logged && ($profile_level == 2 || $profile_level >= 8)) :

        $id = $_REQUEST['id'] ? $_REQUEST['id'] : 0;

        $page_title = "Setting";

        if($_POST['btnsetting'] || $_POST['btnsetting_x']) :

            $set_id = $_POST['set_id'];
            $setdata['set_val'] = $_POST['set_val'];

            if ($set_id) :
                $set_info = $main->setting_action($setdata, 'update', $set_id);	
            endif;

            //var_dump($brand_info);
            if ($set_info) :
                echo '{"success": true, "id": '.$set_id.'}';
                exit();            
            else :
                echo '{"success": false, "error": "System or program error"}';
                exit();
            endif;

        endif;

        if ($id) :
            $setting = $main->get_setting($id);	
            $setting_count = $main->get_setting(0, 0, 0, NULL, 1);	
        else :
            $setting = $main->get_setting(0, 0, 0, NULL, 0);	
        endif;


        

    else :
		echo "<script language='javascript' type='text/javascript'>window.location.href='".WEB."/login'</script>";
    endif;
?>