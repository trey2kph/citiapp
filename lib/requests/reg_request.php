<?php 

	include("../../config.php"); 
	//**************** USER MANAGEMENT - START ****************\\

	include(LIB."/login/chklog.php");
    include(LIB."/init/settinginit.php");

	$logged = $logstat;
    $profile_full = $logfname;
	$profile_name = $lognick;
	$profile_pic = $logpic;
	$profile_id = $userid;
	$profile_idnum = $logname;
	$profile_email = $email;
	$profile_level = $level;
    $profile_hash = md5('2014'.$profile_idnum);

	$GLOBALS['level'] = $level;
	
	//***************** USER MANAGEMENT - END *****************\\
?>

<?php	

    $sec = $_GET['sec'];

    switch ($sec) {
        case 'clear_search':	
            unset($_SESSION['searchuser']);
        break;
        case 'dir_clear_search':	
            unset($_SESSION['searchdir']);
            unset($_SESSION['searchdirdept']);
        break;
        case 'bday':	
            $emp_id = $_POST['empid'];
    
            $single_emp = $main->get_users($emp_id);
        
            foreach ($single_emp as $key => $value) : 
    
                echo '{"bday_empid":'.$value['emp_id'].', "bday_empname":"'.$value['emp_firstname'].' '.$value['emp_lastname'].' '.$value['emp_suffixname'].' ('.$value['emp_corpemail'].')", "bday_subject":"HAPPY BIRTHDAY '.$value['emp_nickname'].'!!!", "bday_email":"'.$value['emp_corpemail'].'", "bday_empnick":"'.$value['emp_nickname'].'"}';                
            
            endforeach; 
        break;
        case 'checkid':
            $empid = $_POST['id'];

            $member = $register->get_member_by_empid($empid);
            
            if ($member[0]['emp_id']) echo md5('2014'.$member[0]['emp_id']);
            else echo "0";
        
        break;             
        case 'dgrpsel':	
            $div_id = $_POST['divid'];
            
            $dgrp_select = '';
            $dgroup = $main->get_dgroup(0, NULL, 0, 0, NULL, 0, $div_id);
            if ($dgroup) :
                foreach ($dgroup as $key => $value) :
                    $dgrp_select .= '<option value="'.$value['dgroup_id'].'">'.$value['dgroup_name'].'</option>';
                endforeach;
                $dgrp_select .= '<option value="29999">N/A</option>';
            else :
                $dgrp_select .= '<option value="29999">N/A</option>';
            endif;
            echo $dgrp_select;
        
        break;        
        case 'deptsel':	
            $div_id = $_POST['divid'];
            
            $dept_select = '';
            $department = $main->get_dept(0, NULL, 0, 0, NULL, 0, $div_id);
            if ($department) :
                foreach ($department as $key => $value) :
                    $dept_select .= '<option value="'.$value['dept_id'].'">'.$value['dept_name'].'</option>';
                endforeach;
            else :
                $dept_select .= '<option value="29999">N/A</option>';
            endif;
            echo $dept_select;
        
        break;        
        case 'secsel':	
            $dept_id = $_POST['deptid'];
            
            $sec_select = '';
            $deptsection = $main->get_section(0, NULL, 0, 0, NULL, 0, $dept_id);
            if ($deptsection) :
                foreach ($deptsection as $key => $value) :
                    $sec_select .= '<option value="'.$value['sec_id'].'">'.$value['sec_name'].'</option>';
                endforeach;
            else :
                $sec_select .= '<option value="29999">N/A</option>';
            endif;
            echo $sec_select;
        
        break;       
        case 'approvesel':	
            $user_level = $_POST['userlevel'];
            $user_dept = $_POST['userdept'];
            if ($user_level == 0) :  
                $user_dept = 0;
            endif;
            
            $appr_select = '';
            $approver = $register->get_approver($user_dept);
            if ($approver) :
                if ($user_level == 1) : $appr_select .= '<option value="0">I have no approving head</option>'; endif;
                foreach ($approver as $key => $value) :
                    $appr_select .= '<option value="'.$value['emp_id'].'">'.$value['emp_firstname'].' '.$value['emp_lastname'].'</option>';
                endforeach;
            else :
                $appr_select .= '<option value="0">No approver has been populated</option>';
            endif;
            echo $appr_select;
        
        break;
        case 'delemp' :
            $id = $_POST['empid'];
			
            //AUDIT TRAIL
            //$log = $main->log_action("DELETE_USER", $id, $profile_id);
        
            $delete_user = $main->user_action(NULL, 'delete', $id);
            $user_info = $main->get_users($id, 0, 0, NULL);
        
            $message = "<div style='display: block; border: 5px solid #024485; padding: 10px; font-size: 12px; font-family: Verdana; width: 100%;'><span style='font-size: 18px; color: #024485; font-weight: bold;'>HR Portal Account Update</span><br><br>Hi ".$user_info[0]['emp_nickname'].",<br><br>";
            $message .= "You've account with employee ID ".$user_info[0]['emp_idnum']." has been DELETED on our system by approver.<br><br>";
            $message .= "Thanks,<br>";
            $message .= "iRoom Admin";
            $message .= "<hr />".MAILFOOT."</div>";
        
            $headers = "From: noreply@megaworldcorp.com\r\n";
            $headers .= "Reply-To: noreply@megaworldcorp.com\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        
            //$sendmail = mail($user_info[0]['emp_corpemail'], "HR Portal Account Update", $message, $headers);
        break;
        case 'approveemp':            

            $id = $_POST['empid'];	
        
            //AUDIT TRAIL
            //$log = $main->log_action("APPROVE_USER", $id, $profile_id);
        
            $user_approve = $main->user_action($_POST, 'approve', $id);
            $user_info = $main->get_users($id, 0, 0, NULL);
        
            echo '<a class="approveUser cursorpoint" attribute="'.$id.'" attribute2="'.$user_approve.'"><i class="fa '.($user_approve == 2 ? 'fa-unlock-alt greentext' : 'fa-lock redtext').' fa-lg"></i></a>';
        
            /*$message = "<div style='display: block; border: 5px solid #024485; padding: 10px; font-size: 12px; font-family: Verdana; width: 100%;'><span style='font-size: 18px; color: #024485; font-weight: bold;'>HR Portal Account Update</span><br><br>Hi ".$user_info[0]['emp_nickname'].",<br><br>";
            $message .= "You've account with employee ID ".$user_info[0]['emp_idnum']." has been ".($user_approve == 2 ? 'APPROVED' : 'DISAPPROVED')." on our system by approver.<br><br>";
            $message .= "Thanks,<br>";
            $message .= "iRoom Admin";
            $message .= "<hr />".MAILFOOT."</div>";
        
            $headers = "From: noreply@megaworldcorp.com\r\n";
            $headers .= "Reply-To: noreply@megaworldcorp.com\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        
            $sendmail = mail($user_info[0]['emp_corpemail'], "HR Portal Account Update", $message, $headers);*/
        
        break;     
    }            
	
?>			