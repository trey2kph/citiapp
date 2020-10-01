<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="ISO-8859-1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $page_title; ?>&nbsp;|&nbsp;<?php echo SITENAME; ?></title>
        <meta name="description" content="Philippine No. 1 Appliance Plaza">
        <meta name="keywords" content="imperial, appliance, plaza, philippines, sony, samsung, lg, hanabishi, asahi, 3d, kyowa, toshiba, haier, hisense, tcl">
        <meta name="google-signin-client_id" content="390218948979-5tgrqotnqu8finqums9cl7uh5nd14le8.apps.googleusercontent.com">
        
        <!-- FAVICON -->
        
        <link rel="shortcut icon" href="<?php echo WEB; ?>/favicon.ico" type="image/x-icon">
		<link rel="icon" href="<?php echo WEB; ?>/favicon.ico" type="image/x-icon">
        
        <!-- VIEWPORT -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        
        <!-- CSS STYLES -->
        <link rel="stylesheet" href="<?php echo CSS; ?>/style.php"> 
        <link rel="stylesheet" href="<?php echo CSS; ?>/lightbox.css">        
        <link rel="stylesheet" href="<?php echo CSS; ?>/jquery-ui.css">
        <link rel="stylesheet" href="<?php echo CSS; ?>/fullcalendar.css">
        <link rel="stylesheet" href="<?php echo CSS; ?>/colorpicker.css">
        <link rel="stylesheet" href="<?php echo CSS; ?>/timepicker.css">
		<link rel="stylesheet" href="<?php echo CSS; ?>/fontawesome-all.min.css">  
		<link rel="stylesheet" href="<?php echo CSS; ?>/rating.css">  
        <link rel="stylesheet" type="text/css" href="<?php echo CSS; ?>/DateTimePicker.min.css" />
        <link rel="stylesheet" href="<?php echo JS; ?>/nivoslider/nivo-slider.css" media="screen">
        
        <!-- GOOGLE LOGIN -->
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        
        <!-- JQUERY -->        
        <script src="<?php echo JS; ?>/jquery-1.7.2.min.js"></script>  
        
    </head>
    <body>   
        
        <!-- FACEBOOK -->
        
        
        <!--
          Below we include the Login Button social plugin. This button uses
          the JavaScript SDK to present a graphical Login button that triggers
          the FB.login() function when clicked.
        -->
        
        
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        
        <div id="floatdiv" class="floatdiv invisible">
            
            <!-- DATA PRIVACY - BEGIN --> 
            <div id="fppolicy" class="freg invisible">
                
                <div class="centertalign">    
                    <table class=" centertalign vsmalltext" width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td id="errortd"></td>
                        </tr>
                        <tr>
                            <td>This site uses cookies to provide our guests with a smooth experience. By continuing to browse <?php echo WEB; ?>, you are agreeing to our cookie policy.</td>
                        </tr>
                        <tr>                            
                            <td><a href="<?php echo WEB; ?>/privacy"><button name="btnppmoreinfo" id="btnppmoreinfo" value="1" class="redbtn margintop30">MORE INFO</button></a>&nbsp;&nbsp;&nbsp;<button name="btnppagree" id="btnppagree" value="1" class="redbtn margintop30">AGREE</button></td>
                        </tr>
                    </table>
                </div>
                
            </div>
            <!-- DATA PRIVACY - END -->  
                
            <!-- REGISTER - BEGIN --> 
            <div id="freg" class="freg invisible">
                <div class="closebutton cursorpoint"><i class="fa fa-times-circle fa-3x redtext"></i></div>
                <div id="reg_title" class="robotobold cattext redtext marginbottom20"><span id="ltitle"></span> Sign Up</div>
                
                <div class="centertalign">
                    <form name="reg_user" id="reg_user" action="?ignore-page-cache=true" method="POST" enctype="multipart/form-data">     
                    <table class=" centertalign vsmalltext" width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td><input type="text" id="user_lastname" name="user_lastname" autocomplete="off" placeholder="Last Name" class="txtbox width70per" /></td>
                        </tr>
                        <tr>
                            <td><input type="text" id="user_firstname" name="user_firstname" autocomplete="off" placeholder="First Name" class="txtbox width70per" /></td>
                        </tr>
                        <tr>
                            <td><input type="text" id="user_email" name="user_email" autocomplete="off" placeholder="Email Address" class="txtbox width70per" /></td>
                        </tr>
                        <tr>
                            <td><input type="password" id="user_password" name="user_password" autocomplete="off" placeholder="Password" class="txtbox width70per" /></td>
                        </tr>
                        <tr>
                            <td><input type="password" id="user_password2" name="user_password2" autocomplete="off" placeholder="Confirm Password" class="txtbox width70per" /></td>
                        </tr>
                        <tr>                            
                            <td><input type="submit" name="btnregister" id="btnregister" value="REGISTER" class="redbtn" /></td>
                        </tr>
                    </table>
                    </form>
                </div>
                
            </div>
            <!-- REGISTER - END -->  
                
            <!-- FORGOT - BEGIN --> 
            <div id="fforgot" class="freg invisible">
                <div class="closebutton cursorpoint"><i class="fa fa-times-circle fa-3x redtext"></i></div>
                <div id="forgot_title" class="robotobold cattext redtext"><span id="ltitle"></span> Forgot Password</div>
                
                <div class="centertalign">
                    <form name="forgot_password" id="forgot_password" action="?ignore-page-cache=true" method="POST" enctype="multipart/form-data">     
                    <table class=" centertalign vsmalltext" width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td id="errortd"></td>
                        </tr>
                        <tr>
                            <td><input type="text" id="user_email" name="user_email" autocomplete="off" placeholder="Email Address" class="txtbox width70per" /></td>
                        </tr>
                        <tr>                            
                            <td><input type="submit" name="btnforgot" id="btnforgot" value="RETRIEVE PASSWORD" class="redbtn" /></td>
                        </tr>
                    </table>
                    </form>
                </div>
                
            </div>
            <!-- FORGOT - END -->  
            
            <!-- ORDER - BEGIN --> 
            <div id="forder" class="forder invisible">
                <div class="closebutton cursorpoint"><i class="fa fa-times-circle fa-3x redtext"></i></div>
                <div id="log_title" class="robotobold cattext redtext"><span id="ltitle"></span> My Last Order</div>
                
                <div id="orderdata" class="minheight100">
                    <?php if ($order_data) : ?>
                        <?php foreach ($order_data as $key => $value) : ?>
                            <div class="fdata">
                                <div class="fdataleft"><b>Order ID: <?php echo $value['trans_id'].' - P '.number_format($value['trans_price'], 2).'</b> ('.date('m/d/Y', $value['trans_date']).')'; ?></b></div>
                                <?php 
                                if ($value['trans_paytype'] == 1) :
                                    $order_array = $order_status2;  
                                else :
                                    $order_array = $order_status;
                                endif;
                                ?>
                                <div class="fdataright">
                                    <div class='statbar <?php echo $order_array[$value['trans_status']][1]; ?>'><?php echo $order_array[$value['trans_status']][0]; ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="fdata margintop30">
                            <button id="btnorderlink" class="redbtn"><i class="fa fa-shopping-bag"></i> View Orders</button>
                        </div>
                    <?php else : ?>
                        <div class="fdata" class="centertalign margintop50"><i>No order has been made</i></div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- ORDER - END --> 
                
            <!-- LOGIN - BEGIN --> 
            <div id="flog" class="flog invisible">
                <div class="closebutton cursorpoint"><i class="fa fa-times-circle fa-3x redtext"></i></div>
                <div id="log_title" class="robotobold cattext redtext"><span id="ltitle"></span> Sign In</div>
                
                <div id="frmlogin" class="centertalign">
                    <table class=" centertalign vsmalltext" width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td id="errortd"></td>
                        </tr>
                        <tr>
                            <td><input type="text" id="username" name="username" autocomplete="off" placeholder="E-mail Address" class="txtbox width70per" /></td>
                        </tr>
                        <tr>
                            <td><input type="password" id="password" name="password" autocomplete="off" placeholder="Password" class="txtbox width70per" /></td>
                        </tr>
                        <tr>                            
                            <td><input type="submit" name="btnlogin" id="btnlogin" value="LOGIN" class="redbtn" /></td>
                        </tr>
                        <tr>                            
                            <td><span id="linkreg" class="cursorpoint">Sign-up</span> | <span id="linkforgot" class="cursorpoint">Cannot Access?</span></td>
                        </tr>
                        <tr>
                            <td class="centertalign"><div class="g-signin2" data-onsuccess="onSignIn"></div></td>
                        </tr>
                    </table>
                </div>
                
            </div>
            <!-- LOGIN - END -->  
            
            <!-- WISHLIST - BEGIN --> 
            <div id="fwish" class="fwish invisible">
                <div class="closebutton cursorpoint"><i class="fa fa-times-circle fa-3x redtext"></i></div>
                <div id="log_title" class="robotobold cattext redtext"><span id="ltitle"></span> My Wishlist</div>
                
                <div id="wishdata" class="minheight100">
                    <?php if ($wishlist_data) : ?>
                    
                        <div class="fdata bottomborder1">
                            <div class="fdataleft centertalign">Items</div>
                            <div class="fdataright bold centertalign">Price</div>
                        </div>
                    
                        <?php foreach ($wishlist_data as $key => $value) : ?>
                            <?php $product_data = $mainsql->get_products($value['wish_product']); ?>
                            <div class="fdata">
                                <div attribute="<?php echo $product_data[0]['product_id']; ?>" attribute2="<?php echo urlencode(strtolower($product_data[0]['product_name'])); ?>" class="btnview cursorpoint fdataleft"><?php echo $product_data[0]['product_name']; ?></div>
                                <div class="fdataright">P <?php echo $product_data[0]['product_price']; ?>&nbsp;&nbsp;&nbsp;<span attribute="<?php echo $product_data[0]['product_id']; ?>" class="btnwishlist fa fa-times cursorpoint redtext"></span></div>
                            </div>
                        <?php endforeach; ?>
                        <div class="fdata">
                            <?php echo $wishlist_page; ?>
                        </div>
                        <div class="fdata margintop30">
                            <button class="btnwishtocart redbtn"><i class="fa fa-shopping-bag"></i> Add this to Cart</button>
                        </div>
                    <?php else : ?>
                        <div class="fdata" class="centertalign margintop50"><i>No wishlist has been made</i></div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- WISHLIST - END --> 
            
            <!-- CART - BEGIN --> 
            <div id="fcart" class="fcart invisible">
                <div class="closebutton cursorpoint"><i class="fa fa-times-circle fa-3x redtext"></i></div>
                <div id="log_title" class="robotobold cattext redtext"><span id="ltitle"></span> Cart</div>
                
                <div id="cartdata" class="minheight100">
                    <?php if ($_SESSION["cart_item"]) : ?>
                    
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
                    <?php endif;  ?>
                </div>
            </div>
            <!-- CART - END --> 
        </div>
            
        <div id="floatdiv2" class="floatdiv2">
            <div id="floatmenu" class="floatmenu">
                <?php if ($logged == 1) : ?>
                <div id="mlinkuser" class="profilediv whitetext mediumtext">
                    <i class="fa fa-user-circle fa-3x"></i>&nbsp;&nbsp;<div class="inlineblock2 width70per">Hello <?php echo $profile_full; ?><br /><span id="mlinksignout" class="vsmalltext">Logout</span></div>
                </div>
                <?php endif; ?>
                <div class="mainmenu mediumtext2"> 
                    <div><a href="<?php echo WEB; ?>" class="<?php echo !$section ? 'lorangetext' : 'whitetext'; ?>"><i class="fa fa-home"></i>&nbsp;&nbsp;HOME</a></div>
                    <div><a href="<?php echo WEB; ?>/shop" class="<?php echo $section == 'shop' ? 'lorangetext' : 'whitetext'; ?>"><i class="fa fa-shopping-bag"></i>&nbsp;&nbsp;SHOP</a></div>
                    <div><a href="<?php echo WEB; ?>/whatsnew" class="<?php echo $section == 'whatsnew' ? 'lorangetext' : 'whitetext'; ?>"><i class="fa fa-star"></i>&nbsp;&nbsp;WHAT'S NEW</a></div>
                    <div><a href="<?php echo WEB; ?>/locator" class="<?php echo $section == 'locator' ? 'lorangetext' : 'whitetext'; ?>"><i class="fa fa-map-marker"></i>&nbsp;&nbsp;STORE LOCATOR</a></div>
                    <div><a href="<?php echo WEB; ?>/about" class="<?php echo $section == 'about' ? 'lorangetext' : 'whitetext'; ?>"><i class="fa fa-cube"></i>&nbsp;&nbsp;ABOUT US</a></div>
                    <div><a href="<?php echo WEB; ?>/career" class="<?php echo $section == 'career' ? 'lorangetext' : 'whitetext'; ?>"><i class="fa fa-id-card"></i>&nbsp;&nbsp;CAREER</a></div>
                </div>
                
            </div>
        </div>
        
		<div id="main" class="main">
          <input id="txtprofileid" type="hidden" name="txtprofileid" value="<?php echo $logged ? $profile_id : 0; ?>" />    
          <div id="upper" class="upper">
              <div class="wrapper lgraybg">
                  <div id="headercon" class="headercon bluebg">
                      <div id="headertop" class="headertop lbluebg">
                          <ul>
                              <li id="linkorder"><i class="fa fa-compass"></i> Order Tracker<?php echo $order_counth ? ' <span class="yellowbubble">'.$order_counth.'</span>' : ''; ?></li>
                              <li id="linkwish"><i class="fa fa-gift"></i> Wishlist<span id="wishcount"><?php echo $wishlist_count ? ' <span class="yellowbubble">'.$wishlist_count.'</span>' : ''; ?></span></li>
                              <li id="linkcart"><i class="fa fa-shopping-cart"></i> Cart<span id="cartcount"><?php echo $cart_count ? ' <span class="yellowbubble">'.$cart_count.'</span>' : ''; ?></span></li>
                              <?php if ($logged) : ?>
                              <li id="linkuser"><i class="fa fa-user"></i> <?php echo $profile_name; ?></li>
                              <li id="linksignout"><i class="fa fa-sign-out"></i> Logout</li>
                              <?php else : ?>
                              <li id="linksign"><i class="fa fa-sign-in-alt"></i> Sign In</li>
                              <?php endif; ?>
                          </ul>
                      </div>
                      <div id="mheadertop" class="mheadertop lbluebg">
                          <span id="showmenu" class="mmenu"><i class="fa fa-bars whitetext"></i></span>
                          <ul>
                              <li id="mlinkorder"><i class="fa fa-compass"></i> <?php echo $order_counth ? ' <span class="yellowbubble">'.$order_counth.'</span>' : ''; ?></li>
                              <li id="mlinkwish"><i class="fa fa-gift"></i> <span id="wishcount"><?php echo $wishlist_count ? ' <span class="yellowbubble">'.$wishlist_count.'</span>' : ''; ?></span></li>
                              <li id="mlinkcart"><i class="fa fa-shopping-cart"></i> <span id="cartcount"><?php echo $cart_count ? ' <span class="yellowbubble">'.$cart_count.'</span>' : ''; ?></span></li>
                              <?php if (!$logged) : ?>
                              <li id="mlinksign"><i class="fa fa-sign-in-alt"></i></li>
                              <?php endif; ?>
                          </ul>
                      </div>
                      <div class="header">
                        <a href="<?php echo WEB; ?>"><img src="<?php echo WEB; ?>/images/iaplogo.png" class="marginlr20" /></a>
                        <div id="divsearch">
                            <?php if ($section == 'whatsnew') : ?>
                            <input id="txtpsearch" type="text" name="txtpsearch" value="<?php echo $sprom; ?>" placeholder="Search for promo..." class="txtsearch" />
                            <div id="btnpsearch" class="btnsearch cursorpoint"><i class="fa fa-search fa-2x whitetext"></i></div>
                            <?php else : ?>
                            <input id="txtsearch" type="text" name="txtsearch" value="<?php echo $sprod; ?>" placeholder="Search the store..." class="txtsearch" />
                            <div id="btnsearch" class="btnsearch cursorpoint"><i class="fa fa-search fa-2x whitetext"></i></div>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div id="headerbot" class="headerbot dbluebg">
                          <ul>
                              <li><a href="<?php echo WEB; ?>">HOME</a></li>
                              <li><a href="<?php echo WEB; ?>/shop">SHOP</a></li>
                              <li><a href="<?php echo WEB; ?>/whatsnew">WHAT'S NEW</a></li>
                              <li><a href="<?php echo WEB; ?>/locator">STORE LOCATOR</a></li>
                              <li><a href="<?php echo WEB; ?>/about">ABOUT US</a></li>
                              <li><a href="<?php echo WEB; ?>/career">CAREERS</a></li>
                          </ul>
                      </div>
                  </div>
                  