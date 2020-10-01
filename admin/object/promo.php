<?php
    
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1 ;
    $start = NUM_ROWS * ($page - 1);

    if ($logged && ($profile_level == 3 || $profile_level >= 8)) :

        $id = $_REQUEST['id'] ? $_REQUEST['id'] : 0;
        $add = $_REQUEST['add'] ? $_REQUEST['add'] : 0;

        $page_title = "Promo Management";

        if($_POST['btnpromo'] || $_POST['btnpromo_x']) :

            // SMALL PIC

            if ($_FILES['promo_smallimg']['name']) :
                $tmpFile = $_FILES['promo_smallimg']['tmp_name'];
                if ($tmpFile != "") :
                    $textension = explode(".", $_FILES['promo_smallimg']['name']);
                    $exten = end($textension);
                    $newname = 's'.str_replace('%', '', str_replace('+', '', urlencode(strtolower($_POST['promo_title'])))).'_'.date('U').'.'.$exten;

                    $newFile = $_SERVER['DOCUMENT_ROOT']."/imperial/uploads/promo/".basename($newname);
                    if(move_uploaded_file($tmpFile, $newFile)) :
                        $promodata['promo_smallimg'] = $newname;

                        //RESIZE IMAGE
                        $zebra->source_path = $_SERVER['DOCUMENT_ROOT']."/imperial/uploads/promo/".basename($newname);
                        $zebra->target_path = $_SERVER['DOCUMENT_ROOT']."/imperial/uploads/promo/".basename($newname);

                        $zebra->jpeg_quality = 70;

                        $zebra->preserve_aspect_ratio = true;
                        $zebra->enlarge_smaller_images = true;
                        $zebra->preserve_time = true;

                        $zebra->resize(300, 0, ZEBRA_IMAGE_CROP_CENTER);

                    else : 
                        $promodata['promo_smallimg'] = NULL;
                    endif;
                endif;
            else :
                $promodata['promo_smallimg'] = NULL;
            endif;

            // LARGE PIC

            if ($_FILES['promo_largeimg']['name']) :
                $tmpFile = $_FILES['promo_largeimg']['tmp_name'];
                if ($tmpFile != "") :
                    $textension = explode(".", $_FILES['promo_largeimg']['name']);
                    $exten = end($textension);
                    $newname = 'l'.str_replace('%', '', str_replace('+', '', urlencode(strtolower($_POST['promo_title'])))).'_'.date('U').'.'.$exten;

                    $newFile = $_SERVER['DOCUMENT_ROOT']."/imperial/uploads/promo/".basename($newname);
                    if(move_uploaded_file($tmpFile, $newFile)) :
                        $promodata['promo_largeimg'] = $newname;

                        //RESIZE IMAGE
                        $zebra->source_path = $_SERVER['DOCUMENT_ROOT']."/imperial/uploads/promo/".basename($newname);
                        $zebra->target_path = $_SERVER['DOCUMENT_ROOT']."/imperial/uploads/promo/".basename($newname);

                        $zebra->jpeg_quality = 70;

                        $zebra->preserve_aspect_ratio = true;
                        $zebra->enlarge_smaller_images = true;
                        $zebra->preserve_time = true;

                        $zebra->resize(1100, 0, ZEBRA_IMAGE_CROP_CENTER);

                    else : 
                        $promodata['promo_largeimg'] = NULL;
                    endif;
                endif;
            else :
                $promodata['promo_largeimg'] = NULL;
            endif;

            // HUGE PIC

            if ($_FILES['promo_hugeimg']['name']) :
                $tmpFile = $_FILES['promo_hugeimg']['tmp_name'];
                if ($tmpFile != "") :
                    $textension = explode(".", $_FILES['promo_hugeimg']['name']);
                    $exten = end($textension);
                    $newname = 'h'.str_replace('%', '', str_replace('+', '', urlencode(strtolower($_POST['promo_title'])))).'_'.date('U').'.'.$exten;

                    $newFile = $_SERVER['DOCUMENT_ROOT']."/imperial/uploads/promo/".basename($newname);
                    if(move_uploaded_file($tmpFile, $newFile)) :
                        $promodata['promo_hugeimg'] = $newname;

                        //RESIZE IMAGE
                        $zebra->source_path = $_SERVER['DOCUMENT_ROOT']."/imperial/uploads/promo/".basename($newname);
                        $zebra->target_path = $_SERVER['DOCUMENT_ROOT']."/imperial/uploads/promo/".basename($newname);

                        $zebra->jpeg_quality = 70;

                        $zebra->preserve_aspect_ratio = true;
                        $zebra->enlarge_smaller_images = true;
                        $zebra->preserve_time = true;

                        $zebra->resize(1100, 0, ZEBRA_IMAGE_CROP_CENTER);

                    else : 
                        $promodata['promo_hugeimg'] = NULL;
                    endif;
                endif;
            else :
                $promodata['promo_hugeimg'] = NULL;
            endif;

            $promo_id = $_POST['promo_id'] ? $_POST['promo_id'] : 0;
            $promodata['promo_title'] = addslashes($_POST['promo_title']);
            $promodata['promo_desc'] = addslashes($_POST['promo_desc']);
            $promodata['promo_mechanic'] = addslashes($_POST['promo_mechanic']);
            $promodata['promo_type'] = $_POST['promo_type'];
            $promodata['promo_user'] = $_POST['promo_user'];

            if ($promo_id) :
                $promo_info = $main->promo_action($promodata, 'update', $promo_id);	
            else :
                $promo_info = $main->promo_action($promodata, 'add');	
            endif;

            //var_dump($promo_info);
            if ($promo_info) :

                if ($promo_id) :
                    echo '{"success": true, "id": '.$promo_id.', "add" : false}';
                else :
                    echo '{"success": true, "id": '.$promo_info.', "add" : true}';
                endif;
                exit();            
            else :
                echo '{"success": false, "error": "System or program error"}';
                exit();
            endif;

        endif;

        $spromo_sess = $_SESSION['spromo'];
        if ($_POST['spromo']) {        
            $spromo = $_POST['spromo'] ? $_POST['spromo'] : NULL;            
            $_SESSION['spromo'] = $spromo;
        }
        elseif ($spromo_sess) {
            $spromo = $spromo_sess ? $spromo_sess : NULL;
            $_POST['spromo'] = $spromo != 0 ? $spromo : NULL;
        }
        else {
            $spromo = NULL;
            $_POST['spromo'] = NULL;
        }   

        if ($id) :
            $promo = $main->get_promos($id);	
            $promo_count = $main->get_promos(0, 0, 0, NULL, 1);	
        elseif ($add) : 
            $promo_count = $main->get_promos(0, 0, 0, NULL, 1);	
        else :
            $promoall = $main->get_promos(0, $start, NUM_ROWS, NULL, 0);
            $promo = $main->get_promos(0, $start, NUM_ROWS, $spromo, 0);	
            $promocount = $main->get_promos(0, 0, 0, $spromo, 1);
            $pages = $main->pagination("promo", $promocount, NUM_ROWS, 9);
        endif;


        

    else :
		echo "<script language='javascript' type='text/javascript'>window.location.href='".WEB."/login'</script>";
    endif;
?>