<?php
    
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1 ;
    $start = NUM_ROWS * ($page - 1);

    if ($logged && ($profile_level == 6 || $profile_level >= 8)) :

        $id = $_REQUEST['id'] ? $_REQUEST['id'] : 0;
        $add = $_REQUEST['add'] ? $_REQUEST['add'] : 0;

        $page_title = "Wishlist Management";

        $sprod_sess = $_SESSION['swish'];
        if ($_POST['swish']) {        
            $swish = $_POST['swish'] ? $_POST['swish'] : NULL;            
            $_SESSION['swish'] = $swish;
        }
        elseif ($swish_sess) {
            $swish = $swish_sess ? $swish_sess : NULL;
            $_POST['swish'] = $swish != 0 ? $swish : NULL;
        }
        else {
            $swish = NULL;
            $_POST['swish'] = NULL;
        }   

        
        $wish = $main->get_wish(0, $start, NUM_ROWS, $swish, 0);	
        $wishcount = $main->get_wish(0, 0, 0, $swish, 1);
        $pages = $main->pagination("wish", $wishcount, NUM_ROWS, 9);
        

    else :
		echo "<script language='javascript' type='text/javascript'>window.location.href='".WEB."/login'</script>";
    endif;
?>