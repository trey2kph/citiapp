<?php

    if (!$logged) :

        $page_title = "Login";
        
	else :
		echo "<script language='javascript' type='text/javascript'>window.location.href='".WEB."'</script>";
    endif;

?>