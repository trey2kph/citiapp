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
	
	//***************** USER MANAGEMENT - END *****************\\

    $sec = $_GET['sec'];

    switch ($sec) {            
        case 'entrynum':
            
            $entry_count = $main->get_entries(0, 0, 0, NULL, $session, 1);	
            echo $entry_count + 1;
            
        break;  
        case 'entryleg':
            
            $enum = $_POST['entrynum'];
            $eid = $_POST['entryid'] ? $_POST['entryid'] : 0;            
            $entry = $main->get_entries($eid);	            
            if ($entry) :
                $legarray = explode('|', $entry[0]['entry_legnum']);
            endif;
            
            for ($i=1; $i<=$enum; $i++) :
                echo '<div class="form-group">
                    <label for="entry_leg['.$i.']" class="col-sm-3 control-label">Leg '.$i.'</label>
                    <div class="col-sm-3">
                        <input id="entry_leg'.$i.'" type="text" name="entry_leg['.$i.']" value="'.($eid ? $legarray[$i - 1] : '').'" class="form-control" placeholder="Leg '.$i.'">
                    </div>
                </div>';
            endfor;
            
        break;
        case 'delete':
            $entry_id = $_POST['id'];
    
            $del_entry = $main->entry_action(NULL, 'delete', $entry_id);			
            if($del_entry) :
        
                //AUDIT TRAIL
                //$log = $main->log_action("DELETE_DRIVER", $driver_id, $profile_id); 
        
                return TRUE;
            else :
                return FALSE;
            endif;
        break;    
        
    }            
	
?>