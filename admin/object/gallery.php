<?php
    if ($logged) :

        $id = $_REQUEST['id'] ? $_REQUEST['id'] : 0;
        $add = $_REQUEST['add'] ? $_REQUEST['add'] : 0;

        $page_title = "Gallery Management";

        if($_POST['btngallery'] || $_POST['btngallery_x']) :

            
            $allowedExts = array("JPEG", "jpeg", "JPG", "jpg", "GIF", "gif", "PNG", "png");

            if ($_FILES['gallery_pic']['name']) :
                $filename = $_FILES['gallery_pic']['name'];
                $filesize = $_FILES['gallery_pic']['size'];

                //var_dump($filename.' '.$filesize);

                $tempext = explode(".", $filename);
                $extension = end($tempext);

                if (($filesize >= 4048570) || !in_array($extension, $allowedExts)) : //10Mb
                    echo '{"success": false, "error": "One of the photo has invalid file type and/or not less then 400Kb"}';
                    exit();
                endif;
            endif;

            // PROFILE PIC

            if ($_FILES['gallery_pic']['name']) :
                $tmpFile = $_FILES['gallery_pic']['tmp_name'];
                if ($tmpFile != "") :
                    $newFile = $_SERVER['DOCUMENT_ROOT']."/upload/gallery/".basename($_FILES['gallery_pic']['name']);
                    if(move_uploaded_file($tmpFile, $newFile)) :
                        $gallerydata['gallery_pic'] = $_FILES['gallery_pic']['name'];
                    else : 
                        $gallerydata['gallery_pic'] = NULL;
                    endif;
                endif;
            else :
                $gallerydata['gallery_pic'] = NULL;
            endif;

            $gallery_id = $_POST['gallery_id'] ? $_POST['gallery_id'] : 0;
            $gallerydata['gallery_user'] = $_POST['gallery_user'];

            if ($gallery_id) :
                $gallery_info = $main->gallery_action($gallerydata, 'update', $gallery_id);	
            else :
                $gallery_info = $main->gallery_action($gallerydata, 'add');	
            endif;

            //var_dump($gallery_info);
            if ($gallery_info) :

                if ($gallery_id) :
                    echo '{"success": true, "id": '.$gallery_id.', "add" : false}';
                else :
                    echo '{"success": true, "id": '.$gallery_info.', "add" : true}';
                endif;
                exit();            
            else :
                echo '{"success": false, "error": "System or program error"}';
                exit();
            endif;

        endif;

        if ($id) :
            $gallery = $main->get_gallery($id);	
        elseif ($add) :
            $gallery_count = $main->get_gallery(0, 0, 0, NULL, 1, 6);	
        else :
            $gallery = $main->get_gallery(0, 0, 0, NULL, 0, 6);	
        endif;
        

    else :
		echo "<script language='javascript' type='text/javascript'>window.location.href='".WEB."/login'</script>";
    endif;
?>