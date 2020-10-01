<?php

    include("../../config.php"); 
	//**************** USER MANAGEMENT - START ****************\\

	include(LIB."/login/chklog.php");

    $logged = $logstat;
    $profile_full = $logfname;
    $profile_name = $logname;
    $profile_id = $userid;
    $profile_email = $email;
    $profile_sex = $sex;

    if (!$logged) :
        echo '<script type="text/javascript">
            alert("Session has been expired.");
            window.location.href = "'.WEB.'";
        </script>';
    endif;

	$GLOBALS['level'] = $level;

    $sec = $profile_id ? $_GET['sec'] : NULL;

    switch ($sec) {
        
        case 'report': 
            
            $status = isset($_POST["status"]) ? $_POST["status"] : 0;
            if ($status == 3) :
                $status = 4;
                $type = 2;
                $stat = 3;
            elseif ($status == 4) :
                $status = 4;
                $type = 1;
                $stat = 4;
            else :
                $type = 0;
                $stat = $status;
            endif;
            $datefrom = $_POST["dfrom"] ? strtotime($_POST["dfrom"]) : 0;
            $dateto = $_POST["dto"] ? strtotime($_POST["dto"]) : 0;
            
            $report = $main->get_trans(0, 0, 0, NULL, 0, $status, $type, $datefrom, $dateto);	
            
            if ($report) :
                echo 1;
            else :
                echo 0;
            endif;
        
        break;
        
    }

?>