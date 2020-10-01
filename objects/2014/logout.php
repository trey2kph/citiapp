<?php
	
	if ($logged == 1) {
	
		# PAGINATION
		$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1 ;
		
		# CLEAN THE GET VARIABLES
		if (isset($_GET['id']))
		{ 
			$_GET['id'] = $main->clean_variable($_GET['id'], 1); 
		}
		
		//*********************** MAIN CODE START **********************\\
			
		# ASSIGNED VALUE
		$article_page = true;
		$page_title = "";	
		
		//***********************  MAIN CODE END  **********************\\

		$cookiename = 'imperial_user';
		//AUDIT TRAIL
		//$log = $main->log_action("LOGOUT", 0, $profile_id);
		unset($_SESSION[$cookiename]);
        unset($_SESSION["cart_item"]);
		echo "<script language='javascript' type='text/javascript'>window.location.href='".WEB."'</script>";

	}
	else
	{
		echo "<script language='javascript' type='text/javascript'>window.location.href='".WEB."'</script>";
	}
	
?>