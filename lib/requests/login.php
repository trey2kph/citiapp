<?php	

    include("../../config.php");

    extract($_POST);

    $cookiename = 'imperial_user';

    $checkfmem = $register->check_member($username, $password);

    if ($checkfmem)
    {
        $expire = time() + 60;
        $_SESSION[$cookiename] = $username;
        
        //var_dump($_SESSION[$cookiename]);

        $success = 1;
    }
    else
    {	
        $success = 0;		
    }	

	echo $success;

?>