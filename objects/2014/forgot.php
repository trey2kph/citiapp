<?php    
	
	if ($logged == 1) :

		echo "<script language='javascript' type='text/javascript'>window.location.href='".WEB."'</script>";		

	else :
	        
        //*********************** MAIN CODE START **********************\\
			
		# ASSIGNED VALUE
		$page_title = "Forgot Password";	
		
		//***********************  MAIN CODE END  **********************\\
        
        global $sroot;
        
        if ($_POST['btnforgot'] || $_POST['btnforgot_x']) :
        
            $user_info = $mainsql->get_userbyidnum($_POST['empidnum']);
            $new_password = $register->random_password();	 
            
            $post['user_empnum'] = strtoupper($_POST['empidnum']);
            $post['user_passw'] = $new_password;

            $update_password = $register->update_member($post, 2);

            if ($update_password) :

                $message = "<div style='display: block; border: 5px solid #024485; padding: 10px; font-size: 12px; font-family: Verdana; width: 100%;'><span style='font-size: 18px; color: #024485; font-weight: bold;'>iVR Password Change</span><br><br>Hi ".$user_info[0]['user_fullname'].",<br><br>";
                $message .= "Your account password has been successfully reset.<br><br>";
                $message .= "<b>".$new_password."</b><br><br>";
                $message .= "Please click <a href='".WEB."'>here</a> to log in<br><br>";
                $message .= "Thanks,<br>";
                $message .= "iVR Admin";
                $message .= "<hr />".MAILFOOT."</div>";
                
                $headers = "From: noreply@megaworldcorp.com\r\n";
                $headers .= "Reply-To: noreply@megaworldcorp.com\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        
                $sendmail = mail($user_info[0]['user_email'], "iVR Password Change", $message, $headers);   

                if ($sendmail) :

                    //AUDIT TRAIL
                    $post['log_userid'] = $user_info[0]['user_id'];
                    $post['log_task'] = "FORGOT_PASSWORD";
                    $post['log_data'] = $user_info[0]['user_id'];
                    $post['log_date'] = date("U");

                    $log = $mainsql->log_action($post, 'add');

                    echo '{"success": true}';
                    exit();
                else :
                    echo '{"success": false, "error": "This employee ID hasn\'t been listed on system\'s database"}';
                    exit();
                endif;
            else :
                echo '{"success": false}';
                exit();
            endif;
    
        endif;

	endif;
	
?>