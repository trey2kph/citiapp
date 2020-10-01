<?php 

	include("../../config.php"); 
	//**************** USER MANAGEMENT - START ****************\\

	include(LIB."/login/chklog.php");

    $logged = $logstat;
    $profile_full = $logfname;
    $profile_name = $logname;
    $profile_id = $userid;
    $profile_email = $email;
	
	//***************** USER MANAGEMENT - END *****************\\

    $sec = $_GET['sec'];

    switch ($sec) {             
        case 'chkemail':
            $user_email = $_POST['email'];
    
            $chkemail = $register->check_email($user_email);			
            if($chkemail) :
                echo 1;
            else :
                echo 0;
            endif;
        break;      
        case 'subscribe':
            $post['user_lastname'] = 'user_'.date("U");
            $post['user_email'] = $_POST['email'];
            $post['user_password'] = md5($register->random_password());
    
            $subscribe_user = $mainsql->user_action($post, 'subscribe');			
            if($subscribe_user) :
            
                $activate_hash = md5('impact'.$subscribe_user);

                $message = "<div style='display: block; border: 2px solid #888; background: #DDD; padding: 10px; font-size: 12px; font-family: Verdana; width: 100%;'><span style='font-size: 18px; color: #F00; font-weight: bold;'>You're Almost Done</span><br><br>Hi,<br><br>";
                $message .= "Welcome to Imperial Appliance Plaza. To activate your account and verify your email
    address, please click the following link:<br><br><a href='".WEB."/activate/".$activate_hash."'>".WEB."/activate/".$activate_hash."</a><br><br>***NOTE*** Please print this page for your records. You'll need your verification link if you lose access to your account (for example, if you forget your username or password).<br><br>If you've received this mail in error, it's likely that another user entered your email address while trying to create an account for a different email address. If you don't click the verification link, the account won't
    be activated.<br><br>If clicking the link above does not work, copy and paste the URL in a new browser window instead.<br><br>Thank you,<br>";
                $message .= SITENAME." Admin";
                $message .= "<hr />".MAILFOOT."</div>";

                $headers = "From: ".NOTIFICATION_EMAIL."\r\n";
                $headers .= "Reply-To: ".NOTIFICATION_EMAIL."\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                $sendmail = mail($_POST['email'], "Imperial Appliance Plaza: Please activate your email address", $message, $headers);   
        
                //AUDIT TRAIL
                //$log = $mainsql->log_action("DELETE_PROMO", $user_id, $profile_id); 
        
                return TRUE;
            else :
                return FALSE;
            endif;
        break;      
        case 'delete':
            $user_id = $_POST['id'];
    
            $del_user = $mainsql->user_action(NULL, 'delete', $user_id);			
            if($del_user) :
        
                //AUDIT TRAIL
                //$log = $mainsql->log_action("DELETE_PROMO", $user_id, $profile_id); 
        
                return TRUE;
            else :
                return FALSE;
            endif;
        break;    
            
        case 'status':
            $user_id = $_POST['id'];
            $userdata['user_status'] = $_POST['status'];		
    
            $user_stat = $mainsql->user_action($userdata, 'status', $user_id);			
            if($user_stat) :
                
                //AUDIT TRAIL
                //$log = $mainsql->log_action("STATUS_PROMO", $user_id, $profile_id); 
        
                return TRUE;
            else :
                return FALSE;
            endif;
        break; 
            
        
        
    }            
	
?>