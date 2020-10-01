<?php
    if ($logged && ($profile_level == 3 || $profile_level >= 8)) :

        $id = $_REQUEST['id'] ? $_REQUEST['id'] : 0;
        $add = $_REQUEST['add'] ? $_REQUEST['add'] : 0;

        $page_title = "Content Management";

        if($_POST['btncontent'] || $_POST['btncontent_x']) :

            $content_id = $_POST['contents_id'] ? $_POST['contents_id'] : 0;		
                        
            $contentsdata['content_title'] = addslashes($_POST['contents_title']);			
            $contentsdata['content_type'] = $_POST['contents_type'];		    
            $contentsdata['content_blurb'] = addslashes($_POST['contents_blurb']);
            $contentsdata['content_text'] = addslashes($_POST['contents_text']);
            $contentsdata['content_user'] = $_POST['contents_user'];		        

            if ($content_id) :
                $contents_info = $main->content_action($contentsdata, 'update', $content_id);	
            else :
                $contents_info = $main->content_action($contentsdata, 'add');	
            endif;
            
            if ($contents_info) :
                echo '{"success": true}';
                exit();            
            else :
                echo '{"success": false, "error": "System or program error"}';
                exit();
            endif;

        endif;

        if ($id) :
            $contents = $main->get_content($id);	
        elseif ($add) :
            $contents_count = $main->get_content(0, 0, 0, NULL, 1, 0);	
        else :
            $contents = $main->get_content(0, 0, 0, NULL, 0, 0);	
        endif;
        

    else :
		echo "<script language='javascript' type='text/javascript'>window.location.href='".WEB."/login'</script>";
    endif;
?>