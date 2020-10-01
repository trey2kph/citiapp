<?php    

    if ($logged == 1) {
        
        $datenow = date('U');
        
        $status = isset($_GET["status"]) ? $_GET["status"] : 0;
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
        $datefrom = $_GET["from"] ? $_GET["from"] : 0;
        $dateto = $_GET["to"] ? $_GET["to"] : 0;

        $report = $main->get_trans(0, 0, 0, NULL, 0, $status, $type, $datefrom, $dateto);	
        $filename = "report_".$datenow.".xls";

        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");
    }
	else
	{
		echo "<script language='javascript' type='text/javascript'>window.location.href='".WEB."/login'</script>";
	}
    
?>