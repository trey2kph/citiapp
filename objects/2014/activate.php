<?php

    $id = $_GET["id"];

    if ($id) :

        $userhash_search = $register->get_member_by_hash($id);

        if ($userhash_search) :

            $activate_user = $mainsql->user_action(NULL, 'activate', $userhash_search[0]['user_id']);

            if ($activate_user) :

                if ($userhash_search[0]['user_type'] == 4) :

                    echo '<script type="text/javascript">alert("Your email ('.$userhash_search[0]['user_email'].') has been successfully activated.");</script>';
                    echo "<script language='javascript' type='text/javascript'>window.location.href='".WEB."'</script>";

                else :

                    $cookiename = 'imperial_user';
                    unset($_SESSION[$cookiename]);

                    $expire = time() + 60;
                    $_SESSION[$cookiename] = $userhash_search[0]['user_email'];

                    echo '<script type="text/javascript">alert("Your account ('.$userhash_search[0]['user_email'].') has been successfully activated.");</script>';
                    echo "<script language='javascript' type='text/javascript'>window.location.href='".WEB."'</script>";

                endif;

            endif;

        else :

            echo '<script type="text/javascript">alert("There\'s a problem with activation code has been submitted.");</script>';
            echo "<script language='javascript' type='text/javascript'>window.location.href='".WEB."'</script>";
            
        endif;

    else :

        echo "<script language='javascript' type='text/javascript'>window.location.href='".WEB."'</script>";

    endif;
	
?>