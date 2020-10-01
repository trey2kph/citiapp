<?php
    
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1 ;
    $start = PROD_NUM_ROWS * ($page - 1);

    if ($logged && ($profile_level == 2 || $profile_level >= 8)) :

        $id = $_REQUEST['id'] ? $_REQUEST['id'] : 0;
        $add = $_REQUEST['add'] ? $_REQUEST['add'] : 0;

        $page_title = "Product Management";

        if($_POST['btnproduct'] || $_POST['btnproduct_x']) :

            $totalfile = count($_FILES['product_pics']['name']);
            $allowedExts = array("JPEG", "jpeg", "JPG", "jpg", "GIF", "gif", "PNG", "png");
            $fileerror = 0;
            for($i=0; $i<$totalfile; $i++) :

                if ($_FILES['product_pics']['name'][$i]) :
                    $filename = $_FILES['product_pics']['name'][$i];
                    $filesize = $_FILES['product_pics']['size'][$i];

                    //var_dump($filename.' '.$filesize);

                    $tempext = explode(".", $filename);
                    $extension = end($tempext);

                    if (($filesize >= 1048570) || !in_array($extension, $allowedExts)) : //10Mb
                        $fileerror++;
                    endif;
                endif;

            endfor;

            if ($fileerror) :
                echo '{"success": false, "error": "One of the photo has invalid file type and/or not less then 100Kb"}';
                exit();
            endif;

            // SMALL PIC

            if ($_FILES['product_smallimg']['name']) :
                $tmpFile = $_FILES['product_smallimg']['tmp_name'];
                if ($tmpFile != "") :
                    $textension = explode(".", $_FILES['product_smallimg']['name']);
                    $exten = end($textension);
                    $newname = str_replace('%', '', str_replace('+', '', urlencode(strtolower($_POST['product_name'])))).'_'.date('U').'.'.$exten;

                    $newFile = $_SERVER['DOCUMENT_ROOT']."/imperial/uploads/prodsimg/".basename($newname);
                    if(move_uploaded_file($tmpFile, $newFile)) :
                        $productdata['product_smallimg'] = $newname;

                        //RESIZE IMAGE
                        $zebra->source_path = $_SERVER['DOCUMENT_ROOT']."/imperial/uploads/prodsimg/".basename($newname);
                        $zebra->target_path = $_SERVER['DOCUMENT_ROOT']."/imperial/uploads/prodsimg/".basename($newname);

                        $zebra->jpeg_quality = 70;

                        $zebra->preserve_aspect_ratio = true;
                        $zebra->enlarge_smaller_images = true;
                        $zebra->preserve_time = true;

                        $zebra->resize(300, 0, ZEBRA_IMAGE_CROP_CENTER);

                    else : 
                        $productdata['product_smallimg'] = NULL;
                    endif;
                endif;
            else :
                $productdata['product_smallimg'] = NULL;
            endif;

            // LARGE PIC

            if ($_FILES['product_largeimg']['name']) :
                $tmpFile = $_FILES['product_largeimg']['tmp_name'];
                if ($tmpFile != "") :
                    $textension = explode(".", $_FILES['product_largeimg']['name']);
                    $exten = end($textension);
                    $newname = str_replace('%', '', str_replace('+', '', urlencode(strtolower($_POST['product_name'])))).'_'.date('U').'.'.$exten;

                    $newFile = $_SERVER['DOCUMENT_ROOT']."/imperial/uploads/prodlimg/".basename($newname);
                    if(move_uploaded_file($tmpFile, $newFile)) :
                        $productdata['product_largeimg'] = $newname;

                        //RESIZE IMAGE
                        $zebra->source_path = $_SERVER['DOCUMENT_ROOT']."/imperial/uploads/prodlimg/".basename($newname);
                        $zebra->target_path = $_SERVER['DOCUMENT_ROOT']."/imperial/uploads/prodlimg/".basename($newname);

                        $zebra->jpeg_quality = 70;

                        $zebra->preserve_aspect_ratio = true;
                        $zebra->enlarge_smaller_images = true;
                        $zebra->preserve_time = true;

                        $zebra->resize(1000, 0, ZEBRA_IMAGE_CROP_CENTER);

                    else : 
                        $productdata['product_largeimg'] = NULL;
                    endif;
                endif;
            else :
                $productdata['product_largeimg'] = NULL;
            endif;

            $product_id = $_POST['product_id'] ? $_POST['product_id'] : 0;
            $productdata['product_name'] = $_POST['product_name'];
            $productdata['product_feature'] = $_POST['product_feature'] ? 1 : 0;
            $productdata['product_model'] = $_POST['product_model'];
            $productdata['product_modelyear'] = $_POST['product_modelyear'] ? $_POST['product_modelmonth'].$_POST['product_modelyear'] : date('mY');
            $productdata['product_price'] = $_POST['product_price'];
            $productdata['product_sku'] = $_POST['product_sku'];
            $productdata['product_cat'] = $_POST['product_cat'];
            $productdata['product_subcat'] = $_POST['product_subcat'];
            $productdata['product_brand'] = $_POST['product_brand'];
            $productdata['product_specs'] = $_POST['product_specs'];
            $productdata['product_blurb'] = $_POST['product_blurb'];
            $productdata['product_tags'] = $_POST['product_tags'];
            $productdata['product_user'] = $_POST['product_user'];

            if ($product_id) :
                $product_info = $main->product_action($productdata, 'update', $product_id);	
            else :
                $product_info = $main->product_action($productdata, 'add');	
            endif;

            //var_dump($product_info);
            if ($product_info) :

                if ($product_id) :
                    $logsdata['logs_item'] = $product_id;
                    $logsdata['logs_task'] = "UPDATE_PRODUCT";
                    $logsdata['logs_user'] = $_POST['product_user'];
                    $logs_action = $main->logs_action($logsdata, 'add');	
                else :
                    $logsdata['logs_item'] = $product_info;
                    $logsdata['logs_task'] = "CREATE_PRODUCT";
                    $logsdata['logs_user'] = $_POST['product_user'];
                    $logs_action = $main->logs_action($logsdata, 'add');	
                endif;

                $pricedata['price_price'] = $_POST['product_price'];
                $pricedata['price_product'] = $product_info;
                $pricedata['price_user'] = $_POST['product_user'];
                
                $price_product = $main->product_action($pricedata, 'addprice');

                $total1 = count($_FILES['product_dimension']['name']);
                $productdimdata['pic_data'] = $product_info;
                $productdimdata['pic_type'] = 1;
                $productdimdata['pic_user'] = $_POST['product_user'];

                for($i=0; $i<$total1; $i++) :
                    $tmpFile = $_FILES['product_dimension']['tmp_name'][$i];
                    if ($tmpFile != "") :

                        $textension = explode(".", $_FILES['product_dimension']['name'][$i]);
                        $exten = end($textension);
                        $newname = 'dim_'.str_replace('%', '', str_replace('+', '', urlencode(strtolower($_POST['product_name'])))).'_'.date('YmdHis').'_'.$i.'.'.$exten;

                        $productdimdata['pic_file'] = $newname;

                        $newFile = $_SERVER['DOCUMENT_ROOT']."/imperial/uploads/dimension/".basename($newname);
                        if(move_uploaded_file($tmpFile, $newFile)) :
                            $product_dim = $main->product_action($productdimdata, 'addpic');	

                            //RESIZE IMAGE
                            $zebra->source_path = $newFile;
                            $zebra->target_path = $newFile;

                            $zebra->jpeg_quality = 80;

                            $zebra->preserve_aspect_ratio = true;
                            $zebra->enlarge_smaller_images = true;
                            $zebra->preserve_time = true;

                            $zebra->resize(900, 0, ZEBRA_IMAGE_CROP_CENTER);
                        endif;
                    endif;
                endfor;

                $total2 = count($_FILES['product_pics']['name']);
                $productpicdata['pic_data'] = $product_info;
                $productpicdata['pic_type'] = 2;
                $productpicdata['pic_user'] = $_POST['product_user'];

                for($i=0; $i<$total2; $i++) :
                    $tmpFile = $_FILES['product_pics']['tmp_name'][$i];
                    if ($tmpFile != "") :

                        $textension = explode(".", $_FILES['product_pics']['name'][$i]);
                        $exten = end($textension);
                        $newname = 'pic_'.str_replace('%', '', str_replace('+', '', urlencode(strtolower($_POST['product_name'])))).'_'.date('YmdHis').'_'.$i.'.'.$exten;

                        $productpicdata['pic_file'] = $newname;

                        $newFile = $_SERVER['DOCUMENT_ROOT']."/imperial/uploads/broucher/".basename($newname);
                        if(move_uploaded_file($tmpFile, $newFile)) :
                            $product_pic = $main->product_action($productpicdata, 'addpic');	

                            //RESIZE IMAGE
                            $zebra->source_path = $newFile;
                            $zebra->target_path = $newFile;

                            $zebra->jpeg_quality = 80;

                            $zebra->preserve_aspect_ratio = true;
                            $zebra->enlarge_smaller_images = true;
                            $zebra->preserve_time = true;

                            $zebra->resize(900, 0, ZEBRA_IMAGE_CROP_CENTER);
                        endif;
                    endif;
                endfor;

                if ($product_id) :
                    echo '{"success": true, "id": '.$product_id.', "add" : false}';
                else :
                    echo '{"success": true, "id": '.$product_info.', "add" : true}';
                endif;
                exit();            
            else :
                echo '{"success": false, "error": "System or program error"}';
                exit();
            endif;

        endif;

        $sprod_sess = $_SESSION['sprod'];
        if ($_POST['sprod']) {        
            $sprod = $_POST['sprod'] ? $_POST['sprod'] : NULL;            
            $_SESSION['sprod'] = $sprod;
        }
        elseif ($sprod_sess) {
            $sprod = $sprod_sess ? $sprod_sess : NULL;
            $_POST['sprod'] = $sprod != 0 ? $sprod : NULL;
        }
        else {
            $sprod = NULL;
            $_POST['sprod'] = NULL;
        }   

        if ($id) :
            $product = $main->get_products($id);	
            $product_count = $main->get_products(0, 0, 0, NULL, 1);
            $subcat = $main->get_subcat(0, 0, 0, $product[0]['product_cat'], 0);
            $product_price = $main->get_price(0, 0, 5, 0, $id);	     
            $product_dimension = $main->get_pics(0, 0, 0, 0, $id, 1);	     
            $product_pics = $main->get_pics(0, 0, 0, 0, $id, 2);

            if ($product[0]['product_modelyear']) :
                $productmonth = substr($product[0]['product_modelyear'], 0, 2);
                $productyear = substr($product[0]['product_modelyear'], -4);
            else :
                $productmonth = date('m');
                $productyear = date('Y');
            endif;

            $product_logs = $main->get_logs($id);
        elseif ($add) : 
            $product_count = $main->get_products(0, 0, 0, NULL, 1);	
        else :
            $productall = $main->get_products(0, $start, PROD_NUM_ROWS, NULL, 0);	
            $product = $main->get_products(0, $start, PROD_NUM_ROWS, $sprod, 0);	
            $productcount = $main->get_products(0, 0, 0, $sprod, 1);
            $pages = $main->pagination("product", $productcount, PROD_NUM_ROWS, 9);
        endif;

        $brand = $main->get_brands(0, 0, 0, NULL, 0, 2);
        $cat = $main->get_category(0, 0, 0, NULL, 0, 2);
        

    else :
		echo "<script language='javascript' type='text/javascript'>window.location.href='".WEB."/login'</script>";
    endif;
?>