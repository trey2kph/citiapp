<?php
    
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1 ;
    $start = NUM_ROWS * ($page - 1);

    if ($logged && ($profile_level == 2 || $profile_level >= 8)) :

        $id = $_REQUEST['id'] ? $_REQUEST['id'] : 0;
        $add = $_REQUEST['add'] ? $_REQUEST['add'] : 0;

        $page_title = "Category Management";

        if($_POST['btncategory'] || $_POST['btncategory_x']) :

            $category_id = $_POST['category_id'] ? $_POST['category_id'] : 0;
            $categorydata['category_name'] = $_POST['category_name'];
            $categorydata['category_user'] = $_POST['category_user'];

            if ($category_id) :
                $category_info = $main->category_action($categorydata, 'update', $category_id);	
            else :
                $category_info = $main->category_action($categorydata, 'add');	
            endif;

            if ($category_info) :
                if ($category_id) :
                    echo '{"success": true, "id": '.$category_id.', "add" : false}';
                else :
                    echo '{"success": true, "id": '.$category_info.', "add" : true}';
                endif;
                exit();            
            else :
                echo '{"success": false, "error": "System or program error"}';
                exit();
            endif;

        endif;

        $scategory_sess = $_SESSION['scategory'];
        if ($_POST['scategory']) {        
            $scategory = $_POST['scategory'] ? $_POST['scategory'] : NULL;            
            $_SESSION['scategory'] = $scategory;
        }
        elseif ($scategory_sess) {
            $scategory = $scategory_sess ? $scategory_sess : NULL;
            $_POST['scategory'] = $scategory != 0 ? $scategory : NULL;
        }
        else {
            $scategory = NULL;
            $_POST['scategory'] = NULL;
        }   

        if ($id) :
            $cat = $main->get_category($id);	
            $cat_count = $main->get_category(0, 0, 0, NULL, 1);
            $subcat = $main->get_subcat(0, 0, 0, $id, 0);
        elseif ($add) : 
            $cat_count = $main->get_category(0, 0, 0, NULL, 1);	
        else :
            $catall = $main->get_category(0, $start, NUM_ROWS, NULL, 0);	
            $cat = $main->get_category(0, $start, NUM_ROWS, $scategory, 0);	
            $catcount = $main->get_category(0, 0, 0, $scategory, 1);
            $pages = $main->pagination("category", $catcount, NUM_ROWS, 9);
        endif;


        

    else :
		echo "<script language='javascript' type='text/javascript'>window.location.href='".WEB."/login'</script>";
    endif;
?>