<?php 

	include("../../config.php"); 
	//**************** USER MANAGEMENT - START ****************\\

	include(LIB."/login/chklog.php");

    $logged = $logstat;
    $profile_full = $logfname;
    $profile_name = $logname;
    $profile_id = $userid;
    $profile_email = $email;
	
	//***************** USER MANAGEMENT - END *****************\\

    $sec = $_GET['sec'];

    switch ($sec) { 
        case 'catcount':
            $catcount = $mainsql->get_category(0, 0, 0, NULL, 1);
            
            echo $catcount;
        break;
        case 'subcatcount':
            $category_id = $_POST['catid'];
            $subcatcount = $mainsql->get_subcat(0, 0, 0, $category_id, 1);
            
            echo $subcatcount;
        break;
        case 'catsel':
            
            ?>

            <script>
                $(".catopt").on("click", function() {	
                     
                    $(".fbcat").fadeOut("fast");
                    $(".footcat").fadeOut("fast");
                    var catid = $(this).attr('attribute');
                    var catname = $(this).attr('attribute2');
                    var brandid = new Array(); 
                    var priceval = new Array();   

                    var sprod = "";

                    $('input[name^="brand"]').each(function(){                    
                        var checked = $(this).is(':checked');

                        if (checked) {
                            brandid.push($(this).val());                    
                        }
                    });

                    $('input[name^="price"]').each(function(){                    
                        priceval.push($(this).val());                    
                    });

                    $.ajax(
                    {
                        url: "<?php echo WEB; ?>/lib/requests/category_request.php?sec=subcatsel",
                        data: "catid=" + catid + "&catname=" + catname,
                        type: "POST",
                        success: function(data) {                        
                            $(".fbcat").html(data);
                            $(".fbcat").fadeIn("fast");
                        }
                    });  

                    $.ajax(
                    {
                        url: "<?php echo WEB; ?>/lib/requests/category_request.php?sec=subcatcount",
                        data: "catid=" + catid,
                        type: "POST",
                        success: function(data) {    
                            if (data > 6) {
                                $(".fbcat").animate({height: 195}, 200);
                                $(".showcat").html('Show More');
                                $(".footcat").fadeIn("fast");
                            } 
                        }
                    });     

                    $.ajax(
                    {
                        url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=table",
                        data: "sprod=" + sprod + "&sbrand=" + brandid + "&scat=" + catid + "&sprice=" + priceval,
                        type: "POST",
                        success: function(data) {                        
                            $("#proddata").html(data);
                        }
                    });  
                });
            </script>

            <?php
            
            $catsel = "";
    
            $cat = $mainsql->get_category(0, 0, 0, NULL, 0, 0, 1);
            
            $catsel .= '<ul>';
            foreach ($cat as $key => $value) : 
            $catsel .= '<li><input id="cat'.$key.'" type="checkbox" attribute="'.$value['category_id'].'" attribute2="'.$value['category_name'].'" name="cat['.$key.']" value="1" class="catopt" /> '.$value['category_name'].'</li>';
            endforeach;
            $catsel .= '</ul>';
            
            echo $catsel;
            
        break;          
        case 'subcatsel':
            
            ?>

            <script>
    
                $(".subcatopt").on("click", function() {
                    var catid = $(this).attr('attribute2');
                    var subcathome = $(this).attr('attribute');
                    var brandid = new Array();  
                    var subcatid = new Array();  
                    var priceval = new Array();   

                    var sprod = ""; 

                    if (subcathome == 99999) {
                        catid = 99999;
                        subcatid = 99999;

                        $('input[name^="brand"]').each(function(){                    
                            var checked = $(this).is(':checked');

                            if (checked) {
                                brandid.push($(this).val());                    
                            }
                        });

                        $('input[name^="price"]').each(function(){                    
                            priceval.push($(this).val());                    
                        });

                        $(".footcat").fadeOut("fast");
                        $(".fbcat").fadeOut("fast");	
                        $.ajax(
                        {
                            url: "<?php echo WEB; ?>/lib/requests/category_request.php?sec=catsel",
                            type: "POST",
                            success: function(data) {                        
                                $(".fbcat").html(data);
                                $(".fbcat").fadeIn("fast");
                            }
                        });   

                        $.ajax(
                        {
                            url: "<?php echo WEB; ?>/lib/requests/category_request.php?sec=catcount",
                            type: "POST",
                            success: function(data) {    
                                if (data > 7) {
                                    $(".fbcat").animate({height: 195}, 200);
                                    $(".showcat").html('Show More');
                                    $(".footcat").fadeIn("fast");
                                } 
                            }
                        });   

                        $.ajax(
                        {
                            url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=table",
                            data: "sprod=" + sprod + "&sbrand=" + brandid + "&scat=" + catid + "&ssubcat=" + subcatid + "&sprice=" + priceval,
                            type: "POST",
                            success: function(data) {                        
                                $("#proddata").html(data);
                            }
                        });  
                    } else {

                        $('input[name^="brand"]').each(function(){                    
                            var checked = $(this).is(':checked');

                            if (checked) {
                                brandid.push($(this).val());                    
                            }
                        });

                        $('input[name^="subcat"]').each(function(){                    
                            var checked = $(this).is(':checked');

                            if (checked) {
                                subcatid.push($(this).val());                    
                            }
                        });

                        $('input[name^="price"]').each(function(){                    
                            priceval.push($(this).val());                    
                        });

                        $.ajax(
                        {
                            url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=table",
                            data: "sprod=" + sprod + "&sbrand=" + brandid + "&scat=" + catid + "&ssubcat=" + subcatid + "&sprice=" + priceval,
                            type: "POST",
                            success: function(data) {                        
                                $("#proddata").html(data);
                            }
                        });  
                    }
                });
            </script>

            <?php
            
            $catsel = "";
            $category_id = $_POST['catid'];
            $category_name = $_POST['catname'];
    
            $subcat = $mainsql->get_subcat(0, 0, 0, $category_id, 0);
            
            $catsel .= '<ul>';
            $catsel .= '<li><input id="subcat99999" type="checkbox" attribute="99999" attribute2="'.$category_id.'" name="cat[99999]" value="99999" class="subcatopt" checked /> <b>'.$category_name.'</b></li>';  
            if ($category_id) :
            foreach ($subcat as $key => $value) : 
            $catsel .= '<li><input id="subcat'.$key.'" type="checkbox" attribute="'.$value['subcat_id'].'" attribute2="'.$category_id.'" name="subcat['.$key.']" value="'.$value['subcat_id'].'" class="subcatopt" /> '.$value['subcat_name'].'</li>';
            endforeach;
            endif;
            $catsel .= '</ul>';
            
            echo $catsel;
            
        break;  
        
        
    }            
	
?>