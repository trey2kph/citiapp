<?php 

	include("../../config.php"); 
	//**************** USER MANAGEMENT - START ****************\\

	include(LIB."/login/chklog.php");

    $logged = $logstat;
    $profile_full = $logfname;
    $profile_name = $logname;
    $profile_id = $userid;
    $profile_email = $email;
    $profile_sex = $sex;
	
	//***************** USER MANAGEMENT - END *****************\\

    $sec = $_GET['sec'];

    switch ($sec) {  
            
        
        
        case 'wishlistdata':
        ?>
        <script>    
            $(".btnview").on("click", function() {	

                id = $(this).attr('attribute');
                slug = $(this).attr('attribute2');

                window.location.href='<?php echo WEB; ?>/shop/' + id + '/' + slug;

            });
            
            $(".btnwishtocart1").on("click", function() {	

                var uid = $("#txtprofileid").val(); 

                var r = confirm("Are you sure you want to add this to cart");
                if (r == true)
                {

                    $.ajax(
                    {
                        url: "<?php echo WEB; ?>/lib/requests/cart_request.php?sec=getwish",
                        data: "uid=" + uid,
                        type: "POST",
                        success: function(data) {

                            var w_array = data.split(',');

                            for(var i = 0; i < w_array.length; i++) {
                                w_array[i] = w_array[i].replace(/^\s*/, "").replace(/\s*$/, "");

                                $.ajax(
                                {
                                    url: "<?php echo WEB; ?>/lib/requests/cart_request.php?sec=addcart",
                                    data: "prod=" + w_array[i] + "&quantity=1",
                                    type: "POST",
                                    success: function(data) {                          
                                        $("#btnbuy" + w_array[i]).removeAttr("disabled");
                                        $.ajax(
                                        {
                                            url: "<?php echo WEB; ?>/lib/requests/cart_request.php?sec=countcart",
                                            type: "POST",
                                            success: function(data) {  
                                                $("#cartcount").html(data);
                                            }
                                        })
                                        $.ajax(
                                        {
                                            url: "<?php echo WEB; ?>/lib/requests/cart_request.php?sec=displaycart",
                                            type: "POST",
                                            success: function(data) {  
                                                $("#cartdata").html(data);
                                            }
                                        });    
                                    }
                                }); 
                            }
                            
                            $.ajax(
                            {
                                url: "<?php echo WEB; ?>/lib/requests/cart_request.php?sec=clearwish",
                                data: "uid=" + uid,
                                type: "POST",
                                success: function(data) {
                                    alert('Wishlist has been successfully added to cart'); 
                                    
                                    $.ajax(
                                    {
                                        url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=wishlistcount",
                                        type: "POST",
                                        success: function(data) {  
                                            $("#wishcount").html(data);
                                        }
                                    })
                                    $.ajax(
                                    {
                                        url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=wishlistdata",
                                        type: "POST",
                                        success: function(data) {  
                                            $("#wishdata").html(data);
                                        }
                                    });    
                                }
                            });
                        }
                    });

                }

            });
            
            $(".btnwishlist1").on("click", function() {
                <?php if ($logged) : ?>
                var product_id = $(this).attr('attribute');
                var profile_id = $("#txtprofileid").val();

                $.ajax(
                {
                    url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=chkwishlist",
                    data: "prod=" + product_id,
                    type: "POST",
                    success: function(data) {                        
                        if (data == 0) {
                            $.ajax(
                            {
                                url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=actwishlist",
                                data: "flag=0&prod=" + product_id + "&prof=" + profile_id,
                                type: "POST",
                                success: function(data) {   
                                    alert('This product has been added to your wishlist');                            
                                    $("#btnwishlist" + product_id).html('<i class="fa fa-gift"></i> Remove to Wishlist');
                                    $.ajax(
                                    {
                                        url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=wishlistcount",
                                        type: "POST",
                                        success: function(data) {  
                                            $("#wishcount").html(data);
                                        }
                                    })
                                    $.ajax(
                                    {
                                        url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=wishlistdata",
                                        type: "POST",
                                        success: function(data) {  
                                            $("#wishdata").html(data);
                                        }
                                    });    
                                }
                            }); 
                        } else {
                            $.ajax(
                            {
                                url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=actwishlist",
                                data: "flag=" + data,
                                type: "POST",
                                success: function(data) {  
                                    alert('This product has been removed to your wishlist');
                                    $("#btnwishlist" + product_id).html('<i class="fa fa-gift"></i> Add to Wishlist');
                                    $.ajax(
                                    {
                                        url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=wishlistcount",
                                        type: "POST",
                                        success: function(data) {  
                                            $("#wishcount").html(data);
                                        }
                                    })
                                    $.ajax(
                                    {
                                        url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=wishlistdata",
                                        type: "POST",
                                        success: function(data) {  
                                            $("#wishdata").html(data);
                                        }
                                    });    
                                }
                            });           
                        }
                    }
                });  
                <?php else : ?>
                $("#floatdiv").removeClass("invisible");
                $("#freg").addClass("invisible");
                $("#fforgot").addClass("invisible");
                $("#forder").addClass("invisible");
                $("#fcart").addClass("invisible");
                $("#flog").removeClass("invisible");
                $("#fwish").addClass("invisible");
                <?php endif; ?>
            });
        </script>    
        <?php
        case 'clearprod':
        case 'table':
            
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

        $nprice = $mainsql->get_minmax_price(0, $sprod, 0, 0, $sbrand, $scat, $ssubcat);
        $xprice = $mainsql->get_minmax_price(1, $sprod, 0, 0, $sbrand, $scat, $ssubcat);
        $minprice = number_format($nprice, 0, "", "");
        $maxprice = number_format($xprice, 0, "", "") + 1;
            
        ?>

        <script>

            $(".btnwishlist2").on("click", function() {
                    <?php if ($logged) : ?>
                    var product_id = $(this).attr('attribute');
                    var profile_id = $("#txtprofileid").val();

                    $.ajax(
                    {
                        url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=chkwishlist",
                        data: "prod=" + product_id,
                        type: "POST",
                        success: function(data) {                        
                            if (data == 0) {
                                $.ajax(
                                {
                                    url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=actwishlist",
                                    data: "flag=0&prod=" + product_id + "&prof=" + profile_id,
                                    type: "POST",
                                    success: function(data) {   
                                        alert('This product has been added to your wishlist');                            
                                        $("#btnwishlist" + product_id).html('<i class="fa fa-gift"></i> Remove to Wishlist');
                                        $.ajax(
                                        {
                                            url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=wishlistcount",
                                            type: "POST",
                                            success: function(data) {  
                                                $("#wishcount").html(data);
                                            }
                                        })
                                        $.ajax(
                                        {
                                            url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=wishlistdata",
                                            type: "POST",
                                            success: function(data) {  
                                                $("#wishdata").html(data);
                                            }
                                        });    
                                    }
                                }); 
                            } else {
                                $.ajax(
                                {
                                    url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=actwishlist",
                                    data: "flag=" + data,
                                    type: "POST",
                                    success: function(data) {  
                                        alert('This product has been removed to your wishlist');
                                        $("#btnwishlist" + product_id).html('<i class="fa fa-gift"></i> Add to Wishlist');
                                        $.ajax(
                                        {
                                            url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=wishlistcount",
                                            type: "POST",
                                            success: function(data) {  
                                                $("#wishcount").html(data);
                                            }
                                        })
                                        $.ajax(
                                        {
                                            url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=wishlistdata",
                                            type: "POST",
                                            success: function(data) {  
                                                $("#wishdata").html(data);
                                            }
                                        });    
                                    }
                                });           
                            }
                        }
                    });  
                    <?php else : ?>
                    $("#floatdiv").removeClass("invisible");
                    $("#freg").addClass("invisible");
                    $("#fforgot").addClass("invisible");
                    $("#forder").addClass("invisible");
                    $("#fcart").addClass("invisible");
                    $("#flog").removeClass("invisible");
                    $("#fwish").addClass("invisible");
                    <?php endif; ?>
                });



                $(".btnbuy1").on("click", function() {
                    var product_id = $(this).attr('attribute');  
                    var qty = $("#buyqty" + product_id).val();                         
                    $("#btnbuy" + product_id).attr("disabled", "disabled");

                    $.ajax(
                    {
                        url: "<?php echo WEB; ?>/lib/requests/cart_request.php?sec=addcart",
                        data: "prod=" + product_id + "&quantity=" + qty,
                        type: "POST",
                        success: function(data) {   
                            alert('This product has been added to your cart');                            
                            $("#btnbuy" + product_id).removeAttr("disabled");
                            $.ajax(
                            {
                                url: "<?php echo WEB; ?>/lib/requests/cart_request.php?sec=countcart",
                                type: "POST",
                                success: function(data) {  
                                    $("#cartcount").html(data);
                                }
                            })
                            $.ajax(
                            {
                                url: "<?php echo WEB; ?>/lib/requests/cart_request.php?sec=displaycart",
                                type: "POST",
                                success: function(data) {  
                                    $("#cartdata").html(data);
                                }
                            });    
                        }
                    }); 
                });
    
                $(".btnview").on("click", function() {	

                    id = $(this).attr('attribute');
                    slug = $(this).attr('attribute2');

                    window.location.href='<?php echo WEB; ?>/shop/' + id + '/' + slug;

                });
                
                $(".aitem").flip({
                    axis: 'y',
                    trigger: 'hover',
                    speed: 200
                });
                
                /* SLIDER */

                $("#price-range").slider({
                    range: true,
                    min: <?php echo $minprice; ?>,
                    max: <?php echo $maxprice; ?>,
                    values: [<?php echo $minprice ? $minprice : $sprice[0]; ?>, <?php echo $maxprice ? $maxprice : $sprice[1]; ?>],
                    slide: function(event, ui) {
                        $("#pamount").html("P" + ui.values[0] + " - P" + ui.values[1]);
                        $("#minprice").val(ui.values[0]);
                        $("#maxprice").val(ui.values[1]);
                    }
                });
                
                $("#pamount").html("P<?php echo $minprice ? $minprice : $sprice[0]; ?> - P<?php echo $maxprice ? $maxprice : $sprice[1]; ?>");

        </script>

        <?php
        break;
        case 'ajaxpage':
            ?>
            
            <script>
                $(".btnvieworder").on("click", function() {	
                    oid = $(this).attr('attribute');

                    $.ajax(
                    {
                        url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=orderdetail",
                        data: "id=" + oid,
                        type: "POST",
                        success: function(data) {                        
                            $("#divodetail").html(data);
                        }
                    });   

                });
            </script>
            <?php
        break;
    }

    $sec = $_GET['sec'];

    switch ($sec) {  
            
        case 'setbrand':
            
            $brand_id = $_POST['brandid'];
            $_SESSION['sbrand'] = $brand_id;
            
        break;
            
        case 'chkwishlist':
            
            $product_id = $_POST['prod'];
            $chkwish = $mainsql->get_wish(0, 0, 0, $profile_id, 0, $product_id);
            
            if ($chkwish) :
                echo $chkwish[0]['wish_id'];
            else :
                echo 0;
            endif;
            
        break;
            
        case 'actwishlist':
            
            $flag = $_POST['flag'];
            $post['wish_product'] = $_POST['prod'];
            $post['wish_user'] = $_POST['prof'];
            
            if ($flag) :
                $actwish = $mainsql->wish_action(NULL, 'delete', $flag);
            else :
                $actwish = $mainsql->wish_action($post, 'add');
            endif;
            
        break;
            
        case 'wishlistcount':
            
            $cntwish = $mainsql->get_wish(0, 0, 0, $profile_id, 1);
            
            echo $cntwish ? ' <span class="yellowbubble">'.$cntwish.'</span>' : '';
            
        break;
            
        case 'wishlistdata':
            
            
            $wishlist_data = $mainsql->get_wish(0, 0, 5, $profile_id, 0, 0, 1);
            $wishlist_count = $mainsql->get_wish(0, 0, 0, $profile_id, 1);
            $wishlist_page = $mainsql->ajax_pagination("wish", $wishlist_count, 5, 9);
            
            if ($wishlist_data) : ?>
                <div class="fdata">
                    <div class="fdataleft centertalign">Items</div>
                    <div class="fdataright bold centertalign">Price</div>
                </div>
                <?php foreach ($wishlist_data as $key => $value) :
                    $product_data = $mainsql->get_products($value['wish_product']); ?>
                    <div class="fdata">
                        <div attribute="<?php echo $product_data[0]['product_id']; ?>" attribute2="<?php echo urlencode(strtolower($product_data[0]['product_name'])); ?>" class="btnview cursorpoint fdataleft"><?php echo $product_data[0]['product_name']; ?></div>
                        <div class="fdataright">P <?php echo $product_data[0]['product_price']; ?>&nbsp;&nbsp;&nbsp;<span attribute="<?php echo $product_data[0]['product_id']; ?>" class="btnwishlist1 fa fa-times cursorpoint redtext"></span></div>
                    </div>
                <?php endforeach; ?>
                <div class="fdata">
                    <?php echo $wishlist_page; ?>
                </div>
                <div class="fdata margintop30">
                    <button class="btnwishtocart1 redbtn"><i class="fa fa-shopping-bag"></i> Add this to Cart</button>
                </div>
            <?php else : ?>
                <div class="fdata" class="centertalign margintop50"><i>No wishlist has been made</i></div>
            <?php endif; 
            
        break;
            
        case 'clearprod':
            
            unset($_SESSION['sprod']);
            
            
            $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1 ;
            $start = PROD_NUM_ROWS * ($page - 1);
            
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

            $product = $mainsql->get_products(0, $start, GRID_NUM_ROWS, $sprod, 0, 0, 0, $sbrand, $scat, $ssubcat);
            $product_count = $mainsql->get_products(0, 0, 0, $sprod, 1, 0, 0, $sbrand, $scat, $ssubcat);
            
            $nprice = $mainsql->get_minmax_price(0, $sprod, 0, 0, $sbrand, $scat, $ssubcat);
            $xprice = $mainsql->get_minmax_price(1, $sprod, 0, 0, $sbrand, $scat, $ssubcat);
            $minprice = number_format($nprice, 0, "", "");
            $maxprice = number_format($xprice, 0, "", "") + 1;

            $pages = $mainsql->pagination("shop", $product_count, GRID_NUM_ROWS, 9);
            
            if ($sprod) : ?>
            <div class="marginbottom25">Search result for <button id="btndelsprod" class="smlbtn"><?php echo $sprod; ?> <i class="fa fa-times"></i></button></div>
            <?php endif; ?>
            <?php
            
            if ($product) : 
            foreach ($product as $key => $value) : 
            $product_price = $mainsql->get_price(0, 0, 0, 0, $value['product_id']); 
            $product_brand = $mainsql->get_brands($value['product_brand']); ?>
            <div id="aitem<?php echo $value['product_id']; ?>" class="aitem">
                <div class="front">
                    <img src="<?php echo WEB; ?>/uploads/brand/<?php echo $product_brand[0]['brand_logo']; ?>" class="marginlr20 marginbottom15" />
                    <img id="appimg" src="<?php echo WEB; ?>/uploads/prodsimg/<?php echo $value['product_smallimg']; ?>" class="marginlr20 marginbottom15" />
                    <div id="ainfo" class="ainfo">
                        <div class="bold cattext2 margintop10"><?php echo $value['product_model']; ?></div>
                        <div class="margintop10"><?php echo $value['product_name']; ?></div>
                        <div class="bold mediumtext margintop10"><?php echo $product_price[0]['price_price'] ? 'P'.number_format($product_price[0]['price_price'], 2, '.', ',') : 'P0.00'; ?></div>
                    </div>
                </div>
                <div class="back">
                    <b>Quantity</b>
                    <select id="buyqty<?php echo $value['product_id']; ?>" name="buyqty[<?php echo $value['product_id']; ?>]">
                        <?php for($i=1; $i<=30; $i++) : ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>
                    <button attribute="<?php echo $value['product_id']; ?>" class="btnbuy1 redbtn margintop25"><i class="fa fa-shopping-cart"></i> Buy this Item</button>
                    <?php if ($chk_wishlist && $logged) : ?>
                    <button id="btnwishlist<?php echo $value['product_id']; ?>" attribute="<?php echo $value['product_id']; ?>" class="btnwishlist2 redbtn margintop25"><i class="fa fa-gift"></i> Remove to Wishlist</button>
                    <?php else : ?>
                    <button attribute="<?php echo $value['product_id']; ?>" class="btnwishlist2 redbtn margintop25"><i class="fa fa-gift"></i> Add to Wishlist</button>
                    <?php endif; ?>
                    <button attribute="<?php echo $value['product_id']; ?>" attribute2="<?php echo urlencode(strtolower($value['product_name'])); ?>" class="btnview redbtn margintop25"><i class="fa fa-eye"></i> View this Item</button>
                </div>
            </div>
            <?php endforeach; ?>
            <?php if ($pages) : ?>
            <div class="centertalign margintop25"><?php echo $pages; ?></div>
            <?php endif; ?>
            <?php else : ?>
            <div class="centertalign margintopbot100 cattext">No product listed</div>
            <?php endif; 
            
        break;
            
        case 'table':
            
            $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1 ;
            $start = PROD_NUM_ROWS * ($page - 1);
            
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
            
            $nprice = $mainsql->get_minmax_price(0, $sprod, 0, 0, $sbrand, $scat, $ssubcat);
            $xprice = $mainsql->get_minmax_price(1, $sprod, 0, 0, $sbrand, $scat, $ssubcat);
            $minprice = number_format($nprice, 0, "", "");
            $maxprice = number_format($xprice, 0, "", "") + 1;

            $pages = $mainsql->pagination("shop", $product_count, GRID_NUM_ROWS, 9);
            
            
            if ($sprod) : ?>
            <div class="marginbottom25">Search result for <button id="btndelsprod" class="smlbtn"><?php echo $sprod; ?> <i class="fa fa-times"></i></button></div>
            <?php endif; ?>
            <?php
            
            if ($product) : 
            foreach ($product as $key => $value) : 
            $product_price = $mainsql->get_price(0, 0, 0, 0, $value['product_id']); 
            $product_brand = $mainsql->get_brands($value['product_brand']); ?>
            <div id="aitem<?php echo $value['product_id']; ?>" class="aitem">
                <div class="front">
                    <img src="<?php echo WEB; ?>/uploads/brand/<?php echo $product_brand[0]['brand_logo']; ?>" class="marginlr20 marginbottom15" />
                    <img id="appimg" src="<?php echo WEB; ?>/uploads/prodsimg/<?php echo $value['product_smallimg']; ?>" class="marginlr20 marginbottom15" />
                    <div id="ainfo" class="ainfo">
                        <div class="bold cattext2 margintop10"><?php echo $value['product_model']; ?></div>
                        <div class="margintop10"><?php echo $value['product_name']; ?></div>
                        <div class="bold mediumtext margintop10"><?php echo $product_price[0]['price_price'] ? 'P'.number_format($product_price[0]['price_price'], 2, '.', ',') : 'P0.00'; ?></div>
                    </div>
                </div>
                <div class="back">
                    <b>Quantity</b>
                    <select id="buyqty<?php echo $value['product_id']; ?>" name="buyqty[<?php echo $value['product_id']; ?>]">
                        <?php for($i=1; $i<=30; $i++) : ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>
                    <button attribute="<?php echo $value['product_id']; ?>" class="btnbuy1 redbtn margintop25"><i class="fa fa-shopping-cart"></i> Buy this Item</button>
                    <?php if ($chk_wishlist && $logged) : ?>
                    <button id="btnwishlist<?php echo $value['product_id']; ?>" attribute="<?php echo $value['product_id']; ?>" class="btnwishlist2 redbtn margintop25"><i class="fa fa-gift"></i> Remove to Wishlist</button>
                    <?php else : ?>
                    <button attribute="<?php echo $value['product_id']; ?>" class="btnwishlist2 redbtn margintop25"><i class="fa fa-gift"></i> Add to Wishlist</button>
                    <?php endif; ?>
                    <button attribute="<?php echo $value['product_id']; ?>" attribute2="<?php echo urlencode(strtolower($value['product_name'])); ?>" class="btnview redbtn margintop25"><i class="fa fa-eye"></i> View this Item</button>
                </div>
            </div>
            <?php endforeach; ?>
            <?php if ($pages) : ?>
            <div class="centertalign margintop25"><?php echo $pages; ?></div>
            <?php endif; ?>
            <?php else : ?>
            <div class="centertalign margintopbot100 cattext">No product listed</div>
            <?php endif; 
        break;
            
        case 'orderdetail':
            
            $orderid = $_POST['id'];
            
            if ($orderid) :
            
                $order_data = $mainsql->get_trans($orderid);
                $cart_data = unserialize($order_data[0]['trans_order']);
                
                ?>
                <div class="fdata marginbottom30"><b>Order ID:</b> <?php echo $order_data[0]['trans_id']; ?></div>
                <?php
                    $item_total = 0;

                    foreach ($cart_data as $value) : ?>
                        <div class="fdata">
                            <div attribute="<?php echo $value['id']; ?>" attribute2="<?php echo urlencode(strtolower($value['name'])); ?>" class="btnview cursorpoint fdataleft"><b><?php echo $value['quantity']; ?> x <?php echo $value['name']; ?></b><?php echo $value['quantity'] > 1 ? '<br><i>P '.number_format($value['price']).' per unit</i>' : ''; ?></div>
                            <div class="fdataright valigntop">P <?php echo number_format($value['price'] * $value['quantity'], 2); ?></div>
                        </div>
                        <?php $item_total = $item_total + ($value['price'] * $value['quantity']); ?>
                    <?php endforeach; ?>

                    <div class="fdata topborder1">
                        <div class="fdataleft bold">Total</div>
                        <div class="fdataright bold">P <?php echo number_format($item_total, 2); ?></div>
                    </div>
                <div class="fdata lefttalign margintop30"><b>Will pickup/receive by:</b> <?php echo $order_data[0]['trans_fname']; ?></div>
                <div class="fdata lefttalign"><b>Mobile No.:</b> <?php echo $order_data[0]['trans_mobile']; ?></div>
                <div class="fdata lefttalign"><b>Address:</b> <?php echo $order_data[0]['trans_address']; ?></div>
                <div class="fdata lefttalign"><b>Instruction/Remark:</b> <?php echo $order_data[0]['trans_uremark']; ?></div>
                <div class="fdata lefttalign"><b>Date/Time:</b> <?php echo date('F j, Y | g:ia', $order_data[0]['trans_date']); ?></div>
                <div class="fdata lefttalign"><b>Payment Type:</b> <?php echo $payment_type[$order_data[0]['trans_paytype']]; ?></div>
                <?php 
                if ($order_data[0]['trans_paytype'] == 1) :
                    $order_array = $order_status2;  
                else :
                    $order_array = $order_status;
                endif;
                ?>
                <div class="fdata valigntop centertalign"><div class='statbarbig <?php echo $order_array[$order_data[0]['trans_status']][1]; ?>'><?php echo $order_array[$order_data[0]['trans_status']][0]; ?></div></div>
                <?php 
            
            endif;
            
        break;
            
        case 'ajaxpage':
            
            $target = $_POST['target'];
            $apage = $_POST['page'];
            
            if ($target == 'order') :
            
                $page = isset($apage) ? (int)$apage : 1 ;
                $start = NUM_ROWS * ($page - 1);
            
                $order_data = $mainsql->get_trans(0, $start, NUM_ROWS, NULL, 0, $profile_id, 0);
            
                if ($order_data) : ?>
                    <div class="fdata">
                        <div class="fdata20 centertalign valigntop bold">Order ID</div>
                        <div class="fdata20 centertalign valigntop bold">Price</div>
                        <div class="fdata20 centertalign valigntop bold">Date</div>
                        <div class="fdata20 centertalign valigntop bold">Status</div>
                        <div class="fdata16 centertalign valigntop bold">View</div>
                    </div>

                    <?php foreach ($order_data as $key => $value) : ?>
                        <div class="fdata">
                            <div class="fdata20 valigntop lefttalign"><?php echo $value['trans_id']; ?></div>
                            <div class="fdata20 valigntop lefttalign">P <?php echo number_format($value['trans_price'], 2); ?></div>
                            <div class="fdata20 valigntop lefttalign"><?php echo date('F j, Y', $value['trans_date']); ?></div>
                            <?php 
                            if ($value['trans_paytype'] == 1) :
                                $order_array = $order_status2;  
                            else :
                                $order_array = $order_status;
                            endif;
                            ?>
                            <div class="fdata20 valigntop centertalign"><div class='statbar <?php echo $order_array[$value['trans_status']][1]; ?>'><?php echo $order_array[$value['trans_status']][0]; ?></div></div>
                            <div class="fdata16 valigntop centertalign"><i attribute="<?php echo $value['trans_id']; ?>" class="btnvieworder fa fa-eye cursorpoint"></i></div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; 
            
            endif;
            
        break;
        
        
    }            
	
?>