<?php
	
	if ($logged == 0) {
	
		# PAGINATION
		$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1 ;
		
		//*********************** MAIN CODE START **********************\\
			
		# ASSIGNED VALUE
		$article_page = true;
		$page_title = "Callback";	
		
		//***********************  MAIN CODE END  **********************\\
		
		global $sroot, $profile_id;
        
        if ($_SESSION['googleToken']) :
            $gclient->setAccessToken($_SESSION['googleToken']);
        elseif ($_GET['code']) :
            $access_token = $gclient->fetchAccessTokenWithAuthCode($_GET['code']);
            $_SESSION['googleToken'] = $access_token;
        else :
            header(WEB);
        endif;
        
        $cookiename = 'imperial_user';
        
        $gAuth = new Google_Service_Oauth2($gclient);
        $guser = $gAuth->userinfo->get();
        
        $checkuser = $register->check_user($guser->email);
        if ($checkuser) :
            $_SESSION[$cookiename] = $guser->email;
        else :
            $passwordgen = $register->random_password();
        
            $post['user_lastname'] = $guser->familyName;
            $post['user_firstname'] = $guser->givenNames;
            $post['user_email'] = $guser->email;
            $post['user_password'] = $passwordgen;
            $post['user_gtoken'] = $_SESSION['googleToken'];
        
            $save = $mainsql->user_action($post, 'regauth');
            if($save) :  

                $message = "<div style='display: block; border: 2px solid #888; background: #DDD; padding: 10px; font-size: 12px; font-family: Verdana; width: 100%;'><span style='font-size: 18px; color: #F00; font-weight: bold;'>You've Sucessfully Registered</span><br><br>Hi ".$_POST['user_firstname'].",<br><br>";
                $message .= "Welcome to Imperial Appliance Plaza. You've login using your Google account. Your name and email address has been registered to our database.<br><br>Your password will be<br><br><b>".$passwordgen."</b><br><br>and can be change once you've login.<br><br>Thank you,<br>";
                $message .= SITENAME." Admin";
                $message .= "<hr />".MAILFOOT."</div>";

                $headers = "From: ".NOTIFICATION_EMAIL."\r\n";
                $headers .= "Reply-To: ".NOTIFICATION_EMAIL."\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                $sendmail = mail($_POST['user_email'], "Imperial Appliance Plaza: You've sucessfully registered with your Google account", $message, $headers);   
        
                $_SESSION[$cookiename] = $guser->email;
        
            endif; 
        endif;
        
        header(WEB);

	}
	else
	{
		echo "<script language='javascript' type='text/javascript'>window.location.href='".WEB."'</script>";
	}
	
?>