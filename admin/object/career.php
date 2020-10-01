<?php
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1 ;
    $start = PROD_NUM_ROWS * ($page - 1);

    if ($logged && ($profile_level == 5 || $profile_level >= 8)) :

        $id = $_REQUEST['id'] ? $_REQUEST['id'] : 0;
        $add = $_REQUEST['add'] ? $_REQUEST['add'] : 0;

        $page_title = "Career Management";

        if($_POST['btncareer'] || $_POST['btncareer_x']) :

            $career_id = $_POST['career_id'] ? $_POST['career_id'] : 0;		
                        
            $careerdata['career_name'] = addslashes($_POST['career_name']);	    
            $careerdata['career_requirement'] = addslashes($_POST['career_requirement']);
            $careerdata['career_postfrom'] = strtotime($_POST['career_postfrom']);
            $careerdata['career_postto'] = strtotime($_POST['career_postto']);
            $careerdata['career_user'] = $_POST['career_user'];

            if ($career_id) :
                $career_info = $main->career_action($careerdata, 'update', $career_id);	
            else :
                $career_info = $main->career_action($careerdata, 'add');	
            endif;
            
            if ($career_info) :
                echo '{"success": true}';
                exit();            
            else :
                echo '{"success": false, "error": "System or program error"}';
                exit();
            endif;

        endif;

        $scareer_sess = $_SESSION['scareer'];
        if ($_POST['scareer']) {        
            $scareer = $_POST['scareer'] ? $_POST['scareer'] : NULL;            
            $_SESSION['scareer'] = $scareer;
        }
        elseif ($scareer_sess) {
            $scareer = $scareer_sess ? $scareer_sess : NULL;
            $_POST['scareer'] = $scareer != 0 ? $scareer : NULL;
        }
        else {
            $scareer = NULL;
            $_POST['scareer'] = NULL;
        }   

        if ($id) :
            $career = $main->get_career($id);	
        elseif ($add) :
            $career_count = $main->get_career(0, 0, 0, NULL, 1, 6);	
        else :
            $career = $main->get_career(0, $start, PROD_NUM_ROWS, $scareer, 0);	
            $careercount = $main->get_career(0, 0, 0, $scareer, 1);
            $pages = $main->pagination("career", $careercount, PROD_NUM_ROWS, 9);
        endif;
        

    else :
		echo "<script language='javascript' type='text/javascript'>window.location.href='".WEB."/login'</script>";
    endif;
?>