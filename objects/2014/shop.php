<?php

    $id = (int)$_GET["id"];
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1 ;
    $start = GRID_NUM_ROWS * ($page - 1);
        
    if ($id) :
        
        $product = $mainsql->get_products($id);
        $product_price = $mainsql->get_price(0, 0, 0, 0, $id);
        $product_brand = $mainsql->get_brands($product[0]['product_brand']);

        $ssubcat = explode(',', $product[0]['product_subcat']);

        $subcatprod = $mainsql->get_products(0, 0, 3, NULL, 0, $id, 0, 0, 0, $ssubcat, 0, 0, 1);

        $page_title = $product[0]['product_name']." | SHOP";

    else :

        $page_title = "SHOP";

        $sprod_sess = $_SESSION['sprod'];
        $sbrand_sess = $_SESSION['sbrand'];
        $scat_sess = $_SESSION['scat'];
        $ssubcat_sess = $_SESSION['ssubcat'];
        $sprice_sess = $_SESSION['sprice'];
        if ($_POST['sprod'] || $_POST['sbrand'] || $_POST['scat'] || $_POST['ssubcat']) {        
            $sprod = $_POST['sprod'] ? $_POST['sprod'] : NULL;            
            $sbrand = ($_POST['sbrand'] && $_POST['sbrand'] != 99999) ? explode(',', $_POST['sbrand']) : 0;            
            $scat = ($_POST['scat'] && $_POST['scat'] != 99999) ? $_POST['scat'] : 0;            
            $ssubcat = ($_POST['ssubcat'] && $_POST['ssubcat'] != 99999) ? explode(',', $_POST['ssubcat']) : 0;            
            $sprice = ($_POST['sprice'] && $_POST['sprice'] != 99999) ? explode(',', $_POST['sprice']) : 0;            
            $_SESSION['sprod'] = $sprod;
            $_SESSION['sbrand'] = implode(',', $sbrand);
            $_SESSION['scat'] = $scat;
            $_SESSION['ssubcat'] = implode(',', $ssubcat);
            $_SESSION['sprice'] = implode(',', $sprice);
        }
        elseif ($sprod_sess || $sbrand_sess || $scat_sess || $ssubcat_sess) {
            $sprod = $sprod_sess ? $sprod_sess : NULL;
            $sbrand = $sbrand_sess ? explode(',', $sbrand_sess) : 0;
            $scat = $scat_sess ? $scat_sess : 0;
            $ssubcat = $ssubcat_sess ? explode(',', $ssubcat_sess) : 0;
            $sprice = $sprice_sess ? explode(',', $sprice_sess) : 0;
            $_POST['sprod'] = $sprod != 0 ? $sprod : NULL;
            $_POST['sbrand'] = $sbrand != 0 ? $sbrand : 0;
            $_POST['scat'] = $scat != 0 ? $scat : 0;
            $_POST['ssubcat'] = $ssubcat != 0 ? $ssubcat : 0;
            $_POST['sprice'] = $sprice != 0 ? $sprice : 0;
        }
        else {
            $sprod = NULL;
            $sbrand = 0;
            $scat = 0;
            $ssubcat = 0;
            $sprice = 0;
            $_POST['sprod'] = NULL;
            $_POST['sbrand'] = $sbrand != 0 ? $sbrand : 0;
            $_POST['scat'] = $scat != 0 ? $scat : 0;
            $_POST['ssubcat'] = $ssubcat != 0 ? $ssubcat : 0;
            $_POST['sprice'] = $sprice != 0 ? $sprice : 0;
        }  

        //var_dump($sbrand.", ".$scat.", ".$ssubcat);

        $product = $mainsql->get_products(0, $start, GRID_NUM_ROWS, $sprod, 0, 0, 0, $sbrand, $scat, $ssubcat, $sprice);
        $product_count = $mainsql->get_products(0, 0, 0, $sprod, 1, 0, 0, $sbrand, $scat, $ssubcat, $sprice);

        $pages = $mainsql->pagination("shop", $product_count, GRID_NUM_ROWS, 9);

        $nprice = $mainsql->get_minmax_price(0, $sprod, 0, 0, $sbrand, $scat, $ssubcat);
        $xprice = $mainsql->get_minmax_price(1, $sprod, 0, 0, $sbrand, $scat, $ssubcat);
        $minprice = number_format($nprice, 0, "", "");
        $maxprice = number_format($xprice, 0, "", "") + 1;

        if ($scat) :
            $subcat_count = $mainsql->get_subcat(0, 0, 0, $scat, 1);
        endif;

        $category = $mainsql->get_category(0, 0, 0, NULL, 0, 0, 1);
        $brand = $mainsql->get_brands(0, 0, 0, NULL, 0, 0, 1);

    endif;
	
?>