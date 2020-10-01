<?php
    
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1 ;
    $start = NUM_ROWS * ($page - 1);

    if ($logged && $profile_level >= 8) :

        $id = $_REQUEST['id'] ? $_REQUEST['id'] : 0;
        $add = $_REQUEST['add'] ? $_REQUEST['add'] : 0;

        $page_title = "User Management";

        if($_POST['btnuser'] || $_POST['btnuser_x']) :

            $user_id = $_POST['user_id'] ? $_POST['user_id'] : 0;
            $userdata['user_type'] = $_POST['user_type'];
            $userdata['user_lastname'] = $_POST['user_lastname'];
            $userdata['user_firstname'] = $_POST['user_firstname'];
            $userdata['user_middlename'] = $_POST['user_middlename'];
            $userdata['user_address'] = $_POST['user_address'];
            $userdata['user_city'] = $_POST['user_city'];
            $userdata['user_zip'] = $_POST['user_zip'];
            $userdata['user_nationality'] = $_POST['user_nationality'];
            $userdata['user_cstatus'] = $_POST['user_cstatus'];
            $userdata['user_telno'] = $_POST['user_telno'];
            $userdata['user_mobile'] = $_POST['user_mobile'];
            $userdata['user_email'] = $_POST['user_email'];
            $userdata['user_password'] = $_POST['user_password'];
            $userdata['user_subscribe'] = $_POST['user_subscribe'];
            $userdata['user_refer'] = $_POST['user_refer'];
            $userdata['user_likes'] = $_POST['user_likes'];
            $userdata['user_user'] = $_POST['user_user'];

            if ($user_id) :
                $user_info = $main->user_action($userdata, 'update', $user_id);	
            else :
                $user_info = $main->user_action($userdata, 'add');	
            endif;

            //var_dump($user_info);
            if ($user_info) :
                if ($user_id) :
                    echo '{"success": true, "id": '.$user_id.', "add" : false}';
                else :
                    echo '{"success": true, "id": '.$user_info.', "add" : true}';
                endif;
                exit();            
            else :
                echo '{"success": false, "error": "System or program error"}';
                exit();
            endif;

        endif;

        $suser_sess = $_SESSION['suser'];
        if ($_POST['suser']) {        
            $suser = $_POST['suser'] ? $_POST['suser'] : NULL;            
            $_SESSION['suser'] = $suser;
        }
        elseif ($suser_sess) {
            $suser = $suser_sess ? $suser_sess : NULL;
            $_POST['suser'] = $suser != 0 ? $suser : NULL;
        }
        else {
            $suser = NULL;
            $_POST['suser'] = NULL;
        }   

        if ($id) :
            $user = $main->get_user($id);	
            $user_count = $main->get_user(0, 0, 0, NULL, 1);	
        elseif ($add) : 
            $user_count = $main->get_user(0, 0, 0, NULL, 1);	
        else :
            $userall = $main->get_user(0, $start, NUM_ROWS, NULL, 0);	
            $user = $main->get_user(0, $start, NUM_ROWS, $sprod, 0);	
            $usercount = $main->get_user(0, 0, 0, $sprod, 1);
            $pages = $main->pagination("user", $usercount, NUM_ROWS, 9);
        endif;


        

    else :
		echo "<script language='javascript' type='text/javascript'>window.location.href='".WEB."/login'</script>";
    endif;
?>