<?php

    $id = (int)$_GET["id"];
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1 ;
    $start = GRID_NUM_ROWS * ($page - 1);
        
    if ($id) :
        
        $promo = $mainsql->get_promos($id);

        //var_dump($promo);

        $page_title = $promo[0]['promo_title']." | WHAT'S NEW";

    else :

        $page_title = "WHAT'S NEW";

        $sprom_sess = $_SESSION['sprom'];
        
        if ($_POST['sprom']) {        
            $sprom = $_POST['sprom'] ? $_POST['sprom'] : NULL;       
            $_SESSION['sprom'] = $sprom;
        }
        elseif ($sprom_sess) {
            $sprom = $sprom_sess ? $sprom_sess : NULL;
            $_POST['sprom'] = $sprom != 0 ? $sprom : NULL;
        }
        else {
            $sprom = NULL;
            $_POST['sprom'] = NULL;
        }  

        $promo_content = $mainsql->get_content(0, 0, 1, NULL, 0, 2);

        $promo = $mainsql->get_promos(0, $start, GRID_NUM_ROWS, $sprom, 0);
        $promo_count = $mainsql->get_promos(0, 0, 0, $sprom, 1);

        //var_dump($promo);

        $pages = $mainsql->pagination("whatsnew", $promo_count, GRID_NUM_ROWS, 9);

    endif;
	
?>