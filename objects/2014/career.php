<?php

    $id = (int)$_GET["id"];
        
    if ($id) :
        
        $career = $mainsql->get_career($id);

        $page_title = "APPLY NOW";

    else :
	
        $page_title = "BE PART OF OUR GROWING COMPANY";

        $career_content = $mainsql->get_content(0, 0, 1, NULL, 0, 3);
        //var_dump($about_content);

        $career_data = $mainsql->get_career(0, 0, 0, NULL, 0, 1);

    endif;
	
?>