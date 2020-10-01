	<?php include(TEMP."/header.php"); ?>

    <!-- BODY -->
                    
                    <div class="bodycontainer">
                        <div class="mainsplash">
                            <img src="<?php echo WEB; ?>/images/splash2.jpg" />
                        </div>
                        <div class="maincontainer">
                        
                            <div class="titlecontainer marginbottom25 hugetext bold"><?php echo $page_title; ?></div>
                            
                            <?php if ($id) : ?>
                            
                                <div class="cmaincontainer">

                                    <div id="aproduct" class="aproduct">
                                        <img src="<?php echo WEB; ?>/uploads/brand/<?php echo $product_brand[0]['brand_logo']; ?>" class="marginlr20 marginbottom25 block" />
                                        <img id="imgbig" src="<?php echo WEB; ?>/uploads/prodsimg/<?php echo $product[0]['product_smallimg']; ?>" class="marginlr20 marginbottom15" />
                                        <div id="ainfo" class="ainfo">
                                            <div class="bold titletext margintop10"><?php echo $product[0]['product_name']; ?></div>
                                            <div class="bold cattext2 margintop25"><?php echo $product[0]['product_model']; ?></div>
                                            <div class="margintop10"><?php echo $product[0]['product_blurb']; ?></div>
                                            <div class="bold mediumtext margintop10"><?php echo $product_price[0]['price_price'] ? 'P'.number_format($product_price[0]['price_price'], 2, '.', ',') : 'P0.00'; ?></div><br><br>
                                            <b>Quantity</b>
                                            <select id="buyqty<?php echo $product[0]['product_id']; ?>" name="buyqty[<?php echo $product[0]['product_id']; ?>]" class="clearboth">
                                                <?php for($i=1; $i<=30; $i++) : ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php endfor; ?>
                                            </select><br>
                                            <button id="btnbuy<?php echo $product[0]['product_id']; ?>" attribute="<?php echo $product[0]['product_id']; ?>" class="btnbuy redbtn margintop45"><i class="fa fa-shopping-cart"></i> Add to Cart</button>&nbsp;
                                            <?php $chk_wishlist = $mainsql->get_wish(0, 0, 0, $profile_id, 0, $product[0]['product_id']); ?>
                                            <?php if ($chk_wishlist && $logged) : ?>
                                            <button id="btnwishlist<?php echo $product[0]['product_id']; ?>" attribute="<?php echo $product[0]['product_id']; ?>" class="btnwishlist redbtn margintop45"><i class="fa fa-gift"></i> Remove to Wishlist</button>
                                            <?php else : ?>
                                            <button id="btnwishlist<?php echo $product[0]['product_id']; ?>" attribute="<?php echo $product[0]['product_id']; ?>" class="btnwishlist redbtn margintop45"><i class="fa fa-gift"></i> Add to Wishlist</button>
                                            <?php endif; ?>&nbsp;<button id="btnback" id="btnback" class="redbtn margintop45"><i class="fa fa-arrow-left"></i> Back to List</button>
                                        </div>
                                        <div id="ainfoadd" class="ainfoadd margintop45">
                                            <div class="bold mediumtext marginbottom25">Specification</div>
                                            <div class="aspecs">
                                                <?php echo $product[0]['product_specs']; ?>
                                            </div>
                                        </div>
                                        
                                        <div id="ainfoadd" class="ainfoadd margintop45">
                                            <div class="bold mediumtext marginbottom25">You Might Also Like</div>
                                            <?php foreach ($subcatprod as $key => $value) : ?>
                                            <?php $product_price = $mainsql->get_price(0, 0, 0, 0, $value['product_id']); ?>
                                            <?php $product_brand = $mainsql->get_brands($value['product_brand']); ?>
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
                                                    <?php $chk_wishlist = $mainsql->get_wish(0, 0, 0, $profile_id, 0, $value['product_id']); ?>
                                                    <?php if ($chk_wishlist && $logged) : ?>
                                                    <button id="btnwishlist<?php echo $value['product_id']; ?>" attribute="<?php echo $value['product_id']; ?>" class="btnwishlist redbtn"><i class="fa fa-gift"></i> Remove to Wishlist</button>
                                                    <?php else : ?>
                                                    <button id="btnwishlist<?php echo $value['product_id']; ?>" attribute="<?php echo $value['product_id']; ?>" class="btnwishlist redbtn"><i class="fa fa-gift"></i> Add to Wishlist</button>
                                                    <?php endif; ?>
                                                    <button id="btnbuy<?php echo $value['product_id']; ?>" attribute="<?php echo $value['product_id']; ?>" class="btnbuy redbtn margintop25"><i class="fa fa-shopping-cart"></i> Buy this Item</button>
                                                    <button attribute="<?php echo $value['product_id']; ?>" attribute2="<?php echo urlencode(strtolower($value['product_name'])); ?>" class="btnview redbtn margintop25"><i class="fa fa-eye"></i> View this Item</button>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                        
                                    </div>

                                </div>
                            
                            <?php else : ?>
                            
                                <div class="lmaincontainer">
                                    <div class="filter">
                                        <div class="filterhead">Type</div>
                                        <div class="filterbody fbcat">
                                            <ul>
                                                <?php if ($scat) : ?>
                                                <?php $catdata = $mainsql->get_category($scat); ?>
                                                <?php $subcat = $mainsql->get_subcat(0, 0, 0, $scat); ?>
                                                <li><input id="subcat99999" type="checkbox" attribute="99999" attribute2="<?php echo $scat; ?>" name="cat[99999]" value="99999" class="subcatopt" checked /> <b><?php echo $catdata[0]['category_name']; ?></b></li> 
                                                <?php foreach ($subcat as $key => $value) : ?>
                                                <li><input id="subcat<?php echo $key; ?>" type="checkbox" attribute="<?php echo $value['subcat_id']; ?>" attribute2="<?php echo $scat; ?>" name="subcat[<?php echo $key; ?>]" value="<?php echo $value['subcat_id']; ?>" class="subcatopt"<?php echo in_array($value['subcat_id'], $ssubcat) ? ' checked' : ''; ?> /> <?php echo $value['subcat_name']; ?></li>
                                                <?php endforeach; ?>
                                                <?php else : ?>
                                                <?php foreach ($category as $key => $value) : ?>
                                                <li><input id="cat<?php echo $key; ?>" type="checkbox" attribute="<?php echo $value['category_id']; ?>" attribute2="<?php echo $value['category_name']; ?>" name="cat[<?php echo $key; ?>]" value="1" class="catopt" /> <?php echo $value['category_name']; ?></li>
                                                <?php endforeach; ?>
                                                <?php endif; ?>
                                            </ul>
                                        </div>    
                                        <div class="filterfoot footcat centertalign<?php echo ($subcat_count > 0 && $subcat_count <= 6) ? ' invisible' : ''; ?>">
                                            <button class="redbtn btnshow showcat">Show More</button>
                                        </div>
                                    </div>
                                    <div class="filter">
                                        <div class="filterhead">Brand</div>
                                        <div class="filterbody fbbrand">
                                            <ul>
                                                <?php foreach ($brand as $key => $value) : ?>
                                                <li><input id="brand<?php echo $key; ?>" type="checkbox" attribute="<?php echo $value['brand_id']; ?>" name="brand[<?php echo $key; ?>]" value="<?php echo $value['brand_id']; ?>" class="brandopt"<?php echo in_array($value['brand_id'], $sbrand) ? ' checked' : ''; ?> /> <?php echo $value['brand_name']; ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>   
                                        <div class="filterfoot footbrand centertalign">
                                            <button class="redbtn btnshow showbrand">Show More</button>
                                        </div>                                   
                                    </div>
                                    <div id="prange" class="filter"<?php echo !$product ? ' invisible' : ''; ?>>
                                        <div class="filterhead">Price Range</div>
                                        <div class="filterbody centertalign">
                                            <div id="pamount">P1000 - P50000</div>
                                            <div id="price-range"></div>
                                            <input id="minprice" type="hidden" name="price[0]" value="1000" />
                                            <input id="maxprice" type="hidden" name="price[1]" value="50000" />
                                            <button id="btnprange" name="btnprange" class="redbtn margintop10">Apply</button>
                                        </div>                                    
                                    </div>
                                </div>
                                <div id="proddata" class="rmaincontainer">
                                    <?php if ($product) : ?>
                                    
                                    <script>
                                        /* SLIDER */
                                        $(function() {
                                            $("#price-range").slider({
                                                range: true,
                                                min: <?php echo $minprice; ?>,
                                                max: <?php echo $maxprice; ?>,
                                                values: [<?php echo $sprice[0] ? $sprice[0] : $minprice; ?>, <?php echo $sprice[1] ? $sprice[1] : $maxprice; ?>],
                                                slide: function(event, ui) {
                                                    $("#pamount").html("P" + ui.values[0] + " - P" + ui.values[1]);
                                                    $("#minprice").val(ui.values[0]);
                                                    $("#maxprice").val(ui.values[1]);
                                                }
                                            });
                                            
                                            $("#pamount").html("P<?php echo $minprice ? $minprice : $sprice[0]; ?> - P<?php echo $maxprice ? $maxprice : $sprice[1]; ?>");
                                        });
                                    </script>
                                    
                                    <div class="prodcontainer">
                                    <?php if ($sprod) : ?>
                                    <div class="marginbottom25">Search result for <button id="btndelsprod" class="smlbtn"><?php echo $sprod; ?> <i class="fa fa-times"></i></button></div>
                                    <?php endif; ?>
                                    <?php foreach ($product as $key => $value) : ?>
                                    <?php $product_price = $mainsql->get_price(0, 0, 0, 0, $value['product_id']); ?>
                                    <?php $product_brand = $mainsql->get_brands($value['product_brand']); ?>
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
                                            <button id="btnbuy<?php echo $value['product_id']; ?>" attribute="<?php echo $value['product_id']; ?>" class="btnbuy redbtn margintop25"><i class="fa fa-shopping-cart"></i> Buy this Item</button>
                                            <?php $chk_wishlist = $mainsql->get_wish(0, 0, 0, $profile_id, 0, $value['product_id']); ?>
                                            <?php if ($chk_wishlist && $logged) : ?>
                                            <button id="btnwishlist<?php echo $value['product_id']; ?>" attribute="<?php echo $value['product_id']; ?>" class="btnwishlist redbtn margintop25"><i class="fa fa-gift"></i> Remove to Wishlist</button>
                                            <?php else : ?>
                                            <button id="btnwishlist<?php echo $value['product_id']; ?>" attribute="<?php echo $value['product_id']; ?>" class="btnwishlist redbtn margintop25"><i class="fa fa-gift"></i> Add to Wishlist</button>
                                            <?php endif; ?>
                                            <button attribute="<?php echo $value['product_id']; ?>" attribute2="<?php echo urlencode(strtolower($value['product_name'])); ?>" class="btnview redbtn margintop25"><i class="fa fa-eye"></i> View this Item</button>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                    </div>
                                    <?php if ($pages) : ?>
                                    <div class="centertalign margintop25"><?php echo $pages; ?></div>
                                    <?php endif; ?>
                                    <?php else : ?>
                                    <div class="centertalign margintopbot100 cattext">No product listed</div>
                                    <?php endif; ?>
                                </div>
                            
                            <?php endif; ?>
                            
                        </div>
                        
                   

                    </div>

                    

    <?php include(TEMP."/footer.php"); ?>