<?php
    
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1 ;
    $start = NUM_ROWS * ($page - 1);

    if ($logged && ($profile_level == 2 || $profile_level >= 8)) :

        $id = $_REQUEST['id'] ? $_REQUEST['id'] : 0;
        $add = $_REQUEST['add'] ? $_REQUEST['add'] : 0;

        $page_title = "Brand Management";

        if($_POST['btnbrand'] || $_POST['btnbrand_x']) :

            // LOGO

            if ($_FILES['brand_logo']['name']) :
                $tmpFile = $_FILES['brand_logo']['tmp_name'];
                if ($tmpFile != "") :
                    $textension = explode(".", $_FILES['brand_logo']['name']);
                    $exten = end($textension);
                    $newname = str_replace('%', '', str_replace('+', '', urlencode(strtolower($_POST['brand_name'])))).'_'.date('U').'.'.$exten;

                    $newFile = $_SERVER['DOCUMENT_ROOT']."/imperial/uploads/brand/".basename($newname);
                    if(move_uploaded_file($tmpFile, $newFile)) :
                        $branddata['brand_logo'] = $newname;

                        //RESIZE IMAGE
                        $zebra->source_path = $_SERVER['DOCUMENT_ROOT']."/imperial/uploads/brand/".basename($newname);
                        $zebra->target_path = $_SERVER['DOCUMENT_ROOT']."/imperial/uploads/brand/".basename($newname);

                        $zebra->jpeg_quality = 70;

                        $zebra->preserve_aspect_ratio = true;
                        $zebra->enlarge_smaller_images = true;
                        $zebra->preserve_time = true;

                        $zebra->resize(100, 0, ZEBRA_IMAGE_CROP_CENTER);

                    else : 
                        $branddata['brand_logo'] = NULL;
                    endif;
                endif;
            else :
                $branddata['brand_logo'] = NULL;
            endif;

            $brand_id = $_POST['brand_id'] ? $_POST['brand_id'] : 0;
            $branddata['brand_name'] = $_POST['brand_name'];
            $branddata['brand_alias'] = urlencode(strtolower($_POST['brand_name']));
            $branddata['brand_country'] = $_POST['brand_country'];
            $branddata['brand_user'] = $_POST['brand_user'];

            if ($brand_id) :
                $brand_info = $main->brand_action($branddata, 'update', $brand_id);	
            else :
                $brand_info = $main->brand_action($branddata, 'add');	
            endif;

            //var_dump($brand_info);
            if ($brand_info) :
                if ($brand_id) :
                    echo '{"success": true, "id": '.$brand_id.', "add" : false}';
                else :
                    echo '{"success": true, "id": '.$brand_info.', "add" : true}';
                endif;
                exit();            
            else :
                echo '{"success": false, "error": "System or program error"}';
                exit();
            endif;

        endif;

        $sbrand_sess = $_SESSION['sbrand'];
        if ($_POST['sbrand']) {        
            $sbrand = $_POST['sbrand'] ? $_POST['sbrand'] : NULL;            
            $_SESSION['sbrand'] = $sbrand;
        }
        elseif ($sbrand_sess) {
            $sbrand = $sbrand_sess ? $sbrand_sess : NULL;
            $_POST['sbrand'] = $sbrand != 0 ? $sbrand : NULL;
        }
        else {
            $sbrand = NULL;
            $_POST['sbrand'] = NULL;
        }   

        if ($id) :
            $brand = $main->get_brands($id);	
            $brand_count = $main->get_brands(0, 0, 0, NULL, 1);	
            $brand_pics = $main->get_pics(0, 0, 0, 0, $id);	    
        elseif ($add) : 
            $brand_count = $main->get_brands(0, 0, 0, NULL, 1);	
        else :
            $brandall = $main->get_brands(0, $start, NUM_ROWS, NULL, 0);	
            $brand = $main->get_brands(0, $start, NUM_ROWS, $sbrand, 0);	
            $brandcount = $main->get_brands(0, 0, 0, $sbrand, 1);
            $pages = $main->pagination("brand", $brandcount, NUM_ROWS, 9);
        endif;


        

    else :
		echo "<script language='javascript' type='text/javascript'>window.location.href='".WEB."/login'</script>";
    endif;
?>