	<?php include(TEMP."/header.php"); ?>

    <!-- BODY -->
                    
                    <div class="bodycontainer">
                        <div id="conslide">
                            <div id="slider" class="nivoSlider">
                                <?php foreach ($gallery as $value) : ?>
                                <img src="<?php echo WEB; ?>/uploads/promo/<?php echo $value['promo_hugeimg']; ?>" alt="" />
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="maincontainer">
                            
                            <div class="hmaincontainer">
                                <?php if ($product) : ?>
                                <?php foreach ($product as $key => $value) : ?>
                                <?php $product_price = $mainsql->get_price(0, 0, 0, 0, $value['product_id']); ?>
                                <?php $product_brand = $mainsql->get_brands($value['product_brand']); ?>
                                <div id="fitem<?php echo $value['product_id']; ?>" class="fitem">
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
                                        <select id="buyqty<?php echo $value['product_id']; ?>" name="buyqty[<?php echo $value['product_id']; ?>]" class="clearboth">
                                            <?php for($i=1; $i<=30; $i++) : ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php endfor; ?>
                                        </select><br>
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
                                <?php endif; ?>
                            </div>
                            
                            <div class="hmaincontainer margintop15">
                                <?php if ($brand) : ?>
                                <?php foreach ($brand as $key => $value) : ?>
                                <div id="bitem<?php echo $value['brand_id']; ?>" attribute="<?php echo $value['brand_id']; ?>" class="bitem cursorpoint">
                                    <img src="<?php echo WEB; ?>/uploads/brand/<?php echo $value['brand_logo']; ?>" class="marginlr20 margintop30 marginbottom15" />
                                </div>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            
                            <div class="hmaincontainer margintop15">
                                <button id="shopmore" type="button" name="shopmore" class="redbtn">SHOP MORE</button>
                            </div>
                        </div>
                        
                   

                    </div>

                    

    <?php include(TEMP."/footer.php"); ?>