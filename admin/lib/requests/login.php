<?php	

    include("../../config.php");

    extract($_POST);

    $cookiename = 'mcomp_user';

    $checkfmem = $register->check_member($username, $password);

    $getmem = $register->get_member($username);
    if ($checkfmem)
    {
        $expire = time() + 60;
        $_SESSION[$cookiename] = $username;

        $success = 1;
    }
    else
    {	
        $success = 0;		
    }	

	echo $success;

?>