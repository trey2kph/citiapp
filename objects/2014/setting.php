<?php

	if ($logged == 1 && ($profile_level == 8 || $profile_level == 9)) {
	
		# PAGINATION
		$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1 ;
		$start = NUM_ROWS * ($page - 1);    
		
		//*********************** MAIN CODE START **********************\\
			
		# ASSIGNED VALUE
		$article_page = true;
		$page_title = "Setting";	
		
		//***********************  MAIN CODE END  **********************\\
		
		global $sroot, $profile_id;
        
        if($_POST['btneditset'] || $_POST['btneditset_x'])
        {
            $edit_set = $mainsql->set_update($_POST);

            if ($edit_set) {
                //AUDIT TRAIL
                $post['log_userid'] = $profile_id;
                $post['log_task'] = "SET_UPDATE";
                $post['log_data'] = 1;
                $post['log_date'] = date("U");

                $log = $mainsql->log_action($post, 'add');
                
                echo '<script type="text/javascript">alert("Setting has been successfully updated");</script>';
            } 
            else echo '<script type="text/javascript">alert("There\'s a problem");</script>';
        }

		$setting = $mainsql->get_set();

	}
	else
	{
		echo "<script language='javascript' type='text/javascript'>window.location.href='".WEB."/login'</script>";
	}
	
?>