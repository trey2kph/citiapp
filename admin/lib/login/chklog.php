<?php

	$cookiename = 'mcomp_user';

	$username = $_SESSION[$cookiename];	
	
	if ($username) {	        
		$redirectUrl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$_SESSION['login_url'] = $redirectUrl;
		$_SESSION['logout_url'] = $redirectUrl;	
		
		$checkname = $register->check_user($username);
		
		if (!$checkname) 
		{
			$logstat = 0;		
		}
		else 
		{
			$userdata = $register->get_member($username);
			
			$logstat = 1;
			$logfname = $userdata[0]['user_firstname'].' '.$userdata[0]['user_lastname'];
			$logname = $userdata[0]['user_firstname'].' '.$userdata[0]['user_lastname'];
			$userid = $userdata[0]['user_id'];	
			$email = $userdata[0]['user_email'];	
			$level = $userdata[0]['user_type'];		
		}		
	}
	else
	{
		$logstat = 0;
	}

?>