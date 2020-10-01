<?php 

    include("config.php");

    include(LIB."/login/chklog.php");

    $mailfootdata = $main->get_setting(0, 0, 0, 'mailfoot');
    $wish_datedata = $main->get_setting(0, 0, 0, 'wish_date');	

    if ($wish_datedata[0]['set_val'] != date('Y-m-d')) :

        $wishcount = 0;
        $wishdata = $main->get_wish(0, 0, 0, 0, 0, 1, 1);

        foreach ($wishdata as $key => $value) :
            
            $tuser_data = $main->get_user($value['wish_user']);

            $message = "<div style='display: block; border: 2px solid #F00; padding: 0px; font-size: 14px; font-family: Verdana; width: 500px;'>

            <div style='display: inline-block; background: #F00; width: 100%; height: 120px; text-align: center'><img src='".SWEB."/images/iaplogo.png' style='margin-bottom: 10px;' /></div>
            <div style='display: inline-block; width: 90%; padding: 5%;'>
            <span style='font-size: 24px; color: #024485; font-weight: bold;'>Do You Care What you Wish</span><br><br>Dear ".$tuser_data[0]['user_firstname']." ".$tuser_data[0]['user_lastname'].",<br>
            One or more item on your wishlist is 3 days old. Do you want to purchased this? Please login and check your wishlist on the upper right-hand corner of the site";

            $message .= "<br><br>Thanks,<br>";
            $message .= SITENAME." Admin<br><hr>".$mailfootdata[0]['set_val']."</div></div>";

            $headers = "From: ".NOTIFICATION_EMAIL."\r\n";
            $headers .= "Reply-To: ".NOTIFICATION_EMAIL."\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            $sendmail = mail($tuser_data[0]['user_email'], "Do You Care What you Wish :)", $message, $headers);

            if ($sendmail) : $wishcount++; endif;

        endforeach;

        $set_id = 3;
        $setdata['set_val'] = date('Y-m-d');

        $set_info = $main->setting_action($setdata, 'update', $set_id);	

        echo '<script type="text/javascript">alert("'.$wishcount.' customer/s notification with wishlist 3 days old has been sent.")</script>';

    endif;
    
    $logged = $logstat;
    $profile_full = $logfname;
    $profile_name = $logname;
    $profile_id = $userid;
    $profile_email = $email;
    $profile_sex = $sex;
    $profile_level = $level;

    $section = $_REQUEST['section'] ? $_REQUEST['section'] : NULL; 

    if ($section) :
        include(OBJ.'/'.$section.'.php');
        include(TEMP.'/'.$section.'.php');
    else :	
        $ishome = 1;
        include(OBJ.'/home.php');
        include(TEMP.'/home.php');
    endif;

?>
       