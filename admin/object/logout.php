<?php
	
	if ($logged == 1) {
	
		# PAGINATION
		$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1 ;
		
		//*********************** MAIN CODE START **********************\\
			
		# ASSIGNED VALUE
		$article_page = true;
		$page_title = "Logout";	
		
		//***********************  MAIN CODE END  **********************\\

		$cookiename = 'mcomp_user';
        
		unset($_SESSION[$cookiename]);
		echo "<script language='javascript' type='text/javascript'>window.location.href='".WEB."/login'</script>";

	}
	else
	{
		echo "<script language='javascript' type='text/javascript'>window.location.href='".WEB."/login'</script>";
	}
	
?>