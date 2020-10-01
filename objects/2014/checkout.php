<?php

    if ($logged) :

        $page_title = "CHECKOUT";

        if($_POST['btncoproceed'] || $_POST['btncoproceed_x']) :
            $cartdata = $_SESSION["cart_item"];

            $item_total = 0;
            
            foreach ($cartdata as $value) : 
                $item_total = $item_total + ($value['price'] * $value['quantity']); 
            endforeach; 

            if ($_POST['txtconame'] && $_POST['txtcoemail'] && $_POST['txtcomobile'] && $_POST['txtcoaddress'] && $_POST['txtcoinstruct']) :

                $post['trans_uid'] = $profile_id;
                $post['trans_order'] = serialize($cartdata);
                $post['trans_fname'] = $_POST['txtconame'];
                $post['trans_mobile'] = $_POST['txtcomobile'];
                $post['trans_address'] = $_POST['txtcoaddress'].', '.$_POST['txtcity'].', '.$_POST['txtprovince'];
                $post['trans_uremark'] = $_POST['txtcoinstruct'];
                $post['trans_price'] = $item_total;
                $post['trans_paytype'] = $_POST['txtcoptype'];

                $add_trans = $mainsql->trans_action($post, 'add');

                //var_dump($add_trans);

                if ($add_trans) :
                    unset($_SESSION["cart_item"]);
                    echo '{"success": true}';
                    exit();
                else :
                    echo '{"success": false, "error": "System and database error"}';
                    exit();
                endif;
                    
            else :
                echo '{"success": false, "error": "All fields are required"}';
                exit();
            endif;
        endif;

        $cart_data = $_SESSION["cart_item"];

    else :
		echo "<script language='javascript' type='text/javascript'>window.location.href='".WEB."'</script>";
    endif;
	
?>