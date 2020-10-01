<?php 

    include("config.php");

    $logged = 0;

    $section = $_REQUEST['section'] ? $_REQUEST['section'] : NULL; 

    if ($section) :
        include(OBJ.'/'.$section.'.php');
        include(TEMP.'/'.$section.'.php');
    else :	
        $ishome = 1;
        include(OBJ.'/home.php');
        include(TEMP.'/home.php');
    endif;

?>
       