<?php

	$cookiename = 'imperial_user';

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
            $lognick = $userdata[0]['user_firstname'];
			$logname = $userdata[0]['user_firstname'];
			$userid = $userdata[0]['user_id'];	
			$email = $userdata[0]['user_email'];	
			$mobile = $userdata[0]['user_mobile'];	
			$address = $userdata[0]['user_address'];	
			$level = $userdata[0]['user_type'];
		}		
	}
	else
	{
		$logstat = 0;
	}

?>