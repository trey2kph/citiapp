<?php
    
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1 ;
    $start = NUM_ROWS * ($page - 1);

    if ($logged) :

        $page_title = "Dashboard";


        


        $latest_prod = $main->get_products(0, 0, 5, NULL, 0);	
        $latest_user = $main->get_user(0, 0, 8, NULL, 0);
        $orderdata = $main->get_trans(0, 0, 4, NULL, 0);	

        $product_count = $main->get_products(0, 0, 0, NULL, 1);
        $brand_count = $main->get_brands(0, 0, 0, NULL, 1);	
        $cat_count = $main->get_category(0, 0, 0, NULL, 1);
        $promo_count = $main->get_promos(0, 0, 0, NULL, 1);	
        $store_count = $main->get_store(0, 0, 0, NULL, 1);	
        $careercount = $main->get_career(0, 0, 0, NULL, 1);
        $ordercount = $main->get_trans(0, 0, 0, NULL, 1);	
        $usercount = $main->get_user(0, 0, 0, NULL, 1);
        
        $order = $main->get_trans(0, 0, 5, $sorder, 0);	

    else :
		echo "<script language='javascript' type='text/javascript'>window.location.href='".WEB."/login'</script>";
    endif;
?>