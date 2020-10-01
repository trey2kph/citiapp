<?php
	
	$page_title = "STORE LOCATOR";
        
    $sstore = $_GET['sstore'] ? $_GET['sstore'] : NULL;     

    $storedatal = $mainsql->get_store(0, 0, 0, $sstore, 0);
    
	
?>