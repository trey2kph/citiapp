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
            
        case 'getwish':
            
            $user_id = $_POST['uid'];
            $wishdata = $mainsql->get_wish(0, 0, 0, $user_id, 0, 0, 0);
            
            $wisharray = '';
            
            foreach ($wishdata as $key => $value) :
                if ($key > 0) :
                    $wisharray .= ',';
                endif;
                $wisharray .= $value['wish_product'];
            endforeach;
            
            echo $wisharray;
        break;
            
        case 'clearwish':
            
            $user_id = $_POST['uid'];
            $wishdelbyuser = $mainsql->wish_action(NULL, 'delete_byuser', $user_id);
            
            echo $wishdelbyuser;
        break;
            
        case 'addcart':
            
            $product_id = $_POST['prod'];
            
            $quantity = $_POST["quantity"] ? $_POST["quantity"] : 1;
            
            if (!empty($quantity)) :
                $product_data = $mainsql->get_products($product_id);
                $itemArray = array($product_data[0]["product_id"] => array('name' => $product_data[0]["product_name"], 'id' => $product_data[0]["product_id"], 'quantity' => $quantity, 'price' => $product_data[0]["product_price"]));
            
                //unset($_SESSION["cart_item"]);
                var_dump($_SESSION["cart_item"]);

                if (!empty($_SESSION["cart_item"])) :
                    foreach($_SESSION["cart_item"] as $k => $v) :
                        if($product_data[0]["product_id"] == $k) :
                            $_SESSION["cart_item"][$k]["quantity"] = $_SESSION["cart_item"][$k]["quantity"] + $quantity;
                        else :
                            $_SESSION["cart_item"] = $_SESSION["cart_item"] + $itemArray;
                        endif;
                    endforeach;
                else :
                    $_SESSION["cart_item"] = $itemArray;
                endif;
            endif;
            
        break;
            
        case 'removecart':
            
            $product_id = $_POST['prod'];
            
            if (!empty($_SESSION["cart_item"])) :
                foreach($_SESSION["cart_item"] as $k => $v) :
                    if ($product_id == $k) :
                        unset($_SESSION["cart_item"][$k]);
                    endif;
                    if (empty($_SESSION["cart_item"])) :
                        unset($_SESSION["cart_item"]);
                    endif;
                endforeach;
            endif;
            
        break;
            
        case 'clearcart':
            
            unset($_SESSION["cart_item"]);
            
        break;
            
        case 'countcart':
            
            $cntcart = count($_SESSION["cart_item"]);
            echo $cntcart ? ' <span class="yellowbubble">'.$cntcart.'</span>' : '';
            
        break;  
        case 'displaycart':
            
            ?>

            <script>
                
                $(".btncheckout").on("click", function() {		

                    window.location.href='<?php echo WEB; ?>/checkout';

                });
                                               
                $('#linksign, #mlinksign').on("click", function() {
                    $("#floatdiv").removeClass("invisible");
                    $("#freg").addClass("invisible");
                    $("#fforgot").addClass("invisible");
                    $("#forder").addClass("invisible");
                    $("#flog").removeClass("invisible");
                    $("#fcart").addClass("invisible");
                    $("#fwish").addClass("invisible");
                });
        
                $(".btnclearcart").on("click", function() {

                    var r = confirm("Are you sure you want to clear the cart");
                    if (r == true)
                    {
                        $.ajax(
                        {
                            url: "<?php echo WEB; ?>/lib/requests/cart_request.php?sec=clearcart",
                            type: "POST",
                            success: function(data) {         
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
                        })

                        return false;
                    }


                });
            </script>

            <?php
            
            if ($_SESSION["cart_item"]) : ?>
                    
                <div class="fdata bottomborder1">
                    <div class="fdataleft bold centertalign">Items</div>
                    <div class="fdataright bold centertalign">Price</div>
                </div>

                <?php
            
                $item_total = 0;
            
                foreach ($_SESSION["cart_item"] as $value) : ?>
                    <div class="fdata">
                        <div attribute="<?php echo $value['id']; ?>" attribute2="<?php echo urlencode(strtolower($value['name'])); ?>" class="btnview cursorpoint fdataleft"><b><?php echo $value['quantity']; ?> x <?php echo $value['name']; ?></b><?php echo $value['quantity'] > 1 ? '<br><i>P '.number_format($value['price']).' per unit</i>' : ''; ?></div>
                        <div class="fdataright valigntop">P <?php echo number_format($value['price'] * $value['quantity'], 2); ?>&nbsp;&nbsp;&nbsp;<span attribute="<?php echo $value['id']; ?>" class="btndelbuy fa fa-times cursorpoint redtext"></span></div>
                    </div>
                    <?php $item_total = $item_total + ($value['price'] * $value['quantity']); ?>
                <?php endforeach; ?>

                <div class="fdata topborder1">
                    <div class="fdataleft bold">Total</div>
                    <div class="fdataright bold">P <?php echo number_format($item_total, 2); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                </div>
                        
                <div class="fdata margintop30">
                    <?php if ($logged) : ?>
                    <button class="btncheckout redbtn"><i class="fa fa-shopping-bag"></i> Checkout</button>
                    <?php else : ?>
                    <button id="linksign" class="btnsignin redbtn"><i class="fa fa-sign-in"></i> Sign-in</button>
                    <?php endif; ?>
                    <button class="btnclearcart redbtn"><i class="fa fa-times-circle"></i> Clear Cart</button>
                </div>
            <?php else : ?>
                <div class="fdata" class="centertalign margintop50"><i>Your cart is empty</i></div>
            <?php endif; 
            
            
        break;
        
        
    }            
	
?>