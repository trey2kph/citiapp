<?php

	include("config.php");

    //GOOGLE LOGIN API
    
    //require_once('../lib/googleapi/vendor/autoload.php');
    
    /*$gclient = new Google_Client();
    $gclient->setAuthConfig('../lib/googleapi/client_secret.json');
    $gclient->setRedirectUri(WEB.'/callback.php');*/

    //IP LOG

    $visitcount = $mainsql->get_visit(NULL, 1);
    $visitlog = $mainsql->get_visit($_SERVER['REMOTE_ADDR'], 1);
    if (!$visitlog) :
        $post['visit_ip'] = $_SERVER['REMOTE_ADDR'];
        $visitlog = $mainsql->visit_action($post, 'add');
    endif;
	
	//**************** USER MANAGEMENT - START ****************\\

	include(LIB."/login/chklog.php");
    //include(LIB."/init/settinginit.php");

    $logged = $logstat;
    $profile_full = $logfname;
	$profile_name = $lognick;
	$profile_pic = $logpic;
	$profile_id = $userid;
	$profile_idnum = $logname;
	$profile_mobile = $mobile;
	$profile_address = $address;
	$profile_email = $email;
	$profile_level = $level;
    $profile_hash = md5('2014'.$profile_idnum);
    $profile_appr = $appr;

    //$logged = 1; 

    //var_dump($profile_level);

	$GLOBALS['level'] = $level;

    //$setting = $mainsql->get_set();

    define("ANNOUNCEMENT", $setting[0]['set_announce']);
    define("MAILFOOT", $setting[0]['set_mailfoot']); 

    $footer_content = $mainsql->get_content(0, 0, 1, NULL, 0, 4);
	
	//***************** USER MANAGEMENT - END *****************\\
    		
	$section = $_REQUEST['section'];

    if ($_POST['btnregister'] || $_POST['btnregister_x']) :

        $post['user_lastname'] = $_POST['user_lastname'];
        $post['user_firstname'] = $_POST['user_firstname'];
        $post['user_email'] = $_POST['user_email'];
        $post['user_password'] = $_POST['user_password'];

        $chk_email = $register->check_email($post['user_email']);

        if ($chk_email) :
            echo '{"success": false, "error": "'.$post['user_email'].' already exist"}';
            exit();
        endif;

        $save = $mainsql->user_action($post, 'register');
        if($save) :  

            $activate_hash = md5('impact'.$save);

            $message = "<div style='display: block; border: 2px solid #888; background: #DDD; padding: 10px; font-size: 12px; font-family: Verdana; width: 100%;'><span style='font-size: 18px; color: #F00; font-weight: bold;'>You're Almost Done</span><br><br>Hi ".$_POST['user_firstname'].",<br><br>";
            $message .= "Welcome to Imperial Appliance Plaza. To activate your account and verify your email
address, please click the following link:<br><br><a href='".WEB."/activate/".$activate_hash."'>".WEB."/activate/".$activate_hash."</a><br><br>***NOTE*** Please print this page for your records. You'll need your verification link if you lose access to your account (for example, if you forget your username or password).<br><br>If you've received this mail in error, it's likely that another user entered your email address while trying to create an account for a different email address. If you don't click the verification link, the account won't
be activated.<br><br>If clicking the link above does not work, copy and paste the URL in a new browser window instead.<br><br>Thank you,<br>";
            $message .= SITENAME." Admin";
            $message .= "<hr />".MAILFOOT."</div>";

            $headers = "From: ".NOTIFICATION_EMAIL."\r\n";
            $headers .= "Reply-To: ".NOTIFICATION_EMAIL."\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            $sendmail = mail($_POST['user_email'], "Imperial Appliance Plaza: Please activate your account", $message, $headers);   

            echo '{"success": true}';
            exit();

        else :
            echo '{"success": false, "error": "There was a problem on registration"}';
            exit();
        endif; 

    endif;

    if ($logged) :
        $order_data = $mainsql->get_trans(0, 0, 5, NULL, 0, $profile_id, 0);
        $order_count = $mainsql->get_trans(0, 0, 0, NULL, 1, $profile_id, 0);
        $order_counth = $mainsql->get_trans(0, 0, 0, NULL, 1, $profile_id, 999);
        $order_page = $mainsql->ajax_pagination("order", $wishlist_count, 5, 9);
        $wishlist_data = $mainsql->get_wish(0, 0, 5, $profile_id, 0, 0, 1);
        $wishlist_count = $mainsql->get_wish(0, 0, 0, $profile_id, 1);
        $wishlist_page = $mainsql->ajax_pagination("wish", $wishlist_count, 5, 9);
    endif;
    $cart_count = count($_SESSION["cart_item"]);
		
	if ($section) :
		include(OBJ."/".$section.".php");
		include(TEMP."/".$section.".php");
	else :	
		$ishome = 1;
		include(OBJ."/index.php");
		include(TEMP."/index.php");
    endif;
	
?>